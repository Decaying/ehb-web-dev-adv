<?php
require_once("customBike.php");

class CustomBikeRepository {
    const NumberOfHighlights = 4;

    private $allBikes;

    function __construct() {
        $this->allBikes = array(
            new CustomBike(1, "Captain America", "http://media.new.mensxp.com/media/content/2016/Feb/indian-custom-bike-builders-980x457-1454589702_980x457.jpg"),
            new CustomBike(2, "Offroad Maniac", "http://kickstart.bikeexif.com/wp-content/uploads/2015/12/bmw-r100r-vagabund-625x417.jpg"),
            new CustomBike(3, "Tron Legacy Rebuilt", "https://s-media-cache-ak0.pinimg.com/736x/88/85/bd/8885bd20d991291d1337b832ee890c0f.jpg"),
            new CustomBike(4, "Alien vs Highway", "http://wallpapercave.com/wp/3P7YTSc.jpg"),
            new CustomBike(5, "Iron Man", "https://www.globalmototrend.com/wp-content/uploads/2015/09/Madaus_Twintrax_Power_Plus_4-e1441185096639.jpg"),
            new CustomBike(6, "Sharknado", "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTsJE8UW0zEZ_BVHQ20h1NIVP7uSN2wcB8wMNXpJp0YehmjXaJM"),
            new CustomBike(7, "The Trooper", "http://wallpapercave.com/wp/dDdKgba.jpg"),
            new CustomBike(8, "The Indian", "http://polaris.hs.llnwd.net/o40/ind/2017/img/pages/history/2014/el-nora/0.jpg")
        );
    }

    public function getHighlightedBikes() {
        $keys = array_rand($this->allBikes, CustomBikeRepository::NumberOfHighlights);
        $bikes = array();
        foreach ($keys as $key) {
            $bikes[] = $this->allBikes[$key];
        }
        return $bikes;
    }

    public function search($name) {
        return array_filter($this->allBikes, function($bike) use ($name) {
            return stripos($bike->name, $name) !== false;
        });
    }

    public function getById($id) {
        $bikes = array_filter($this->allBikes, function($bike) use ($id) {
            return $bike->id == $id;
        });
        return reset($bikes);
    }
}