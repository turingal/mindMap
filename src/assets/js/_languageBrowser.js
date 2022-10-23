$(document).ready(function () {
    var language = getCookie('mc_language_browser');
    if (!language || (language != navigator.language)) {
        setCookie('mc_language_browser', navigator.language, {'max-age': 157788000000});

        window.sendMetric(
            'language_browser',
            navigator.language,
            function () {
                console.log('language recorded');
            }
        );
    }
});
