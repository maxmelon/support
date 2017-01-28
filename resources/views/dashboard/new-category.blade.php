@extends('layouts.dashboard')

@section('title')
  Dashboard: New Category
@stop

@section('content')

  <div>
    <div class="dashboard-container w-container">
      <div class="dashboards-subsection-top">
        <h2 class="dashboard-header">New Category</h2>
      </div>
      <div class="new-question-form-wrapper">
        <div class="w-form">
          <form method="post" action="{{ route('create-category') }}">
            {{ csrf_field() }}
            <input class="dashboard-form-field w-input" id="name" name="name" maxlength="256" type="text" placeholder="Category" value="{{ old('name') }}">
            <button class="dashboard-button flex-center w-button" type="submit">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@stop
