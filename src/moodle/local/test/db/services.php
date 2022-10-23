<?php

// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

// We defined the web service functions to install.
$functions = array(
    'local_test_hello_world' => array(
        'classname'   => 'local_test_external',
        'methodname'  => 'hello_world',
        'classpath'   => 'local/test/externallib.php',
        'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
        'type'        => 'read',
        'ajax'        => true,
    )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
    'local_test_service' => array(
        'functions' => array ('local_test_hello_world'),
        'restrictedusers' => 0,
        'shortname' => 'local_test',
        'enabled'=>1,
    )
);