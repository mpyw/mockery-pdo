<?php

namespace Mpyw\MockeryPDO\States;

use Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy;
use Mpyw\MockeryPDO\Expectations\ExecuteExpectationProxy;
use PDO;

class BindingState
{
    /**
     * @var \Mockery\MockInterface|\PDOStatement
     */
    protected $statement;

    /**
     * BindingState constructor.
     *
     * @param \Mockery\MockInterface $statement
     */
    public function __construct($statement)
    {
        $this->statement = $statement;
    }

    /**
     * @param  mixed                                                   $parameter
     * @param  mixed                                                   $value
     * @return \Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy
     */
    public function value($parameter, $value): BindValueExpectationProxy
    {
        return $this->newBinding()->with($parameter, $value);
    }

    /**
     * @param  mixed                                                   $parameter
     * @param  mixed                                                   $value
     * @param  int|mixed                                               $type
     * @return \Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy
     */
    public function valueAs($parameter, $value, $type): BindValueExpectationProxy
    {
        return $this->newBinding()->with($parameter, $value, $type);
    }

    /**
     * @param  mixed                                                   $parameter
     * @param  mixed                                                   $value
     * @return \Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy
     */
    public function explicitStringValue($parameter, $value): BindValueExpectationProxy
    {
        return $this->newBinding()->with($parameter, $value, PDO::PARAM_STR);
    }

    /**
     * @param  mixed                                                   $parameter
     * @param  mixed                                                   $value
     * @return \Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy
     */
    public function intValue($parameter, $value): BindValueExpectationProxy
    {
        return $this->newBinding()->with($parameter, $value, PDO::PARAM_INT);
    }

    /**
     * @param  mixed                                                   $parameter
     * @param  mixed                                                   $value
     * @return \Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy
     */
    public function boolValue($parameter, $value): BindValueExpectationProxy
    {
        return $this->newBinding()->with($parameter, $value, PDO::PARAM_BOOL);
    }

    /**
     * @param  null|array|mixed                                      $boundValues
     * @return \Mpyw\MockeryPDO\Expectations\ExecuteExpectationProxy
     */
    public function shouldExecute($boundValues = null): ExecuteExpectationProxy
    {
        $expectation = new ExecuteExpectationProxy(
            $this->statement->shouldReceive('execute')->once()->andReturnTrue(),
            $this->statement
        );

        return func_num_args() < 1 ? $expectation : $expectation->withBoundValues($boundValues);
    }

    /**
     * @return \Mpyw\MockeryPDO\Expectations\BindValueExpectationProxy
     */
    protected function newBinding(): BindValueExpectationProxy
    {
        return new BindValueExpectationProxy(
            $this->statement->shouldReceive('bindValue')->once()->andReturnTrue(),
            $this
        );
    }
}
