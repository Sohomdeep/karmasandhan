<?php

namespace App\models\job;

use Illuminate\Database\Eloquent\Model;

class Job_location_map extends Model
{
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];

    public function hasone_master_location(){
        return $this->hasOne('App\models\master\master_location','id','location_id');
    }
}
