$(document).ready(function () {

    if (!(window.location.pathname.slice(0, 13) == '/mod/resource'))
        return;

    console.log("Resource Page");

    let btn = $(".resourceworkaround a");
    let downloaded = false;
    let allowedTypes = ['doc', 'docx', 'txt', 'excel', 'pdf', 'odt'];

    let file_extension = (""+btn.attr("href")).split('.').slice(-1)[0];
    console.log(file_extension);

    if (allowedTypes.includes(file_extension)) {
        btn.click(function () {
            window.sendMetric(
                'download_text_file',
                1,
                function () {
                    console.log('File download fact recorded');
                }
            );
        });

        window.addEventListener('beforeunload', function () {
            if (!downloaded) {
                window.sendMetric(
                    'download_text_file',
                    0,
                    function () {
                        console.log('Fact not downloading file recorded');
                    }
                );
            }
        });
    }
});