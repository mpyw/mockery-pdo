<?php

namespace Mpyw\MockeryPDO;

class MockeryPDO
{
    /**
     * @var \Mpyw\MockeryPDO\PDOMockFactoryInterface
     */
    protected $pdoFactory;

    /**
     * @var \Mpyw\MockeryPDO\PDOStatementMockFactoryInterface
     */
    protected $stmtFactory;

    /**
     * MockeryPDO constructor.
     *
     * @param null|\Mpyw\MockeryPDO\PDOMockFactoryInterface          $pdoProvider
     * @param null|\Mpyw\MockeryPDO\PDOStatementMockFactoryInterface $stmtProvider
     */
    public function __construct(?PDOMockFactoryInterface $pdoProvider = null, ?PDOStatementMockFactoryInterface $stmtProvider = null)
    {
        $this->pdoFactory = $pdoProvider ?: new PDOMockFactory();
        $this->stmtFactory = $stmtProvider ?: new PDOStatementMockFactory();
    }

    /**
     * @return \Mpyw\MockeryPDO\PDOMockProxy
     */
    public function mock(): PDOMockProxy
    {
        return new PDOMockProxy(
            $this->pdoFactory->createPDOMock(),
            $this->stmtFactory
        );
    }
}
