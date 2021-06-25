<?php

namespace Mpyw\MockeryPDO\Concerns;

use Mockery\MockInterface;
use PDO;

if (\version_compare(PHP_VERSION, '8', '>=')) {
    trait DelegatesToPDOMockVersionsCompat
    {
        /**
         * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
         */
        abstract protected function getPDOMock(): MockInterface;

        /**
         * @param string $statement
         * @param int $mode
         * @param mixed $fetchModeArgs
         * @return false|\PDOStatement
         */
        public function query(string $statement, ?int $mode = PDO::ATTR_DEFAULT_FETCH_MODE, mixed ...$fetchModeArgs)
        {
            return $this->getPDOMock()->query(...func_get_args());
        }
    }
} else {
    trait DelegatesToPDOMockVersionsCompat
    {
        /**
         * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
         */
        abstract protected function getPDOMock(): MockInterface;

        /**
         * @param string $statement
         * @param int $mode
         * @param mixed $fetchModeArgs
         * @return false|\PDOStatement
         */
        public function query(string $statement, ?int $mode = PDO::ATTR_DEFAULT_FETCH_MODE, mixed ...$fetchModeArgs)
        {
            return $this->getPDOMock()->query(...func_get_args());
        }
    }
}
