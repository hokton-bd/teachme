<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    public function user() {

        return $this->belongsTo('App\Models\User');

    }


    public function subject() {

        return $this->hasOne('App\Models\Subject');

    }

    public function lectures() {

        return $this->hasMany('App\Models\Lectures');

    }

}
