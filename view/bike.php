<?php

class Bike {
    private $bike;

    function __construct(CustomBikeViewModel $bike) {
        $this->bike = $bike;
    }

    public static function renderBikes(array $bikes) {
        echo '<div class="container-fluid">';
        foreach ($bikes as $key => $bike) {
            if ($key % 4 === 0) {
                if ($key !== 0)
                    echo '</div>';
                echo '<div class="row">';
            }
            $b = new Bike($bike);
            $b->renderBikeAsThumbnail();
        }
        echo '</div>
              </div>';
    }

    public function renderBikeAsThumbnail() {
        echo '<div class="col-lg-3 col-md-6 col-sm-12">
                  <div class="panel panel-default shop-item-toggle">
                      <div class="panel-heading">
                          ' . $this->bike->name . '
                      </div>
                      <div class="panel-body" style="position: relative">
                          <a href="#" data-id="' . $this->bike->id . '" class="btn btn-success btn-square btn-bottom-right shop-item">
                              <span class="glyphicon glyphicon-shopping-cart">
                                  <span class="sr-only">Add to shopping cart</span>
                              </span>
                          </a>
                          <img src="' . $this->bike->image . '" class="img-responsive img-thumbnail">
                      </div>
                  </div>
              </div>';
    }
}