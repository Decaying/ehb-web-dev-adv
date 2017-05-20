<?php

use bikes\Detail;
use bikes\DetailViewModel;
use bikes\Index;
use bikes\IndexViewModel;
use bikes\RatingComment;

require_once("controller.php");

require_once(VIEW_PATH . "/bikes/detail.php");
require_once(VIEW_PATH . "/bikes/index.php");
require_once(VIEW_PATH . "/bikes/ratingComment.php");
require_once(VIEW_PATH . "/notFound.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(MODEL_PATH . "/bikes/indexViewModel.php");
require_once(MODEL_PATH . "/bikes/detailViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");
require_once(SERVICE_PATH . "/authenticationManager.php");
require_once(SERVICE_PATH . "/ratingsRepository.php");

class BikesController extends Controller {
    const NumberOfBikesFromSameCategory = 4;

    private $customBikes;
    private $auth;
    private $ratings;

    function __construct(CustomBikeRepository $customBikes, AuthenticationManager $auth, RatingsRepository $ratings) {
        $this->customBikes = $customBikes;
        $this->auth = $auth;
        $this->ratings = $ratings;
    }

    public function index() {
        $args = func_get_args();
        if (count($args) == 1){
            return $this->indexById($args[0]);
        } else {
            return $this->indexForAll();
        }
    }

    private function indexForAll() {
        $all = $this->getAll();
        $categories = $this->getCategories();

        $all = $all === null ? array() : $all;
        $categories = $categories === null ? array() : $categories;

        $model = new IndexViewModel($all, $categories);

        return new Index($model);
    }

    private function indexById($id) {
        $bike = $this->getById($id);

        if (!$bike) {
            return new NotFound("Bike with id '$id' does not exist.");
        }

        $isUserLoggedIn = $this->auth->isUserLoggedIn();

        if ($this->hasGetValue('rating') && $isUserLoggedIn) {
            $rating = $_GET['rating'];
            if ($this->hasPostValue('form-id') && $_POST['form-id'] === 'rating-comment') {
                $comment = $_POST['comment'];

                $user = $this->auth->getUser();
                $this->ratings->setRatingFor($user->getId(), $id, $rating, $comment);
                $this->redirectTo("/bikes/$id");
            } else {
                return new RatingComment($rating);
            }
        }

        $sameCategory = $this->getSameCategory($bike);

        $userRating = null;
        if ($isUserLoggedIn) {
            $user = $this->auth->getUser();
            $userRating = $this->ratings->getRatingFor($user->getId(), $id);
        }

        $avgRating = $this->ratings->getAverageRatingFor($id);

        $model = new DetailViewModel($this->toBikeVm($bike), $this->toBikeVms($sameCategory), $isUserLoggedIn, $avgRating, $userRating);

        return new Detail($model);
    }

    private function toBikeVm(CustomBike $bike) {
        return CustomBikeViewModel::FromCustomBike($bike);
    }

    private function toBikeVms(array $bikes) {
        return CustomBikeViewModel::FromCustomBikes($bikes);
    }

    private function getById($id) {
        return $this->customBikes->searchById($id);
    }

    private function getAll() {
        $allBikes = $this->customBikes->getAllBikes();
        if ($allBikes === null)
            return null;
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }

    private function getSameCategory(CustomBike $bike) {
        $sameCategory = $this->customBikes->searchByCategory($bike->category);

        $sameCategoryNotSelf = array_filter($sameCategory, function($b) use ($bike) {
            return $b->id !== $bike->id;
        });

        return array_slice($sameCategoryNotSelf, 0, BikesController::NumberOfBikesFromSameCategory);
    }

    private function getCategories() {
        return $this->customBikes->getCategories();
    }
}