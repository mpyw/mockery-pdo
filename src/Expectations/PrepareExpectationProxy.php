<?php

namespace Mpyw\MockeryPDO\Expectations;

use Mockery\ExpectationInterface;
use Mpyw\MockeryPDO\Concerns\DelegatesToExpectation;
use Mpyw\MockeryPDO\States\BindingState;

class PrepareExpectationProxy
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
     * @var string
     */
    protected $sql;

    /**
     * PrepareExpectationProxy constructor.
     *
     * @param \Mockery\ExpectationInterface $expectation
     * @param \Mockery\MockInterface        $statement
     * @param string                        $sql
     */
    public function __construct($expectation, $statement, $sql)
    {
        $this->expectation = $expectation;
        $this->statement = $statement;
        $this->sql = $sql;
    }

    /**
     * @param  array|mixed $options
     * @return $this
     */
    public function withOptions($options)
    {
        return $this->with($this->sql, $options);
    }

    /**
     * @return $this
     */
    public function withoutOptions()
    {
        return $this->withNoArgs();
    }

    /**
     * @return \Mpyw\MockeryPDO\States\BindingState
     */
    public function shouldBind(): BindingState
    {
        return new BindingState($this->statement);
    }

    /**
     * @param  null|array|mixed                                      $boundValues
     * @return \Mpyw\MockeryPDO\Expectations\ExecuteExpectationProxy
     */
    public function shouldExecute($boundValues = null): ExecuteExpectationProxy
    {
        return $this->shouldBind()->shouldExecute(...func_get_args());
    }

    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface
    {
        return $this->expectation;
    }
}
