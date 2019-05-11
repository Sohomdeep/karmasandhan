<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\job\job_post;
use App\models\job\job_view;
use App\Library\custom_function;
use Illuminate\Support\Facades\Config;
class UserDashboard extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        //recent 10 feature job
        $feature_jobs = job_post::where('is_featured',1)->where('is_active',1)->take('10')->orderBy('id','DESC')->get();
        $data['feature_jobs'] = $feature_jobs;
        $all_jobs = job_post::where('is_active',1)->take('10')->orderBy('id','DESC')->get();
        $data['all_jobs'] = $all_jobs;
        //echo "<pre>";print_r($feature_jobs->toArray());exit;
        return view('job-dashboard',$data);
    }

    public function job_details(Request $Request)
    {
        $job_id = $Request->job_id;

        /****View count & increase***********/
        $ext_vw = job_view::where('job_id',$job_id)->first();
        $vw_inc = [];
        $vw_inc['views'] = $ext_vw->views+1;
        job_view::where('job_id',$job_id)->update($vw_inc);

        $data = [];
        $job = job_post::where('id',$job_id)
        ->with('job_view')
        ->with('job_skill_map.hasone_master_skill')
        ->with('job_sector_map.hasone_master_sector')
        ->with('job_location_map.hasone_master_location') 
        ->with('job_qualification_map.hasone_master_qualification') 
              
        ->first();
        $data['job_details'] = $job;
        //echo "<pre>";print_r($job->toArray());exit;
        return view('job-details',$data);
    }
}
