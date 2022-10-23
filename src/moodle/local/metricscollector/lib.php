<?
// Подключение наших скриптов внизу сайта
function local_metricscollector_before_footer() {
    global $PAGE;
    $PAGE->requires->js("/static/js/all.js");
}

// Подключение JQuery вверху сайта
function local_metricscollector_before_standard_html_head() {
    return '<script
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>';
}
?>
