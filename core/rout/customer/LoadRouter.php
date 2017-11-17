<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 01.11.17
 * Time: 14:12
 */

namespace Core\rout\customer;


use Core\controller\logistic\FileParseController;
use Core\controller\logistic\LogisticController;
use Core\model\FileParse;
use Core\model\FileWriteBase;
use Core\model\LogisticModel;
use Core\rout\Router;

class LoadRouter extends Router {

  /**
   * @param $app
   * @return bool
   */
  function registerRouter() {

    /**
     * крос доменный заголовки
     */
    $this->app->add(function ($req, $res, $next) {
      $response = $next($req, $res);
      return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    });

    /**
     * отдать но логистик
     */
    $this->app->get('/load/getNoLogistic', function ($request, $response, $args) {
      $logisticController = new LogisticController();
      return $response->withJSON($logisticController->getNoLogistic());
    });

    /**
     * отдать логистик
     */
    $this->app->get('/load/getLogistic', function ($request, $response, $args) {
      $logisticController = new LogisticController();
      return $response->withJSON($logisticController->getLogistic());
    });

    /**
     * получение
     */
    $this->app->get('/load/getDataBase', function ($request, $response, $args) {
      $logisticModel = LogisticModel::getInstance();

      return $response->withJSON($logisticModel->query('SELECT name, crdate FROM sysdatabases WHERE  CHARINDEX(\'_Rivg\', name) > 0'));
    });


    /**
     * получение новой логистик записи
     */
    $this->app->post('/load/setLogistic', function ($request, $response, $args) {
      $logisticController = new LogisticController();
      return $response->withJSON($logisticController->setLogistic($_POST));
    });

    /**
     * получение
     */
    $this->app->post('/load/setDataBase', function ($request, $response, $args) {
      $logisticModel = LogisticModel::getInstance();

      $base = $_POST['base'];
      $sql = "CREATE DATABASE [".$base."] CONTAINMENT = NONE ON  PRIMARY( NAME = N'".$base."', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL13.MSSQLSERVER\MSSQL\DATA\\".$base . ".mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )";
      $logisticModel->exec($sql);
      return $response->withJSON($logisticModel->query('SELECT name, crdate FROM sysdatabases WHERE  CHARINDEX(\'_Rivg\', name) > 0'));
    });


    /**
     * логика регистрации и обработки файла
     */
    $this->app->post('/load/{name}', function ($request, $response, $args) {
      $logisticController = new LogisticController();
      if( $logisticController->register($args['name'])){ // если зарегистрирован ключ
        $fileParseModel = new FileParseController();

        foreach ($request->getUploadedFiles() as $uploadedFile){
          if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            return $response->withJSON($fileParseModel->logisticFile($args['name'], $uploadedFile));
          }
        }
      }
      return $response->withJSON(000);
    });

    //////////////// delete ////////////////////////////////////

    /**
     * test
     */
    $this->app->get('/load/test', function ($request, $response, $args) {
      $fileParseModel = new FileParse();
//      $fileWriteBaseModel = new FileWriteBase('./testKey');
      return $response->withJSON($fileParseModel->logisticFile('testKey', './test.txt' ));
      return $response->withJSON($fileWriteBaseModel->database->insert(['date'=>'000']));
//      return $response->write(var_dump($logisticController->isTable($_POST['db'], $_POST['tableBd'])));
//      return $response->write(d($logisticController->isTable('test_dRivg', 'testTable')));
    });

    /**
     * логика регистрации
     */
    $this->app->get('/load/{name}', function ($request, $response, $args) {
      $logisticController = new LogisticController();

      return $response->withJSON($logisticController->register($args['name']));
    })->setName("ticket-detail");


    //////////////// delete ////////////////////////////////////


  }

}

