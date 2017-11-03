<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 01.11.17
 * Time: 13:50
 */

namespace Core\rout;


class FactoryRouter {
  function getRouter($router){
    switch ($router){
      case 'IndexRouter': return 'Core\rout\\' . $router;
      case 'HelloRouter': return 'Core\rout\\' . $router;
      default:
        return 'Core\rout\customer\\' . $router;
    }
  }
}