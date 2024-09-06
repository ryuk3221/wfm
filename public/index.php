<?php

use wfm\App;

if (PHP_MAJOR_VERSION < 8) {
  die('Необходима версия PHP 8.0');
}

require_once dirname(__DIR__) . '/config/init.php';

new App();

throw new Exception('Произошла ошибка');

?>