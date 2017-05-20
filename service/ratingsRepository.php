<?php

interface RatingsRepository {
    /**
     * @param $userId
     * @param $bikeId
     * @return int a number from 1 to 5 when the user has rated the bike, 0 when there is no rating
     */
    function getRatingFor($userId, $bikeId);

    /**
     * @param $userId int
     * @param $bikeId int
     * @param $rating int
     * @param $comment string
     * @return void
     */
    function setRatingFor($userId, $bikeId, $rating, $comment);

    function getAverageRatingFor($bikeId);
}