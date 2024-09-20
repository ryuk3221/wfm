<?php
namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{

  public function indexAction() {
    $this->setMeta('Главная страница', 'Description', 'Keywords...');
    $this->set(['dota 2', 'cs go']);
  }


};

?>