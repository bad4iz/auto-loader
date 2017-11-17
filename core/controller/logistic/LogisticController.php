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
    return $this->bd->no_logistics()->insert(['keyFile' => $key, 'date' => time()]);
  }

  /**
   * проверка записи key в логистик
   * @param $key
   * @return bool
   */
  private function isLogistic($key) {
    $answer = $this->bd->logistics()->where("keyFile", $key);
    return !!count($answer);
  }

  /**
   * @param $key
   * если нет в логистике то пишется в нологистик
   */
  function register($key) {
    if (!$this->isLogistic($key)) {
      return $this->setNoLogistic($key);
    }else {
      return true;
    }
    return false;
  }

  function getNoLogistic() {
    $answer = [];
    foreach ($this->bd->no_logistics() as $id => $row){
      $answer[] = $row;
    }
    return $answer;
  }

  function getLogistic() {
    $answer = [];
    foreach ($this->bd->logistics() as $id => $row){
      $answer[] = $row;
    }
    return $answer;
  }

  /**
   * перенос с нологистик в логистик
   * @param $arr
   * @return string
   *
   * USE [test]
   *
   *   CREATE TABLE [dbo].[logistics](
   *   [keyFile] [varchar](50) NULL,
   *   [db] [varchar](50) NULL,
   *   [tableBd] [varchar](50) NULL,
   *   [struct] [varchar](50) NULL,
   *   [diskription] [varchar](50) NULL,
   *   [statusbd] [varchar](50) NULL
   *   ) ON [PRIMARY]
   *
   */
  function setLogistic($arr){
    if($this->isTable($arr['db'],$arr['tableBd'])) {
      return false;
    }
    $logisticModel = LogisticModel::getInstance();


    $key = $arr['keyFile'];

    $fields = [];
    $struct = trim( $arr['struct'], ';');
    $fields = explode(";",  $struct);

    $sql = "USE [". $arr['db'] ."]
            CREATE TABLE [dbo].[". $arr['tableBd'] ."](";

    foreach ($fields as $value){
      $sql .= "[" . $value . "] [varchar](50) NULL,";
    }
    $sql = trim($sql, ',');
    $sql .= ") ON [PRIMARY]";
    $logisticModel->exec($sql);

    if($this->isTable($arr['db'],$arr['tableBd'])){
      if (!$this->isLogistic($key)) {
        $this->bd->logistics()->insert($arr);
      }
      if ($this->isLogistic($key)) {
        $row =  $this->bd->no_logistics()->where("keyFile", $key);
        return $row->delete();
      }
    }
  }

   private function isTable($dateBase, $table){
    $sql = " SELECT OBJECT_ID(N'".$dateBase ."..". $table ."') AS 'table';";
    $logisticModel = LogisticModel::getInstance();
    return  $logisticModel->queryOne($sql)['table'];
  }

  /**
   * обработка файла по ключу
   * @param $key
   * @param $fileName
   */
  function setFile($key, $fileName){
    $fileParseModel = new FileParseController();
    $fileParseModel->logisticFile($key, $fileName );
  }


}