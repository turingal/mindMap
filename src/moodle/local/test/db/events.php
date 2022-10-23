<?
defined('MOODLE_INTERNAL') || die();

    $observers = array(
        array(
            'eventname' => 'core\event\user_loggedin',
            'callback' => 'local_test_observer::user_loggedin',
        ),
        array(
            'eventname' => 'core\event\user_loggedout',
            'callback' => 'local_test_observer::user_loggedin',
        ),
    );
