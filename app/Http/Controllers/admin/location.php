<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use App\models\master\master_location;
use App\Library\custom_function;
use Session;
use Auth;
use Illuminate\Support\Facades\Config;

class Location extends BaseController {

    protected $_customFun;
    protected $img_resize;

    function __construct() {
        $this->_customFun = new Custom_function;
    }


    /*Function name : add_location
    Date : 15-01-2019
    Description : Add new location to location master*/
    function add_location() {
       return view('admin.master.location.add');
    }

    /* Function name : location_list
    Date : 15-01-2019
    Description : Fetching all location */
    public function location_list(Request $request) {
        $data =[];
        $search = trim($request->input('search'));
        $page = (int)$request->input('page');
        $searchResults = master_location::
        where(function($subQuery) use ($search) {
            if($search != ''){
               $subQuery->where('location_name','LIKE','%'.$search.'%');
            }
        });
        $PerPage = Config::get('settings.admin_per_page');
        $currentPage = $page ? $page : 1;
        if ((!is_numeric($currentPage)) || ($currentPage < 1)) {
            $currentPage = 1;
        }
        $startpoint = (floor($currentPage) * $PerPage) - $PerPage;
        $totlaResult = $searchResults->count();
        $searchResultsList = $searchResults->take($PerPage)->offset($startpoint)->orderBy('id', 'DESC')->get();
        $data['lists'] = $searchResultsList;
        $data['pagination'] = $this->_customFun->myPaginationAjax($totlaResult, $PerPage, $currentPage, '');
        return view('admin.master.location.list', $data);
    }

    /* Function name : validate_location
    Date : 15-01-2019
    Description : check location already exist or not */
    function validate_location($string='',$location_id='')
    {
        if($string != ''){  
            $select = master_location::where('location_name',$string);
            if($location_id!='' && $location_id>0){
              $select->where('id', '!=' ,$location_id);
            }
            $res = $select->first();
            if(!empty($res) && ($res->count())>0){
                return 'location already exists';
            }
            else{
                return 'yes';
            }
        }else{
            return 'Please enter location name';
        }
        return 'yes';
    }

    /* Function name : do_add_location
    Date : 15-01-2019
    Description : Adding location details */
    function do_add_location(Request $request)
    {
        if ($request->has(['location_name'],['active_inactive']))
        {
            $location_name     = trim($request->location_name);
            $status         = $request->active_inactive;
            $validate       = $this->validate_location($location_name);
            if($validate == 'yes'){
                $variantData = array(
                    'location_name'    => $location_name,
                    'is_active'     => $status,
                );
                $insert = master_location::insertGetId($variantData);
                Session::put('success_message', 'Location added successfully');
            }
            else{
                if($validate != 'yes'){
                    Session::put('error_message', $validate);
                }
                else{
                    Session::put('error_message', $validate);
                }
            }
        }
        else{
            Session::put('error_message', 'Failed to save location');
        }
        return redirect()->route('location-list');
    }

    /*Function name : edit_location
    Date : 15-01-2019
    Description : Editing brand details view */
    function edit_location($location_id='')
    {
        $location_id = (int)$location_id;
        $data = [];
        $editVariantDetails = master_location::where('id',$location_id)->first();

        if(!empty($editVariantDetails) && ($editVariantDetails->count())>0){
            $data['location_details'] = $editVariantDetails;
            return view('admin.master.location.edit', $data);
        }
        else{
            Session::put('error_message', 'Location not found');
            return redirect()->route('location-list');
        }
    }

    /* Function name : do_edit_location
    Date : 15-01-2019
    Description : Editing location details */
    function do_edit_location(Request $request)
    {
        if ($request->has(['location_name'],['active_inactive']))
        {
            $location_id = (int)$request->location_id;
            $location_name = trim($request->location_name);
            $status = (int)$request->active_inactive;

            $validate = $this->validate_location($location_name,$location_id);
            if($validate == 'yes'){
                $updateData = array(
                    'location_name'=>$location_name,
                    'is_active'=>$status,
                );

                if($location_id > 0){
                    $updateCustomer = master_location::where('id',$location_id)->update($updateData);
                }
                Session::put('success_message', 'Location updated successfully');
            }else{
                Session::put('error_message', 'Location already exist');
                return redirect()->route('edit-location',['location'=>$location_id]);
            }
        }
        return redirect()->route('location-list');
    }

    /* Function name : delete_location
      Date : 15-01-2019
      Description : Deleting location  */
    function delete_location($location_id = '')
    {
        $location_id = (int)$location_id;
        master_location::where('id',$location_id)->delete();
        Session::put('success_message', 'Location deleted successfully');
        return redirect()->route('location-list');
    }

     /* Function name : update_status
      Date : 15-01-2019
      Description : Updating status of location*/
    /*function update_status(Request $request)
    {
        $location_id = $request->location_id;
        $status = $request->status;
        $statusArray=array(
            'is_active' => $status,
            'updated_by'=> Auth::User()->id
        );
        if($location_id>0){
            $update = location_master::where('location_id',$location_id)->update($statusArray);
            echo "1";
        }
    }*/
}
