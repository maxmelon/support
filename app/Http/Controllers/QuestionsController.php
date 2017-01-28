<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Category;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form in Dashboard for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        $categories = Category::get()->all();
        return view('dashboard.new-question', compact('categories'));
    }

    /**
     * Receives an admin's request to create a new question in the database
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeByAdmin(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|numeric',
            'status' => 'required|numeric',
            'question' => 'required|max:300',
            'author' => 'required|max:100',
            'authors_email' => 'nullable|email|max:255',
            'answer' => 'nullable|max:1000'
        ]);

        $question = new Question();
        $question->category_id = $request->category;
        $question->status = $request->status;
        $question->question = $request->question;
        $question->author = $request->author;

        if (!empty($request->answer)) {
            $question->answer = $request->answer;
        }

        if (!empty($request->authors_email)) {
            $question->authors_email = $request->authors_email;
        }

        $question->save();

        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The question has been added!')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The question has been added!')->with('icon', '');
    }

    /**
     * Shows the form for editing the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Question $question)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        $categories = Category::get()->all();
        return view('dashboard.edit-question', compact('question', 'categories'));
    }


    /**
     * Update the item in storage
     *
     * @param Question $question
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Question $question, Request $request)
    {
        $this->validate($request, [
            'category' => 'required|numeric',
            'status' => 'required|numeric',
            'question' => 'required|max:300',
            'author' => 'required|max:100',
            'authors_email' => 'nullable|email|max:255',
            'answer' => 'nullable|max:1000'
        ]);

        $question->update([
            'category_id' => $request->category,
            'status' => $request->status,
            'question' => $request->question,
            'author' => $request->author,
            'authors_email' => $request->authors_email,
            'answer' => $request->answer
        ]);

        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The question has been successfully updated!')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The question has been successfully updated!')->with('icon', '');
    }

    /**
     * Show the page to confirm the intention to delete.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function delete(Question $question)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.delete-question', compact('question'));
    }

    /**
     * Kills the item in a database (irreversibly)
     *
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The question has been successfully deleted')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The question has been successfully deleted')->with('icon', '');
    }
}
