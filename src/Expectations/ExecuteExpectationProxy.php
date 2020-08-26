<?php

namespace Mpyw\MockeryPDO\Expectations;

use Mockery\ExpectationInterface;
use Mockery\MockInterface;
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
     * @param  int                                                $rowCount
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function shouldRowCountReturns(int $rowCount): ExpectationInterface
    {
        return $this->whenRowCountCalled()->andReturn($rowCount);
    }

    /**
     * @param  array                                              $results
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function shouldFetchAllReturns(array $results): ExpectationInterface
    {
        return $this->whenFetchAllCalled()->andReturn($results);
    }

    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function whenRowCountCalled(): ExpectationInterface
    {
        return $this->whenCalled('rowCount');
    }

    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function whenFetchAllCalled(): ExpectationInterface
    {
        return $this->whenCalled('fetchAll');
    }

    /**
     * @param  string                                             $method
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function whenCalled(string $method): ExpectationInterface
    {
        return $this->statement->shouldReceive($method);
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

    /**
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|\PDOStatement
     */
    public function thenStatement(): MockInterface
    {
        return $this->statement;
    }
}
