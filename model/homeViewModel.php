<?php

class HomeViewModel {
    public $highlights;
    public $latest;

    function __construct(array $highlights, array $latest) {
        $this->highlights = $highlights;
        $this->latest = $latest;
    }
}