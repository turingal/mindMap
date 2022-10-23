<?php
require_once('MetricHandler.php');

class DownloadTextFileHandler extends MetricHandler {

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

        // считаем коэффициент
        $yes = 0;
        $no = 0;
        foreach ($records as $item) {
            $yes += $item->value;
            $no += !$item->value;
        }

        return [
            'yes' => $yes,
            'no' => $no,
            'k' => $yes / ($yes + $no)
        ];
    }
}