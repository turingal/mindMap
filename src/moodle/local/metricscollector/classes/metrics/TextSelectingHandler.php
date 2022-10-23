<?php
require_once('MetricHandler.php');

class TextSelectingHandler extends MetricHandler{

    public function getResult()
    {
        ignore_user_abort(true);
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

        $count_all = count($records);
        $count_more_zero = 0;

        // считаем коэффициент
        foreach ($records as $item) {
            $count_more_zero += $item->value;
        }

        return [
            'k' => $count_all / $count_more_zero
        ];
    }
}