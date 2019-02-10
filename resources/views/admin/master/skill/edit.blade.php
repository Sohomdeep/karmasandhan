@extends('admin.layouts.app')
@section('content')
<script type="text/javascript">
$(function () {
    $('#edit-form').submit(function () {
        $('#all_error').html('');
        if ($('#skill_name').commonCheck('Please enter skill name')) {
            $('#edit-form_btn').prop('disabled', true);
            return true;
        }else
        {
            $('#all_error').html('You have left out mandatory field(s)');
            return false;
        }
        return false;
    });
})
</script>


<div id="main-container">
    <div class="main-header clearfix">
        <div class="page-title">
            <h4 class="no-margin">Edit Zone</h4>
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

                        <form id="edit-form" action="{{route('do-edit-skill')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="skill_id" value="{{$skill_details->id}}">
                            <div class="form-group">
                                <label>Name <span class="requireStar">*</span></label>
                                <input type="text" name="skill_name" id="skill_name" class="form-control input-sm" maxlength="60" value="{{$skill_details->skill_name}}">
                            </div>

                            <div class="form-group">
                                <label>Active/Inactive <span class="requireStar">*</span></label>
                                <div>
                                    <label class="label-radio inline">
                                        <input type="radio" name="active_inactive" value="1" @if($skill_details->is_active == 1) checked @endif>
                                        <span class="custom-radio"></span>
                                        Active
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" name="active_inactive" value="0" @if($skill_details->is_active == 0) checked @endif>
                                        <span class="custom-radio"></span>
                                        Inactive
                                    </label>
                                </div>
                            </div>



                            <div class="panel-footer" style="text-align: center">
                                <div id="all_error" style="color: red"></div>
                                <button type="submit" id="edit-form_btn" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="javascript:location.href ='{{route("skill-list")}}'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /panel -->
            </div><!-- /.col -->
        </div>
    </div><!-- /.padding-md -->
</div><!-- /main-container -->
@endsection