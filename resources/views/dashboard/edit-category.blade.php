@extends('layouts.dashboard')

@section('title')
    Dashboard: Edit Category
@stop

@section('content')

    <div>
        <div class="dashboard-container w-container">
            <div class="dashboards-subsection-top">
                <h2 class="dashboard-header">Edit Category</h2>
            </div>
            <div class="new-question-form-wrapper">
                <div class="w-form">
                    <form method="post" action="{{ route('update-category', ['category' => $category->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input class="dashboard-form-field w-input" id="name" name="name" maxlength="191" type="text" placeholder="Category" value="{{ $category->name }}">
                        <button class="dashboard-button flex-center w-button" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop