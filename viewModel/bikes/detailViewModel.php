<?php

namespace bikes;

use CustomBikeViewModel;

class DetailViewModel {
    public $bike;
    public $sameCategory;
    private $isLoggedIn;
    private $userRating;
    /**
     * @var null
     */
    private $avgRating;

    function __construct(CustomBikeViewModel $bike, array $fromSameCategory, $isLoggedIn, $avgRating = null, $userRating = null) {
        $this->bike = $bike;
        $this->sameCategory = $fromSameCategory;
        $this->isLoggedIn = $isLoggedIn;
        $this->userRating = $userRating;
        $this->avgRating = $avgRating;
    }

    /**
     * @return mixed
     */
    public function isUserLoggedIn() {
        return $this->isLoggedIn;
    }

    /**
     * @return mixed
     */
    public function getUserRating() {
        return $this->userRating;
    }

    /**
     * @return int 0 when no rating, 1-5 when the ratings are available
     */
    public function getAvgRating() {
        return $this->avgRating;
    }
}