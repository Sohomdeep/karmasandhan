@extends('layouts.app')
@section('content')
<!--Google map api location-->
<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyB8jvqsSiQ8afTkrUOi1lSVP9hPtFy33qU&libraries=places'></script>
<!-- <script src="{{asset('admin_assets/js/locationPicker/locationpicker.jquery.min.js')}}"></script>
<script src="{{asset('admin_assets/js/locationPicker/locationpicker.jquery.min.map')}}"></script> -->
<script src="{{asset('locationPicker/locationpicker.jquery.min.js')}}"></script>
<script src="{{asset('locationPicker/locationpicker.jquery.min.map')}}"></script>
<!--Google map api location end    -->
<script type="text/javascript">
$(function () {
    $('#edit-form').submit(function () {
        $('#all_error').html('');
        if ($('#outlet_name').commonCheck('Please enter outlet name') & $('#picklocation').commonCheck('Please enter adress')) {
            $('#edit-form_btn').prop('disabled', true);
            return true;
        }else
        {
            $('#all_error').html('You have left out mandatory field(s)');
            return false;
        }
        return false;
    });

    //google api start
    var baselat = $('#picklocationlat').val();
    var baselong = $('#picklocationlong').val();
    try {
        baselat = parseFloat(baselat);
        baselong = parseFloat(baselong);
        if (isNaN(baselat)) {
            baselat = 0;
        }
        if (isNaN(baselong)) {
            baselong = 0;
        }
    } catch (ex) {
        baselat = 0;
        baselong = 0;
    }

    $('#location_map').locationpicker({
        location: {latitude: baselat, longitude: baselong},
        radius: 300,
        zoom: 15,
        scrollwheel: false,
        inputBinding: {
            latitudeInput: $('#picklocationlat'),
            longitudeInput: $('#picklocationlong'),
            locationNameInput: $('#picklocation')
        },
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            var addressComponents = $(this).locationpicker('map').location.addressComponents;
            updateControls(addressComponents);
        },
        enableAutocomplete: true,
        enableReverseGeocode: true
    });

    function updateControls(addressComponents)
    {
        $('#picklocationCity').val(addressComponents.city);
        $("#picklocationaddress").val(addressComponents.addressLine1 + ', ' + addressComponents.city + ', ' + addressComponents.stateOrProvince + ', ' + addressComponents.postalCode);
    }
})
</script>


<div id="main-container">
    <div class="main-header clearfix">
        <div class="page-title">
            <h4 class="no-margin">Edit Outlet</h4>
        </div><!-- /page-title -->
    </div><!-- /main-header -->
        @if(Session::get('error_message') != '')
        <div class="alert alert-danger alert_msg" style="text-align: center;">
            <div class="close closeError" data-close="alert"></div>
            <span>{{Session::get('error_message')}}</span>
        </div>
        {{Session::forget('error_message')}}
        @endIf
        @if(Session::get('success_message') != '')
        <div class="alert alert-success alert_msg" style="text-align: center;">
            <div class="close closeError" data-close="alert"></div>
            <span>
                {{Session::get('success_message')}} </span>
        </div>
        {{Session::forget('success_message')}}
        @endIf
    <div class="padding-md">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form id="edit-form" action="{{route('do-edit-outlet')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="outlet_id" value="{{$outlet_details->outlet_id}}">
                            <div class="form-group">
                                <label>Name <span class="requireStar">*</span></label>
                                <input type="text" name="outlet_name" id="outlet_name" class="form-control input-sm" maxlength="60" value="{{$outlet_details->outlet_name}}">
                            </div>

                            <div class="form-group">
                                <label>Wholesale Distributor</label>
                                <input type="text" readonly name="outlet_name" id="outlet_name" class="form-control input-sm" maxlength="60" value="{{$outlet_details->outlet_has_one_distributor_outlet_mapping->distributor->distributor_name}}">
                            </div>

                            <!-- <div class="form-group">
                                <label>Wholesale Distributor<span class="requireStar">*</span></label>
                                <select name="distributor" id="distributor" class="form-control input-sm" readonly>
                                    @if(!empty($distributor) && count($distributor)>0)
                                        <option value="">Select Distributor</option>
                                        @foreach($distributor as $zn)
                                            <option {{($zn->distributor_id==$outlet_details->outlet_has_one_distributor_outlet_mapping->distributor->distributor_id)?'selected':''}} value="{{$zn->distributor_id}}">{{$zn->distributor_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Distributor Avilable</option>
                                    @endif
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label>Outlet Code </label>
                                <input type="text" name="outlet_code" id="outlet_code" class="form-control input-sm" maxlength="60" value="{{$outlet_details->outlet_code}}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Pick a location <span class="requireStar">*</span></label>
                                <input type="text" name="address" id="picklocation" class="form-control input-sm" placeholder="" maxlength="250" value="{{$outlet_details->address}}">
                            </div>
                            <div class="form-group">
                                <div id="location_map" style="height:300px;"></div>
                            </div>


                            <div class="form-group">
                                <label>Latitude <span class="requireStar">*</span></label>
                                <input type="text" name="lat" id="picklocationlat" class="form-control input-sm" maxlength="60" value="{{$outlet_details->latitude}}">
                            </div>
                            <div class="form-group">
                                <label>longitude <span class="requireStar">*</span></label>
                                <input type="text" name="lng" id="picklocationlong" class="form-control input-sm" maxlength="60" value="{{$outlet_details->longitude}}">
                            </div>

                            <div class="form-group">
                                <label>Active/Inactive <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input type="radio" name="active_inactive" value="1" @if($outlet_details->is_active == 1) checked @endif>
                                        <span class="custom-radio"></span>
                                        Active
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" name="active_inactive" value="0" @if($outlet_details->is_active == 0) checked @endif>
                                        <span class="custom-radio"></span>
                                        Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="panel-footer" style="text-align: center">
                                <div id="all_error" style="color: red"></div>
                                <button type="submit" id="edit-form_btn" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="javascript:location.href ='{{route("outlet-list")}}'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /panel -->
            </div><!-- /.col -->
        </div>
    </div><!-- /.padding-md -->
</div><!-- /main-container -->
@endsection