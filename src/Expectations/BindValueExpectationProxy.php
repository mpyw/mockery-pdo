<?php

namespace Mpyw\MockeryPDO\Expectations;

use Mockery\ExpectationInterface;
use Mpyw\MockeryPDO\Concerns\DelegatesToExpectation;

class BindValueExpectationProxy
{
    use DelegatesToExpectation;

    /**
     * @var \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    protected $expectation;

    /**
     * @var \Mpyw\MockeryPDO\States\BindingState
     */
    protected $state;

    /**
     * BindValueExpectationProxy constructor.
     *
     * @param \Mockery\ExpectationInterface        $expectation
     * @param \Mpyw\MockeryPDO\States\BindingState $state
     */
    public function __construct($expectation, $state)
    {
        $this->expectation = $expectation;
        $this->state = $state;
    }

    /**
     * @param  mixed  $parameter
     * @param  mixed  $value
     * @return static
     */
    public function value($parameter, $value)
    {
        return $this->state->value($parameter, $value);
    }

    /**
     * @param  mixed     $parameter
     * @param  mixed     $value
     * @param  int|mixed $type
     * @return static
     */
    public function valueAs($parameter, $value, $type)
    {
        return $this->state->valueAs($parameter, $value, $type);
    }

    /**
     * @param  mixed  $parameter
     * @param  mixed  $value
     * @return static
     */
    public function explicitStringValue($parameter, $value)
    {
        return $this->state->explicitStringValue($parameter, $value);
    }

    /**
     * @param  mixed  $parameter
     * @param  mixed  $value
     * @return static
     */
    public function intValue($parameter, $value)
    {
        return $this->state->intValue($parameter, $value);
    }

    /**
     * @param  mixed  $parameter
     * @param  mixed  $value
     * @return static
     */
    public function boolValue($parameter, $value)
    {
        return $this->state->boolValue($parameter, $value);
    }

    /**
     * @return \Mpyw\MockeryPDO\Expectations\ExecuteExpectationProxy
     */
    public function shouldExecute(): ExecuteExpectationProxy
    {
        return $this->state->shouldExecute();
    }

    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface
    {
        return $this->expectation;
    }
}
