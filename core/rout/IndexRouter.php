<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 22.10.17
 * Time: 14:07
 */

namespace Core\rout;


class IndexRouter extends Router {

  function registerRouter() {

    $this->app->get('/', function ($request, $response, $args) {
      $response->getBody()->write('rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr');
      return $response;
    });

  }
}