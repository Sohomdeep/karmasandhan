<aside class="fixed skin-6">
    <div class="sidebar-inner scrollable-sidebar">
        <div class="size-toggle">
            <a class="btn btn-sm" id="sizeToggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="btn btn-sm pull-right logoutConfirm_open" href="{{url('/logout')}}">
                <i class="fa fa-power-off"></i>
            </a>
        </div><!-- /size-toggle -->

        <div class="user-block clearfix">
            <div style="display: inline-block;text-align: center;width: 100%;">
                <img src="{{asset('public/admin-assets/img/pro.png')}}" alt="User Avatar" style="width: 50px;height: 50px;float: none;">
            </div>
            <div class="detail" style="width:100%;text-align:center;margin-top:3px;float:none;margin-left:0;">
                <strong>{{Auth::user()->name}}</strong>
            </div>
        </div><!-- /user-block -->

        <div class="main-menu">
            <ul>
                <li @if((Route::currentRouteName() == "dashboard")) class="active open" @endif>
                    <a href="{{route('dashboard')}}">
                        <span class="menu-icon">
                            <i class="fa fa-desktop fa-lg"></i>
                        </span>
                        <span class="text">
                            Dashboard
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                </li>

                <li  @if(Request::segment(2)=="job" ) active open @endif">
                    <a href="{{route('job-list')}}">
                        <span class="menu-icon">
                            <i class="fa fa-desktop fa-lg"></i>
                        </span>
                        <span class="text">
                            Job
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                </li>

                {{--<li class="openable @if(Request::segment(2)=="supervisor" || Request::segment(2)=="field-auditor") active open @endif">
                    <a href="#">
                        <span class="menu-icon">
                            <i class="fa fa-file-text fa-lg"></i>
                        </span>
                        <span class="text">
                            Users
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li @if((Route::currentRouteName() == "supervisor-list" || Request::segment(2)=="supervisor")) class="active open" @endif>
                            <a href="{{route('supervisor-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Supervisor
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>


                        <li @if((Route::currentRouteName() == "field-auditor-list" || Request::segment(2)=="field-auditor")) class="active open" @endif>
                            <a href="{{route('field-auditor-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Field auditor
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="openable @if(Request::segment(2)=="brand-variant" || Request::segment(2)=="competition-brand-variant") active open @endif">
                    <a href="#">
                        <span class="menu-icon">
                            <i class="fa fa-file-text fa-lg"></i>
                        </span>
                        <span class="text">
                            Brands
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li @if((Request::segment(2)=="brand-variant")) class="active open" @endif>
                            <a href="{{route('brand-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    ITC
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li @if((Request::segment(2)=="competition-brand-variant")) class="active open" @endif>
                            <a href="{{route('competition-brand-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Competition
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <!-- <li @if((Route::currentRouteName() == "variant-list" || Request::segment(2)=="variant")) class="active open" @endif>
                            <a href="{{route('variant-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Variant
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li class="openable @if(Request::segment(2)=="zone" || Request::segment(2)=="branch" || Request::segment(2)=="city" || Request::segment(2)=="distributor" || Request::segment(2)=="outlet") active open @endif">
                    <a href="#">
                        <span class="menu-icon">
                            <i class="fa fa-file-text fa-lg"></i>
                        </span>
                        <span class="text">
                            Market Level
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">

                        <li @if((Route::currentRouteName() == "zone-list" || Request::segment(2)=="zone")) class="active open" @endif>
                            <a href="{{route('zone-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Zone
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>

                        <li @if((Route::currentRouteName() == "branch-list" || Request::segment(2)=="branch")) class="active open" @endif>
                            <a href="{{route('branch-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Branch
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>

                        <li @if((Route::currentRouteName() == "city-list" || Request::segment(2)=="city")) class="active open" @endif>
                            <a href="{{route('city-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    City
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>

                        <li @if((Route::currentRouteName() == "distributor-list" || Request::segment(2)=="distributor")) class="active open" @endif>
                            <a href="{{route('distributor-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Distributor
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>

                        <li @if((Route::currentRouteName() == "outlet-list" || Request::segment(2)=="outlet")) class="active open" @endif>
                            <a href="{{route('outlet-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Outlet
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="openable @if(Request::segment(1)=="market") active open @endif">
                    <a href="#">
                        <span class="menu-icon">
                            <i class="fa fa-file-text fa-lg"></i>
                        </span>
                        <span class="text">
                            Brand Settings
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">

                        <li @if( Request::segment(2)=="focus-brand") class="active open" @endif>
                            <a href="{{route('monthly_fb_variant_list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Focused Brand
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li @if( Request::segment(2)=="facing-brand") class="active open" @endif>
                            <a href="{{route('ffb-variant-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Facing Brand
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>


                        
                    </ul>
                </li>--}}

            </ul>
        </div><!-- /main-menu -->
    </div><!-- /sidebar-inner -->
</aside>
