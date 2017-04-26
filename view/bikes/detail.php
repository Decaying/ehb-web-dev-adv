<?php

namespace bikes;


class Detail {

    public function render(DetailViewModel $model) {
        echo '<h1>This is the detail page for ' . $model->bike->name . ' </h1>';
    }
}