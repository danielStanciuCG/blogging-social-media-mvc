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

    /**
     * Adds a blog post.
     */
    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize blog post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "title" => trim($_POST["title"]),
                "body" => trim($_POST["body"]),
                "userId" => $_SESSION["userId"],
                "titleError" => "",
                "bodyError" => ""
            ];

            //Validate title
            if (empty($data["title"])) {
                $data["titleError"] = "Please enter a title.";
            }

            //Validate body
            if (empty($data["body"])) {
                $data["bodyError"] = "Please enter body text.";
            }

            //Make sure no errors
            if (empty($data["titleError"]) && empty($data["bodyError"])) {
                //Validated
                if ($this->model->addPost($data)) {
                    genFlashMsg("postMessage", "Post added!");
                    redirect("posts");
                } else {
                    die("Something went wrong when trying to add a new post.");
                }
            } else {
                //Load view with errors
                $this->loadView("posts/add", $data);
            }

        } else {
            $data = [
                "title" => "",
                "body" => ""
            ];
        }

        $data = [
            "title" => "",
            "body" => "",
        ];

        $this->loadView("posts/add", $data);
    }

    /**
     * Edits a blog post.
     * @param $id - int, the post id number.
     */
    public function edit($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize blog post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "title" => trim($_POST["title"]),
                "body" => trim($_POST["body"]),
                "userId" => $_SESSION["userId"],
                "postId" => $id,
                "titleError" => "",
                "bodyError" => ""
            ];

            //Validate title
            if (empty($data["title"])) {
                $data["titleError"] = "Please enter a title.";
            }

            //Validate body
            if (empty($data["body"])) {
                $data["bodyError"] = "Please enter body text.";
            }

            //Make sure no errors
            if (empty($data["titleError"]) && empty($data["bodyError"])) {
                //Validated
                if ($this->model->editPost($data)) {
                    genFlashMsg("postMessage", "Post updated!");
                    redirect("posts");
                } else {
                    die("Something went wrong when trying to edit the post.");
                }
            } else {
                //Load view with errors
                $this->loadView("posts/edit", $data);
            }

        } else {
            //Get existing post from model
            $post = $this->model->getPost($id);

            //Check for owner
            if ($post->user_id != $_SESSION["userId"]) {
                redirect("posts");
            }

            $data = [
                "id" => $id,
                "title" => $post->title,
                "body" => $post->body
            ];

            $this->loadView("posts/edit", $data);
        }
    }

    /**
     * Deletes a blog post.
     * @param $id - int, the post id number.
     */
    public function delete($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->model->deletePost($id)) {
                genFlashMsg("postMessage", "Post deleted.");
                redirect ("posts");
            } else {
                die("Something went wrong when trying to delete the post");
            }
        } else {
            redirect("posts");
        }
    }

    public function show($id) {
        if ($this->model->getPost($id)) {
            $post = $this->model->getPost($id);
            $user = $this->model->getUser($post->user_id);

            $data = [
                "post" => $post,
                "user" => $user
            ];

            $this->loadView("posts/show", $data);
        } else {
            redirect("posts");
        }
    }
}
