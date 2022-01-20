<?php

function autoload($className = null)
{
    $className = strtr($className, ['\\' => '/']);

    if (file_exists($_SERVER['DOCUMENT_ROOT']. $className . '.php')) {
        include $_SERVER['DOCUMENT_ROOT'] . $className . '.php';
        return;
    } else {
        include_once '/'. $className.'.php';
        return;
    }
    throw new Exception('Can not load class : ' . $className);
}
spl_autoload_register('autoload');

//세션 전역으로 쓰기위하여
use hwhome\lib\controllers\loginControllers as loginControllers;

session_start();
loginControllers::home();
