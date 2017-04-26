<?php
require_once("customBike.php");
require_once("purchase.php");
require_once("customBikeRepository.php");

class InMemoryCustomBikeRepository implements CustomBikeRepository{
    private $allBikes;

    function __construct() {
        $this->allBikes = array(
            new CustomBike(1, "Captain America", "http://media.new.mensxp.com/media/content/2016/Feb/indian-custom-bike-builders-980x457-1454589702_980x457.jpg",
                49999.99, "Racing", "The Captain America's Description", new DateTime('2017-01-01'), false),
            new CustomBike(2, "Offroad Maniac", "http://kickstart.bikeexif.com/wp-content/uploads/2015/12/bmw-r100r-vagabund-625x417.jpg",
                41234.567, "Sport", "This is the one you want when you want to go off-road", new DateTime('2016-12-31'), false),
            new CustomBike(3, "Tron Legacy Rebuilt", "https://s-media-cache-ak0.pinimg.com/736x/88/85/bd/8885bd20d991291d1337b832ee890c0f.jpg",
                61111.11111, "Racing", "The future has arrived and we sell it here!", new DateTime('2017-02-28'), true),
            new CustomBike(4, "Alien vs Highway", "http://wallpapercave.com/wp/3P7YTSc.jpg",
                65000.01444447, "Racing", "Watch out for this one, it will come to get you", new DateTime('2017-03-10'), true),
            new CustomBike(5, "Iron Man", "https://www.globalmototrend.com/wp-content/uploads/2015/09/Madaus_Twintrax_Power_Plus_4-e1441185096639.jpg",
                55000.009, "Racing", "Here to save the day!", new DateTime('2017-06-02'), true),
            new CustomBike(6, "Sharknado", "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTsJE8UW0zEZ_BVHQ20h1NIVP7uSN2wcB8wMNXpJp0YehmjXaJM",
                59999.99, "Racing", "A whirlwind of sharks appears out of nowhere and takes you on a journey across the world", new DateTime('2017-04-01'), true),
            new CustomBike(7, "The Trooper", "http://wallpapercave.com/wp/dDdKgba.jpg",
                56000.00, "Touring", "For all those of you on or off duty", new DateTime('2017-03-31'), false),
            new CustomBike(8, "The Indian", "http://polaris.hs.llnwd.net/o40/ind/2017/img/pages/history/2014/el-nora/0.jpg",
                40000.00, "Touring", "This the classic you've been waiting for, watch out, it's limited edition!", new DateTime('2017-04-25'), false),
            new CustomBike(9, "The Conductor", "https://s-media-cache-ak0.pinimg.com/originals/f6/5b/2b/f65b2bd1c6d3567beef299984a1c69d5.jpg",
                39999.99, "Custom", "For those of you who like trains, planes and motorcycles", new DateTime('2017-04-26'), true)
        );
    }

    public function getLatestBikes() {
        $sorted = $this->allBikes;

        usort($sorted, function(CustomBike $a, CustomBike $b) {
            if ($a->dateAdded == $b->dateAdded) {
                return 0;
            }

            return $a->dateAdded > $b->dateAdded ? -1 : 1;
        });

        return array_slice($sorted, 0, CustomBikeRepository::NumberOfLatest);
    }

    public function getHighlightedBikes() {
        $bikes = array();

        $highlighted = array_filter($this->allBikes, function(CustomBike $bike) {
            return $bike->isHighlighted === true;
        });

        if (count($highlighted) === 0)
            return $bikes;

        $random = array_rand($highlighted, min(count($highlighted), CustomBikeRepository::NumberOfHighlights));
        if (is_numeric($random)) {
            $bikes[] = $this->allBikes[$random];
        } else {
            foreach ($random as $index) {
                $bikes[] = $this->allBikes[$index];
            }
        }
        return $bikes;
    }

    public function searchByName($name) {
        return array_filter($this->allBikes, function(CustomBike $bike) use ($name) {
            return stripos($bike->name, $name) !== false;
        });
    }

    public function searchByCategory($category) {
        return array_filter($this->allBikes, function(CustomBike $bike) use ($category) {
            return $bike->category === $category;
        });
    }

    public function searchById($id) {
        $bikes = array_filter($this->allBikes, function(CustomBike $bike) use ($id) {
            return $bike->id == $id;
        });
        return reset($bikes);
    }

    public function getAllBikes() {
        return $this->allBikes;
    }
}