<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use App\models\master\master_sector;
use App\Library\custom_function;

use Session;
use Auth;
use Illuminate\Support\Facades\Config;

class Sector extends BaseController {

    protected $_customFun;
    protected $img_resize;

    function __construct() {
        $this->_customFun = new Custom_function;
    }


    /*Function name : add_sector
    Date : 15-01-2019
    Description : Add new sector to sector master*/
    function add_sector() {
       return view('admin.master.sector.add');
    }

    /* Function name : sector_list
    Date : 15-01-2019
    Description : Fetching all sector */
    public function sector_list(Request $request) {
        $data =[];
        $search = trim($request->input('search'));
        $page = (int)$request->input('page');
        $searchResults = master_sector::
        where(function($subQuery) use ($search) {
            if($search != ''){
               $subQuery->where('sector_name','LIKE','%'.$search.'%');
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
        return view('admin.master.sector.list', $data);
    }

    /* Function name : validate_sector
    Date : 15-01-2019
    Description : check sector already exist or not */
    function validate_sector($string='',$sector_id='')
    {
        if($string != ''){  
            $select = master_sector::where('sector_name',$string);
            if($sector_id!='' && $sector_id>0){
              $select->where('id', '!=' ,$sector_id);
            }
            $res = $select->first();
            if(!empty($res) && ($res->count())>0){
                return 'sector already exists';
            }
            else{
                return 'yes';
            }
        }else{
            return 'Please enter sector name';
        }
        return 'yes';
    }

    /* Function name : do_add_sector
    Date : 15-01-2019
    Description : Adding sector details */
    function do_add_sector(Request $request)
    {
        if ($request->has(['sector_name'],['active_inactive']))
        {
            $sector_name     = trim($request->sector_name);
            $status         = $request->active_inactive;
            $validate       = $this->validate_sector($sector_name);
            if($validate == 'yes'){
                $variantData = array(
                    'sector_name'    => $sector_name,
                    'is_active'     => $status,
                );
                $insert = master_sector::insertGetId($variantData);
                Session::put('success_message', 'Sector added successfully');
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
            Session::put('error_message', 'Failed to save sector');
        }
        return redirect()->route('sector-list');
    }

    /*Function name : edit_sector
    Date : 15-01-2019
    Description : Editing brand details view */
    function edit_sector($sector_id='')
    {
        $sector_id = (int)$sector_id;
        $data = [];
        $editVariantDetails = master_sector::where('id',$sector_id)->first();

        if(!empty($editVariantDetails) && ($editVariantDetails->count())>0){
            $data['sector_details'] = $editVariantDetails;
            return view('admin.master.sector.edit', $data);
        }
        else{
            Session::put('error_message', 'Sector not found');
            return redirect()->route('sector-list');
        }
    }

    /* Function name : do_edit_sector
    Date : 15-01-2019
    Description : Editing sector details */
    function do_edit_sector(Request $request)
    {
        if ($request->has(['sector_name'],['active_inactive']))
        {
            $sector_id = (int)$request->sector_id;
            $sector_name = trim($request->sector_name);
            $status = (int)$request->active_inactive;

            $validate = $this->validate_sector($sector_name,$sector_id);
            if($validate == 'yes'){
                $updateData = array(
                    'sector_name'=>$sector_name,
                    'is_active'=>$status,
                );

                if($sector_id > 0){
                    $updateCustomer = master_sector::where('id',$sector_id)->update($updateData);
                }
                Session::put('success_message', 'Sector updated successfully');
            }else{
                Session::put('error_message', 'Sector already exist');
                return redirect()->route('edit-sector',['sector'=>$sector_id]);
            }
        }
        return redirect()->route('sector-list');
    }

    /* Function name : delete_sector
      Date : 15-01-2019
      Description : Deleting sector  */
    function delete_sector($sector_id = '')
    {
        $sector_id = (int)$sector_id;
        master_sector::where('id',$sector_id)->delete();
        Session::put('success_message', 'Sector deleted successfully');
        return redirect()->route('sector-list');
    }

     /* Function name : update_status
      Date : 15-01-2019
      Description : Updating status of sector*/
    /*function update_status(Request $request)
    {
        $sector_id = $request->sector_id;
        $status = $request->status;
        $statusArray=array(
            'is_active' => $status,
            'updated_by'=> Auth::User()->id
        );
        if($sector_id>0){
            $update = sector_master::where('sector_id',$sector_id)->update($statusArray);
            echo "1";
        }
    }*/
}
