<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 15.11.2017
 * Time: 13:24
 */

namespace Core\model;

use PDO;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/core/lib/notorm-master/NotORM.php");


class FileWriteBase {
  private $bd;
  private $config;
  function __construct() {
    $param = $_ENV['env'];
    $this->driver = $param['driver'];
    $this->port = $param['port'];
    $this->database = $param['database'];
    $this->username = $param['username'];
    $this->user = $param['host'];
    $this->password = $param['password'];

  }
  function baseFactory($base){

  }
  function entryToDatabase($base){
    new \NotORM(new PDO($this->driver . $database, $user, $password));

  }
}