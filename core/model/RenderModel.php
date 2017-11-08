<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 08.11.17
 * Time: 11:17
 */

namespace Core\model;


class RenderModel {

  public function render($file) {
    ob_start();
    include( $_SERVER['DOCUMENT_ROOT'] . '/' . $file );
    return ob_get_clean();
  }

  function readFile($file){
    return file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $file ,  FILE_USE_INCLUDE_PATH);
  }

}
