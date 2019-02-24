<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $fillable = ['id','user_id','event_id','location_id','destroy'];
    protected $table = 'user_events';
}
