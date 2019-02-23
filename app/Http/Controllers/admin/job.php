<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\models\master\master_skill;
use App\models\master\master_sector;
use App\models\master\master_qualification;
use App\models\master\master_location;

// use App\models\master\master_country;
// use App\models\master\master_city;
// use App\models\master\master_state;

use App\models\job\job_post;
use App\models\job\job_qualification_map;
use App\models\job\job_view;
use App\models\job\job_skill_map;
use App\models\job\job_location_map;
use App\models\job\job_sector_map;

use Session;
use Auth;
use App\Library\custom_function;
use Illuminate\Support\Facades\Config;
use helper;
class Job extends BaseController
{

	protected $_customFun;

    function __construct() {
        $this->_customFun = new Custom_function;
        
    }

    function job_list(Request $request){
    	$data = [];
        $search = trim($request->input('search'));
        $page = (int)$request->input('page');


        $searchResults = job_post::
        where(function($subQuery) use ($search) {
            if($search != ''){
               //$subQuery->where('city_name','LIKE','%'.$search.'%');
            }
        })
        ->whereHas('job_skill_map.hasone_master_skill')
        ->with('job_skill_map.hasone_master_skill')

        ->whereHas('job_location_map.hasone_master_location')
        ->with('job_location_map.hasone_master_location')

        ->whereHas('job_sector_map.hasone_master_sector')
        ->with('job_sector_map.hasone_master_sector')

        ->whereHas('job_qualification_map.hasone_master_qualification')
        ->with('job_qualification_map.hasone_master_qualification');
        
        //->get();echo "<pre>";print_r($searchResults->toArray());exit;

        $PerPage = Config::get('settings.admin_per_page');
        $currentPage = $page ? $page : 1;
        if ((!is_numeric($currentPage)) || ($currentPage < 1)) {
            $currentPage = 1;
        }
        $startpoint = (floor($currentPage) * $PerPage) - $PerPage;
        $totlaResult = $searchResults->count();
        $searchResultsList = $searchResults->take($PerPage)->offset($startpoint)->orderBy('id', 'DESC')->get();
        //echo "<pre>";print_r($searchResultsList->toArray());exit;
        $data['lists'] = $searchResultsList;
        $data['pagination'] = $this->_customFun->myPaginationAjax($totlaResult, $PerPage, $currentPage, '');
        return view('admin.job.list', $data);
    }

    function job_add(){
    	$data 						= [];
    	$data['skills'] 			= master_skill::where('is_active',1)->get();
    	$data['sectors'] 			= master_sector::where('is_active',1)->get();
    	$data['qualifications'] 	= master_qualification::where('is_active',1)->get();
    	$data['locations'] 			= master_location::where('is_active',1)->get();
    	//$data['countries'] 		= master_country::where('is_active',1)->get();
    	//$data['cities'] 			= master_city::where('is_active',1)->get();
    	//$data['states'] 			= master_state::where('is_active',1)->get();
        return view('admin.job.add', $data);
    }

    function do_job_add(Request $request){
    	//echo "<pre>"; print_r($request->all());exit;
    	if($request){
    		$post_data = $request->all();
    		$job_add = [];
    		$job_add['job_title'] 		= $post_data['job_title'];
    		$job_add['short_desc'] 		= $post_data['short_desc'];
    		$job_add['company_name'] 	= $post_data['company_name'];
    		$job_add['up_body'] 		= $post_data['up_body'];
    		$job_add['down_body'] 		= $post_data['down_body'];
    		$job_add['experiance'] 		= $post_data['experiance'];
    		$job_add['expired_on'] 		= $post_data['expired_on'];
    		$job_add['is_featured'] 	= $post_data['is_featured'];
    		$job_add['is_active'] 		= $post_data['is_active'];
    		$job_add['job_title'] 		= $post_data['job_title'];
            $job_add['created_by']       = Auth::User()->id;
            $job_id = job_post::insertGetId($job_add);

            if($job_id!='' && $job_id>0){
                
                $job_view           = [];
                $job_view['job_id'] = $job_id;
                job_view::insert($job_view);

                if(!empty($post_data['skill']) && is_array($post_data['skill'])){
                    foreach ($post_data['skill'] as $k1 => $skill_id) {
                        $skill_arr = [];
                        $skill_arr['job_id']    = $job_id;
                        $skill_arr['skill_id']  = $skill_id;
                        job_skill_map::insert($skill_arr);
                    }
                }

                if(!empty($post_data['sector']) && is_array($post_data['sector'])){
                    foreach ($post_data['sector'] as $k1 => $sector_id) {
                        $sector_arr = [];
                        $sector_arr['job_id']    = $job_id;
                        $sector_arr['sector_id']  = $sector_id;
                        job_sector_map::insert($sector_arr);
                    }
                }

                if(!empty($post_data['qualification']) && is_array($post_data['qualification'])){
                    foreach ($post_data['qualification'] as $k1 => $qualification_id) {
                        $qualification_arr = [];
                        $qualification_arr['job_id']    = $job_id;
                        $qualification_arr['qualification_id']  = $qualification_id;
                        job_qualification_map::insert($qualification_arr);
                    }
                }

                if(!empty($post_data['location']) && is_array($post_data['location'])){
                    foreach ($post_data['location'] as $k1 => $location_id) {
                        $location_arr = [];
                        $location_arr['job_id']    = $job_id;
                        $location_arr['location_id']  = $location_id;
                        job_location_map::insert($location_arr);
                    }
                }

                if(!empty($post_data['extra']) && ($post_data['extra'])>0){
                    $view_arr = [];
                    $view_arr['job_id'] =  $job_id;
                    $view_arr['extra'] =  $post_data['extra']; 
                    job_view::insert($view_arr);
                }
            }
            Session::put('success_message', 'Job successfully created, Job id : '.$job_id);	
        }
        return redirect()->route('job-list');
    }

