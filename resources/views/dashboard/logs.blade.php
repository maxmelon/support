@extends('layouts.dashboard')

@section('title')
    Dashboard: Logs
@stop

@section('content')

    <div class="dashboard-container w-container">

        <div class="dashboards-subsection-top">
            <h2 class="dashboard-header">Last Activities (max. 20)</h2>
            <div class="dashboard-subsection-buttons-block">
                <a class="dashboard-button flex-left w-button" href="#">Full Logs</a>
            </div>

        </div>

        <div class="list-header">
            <div class="list-item-row">
                <div class="list-item-colomn w-col w-col-2">
                    <div class="column-text">Date</div>
                </div>
                <div class="list-item-colomn w-col w-col-2">
                    <div class="column-text">User</div>
                </div>
                <div class="list-item-colomn w-col w-col-8">
                    <div class="column-text">Activity</div>
                </div>
            </div>
        </div>

        @foreach($activities as $activity)
            @php
            $pathExploded = explode('\\', $activity->subject_type);
            $subject = end($pathExploded);
            @endphp
                <div class="list-item">
                    <div class="list-item-row">
                        <div class="list-item-colomn w-col w-col-2">
                            <div class="column-text">{{ $activity->created_at }}</div>
                        </div>
                        <div class="list-item-colomn w-col w-col-2">
                            <div class="column-text">{{ $activity->causer->name }}</div>
                        </div>
                        <div class="list-item-colomn w-col w-col-8">
                            <div class="column-text">
                                {{ $subject }} ({{ $activity->subject_id }}) has been {{ $activity->description }}. <br>
                                @foreach ($activity->changes['attributes'] as $key => $attribute)
                                    <i>{{ $key }}</i>: {{ $attribute }} <br>
                                @endforeach
                                @if(isset($activity->changes['old']))
                                    Old properties:
                                    @foreach ($activity->changes['old'] as $key => $attribute)
                                        <i>{{ $key }}</i>: {{ $attribute }}
                                    @endforeach
                                @endif
                                {{--{{ str_replace($needles, " ", $activity->properties) }}--}}
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach

    </div>

@stop
