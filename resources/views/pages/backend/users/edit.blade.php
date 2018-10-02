@extends('layouts.backend')

@section('title')
    {{ $user->name }} :: {{ __('users.edit') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.users.update', $user) }}" enctype="multipart/form-data">
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
                    <div class="field {{ $errors->has('role') ? 'error' : '' }}">
                        <label>{{ __('users.role') }}</label>
                        <div id="user-role-dropdown" class="ui selection dropdown">
                            <input type="hidden" name="role">
                            <i class="dropdown icon"></i>
                            <div class="default text"></div>
                            <div class="menu">
                                <div class="item" data-value="{{ App\Models\User::ROLE_USER }}"><i class="grey user icon"></i> {{ __('users.role_'.App\Models\User::ROLE_USER) }}</div>
                                <div class="item" data-value="{{ App\Models\User::ROLE_ADMIN }}"><i class="grey user secret icon"></i> {{ __('users.role_'.App\Models\User::ROLE_ADMIN) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('status') ? 'error' : '' }}">
                        <label>{{ __('users.status') }}</label>
                        <div id="user-status-dropdown" class="ui selection dropdown">
                            <input type="hidden" name="status">
                            <i class="dropdown icon"></i>
                            <div class="default text"></div>
                            <div class="menu">
                                <div class="item" data-value="{{ App\Models\User::STATUS_ACTIVE }}"><i class="grey check icon"></i> {{ __('users.status_'.App\Models\User::STATUS_ACTIVE) }}</div>
                                <div class="item" data-value="{{ App\Models\User::STATUS_BLOCKED }}"><i class="grey ban icon"></i> {{ __('users.status_'.App\Models\User::STATUS_BLOCKED) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                        <label>{{ __('users.email') }}</label>
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input type="email" name="email" placeholder="{{ __('users.email') }}" value="{{ old('email', $user->email) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                        <label>{{ __('users.password') }}</label>
                        <div class="ui left icon input">
                            <i class="key icon"></i>
                            <input type="password" name="password" placeholder="{{ __('users.password_placeholder') }}">
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('users.last_login_time') }}</label>
                        <div class="ui left icon input">
                            <i class="clock outline icon"></i>
                            <input value="{{ $user->last_login_time }} ({{ $user->last_login_time->diffForHumans() }})" disabled="disabled">
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('users.last_login_ip') }}</label>
                        <div class="ui left icon input">
                            <i class="globe icon"></i>
                            <input value="{{ $user->last_login_ip }}" disabled="disabled">
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('users.created_at') }}</label>
                        <div class="ui left icon input">
                            <i class="clock outline icon"></i>
                            <input value="{{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})" disabled="disabled">
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('users.updated_at') }}</label>
                        <div class="ui left icon input">
                            <i class="clock outline icon"></i>
                            <input value="{{ $user->updated_at }} ({{ $user->updated_at->diffForHumans() }})" disabled="disabled">
                        </div>
                    </div>
                    <button class="ui large {{ $settings->color }} submit icon button">
                        <i class="save icon"></i>
                        {{ __('users.save') }}
                    </button>
                    <a href="{{ route('backend.users.delete', $user) }}" class="ui large red submit right floated icon button">
                        <i class="trash icon"></i>
                        {{ __('users.delete') }}
                    </a>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="{{ url()->previous() }}"><i class="left arrow icon"></i> {{ __('users.back_all') }}</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#user-role-dropdown').dropdown('set selected', '{{ $user->role }}');
        $('#user-status-dropdown').dropdown('set selected', '{{ $user->status }}');
    </script>
@endpush