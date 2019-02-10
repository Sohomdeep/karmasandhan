<?php

namespace App\models\job;

use Illuminate\Database\Eloquent\Model;

class Job_view extends Model
{
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];

    
}
