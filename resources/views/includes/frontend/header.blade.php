<div id="header" class="ui container">
    <div class="ui equal width middle aligned grid">
        <div id="menu-top-bar" class="row">
            <div class="mobile only column">
                <!-- Mobile menu -->
                <div class="ui vertical icon {{ $inverted }} menu">
                    <div class="ui left pointing dropdown icon item">
                        <i class="bars icon"></i>
                        <div class="ui stackable large menu">
                            <a href="{{ route('frontend.dashboard') }}" class="item {{ Route::currentRouteName()=='frontend.dashboard' ? 'active' : '' }}">
                                <i class="home icon"></i>
                                {{ __('app.dashboard') }}
                            </a>
                            <a href="{{ route('frontend.competitions.index') }}" class="item {{ strpos(Route::currentRouteName(),'frontend.competitions.')!==FALSE ? 'active' : '' }}">
                                <i class="trophy icon"></i>
                                {{ __('app.competitions') }}
                            </a>
                            <a href="{{ route('frontend.assets.index') }}" class="item {{ Route::currentRouteName()=='frontend.assets.index' ? 'active' : '' }}">
                                <i class="bitcoin icon"></i>
                                {{ __('app.coins') }}
                            </a>
                            <a href="{{ route('frontend.rankings') }}" class="item {{ Route::currentRouteName()=='frontend.rankings' ? 'active' : '' }}">
                                <i class="star icon"></i>
                                {{ __('app.rankings') }}
                            </a>
                            <a href="{{ route('frontend.help') }}" class="item {{ Route::currentRouteName()=='frontend.help' ? 'active' : '' }}">
                                <i class="question icon"></i>
                                {{ __('app.help') }}
                            </a>
                            <div class="item">
                                <div class="text">
                                    <img class="ui avatar image" src="{{ auth()->user()->avatar_url }}">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="menu">
                                    @if(auth()->user()->admin())
                                        <a href="{{ route('backend.dashboard') }}" class="item">
                                            <i class="setting icon"></i>
                                            {{ __('app.backend') }}
                                        </a>
                                    @endif
                                    <a href="{{ route('frontend.users.show', auth()->user()) }}" class="item">
                                        <i class="user icon"></i>
                                        {{ __('users.profile') }}
                                    </a>

                                    @packageview('includes.frontend.header')

                                    <log-out-button token="{{ csrf_token() }}" class="item">
                                        <i class="sign out alternate icon"></i>
                                        {{ __('auth.logout') }}
                                    </log-out-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Mobile menu -->
            </div>
            <div class="tablet only computer only column">
                <h4>
                    <a href="{{ route('frontend.index') }}">
                        <img src="{{ asset('images/logo.png') }}" class="ui image">
                        {{ __('app.app_name') }}
                    </a>
                </h4>
            </div>
            <div class="right aligned column">
                <locale-select :locales="{{ json_encode($locale->locales()) }}" :locale="{{ json_encode($locale->locale()) }}"></locale-select>
            </div>
        </div>
        <div class="row">
            <div class="tablet only computer only column">
                <!-- Desktop menu -->
                <div class="ui stackable {{ $inverted }} menu">
                    <a href="{{ route('frontend.dashboard') }}" class="item {{ Route::currentRouteName()=='frontend.dashboard' ? 'active' : '' }}">
                        <i class="home icon"></i>
                        {{ __('app.dashboard') }}
                    </a>
                    <a href="{{ route('frontend.competitions.index') }}" class="item {{ strpos(Route::currentRouteName(),'frontend.competitions.')!==FALSE ? 'active' : '' }}">
                        <i class="trophy icon"></i>
                        {{ __('app.competitions') }}
                    </a>
                    <a href="{{ route('frontend.assets.index') }}" class="item {{ Route::currentRouteName()=='frontend.assets.index' ? 'active' : '' }}">
                        <i class="bitcoin icon"></i>
                        {{ __('app.coins') }}
                    </a>
                    <a href="{{ route('frontend.rankings') }}" class="item {{ Route::currentRouteName()=='frontend.rankings' ? 'active' : '' }}">
                        <i class="star icon"></i>
                        {{ __('app.rankings') }}
                    </a>
                    <a href="{{ route('frontend.help') }}" class="item {{ Route::currentRouteName()=='frontend.help' ? 'active' : '' }}">
                        <i class="question icon"></i>
                    </a>
                    <div class="right menu">
                        <div class="ui item dropdown">
                            <div class="text">
                                <img class="ui avatar image" src="{{ auth()->user()->avatar_url }}">
                                {{ auth()->user()->name }}
                                @if(!empty(Auth::user()->points->first()->points))
                                    @if(!empty($badges))
                                        @foreach($badges as $badge)
                                            @if(Auth::user()->points->first()->points >= $badge->points)
                                                <img src="{{ asset('images/badges/'.$badge->avatar) }}" alt="Badge" height="25px" width="25px">
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                @if(auth()->user()->admin())
                                    <a href="{{ route('backend.dashboard') }}" class="item">
                                        <i class="setting icon"></i>
                                        {{ __('app.backend') }}
                                    </a>
                                @endif
                                <a href="{{ route('frontend.users.show', auth()->user()) }}" class="item">
                                    <i class="user icon"></i>
                                    {{ __('users.profile') }}
                                </a>

                                @packageview('includes.frontend.header')

                                <log-out-button token="{{ csrf_token() }}" class="item">
                                    <i class="sign out alternate icon"></i>
                                    {{ __('auth.logout') }}
                                </log-out-button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Desktop menu -->
            </div>
        </div>
    </div>
</div>