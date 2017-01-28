@extends('layouts.dashboard')

@section('title')
    Dashboard: Edit Account
@stop

@section('content')
    <div class="dashboard-container w-container">
        <div class="dashboards-subsection-top">
            <h2 class="dashboard-header">Edit Account</h2>
        </div>
        <div class="new-question-form-wrapper">
            <div class="w-form">
                <form method="POST" action="{{ route('update-account', ['user' => $user->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input class="dashboard-form-field w-input" id="name" name="name" maxlength="256" required="required" type="text" value="{{ $user->name }}">
                    <input class="dashboard-form-field w-input" id="email" name="email" maxlength="256" required="required" type="text" value="{{ $user->email }}">
                    <input class="dashboard-form-field w-input" id="password" name="password" maxlength="256" type="password" placeholder="Type in a new password to change the old one">
                    <input class="dashboard-form-field w-input" id="password_confirmation" name="password_confirmation" maxlength="256" type="password" placeholder="Confirm password">
                    <div class="dashboard-button-section">
                        <a class="dashboard-button w-button" href="{{ route('cancel') }}">Cancel</a>
                        <button class="dashboard-button flex-center w-button" type="submit">Save</button>
                        <a class="dashboard-button delete-button w-button" href="{{ route('delete-account-form', ['user' => $user->id]) }}">Delete</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop