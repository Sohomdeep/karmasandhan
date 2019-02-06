<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
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
    	$data = [];
        return view('admin.job.add', $data);
    }

}
