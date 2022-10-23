<?php
require_once('MetricHandler.php');

class BrowserTypeHandler extends MetricHandler{

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
        $browsers = [];

        $count = 0;
        // подсчитываем, какой браузер сколько раз встречался
        foreach ($records as $item) {
            $count++;
            if (array_key_exists($item->value, $browsers))
                $browsers[$item->value]++;
            else
                $browsers[$item->value] = 1;
        }

        $result = [];

        foreach ($browsers as $key => $value) {
            $result[$key] = $value / $count;
        }

        return $result;
    }
}