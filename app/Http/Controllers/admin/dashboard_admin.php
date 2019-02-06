<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Session;
use Auth;

class Dashboard_admin extends BaseController
{
    /*Function name : index
    Date : 05-12-2018
    Description : Dashboard load page */
    public function index(Request $request){
        //echo 'ddddd';exit;
        //$permission = Permission::create(['name' => 'add field auditor']);
        //$role = Role::find(2);
        //$permission = Permission::find(3);
        //$role->givePermissionTo($permission);
        //$permission->assignRole($role);
        //dd($role->toArray());


        //$currentUser = Auth::user();
        //dd($currentUser->toArray());

        //Auth::user()->assignRole('superadmin');
        //$permissions = Auth::user()->roles;

        //dd($permissions->toArray());
        return view('admin.dashboard.dashboard');
    }

    /*Function name : logout_admin
    Date : 05-12-2018
    Description : Logout of admin */
    public function logout_admin(Request $request){
        Auth::logout();
	    return redirect()->route('home');
    }

}
