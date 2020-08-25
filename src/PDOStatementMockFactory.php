<?php

namespace Mpyw\MockeryPDO;

use Mockery;
use Mockery\MockInterface;
use PDOStatement;

class PDOStatementMockFactory implements PDOStatementMockFactoryInterface
{
    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDOStatement
     */
    public function createPDOStatementMock(): MockInterface
    {
        return Mockery::mock(PDOStatement::class);
    }
}
