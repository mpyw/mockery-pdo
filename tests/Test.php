<?php

namespace Mpyw\MockeryPDO\Tests;

use Mockery;
use Mpyw\MockeryPDO\MockeryPDO;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testSelectBasic(): void
    {
        $pdo = (new MockeryPdo())->mock();

        $pdo->shouldPrepare('select * from users where email = :email and active = :active')
            ->shouldBind()
                ->value('email', 'John')
                ->boolValue('active', true)
            ->shouldExecute()
            ->shouldFetchAllReturns([['id' => 1, 'name' => 'John', 'active' => 1]]);

        $this->assertInstanceOf(
            PDOStatement::class,
            $stmt = $pdo->prepare('select * from users where email = :email and active = :active')
        );

        $this->assertTrue($stmt->bindValue('email', 'John'));
        $this->assertTrue($stmt->bindValue('active', 'John', PDO::PARAM_BOOL));
        $this->assertTrue($stmt->execute());

        $this->assertSame(
            [['id' => 1, 'name' => 'John', 'active' => 1]],
            $stmt->fetchAll()
        );
    }

    public function testSelectBindOnExecute(): void
    {
        $pdo = (new MockeryPdo())->mock();

        $pdo->shouldPrepare('select * from users where email = ? and active = ?')
            ->shouldExecute(['John', '1'])
            ->shouldFetchAllReturns([['id' => 1, 'name' => 'John', 'active' => 1]]);

        $this->assertInstanceOf(
            PDOStatement::class,
            $stmt = $pdo->prepare('select * from users where email = ? and active = ?')
        );
        $this->assertTrue($stmt->execute(['John', '1']));

        $this->assertSame(
            [['id' => 1, 'name' => 'John', 'active' => 1]],
            $stmt->fetchAll()
        );
    }

    public function testSelectFetchRepeated(): void
    {
        $pdo = (new MockeryPdo())->mock();

        $pdo->shouldPrepare('select * from users where email = :email and active = :active')
            ->shouldBind()
                ->value('email', 'John')
                ->boolValue('active', true)
            ->shouldExecute()
            ->shouldStartFetching()
                ->fetchReturns((object)['id' => 1, 'name' => 'John', 'active' => 1])
                    ->with(PDO::FETCH_OBJ)
                ->fetchEnds();

        $this->assertInstanceOf(
            PDOStatement::class,
            $stmt = $pdo->prepare('select * from users where email = :email and active = :active')
        );

        $this->assertTrue($stmt->bindValue('email', 'John'));
        $this->assertTrue($stmt->bindValue('active', 'John', PDO::PARAM_BOOL));
        $this->assertTrue($stmt->execute());

        $this->assertEquals((object)['id' => 1, 'name' => 'John', 'active' => 1], $stmt->fetch(PDO::FETCH_OBJ));
        $this->assertFalse($stmt->fetch());
        $this->assertFalse($stmt->fetch());
        $this->assertFalse($stmt->fetch());
    }

    public function testInsert(): void
    {
        $pdo = (new MockeryPdo())->mock();

        $pdo->shouldPrepare('insert into users(email, active) values (?, ?)')
            ->shouldExecute(['John', '1'])
            ->shouldRowCountReturns(1);

        $this->assertInstanceOf(
            PDOStatement::class,
            $stmt = $pdo->prepare('insert into users(email, active) values (?, ?)')
        );
        $this->assertTrue($stmt->execute(['John', '1']));
        $this->assertSame(1, $stmt->rowCount());
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
