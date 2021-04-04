<?php
declare(strict_types=1);

class SessionSeven
{
    public function handle() : void
    {
        $segments = [
            ['segment' => 'a', 'basicSalary' => 1000],
            ['segment' => 'b', 'basicSalary' => 2000],
            ['segment' => 'c', 'basicSalary' => 3000],
        ];
        $grossSalaryCalculators = array_map(fn ($i) => [
            'segment'                 => $i['segment'],
            'MyGrossSalaryCalculator' => $this->grossSalaryCalculator($i['basicSalary']),
        ], $segments);

        echo $grossSalaryCalculators[0]['MyGrossSalaryCalculator'](80).PHP_EOL;
        echo $grossSalaryCalculators[1]['MyGrossSalaryCalculator'](90).PHP_EOL;
        echo $grossSalaryCalculators[2]['MyGrossSalaryCalculator'](100).PHP_EOL;
    }

    private function grossSalaryCalculator(float $basicSalary) : Closure
    {
        $tax = 0.2 * $basicSalary;

        return static fn (float $bonus) => $tax + $bonus + $basicSalary;
    }
}

(new SessionSeven())->handle();









