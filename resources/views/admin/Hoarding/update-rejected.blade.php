@extends('admin.app')

@section('heading')
Rejected Hoarding
@endsection

@section('hoardingRejectedActive')
class="active"
@endsection

@section('app-content')
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session()->get('message') }}
</div>
@endif
<ul class="nav nav-pills nav-justified mb-8">
    <li class="nav-item col-md-4">
        <a class="nav-link active" id="active-pill" data-toggle="pill" href="#active" aria-expanded="true">Details of
            Hoarding</a>
    </li>
</ul>

<!-- CARD  -->
<div class="card">
    <div class="card-body">
        <div class="card-block">
            <!-- tab items -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1"
                        aria-expanded="true">Application Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2"
                        aria-expanded="false">Workflow</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3"
                        aria-expanded="false">Documents</a>
                </li>
            </ul>
            <!-- tab-items -->
            <!-- TAB CONTENTS -->
            <div class="tab-content px-1 pt-1">
                <!-- ============================APPLATION DETAILS====================================== -->
                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card-header card-bg">
                                <div class="card-title my-card-title">DETAILS OF HOARDING</div>
                            </div>
                            <!-- FORM -->
                            <form action="rnc/edit-hoarding/{{$hoardings->HoardingID}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="spin-label">License Year <span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select class="spin-valuearea form-control" id="LicenseYear"
                                                        name="LicenseYear">
                                                        <option value="">Select One</option>
                                                        <option value="{{$hoardings->LicenseYear}}" selected>
                                                            {{$hoardings->LicenseYear}}</option>
                                                    </select>

                                                    <input type="hidden" id="renewalID" name="renewalID"
                                                        value="{{$hoardings->RenewalID}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">License From <span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="date" class="form-control" id="licenseFrom"
                                                        name="licenseFrom" value="{{$hoardings->PermissionFrom}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">License To <span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="date" id="licenseTo" name="licenseTo"
                                                        class="form-control" value="{{$hoardings->PermissionTo}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Location<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="location"
                                                        name="location" value="{{$hoardings->Location}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Longitude<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="longitude"
                                                        name="longitude" value="{{$hoardings->Longitude}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Latitude<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="latitude"
                                                        name="latitude" value="Latitude">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">LengthOfHoarding<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="number" class="form-control" id="lengthOfHoarding"
                                                        name="lengthOfHoarding" value="{{$hoardings->Length}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">WidthOfHoarding<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="number" class="form-control" id="widthOfHoarding"
                                                        name="widthOfHoarding" value="{{$hoardings->Width}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">AreaOfBoard<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="number" class="form-control" id="areaOfBoard"
                                                        name="areaOfBoard" value="{{$hoardings->BoardArea}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Material Type<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select name="materialType" id="materialType" class="form-control">
                                                        <option value="">Select Material Type</option>
                                                        <option value="{{$hoardings->MaterialType}}" selected>
                                                            {{$hoardings->MaterialType}}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Illumination<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select name="illumination" id="illumination" class="form-control">
                                                        <option value="">Select Illumination</option>
                                                        <option value="{{$hoardings->Illumination}}" selected>
                                                            {{$hoardings->Illumination}}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Facing<span
                                                        class="spin-separator spin-star">*</span>
                                                </td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select name="facing" id="facing" class="form-control">
                                                        <option value="">Select Facing</option>
                                                        <option value="{{$hoardings->Face}}" selected>
                                                            {{$hoardings->Face}}
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Landmark<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="landmark"
                                                        name="landmark" value="{{$hoardings->Landmark}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Hoarding Type<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select class="form-control" id="hoardingType" name="hoardingType">
                                                        <option value="">Select Hoarding Type</option>
                                                        <option value="{{$hoardings->HoardingCategory}}" selected>
                                                            {{$hoardings->HoardingCategory}}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Property Type<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select name="propertyType" id="propertyType" class="form-control">
                                                        <option value="">Select Property Type</option>
                                                        <option value="{{$hoardings->PropertyType}}" selected>
                                                            {{$hoardings->PropertyType}}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Zone<span
                                                        class="spin-separator spin-star">*</span>
                                                </td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <select name="zone" id="zone" class="form-control">
                                                        <option value="">Select Zone</option>
                                                        <option value="{{$hoardings->Zone}}">{{$hoardings->Zone}}
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">License Fee<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="licenseFee"
                                                        name="licenseFee" value="{{$hoardings->LicenseFee}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Amount<span
                                                        class="spin-separator spin-star">*</span>
                                                </td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="amount" name="amount"
                                                        value="{{$hoardings->Amount}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">GST<span
                                                        class="spin-separator spin-star">*</span>
                                                </td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="gst" name="gst"
                                                        value="{{$hoardings->GST}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="spin-label">Net Amount<span
                                                        class="spin-separator spin-star">*</span></td>
                                                <td class="spin-separator">:</td>
                                                <td>
                                                    <input type="text" class="form-control" id="netAmount"
                                                        name="netAmount" value="{{$hoardings->NetAmount}}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- FORM -->
                        </div>
                        <!--  NOTICE -->
                        <div class="col-md-3">
                            <h4 class="card-title success">Help &amp; Advisory</h4>
                            <div class="alert alert-success">Please Note!!</div>
                            <p class="card-text">
                            </p>
                            <ul>
                                <li>Keep all the information handy before filling up the application form.
                                </li>
                                <li>You will have to visit RMC office for any correction regatding
                                    application information.</li>
                                <li>Keep your address concise</li>
                                <li>Visit Market Section for further enquiry</li>
                            </ul>
                            <h4 class="card-title success">Hoarding Categories</h4>
                            <ul>
                                <li>A1. Bus and IPT Shelters</li>
                                <li>A2. Bus and IPT route markers</li>
                                <li>A3. Foot over Bridges, toilet blocks and urinals</li>
                                <li>A4. Cycle Station</li>
                                <li>A5. Police booth,parking booth, telephone booth, pre paid taxi booth, bus/rail
                                    booking information booth, drinking water facility, vending kiosks, pole kiosks,
                                    kiosks outside colonies to facilitate directory/ payment of bills etc.</li>
                                <li>A6. Sitting bench, garbage bins</li>
                                <li>B1. Metro/ MRTS</li>
                                <li>B2. Traffic barricading</li>
                                <li>B3. Public transport vehicle</li>
                                <li>C1. Bill boards/ Hoardings on public land</li>
                                <li>C2. Unipole, Monopole, Overhead arches on public land</li>
                                <li>C3. Pole kiosk, Lollipop on public land</li>
                                <li>D1. Billboards, building boards, wall wraps on Private Land/ Building</li>
                                <li>D2. Unipoles, Monopoles, Overhead arches on Private Land/ Building</li>
                                <li>D3. Pole Kiosk, Lollipop on Private land/ Building</li>
                                <li>E1. Temporary events</li>
                                <li>F1. Tree guards</li>
                                <li>G1. Self Advertisement</li>
                                <li>H1. Innovative advertisement including Trailer advertising, Bicycle, Auto rikshaw,
                                    handcard or any vehicle</li>
                                <li>I1. In-cinema on screen advertising including sides and advertisement films (moving
                                    advertisements.)</li>
                                <li>J1. Inside commercial building and public building</li>
                            </ul>
                        </div>
                        <!-- NOTICE -->
                    </div>
                    <!-- ============================APPLICATION DETATILS ENDS ============================= -->
                </div>
                <!-- ============================APPLATION DETAILS====================================== -->
                <!-- ============================ WORKFLOW ============================================= -->
                <div class="tab-pane" id="tab2" aria-labelledby="base-tab2" aria-expanded="false">
                    <div class="row">
                            <!-- comments -->
                            <div class="container bootstrap snippets bootdey">
                                <div class="blog-comment">
                                    <h3 class="text-success">Comments</h3>
                                    @foreach($comments as $comment)
                                        <ul class="comments mb-top">
                                            <li class="clearfix">
                                            <div class="post-comments">
                                                <p class="meta">
                                                    <span class="CommentUser"><i class="icon-android-contact"></i> {{$comment->UserID}}</span> says : <i class="pull-right"></i>
                                                    <i class="icon-android-stopwatch"></i> {{$comment->TrackDate}}
                                                </p>
                                                <p class="comment_color">
                                                    <i class="icon-edit2"></i> {{$comment->Remarks}}
                                                </p>
                                            </div>
                                            </li>
                                        </ul>
                                        @endforeach
                                </div>
                            </div>
                            </ul>
                            <!-- comments -->
                    </div>
                </div>
                <!-- ============================ WORKFLOW ============================================= -->
                <!-- ============================ DOCUMENT ============================================= -->
                <div class="tab-pane" id="tab3" aria-labelledby="base-tab3" aria-expanded="false">
                    <div class="row">
                        <!-- photos -->
                        <div class="col-md-3">
                            <div class="scroll">
                                <label for="">Building Permit/ Property Tax</label>
                                <img src="{{$hoardings->BuildingPermitPath}}" alt="" style="width:100%;"
                                    id="buildingPermitPath" name="buildingPermitPath" onclick="myfunction('first')">
                                <br>
                                <label for="">Certificate of Structural Engineer Ownship details(Public/Private)</label>
                                <img src="{{$hoardings->EngineerCertificatePath}}" alt="" style="width:100%;"
                                    id="engineerCertificatePath" name="engineerCertificatePath"
                                    onclick="myfunction('second')">
                                <br>
                                <label for="">Agreement Between the Building Owner and Advertisement Agency</label>
                                <img src="{{$hoardings->AgreementPath}}" alt="" style="width: 100%;" id="agreementPath"
                                    name="agreementPath" onclick="myfunction('third')">
                                <br>
                                <label for="">Co-Ordinates of OMD with GPS Location with Photograph</label>
                                <img src="{{$hoardings->GPSPhotographPath}}" alt="" style="width: 100%;" id="GPSPath"
                                    name="GPSPath" onclick="myfunction('forth')">
                                <br>
                                <label for="">Photograph Site</label>
                                <img src="{{$hoardings->SitePhotographPath}}" alt="" style="width: 100%;"
                                    id="sitePhotographPath" name="sitePhotographPath" onclick="myfunction('fifth')">
                                <br>
                                <label for="">Sketch Plan of Site</label>
                                <img src="{{$hoardings->SketchPlanPath}}" alt="" style="width: 100%;"
                                    id="sketchPlanPath" name="sketchPlanPath" onclick="myfunction('sixth')">
                                <br>
                                <label for="">Pending Dues(if any)</label>
                                <img src="{{$hoardings->PendingDuesPath}}" alt="" style="width: 100%;"
                                    id="pendingDuesPath" name="pendingDuesPath" onclick="myfunction('seventh')">
                                <br>
                                <label for="">Upload Architectural Drawing(elevation, measurement scale 1:1000)</label>
                                <img src="{{$hoardings->ArchitecturalDrawingPath}}" alt="" style="width: 100%;"
                                    id="architecturalDrawingPath" name="architecturalDrawingPath"
                                    onclick="myfunction('eighth')">
                                <br>
                                <label for="">Proceeding 1 Photo</label>
                                <img src="{{$hoardings->Proceeding1Photo}}" alt="" style="width: 100%;"
                                    id="proceeding1Photo" name="proceeding1Photo" onclick="myfunction('ninth')">
                                <br>
                                <label for="">Proceeding 2 Photo</label>
                                <img src="{{$hoardings->Proceeding2Photo}}" alt="" style="width: 100%;"
                                    id="proceeding2Photo" name="proceeding2Photo" onclick="myfunction('tenth')">
                                <br>
                                <label for="">Extra Document 1</label>
                                <img src="{{$hoardings->ExtraDoc1}}" alt="" style="width: 100%;" id="extraDoc1"
                                    name="extraDoc1" onclick="myfunction('eleventh')">
                                <br>
                                <label for="">Extra Document 2</label>
                                <img src="{{$hoardings->ExtraDoc2}}" alt="" style="width: 100%;" id="extraDoc2"
                                    name="extraDoc2" onclick="myfunction('twelth')">
                            </div>
                        </div>
                        <!-- photos -->
                        <!-- preview -->
                        <div class="col-md-9">
                            <div class="card-header card-bg mb-8">
                                <div class="card-title my-card-title">Preview</div>
                            </div>
                            <a href="{{$hoardings->BuildingPermitPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->BuildingPermitPath}}" alt="" id="first" href="#img1"
                                    style="width: 100%;">
                            </a>

                            <a href="{{$hoardings->EngineerCertificatePath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->EngineerCertificatePath}}" alt="" style="width:100%;"
                                    id="second">
                            </a>
                            <a href="{{$hoardings->AgreementPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->AgreementPath}}" alt="" style="width: 100%;" id="third">
                            </a>

                            <a href="{{$hoardings->GPSPhotographPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->GPSPhotographPath}}" alt="" style="width: 100%;" id="forth">
                            </a>

                            <a href="{{$hoardings->SitePhotographPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->SitePhotographPath}}" alt="" style="width: 100%;" id="fifth">
                            </a>

                            <a href="{{$hoardings->SketchPlanPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->SketchPlanPath}}" alt="" style="width: 100%;" id="sixth">
                            </a>

                            <a href="{{$hoardings->PendingDuesPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->PendingDuesPath}}" alt="" style="width: 100%;" id="seventh">
                            </a>
                            <a href="{{$hoardings->ArchitecturalDrawingPath}}" data-toggle="lightbox">
                                <img src="{{$hoardings->ArchitecturalDrawingPath}}" alt="" style="width: 100%;"
                                    id="eighth">
                            </a>
                            <a href="{{$hoardings->Proceeding1Photo}}" data-toggle="lightbox">
                                <img src="{{$hoardings->Proceeding1Photo}}" alt="" style="width: 100%;" id="ninth">
                            </a>
                            <a href="{{$hoardings->Proceeding2Photo}}" data-toggle="lightbox">
                                <img src="{{$hoardings->Proceeding2Photo}}" alt="" style="width: 100%;" id="tenth">
                            </a>
                            <a href="{{$hoardings->ExtraDoc1}}" data-toggle="lightbox">
                                <img src="{{$hoardings->ExtraDoc1}}" alt="" style="width: 100%;" id="eleventh">
                            </a>
                            <a href="{{$hoardings->ExtraDoc2}}" data-toggle="lightbox">
                                <img src="{{$hoardings->ExtraDoc2}}" alt="" style="width: 100%;" id="twelth">
                            </a>
                        </div>
                        <!-- preview -->
                    </div>
                </div>
                <!-- ============================ DOCUMENT ============================================= -->
            </div>
            <!-- TAB CONTENTS -->
        </div>
    </div>
</div>
<!-- CARD -->

@endsection

@section('pagescript')

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
    integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    $(document).ready(function () {
        // add active class
        $("#hoardingRejected").addClass('active');
        $('#datatable').DataTable();
        displayNone();
    });

    function displayNone() {
        document.getElementById("first").style.display = 'none';
        document.getElementById("second").style.display = 'none';
        document.getElementById("third").style.display = 'none';
        document.getElementById("forth").style.display = 'none';
        document.getElementById("fifth").style.display = 'none';
        document.getElementById("sixth").style.display = 'none';
        document.getElementById("seventh").style.display = 'none';
        document.getElementById("eighth").style.display = 'none';
        document.getElementById("ninth").style.display = 'none';
        document.getElementById("tenth").style.display = 'none';
        document.getElementById("eleventh").style.display = 'none';
        document.getElementById("twelth").style.display = 'none';
    }

    function myfunction(id) {
        displayNone();
        document.getElementById(id).style.display = 'block';
    }

</script>
@endsection
