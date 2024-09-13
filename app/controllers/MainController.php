<?php
namespace app\controllers;
use wfm\Controller;

class MainController extends Controller
{
  public function indexAction() {
    echo "Привет мир!";
    echo __METHOD__;
  }
};

?>