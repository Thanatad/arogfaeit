<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['id','user_id','dob','sex','site','province','address','mobile'];
    protected $table = 'user_profiles';
}
