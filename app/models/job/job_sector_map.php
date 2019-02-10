<?php

namespace App\models\job;

use Illuminate\Database\Eloquent\Model;

class Job_sector_map extends Model
{
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];

    public function hasone_master_sector(){
        return $this->hasOne('App\models\master\master_sector','id','sector_id');
    }
}
