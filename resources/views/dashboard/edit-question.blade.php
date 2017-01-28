@extends('layouts.dashboard')

@section('title')
  Dashboard: Edit Question
  @stop

@section('content')
<div class="dashboard-container w-container">
      <div class="dashboards-subsection-top">
        <h2 class="dashboard-header">Edit Question</h2>
      </div>
      <div class="new-question-form-wrapper">
        <div class="w-form">
          <form method="POST" action="{{ route('update-question', ['question' => $question->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <select class="dashboard-form-field w-select" id="category" name="category">
              @foreach($categories as $category)
              <option value="{{ $category->id }}" @if($question->category->id == $category->id) selected @endif>{{ $category->name }}</option>
              @endforeach
            </select>
            <select class="dashboard-form-field w-select" id="status" name="status">
              <option value="0" @if($question->status == 0) selected @endif>Pending</option>
              <option value="1" @if($question->status == 1) selected @endif>Published</option>
              <option value="2" @if($question->status == 2) selected @endif>Hidden</option>
            </select>
            <input class="dashboard-form-field w-input" id="author" name="author" maxlength="100"  value="{{ $question->author }}" required="required" type="text" placeholder="Author">
            <input class="dashboard-form-field w-input" id="authors_email" name="authors_email" maxlength="256" value="{{ $question->authors_email }}" required="required" type="email" placeholder="Email">
            <textarea class="dashboard-form-field w-input" id="question" name="question" maxlength="300" placeholder="Question (max. 300 characters)">{{ $question->question }}</textarea>
            <textarea class="dashboard-form-field w-input" id="answer" name="answer" maxlength="1000" placeholder="Answer (max. 1000 characters)">{{ $question->answer }}</textarea>

              <div class="dashboard-button-section">
                  <a class="dashboard-button w-button" href="{{ route('cancel') }}">Cancel</a>
                  <button class="dashboard-button flex-center w-button" type="submit">Save</button>
                  <a class="dashboard-button delete-button w-button" href="{{ route('delete-question-form', ['question' => $question->id]) }}">Delete</a>
              </div>
          </form>
        </div>
      </div>
    </div>

@stop