<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectures extends Model
{
    use HasFactory;

    public function teacher() {

        return $this->belongsTo('App\Models\Teacher');

    }

    public function student() {

        return $this->belongsTo('App\Models\Student');

    }

}
