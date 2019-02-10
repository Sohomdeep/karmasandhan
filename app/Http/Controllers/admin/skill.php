<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use App\models\master\master_skill;
use App\Library\custom_function;

use Session;
use Auth;
use Illuminate\Support\Facades\Config;

class Skill extends BaseController {

    protected $_customFun;
    protected $img_resize;

    function __construct() {
        $this->_customFun = new Custom_function;
    }


    /*Function name : add_skill
    Date : 15-01-2019
    Description : Add new skill to skill master*/
    function add_skill() {
       return view('admin.master.skill.add');
    }

    /* Function name : skill_list
    Date : 15-01-2019
    Description : Fetching all skill */
    public function skill_list(Request $request) {
        $data =[];
        $search = trim($request->input('search'));
        $page = (int)$request->input('page');
        $searchResults = master_skill::
        where(function($subQuery) use ($search) {
            if($search != ''){
               $subQuery->where('skill_name','LIKE','%'.$search.'%');
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
        return view('admin.master.skill.list', $data);
    }

    /* Function name : validate_skill
    Date : 15-01-2019
    Description : check skill already exist or not */
    function validate_skill($string='',$skill_id='')
    {
        if($string != ''){  
            $select = master_skill::where('skill_name',$string);
            if($skill_id!='' && $skill_id>0){
              $select->where('id', '!=' ,$skill_id);
            }
            $res = $select->first();
            if(!empty($res) && ($res->count())>0){
                return 'skill already exists';
            }
            else{
                return 'yes';
            }
        }else{
            return 'Please enter skill name';
        }
        return 'yes';
    }

    /* Function name : do_add_skill
    Date : 15-01-2019
    Description : Adding skill details */
    function do_add_skill(Request $request)
    {
        if ($request->has(['skill_name'],['active_inactive']))
        {
            $skill_name     = trim($request->skill_name);
            $status         = $request->active_inactive;
            $validate       = $this->validate_skill($skill_name);
            if($validate == 'yes'){
                $variantData = array(
                    'skill_name'    => $skill_name,
                    'is_active'     => $status,
                );
                $insert = master_skill::insertGetId($variantData);
                Session::put('success_message', 'Skill added successfully');
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
            Session::put('error_message', 'Failed to save skill');
        }
        return redirect()->route('skill-list');
    }

    /*Function name : edit_skill
    Date : 15-01-2019
    Description : Editing brand details view */
    function edit_skill($skill_id='')
    {
        $skill_id = (int)$skill_id;
        $data = [];
        $editVariantDetails = master_skill::where('id',$skill_id)->first();

        if(!empty($editVariantDetails) && ($editVariantDetails->count())>0){
            $data['skill_details'] = $editVariantDetails;
            return view('admin.master.skill.edit', $data);
        }
        else{
            Session::put('error_message', 'Skill not found');
            return redirect()->route('skill-list');
        }
    }

    /* Function name : do_edit_skill
    Date : 15-01-2019
    Description : Editing skill details */
    function do_edit_skill(Request $request)
    {
        if ($request->has(['skill_name'],['active_inactive']))
        {
            $skill_id = (int)$request->skill_id;
            $skill_name = trim($request->skill_name);
            $status = (int)$request->active_inactive;

            $validate = $this->validate_skill($skill_name,$skill_id);
            if($validate == 'yes'){
                $updateData = array(
                    'skill_name'=>$skill_name,
                    'is_active'=>$status,
                );

                if($skill_id > 0){
                    $updateCustomer = master_skill::where('id',$skill_id)->update($updateData);
                }
                Session::put('success_message', 'Skill updated successfully');
            }else{
                Session::put('error_message', 'Skill already exist');
                return redirect()->route('edit-skill',['skill'=>$skill_id]);
            }
        }
        return redirect()->route('skill-list');
    }

    /* Function name : delete_skill
      Date : 15-01-2019
      Description : Deleting skill  */
    function delete_skill($skill_id = '')
    {
        $skill_id = (int)$skill_id;
        master_skill::where('id',$skill_id)->delete();
        Session::put('success_message', 'Skill deleted successfully');
        return redirect()->route('skill-list');
    }

     /* Function name : update_status
      Date : 15-01-2019
      Description : Updating status of skill*/
    /*function update_status(Request $request)
    {
        $skill_id = $request->skill_id;
        $status = $request->status;
        $statusArray=array(
            'is_active' => $status,
            'updated_by'=> Auth::User()->id
        );
        if($skill_id>0){
            $update = skill_master::where('skill_id',$skill_id)->update($statusArray);
            echo "1";
        }
    }*/
}
