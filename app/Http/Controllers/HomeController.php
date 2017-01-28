<?php

namespace App\Http\Controllers;

use Session;
use App\Question;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $categoriesToCards = Category::whereHas('questions', function ($query) {
            $query->where('status', '1');
        })->get();
        return view('home', compact('categories', 'categoriesToCards'));
    }

    /**
     * Return back to the previous page.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cancel()
    {
        return ($url = Session::get('backUrl'))
            ? redirect($url)
            : redirect('/dashboard');
    }

    /**
     * Receive a client's request and create a new pending question in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitQuestion(Request $request)
    {

        $this->validate($request, [
            'category' => 'required|numeric',
            'author' => 'required|max:100',
            'email' => 'required|email|max:255',
            'question' => 'required|max:300',
        ]);

        Question::create([
            'category_id' => $request->category,
            'author' => $request->author,
            'authors_email' => $request->email,
            'question' => $request->question
        ]);

        return redirect('home')->with('status', 'success')->with('alert', 'Your question has been successfully submitted!')->with('icon', '');
    }
}
