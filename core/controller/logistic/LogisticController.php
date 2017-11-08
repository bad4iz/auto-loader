<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 08.11.17
 * Time: 13:47
 */

namespace Core\controller\logistic;


use Core\model\LogisticModel;

class LogisticController {
  private $bd;

  function __construct() {
    $this->bd = LogisticModel::getInstance()->getNotOrm();
  }

  /**
   * @param $key
   * запись в нологистик
   */
  private function setNoLogistic($key) {
    $this->bd->no_logistics()->insert(['keyFile' => $key, 'date' => time()]);
  }

  /**
   * проверка записи key в логистик
   * @param $key
   * @return bool
   */
  private function isLogistic($key) {
    $answer = $this->bd->logistic()->where("keyFile", $key);
    return !!count($answer);
  }

  /**
   * @param $key
   * если нет в логистике то пишется в нологистик
   */
  function register($key) {
    if (!$this->isLogistic($key)) {
      $this->setNoLogistic($key);
    }
  }

  function getNoLogistic() {
    $answer = [];
    foreach ($this->bd->no_logistics() as $id => $row){
      $answer[] = $row;
    }
    return $answer;
  }

}