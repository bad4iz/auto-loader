<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 22.10.17
 * Time: 14:02
 */

namespace Core\rout;

/**
 * Interface IRouter
 * @package myClass\rout
 */
interface IRouter {
  /**
   * @param $app
   * @return bool
   */
  function registerRouter();
}