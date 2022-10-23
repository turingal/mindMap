(function () {
    window.userActivity = true;

    let handler = function () {
        window.userActivity = true;
        clearTimeout(timerId);
        setTimer();
    };
    $(window).on('click', handler)
        .on('mousemove', handler)
        .on('scroll', handler)
        .on('keypress', handler);

    let getSecAmount = function () {
        if (document.documentElement.clientHeight >= 637 && document.documentElement.clientWidth >= 729) {
            return 60000;
        } else {
            return 20000;
        }
    };

    let timerId;
    let setTimer = function () {
        timerId = setTimeout(function tick() {
            window.userActivity = false;
            media.forEach(function (item) {
                if (item.inProgress) {
                    window.userActivity = true;
                    return;
                }
            })
            timerId = setTimeout(tick, getSecAmount());
        }, getSecAmount());
    };
    setTimer();
    var videoActions = Array.from(document.querySelectorAll("video"));
    var audioActions = Array.from(document.querySelectorAll("audio"));
    var media = videoActions.concat(audioActions);

    media.forEach(function (item) {
        item.inProgress = false;
        $(item).on("play", function () {
            this.inProgress = true
        });
        $(item).on("ended", function () {
            this.inProgress = false
        });
        $(item).on("pause", function () {
            this.inProgress = false
        });
    });
})();
