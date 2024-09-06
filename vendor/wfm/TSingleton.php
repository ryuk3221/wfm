<?php
namespace wfm;

trait TSingleton
{
  private static $instance = null;

  private function __construct()
  {

  }

  public static function getInstance(): static
  {
    return static::$instance ?? static::$instance = new static();
  }
}

?>