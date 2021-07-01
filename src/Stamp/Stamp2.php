<?php

namespace App\Stamp;

use Bit9\Middleware\Request\Stamp\StampInterface;

class Stamp2 implements StampInterface
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}