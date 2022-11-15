<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{

    public function updateExerciseComplete(Request $request)
    {
        $userId = Auth::user()->id;
        dd($userId);
    }
}
