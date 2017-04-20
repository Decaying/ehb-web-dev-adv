<?php

class SearchResults {
    function render(SearchResultsViewModel $model) {
        echo '<p>This is the search results page</p>
              <p>Searching for: '.$model->query.'</p>';
    }
}