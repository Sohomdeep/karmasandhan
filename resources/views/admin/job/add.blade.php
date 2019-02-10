@extends('admin.layouts.app')
@section('content')
{{-- <script src="{{asset('public/admin-assets/js/ckediter.js')}}"></script> --}}
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
            <h4 class="no-margin">Add Job</h4>
        </div><!-- /page-title -->
    </div><!-- /main-header -->
    <div class="padding-md">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form id="add-form" action="{{route('do-add-job')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Job Title <span class="requireStar">*</span></label>
                                <input type="text" name="job_title" id="job_title" class="form-control input-sm" maxlength="75">
                            </div>
                            <div class="form-group">
                                <label>Short Description <span class="requireStar">*</span></label>
                                <textarea name="short_desc" id="short_desc" class="form-control input-sm" maxlength="250"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Company Name <span class="requireStar">*</span></label>
                                <input type="text" name="company_name" id="company_name" class="form-control input-sm" maxlength="75">
                            </div>

                            <div class="form-group">
                                <label>Locations<span class="requireStar">*</span></label>
                                <select name="location[]" id="location" class="form-control input-sm" multiple="">
                                    @if(!empty($locations) && count($locations)>0)
                                        <option value="">Select Location</option>
                                        @foreach($locations as $zn)
                                            <option value="{{$zn->id}}">{{$zn->location_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Location Avilable</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Skills<span class="requireStar">*</span></label>
                                <select name="skill[]" id="skill" class="form-control input-sm" multiple="">
                                    @if(!empty($skills) && count($skills)>0)
                                        <option value="">Select Skill</option>
                                        @foreach($skills as $zn)
                                            <option value="{{$zn->id}}">{{$zn->skill_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Skill Avilable</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Sectors<span class="requireStar">*</span></label>
                                <select name="sector[]" id="sector" class="form-control input-sm" multiple="">
                                    @if(!empty($sectors) && count($sectors)>0)
                                        <option value="">Select Sectors</option>
                                        @foreach($sectors as $zn)
                                            <option value="{{$zn->id}}">{{$zn->sector_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Sector Avilable</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Qualifications<span class="requireStar">*</span></label>
                                <select name="qualification[]" id="qualification" class="form-control input-sm" multiple="">
                                    @if(!empty($qualifications) && count($qualifications)>0)
                                        <option value="">Select Qualifications</option>
                                        @foreach($qualifications as $zn)
                                            <option value="{{$zn->id}}">{{$zn->qualification_name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Qualification Avilable</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Up Body<span class="requireStar">*</span></label>
                                <textarea  name="up_body" id="editor1" class="form-control input-sm"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Down Body <span class="requireStar">*</span></label>
                                <textarea  name="down_body" id="editor2" class="form-control input-sm"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Experiance (in years) <span class="requireStar">*</span></label>
                                <input type="text" name="experiance" id="experiance" class="form-control input-sm" maxlength="2">
                            </div>
                            <div class="form-group">
                                <label>Expired On <span class="requireStar">*</span></label>
                                <input type="date" name="expired_on" id="expired_on" class="form-control input-sm" maxlength="2">
                            </div>
                          
                            <div class="form-group">
                                <label>Is Featured <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input type="radio" name="is_featured" value="1" >
                                        <span class="custom-radio"></span>
                                        Yes
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" name="is_featured" value="0" checked>
                                        <span class="custom-radio"></span>
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Active/Inactive <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input type="radio" name="is_active" value="1" checked>
                                        <span class="custom-radio"></span>
                                        Active
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" name="is_active" value="0">
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
</script>
@endsection