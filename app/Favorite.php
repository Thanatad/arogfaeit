<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['id', 'user_id', 'event_id'];
    protected $table = 'favorites';
}
