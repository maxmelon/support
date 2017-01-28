@extends('layouts.dashboard')

@section('title')
    Dashboard: New Account
@stop

@section('content')

    <div>
        <div class="dashboard-container w-container">
            <div class="dashboards-subsection-top">
                <h2 class="dashboard-header">New Account</h2>
            </div>
            <div class="new-question-form-wrapper">
                <div class="w-form">
                    <form method="post" action="{{ route('create-account') }}">
                        {{ csrf_field() }}
                        <input class="dashboard-form-field w-input" id="name" name="name" maxlength="256" required="required" type="text" placeholder="Username" value="{{ old('name') }}">
                        <input class="dashboard-form-field w-input" id="email" name="email" maxlength="256" required="required" type="text" placeholder="Email" value="{{ old('email') }}">
                        <input class="dashboard-form-field w-input" id="password" name="password" maxlength="256" type="password" placeholder="Password">
                        <input class="dashboard-form-field w-input" id="password_confirmation" name="password_confirmation" maxlength="256" type="password" placeholder="Confirm password">
                        <button class="dashboard-button flex-center w-button" type="submit">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop