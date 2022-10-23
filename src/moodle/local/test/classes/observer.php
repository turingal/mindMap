<?php

class local_test_observer
{
    public static function user_loggedin(core\event\base $event)
    {
        $event_data = $event->get_data();
        echo "Hello, world!<br>";
        var_dump($event_data);
        // die();
    }
}
