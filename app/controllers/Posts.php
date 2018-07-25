<?php

class Posts extends Controller {
    public function __construct() {
        if (!isLoggedIn()) {
            redirect("users/login");
        }
    }

    public function index() {
        $data = [];

        $this->loadView("posts/index", $data);
    }
}
