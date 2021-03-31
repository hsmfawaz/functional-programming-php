<?php
declare(strict_types=1);
require __DIR__.'/vendor/autoload.php';

$numbers = new \Illuminate\Support\Collection([7, 4, 5, 6, 3, 8, 10]);

function addOne(int $x) : int
{
    return $x + 1;
}

function square(int $x) : int
{
    return $x * $x;
}

function subtractTen(int $x) : int
{
    return $x - 10;
}

function println(string $x) : void
{
    echo $x.PHP_EOL;
}

println('Imperative Programming');
foreach ($numbers as $number) {
    println((string) subtractTen(square(addOne($number))));
}

println('Declarative Programming');
$numbers->map('addOne')
        ->map('square')
        ->filter(fn ($x) => $x < 70)
        ->sort()
        ->take(2)
        ->each('println');