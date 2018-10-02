@extends('layouts.backend')

@section('title')
    {{ __('Badges') }} :: {{ __('app.edit') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.badge.update', ['id' => $badge->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <image-upload-input name="logo" default-image-url="{{ asset('images/badges/'.$badge->avatar) }}" class="{{ $errors->has('logo') ? 'error' : '' }}" color="{{ $settings->color }}">
                        {{ __('app.logo') }}
                    </image-upload-input>
                    <div class="field {{ $errors->has('label') ? 'error' : '' }}">
                        <label>{{ __('Achievement label') }}</label>
                        <div class="ui input">
                            <input type="text" name="label" value="{{ $badge->title }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('points') ? 'error' : '' }}">
                        <label>{{ __('Points required to achieve this badge') }}</label>
                        <div class="ui input">
                            <input type="number" name="points" value="{{ $badge->points }}" required autofocus>
                        </div>
                    </div>
                    <button class="ui large {{ $settings->color }} submit button">
                        <i class="save icon"></i>
                        {{ __('Update') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="{{ route('backend.badge.index') }}"><i class="left arrow icon"></i> {{ __('Back to all badges') }}</a>
        </div>
    </div>
@endsection