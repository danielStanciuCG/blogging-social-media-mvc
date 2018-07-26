<?php

class Pages extends Controller {
    private $model;

    public function __construct() {
        if (isLoggedIn()) {
            redirect("posts");
        }
    }

    public function index() {
        $data = [
            "title" => "SharePosts",
            "description" => "Simple social network built on the MVC Framework",
        ];
        $this->loadView("pages/index", $data);
    }

    public function about() {
        $data = [
            "title" => "About MVC Framework",
            "description" => "App to share posts with other users.",
        ];
        $this->loadView("pages/about", $data);
    }
}