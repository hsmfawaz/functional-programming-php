<?php
declare(strict_types=1);
require __DIR__.'/vendor/autoload.php';

class Session4Laravel
{
    public function handle()
    {
        $ordersList = new \Illuminate\Support\Collection([
            new Order(['name' => "Paper"]),
            new Order(['name' => "Laptop"]),
        ]);
        $ordersWithDiscounts = $ordersList->map(function ($x) {
            return $this->GetOrderWithDiscount($x, $this->GetDiscountRules());
        });

        print_r($ordersWithDiscounts->toArray());
    }

    public function GetOrderWithDiscount(Order $r, \Illuminate\Support\Collection $rules) : Order
    {
        $discount = $rules->filter(fn ($a) => $a['QualifyingCondition']($r))
                          ->map(fn ($b) => $b['GetDiscount']($r))
                          ->sort()
                          ->take(3)
                          ->avg();
        $newOrder = new Order($r->orderData);
        $newOrder->discount = $discount;

        return $newOrder;
    }

    public function GetDiscountRules() : \Illuminate\Support\Collection
    {
        return new \Illuminate\Support\Collection([
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
        ]);
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

(new Session4Laravel())->handle();









