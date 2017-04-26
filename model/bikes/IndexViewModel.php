<?php

namespace bikes;

class IndexViewModel {

    public $allBikes;
    public $categories;

    function __construct(array $bikes, array $categories) {
        $this->allBikes = $bikes;
        $this->categories = $categories;
    }
}