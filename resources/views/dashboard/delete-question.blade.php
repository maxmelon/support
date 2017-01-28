@extends('layouts.dashboard')

@section('title')
    Dashboard: Delete This Question?
@stop

@section('content')

    <div class="dashboard-container w-container">

        <div class="dashboards-subsection-top">
            <h2 class="dashboard-header">Are you sure you want to delete this question?</h2>
        </div>

        <div class="list-group">

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

                <div class="list-item {{ $borderClass }}" data-ix="show-menu">
                    <div class="list-item-row w-row">
                        <div class="list-item-colomn w-col w-col-2">
                            <div>{{ $question->created_at }}</div>
                        </div>
                        <div class="list-item-colomn w-col w-col-2">
                            <div>{{ $question->category->name }}</div>
                        </div>
                        <div class="list-item-colomn w-col w-col-6">
                            <div>
                                <div class="column-text">{{ $question->question }}</div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

        <div class="w-form">
            <form method="POST" action="{{ route('destroy-question', ['question' => $question->id]) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="dashboard-button-section">
                    <a class="dashboard-button w-button" href="{{ route('cancel') }}">Cancel</a>
                    <button class="dashboard-button delete-button w-button">Delete</button>
                </div>
            </form>
        </div>

    </div>



@stop