<?php

class Posts extends Controller {
    private $model;

    /**
     * Posts constructor.
     */
    public function __construct() {
        $this->model = $this->loadModel("Post");

        if (!isLoggedIn()) {
            redirect("users/login");
        }
    }

    /**
     * Default page.
     */
    public function index() {
        $posts = $this->model->getPosts();

        $data = [
            "posts" => $posts,
        ];

        $this->loadView("posts/index", $data);
    }
}
