<?php

class SearchResultsViewModel {
    public $query;

    function __construct($q) {
        $this->query = $q;
    }
}