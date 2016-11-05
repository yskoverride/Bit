<?php

namespace Bit\Core\Database;


class QueryBuilder
{
    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection  = $connection;
    }

    /**
     * Selects and returns all columns & rows
     * @param  string $table [tablename]
     * @return Array [fetched rows as Object property]
     */
    public function selectAll($table)
    {
        $statement = $this->connection->prepare("SELECT * FROM {$table}");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);

    }

    /**
     * Selects and returns all rows of sepcific columns
     * @param  mixed $parameters [columns of table]
     * @param  string $table     [tablename]
     * @return array             [fetched rows as Object property]
     */
    public function select($table,$parameters)
    {

        if (is_array($parameters)) {

          $query = sprintf(

                    'select %s from %s',

                    implode(', ',$parameters),

                    $table

                  );
        }
        elseif (is_string($parameters)) {

          $query = sprintf('select %s from %s',$parameters,$table);

        }
        else
        {
          throw new \Exception("Parameters must be of type string or array");
        }



        try {

            $statement  = $this->connection->prepare($query);

            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_OBJ);

        } catch (\Exception $e) {

          echo $e->getMessage();

        }
    }

    /**
     * Inserts values to table
     * @param  string $table      [tablename]
     * @param  array $parameters [values to be inserted]
     * @return NULL
     */
    public function insert($table, $parameters)
    {

      if (! is_array($parameters))

      throw new \Exception("Parameters must be of type array []");


        $query = sprintf(

                    'insert into %s (%s) values (%s)',

                    $table,

                    implode(', ', array_keys($parameters)),

                    ':' . implode(', :', array_keys($parameters))

                    );

        try {

            $statement  = $this->connection->prepare($query);

            $statement->execute($parameters);

        } catch (\Exception $e) {

          echo $e->getMessage();

        }


    }


    /**
     * Prepares SQl Query
     * @param  string $query [Raw SQl query]
     * @return Object        [PDO Object]
     */
    protected function prepare($query)
    {

      $statement = $this->connection->prepare($query);

      return $statement;

    }


    /**
     * Executes SQl Query
     * @param  string $query    [Raw SQl query]
     * @param  array $clauses   [Clauses]
     * @return Object           [PDO Object]
     */
    public function query($query, $clauses = [])
    {
        $result = $this->prepare($query);

        if(! is_array($clauses))

        throw new \Exception("Clauses must be of type array []");

        $result->execute($clauses);

        return $result->fetchAll(\PDO::FETCH_OBJ);
    }
}
