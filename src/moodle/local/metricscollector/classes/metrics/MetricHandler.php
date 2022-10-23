<?php

abstract class MetricHandler {
    protected $metricValue;
    protected $metricCode;

    public function __construct($metricCode, $metricValue, $metricDescription = '')
    {
        $this->metricValue = $metricValue;
        $this->metricCode = $metricCode;
        $this->createMetricIfNotExist($metricDescription);
    }

    public function getMetricId() {
        global $DB;
        return ($DB->get_record_sql("SELECT * FROM metric WHERE code = ?", [$this->metricCode]))->id;
    }

    public function createMetricIfNotExist($name) {
        global $DB;

        $check = $DB->get_record_sql("SELECT * FROM metric WHERE code = ?", [$this->metricCode]);
        if (!$check) {
            $DB->execute('INSERT INTO metric (name, code) VALUE (?, ?)', array($name, $this->metricCode));
        }
    }

    /*
     * Получение записей значений метрики по userId
     * Возможно ограничение сверху и снизу по timeshtamp
     */
    public function getRecords($userId, $dateStart = null, $dateFinish = null) {
        global $DB;
        $metric_id = $this->getMetricId();
        
        if (!$dateStart and !$dateFinish) {
            return $DB->get_records_sql(
                "SELECT * FROM metric_data WHERE metric_id = ? AND user_id = ?",
                [$metric_id, $userId]
            );
        } else if ($dateStart and !$dateFinish) {
            return $DB->get_records_sql(
                "SELECT * FROM metric_data WHERE metric_id = ? AND user_id = ? AND timeshtamp > ?",
                [$metric_id, $userId, $dateStart]
            );
        } else if (!$dateStart and $dateFinish) {
            return $DB->get_records_sql(
                "SELECT * FROM metric_data WHERE metric_id = ? AND user_id = ? AND timeshtamp < ?",
                [$metric_id, $userId, $dateFinish]
            );
        } else if ($dateStart and $dateFinish) {
            return $DB->get_records_sql(
                "SELECT * FROM metric_data WHERE metric_id = ? AND user_id = ? AND timeshtamp BETWEEN ? AND ?",
                [$metric_id, $userId, $dateStart, $dateFinish]
            );
        }
    }

    /*
     * Используется при запросе на создание метрики
     */
    abstract public function getResult();

    /*
     * Используется при выборке значения метрик для
     * передачи во внешние источники (API)
     */
    abstract public function getValues($userId, $dateStart = null, $dateFinish = null);
}