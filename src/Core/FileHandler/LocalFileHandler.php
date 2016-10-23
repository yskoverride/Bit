<?php

namespace Bit\Core\FileHandler;

/**
 * Filehandler
 */
class LocalFileHandler implements FileHandlerInterface
{

  /**
   * get name of file
   * @param  array $file  [fileproperty array]
   * @return string       [file name]
   */
  public function getfilename($file)
  {

    if (! is_array ($file)) {

      throw new \Exception('Input value should of of type $_FILES[]');
    }

    return $file['name'];
  }

  /**
   * get name of size
   * @param  array $file  [fileproperty array]
   * @return string       [file size in KB]
   */
  public function getsize($file)
  {
    if (! is_array ($file)) {

      throw new \Exception('Input value should of of type $_FILES[]');
    }

    return $file['size'] / 1000;

  }

  /**
   * get name of extension
   * @param  array $file  [fileproperty array]
   * @return string       [file extension]
   */
  public function getextension($file)
  {
    if (! is_array ($file)) {

      throw new \Exception('Input value should of of type $_FILES[]');
    }

    $filesplit = explode('.', $file['name']);

    return strtolower(end($filesplit));
  }

  /**
   * Uploads files to its destination
   * @param  array $file  [fileproperty array]
   * @param  string $uploadpath [upload folder name]
   * @return boolean            true if file is uploaded
   */
  public function copy($file,$uploadpath)
  {

    if (! is_array ($file)) {

      throw new \Exception('Input value should of of type $_FILES[]');
    }

    if (! file_exists($uploadpath)) {

      throw new \Exception("Destination does not exist");
    }

    $new_file_path = $uploadpath .'/' .microtime() . $file['name'];

    if (! move_uploaded_file($file['tmp_name'], $new_file_path))
    {
        throw new \Exception("File could not be uploaded");
    }

    return true;
  }

  /**
   * delete a given file
   * @param  string $filepath [file to be deleted]
   * @return boolean          [true if file is deleted]
   */
  public function delete($filepath)
  {
    if (! realpath($filepath)) {

      throw new \Exception("File not found");

    }

    return unlink($filepath);

  }

  /**
   * Creates a new directory
   * @param  string  $directory [directory path]
   * @param  integer $mode      [directory mode]
   * @return boolean            [true if directory is created]
   */
  public function createDir($directory, $mode = 755)
  {
     if(! file_exists($directory))
     {
       return (mkdir($directory, $mode));
     }

     throw new \Exception("Folder already exists");
  }


}
