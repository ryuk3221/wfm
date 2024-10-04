<?php

namespace app\widgets\Language;
use RedBeanPHP\R;
use wfm\App;

class Language {

  protected $tpl;
  protected $languages;
  protected $lang;

  public function __construct() {
    $this->tpl = __DIR__ . '/lang_tpl.php';
    $this->run();
  }

  protected function run() {
    $this->languages = App::$app->getProperty('languages');
    $this->lang = App::$app->getProperty('language');
    echo $this->getHtml();
  }

  public static function getLanguages() {
    return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
  }

  public static function getLanguage($languages) {
    $lang = App::$app->getProperty('lang');
    
    if ($lang && array_key_exists($lang, $languages)) {
      $key = $lang;
    }    
    else if (!$lang) {
      $key = key($languages);
    }
    else {
      throw new \Exception("Not found language {$lang}", 404);
    }
    $lang_info = $languages[$key];
    $lang_info['code'] = $key;
    return $lang_info;
  }

  protected function getHtml():string
   {
    ob_start();
    require $this->tpl;
    return ob_get_clean();
  }
}

?>