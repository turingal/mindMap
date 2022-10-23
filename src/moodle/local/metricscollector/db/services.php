<?php

// We defined the web service functions to install.
$functions = array(
    'local_metricsCollector_createRecord' => array(
        'classname'   => 'local_metricsCollectorAPI',
        'methodname'  => 'createRecord',
        'classpath'   => 'local/metricscollector/externallib.php',
        'description' => 'Searches for and launches a metric handler',
        'type'        => 'write',
        'ajax'        => true,
    )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
    'local_metricscollector_service' => array(
        'functions' => array ('local_metricsCollector_createRecord'),
        'restrictedusers' => 0,
        'shortname' => 'local_metricscollector',
        'enabled'=>1,
    )
);