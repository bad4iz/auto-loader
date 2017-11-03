<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 22.10.17
 * Time: 18:58
 */

namespace Core\controller;

use Core\rout\FactoryRouter;

/**
 * Главный Контроллер
 * Class FrontController
 * @package MyClass\contoroller
 */
class FrontController {
  protected $_router, $_action, $_params;
  static $_instance;

  public static function getInstance() {
    if(!(self::$_instance instanceof self))
      self::$_instance = new self();
    return self::$_instance;
  }

  /**
   * FrontController constructor.
   */
  private function __construct() {
    $request = $_SERVER['REQUEST_URI'];
    $splits = explode('/', trim($request,'/'));

    //Какой rout использовать?
    $this->_router = !empty($splits[0]) ? ucfirst($splits[0]).'Router' : 'IndexRouter';
    //Какой action использовать?
    $this->_action = 'registerRouter';

  }

  /**
   * @param \Slim\App $app
   * @throws \Exception
   */
  public function routeInitialize(\Slim\App $app) {
    $this->_params = $app;

    if($this->fileExist()) {
      $rc = new \ReflectionClass($this->getRouter());
      if($rc->implementsInterface('\Core\rout\IRouter')) {
        if($rc->hasMethod($this->getAction())) {
          $router = $rc->newInstance();
          $method = $rc->getMethod($this->getAction());
          $method->invoke($router);
        } else {
          throw new \Exception("Action");
        }
      } else {
        throw new \Exception("Interface");
      }
    } else {
      throw new \Exception("Router");
    }
  }

  /**
   * Получаем параметры
   * @return mixed
   */
  public function getParams() {
    return $this->_params;
  }

  /**
   * получаем роутер
   * @return string
   */
  private function getRouter() {
    $factory = new FactoryRouter();
    return $factory->getRouter($this->_router);

  }

  /**
   * получаем метод
   * @return string
   */
  private function getAction() {
    return $this->_action;
  }

  /**
   * проверяем существование класса
   * @return bool
   */
  private function fileExist() {
    return class_exists($this->getRouter());
  }
}