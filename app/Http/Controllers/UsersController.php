<?php

namespace App\Http\Controllers;

use URL;
use Session;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::flash('backUrl', URL::current());
        $users = User::get();
        return view('dashboard.accounts', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.new-account');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|alpha-dash',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The user has been successfully added')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The user has been successfully added')->with('icon', '');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.edit-account', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255|alpha-dash',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:5|confirmed'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if(!empty($request->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The account details have been successfully updated')->with('icon', '')
            : redirect('/dashboard/accounts')->with('status', 'success')->with('alert', 'The account details have been successfully updated')->with('icon', '');
    }

    /**
     * Show the page to confirm the intention to delete.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        return view('dashboard.delete-account', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->first()->delete();
        return ($url = Session::get('backUrl'))
            ? redirect($url)->with('status', 'success')->with('alert', 'The user has been successfully deleted')->with('icon', '')
            : redirect('/dashboard')->with('status', 'success')->with('alert', 'The user has been successfully deleted')->with('icon', '');
    }
}
