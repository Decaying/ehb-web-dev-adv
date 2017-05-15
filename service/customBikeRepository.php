<?php

interface CustomBikeRepository {
    const NumberOfHighlights = 4;
    const NumberOfLatest = 4;

    function getAllBikes();

    function getLatestBikes();
    function getHighlightedBikes();

    function searchByName($name);
    function searchByCategory($category);
    function searchById($id);


    function getCategories();

    function delete($id);

    function add(CustomBike $bike);

    function update(CustomBike $bike);
}