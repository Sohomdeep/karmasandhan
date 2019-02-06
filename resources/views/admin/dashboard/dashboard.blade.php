@extends('admin.layouts.app')
@section('content')

<div id="main-container">
    <div class="main-header clearfix">
        <div class="page-title">
            <h3 class="no-margin">Dashboard</h3>
        </div>
    </div>

    <div class="grey-container shortcut-wrapper">
    </div>

    <div class="padding-md">
        <div class="row">
            <a href="">
            <div class="col-sm-6 col-md-3">
                <div class="panel-stat3 bg-danger">
                    <h4 class="m-top-none">Users</h4>
                    <div class="stat-icon">
                        <i class="fa fa-user fa-3x"></i>
                    </div>
                </div>
            </div><!-- /.col -->
            </a>

            <a href="#">
            <div class="col-sm-6 col-md-3">
                <div class="panel-stat3 bg-info">
                    <h4 class="m-top-none">JOB</h4>
                    <div class="stat-icon">
                        <i class="fa fa-hdd-o fa-3x"></i>
                    </div>
                </div>
            </div><!-- /.col -->
            </a>
            <a href="#">
            <div class="col-sm-6 col-md-3">
                <div class="panel-stat3 bg-warning">
                    <h4 class="m-top-none">JOB</h4>
                    <div class="stat-icon">
                        <i class="fa fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
            </div>
            </a>

            <a href="#">
            <div class="col-sm-6 col-md-3">
                <div class="panel-stat3 bg-success">
                    <h4 class="m-top-none">JOB</h4>
                    <div class="stat-icon">
                        <i class="fa fa-bar-chart-o fa-3x"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>

    </div><!-- /.padding-md -->
</div><!-- /main-container -->
<!-- Endless -->
@endsection
