<?php

namespace Mpyw\MockeryPDO;

use Mockery\ExpectationInterface;
use Mockery\MockInterface;
use Mpyw\MockeryPDO\Concerns\DelegatesToPDOMock;
use Mpyw\MockeryPDO\Expectations\PrepareExpectationProxy;
use PDO;

/**
 * Class PDOMockProxy
 *
 * @mixin \Mockery\Mock|\PDO
 */
class PDOMockProxy extends PDO
{
    use DelegatesToPDOMock;

    /**
     * @var \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
     */
    protected $pdo;

    /**
     * @var \Mpyw\MockeryPDO\PDOStatementMockFactoryInterface
     */
    protected $stmtFactory;

    /**
     * PDOMockProxy constructor.
     *
     * @param \Mockery\MockInterface                            $pdo
     * @param \Mpyw\MockeryPDO\PDOStatementMockFactoryInterface $stmtProvider
     */
    public function __construct($pdo, PDOStatementMockFactoryInterface $stmtProvider)
    {
        $this->pdo = $pdo;
        $this->stmtFactory = $stmtProvider;

        parent::__construct('sqlite::memory:');
    }

    /**
     * @param  string $name
     * @param  array  $args
     * @return mixed
     */
    public function __call(string $name, array $args)
    {
        return $this->getPDOMock()->$name(...$args);
    }

    /**
     * @param  mixed|string                                       $sql
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function shouldExec($sql): ExpectationInterface
    {
        return $this->pdo->shouldReceive('exec')->with($sql);
    }

    /**
     * @param  mixed|string                                          $sql
     * @param  null|array|mixed                                      $options
     * @return \Mpyw\MockeryPDO\Expectations\PrepareExpectationProxy
     */
    public function shouldPrepare($sql, $options = null): PrepareExpectationProxy
    {
        $statement = $this->stmtFactory->createPDOStatementMock();

        $expectation = new PrepareExpectationProxy(
            $this->getPDOMock()->shouldReceive('prepare')->with($sql)->andReturn($statement),
            $statement,
            $sql
        );

        return func_num_args() < 2 ? $expectation : $expectation->withOptions($options);
    }

    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDO
     */
    public function getPDOMock(): MockInterface
    {
        return $this->pdo;
    }
}
