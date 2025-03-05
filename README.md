# Mockery PDO [![Build Status](https://github.com/mpyw/mockery-pdo/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/mpyw/mockery-pdo/actions) [![Coverage Status](https://coveralls.io/repos/github/mpyw/mockery-pdo/badge.svg?branch=master)](https://coveralls.io/github/mpyw/mockery-pdo?branch=master)

> [!WARNING]
> **Experimental**

BDD-style PDO Mocking Library for [`mockery/mockery`](https://github.com/mockery/mockery)

## Requirements

- PHP: `^8.2`
- Mockery: `^1.6.12`

> [!NOTE]
> Older versions have outdated dependency requirements. If you cannot prepare the latest environment, please refer to past releases.

## Installing

```bash
composer require mpyw/mockery-pdo:VERSION@alpha
```

## Example

### SELECT

#### Basic

```php
$pdo = (new MockeryPDO())->mock();

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
```

#### Bind values on `execute()` call

```php
$pdo = (new MockeryPDO())->mock();

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
```

#### Progressively fetch rows

```php
$pdo = (new MockeryPDO())->mock();

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
```

### INSERT

```php
$pdo = (new MockeryPDO())->mock();

$pdo->shouldPrepare('insert into users(email, active) values (?, ?)')
    ->shouldExecute(['John', '1'])
    ->shouldRowCountReturns(1);

$this->assertInstanceOf(
    PDOStatement::class,
    $stmt = $pdo->prepare('insert into users(email, active) values (?, ?)')
);
$this->assertTrue($stmt->execute(['John', '1']));
$this->assertSame(1, $stmt->rowCount());
```
