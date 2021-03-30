<?php
declare(strict_types=1);

$numbers = [7, 4, 5, 6, 3, 8, 10];

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
//Imperative
foreach ($numbers as $number) {
    println((string) subtractTen(square(addOne($number))));
}

//Declarative
println('Declarative Programming');
$transformed = array_map('subtractTen', array_map('square', array_map('addOne', $numbers)));
array_filter($transformed, 'println');