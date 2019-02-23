<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use App\models\master\master_qualification;
use App\Library\custom_function;

use Session;
use Auth;
use Illuminate\Support\Facades\Config;

class Qualification extends BaseController {

    protected $_customFun;
    protected $img_resize;

    function __construct() {
        $this->_customFun = new Custom_function;
    }


    /*Function name : add_qualification
    Date : 15-01-2019
    Description : Add new qualification to qualification master*/
    function add_qualification() {
       return view('admin.master.qualification.add');
    }

    /* Function name : qualification_list
    Date : 15-01-2019
    Description : Fetching all qualification */
    public function qualification_list(Request $request) {
        $data =[];
        $search = trim($request->input('search'));
        $page = (int)$request->input('page');
        $searchResults = master_qualification::
        where(function($subQuery) use ($search) {
            if($search != ''){
               $subQuery->where('qualification_name','LIKE','%'.$search.'%');
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
        return view('admin.master.qualification.list', $data);
    }

    /* Function name : validate_qualification
    Date : 15-01-2019
    Description : check qualification already exist or not */
    function validate_qualification($string='',$qualification_id='')
    {
        if($string != ''){  
            $select = master_qualification::where('qualification_name',$string);
            if($qualification_id!='' && $qualification_id>0){
              $select->where('id', '!=' ,$qualification_id);
            }
            $res = $select->first();
            if(!empty($res) && ($res->count())>0){
                return 'qualification already exists';
            }
            else{
                return 'yes';
            }
        }else{
            return 'Please enter qualification name';
        }
        return 'yes';
    }

    /* Function name : do_add_qualification
    Date : 15-01-2019
    Description : Adding qualification details */
    function do_add_qualification(Request $request)
    {
        if ($request->has(['qualification_name'],['active_inactive']))
        {
            $qualification_name     = trim($request->qualification_name);
            $status         = $request->active_inactive;
            $validate       = $this->validate_qualification($qualification_name);
            if($validate == 'yes'){
                $variantData = array(
                    'qualification_name'    => $qualification_name,
                    'is_active'     => $status,
                );
                $insert = master_qualification::insertGetId($variantData);
                Session::put('success_message', 'Qualification added successfully');
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
            Session::put('error_message', 'Failed to save qualification');
        }
        return redirect()->route('qualification-list');
    }

    /*Function name : edit_qualification
    Date : 15-01-2019
    Description : Editing brand details view */
    function edit_qualification($qualification_id='')
    {
        $qualification_id = (int)$qualification_id;
        $data = [];
        $editVariantDetails = master_qualification::where('id',$qualification_id)->first();

        if(!empty($editVariantDetails) && ($editVariantDetails->count())>0){
            $data['qualification_details'] = $editVariantDetails;
            return view('admin.master.qualification.edit', $data);
        }
        else{
            Session::put('error_message', 'Qualification not found');
            return redirect()->route('qualification-list');
        }
    }

    /* Function name : do_edit_qualification
    Date : 15-01-2019
    Description : Editing qualification details */
    function do_edit_qualification(Request $request)
    {
        if ($request->has(['qualification_name'],['active_inactive']))
        {
            $qualification_id = (int)$request->qualification_id;
            $qualification_name = trim($request->qualification_name);
            $status = (int)$request->active_inactive;

            $validate = $this->validate_qualification($qualification_name,$qualification_id);
            if($validate == 'yes'){
                $updateData = array(
                    'qualification_name'=>$qualification_name,
                    'is_active'=>$status,
                );

                if($qualification_id > 0){
                    $updateCustomer = master_qualification::where('id',$qualification_id)->update($updateData);
                }
                Session::put('success_message', 'Qualification updated successfully');
            }else{
                Session::put('error_message', 'Qualification already exist');
                return redirect()->route('edit-qualification',['qualification'=>$qualification_id]);
            }
        }
        return redirect()->route('qualification-list');
    }

    /* Function name : delete_qualification
      Date : 15-01-2019
      Description : Deleting qualification  */
    function delete_qualification($qualification_id = '')
    {
        $qualification_id = (int)$qualification_id;
        master_qualification::where('id',$qualification_id)->delete();
        Session::put('success_message', 'Qualification deleted successfully');
        return redirect()->route('qualification-list');
    }

     /* Function name : update_status
      Date : 15-01-2019
      Description : Updating status of qualification*/
    function update_status(Request $request)
    {
        $qualification_id = $request->qualification_id;
        $status = $request->status;
        $statusArray=array(
            'is_active' => $status,
            //'updated_by'=> Auth::User()->id
        );
        if($qualification_id>0){
            $update = master_qualification::where('id',$qualification_id)->update($statusArray);
            echo "1";
        }
    }
}
