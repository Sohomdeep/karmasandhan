<?php

namespace App\models\job;

use Illuminate\Database\Eloquent\Model;

class Job_qualification_map extends Model
{
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];

    public function hasone_master_qualification(){
        return $this->hasOne('App\models\master\master_qualification','id','qualification_id');
    }
}
