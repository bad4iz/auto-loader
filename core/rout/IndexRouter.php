<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 22.10.17
 * Time: 14:07
 */

namespace Core\rout;


use Core\model\RenderModel;

class IndexRouter extends Router {

  function registerRouter() {

    $this->app->get('/', function ($request, $response, $args) {
      $renderModel = new RenderModel();
      $response->getBody()->write( $renderModel->renderAndOverwritePaths('link/client/dist/index.html') );
      return $response;
    });

  }
}

