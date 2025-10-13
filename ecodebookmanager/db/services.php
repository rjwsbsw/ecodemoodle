<?php
$functions = array(
    'local_ecodebookmanager_delete_book' => array(         //web service function name
        'classname'   => 'local_ecodebookmanager_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'delete_book',          //external function name
        'classpath'   => 'local/ecodebookmanager/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
        'description' => 'Deletes a book',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls.
        'capabilities' => '', // comma separated list of capabilities used by the function.
    ),
);
