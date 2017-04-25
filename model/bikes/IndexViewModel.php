<?php

namespace bikes;

class IndexViewModel {

    public $allBikes;

    function __construct(array $all) {
        $this->allBikes = $all;
    }
}