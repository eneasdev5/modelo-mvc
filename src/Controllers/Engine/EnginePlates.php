<?php

namespace Mvc\Controllers\Engine;

use League\Plates\Engine;

/**
 * Responsible for rendering the web page
 * EnginePlates::view();
 */
abstract class EnginePlates
{
  private static $instance;

  /**
    * Render the View
    */
  public static function view(string $view, array $data =[]): string {
    $source = dirname(__FILE__, 4)."/views/";
    self::$instance = new Engine($source);
    return self::$instance->render($view, $data);
  }
}
