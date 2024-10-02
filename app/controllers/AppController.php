<?php

namespace app\controllers;

use app\widgets\Language\Language;
use app\models\AppModel;
use wfm\Controller;
use wfm\App;


class AppController extends Controller {

  public function __construct($route) {
    parent::__construct($route);
    new AppModel();

    App::$app->setProperty('languages', Language::getLanguages());
  }
}

?>