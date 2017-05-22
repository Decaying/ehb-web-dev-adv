<?php

use manage\bikes\Create;
use manage\bikes\Delete;
use manage\bikes\Edit;
use manage\bikes\Index;

require_once("controller.php");
require_once(VIEW_PATH . "/notFound.php");
require_once(VIEW_PATH . "/notAuthorized.php");
require_once(VIEW_PATH . "/manage/bikes/index.php");
require_once(VIEW_PATH . "/manage/bikes/create.php");
require_once(VIEW_PATH . "/manage/bikes/edit.php");
require_once(VIEW_PATH . "/manage/bikes/delete.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class ManageBikesController extends Controller {

    private $customBikes;
    private $auth;

    function __construct(CustomBikeRepository $customBikes, AuthenticationManager $auth) {
        $this->customBikes = $customBikes;
        $this->auth = $auth;
    }

    public function index() {
        if (!$this->auth->userIsAdmin()) {
            return new NotAuthorized();
        }

        $allBikes = $this->customBikes->getAllBikes();

        $vms = CustomBikeViewModel::FromCustomBikes($allBikes);

        return new Index($vms);
    }

    public function create() {
        if (!$this->auth->userIsAdmin()) {
            return new NotAuthorized();
        }

        if ($this->hasPostValue('form-id') && $_POST['form-id'] === 'create-bike') {
            $this->createNewBike();
            $this->redirectTo('/manage');
        } else {
            return new Create();
        }
    }

    public function delete($id) {
        if (!$this->auth->userIsAdmin()) {
            return new NotAuthorized();
        }

        if ($this->hasPostValue('form-id') && $_POST['form-id'] === 'confirm-delete') {
            $this->customBikes->delete($id);
            $this->redirectTo('/manage');
        } else {
            return new Delete();
        }
    }

    public function edit($id) {
        if (!$this->auth->userIsAdmin()) {
            return new NotAuthorized();
        }

        if ($this->hasPostValue('form-id') && $_POST['form-id'] === "edit-bike") {
            $this->editExistingBike($id);
            $this->redirectTo('/manage');
        } else {
            $bike = $this->customBikes->searchById($id);

            if (!$bike) {
                return new NotFound("Bike with id " . $id . " does not exist.");
            }

            $vm = CustomBikeViewModel::FromCustomBike($bike);

            return new Edit($vm);
        }
    }

    private function createNewBike() {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $isHighlighted = $this->hasPostValue('is-highlighted');

        $bike = new CustomBike($name, $category, $price, $description, $image, $isHighlighted);
        $this->customBikes->add($bike);
    }

    private function editExistingBike($id) {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $isHighlighted = $this->hasPostValue('is-highlighted');

        $bike = new CustomBike($name, $category, $price, $description, $image, $isHighlighted, $id);
        $this->customBikes->update($bike);
    }

    public function orders() {
        return new OrderOverview();
    }
}