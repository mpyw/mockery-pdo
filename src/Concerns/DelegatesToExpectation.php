<?php

namespace Mpyw\MockeryPDO\Concerns;

use Exception;
use Mockery\ExpectationInterface;

trait DelegatesToExpectation
{
    /**
     * @return \Mockery\Expectation|\Mockery\ExpectationInterface
     */
    abstract protected function getExpectation(): ExpectationInterface;

    /**
     * @param  mixed ...$args
     * @return $this
     */
    public function with(...$args)
    {
        $this->getExpectation()->with(...$args);

        return $this;
    }

    /**
     * @param  array|\Closure $argsOrClosure
     * @return $this
     */
    public function withArgs($argsOrClosure)
    {
        $this->getExpectation()->withArgs($argsOrClosure);

        return $this;
    }

    /**
     * @return $this
     */
    public function withNoArgs()
    {
        $this->getExpectation()->withNoArgs();

        return $this;
    }

    /**
     * @return $this
     */
    public function withAnyArgs()
    {
        $this->getExpectation()->withAnyArgs();

        return $this;
    }

    /**
     * @param  mixed ...$expectedArgs
     * @return $this
     */
    public function withSomeOfArgs(...$expectedArgs)
    {
        $this->getExpectation()->withSomeOfArgs(...$expectedArgs);

        return $this;
    }

    /**
     * @param  mixed ...$args
     * @return $this
     */
    public function andReturn(...$args)
    {
        $this->getExpectation()->andReturn(...$args);

        return $this;
    }

    /**
     * @param  mixed ...$args
     * @return $this
     */
    public function andReturns(...$args)
    {
        $this->getExpectation()->andReturns(...$args);

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnSelf()
    {
        $this->getExpectation()->andReturnSelf();

        return $this;
    }

    /**
     * @param  array $values
     * @return $this
     */
    public function andReturnValues(array $values)
    {
        $this->getExpectation()->andReturnValues($values);

        return $this;
    }

    /**
     * @param  callable ...$args
     * @return $this
     */
    public function andReturnUsing(...$args)
    {
        $this->getExpectation()->andReturnUsing(...$args);

        return $this;
    }

    /**
     * @param  int   $index
     * @return $this
     */
    public function andReturnArg($index)
    {
        $this->getExpectation()->andReturnArg($index);

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnUndefined()
    {
        $this->getExpectation()->andReturnUndefined();

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnNull()
    {
        $this->getExpectation()->andReturnNull();

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnFalse()
    {
        $this->getExpectation()->andReturnFalse();

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnTrue()
    {
        $this->getExpectation()->andReturnTrue();

        return $this;
    }

    /**
     * @param  \Exception|string $exception
     * @param  string            $message
     * @param  int               $code
     * @param  \Exception        $previous
     * @return $this
     */
    public function andThrow($exception, $message = '', $code = 0, Exception $previous = null)
    {
        $this->getExpectation()->andThrow($exception, $message, $code, $previous);

        return $this;
    }

    /**
     * @param  \Exception|string $exception
     * @param  string            $message
     * @param  int               $code
     * @param  \Exception        $previous
     * @return $this
     */
    public function andThrows($exception, $message = '', $code = 0, Exception $previous = null)
    {
        $this->getExpectation()->andThrows($exception, $message, $code, $previous);

        return $this;
    }

    /**
     * @param  array $exceptions
     * @return $this
     */
    public function andThrowExceptions(array $exceptions)
    {
        $this->getExpectation()->andThrowExceptions($exceptions);

        return $this;
    }

    /**
     * @param  string $name
     * @param  array  ...$values
     * @return $this
     */
    public function andSet($name, ...$values)
    {
        $this->getExpectation()->andSet($name, ...$values);

        return $this;
    }

    /**
     * @param  string $name
     * @param  mixed  $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->getExpectation()->set($name, $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function zeroOrMoreTimes()
    {
        $this->getExpectation()->zeroOrMoreTimes();

        return $this;
    }

    /**
     * @param  int                       $limit
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function times($limit = null)
    {
        $this->getExpectation()->times($limit);

        return $this;
    }

    /**
     * @return $this
     */
    public function never()
    {
        $this->getExpectation()->never();

        return $this;
    }

    /**
     * @return $this
     */
    public function once()
    {
        $this->getExpectation()->once();

        return $this;
    }

    /**
     * @return $this
     */
    public function twice()
    {
        $this->getExpectation()->twice();

        return $this;
    }

    /**
     * @return $this
     */
    public function atLeast()
    {
        $this->getExpectation()->atLeast();

        return $this;
    }

    /**
     * @return $this
     */
    public function atMost()
    {
        $this->getExpectation()->atMost();

        return $this;
    }

    /**
     * @param  int   $minimum
     * @param  int   $maximum
     * @return $this
     */
    public function between($minimum, $maximum)
    {
        $this->getExpectation()->between($minimum, $maximum);

        return $this;
    }

    /**
     * @param  string $message
     * @return $this
     */
    public function because($message)
    {
        $this->getExpectation()->because($message);

        return $this;
    }

    /**
     * @param  string $group Name of the ordered group
     * @return $this
     */
    public function ordered($group = null)
    {
        $this->getExpectation()->ordered($group);

        return $this;
    }

    /**
     * @return $this
     */
    public function globally()
    {
        $this->getExpectation()->globally();

        return $this;
    }

    /**
     * @return $this
     */
    public function byDefault()
    {
        $this->getExpectation()->byDefault();

        return $this;
    }

    /**
     * @return $this
     */
    public function passthru()
    {
        $this->getExpectation()->passthru();

        return $this;
    }
}
