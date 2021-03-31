<?php
declare(strict_types=1);

class HigherOrderFunctionSession
{
    public static function handle()
    {
        $closureOne = fn ($x) => self::testOne($x);
        $closureTwo = fn ($x) => self::testTwo($x);
        $closureThree = fn ($x, $y) => self::testThree($x, $y);
        $closureList = [$closureOne, $closureTwo];

        echo $closureTwo($closureOne(5)).PHP_EOL;
        echo $closureOne($closureTwo(5)).PHP_EOL;

        echo $closureList[0](5).PHP_EOL;
        echo $closureList[1](5).PHP_EOL;

        echo $closureThree($closureOne, 5).PHP_EOL;
        echo $closureThree($closureTwo, 5).PHP_EOL;
    }

    public static function testOne(float $x) : float
    {
        return $x / 2;
    }

    public static function testTwo(float $x) : float
    {
        return $x / 4 + 1;
    }

    public static function testThree(Closure $f, float $value) : float
    {
        return $f($value) + $value;
    }
}

HigherOrderFunctionSession::handle();