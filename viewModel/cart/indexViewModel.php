<?php
/**
 * Created by PhpStorm.
 * User: HansB
 * Date: 2/05/2017
 * Time: 18:50
 */

namespace cart;

class IndexViewModel {

    public $bikes;
    public $purchases;

    function __construct(array $purchases, array $bikes) {
        $this->purchases = $purchases;
        $this->bikes = $bikes;
    }
}