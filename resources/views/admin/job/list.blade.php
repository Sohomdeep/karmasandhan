@extends('admin.layouts.app')
@section('content')
<link href="{{asset('admin-assets/bootstrap-toggle/bootstrap-toggle.min.css')}}" rel="stylesheet">
<script src="{{asset('admin-assets/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
{{--<script>

    $(function(){
        setTimeout(function(){ $('.alert_msg').fadeOut('slow') }, 3000);

        $(document).on('click', '#GoSearchPagi', function(){
            $thisPage = $(this).attr('page');
            $('#GoPage').val($thisPage);
            $('#searchForm').submit();
        });

        $(".changeStatusClass").change(function(){
            var chkStatVal= $(this).val();
            var outlet_id= $(this).attr('id');
            var setStatusVal='';

            if (chkStatVal==0) {
                setStatusVal=1;
                $(this).val(setStatusVal);
            }else{
                setStatusVal=0;
                $(this).val(setStatusVal);
            }
            $.ajax({
                    type: "GET",
                    url: '{{route("outlet-status-update")}}',
                    data:{'outlet_id':outlet_id,'status':setStatusVal},
                    success: function(res)
                    {
                        console.log(res);
                    }
            });
        });
    })

    function confirm_alert(outlet_id){
        jConfirm('Are you sure you want to delete this outlet?', 'Confirmation', function(r) {
            if(r){
                if(outlet_id != ''){
                    window.location.href = '{{route("outlet-delete",["outlet_id"=>""])}}/'+outlet_id;
                }
            }
        });
    }
</script>--}}
<div id="main-container">
    <div class="main-header clearfix">
        <div class="page-title">
            <h4 class="no-margin">Job List</h4>
        </div><!-- /page-title -->
        <div class="tools">
            <a href="{{route('job-add')}}" class="btn btn-circle btn-info btn-sm" style="float: right;">
                <i class="fa fa-plus-circle"></i> Add
            </a>
        </div>
    </div><!-- /main-header -->
    <div class="grey-container shortcut-wrapper">
        <div style="margin-left: 7px;">
            <div class="row">
                <form action="" method="GET" id="searchForm">
                    <input type="hidden" name="page" id="GoPage" value="">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="search" placeholder="Search" value="{{trim(Request::get('search'))}}" maxlength="300">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-info" onclick="window.location.href ='{{route("job-list")}}';">Clear search</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /grey-container -->

    <div class="padding-md">
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
        <div class="panel panel-default table-responsive">
            <table class="table table-striped table-bordered" id="responsiveTable">
                <thead>
                    <tr>
                        <th style="width: 5%">Job Id</th>
                        <th style="width: 15%">Job Title</th>
                        <th style="width: 25%">Location</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(!$lists->isEmpty())
                    @foreach($lists as $list)
                    <tr>
                        <td>@if(isset($list->id)){{$list->id}}@endif</td>
                        <td>@if(isset($list->job_title)){{$list->job_title}}@endif</td>
                        <td>@if(isset($list->job_location_map))
                                @foreach($list->job_location_map as $val)
                                    {{$val->hasone_master_location->location_name}},
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{route('job-edit',['job_id'=>$list->id])}}" title="Edit"><button type="button" class="btn btn-round btn-xs btn-primary"><i class="fa fa-edit"></i></button></a>
                        </td>

                            {{-- @if(isset($list->outlet_has_one_distributor_outlet_mapping->distributor->distributor_name)){{$list->outlet_has_one_distributor_outlet_mapping->distributor->distributor_name}}@else -- @endif --}}
                        
                            {{-- <input type="checkbox" class="changeStatusClass" data-size="mini" id="{{$list->outlet_id}}"  @if($list->is_active ==1) checked @endif  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" value="{{$list->is_active}}"> --}}
                        
                        
                            {{--  --}}
                        
                    </tr>
                   @endforeach
                @else
                    <tr>
                        <td colspan="10" style="text-align: center;color: red;">No result found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="panel-footer clearfix">
                <div class="search-pager">
                    <ul class="pagination pagination-sm pagination-split no-margin">
                        @if(isset($pagination)) {!! $pagination !!}  @endif
                    </ul>
		        </div>
            </div>
        </div><!-- /panel -->

    </div><!-- /.padding-md -->
</div><!-- /main-container -->
@endsection
