$(document).ready(function () {
    if (!getCookie('mc_browser')) {
        setCookie('mc_browser', 'true');


        var browser;
        if (navigator.userAgent.search(/Chrome/) > 0) {
            browser = 'Chrome';
        } else if (navigator.userAgent.search(/Safari/) > 0) {
            browser = 'Safari';
        } else if (navigator.userAgent.search(/Firefox/) > 0) {
            browser = 'Firefox';
        } else if (navigator.userAgent.search(/MSIE/) > 0 || navigator.userAgent.search(/NET CLR /) > 0) {
            browser = 'IE';
        } else if (navigator.userAgent.search(/YaBrowser/) > 0) {
            browser = 'YaBrowser';
        } else if (navigator.userAgent.search(/OPR/) > 0 || navigator.userAgent.search(/Opera/) > 0) {
            browser = 'Opera';
        } else if (navigator.userAgent.search(/Konqueror/) > 0) {
            browser = 'Konqueror';
        } else if (navigator.userAgent.search(/Iceweasel/) > 0) {
            browser = 'Iceweasel';
        } else if (navigator.userAgent.search(/SeaMonkey/) > 0) {
            browser = 'SeaMonkey';
        } else if (navigator.userAgent.search(/Edge/) > 0) {
            browser = 'Edge';
        } else {
            browser = 'Other';
        }

        window.sendMetric(
            'browser',
            browser,
            function () {
                console.log('browser type recorded');
            }
        );
    }
});