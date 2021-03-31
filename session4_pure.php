<?php
declare(strict_types=1);

class Session4Pure
{
    public function handle()
    {
        $ordersList = [
            new Order(['name' => "Paper"]),
            new Order(['name' => "Laptop"]),
        ];
        $ordersWithDiscounts = array_map(function ($x) {
            return $this->GetOrderWithDiscount($x, $this->GetDiscountRules());
        }, $ordersList);

        print_r($ordersWithDiscounts);
    }

    public function GetOrderWithDiscount(Order $R, array $Rules) : Order
    {
        $filterRules = array_filter($Rules, fn ($a) => $a['QualifyingCondition']($R));
        $mapRules = array_map(fn ($b) => $b['GetDiscount']($R), $filterRules);
        sort($mapRules);
        $takeThree = array_slice($mapRules, 0, 3);
        $discount = array_sum($takeThree) / count($takeThree);
        $newOrder = new Order($R->orderData);
        $newOrder->discount = $discount;

        return $newOrder;
    }

    public function GetDiscountRules() : array
    {
        return [
            [
                'QualifyingCondition' => [$this, 'isAQualified'],
                'GetDiscount'         => [$this, 'A'],
            ],
            [
                'QualifyingCondition' => [$this, 'isBQualified'],
                'GetDiscount'         => [$this, 'B'],
            ],
            [
                'QualifyingCondition' => [$this, 'isCQualified'],
                'GetDiscount'         => [$this, 'C'],
            ],
        ];
    }

    public function isAQualified(Order $r) : bool
    {
        return true;
    }

    public function A(Order $r) : float
    {
        return 1.0;
    }

    public function isBQualified(Order $r) : bool
    {
        return true;
    }

    public function B(Order $r) : float
    {
        return 1.0;
    }

    public function isCQualified(Order $r) : bool
    {
        return true;
    }

    public function C(Order $r) : float
    {
        return 1.0;
    }
}

class Order
{
    public float $discount;

    public array $orderData;

    public function __construct(array $orderData)
    {

        $this->orderData = $orderData;
    }
}

(new Session4Pure())->handle();









