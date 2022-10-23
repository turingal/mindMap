<?php
require_once('../../../../config.php');
require_once('../../classes/metrics/MetricManager.php');

$dateStart = null;
$dateFinish = null;

if (array_key_exists('dateStart', $_GET))
    $dateStart = $_GET['dateStart'];

if (array_key_exists('dateFinish', $_GET))
    $dateFinish = $_GET['dateFinish'];

if (array_key_exists('userId', $_GET)) {
    $userId = $_GET['userId'];
} else {
    http_response_code(400);
    print_r(json_encode([
        "status" => "error",
        "msg" => "userId required",
    ]));
    return;
}

$manager = new MetricManager();
$metrics = $manager->getMetrics($userId, $dateStart, $dateFinish);

http_response_code(200);
print_r(json_encode([
    "status" => "ok",
    "response" => [
        "start" => $dateStart,
        "finish" => $dateFinish,
        "metrics" => $metrics,
    ],
]));