@extends('admin.layouts.app')
@section('content')
<style>
    body:after {
        content:'';
        background: url('{{ asset("admin-assets/img/cover_bg_1.jpg") }}');
        position: absolute;
        background-size: cover;
        top:0px;
        left: 0px;
        width:100%;
        height:100%;
        z-index:-1;
        background-attachment: fixed;
        background-position: center;
        opacity: 0.6;
    }
</style>
<div class="login-wrapper">
    <div class="text-center">
        <img src="{{ asset('admin-assets/img/itc_business_logo.png') }}" style="width: 85px;">
    </div>

    <div class="login-widget animation-delay1">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <i class="fa fa-lock fa-lg"></i> Login
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group ">
                        <label>Login Id</label>
                        <input type="text" id="email" type="text" name="email" value="{{ old('account_id') }}" placeholder="Login Id" class="form-control input-sm bounceIn animation-delay2">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" placeholder="Password" name="password" class="form-control input-sm bounceIn animation-delay4">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!--<div class="form-group">
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="regular-checkbox chk-delete" />
                            <span class="custom-checkbox info bounceIn animation-delay4"></span>
                        </label>
                        Remember me
                    </div>-->
                    <hr/>
                    <button type="submit" class="btn btn-success btn-sm bounceIn animation-delay5 pull-right">
                        <i class="fa fa-sign-in"></i> Sign in
                    </button>
                </form>
            </div>
        </div>
        <!-- /panel -->
    </div>
    <!-- /login-widget -->
</div>
<!-- /login-wrapper -->
@endsection
