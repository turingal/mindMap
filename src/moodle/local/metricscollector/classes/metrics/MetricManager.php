<?php
require_once('../../utils.php');

class MetricManager {
    public function getMetrics($userId, $dateStart = null, $dateFinish = null){
        $result = [];
        $metrics = get_existing_metrics();

        foreach ($metrics as $code => $value) {
            $result[$code] = (get_metric_handler($code, ''))->getValues($userId, $dateStart, $dateFinish);
        }

        return $result;
    }
}