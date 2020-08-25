<?php

namespace Mpyw\MockeryPDO;

use Mockery;
use Mockery\MockInterface;
use PDO;

class PDOMockFactory implements PDOMockFactoryInterface
{
    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
     */
    public function createPDOMock(): MockInterface
    {
        return Mockery::mock(PDO::class);
    }
}
