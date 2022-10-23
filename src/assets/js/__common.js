$(document).ready(function (){
    window.getCookie = function (name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    };

    window.setCookie = function (name, value, options = {}) {
        options = {
            path: '/',
            ...options
        };

        if (options.expires instanceof Date) {
            options.expires = options.expires.toUTCString();
        }

        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

        for (let optionKey in options) {
            updatedCookie += "; " + optionKey;
            let optionValue = options[optionKey];
            if (optionValue !== true) {
                updatedCookie += "=" + optionValue;
            }
        }

        document.cookie = updatedCookie;
    };

    window.error = function (er) {
        console.error('MetricsCollector Error: ', er);
    };

    window.sendMetric = function (metricCode, metricValue, callbackSuccess, callbackFail){
        require(['core/ajax'], function(ajax) {
            var promises = ajax.call([
                {
                    methodname: 'local_metricsCollector_createRecord',
                    args: {
                        metricCode: metricCode,
                        metricValue: metricValue,
                    }
                }
            ]);

            promises[0].then(function (response) {
                if (callbackSuccess)
                    callbackSuccess(response);
            }).fail(function (ex) {
                if (callbackFail){
                    callbackFail(ex)
                } else {
                    error(ex);
                }
            });
        });
    };
});