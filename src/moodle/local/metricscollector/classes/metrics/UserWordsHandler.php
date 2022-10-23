<?php
require_once('MetricHandler.php');

class UserWordsHandler extends MetricHandler{

    const WORDS = [
        'смотр', 'слуша', 'слыш', 'представ',
        'взгляд', 'дума', 'кажется', 'знаю', 'знать',
        'понима', 'чувств', 'логично', 'логика',
        'следовательно', 'докаж', 'доказ', 'вид',
        'звуч', 'гляд', 'гляж', 'счит',
    ];

    public function getResult()
    {
        return null;
    }

    public function getValues($userId, $dateStart = null, $dateFinish = null)
    {
        global $DB;
        $result = [];

        // строим sql запрос
        $queryParams = [$userId];
        $dateCondition = $this->getTimeCondition("timecreated", $queryParams, $dateStart, $dateFinish);
        $comments = $DB->get_records_sql(
            "SELECT content FROM mdl_comments WHERE userid = ? {$dateCondition}",
            $queryParams
        );

        $queryParams = [$userId];
        $dateCondition = $this->getTimeCondition("created", $queryParams, $dateStart, $dateFinish);
        $forum = $DB->get_records_sql(
            "SELECT message FROM mdl_forum_posts WHERE userid = ? {$dateCondition}",
            $queryParams
        );

        $queryParams = [$userId];
        $dateCondition = $this->getTimeCondition("timecreated", $queryParams, $dateStart, $dateFinish);
        $message = $DB->get_records_sql(
            "SELECT fullmessage FROM mdl_message WHERE useridfrom = ? {$dateCondition}",
            $queryParams
        );

        // формируем общий текст
        $maxSize = 2147483647;  // 2GB - максимальнй размер строки
        // склеиваем сообщения в массивы строк до 2GB в каждой
        $content = [""];
        $i = 0;
        foreach ($comments as $comment) {
            if (strlen($content[$i]) + strlen($comment->content) > $maxSize) {
                $i++;
                $content[$i] = "";
            }
            $content[$i] .= " ".$comment->content;
        }

        foreach ($forum as $item) {
            if (strlen($content[$i]) + strlen($item->message) > $maxSize) {
                $i++;
                $content[$i] = "";
            }
            $content[$i] .= " ".$item->message;
        }
        foreach ($message as $item) {
            if (strlen($content[$i]) + strlen($item->fullmessage) > $maxSize) {
                $i++;
                $content[$i] = "";
            }
            $content[$i] .= " ".$item->fullmessage;
        }


        // получаем массив всех слов
        $words = [];
        foreach ($content as $item) {
            $words = array_merge($words, mb_split("\s", $item));
        }
        $words = array_map('mb_strtolower', $words);

        $result["amount_comments"] = count($comments);
        $result["amount_words"] = count($words);
        $result["values"] = [];

        // считаем вхождения определенных слов
        foreach ($this::WORDS as $word) {
            $checkInside = preg_grep("/{$word}/", $words);
            if ($checkInside)
                $result["values"][$word] = count($checkInside);
        }

        return $result;
    }

    private function getTimeCondition ($field, &$queryParams, $dateStart = null, $dateFinish = null) {
        if ($dateStart and !$dateFinish) {
            $dateCondition = " AND {$field} > ?";
            $queryParams[] = strtotime($dateStart);
        } else if (!$dateStart and $dateFinish) {
            $dateCondition = " AND {$field} < ?";
            $queryParams[] = strtotime($dateFinish);
        } else if ($dateStart and $dateFinish) {
            $dateCondition = " AND {$field} BETWEEN ? AND ?";
            $queryParams[] = strtotime($dateStart);
            $queryParams[] = strtotime($dateFinish);
        }

        return $dateCondition;
    }
}