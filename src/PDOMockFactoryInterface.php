<?php

namespace Mpyw\MockeryPDO;

use Mockery\MockInterface;

interface PDOMockFactoryInterface
{
    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
     */
    public function createPDOMock(): MockInterface;
}
