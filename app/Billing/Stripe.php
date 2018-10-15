<?php

namespace App\Billing;

/**
 * Class Stripe
 * @package App\Billing
 */
class Stripe {

    protected $key;

    /**
     * Stripe constructor.
     * @param $key
     */
    public function __construct($key){

        $this->key = $key;

    }

}