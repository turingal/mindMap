$(document).ready(function () {

    if (!(window.location.pathname.slice(0, 5) == '/mod/'))
        return;

    let count = 0;

    $(this).on('mouseup', function () {
        var txt = "";

        if (window.getSelection) {
            txt = window.getSelection();
        }
        else if (document.getSelection) {
            txt = document.getSelection();
        } else if (document.selection) {
            txt = document.selection.createRange().text;
        }

        if (txt != "") {
            count++;
            console.log("selecting text");
        }
    });


    window.addEventListener('beforeunload', function () {
        window.sendMetric(
            'text_selecting',
            count,
            function () {
                console.log('Fact that select was recorded');
            }
        );
    });
});