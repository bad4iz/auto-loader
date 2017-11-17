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
  public $database, $struct;

  private $config, $driver, $host, $port, $username, $password;
  function __construct($key) {
    // sqlsrv:Server=localhost,1433;Database=test
    $param = $_ENV['env'];
    $this->driver = $param['driver'];
    $this->host = $param['host'];
    $this->port = $param['port'];
    $this->username = $param['username'];
    $this->password = $param['password'];
    $ar = $this->getDatabaseAndTable($key);
    $this->struct = $ar['struct'];
    $table = $ar['tableBd'];
    $this->database = $this->baseFactory($ar['db'])->$table();

  }
  private function baseFactory($base){
    return new \NotORM(new PDO($this->driver . $this->host . "," . $this->port .";" . 'Database=' . $base  , $this->username,  $this->password ));
  }

  /**
   * возвращает массив по ключу
   * @param $key ключ
   * @return array
   */
  private function getDatabaseAndTable($key){
    $answer = [];
    $logisticModel = LogisticModel::getInstance()->getNotOrm();
    foreach ($logisticModel->logistics()->where('keyFile' , $key)[0] as $key => $value) {
      $answer[$key] = $value;
    }
    return $answer;
  }
}