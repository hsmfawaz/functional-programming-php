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
$transformed = array_filter(array_map('square', array_map('addOne', $numbers)), fn ($x) => $x < 70);
sort($transformed);
array_filter(array_slice(array_map('subtractTen', $transformed), 0, 2), 'println');