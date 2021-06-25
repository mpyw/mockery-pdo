<?php

namespace Mpyw\MockeryPDO\Concerns;

use Mockery\MockInterface;

if (\version_compare(PHP_VERSION, '8', '>=')) {
    trait DelegatesToPDOStatementVersionsCompat
    {
        /**
         * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDOStatement
         */
        abstract protected function getPDOStatementMock(): MockInterface;

        /**
         * @param  null|int $fetchStyle
         * @param  mixed    $args
         * @return array
         */
        public function fetchAll(int $fetchStyle = null, mixed ...$args)
        {
            return $this->getPDOStatementMock()->fetchAll(...func_get_args());
        }

        /**
         * @param  int   $mode
         * @param  mixed $args
         * @return bool
         */
        public function setFetchMode(int $mode, mixed ...$args)
        {
            return $this->getPDOStatementMock()->setFetchMode(...func_get_args());
        }
    }
} else {
    trait DelegatesToPDOStatementVersionsCompat
    {
        /**
         * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDOStatement
         */
        abstract protected function getPDOStatementMock(): MockInterface;

        /**
         * @param  null|int   $fetchStyle
         * @param  mixed      $fetchArgument
         * @param  null|array $ctorArgs
         * @return array
         */
        public function fetchAll($fetchStyle = null, $fetchArgument = null, $ctorArgs = null)
        {
            return $this->getPDOStatementMock()->fetchAll(...func_get_args());
        }

        /**
         * @param  int                $mode
         * @param  null|object|string $classNameObject
         * @param  array              $ctorArg
         * @return bool
         */
        public function setFetchMode($mode, $classNameObject = null, array $ctorArg = [])
        {
            return $this->getPDOStatementMock()->setFetchMode(...func_get_args());
        }
    }
}
