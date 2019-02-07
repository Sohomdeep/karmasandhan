<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\models\master\master_skill;
use App\models\master\master_sector;
use App\models\master\master_qualification;
use App\models\master\master_country;
use App\models\master\master_city;
use App\models\master\master_state;
use Session;
use Auth;
use App\Library\custom_function;
class Job extends BaseController
{

	protected $_customFun;

    function __construct() {
        $this->_customFun = new Custom_function;
        
    }

    function job_list(){
    	$data = [];
    	$data['lists'] = [];
    	return view('admin.job.list', $data);
    }

    function job_add(){
    	$data 						= [];
    	$data['skills'] 			= master_skill::where('is_active',1)->get();
    	$data['sectors'] 			= master_sector::where('is_active',1)->get();
    	$data['qualifications'] 	= master_qualification::where('is_active',1)->get();
    	//$data['countries'] 			= master_country::where('is_active',1)->get();
    	//$data['cities'] 			= master_city::where('is_active',1)->get();
    	//$data['states'] 			= master_state::where('is_active',1)->get();

    	
        return view('admin.job.add', $data);
    }

}
