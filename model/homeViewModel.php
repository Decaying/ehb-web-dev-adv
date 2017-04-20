<?php

class HomeViewModel {
    public $highlights;

    function __construct(array $highlights) {
        $this->highlights = $highlights;
    }
}