<?php

namespace wfm;

use Exception;

class Router
{
  protected static array $routes = [];
  protected static $route = '';


  public static function add($regexp, $route = [])
  {
    self::$routes[$regexp] = $route;
  }

  public static function getRoutes()
  {
    return self::$routes;
  }

  public static function getRoute()
  {
    return self::$route;
  }

  public static function removeParamsFromUrl($str)
  {
    if ($str) {
      $arr = explode('?', $str, 2);
      return rtrim($arr[0], '/');
    }
    return '';
  }

  public static function dispatch($url)
  {
    //Если в REQUEST_URI есть get параметры, избавляюсь от них вызывая соответствующий метод
    $url = self::removeParamsFromUrl($url);
    if (self::matchRoute($url)) {
      //
      $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';
      if (class_exists($controller)) {
        $controllerObj = new $controller(self::$route);

        $controllerObj->getModel();

        $action = self::lowerCamelCase(self::$route['action']  . 'Action');

        if (method_exists($controllerObj, $action)) {
          $controllerObj->$action();
          $controllerObj->getView();
        } else {
          throw new Exception("Метод " . self::$route['action'] . "Action" . " не найден", 404);
        }
      } else {
        throw new Exception("Контроллер {$controller} не найден", 404);
      }
    } else {
      throw new Exception('Страница не найдена', 404);
    }
  }

  public static function matchRoute($url): bool
  {
    foreach(self::$routes as $pattern => $route) {
      //$pattern - шаблон  регулярного выражежения
      if (preg_match("#{$pattern}#", $url, $matches)) {
        foreach($matches as $k => $v) {
          if (is_string($k)) {
            $route[$k] = $v;
          }
        }
        if (empty($route['action'])) {
          $route['action'] = 'index';
        }
        if (!isset($route['admin_prefix'])) {
          $route['admin_prefix'] = '';
        } else {
          $route['admin_prefix'] .= '\\';
        }
        $route['controller'] = self::upperCamelCase($route['controller']);
        self::$route = $route;
        return true;
      }
    }
    return false;
  }

  protected static function upperCamelCase($name): string
  {
    $name = str_replace('-', ' ', $name);
    $name = ucwords($name);
    $name = str_replace(' ', '', $name);
    
    return $name;
  }

  protected static function lowerCamelCase($name): string
  {
    return lcfirst(self::upperCamelCase($name));
  }
}

?>