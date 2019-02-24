<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['id', 'name', 'short_des', 'description', 'budget', 'count_day', 'day', 'start', 'end', 'mobile', 'email', 'highlight', 'hashtag', 'picture', 'assign'];
    protected $table = 'events';
}
