<?php

namespace wfm;

class ErrorHandler
{
  public function __construct()
  {
    if (DEBUG) {
      error_reporting(-1);
    } else {
      error_reporting(0);
    }

    set_exception_handler([$this, 'exceptionHandler']);
    set_error_handler([$this, 'errorHandler']);
    ob_start();
    register_shutdown_function([$this, 'fatalErrorHandler']);
    // echo "Подтянулся класс ErrorHandler";
  }

  public function exceptionHandler(\Throwable $e)
  {
    $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
    $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getLine());
  }

  protected function logError($message = '', $file = '', $line = '')
  {
    file_put_contents(
      LOGS . '/errors.log',
      "[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n===============\n",
      FILE_APPEND
    );
  }

  protected function displayError($errno, $errstr, $errfile, $errline, $responce = 500)
  {
    if ($responce == 0) {
      $responce = 404;
    }

    http_response_code($responce);
    if ($responce == 404 && !DEBUG) {
      require WWW . '/errors/404.php';
      die;
    }
    if (DEBUG) {
      require WWW . '/errors/development.php';
    } else {
      require WWW . '/errors/prodaction.php';
    }
    die;
  }

  public function errorHandler($errno, $errstr, $errFile, $errLine)
  {
    $this->logError($errstr, $errFile, $errLine);
    $this->displayError($errno, $errstr, $errFile, $errLine);
  }

  public function fatalErrorHandler()
  {
    $error = error_get_last();
    if (!empty($error && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))) {
      $this->logError($error['message'], $error['file'], $error['line']);
      ob_end_clean();
      $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
    } else {
      ob_end_flush();
    }
  }
}

?>

