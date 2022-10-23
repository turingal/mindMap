<?php
require_once('classes/metrics/PlatformHandler.php');
require_once('classes/metrics/BrowserTypeHandler.php');
require_once('classes/metrics/LanguageBrowserHandler.php');
require_once('classes/metrics/DownloadTextFileHandler.php');
require_once('classes/metrics/TextSelectingHandler.php');
require_once('classes/metrics/UserWordsHandler.php');
require_once('classes/metrics/FileExtensionHandler.php');

function get_metric_handler($metricCode, $metricValue) {
    $metrics = get_existing_metrics();
    if (array_key_exists($metricCode, $metrics)) {
        return new $metrics[$metricCode]['handler']($metricCode, $metricValue, $metrics[$metricCode]['description']);
    } else {
        return Null;
    }
}

function get_existing_metrics() {
    return [
        'platform' => [
            'handler' => 'PlatformHandler',
            'description' => 'Using platform',
        ],
        'browser' => [
            'handler' => 'BrowserTypeHandler',
            'description' => 'Type of browser',
        ],
        'language_browser' => [
            'handler' => 'LanguageBrowserHandler',
            'description' => 'Language on browser',
        ],
        'download_text_file' => [
            'handler' => 'DownloadTextFileHandler',
            'description' => 'Downloading text files (0/1)',
        ],
        'text_selecting' => [
            'handler' => 'TextSelectingHandler',
            'description' => 'Text Selecting',
        ],
        'user_words' => [
            'handler' => 'UserWordsHandler',
            'description' => 'User use of words',
        ],
        'file_extension' => [
            'handler' => 'FileExtensionHandler',
            'description' => 'Extensions of user files',
        ],
    ];
}