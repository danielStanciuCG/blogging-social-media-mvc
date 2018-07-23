<?php

class Pages extends Controller {
    private $model;

    public function __construct() {

    }

    public function index() {
        $data = [
            "title" => "MVC Framework",
        ];
        $this->loadView("pages/index", $data);
    }

    public function about() {
        $data = [
            "title" => "About MVC Framework"
        ];
        $this->loadView("pages/about", $data);
    }
}