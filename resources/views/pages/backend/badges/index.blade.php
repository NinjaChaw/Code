@extends('layouts.backend')

@section('title')
    {{ __('Badges') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="center aligned column">
            <a href="{{ route('backend.badges.create') }}" class="ui big {{ $settings->color }} button">
                <i class="trophy icon"></i>
                {{ __('Create badge') }}
            </a>
        </div>
    </div>
    <div class="ui equal width stackable grid container">
        <div class="row">
            @foreach($badges as $badge)
                <div class="center aligned column">
                    <div class="ui {{ $inverted }} segment">
                        <div class="ui {{ $inverted }} statistic">
                            <div class="label">
                                Badge point: {{ $badge->points }}
                            </div>
                            <div class="value">
                                <img src="{{ asset('images/badges/'.$badge->avatar) }}" alt="Badge image">
                            </div>
                            <div class="label">
                                {{ $badge->title }}
                            </div>
                            <br>
                            <a class="ui icon {{ $settings->color }} basic button" href="{{ route('backend.badge.edit', $badge->id) }}">
                                <i class="edit icon"></i>
                                {{ __('Edit') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection