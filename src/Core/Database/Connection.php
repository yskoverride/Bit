<?php

namespace Bit\Core\Database;

class Connection
{

    /**
     * Creates a new Database Connection
     * @param  string $configs   database configurations
     * @return PDO               new Instance of \PDO
     */
    public static function connectToDB($configs)
    {
      try {

        return new \PDO(

                    $configs['dbdriver'].':
                    dbname='.$configs['dbname'].';
                    host='.$configs['host'].';',
                    $configs['username'],
                    $configs['password'],
                    $configs['options']

                        );

      } catch (\PDOException $e) {

        echo $e->getMessage();
      }
    }
}
