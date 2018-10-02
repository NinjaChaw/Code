@extends('layouts.frontend')

@section('title')
    {{ $user->name }} :: {{ __('users.edit') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form" method="POST" action="{{ route('frontend.users.update', $user) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <image-upload-input name="avatar" image-url="{{ $user->avatar_url }}" default-image-url="{{ asset('images/avatar.jpg') }}" class="{{ $errors->has('avatar') ? 'error' : '' }}" color="{{ $settings->color }}">
                        {{ __('users.avatar') }}
                    </image-upload-input>
                    <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                        <label>{{ __('users.name') }}</label>
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="name" placeholder="{{ __('users.name') }}" value="{{ old('name', $user->name) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                        <label>{{ __('users.email') }}</label>
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input type="email" name="email" placeholder="{{ __('users.email') }}" value="{{ old('email', $user->email) }}" required autofocus>
                        </div>
                    </div>
                    <button class="ui large {{ $settings->color }} submit icon button">
                        <i class="save icon"></i>
                        {{ __('users.save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection