<?php

namespace App\Http\Controllers;

use URL;
use Auth;
use Session;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * CategoriesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the categories chart where every category shows statistics on the questions it contains.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Session::flash('backUrl', URL::current());
        $categories = Category::with('questions')->get()->all();
        return view('dashboard.questions', compact('pendingQuestions', 'categories'));
    }

    /**
     * Display the resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        Session::flash('backUrl', URL::current());
        return view('dashboard.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.new-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The category has been added!')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The category has been added!')->with('icon', '');
    }

    /**
     * Shows the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.edit-category', compact('category'));
    }


    /**
     * Update the item in storage
     *
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The category has been successfully updated!')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The category has been successfully updated!')->with('icon', '');
    }

    /**
     * Show the page to confirm the intention to delete.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Category $category)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.delete-category', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     * All the associated questions are also removed (by Event).
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        Category::where('id', $category->id)->first()->delete();
        return redirect()->route('show-categories')->with('status', 'success')->with('alert', 'The category has been successfully deleted')->with('icon', '');
    }
}
