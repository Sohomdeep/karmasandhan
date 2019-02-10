<?php

namespace App\models\job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Job_post extends Model
{
	use SoftDeletes;
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];
    protected $dates 		= ['deleted_at'];


    public function job_skill_map(){
        return $this->hasMany('App\models\job\job_skill_map','job_id','id');
    }

    public function job_qualification_map(){
        return $this->hasMany('App\models\job\job_qualification_map','job_id','id');
    }

    public function job_sector_map(){
        return $this->hasMany('App\models\job\job_sector_map','job_id','id');
    }

    public function job_location_map(){
        return $this->hasMany('App\models\job\job_location_map','job_id','id');
    }

    public function job_view(){
        return $this->hasOne('App\models\job\job_view','job_id','id');
    }
}
