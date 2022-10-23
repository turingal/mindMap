<?php
require_once('MetricHandler.php');

class FileExtensionHandler extends MetricHandler
{

    public function getResult()
    {
        return null;
    }

    public function getValues($userId, $dateStart = null, $dateFinish = null)
    {

        global $DB;
        $result = [];

        $sql = "SELECT *
                  FROM mdl_files
                 WHERE userid = ?";
        $records = $DB->get_records_sql($sql, [$userId]);

        foreach ($records as $item) {
            $fileInfo = pathinfo($item->filename);
            $ext = $fileInfo["extension"];
            if (!$ext) $ext = "other";

            if (array_key_exists($ext, $result)) {
                $result[$ext] += 1;
            } else {
                $result[$ext] = 0;
            }
        }

        return $result;
    }
}