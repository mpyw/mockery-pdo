<?php

namespace Mpyw\MockeryPDO\Expectations;

use Mockery\ExpectationInterface;
use Mpyw\MockeryPDO\Concerns\DelegatesToExpectation;

/**
 * Class FetchExpectationProxy
 */
class FetchExpectationProxy
{
    use DelegatesToExpectation;

    /**
     * @var \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    protected $expectation;

    /**
     * @var \Mpyw\MockeryPDO\States\FetchingState
     */
    protected $state;

    /**
     * FetchExpectationProxy constructor.
     *
     * @param \Mockery\ExpectationInterface         $expectation
     * @param \Mpyw\MockeryPDO\States\FetchingState $state
     */
    public function __construct($expectation, $state)
    {
        $this->expectation = $expectation;
        $this->state = $state;
    }

    /**
     * @param  null|string                                        $group
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function fetchEnds(?string $group = null): ExpectationInterface
    {
        return $this->state->fetchEnds($group);
    }

    /**
     * @param  mixed                                               $result
     * @param  null|string                                         $group
     * @return \Mpyw\MockeryPDO\Expectations\FetchExpectationProxy
     */
    public function fetchReturns($result, ?string $group = null): FetchExpectationProxy
    {
        return $this->state->fetchReturns($result, $group);
    }

    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface
    {
        return $this->expectation;
    }
}
