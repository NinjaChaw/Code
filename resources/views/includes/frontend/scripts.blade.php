<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/semantic/semantic.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/variables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@if(config('settings.adsense_client_id') && (config('settings.adsense_top_slot_id') || config('settings.adsense_bottom_slot_id')))
    <script>
        @if(config('settings.adsense_top_slot_id') && config('settings.adsense_bottom_slot_id'))
            // 2 ad slots
            var adsbygoogle = [{}, {}];
        @else
            // 1 ad slot
            var adsbygoogle = [{}];
        @endif
    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endif
@if(!$cookie_usage_accepted)
    <script type="text/javascript" src="{{ asset('js/cookie.js') }}"></script>
@endif
@stack('scripts')