<?php

function __autoload($className){
    $filePath = "src/{$className}.php";
    if( file_exists($filePath) && is_readable($filePath) ){
        require($filePath);
    }
}
spl_autoload_register('__autoload');
