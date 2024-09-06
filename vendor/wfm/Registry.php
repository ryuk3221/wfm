<?php

namespace wfm;

class Registry
{
  use TSingleton;

  protected static array $props = [];

  public function setProperty($name, $value)
  { 
    self::$props[$name] = $value;
  }

  public function getProperty($name, $value) {
    return self::$props[$name] ?? null;
  }

  public function getProperties(): array {
    return self::$props;
  }
}
?>