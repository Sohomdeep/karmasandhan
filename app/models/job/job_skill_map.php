<?php

namespace App\models\job;

use Illuminate\Database\Eloquent\Model;

class Job_skill_map extends Model
{
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];

    //admin job view
    public function hasone_master_skill(){
        return $this->hasOne('App\models\master\master_skill','id','skill_id');
    }
}
