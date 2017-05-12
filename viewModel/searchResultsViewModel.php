<?php

class SearchResultsViewModel {
    public $query;
    public $results;

    function __construct($query, array $results) {
        $this->query = $query;
        $this->results = $results;
    }
}