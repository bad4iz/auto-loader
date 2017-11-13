<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 01.11.17
 * Time: 14:26
 */

namespace Core\rout\customer;


use Core\rout\Router;

class TestProjectRouter extends Router {


    /**
     * @param $app
     * @return bool
     */
    function registerRouter() {
      $this->app->get('/testProject/{name}', function ($request, $response, $args) {
        return $response->write("Hello " . $args['name']);
      });
    }

}