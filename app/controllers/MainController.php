<?php
namespace app\controllers;

use wfm\Controller;
use RedBeanPHP\R;


/** @property Main $model */
class MainController extends Controller
{

  public function indexAction() {
    $names = $this->model->get_names();
    $one_name = R::getRow('SELECT * FROM name WHERE id = 2');
    $this->setMeta('Главная страница', 'Description', 'Keywords...');
    $this->set(compact('names'));
  }

  
};

?>