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

    $('#add-form').submit(function () {

        $('#all_error').html('');
        if ($('#outlet_name').commonCheck('Please enter outlet name') & $('#picklocation').commonCheck('Please enter adress') & $('#distributor').commonCheck('Please select distributor')) {
            $('#add-form_btn').prop('disabled', true);
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
            <h4 class="no-margin">Add Outlet</h4>
        </div><!-- /page-title -->
    </div><!-- /main-header -->
    <div class="padding-md">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form id="add-form" action="{{route('outlet-doadd')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name <span class="requireStar">*</span></label>
                                <input type="text" name="outlet_name" id="outlet_name" class="form-control input-sm" maxlength="60">
                            </div>
                            <!-- <div class="form-group">
                                <label>Address <span class="requireStar">*</span></label>
                                <input type="text" name="address" id="address" class="form-control input-sm" maxlength="60">
                            </div> -->

                            <div class="form-group">
                                <label>Wholesale Distributor<span class="requireStar">*</span></label>
                                <select name="distributor" id="distributor" class="form-control input-sm">
                                    @if(!empty($distributor) && count($distributor)>0)
                                        <option value="">Select Distributor</option>
                                        @foreach($distributor as $zn)
                                            <option value="{{$zn->distributor_id}}">{{$zn->distributor_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Distributor Avilable</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pick a location <span class="requireStar">*</span></label>
                                <input type="text" name="address" id="picklocation" class="form-control input-sm" placeholder="" maxlength="250">
                            </div>
                            <div class="form-group">
                                <div id="location_map" style="height:300px;"></div>
                            </div>


                            <div class="form-group">
                                <label>Latitude <span class="requireStar">*</span></label>
                                <input type="text" name="lat" id="picklocationlat" class="form-control input-sm" maxlength="60">
                            </div>
                            <div class="form-group">
                                <label>longitude <span class="requireStar">*</span></label>
                                <input type="text" name="lng" id="picklocationlong" class="form-control input-sm" maxlength="60">
                            </div>
                            
                            <div class="form-group">
                                <label>Active/Inactive <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input type="radio" name="active_inactive" value="1" checked>
                                        <span class="custom-radio"></span>
                                        Active
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" name="active_inactive" value="0">
                                        <span class="custom-radio"></span>
                                        Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="panel-footer" style="text-align: center">
                                <div id="all_error" style="color: red"></div>
                                <button type="submit" id="add-form_btn" class="btn btn-success">Submit</button>
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