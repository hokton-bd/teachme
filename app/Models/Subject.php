<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function teacher() {

        return $this->belognsTo('App\Models\Teacher');

    }

    public function teacher_subject_teachable() {

        return $this->hasMany('App\Models\Teacher_subject_teachable');

    }


}
