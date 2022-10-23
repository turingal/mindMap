<?php
require_once($CFG->libdir . "/externallib.php");

class local_test_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function hello_world_parameters() {
        // FUNCTIONNAME_parameters() always return an external_function_parameters().
        // The external_function_parameters constructor expects an array of external_description.
        return new external_function_parameters(
        // a external_description can be: external_value, external_single_structure or external_multiple structure
            array('username' => new external_value(PARAM_RAW, 'User Name'))
        );
    }

    /**
     * The function itself
     * @return string welcome message
     * @throws invalid_parameter_exception
     */
    public static function hello_world($username) {

        //Parameters validation
        $params = self::validate_parameters(self::hello_world_parameters(),
            array('username' => $username));

        //Note: don't forget to validate the context and check capabilities
        $returnedvalue = "Hello, ".$username;

        return $returnedvalue;
    }

    /**
     * Returns description of method result value
     * @return void
     */
    public static function hello_world_returns() {
        //return new external_multiple_structure(
            new external_value(PARAM_TEXT, 'User greeting');
        //);
    }



}