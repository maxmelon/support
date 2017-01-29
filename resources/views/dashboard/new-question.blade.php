@extends('layouts.dashboard')

@section('title')
  Dashboard: New Question
@stop

@section('content')

  <div>
    <div class="dashboard-container w-container">
      <div class="dashboards-subsection-top">
        <h2 class="dashboard-header">New Question</h2>
      </div>
      <div class="new-question-form-wrapper">
        <div class="w-form">
          <form method="post" action="{{ route('create-question') }}">
            {{ csrf_field() }}
            <select class="dashboard-form-field w-select" id="category" name="category">
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ ($selectedCategoryId == $category->id ? "selected" : "") }}>{{ $category->name }}</option>
              @endforeach
            </select>
            <select class="dashboard-form-field w-select" id="status" name="status">
              <option value="0" {{ (old("status") == 0 ? "selected":"") }}>Pending</option>
              <option value="1" {{ (old("status") == 1 ? "selected":"") }}>Published</option>
              <option value="2" {{ (old("status") == 2 ? "selected":"") }}>Hidden</option>
            </select>
            <input class="dashboard-form-field w-input" id="author" name="author" maxlength="100" required="required" type="text" placeholder="Author" value="{{ old('author') ? old('author') : Auth::user()->name }}">
            <input class="dashboard-form-field w-input" id="authors_email" name="authors_email" maxlength="256" type="text" placeholder="Email" value="{{ old('authors_email') }}">
            <textarea class="dashboard-form-field w-input" id="question" name="question" maxlength="300" placeholder="Question (max. 300 characters)"></textarea>
            <textarea class="dashboard-form-field w-input" id="answer" name="answer" maxlength="1000" placeholder="Answer (max. 1000 characters)"></textarea>
            <button class="dashboard-button flex-center w-button" type="submit">Create</button>
          </form>

        </div>
      </div>
    </div>
  </div>

@stop
