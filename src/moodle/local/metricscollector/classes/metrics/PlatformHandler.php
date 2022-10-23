<?php
require_once('MetricHandler.php');

class PlatformHandler extends MetricHandler {

    public function getResult()
    {
        global $DB;
        global $USER;

        $user_id = $USER->id;
        $metric_id = $this->getMetricId();
        $value = htmlspecialchars($this->metricValue, ENT_QUOTES);

        $DB->execute(
            "INSERT INTO metric_data (user_id, metric_id, value) VALUE (?, ?, ?)",
            array(
                $user_id,
                $metric_id,
                $value,
            )
        );

        return "OK";
    }

    public function getValues($userId, $dateStart = null, $dateFinish = null)
    {
        $records = $this->getRecords($userId, $dateStart, $dateFinish);
        $platforms = [];

        $count = 0;
        // подсчитываем, какая платформа сколько раз встречалась
        foreach ($records as $item) {
            $count++;
            if (array_key_exists($item->value, $platforms))
                $platforms[$item->value]++;
            else
                $platforms[$item->value] = 1;
        }

        $result = [];

        foreach ($platforms as $key => $value) {
            $result[$key] = $value / $count;
        }

        return $result;
    }
}