<?php

namespace Mpyw\MockeryPDO;

use Mockery\MockInterface;

interface PDOStatementMockFactoryInterface
{
    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDOStatement
     */
    public function createPDOStatementMock(): MockInterface;
}
