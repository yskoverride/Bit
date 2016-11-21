<?php

namespace Bit\Core\FileHandler;

interface FileHandlerInterface {

  public function delete($path);

  public function copy($file, $destination);

  public function getextension($file);

  public function getsize($file);

  public function createDir($directory, $mode);


}
