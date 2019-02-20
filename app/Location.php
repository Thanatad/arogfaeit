<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['id','place_name','place_des','district','zipcode','province','amphoe','road','more_address','lat','lon'];
    protected $table = 'rogfaeit_main.locations';
}
