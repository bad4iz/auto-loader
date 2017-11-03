<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 03.11.2017
 * Time: 11:51
 */

namespace Core\rout\customer;


use Core\rout\Router;

class AdminRouter extends Router {

  /**
   * @param $app
   * @return bool
   */
  function registerRouter() {
    $this->app->get('/admin', function ($request, $response, $args) {
      return $this->view->render($response, 'pages/admin.twig', [
        'name' => 'name'
      ]);
    });
  }
}
