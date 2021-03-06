<?php

namespace App\Repository\Toll;

use App\Models\Toll;
use App\Models\TollPayment;
use App\Repository\Toll\TollRepository;
use App\Traits\Toll as TollTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentTollRepository implements TollRepository
{
    use TollTrait;
    /**
     * Created On-07-07-2022
     * Created By-Anshu Kumar
     * ----------------------------
     * --------------------------------------------------------------
     * Repository for Toll payments and Tolls
     * ------------------------------------------------------------------------------------------
     * ------------------------------------------------------------------------------------------
     */

    /**
     * Save Tolls and Toll Payment Version 1 (Toll Payment)
     */
    public function addToll(Request $request)
    {
        $request->validate([
            'VendorName' => 'required',
            'MarketName' => 'required',
            'AreaName' => 'required',
            'Rate' => 'required',
        ]);

        try {
            $toll = new Toll;
            $toll->VendorName = $request->VendorName;
            $toll->VendorFather = $request->VendorFather;
            $toll->ShopName = $request->ShopName;
            $toll->MarketName = $request->MarketName;
            $toll->AreaName = $request->AreaName;
            $toll->Rate = $request->Rate;
            $toll->UserId = auth()->user()->id;
            $toll->save();

            $tp = new TollPayment;
            $tp->TollId = $toll->id;
            $tp->From = '2022-05-01';
            $tp->To = '2022-06-30';
            $tp->Rate = $request->Rate;
            $tp->Amount = 60 * $request->Rate;
            $tp->PmtMode = 'CASH';
            $tp->Days = '60';
            $tp->PaymentDate = date("Y-m-d");
            $tp->UserId = auth()->user()->id;
            $tp->save();
            return response()->json([
                'message' => 'Successfully Saved',
                'vendor_id' => $toll->id,
                'tran_id' => $tp->id,
                'vendor_name' => $toll->VendorName,
                'market_name' => $toll->MarketName,
                'area_name' => $toll->AreaName,
                'from' => $tp->From,
                'to' => $tp->To,
                'days' => $tp->Days,
                'rate' => $tp->Rate,
                'amount' => $tp->Amount,
            ], 200);
        } catch (Exception $e) {
            return response()->json($e, 400);
        }
    }

    /**
     * Repository for Get Tolls By ID
     */
    public function getTollById($id)
    {
        // $0toll = Toll::where('id', $id)->get();
        $strSql = "
        select t.id as VendorID,
            a.id as TranID,
            t.VendorName,
            t.Address,
            t.ShopType,
            date_format(a.PaymentFrom,'%d-%m-%Y') as DateFrom,
            date_format(a.PaymentTo,'%d-%m-%Y') as DateTo,
            t.AreaName,
            t.Location,
            a.Amount,
            a.PmtMode,
            a.Rate AS PaidRate,
            a.Days,
            date_format(t.LastPaymentDate,'%d-%m-%Y') as PaymentDate,
            s.name as UserName,
            s.mobile,
            t.Rate,
            a.created_at
            from tolls t
            left join (SELECT id,tollid,`FROM` AS PaymentFrom,`TO` AS PaymentTo,Amount,PmtMode,
                       Rate,Days,PaymentDate,UserId,created_at from toll_payments where tollid=$id
            order by id desc limit 1) as a on a.tollid=t.id
            left join survey_logins s on s.id=a.UserID
            WHERE t.id=$id
        ";

        $toll = DB::select($strSql);

        $arr = array();
        if ($toll) {
            foreach ($toll as $tolls) {
                // $dDate = date_create($tolls->created_at ?? '');
                // $created_at = date_format($dDate, 'd-m-Y');

                $created_at = $tolls->created_at == null ? '' : date_format(date_create($tolls->created_at), 'd-m-Y');
                $val['VendorID'] = $tolls->VendorID ?? '';
                $val['VendorName'] = $tolls->VendorName ?? '';
                $val['Address'] = $tolls->Address ?? '';
                $val['ShopType'] = $tolls->ShopType ?? '';
                $val['AreaName'] = $tolls->AreaName ?? '';
                $val['Location'] = $tolls->Location ?? '';
                $val['DailyTollFee'] = $tolls->Rate ?? '';
                $val['LastPaymentDate'] = $tolls->LastPaymentDate ?? '';

                $val['TranID'] = $tolls->TranID ?? '';
                $val['DateFrom'] = $tolls->DateFrom ?? '';
                $val['DateTo'] = $tolls->DateTo ?? '';
                $val['Amount'] = $tolls->Amount ?? '';
                $val['PmtMode'] = $tolls->PmtMode ?? '';
                $val['RatePaid'] = $tolls->PaidRate ?? '';
                $val['PmtDays'] = $tolls->Days ?? '';
                $val['PaymentDate'] = $tolls->PaymentDate ?? '';
                $val['UserName'] = $tolls->UserName ?? '';
                $val['UserMobile'] = $tolls->mobile ?? '';
                $val['CreatedAt'] = $created_at ?? '';
                array_push($arr, $val);
            }
            return response()->json($arr, 200);
        } else {
            return response()->json(['Data Not Found for'], 404);
        }
    }

    /**
     * Get All Tolls
     */
    public function getAllToll()
    {
        $toll = Toll::orderBy('id', 'DESC')->get();
        $arr = array();
        if ($toll) {
            foreach ($toll as $tolls) {
                $val['id'] = $tolls->id ?? '';
                $val['VendorName'] = $tolls->VendorName ?? '';
                $val['VendorFather'] = $tolls->VendorFather ?? '';
                $val['ShopName'] = $tolls->ShopName ?? '';
                $val['MarketName'] = $tolls->MarketName ?? '';
                $val['AreaName'] = $tolls->AreaName ?? '';
                $val['Rate'] = $tolls->Rate ?? '';
                $val['UserId'] = $tolls->UserId ?? '';
                $val['created_at'] = $tolls->created_at ?? '';
                $val['updated_at'] = $tolls->updated_at ?? '';
                array_push($arr, $val);
            }
            return response()->json($arr, 200);
        } else {
            return response()->json(['Data Not Found', 404]);
        }
    }

    /**
     * Get Toll Location By Area
     * @param AreaName $area
     */
    public function getTollLocation()
    {
        $location = DB::select(
            "select distinct
                AreaName,
                Location,
                concat(AreaName,', ',Location)
                as AreaLocation
                from tolls"
        );
        return response()->json($location, 200);
    }

    /**
     * Get Vendor Details by Ids
     * @param id $id
     */
    public function getVendorDetailsByArea(Request $request)
    {
        $request->validate([
            'AreaName' => 'required',
            'Location' => 'required',
        ]);
        $arr = array();
        $detail = Toll::select('id', 'ShopNo', 'ShopType', 'AreaName', 'VendorName', 'Address', 'Location', 'LastPaymentDate', 'LastAmount')
            ->where('AreaName', '=', $request->AreaName)
            ->where('Location', '=', $request->Location)
            ->orderByDesc('id')
            ->get();
        foreach ($detail as $details) {
            $val['id'] = $details->id ?? '';
            $val['ShopNo'] = $details->ShopNo ?? '';
            $val['ShopType'] = $details->ShopType ?? '';
            $val['AreaName'] = $details->AreaName ?? '';
            $val['VendorName'] = $details->VendorName ?? '';
            $val['Address'] = $details->Address ?? '';
            $val['Location'] = $details->Location ?? '';
            $val['LastPaymentDate'] = $details->LastPaymentDate ?? '';
            $val['LastAmount'] = $details->LastAmount ?? '';
            array_push($arr, $val);
        }
        return response()->json($arr, 200);
    }

    /**
     * Toll Payment (Version 2)
     */
    public function tollPayment(Request $request, $id)
    {
        $request->validate([
            'From' => 'required',
            'To' => 'required',
        ]);

        try {
            $toll = Toll::find($id);
            $formatted_from = date_create($request->From);
            $mLastPaymentDate = date_format($formatted_from, "Y-m-d");
            if (!$mLastPaymentDate) {
                return response()->json('This shop has no Last Payment Date', 400);
            }
            if ($mLastPaymentDate) {
                $create = date_create($request->To);
                $format = date_format($create, "Y-m-d");
                if ($format > $mLastPaymentDate) {
                    $Rate = $toll->Rate;
                    $toll->UserId = auth()->user()->id;

                    $tp = new TollPayment;
                    $tp->TollId = $toll->id;
                    $From = date_create($mLastPaymentDate);
                    $tp->From = date_format($From, 'Y-m-d');
                    $To = date_create($request->To);
                    $tp->To = date_format($To, 'Y-m-d');
                    $tp->Rate = $Rate;
                    // Calculating Days
                    $interval = date_diff($From, $To);
                    $tp->Days = $interval->format("%a");

                    // Calculating Amount
                    $Rate = $toll->Rate;
                    $tp->Amount = $tp->Days * $Rate;
                    $toll->LastAmount = $tp->Days * $Rate;
                    $toll->LastPaymentDate = $tp->To;

                    $tp->PmtMode = 'CASH';
                    $tp->PaymentDate = date("Y-m-d H:i:s");
                    $tp->UserId = auth()->user()->id;

                    $toll->save();
                    $tp->save();

                    $query = DB::select("
                    select * from survey_logins where id='$toll->UserId'
                    ");
                    return response()->json([
                        'message' => 'Payment Successful',
                        'vendor_name' => $toll->VendorName,
                        'vendor_mobile' => $toll->ContactNo,
                        'vendor_id' => $toll->id,
                        'tran_id' => $tp->id,
                        'from' => $tp->From,
                        'to' => $tp->To,
                        'daily_toll_fee' => $tp->Rate,
                        'location_name' => $toll->Location,
                        'area_name' => $toll->AreaName,
                        'days' => $tp->Days,
                        'amount' => $tp->Amount,
                        'tax_collector_name' => $query[0]->name,
                        'tax_collector_mobile' => $query[0]->mobile,
                    ], 200);
                } else {
                    return response()->json('Date Should be after the Last Payment Date', 400);
                }
            }
        } catch (Exception $e) {
            return response($e, 400);
        }
    }

    /**
     * Save Tolls
     */
    public function saveToll(Request $request)
    {
        $request->validate([
            'VendorName' => 'required',
        ]);
        // dd($request->all());
        try {
            $toll = new Toll;
            $this->saving($toll, $request);
            $toll->save();
            return response()->json('Successfully Saved The Toll', 200);
        } catch (Exception $e) {
            return response()->json($e, 400);
        }
    }

    /**
     * Update Toll
     */
    public function updateToll(Request $request, $id)
    {
        $request->validate([
            'VendorName' => 'required',
        ]);

        try {
            $toll = Toll::find($id);
            $this->saving($toll, $request);
            $toll->save();
            return response()->json('Successfully Updated', 200);
        } catch (Exception $e) {
            return response()->json($e, 400);
        }
    }

    /**
     * Get Toll Area List
     */
    public function getAreaList()
    {
        $area = Toll::select('AreaName')
            ->distinct()
            ->get();
        return response()->json($area, 200);
    }
}
