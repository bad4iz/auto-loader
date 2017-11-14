<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 08.11.17
 * Time: 13:04
 */

namespace Core\model;


use PDO;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/core/lib/notorm-master/NotORM.php");

class LogisticModel {
  private $pdo;
  static private $_instance;

  private function __construct() {
    $param = $_ENV['env'];

    $dns = $param['dnsPDOCore'];
    $user = $param['userPDOCore'];
    $pass = $param['passPDOCore'];

    $this->connectPDO($dns, $user, $pass);
  }
  static function getInstance() {
    if (!self::$_instance) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  private function connectPDO($dns, $user, $pass) {
    try {
      $this->pdo = new \PDO($dns, $user, $pass);
      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOExceptionption $e) {
      //Выводим сообщение об исключении.
      var_dump($e->getCode() . ":" . $e->getMessage());
    }
  }
  function getNotOrm (){
    return new \NotORM($this->pdo);
  }

  function query($sql) {
    $param = $_ENV['env'];

    $dns = $param['dnsPDOCore'];
    $user = $param['userPDOCore'];
    $pass = $param['passPDOCore'];
    $db = new PDO($dns, $user, $pass);
    return $db->query($sql, PDO::FETCH_ASSOC)->fetchAll();
  }

  function exec($sql) {
    $param = $_ENV['env'];

    $dns = $param['dnsPDOCore'];
    $user = $param['userPDOCore'];
    $pass = $param['passPDOCore'];
    $db = new PDO($dns, $user, $pass);
    return $db->exec($sql);
  }


}