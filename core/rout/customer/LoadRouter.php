<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 01.11.17
 * Time: 14:12
 */

namespace Core\rout\customer;


use Core\rout\Router;

class TestRouter extends Router {

  /**
   * @param $app
   * @return bool
   */
  function registerRouter() {
    $this->app->get('/test/{name}', function ($request, $response, $args) {
      return $response->write("Hello " . $args['name']);
    })->setName("ticket-detail");
  }
}