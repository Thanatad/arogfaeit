<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daylist extends Model
{
    protected $fillable = ['id', 'name', 'type', 'date'];
    protected $table = 'rogfaeit_main.daylists';
}
