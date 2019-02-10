@extends('admin.layouts.app')
@section('content')
<script type="text/javascript">
$(function () {

    $('#add-form').submit(function () {

        $('#all_error').html('');
        if ($('#sector_name').commonCheck('Please enter sector name')) {
            $('#add-form_btn').prop('disabled', true);
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
            <h4 class="no-margin">Add Sector</h4>
        </div><!-- /page-title -->
    </div><!-- /main-header -->
    <div class="padding-md">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form id="add-form" action="{{route('do-add-sector')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name <span class="requireStar">*</span></label>
                                <input type="text" name="sector_name" id="sector_name" class="form-control input-sm" maxlength="60">
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
                                <button type="button" class="btn btn-danger" onclick="javascript:location.href ='{{route("sector-list")}}'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /panel -->
            </div><!-- /.col -->
        </div>
    </div><!-- /.padding-md -->
</div><!-- /main-container -->
@endsection