$(document).ready(function () {
    if (!getCookie('mc_platform')) {
        setCookie('mc_platform', 'true');

        var platform;
        if (navigator.platform.search(/Linux/) >= 0) {
            platform = 'Linux';
        } else if (navigator.platform.search(/Android/) >= 0 || navigator.platform.search(/null/) >= 0) {
            platform = 'Android';
        } else if (navigator.platform.search(/iPhone/) >= 0 || navigator.platform.search(/iPod/) >= 0 || navigator.platform.search(/iPad/) >= 0 || navigator.platform.search(/iPhone Simulator/) >= 0 || navigator.platform.search(/iPod Simulator/) >= 0 || navigator.platform.search(/Pike v7.8 release 517/) >= 0 || navigator.platform.search(/Pike v7.6 release 92/) >= 0 || navigator.platform.search(/Mac68K/) > 0 || navigator.platform.search(/MacPPC/) >= 0 || navigator.platform.search(/MacIntel/) >= 0 || navigator.platform.search(/Macintosh/) >= 0 || navigator.platform.search(/iPad Simulator/) >= 0) {
            platform = 'Apple';
        } else if (navigator.platform.search(/BlackBerry/) >= 0) {
            platform = 'BlackBerry';
        } else if (navigator.platform.search(/FreeBSD/) >= 0 || navigator.platform.search(/FreeBSD i386/) >= 0 || navigator.platform.search(/FreeBSD amd64/) >= 0) {
            platform = 'FreeBSD';
        } else if (navigator.platform.search(/Pocket PC/) >= 0 || navigator.platform.search(/X11/) >= 0 || navigator.platform.search(/Windows/) >= 0 || navigator.platform.search(/Win16/) >= 0 || navigator.platform.search(/Win32/) >= 0 || navigator.platform.search(/WinCE/) >= 0) {
            platform = 'Microsoft';
        } else if (navigator.platform.search(/OpenBSD amd64/) >= 0) {
            platform = 'OpenBSD';
        } else if (navigator.platform.search(/PalmOS/) >= 0 || navigator.platform.search(/webOS/) >= 0) {
            platform = 'Palm';
        } else if (navigator.platform.search(/Nokia_Series_40/) >= 0 || navigator.platform.search(/S60/) >= 0 || navigator.platform.search(/weSymbianbOS/) >= 0 || navigator.platform.search(/Symbian OS/) >= 0) {
            platform = 'Symbian';
        } else if (navigator.platform.search(/SunOS/) >= 0 || navigator.platform.search(/SunOS i86pc/) >= 0 || navigator.platform.search(/SunOS sun4u/) >= 0) {
            platform = 'Solaris';
        } else if (navigator.platform.search(/PLAYSTATION 3/) >= 0 || navigator.platform.search(/PlayStation 4/) >= 0 || navigator.platform.search(/PSP/) >= 0) {
            platform = 'Sony';
        } else {
            platform = 'Other';
        }

        window.sendMetric(
            'platform',
            platform,
            function () {
                console.log('platform recorded');
                console.log(navigator.platform);
            }
        );
    }
});

