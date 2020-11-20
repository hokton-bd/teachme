<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    
    public function show() {

        $subjects = Subject::all();

        return view('signup', compact('subjects'));

    }


}
