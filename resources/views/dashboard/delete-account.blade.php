@extends('layouts.dashboard')

@section('title')
    Dashboard: Delete This Account?
@stop

@section('content')

    <div class="dashboard-container w-container">

        <div class="dashboards-subsection-top">
            <h2 class="dashboard-header">Are you sure you want to delete the account: {{ $user->name }}?</h2>
        </div>

        <div class="list-group">

            <div class="list-header">
                <div class="list-item-row">
                    <div class="list-item-colomn w-col w-col-1">
                        <div class="column-text">ID</div>
                    </div>
                    <div class="list-item-colomn w-col w-col-3">
                        <div class="column-text">Created at</div>
                    </div>
                    <div class="list-item-colomn w-col w-col-4">
                        <div class="column-text">Username</div>
                    </div>
                    <div class="list-item-colomn w-col w-col-4">
                        <div class="column-text">Email</div>
                    </div>
                </div>
            </div>

            <div class="list-item">
                <div class="list-item-row">
                    <div class="list-item-colomn w-col w-col-1">
                        <div class="column-text">{{ $user->id }}</div>
                    </div>
                    <div class="list-item-colomn w-col w-col-3">
                        <div class="column-text">{{ $user->created_at }}</div>
                    </div>
                    <div class="list-item-colomn w-col w-col-4">
                        <div class="column-text">{{ $user->name }}</div>
                    </div>
                    <div class="list-item-colomn w-col w-col-4">
                        <div class="column-text">{{ $user->email }}</div>
                    </div>
                </div>
            </div>

        <div class="w-form">
            <form method="POST" action="{{ route('destroy-account', ['user' => $user->id]) }}">
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