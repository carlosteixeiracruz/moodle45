<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MoodleUser extends Model
{
    protected $connection = 'moodle';
    protected $table = 'ujki_user';
    public $timestamps = false;

    protected $fillable = ['id', 'email', 'password', 'username'];
}



