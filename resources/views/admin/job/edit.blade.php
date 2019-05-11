@extends('admin.layouts.app')
@section('content')
<script src="{{asset('admin-assets/selectizejs/selectize.js')}}"></script>
<link href="{{asset('admin-assets/selectizejs/selectize.bootstrap3.css')}}" rel="stylesheet"/>
<link href="{{asset('admin-assets/selectizejs/selectize.default.css')}}" rel="stylesheet"/>








{{-- <script src="{{asset('admin-assets/js/ckediter.js')}}"></script> --}}
{{-- <script type="text/javascript">
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

</script> --}}


<div id="main-container">
    <div class="main-header clearfix">
        <div class="page-title">
            <h4 class="no-margin">Edit Job Details</h4>
        </div><!-- /page-title -->
    </div><!-- /main-header -->
    <div class="padding-md">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form id="add-form" action="{{route('do-edit-job')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="job_id" @if(isset($edit_data[0]->id))value="{{$edit_data[0]->id}}"@endif>
                            <div class="form-group">
                                <label>Job Title <span class="requireStar">*</span></label>
                                <input type="text" name="job_title" id="job_title" class="form-control input-sm" maxlength="75" @if(isset($edit_data[0]->job_title))value="{{$edit_data[0]->job_title}}"@endif>
                            </div>
                            <div class="form-group">
                                <label>Short Description <span class="requireStar">*</span></label>
                                <textarea name="short_desc" id="short_desc" class="form-control input-sm" maxlength="250">@if(isset($edit_data[0]->short_desc)){{$edit_data[0]->short_desc}}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label>Company Name <span class="requireStar">*</span></label>
                                <input type="text" name="company_name" id="company_name" class="form-control input-sm" maxlength="75" @if(isset($edit_data[0]->company_name))value="{{$edit_data[0]->company_name}}"@endif>
                            </div>
                            
                            @php
                            $loc_ids = [];
                            if(isset($edit_data[0]->job_location_map) && !empty($edit_data[0]->job_location_map))
                            {
                                foreach ($edit_data[0]->job_location_map as $loc) 
                                {
                                    array_push($loc_ids, $loc->hasone_master_location['id']);
                                }
                            }
                            @endphp

                            <div class="form-group">
                                <label>Locations<span class="requireStar">*</span></label>
                                <select name="location[]" id="location" class="form-control input-sm" multiple="">
                                    @if(!empty($locations) && count($locations)>0)
                                        <option value="">Select Location</option>
                                        @foreach($locations as $zn)
                                            <option @if(in_array($zn->id,$loc_ids)) selected @endif value="{{$zn->id}}">{{$zn->location_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Location Avilable</option>
                                    @endif
                                </select>
                            </div>

                            @php
                            $sk_ids = [];
                            if(isset($edit_data[0]->job_skill_map) && !empty($edit_data[0]->job_skill_map))
                            {
                                foreach ($edit_data[0]->job_skill_map as $sk) 
                                {
                                    array_push($sk_ids, $sk->hasone_master_skill['id']);
                                }
                            }
                            @endphp

                            <div class="form-group">
                                <label>Skills<span class="requireStar">*</span></label>
                                <select name="skill[]" id="skill" class="form-control input-sm" multiple="">
                                    @if(!empty($skills) && count($skills)>0)
                                        <option value="">Select Skill</option>
                                        @foreach($skills as $zn)
                                            <option @if(in_array($zn->id,$sk_ids)) selected @endif value="{{$zn->id}}">{{$zn->skill_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Skill Avilable</option>
                                    @endif
                                </select>
                            </div>
                               
                            @php
                            $sec_ids = [];
                            if(isset($edit_data[0]->job_sector_map) && !empty($edit_data[0]->job_sector_map))
                            {
                                foreach ($edit_data[0]->job_sector_map as $sec) 
                                {
                                    array_push($sec_ids, $sec->hasone_master_sector['id']);
                                }
                            }
                            @endphp

                            <div class="form-group">
                                <label>Sectors<span class="requireStar">*</span></label>
                                <select name="sector[]" id="sector" class="form-control input-sm" multiple="">
                                    @if(!empty($sectors) && count($sectors)>0)
                                        <option value="">Select Sectors</option>
                                        @foreach($sectors as $zn)
                                            <option @if(in_array($zn->id,$sec_ids)) selected @endif value="{{$zn->id}}">{{$zn->sector_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Sector Avilable</option>
                                    @endif
                                </select>
                            </div>
                                
                            @php
                            $que_ids = [];
                            if(isset($edit_data[0]->job_qualification_map) && !empty($edit_data[0]->job_qualification_map))
                            {
                                foreach ($edit_data[0]->job_qualification_map as $que) 
                                {
                                    array_push($que_ids, $que->hasone_master_qualification['id']);
                                }
                            }
                            @endphp

                            <div class="form-group">
                                <label>Qualifications<span class="requireStar">*</span></label>
                                <select name="qualification[]" id="qualification" class="form-control input-sm" multiple="">
                                    @if(!empty($qualifications) && count($qualifications)>0)
                                        <option value="">Select Qualifications</option>
                                        @foreach($qualifications as $zn)
                                            <option @if(in_array($zn->id,$que_ids)) selected @endif value="{{$zn->id}}">{{$zn->qualification_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Qualification Avilable</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Up Body<span class="requireStar">*</span></label>
                                <textarea  name="up_body" id="editor1" class="form-control input-sm">@if(isset($edit_data[0]->up_body)){{$edit_data[0]->up_body}}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label>Down Body <span class="requireStar">*</span></label>
                                <textarea  name="down_body" id="editor2" class="form-control input-sm">@if(isset($edit_data[0]->down_body)){{$edit_data[0]->down_body}}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label>Experiance (in years) <span class="requireStar">*</span></label>
                                <input type="text" name="experiance" id="experiance" class="form-control input-sm" maxlength="2" @if(isset($edit_data[0]->experiance))value="{{$edit_data[0]->experiance}}"@endif>
                            </div>
                            <div class="form-group">
                                <label>Expired On <span class="requireStar">*</span></label>
                                <input type="date" name="expired_on" id="expired_on" class="form-control input-sm" maxlength="2">
                            </div>

                            <div class="form-group">
                                <label>Views <span class="requireStar">*</span></label>
                                <input type="text" name="views" id="views" class="form-control input-sm" maxlength="10" readonly="" @if(isset($edit_data[0]->job_view['views']))value="{{$edit_data[0]->job_view['views']}}"@endif>
                            </div>

                            <div class="form-group">
                                <label>Extra Views <span class="requireStar">*</span></label>
                                <input type="text" name="extra" id="extra" class="form-control input-sm" maxlength="10"  @if(isset($edit_data[0]->job_view['extra']))value="{{$edit_data[0]->job_view['extra']}}"@endif>
                            </div>
                          
                            <div class="form-group">
                                <label>Is Featured <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input {{($edit_data[0]->is_featured)==1?'checked':''}} type="radio" name="is_featured" value="1" >
                                        <span class="custom-radio"></span>
                                        Yes
                                    </label>
                                    <label class="label-radio inline">
                                        <input {{($edit_data[0]->is_featured)==0?'checked':''}} type="radio" name="is_featured" value="0">
                                        <span class="custom-radio"></span>
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Active/Inactive <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input {{($edit_data[0]->is_active)==1?'checked':''}} type="radio" name="is_active" value="1" checked>
                                        <span class="custom-radio"></span>
                                        Active
                                    </label>
                                    <label class="label-radio inline">
                                        <input {{($edit_data[0]->is_active)==0?'checked':''}} type="radio" name="is_active" value="0">
                                        <span class="custom-radio"></span>
                                        Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="panel-footer" style="text-align: center">
                                <div id="all_error" style="color: red"></div>
                                <button type="submit" id="add-form_btn" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="javascript:location.href ='{{route("job-list")}}'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /panel -->
            </div><!-- /.col -->
        </div>
    </div><!-- /.padding-md -->
</div><!-- /main-container -->
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script type="text/javascript">
     CKEDITOR.replace( 'editor1' );
     CKEDITOR.replace( 'editor2' );

    /*$( function() {
        $( "#datepicker" ).datepicker();
    });
*/
     $('#location').selectize({
            plugins: ['remove_button'],
            persist: false,
            create: false,
        });

     $('#skill').selectize({
            plugins: ['remove_button'],
            persist: false,
            create: false,
        });

     $('#sector').selectize({
            plugins: ['remove_button'],
            persist: false,
            create: false,
        });

     $('#qualification').selectize({
            plugins: ['remove_button'],
            persist: false,
            create: false,
        });
</script>
@endsection