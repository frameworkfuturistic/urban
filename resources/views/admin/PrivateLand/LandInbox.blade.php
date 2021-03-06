@extends('admin.app')

@section('pagecss')
<link rel="stylesheet" href="css/buttons.dataTables.min.css">
@endsection

@section('heading')
Inbox Private Land
@endsection

@section('LandInboxActive')
class="active"
@endsection

@section('app-content')
<ul class="nav nav-pills nav-justified mb-8">
    <li class="nav-item col-md-4">
        <a class="nav-link active" id="active-pill" data-toggle="pill" href="#active" aria-expanded="true">Pending
            Verifications</a>
    </li>
</ul>
<!-- pending verifications -->
<div class="card">
    <div class="card-body">
        <div class="card-block">
        </div>
        <div class="mb-top">
            <!-- table -->
            <div class="container table-responsive">
            <table class="table table-responsive mb-0 display" id="datatable">
                <thead class="">
                        <tr>
                            <th>Action</th>
                            <th>RenewalID</th>
                            <th>LicenseYear</th>
                            <th>EntityName</th>
                            <th>EntiryAddress</th>
                            <th>EntityWard</th>
                            <th>TradeLicenseNo</th>
                            <th>MobileNo</th>
                            <th>Applicant</th>
                            <th>Father</th>
                            <th>CurrentUser</th>
                            <th>Initiator</th>
                            <th>Approver</th>
                            <th>ApplicationStatus</th>
                            <th>LisenceFee</th>
                            <th>GST</th>
                            <th>NetAmount</th>
                            <th>PmtAmount</th>
                            <th>Bank</th>
                            <th>MRno</th>
                            <th>PaymentDate</th>
                            <th>AppDate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lands as $land)
                        <tr>
                            <td scope="row">
                                <button onclick="window.location.replace('rnc/updateLandInbox/{{$land->id}}')"
                                    class="btn btn-success btn-sm"><i class="icon-pen"></i>
                                    Details
                                </button>
                            </td>
                            <td>{{$land->RenewalID}}</td>
                            <td>{{$land->LicenseYear}}</td>
                            <td>{{$land->EntityName}}</td>
                            <td>{{$land->EntityAddress}}</td>
                            <td>{{$land->WardNo}}</td>
                            <td>{{$land->TradeLicense}}</td>
                            <td>{{$land->MobileNo}}</td>
                            <td>{{$land->Applicant}}</td>
                            <td>{{$land->Father}}</td>
                            <td>{{$land->CurrentUser}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$land->ApplicationStatus}}</td>
                            <td>{{$land->TradeLicense}}</td>
                            <td>{{$land->GSTNo}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table -->
        </div>
    </div>
</div>
<!-- pending verifications -->
@endsection

@section('pagescript')
<script src="js/datatable_buttons/dataTables.buttons.min.js"></script>
<script src="js/datatable_buttons/jszip.min.js"></script>
<script src="js/datatable_buttons/pdfmake.min.js"></script>
<script src="js/datatable_buttons/vfs_fonts.js"></script>
<script src="js/datatable_buttons/buttons.html5.min.js"></script>
<script src="js/datatable_buttons/buttons.print.min.js"></script>
@endsection

@section('script')
<!-- datatable -->
<script>
    $(document).ready(function () {
        $("#landInboxActive").addClass('active');
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: {
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="icon-android-print"></i> Export PDF',
                        className: 'pdfButton btn-padding'
                    },
                    {
                        extend: 'copy',
                        text: '<i class="icon-android-print"></i> Copy',
                        className: 'copyButton btn-padding'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="icon-android-print"></i> CSV',
                        className: 'csvButton btn-padding'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="icon-document-text"></i> Excel',
                        className: 'excelButton btn-padding'
                    },
                    {
                        extend: 'print',
                        text: '<i class="icon-android-print"></i> Print',
                        className: 'printButton btn-padding'
                    }
                ]
            }
        });
    });

</script>
<!-- datatable -->
@endsection
