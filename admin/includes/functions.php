<?php

function classAutoLoader($class){

    $class = strtolower($class);

    $the_path = INCLUDES_PATH . "/{$class}.php";

    if(is_file($the_path) && !class_exists($class)){

        require_once($the_path);
    } else {

        die("The file named {$class}.php was not found ....");
    }
}
function redirect($location) {

    header("Location: {$location}");
}

spl_autoload_register('classAutoLoader');

?>