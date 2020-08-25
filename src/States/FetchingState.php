<?php

namespace Mpyw\MockeryPDO\States;

use Mockery\ExpectationInterface;
use Mpyw\MockeryPDO\Expectations\FetchExpectationProxy;

class FetchingState
{
    /**
     * @var \Mockery\MockInterface|\PDOStatement
     */
    protected $statement;

    /**
     * FetchingState constructor.
     *
     * @param \Mockery\MockInterface $statement
     */
    public function __construct($statement)
    {
        $this->statement = $statement;
    }

    /**
     * @param  null|string                                        $group
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function fetchEnds(?string $group = null): ExpectationInterface
    {
        return $this->newFetchExpectation(false, $group)->atLeast()->once()->getExpectation();
    }

    /**
     * @param  mixed                                               $result
     * @param  null|string                                         $group
     * @return \Mpyw\MockeryPDO\Expectations\FetchExpectationProxy
     */
    public function fetchReturns($result, ?string $group = null): FetchExpectationProxy
    {
        return $this->newFetchExpectation($result, $group)->once();
    }

    /**
     * @param  mixed                 $result
     * @param  null|string           $group
     * @return FetchExpectationProxy
     */
    protected function newFetchExpectation($result, ?string $group = null)
    {
        return new FetchExpectationProxy(
            $this->statement->shouldReceive('fetch')->andReturn($result)->ordered($group),
            $this
        );
    }
}
