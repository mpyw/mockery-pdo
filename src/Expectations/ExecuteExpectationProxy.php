<?php

namespace Mpyw\MockeryPDO\Expectations;

use Mockery\ExpectationInterface;
use Mpyw\MockeryPDO\Concerns\DelegatesToExpectation;
use Mpyw\MockeryPDO\States\FetchingState;

class ExecuteExpectationProxy
{
    use DelegatesToExpectation;

    /**
     * @var \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    protected $expectation;

    /**
     * @var \Mockery\MockInterface|\PDOStatement
     */
    protected $statement;

    /**
     * ExecuteExpectationProxy constructor.
     *
     * @param \Mockery\ExpectationInterface $expectation
     * @param \Mockery\MockInterface        $statement
     */
    public function __construct($expectation, $statement)
    {
        $this->expectation = $expectation;
        $this->statement = $statement;
    }

    /**
     * @param  array|mixed $values
     * @return $this
     */
    public function withBoundValues($values)
    {
        return $this->with($values);
    }

    /**
     * @return $this
     */
    public function withoutBoundValues()
    {
        return $this->withNoArgs();
    }

    /**
     * @param int $rowCount
     */
    public function shouldRowCountReturns(int $rowCount): void
    {
        $this->statement
            ->shouldReceive('rowCount')
            ->andReturn($rowCount);
    }

    /**
     * @param  array                                              $results
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function shouldFetchAllReturns(array $results): ExpectationInterface
    {
        return $this->statement
            ->shouldReceive('fetchAll')
            ->andReturn($results);
    }

    /**
     * @return \Mpyw\MockeryPDO\States\FetchingState
     */
    public function shouldStartFetching(): FetchingState
    {
        return new FetchingState($this->statement);
    }

    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface
    {
        return $this->expectation;
    }
}
