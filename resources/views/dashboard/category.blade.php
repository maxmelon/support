@extends('layouts.dashboard')

@section('title')
  Dashboard: Category View
@stop

@section('content')
<div class="dashboard-container w-container">
  <div class="dashboards-subsection-top">
    <h2 class="dashboard-header">{{ $category->name }}</h2>
    <div class="dashboard-subsection-buttons-block">
      <a class="dashboard-button flex-left w-button" href="{{ route('new-question-form-category', ['category' => $category->id]) }}">New Question</a>
    </div>
  </div>
</div>
<div class="dashboard-container w-container">
  <div class="dashboards-subsection-top statistics">
    <a class="pending statistics-link w-inline-block" href="#">
      <div>Pending: <strong>{{ $category->questions->where('status', '0')->count() }}</strong>
      </div>
    </a>
    <a class="hidden statistics-link w-inline-block" href="#">
      <div class="statistics-text-block">Hidden: <strong><strong>{{ $category->questions->where('status', '2')->count() }}</strong></strong>
      </div>
    </a>
    <a class="published statistics-link w-inline-block" href="#">
      <div class="statistics-text-block">Published: <strong>{{ $category->questions->where('status', '1')->count() }}</strong>
      </div>
    </a>
    <a class="statistics-link w-inline-block" href="#">
      <div class="statistics-text-block">Total: <strong>{{ $category->questions->count() }}</strong>
      </div>
    </a>
  </div>
</div>
<div class="dashboard-container w-container">
  <div class="list-group">

    @foreach($category->questions as $question)

      {{--Get the question's status to determine the row border's color--}}
      @php
      if($question->status == 0) {
      $borderClass = 'list-item-pending-question';
      } elseif($question->status == 1) {
      $borderClass = 'list-item-published-question';
      } elseif($question->status == 2) {
      $borderClass = 'list-item-hidden-question';
      }
      @endphp

      <a href="{{ route('edit-question-form', ['question' => $question->id]) }}" class="no-style-link-block">
        <div class="list-item {{ $borderClass }}">
          <div class="list-item-row w-row">
            <div class="list-item-colomn w-col w-col-2">
              <div>{{ $question->created_at }}</div>
            </div>
            <div class="list-item-colomn w-col w-col-2">
              <div>{{ $question->category->name }}</div>
            </div>
            <div class="list-item-colomn w-col w-col-8">
              <div>
                <div class="column-text">{{ $question->question }}</div>
              </div>
            </div>
          </div>
        </div>
      </a>

    @endforeach

      <a class="dashboard-button flex-center delete-button w-button" href="{{ route('delete-category-form', ['category' => $category->id]) }}">Delete</a>

  </div>
</div>
@stop