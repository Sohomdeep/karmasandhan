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
                <li @if((Route::currentRouteName() == "admin-dashboard")) class="active open" @endif>
                    <a href="{{route('admin-dashboard')}}">
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
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <span class="text">
                            Job
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                </li>

                <li class="openable @if(Request::segment(2)=="skill" || Request::segment(2)=="qualification" || Request::segment(2)=="sector" || Request::segment(2)=="location") active open @endif">
                    <a href="javascript:void(0)">
                        <span class="menu-icon">
                            <i class="fa fa-gear"></i>
                        </span>
                        <span class="text">
                            Master Settings
                        </span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li @if(Request::segment(2)=="skill") class="active open" @endif>
                            <a href="{{route('skill-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Skill
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li @if(Request::segment(2)=="qualification") class="active open" @endif>
                            <a href="{{route('qualification-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Qualification
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li @if(Request::segment(2)=="sector") class="active open" @endif>
                            <a href="{{route('sector-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Sector
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li @if(Request::segment(2)=="location") class="active open" @endif>
                            <a href="{{route('location-list')}}">
                                <span class="menu-icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="text">
                                    Location
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /main-menu -->
    </div><!-- /sidebar-inner -->
</aside>
