<?php
namespace Bit\Models;

use Bit\Core\App;
use Bit\Helpers\Helpers;

/**
 * BaseModel class
 */
abstract class BaseModel
{
  /**
   * Where Clauses String
   * @var string
   */
  protected $whereClause;

  /**
   * Update Clauses String
   * @var string
   */
  protected $updateClause;


  /**
   * Model table name
   * @return NULL
   */
  protected abstract function table();



  /**
   * Creates Intermediate Update Clause
   * @param  array $conditions [associative array of
   *                           columns and values]
   * @return string            [Intermediate Update Clause]
   */
  private function getUpdateClause($conditions =  [])
  {
    if(! Helpers::is_associative($conditions))
    throw new \Exception("Conditions must be an Associative Array");

    foreach ($conditions as $column => $value) {

      if( $value === end($conditions) ){

        $this->updateClause .= $column . '= :' .$column;
        break;
      }

      $this->updateClause .= $column . '= :' .$column . ' , ';

    }

    return $this->updateClause;

  }



  /**
   * Creates Intermediate Where Clause
   * @param  array $conditions [associative array of
   *                           columns and values]
   * @return string            [Intermediate Where Clause]
   */
  private function getWhereClause($conditions = [])
  {
    if(! Helpers::is_associative($conditions))
    throw new \Exception("Conditions must be an Associative Array");

    foreach ($conditions as $column => $value) {

      if( $value === end($conditions) ){

        $this->whereClause .= $column . '= :' .$column;
        break;
      }

      $this->whereClause .= $column . '= :' .$column . ' and ';

    }

    return $this->whereClause;
  }



  /**
   * Finds all records by provided conditions
   * @param  array $conditions [associative array of
   *                           columns and values]
   * @return Object           [PDO Object]
   */
  final function find($conditions=[])
  {

      $statement = sprintf('select * from %s where %s',
                          $this->table(),
                          $this->getWhereClause($conditions)
                        );

    return App::get('database')->query($statement, $conditions);
  }



  /**
   * Finds first record by provided conditions
   * @param  array $conditions [associative array of
   *                           columns and values]
   * @return Object           [PDO Object]
   */
  final function findFirst($conditions=[])
  {
    return $this->find($conditions)[0];
  }



  /**
   * Returns all rows from table
   * @return array [PDO Objects]
   */
  final function findAll()
  {
    return App::get('database')->selectAll($this->table());
  }



  /**
   * Saves rows into table
   * @param  array $values [associative array of
   *                        columns and values]
   */
  final function save($values = [])
  {
      App::get('database')->insert($this->table(),$values);
  }



  /**
   * Update rows as per given conditions
   * @param  array $values      [associative array of
   *                            columns and values]
   * @param  array $conditions [associative array of
   *                           columns and values]
   * @return NULL
   */
  final function update($values= [] , $conditions=[])
  {

    $statement = sprintf('update %s set %s where %s',
                            $this->table(),
                            $this->getUpdateClause($values),
                            $this->getWhereClause($conditions)
                          );

    App::get('database')->query($statement,
                                array_merge($values, $conditions));

  }

  /**
   * Delete from table based on conditions
   * @param  [type] $conditions [associative array of
   *                            columns and values]
   * @return NULL
   */
  final function delete($conditions=[])
  {
      $statement = sprintf('delete from %s where %s',
                            $this->table(),
                            $this->getWhereClause($conditions));
                            
      App::get('database')->query($statement,$conditions);
  }


}
