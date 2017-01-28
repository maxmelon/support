@extends('layouts.layout')

@section('title')
  Support: Home Page
  @stop

@section('content')
  <body class="blue-section">
  {{--Search Field--}}
  <div class="main-section">
    <div class="top-container w-container">
      <div class="search-form-wrapper w-form">
        <form class="search-form" data-name="Search Form" id="search-form" name="search-form">
          <div class="search-form-div">
            <input class="search-field w-input" id="search-field" maxlength="50" name="search-field" placeholder="What can we help you with?" required="required" type="text">
            <input class="search-button w-button" data-wait="In Process..." type="submit" value="Search">
            {{ csrf_field() }}
          </div>
        </form>
      </div>
    </div>

    <div class="w-container">

      {{--Custom Alert--}}
      @if (session('alert'))
        <div class="alert {{ session('status') }}">
            <div class="icon status">{{ session('icon') }}</div>
          <div class="alert-message">{{ session('alert') }}</div>
        </div>
      @endif

      {{--Errors--}}
      @if (count($errors))
        @foreach ($errors->all() as $error)
          <div class="alert failure">
            <div class="icon status"></div>
            <div class="alert-message">{{ $error }}</div>
          </div>
        @endforeach
      @endif

      {{--Cards--}}
      <div class="cards-main-container">
        @foreach($categoriesToCards as $category)
          <h3 class="cards-section-header text-cards-section text-default">{{ $category->name }}</h3>
          <div class="cards-inner-container">
            @foreach($category->questions as $question)
              @if($question->answer != null && $question->status == 1)
              <div class="card">
                <p class="q-and-a"><strong>{{ $question->question }}</strong>
                  <br>
                  <br>
                  {{ $question->answer }}
                </p>
              </div>
              @endif
            @endforeach
          </div>
        @endforeach
      </div>
    </div>

    {{--New Question Submission Form--}}
    <div class="form-container w-container">
      <h2 class="footer-header">Didn't find what you were looking for?<br>Let us know!</h2>
      <div class="form-new-question w-form">
        <form class="form-new-question w-clearfix" method="post" action="{{ route('submit-question') }}">
          {{ csrf_field() }}
          <input class="name-field new-question-field w-input" maxlength="50" placeholder="Enter your name" required="required" type="text" id="author" name="author">
          <input class="new-question-field w-input" maxlength="256" placeholder="Enter your email address" required="required" type="email" id="email" name="email">
          <select class="new-question-field select w-select" id="category" name="category">
            <option value="">Select category...</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
          <textarea class="new-question-text w-input" maxlength="300" name="question" id="question" placeholder="Describe your question (max. 300 characters)" required="required"> </textarea>
          <input class="new-question-button search-button w-button" type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>

  @stop