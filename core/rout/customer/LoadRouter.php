<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 01.11.17
 * Time: 14:12
 */

namespace Core\rout\customer;


use Core\controller\logistic\LogisticController;
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
     * test
     */
    $this->app->get('/load/test', function ($request, $response, $args) {
      $logisticModel = LogisticModel::getInstance();
      $logisticController = new LogisticController();
//      return $response->withJSON($logisticController->setLogistic($_POST));
//      return $response->write(var_dump($logisticController->isTable($_POST['db'], $_POST['tableBd'])));
      return $response->write(d($logisticController->isTable('test_dRivg', 'testTable')));
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
     * логика регистрации
     */
    $this->app->get('/load/{name}', function ($request, $response, $args) {
      $logisticController = new LogisticController();

      return $response->withJSON($logisticController->register($args['name']));
    })->setName("ticket-detail");

    /**
     * получение новой логистик записи
     */
    $this->app->post('/load/setLogistic', function ($request, $response, $args) {
      $logisticController = new LogisticController();
      $logisticModel = LogisticModel::getInstance();
      return $response->withJSON($logisticController->setLogistic($_POST));
//      return $response->write(var_dump($logisticController->isTable($_POST['db'], $_POST['tableBd'])));
      return $response->withJSON($logisticController->isTable($_POST['db'], $_POST['tableBd']));
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
     * логика регистрации
     */
    $this->app->post('/load/{name}', function ($request, $response, $args) {
      $logisticController = new LogisticController();
      $logisticController->register($args['name']);

      $uploadedFiles = $request->getUploadedFiles();
      $uploadedFile = $uploadedFiles['file'];
      if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $filename = moveUploadedFile(dirname(__DIR__), $uploadedFile);
        return $response->withJSON('uploaded ' . $filename . '<br/>');
      }
      return $response->withJSON($uploadedFiles);
    });

    /**
     * Moves the uploaded file to the upload directory and assigns it a unique name
     * to avoid overwriting an existing uploaded file.
     *
     * @param string $directory directory to which the file is moved
     * @param UploadedFile $uploaded file uploaded file to move
     * @return string filename of moved file
     */
    function moveUploadedFile($directory,  $uploadedFile)
    {
      $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
      $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
      $filename = sprintf('%s.%0.8s', $basename, $extension);

      $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

      return $filename;
    }


  }

}