    function job_edit($job_id='',Request $request){
        if($job_id!='' && $job_id>0){
            $data = [];
            $data['skills']             = master_skill::where('is_active',1)->get();
            $data['sectors']            = master_sector::where('is_active',1)->get();
            $data['qualifications']     = master_qualification::where('is_active',1)->get();
            $data['locations']          = master_location::where('is_active',1)->get();
            $edit_data = job_post::
            where(function($subQuery) use ($job_id) {
                if($job_id != ''){
                   $subQuery->where('id',$job_id);
                }
            })
            ->whereHas('job_skill_map.hasone_master_skill')
            ->with('job_skill_map.hasone_master_skill')

            ->whereHas('job_location_map.hasone_master_location')
            ->with('job_location_map.hasone_master_location')

            ->whereHas('job_sector_map.hasone_master_sector')
            ->with('job_sector_map.hasone_master_sector')

            ->whereHas('job_qualification_map.hasone_master_qualification')
            ->with('job_qualification_map.hasone_master_qualification')
            
            ->with('job_view')
            ->get();

            $data['edit_data'] = $edit_data;
            //echo "<pre>"; print_r($edit_data->toArray());exit;
            return view('admin.job.edit', $data);            
        }else{
            return redirect()->route('job-list');
        }
    }

    function do_job_edit(Request $request){
       //echo "<pre>";print_r($request->all());exit;
       if($request){
            $post_data = $request->all();
            $job_add = [];
            $job_id                     = (int)$post_data['job_id'];
            if($job_id!='' && $job_id>0){
                $job_add['job_title']       = $post_data['job_title'];
                $job_add['short_desc']      = $post_data['short_desc'];
                $job_add['company_name']    = $post_data['company_name'];
                $job_add['up_body']         = $post_data['up_body'];
                $job_add['down_body']       = $post_data['down_body'];
                $job_add['experiance']      = $post_data['experiance'];
                $job_add['expired_on']      = $post_data['expired_on'];
                $job_add['is_featured']     = $post_data['is_featured'];
                $job_add['is_active']       = $post_data['is_active'];
                $job_add['job_title']       = $post_data['job_title'];
                $job_add['updated_by']       = Auth::User()->id;
                $job_add['updated_at']       = date('Y-m-d H:i:s');
                $job_id = job_post::where('id',$job_id)->update($job_add);

            
                //$job_view           = [];
                //$job_view['job_id'] = $job_id;
                //job_view::insert($job_view);

                if(!empty($post_data['skill']) && is_array($post_data['skill'])){
                    job_skill_map::where('job_id',$job_id)->delete();
                    foreach ($post_data['skill'] as $k1 => $skill_id) {
                        $skill_arr = [];
                        $skill_arr['job_id']    = $job_id;
                        $skill_arr['skill_id']  = $skill_id;
                        job_skill_map::insert($skill_arr);
                    }
                }

                if(!empty($post_data['sector']) && is_array($post_data['sector'])){
                    job_sector_map::where('job_id',$job_id)->delete();
                    foreach ($post_data['sector'] as $k1 => $sector_id) {
                        $sector_arr = [];
                        $sector_arr['job_id']    = $job_id;
                        $sector_arr['sector_id']  = $sector_id;
                        job_sector_map::insert($sector_arr);
                    }
                }

                if(!empty($post_data['qualification']) && is_array($post_data['qualification'])){
                    job_qualification_map::where('job_id',$job_id)->delete();
                    foreach ($post_data['qualification'] as $k1 => $qualification_id) {
                        $qualification_arr = [];
                        $qualification_arr['job_id']    = $job_id;
                        $qualification_arr['qualification_id']  = $qualification_id;
                        job_qualification_map::insert($qualification_arr);
                    }
                }

                if(!empty($post_data['location']) && is_array($post_data['location'])){
                    job_location_map::where('job_id',$job_id)->delete();
                    foreach ($post_data['location'] as $k1 => $location_id) {
                        $location_arr = [];
                        $location_arr['job_id']    = $job_id;
                        $location_arr['location_id']  = $location_id;
                        job_location_map::insert($location_arr);
                    }
                }

                if(!empty($post_data['extra']) && ($post_data['extra'])>0){
                    $view_arr = [];
                    $view_arr['extra'] =  $post_data['extra']; 
                    job_view::where('job_id',$job_id)->update($view_arr);
                }
            }
            Session::put('success_message', 'Job successfully Updated, Job id : '.$job_id); 
        }
        return redirect()->route('job-list');
    }
    
}
