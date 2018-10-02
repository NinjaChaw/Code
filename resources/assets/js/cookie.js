iziToast.show({
    theme: 'dark',
    message: __('app.cookie_consent'),
    class: 'cookie-consent',
    close: false,
    timeout: false,
    position: 'bottomCenter',
    buttons: [
        ['<button><b>'+__('app.accept')+'</b></button>', function (instance, toast) {
            axios.post('/cookie/accept').then(function (response) {
                if (typeof response.data.success != 'undefined' && response.data.success)
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            });
        }],
        ['<button>'+__('app.privacy_policy')+'</button>', function (instance, toast) {
            window.location.href = '/page/privacy-policy';
        }]
    ]
});