<?php

namespace Mpyw\MockeryPDO\Concerns;

use Mockery\MockInterface;
use PDO;

trait DelegatesToPDOStatement
{
    use DelegatesToPDOStatementVersionsCompat;

    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDOStatement
     */
    abstract protected function getPDOStatementMock(): MockInterface;

    /**
     * @param  null|array    $parameters
     * @throws \PDOException
     * @return bool
     */
    public function execute($parameters = null)
    {
        return $this->getPDOStatementMock()->execute(...func_get_args());
    }

    /**
     * @param  null|int $fetchStyle
     * @param  int      $cursorOrientation
     * @param  int      $cursorOffset
     * @return mixed
     */
    public function fetch($fetchStyle = null, $cursorOrientation = PDO::FETCH_ORI_NEXT, $cursorOffset = 0)
    {
        return $this->getPDOStatementMock()->fetch(...func_get_args());
    }

    /**
     * @param  mixed      $parameter
     * @param  mixed      $variable
     * @param  int        $dataType
     * @param  null|int   $length
     * @param  null|mixed $options
     * @return bool
     */
    public function bindParam($parameter, &$variable, $dataType = PDO::PARAM_STR, $length = null, $options = null)
    {
        return $this->getPDOStatementMock()->bindParam($parameter, $variable, ...array_slice(func_get_args(), 2));
    }

    /**
     * @param  mixed    $column
     * @param  mixed    $param
     * @param  null|int $type
     * @param  null|int $maxlen
     * @param  mixed    $driverData
     * @return bool
     */
    public function bindColumn($column, &$param, $type = null, $maxlen = null, $driverData = null)
    {
        return $this->getPDOStatementMock()->bindParam($column, $param, ...array_slice(func_get_args(), 2));
    }

    /**
     * @param  mixed $parameter
     * @param  mixed $value
     * @param  int   $dataType
     * @return bool
     */
    public function bindValue($parameter, $value, $dataType = PDO::PARAM_STR)
    {
        return $this->getPDOStatementMock()->bindValue(...func_get_args());
    }

    /**
     * @return int
     */
    public function rowCount()
    {
        return $this->getPDOStatementMock()->rowCount();
    }

    /**
     * @param  int   $columnNumber
     * @return mixed
     */
    public function fetchColumn($columnNumber = 0)
    {
        return $this->getPDOStatementMock()->fetchColumn(...func_get_args());
    }

    /**
     * @param  string     $className
     * @param  null|array $ctorArgs
     * @return mixed
     */
    public function fetchObject($className = 'stdClass', $ctorArgs = null)
    {
        return $this->getPDOStatementMock()->fetchObject(...func_get_args());
    }

    /**
     * @return string
     */
    public function errorCode()
    {
        return $this->getPDOStatementMock()->errorCode();
    }

    /**
     * @return array
     */
    public function errorInfo()
    {
        return $this->getPDOStatementMock()->errorInfo();
    }

    /**
     * @param  int   $attribute
     * @param  mixed $value
     * @return bool
     */
    public function setAttribute($attribute, $value)
    {
        return $this->getPDOStatementMock()->setAttribute($attribute, $value);
    }

    /**
     * @param  int   $attribute
     * @return mixed
     */
    public function getAttribute($attribute)
    {
        return $this->getPDOStatementMock()->getAttribute($attribute);
    }

    /**
     * @return int
     */
    public function columnCount()
    {
        return $this->getPDOStatementMock()->columnCount();
    }

    /**
     * @param  int         $column
     * @return array|false
     */
    public function getColumnMeta($column)
    {
        return $this->getPDOStatementMock()->getColumnMeta($column);
    }

    /**
     * @return bool
     */
    public function nextRowset()
    {
        return $this->getPDOStatementMock()->nextRowset();
    }

    /**
     * @return bool
     */
    public function closeCursor()
    {
        return $this->getPDOStatementMock()->closeCursor();
    }

    /**
     * @return void
     */
    public function debugDumpParams()
    {
        $this->getPDOStatementMock()->debugDumpParams();
    }
}
