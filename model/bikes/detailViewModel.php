<?php

namespace bikes;

use CustomBikeViewModel;

class DetailViewModel {
    public $bike;
    public $sameCategory;

    function __construct(CustomBikeViewModel $bike, array $fromSameCategory) {
        $this->bike = $bike;
        $this->sameCategory = $fromSameCategory;
    }

}