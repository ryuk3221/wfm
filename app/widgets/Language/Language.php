<?php

namespace app\widgets\Language;
use RedBeanPHP\R;

class Language {

  protected $tpl;
  protected $languages;
  protected $lang;

  public function __construct() {
    $this->tpl = __DIR__ . 'lang_tpl.php';
    $this->run();
  }

  protected function run() {

  }

  public static function getLanguages() {
    return R::getAll("SELECT * FROM language");
  }

  public static function getLanguage($languages) {

  }
}

?>