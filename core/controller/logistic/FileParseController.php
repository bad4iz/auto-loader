<?php
/**
 * Created by PhpStorm.
 * User: bad4iz
 * Date: 15.11.2017
 * Time: 10:56
 */

namespace Core\controller\logistic;


use Core\model\FileWriteBase;
use Slim\Http\UploadedFile;


class FileParseController {
  /**
   * @param $filePath
   */
  private function parseFile($filePath, $rowKey) {

    if(!$filePath){
      return false;
    }
    $arrFile = file($filePath);

    foreach ($arrFile as $value) {
      $row = [];
      $trim = trim($value, ";");
      $value = explode(";", $trim);
      foreach ($rowKey as $index => $item) {
        $row[$item] = $value[$index];
      }
      $query[] = $row;
    }
    return $query;
  }

  /**
   * @param $key
   * @param $file
   */
  function logisticFile($key, $upFile) {
    $fileWriteBaseModel = new FileWriteBase($key);
    $rowKey = explode(";", trim($fileWriteBaseModel->struct, ';'));

    $filePath = $this->moveUploadedFile($key, $upFile);

    $answer = $fileWriteBaseModel->database->insert_multi($this->parseFile($filePath, $rowKey));

    if ($answer) {
      unlink($filePath);
      return $answer;
    }
    return $filePath;
  }

  /**
   * Moves the uploaded file to the upload directory and assigns it a unique name
   * to avoid overwriting an existing uploaded file.
   *
   * @param string $keyFile directory to which the file is moved
   * @param UploadedFile $uploaded file uploaded file to move
   * @return string filename of moved file
   */
  function moveUploadedFile($keyFile, UploadedFile $uploadedFile)
  {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = $uploadedFile->getClientFilename();

    $pathDir = 'DataFile/'.$keyFile ;
    mkdir($pathDir, 0777, true);
    $pathFile = $pathDir .'/' . $filename;
    $uploadedFile->moveTo($pathFile);
//    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    return $pathFile;
  }
}