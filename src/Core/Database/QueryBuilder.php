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
     * Selects and returns all the rows
     * @param  string $table [tablename]
     * @return Object        [fetched rows as Object property]
     */
    public function selectAll($table)
    {
        $statement = $this->connection->prepare("SELECT * FROM {$table}");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);

    }

    /**
     * Inserts values to table
     * @param  string $table      [tablename]
     * @param  string $parameters [values to be inserted]
     * @return NULL
     */
    public function insert($table, $parameters)
    {
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
}
