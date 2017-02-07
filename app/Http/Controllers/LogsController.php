<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Question;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    public function show()
    {
        $users = User::all();
        $categories = Category::all();
        $questions = Question::all();
        $activities = Activity::orderBy('created_at', 'desc')->get();
        return view('dashboard.logs', compact('users', 'categories', 'questions', 'activities'));
    }

}
