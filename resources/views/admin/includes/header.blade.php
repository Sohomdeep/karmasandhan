<script>
    function getChangePasswordModal()
    {
        $('#changePaswordModal').modal('show');
    }
    $( document ).ready(function() {

        $('#change-form_btn').on('click',function(){
            $('#existing_password_err').html('');
	    if (($('#existing_password').commonCheck('Please enter current password')) & ($('#new_password').passwordCheck({minLen:6,errorMessage1:'Please enter password'})) & ($('#confirm_new_password').CkConfirmPassword({passwordField:'#new_password',errorMessage1:'Please enter confirm password'})))
            {
                var existingPassword = $('#existing_password').val();
                var newPassword= $('#new_password').val();
                var newConfirmPassword= $('#confirm_new_password').val();
                $.ajax({
                    type: "GET",
                   /// url: '{{--url("/change-admin-password")--}}',
                    data:{'existingPassword':existingPassword,'newPassword':newPassword,'newConfirmPassword':newConfirmPassword},
                    success: function(passwrdata)
                    {
                        console.log(passwrdata);
                        if (passwrdata ==1) {
                            $('#changePaswordModal').modal('hide');
                            $('#passChangeSuccess').modal('show');
                            $('#existing_password').val('');
                            $('#new_password').val('');
                            $('#confirm_new_password').val('');
                        }else{
                            $('#existing_password_err').html('Please enter correct existing password');
                            return false;
                        }
                    }
                });
            }
        });
    });
</script>
   
        <!--<div id="overlay" class="transparent"></div>-->
        <div id="wrapper" class="preload">
            <div id="top-nav" class="fixed skin-6">
                <a href="{{url('/')}}" style="background: #F3F3F3;" class="brand">
                    <span>
                        <img style="max-width: 54%;margin-top: -5px;" src="{{ asset('admin-assets/img/itc_business_logo_head.jpg') }}">
                    </span>
                    <!--<span class="text-toggle">Quest</span>-->
                </a>
                <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
                <ul class="nav-notification clearfix">
                    <li class="profile dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <strong>{{Auth::user()->name}}</strong>
                            <span><i class="fa fa-chevron-down"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!--<li><a tabindex="-1" class="main-link" href="javascript:void();" onclick="getChangePasswordModal();"><i class="fa fa-lock fa-lg"></i> Change password</a></li>-->
                            <li><a tabindex="-1" class="main-link" href="{{url('/logout')}}"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="modal fade in" id="changePaswordModal" aria-hidden="false" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4>Change password</h4>
                            <span id="passwordChangeSuccessful" style="display:none">Password changed successfully</span>
                        </div>
                        <div class="modal-body">
                            <form id="change-form" action="{{url('/change-admin-password')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Existing password <span class="requireStar">*</span></label>
                                    <input type="password" class="form-control input-sm reset_need" name='existing_password' id='existing_password' placeholder="" label="Existing password" maxlength="150">
                                    <span id="existing_password_err" style="color:red;"></span>
                                </div>
                                <div class="form-group">
                                    <label>New Password <span class="requireStar">*</span></label>
                                    <input type="password" class="form-control input-sm reset_need" name="new_password" id="new_password" placeholder="" label="New password" maxlength="150">
                                    <span id="new_password_err" style="color:red;"></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password <span class="requireStar">*</span></label>
                                    <input type="password" class="form-control input-sm reset_need" name="confirm_new_password" id="confirm_new_password" placeholder="" label="Confirm password" maxlength="150">
                                    <span id="confirm_new_password_err" style="color:red;"></span>
                                </div>
                                <span id="newConfrim_err" style="color:red;"></span>
                                <div class="form-group text-right">
                                    <button type="button" id="change-form_btn" class="btn btn-success" >Submit</button>
                                    <a href="javascript:void();" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
	    </div>

    <div class="modal fade success-popup" id="passChangeSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title" id="myModalLabel" style="color: green;">Successful !</h4>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('admin_assets/img/if_sign-check.png')}}" style="width: 50px;">
                <p class="lead">Your password changed successfully.</p>
                <a href="javascript:void()" class="rd_more btn btn-default" data-dismiss="modal" aria-label="Close">Close</a>
            </div>

          </div>
        </div>
    </div>
@include('admin.includes.left_panel')
