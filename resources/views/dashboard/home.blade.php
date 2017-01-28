@extends('layouts.dashboard')

@section('title')
  Dashboard
  @stop

@section('content')

  <div>
    <div class="w-container">
      <h2 class="dashboard-header">Pending Questions</h2>
    </div>
  </div>
  <div class="dashboard-container w-container">
    <div class="list-group">

      @if(count($pendingQuestions))

        @foreach($pendingQuestions as $question)
          <a href="{{ route('edit-question-form', ['question' => $question->id]) }}" class="no-style-link-block">
            <div class="list-item list-item-pending-question" data-ix="show-menu">
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

      @else

        No pending questions at the moment

      @endif

    </div>
  </div>

@stop