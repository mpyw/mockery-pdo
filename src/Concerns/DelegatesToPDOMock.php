<?php

namespace Mpyw\MockeryPDO\Concerns;

use Mockery\MockInterface;
use PDO;

trait DelegatesToPDOMock
{
    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
     */
    abstract protected function getPDOMock(): MockInterface;

    /**
     * @param  string             $statement
     * @param  null|array         $options
     * @return bool|\PDOStatement
     */
    public function prepare($statement, $options = null)
    {
        return $this->getPDOMock()->prepare(...func_get_args());
    }

    /**
     * @throws \PDOException
     * @return bool
     */
    public function beginTransaction()
    {
        return $this->getPDOMock()->beginTransaction();
    }

    /**
     * @return bool
     */
    public function commit()
    {
        return $this->getPDOMock()->commit();
    }

    /**
     * @throws \PDOException
     * @return bool
     */
    public function rollBack()
    {
        return $this->getPDOMock()->rollBack();
    }

    /**
     * @return bool
     */
    public function inTransaction()
    {
        return $this->getPDOMock()->rollBack();
    }

    /**
     * @param  int   $attribute
     * @param  mixed $value
     * @return bool
     */
    public function setAttribute($attribute, $value)
    {
        return $this->getPDOMock()->setAttribute($attribute, $value);
    }

    /**
     * @param  string    $statement
     * @return false|int
     */
    public function exec($statement)
    {
        return $this->getPDOMock()->exec($statement);
    }

    /**
     * @param  string              $statement
     * @param  int                 $mode
     * @param  mixed               $fetchModeArgs
     * @return false|\PDOStatement
     */
    public function query(string $statement, ?int $mode = PDO::ATTR_DEFAULT_FETCH_MODE, mixed ...$fetchModeArgs)
    {
        $arg3 = $fetchModeArgs[0] ?? null;
        $ctorArgs = $fetchModeArgs[1] ?? [];
        return $this->getPDOMock()->query($statement, $mode, $arg3, $ctorArgs);
    }

    /**
     * @param  null|string $name
     * @return string
     */
    public function lastInsertId($name = null)
    {
        return $this->getPDOMock()->lastInsertId(...func_get_args());
    }

    /**
     * @return mixed
     */
    public function errorCode()
    {
        return $this->getPDOMock()->errorCode();
    }

    /**
     * @return array
     */
    public function errorInfo()
    {
        return $this->getPDOMock()->errorInfo();
    }

    /**
     * @param  int   $attribute
     * @return mixed
     */
    public function getAttribute($attribute)
    {
        return $this->getPDOMock()->getAttribute($attribute);
    }

    /**
     * @param  string       $string
     * @param  int          $type
     * @return false|string
     */
    public function quote($string, $type = PDO::PARAM_STR)
    {
        return $this->getPDOMock()->quote(...func_get_args());
    }

    /**
     * @param  string   $functionName
     * @param  callable $callback
     * @param  int      $numArgs
     * @param  int      $flags
     * @return bool
     */
    public function sqliteCreateFunction($functionName, $callback, $numArgs = -1, $flags = 0)
    {
        return $this->getPDOMock()->sqliteCreateFunction(...func_get_args());
    }
}
