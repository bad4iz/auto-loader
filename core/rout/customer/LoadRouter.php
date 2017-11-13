<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 01.11.17
 * Time: 14:12
 */

namespace Core\rout\customer;


use Core\controller\logistic\LogisticController;
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
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
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
     * логика регистрации
     */
    $this->app->get('/load/{name}', function ($request, $response, $args) {
      $logisticController = new LogisticController();

      return $response->write(var_dump($logisticController->register($args['name'])));
    })->setName("ticket-detail");

    /**
     * получение новой логистик записи
     */
    $this->app->post('/load/setLogistic', function ($request, $response, $args) {
      $logisticController = new LogisticController();

      return $response->write($logisticController->setLogistic($_POST));
    });


  }
}