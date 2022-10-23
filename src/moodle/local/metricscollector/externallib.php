<?php
require_once($CFG->libdir . "/externallib.php");
require_once("utils.php");

class local_metricsCollectorAPI extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function createRecord_parameters() {
        return new external_function_parameters(
        // a external_description can be: external_value, external_single_structure or external_multiple structure
            array(
                'metricCode' => new external_value(PARAM_RAW, 'Metric code'),
                'metricValue' => new external_value(PARAM_RAW, 'Metric value'),
            )
        );
    }

    /**
     * The function itself
     * @param $metricCode
     * @param $metricValue
     * @return string
     * @throws coding_exception
     * @throws invalid_parameter_exception
     * @throws moodle_exception
     */
    public static function createRecord($metricCode, $metricValue) {
        if (!isloggedin() or isguestuser())
            throw new Exception('Login user required (not guest)');

        //Parameters validation
        $params = self::validate_parameters(
            self::createRecord_parameters(),
            array(
                'metricCode' => $metricCode,
                'metricValue' => $metricValue,
            )
        );

        // Choose handler
        $handler = get_metric_handler($params['metricCode'], $params['metricValue']);

        if ($handler) {
            return $handler->getResult();
        } else {
            return "Fail";
        }
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function createRecord_returns() {
        return new external_value(PARAM_TEXT, 'Only text');
    }

}
