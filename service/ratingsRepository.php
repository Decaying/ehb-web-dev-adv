<?php

interface RatingsRepository {
    /**
     * @param $userId
     * @param $bikeId
     * @return int a number from 1 to 5 when the user has rated the bike, 0 when there is no rating
     */
    function getRatingFor($userId, $bikeId);

    /**
     * @param $userId
     * @param $bikeId
     * @param $rating
     * @return void
     */
    function setRatingFor($userId, $bikeId, $rating);

    function getAverageRatingFor($bikeId);
}