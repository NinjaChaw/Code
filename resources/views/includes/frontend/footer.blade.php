<div id="footer" class="ui inverted vertical segment">
    <div class="ui container">
        <div class="ui top aligned stackable inverted equal height stackable grid">
            <div class="row">
                <div class="tablet-and-below-center column">
                    <h4 class="ui inverted header">
                        <img src="{{ asset('images/logo.png') }}" class="ui tiny image">
                        {{ __('app.app_name') }}
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="eight wide tablet-and-below-center column">
                    <div class="ui inverted horizontal link list">
                        <a href="{{ url('page/privacy-policy') }}" class="item">{{ __('app.privacy_policy') }}</a>
                        <a href="{{ url('page/terms-of-use') }}" class="item">{{ __('app.terms_of_use') }}</a>
                    </div>
                </div>
                <div class="eight wide right aligned tablet-and-below-center column">
                </div>
            </div>
        </div>
    </div>
</div>