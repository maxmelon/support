@extends('layouts.dashboard')

@section('title')
  Dashboard: Accounts
@stop

@section('content')

  <div class="dashboard-container w-container">

    <div class="dashboards-subsection-top">
      <h2 class="dashboard-header">All Users</h2>
      <div class="dashboard-subsection-buttons-block">
        <a class="dashboard-button flex-left w-button" href="{{ route('new-account-form') }}">Add Account</a>
      </div>

    </div>

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

    @foreach($users as $user)
      <a href="{{ route('edit-account-form', ['user' => $user->id]) }}" class="no-style-link-block">
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
      </a>
    @endforeach

  </div>

@stop
