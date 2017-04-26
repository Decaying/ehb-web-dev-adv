<?php

namespace bikes;

use CustomBikeViewModel;

class DetailViewModel {
    public $bike;

    function __construct(CustomBikeViewModel $bike) {
        $this->bike = $bike;
    }

}