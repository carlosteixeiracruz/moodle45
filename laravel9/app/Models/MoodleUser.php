<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleUser extends Model
{
    protected $connection = 'moodle';
    protected $table = 'mdl_user';
    public $timestamps = false;

    protected $fillable = ['id', 'email', 'password', 'username'];
}





