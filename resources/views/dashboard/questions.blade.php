@extends('layouts.dashboard')

@section('title')
  Dashboard: All Questions
@stop

@section('content')

  <div class="dashboard-container w-container">

    <div class="dashboards-subsection-top">
      <h2 class="dashboard-header">All Categories</h2>
      <div class="dashboard-subsection-buttons-block">
      <a class="dashboard-button flex-left w-button" href="{{ route('new-category-form') }}">New Category</a>
      <a class="dashboard-button flex-left w-button" href="{{ route('new-question-form') }}">New Question</a>
      </div>
    </div>

    @foreach($categories as $category)
      <a href="{{ route('show-category', ['category' => $category->id]) }}" class="no-style-link-block">
        <div class="list-item">
          <div class="list-item-row">
            <div class="list-item-colomn w-col w-col-8">
              <div class="column-text">{{ $category->name }}</div>
            </div>
            <div class="list-item-colomn statistics-block pending w-col w-col-1" title="Pending">
              <div class="column-text">{{ $category->questions->where('status', '0')->count() }}</div>
            </div>
            <div class="list-item-colomn statistics-block published w-col w-col-1" title="Published">
              <div class="column-text">{{ $category->questions->where('status', '1')->count() }}</div>
            </div>
            <div class="list-item-colomn statistics-block hidden w-col w-col-1" title="Hidden">
              <div class="column-text">{{ $category->questions->where('status', '2')->count() }}</div>
            </div>
            <div class="list-item-colomn statistics-block w-col w-col-1" title="Total">
              <div class="column-text">{{ $category->questions->count() }}</div>
            </div>
          </div>
        </div>
      </a>
    @endforeach

  </div>

  @stop