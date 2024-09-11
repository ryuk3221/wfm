<?php
use wfm\App;
use wfm\Router;

if (PHP_MAJOR_VERSION < 8) {
  die('Необходима версия PHP 8.0');
}

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require CONFIG . '/routes.php';

new App();

debug(Router::getRoutes());

?>