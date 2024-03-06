<?php

namespace Mvc\Models;

use PDO;

abstract class MysqlRepository
{
  private static $connect = null;

  public static function getConnect(
    $servername,
    $username,
    $password,
    $dbname
  ) {
    if (!is_null(self::$connect)) {
      return self::$connect;
    }
    self::$connect = new PDO(
      "mysql:host={$servername};dbname={$dbname}",
      $username,
      $password,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    return self::$connect;
  }
}
