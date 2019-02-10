<?php

namespace App\models\master;

use Illuminate\Database\Eloquent\Model;

class Master_location extends Model
{
    protected $primaryKey 	= 'id';
    public $timestamps 		= false;
    protected $guarded 		= ['id'];
}
