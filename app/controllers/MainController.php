<?php
namespace app\controllers;

use RedBeanPHP\R;


/** @property Main $model */
class MainController extends AppController
{

  public function indexAction() {
    //Получаю с бд слайдер
    $slides = R::findAll('slider');
    $this->set(compact('slides'));
  }

  
};

?>