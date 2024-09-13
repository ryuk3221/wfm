<?php

namespace wfm;

abstract class Controller
{
  public $route;
  public array $data = [];
  public array $meta = [
    'title' => '',
    'desc' => '',
    'keywords' => ''
  ];
  public false|string $layout = '';
  public string $view = '';
  public object $model;
  
  public function __construct($route = []) {
    $this->route = $route;
  }
} 

?>