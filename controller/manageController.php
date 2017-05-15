<?php

use manage\Create;
use manage\Delete;
use manage\Edit;
use manage\Index;

require_once("controller.php");
require_once(VIEW_PATH . "/notFound.php");
require_once(VIEW_PATH . "/manage/index.php");
require_once(VIEW_PATH . "/manage/create.php");
require_once(VIEW_PATH . "/manage/edit.php");
require_once(VIEW_PATH . "/manage/delete.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class ManageController extends Controller {

    private $customBikes;

    function __construct(CustomBikeRepository $customBikes) {
        $this->customBikes = $customBikes;
    }

    public function index() {
        $allBikes = $this->customBikes->getAllBikes();

        $vms = CustomBikeViewModel::FromCustomBikes($allBikes);

        return new Index($vms);
    }

    public function create() {
        if ($this->hasPostValue('form-id') && $_POST['form-id'] === 'create-bike'){
            $this->createNewBike();
            $this->redirectTo('/manage');
        } else {
            return new Create();
        }
    }

    public function delete($id) {
        if ($this->hasPostValue('form-id') && $_POST['form-id'] === 'confirm-delete'){
            $this->customBikes->delete($id);
            $this->redirectTo('/manage');
        } else {
            return new Delete();
        }
    }

    public function edit($id) {
        if ($this->hasPostValue('form-id') && $_POST['form-id'] === "edit-bike"){
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

}