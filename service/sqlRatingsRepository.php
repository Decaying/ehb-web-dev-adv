<?php

require_once("sqlContext.php");
require_once("ratingsRepository.php");

class SqlRatingsRepository implements RatingsRepository {

    private $context;

    public function __construct(SqlContext $context) {
        $this->context = $context;
    }

    function getRatingFor($userId, $bikeId) {
        $result = $this->context->executeOne("SELECT rating FROM BikeRatings WHERE bike_id = '$bikeId' AND user_id = '$userId'");
        if ($result) {
            $row = $result->fetch_row();
            if ($row) {
                return $row[0];
            }
        }
        return 0;
    }

    function setRatingFor($userId, $bikeId, $rating, $comment) {
        $ratingComment = $this->context->escape_string($comment);
        $this->context->executeOne("INSERT INTO BikeRatings (bike_id, user_id, rating, comment) VALUES ('$bikeId', '$userId', '$rating', '$ratingComment')");
    }

    function getAverageRatingFor($bikeId) {
        $result = $this->context->executeOne("SELECT avg(rating) FROM BikeRatings WHERE bike_id = '$bikeId'");
        if ($result) {
            $row = $result->fetch_row();
            if ($row) {
                return (int)$row[0];
            }
        }
        return 0;
    }
}