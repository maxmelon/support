@extends('layouts.dashboard')

@section('title')
    Dashboard: Delete This Category?
@stop

@section('content')

    <div class="dashboard-container w-container">

        <div class="dashboards-subsection-top">
            <h2 class="dashboard-header">Are you sure you want to delete the category: {{ $category->name }}? All associated questions will be also irreversibly removed.</h2>
        </div>

        <div class="w-form">
            <form method="POST" action="{{ route('destroy-category', ['category' => $category->id]) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="dashboard-button-section">
                    <a class="dashboard-button w-button" href="{{ route('cancel') }}">Cancel</a>
                    <button class="dashboard-button delete-button w-button">Sure, kill it and its questions! Let them burn!</button>
                </div>
            </form>
        </div>

    </div>



@stop