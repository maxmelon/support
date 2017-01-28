<?php

namespace App\Http\Controllers;

use Session;
use URL;
use App\Category;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display homepage.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        Session::flash('backUrl', URL::current());
        $pendingQuestions = Question::where('status', '0')->orderBy('created_at', 'desc')->with('category')->get();
        return view('dashboard.home', compact('pendingQuestions'));
    }
}
