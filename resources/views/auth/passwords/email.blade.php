@extends('layouts.auth')

@section('title')
    {{ __('auth.reset') }}
@endsection

@section('before-auth')
    <div id="particles"></div>
@endsection

@section('auth')
    <div class="ui middle aligned center aligned grid auth-form-container">
        <div class="column">
            <div class="ui segment">
                <h2 class="ui {{ $settings->color }} image header">
                    <a href="{{ route('frontend.index') }}">
                        <img src="{{ asset('images/logo.png') }}" class="image">
                    </a>
                    <div class="content">
                        {{ __('app.app_name') }}
                        <div class="sub header">{{ __('auth.reset_header') }}</div>
                    </div>
                </h2>
                @component('components.session.messages')
                @endcomponent
                <loading-form v-cloak inline-template>
                    <form class="ui form" method="POST" action="{{ route('password.email') }}" @submit="disableButton">
                        {{ csrf_field() }}
                        <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                            <div class="ui left icon input">
                                <i class="mail icon"></i>
                                <input type="email" name="email" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <button :class="[{disabled: submitted, loading: submitted}, 'ui {{ $settings->color }} fluid large submit button']">{{ __('auth.reset') }}</button>
                    </form>
                </loading-form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/auth.js') }}"></script>
@endpush