@extends('layouts.backend')

@section('title')
    {{ __('Badges') }} :: {{ __('app.create') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.badges.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <image-upload-input name="logo" default-image-url="{{ asset('images/badges/initial.jpg') }}" class="{{ $errors->has('logo') ? 'error' : '' }}" color="{{ $settings->color }}">
                        {{ __('app.logo') }}
                    </image-upload-input>
                    <div class="field {{ $errors->has('label') ? 'error' : '' }}">
                        <label>{{ __('Achievement label') }}</label>
                        <div class="ui input">
                            <input type="text" name="label" placeholder="{{ __('Achievement label') }}" value="{{ old('label') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('points') ? 'error' : '' }}">
                        <label>{{ __('Points required to achieve this badge') }}</label>
                        <div class="ui input">
                            <input type="number" name="points" placeholder="{{ __('Badge points') }}" value="{{ old('points') }}" required autofocus>
                        </div>
                    </div>
                    <button class="ui large {{ $settings->color }} submit button">
                        <i class="save icon"></i>
                        {{ __('app.save') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="{{ route('backend.badge.index') }}"><i class="left arrow icon"></i> {{ __('Back to all badges') }}</a>
        </div>
    </div>
@endsection