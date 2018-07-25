<?php

/**
 * Class Users
 * Manages the registration and log in processes.
 */
class Users extends Controller {
    private $model;

    /**
     * Creates user functionality such as account registration and logging in.
     */
    public function __construct() {
        $this->model = $this->loadModel("User");
    }

    /**
     * Handles user registrations
     */
    public function register() {
        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Process form & sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                "name" => trim($_POST["name"]),
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "confirmPassword" => trim($_POST["confirmPassword"]),
                "nameError" => "",
                "emailError" => "",
                "passwordError" => "",
                "confirmPasswordError" => "",
            ];

            //Validate email
            if (empty($data["email"])) {
                $data["emailError"] = "Please enter a valid email address.";
            } else {
                if ($this->model->findUserByEmail($data["email"])) {
                    $data["emailError"] = "Email address is already taken.";
                }
            }

            //Validate name
            if (empty($data["name"])) {
                $data["nameError"] = "Please enter your name.";
            }

            //Validate password
            if (empty($data["password"])) {
                $data["passwordError"] = "Please enter a password.";
            } elseif (strlen($data["password"]) < 6) {
                $data["passwordError"] = "Password must be at least 6 characters.";
            }

            //Validate confirm password
            if (empty($data["confirmPassword"])) {
                $data["confirmPasswordError"] = "Please confirm your password.";
            } else {
                if ($data["password"] != $data["confirmPassword"]) {
                    $data["confirmPasswordError"] = "Passwords do not match.";
                }
            }

            //Make sure errors are empty
            if (empty($data["emailError"]) && empty($data["nameError"]) && empty($data["passwordError"])
                && empty($data["confirmPasswordError"])) {
                //Hash password
                $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

                //Register user by calling the model method
                if ($this->model->registerUser($data)) {
                    genFlashMsg("register_success", "You are registered and can log in!");
                    redirect("users/login");
                } else {
                    die("Something went wrong when trying to register user data for a new account.");
                }
            } else {
                //Load view with errors
                $this->loadView("users/register", $data);
            }
        } else {
            //Init data
            $data = [
                "name" => "",
                "email" => "",
                "password" => "",
                "confirmPassword" => "",
                "nameError" => "",
                "emailError" => "",
                "passwordError" => "",
                "confirmPasswordError" => "",
            ];

            //Load view
            $this->loadView("users/register", $data);
        }
    }

    /**
     * Handles user logins
     */
    public function logIn() {
        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Process form & sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "emailError" => "",
                "passwordError" => "",
            ];

            //Validate email
            if (empty($data["email"])) {
                $data["emailError"] = "Please enter a valid email address.";
            }
            if (!$this->model->findUserByEmail($data["email"])) {
                $data["emailError"] = "Invalid username";
            }

            //Validate password
            if (empty($data["password"])) {
                $data["passwordError"] = "Please enter a password.";
            } elseif (strlen($data["password"]) < 6) {
                $data["passwordError"] = "Password must be at least 6 characters.";
            }

            //Make sure errors are empty
            if (empty($data["emailError"]) && empty($data["passwordError"])) {
                //Validated - check and set logged in user
                $loggedInUser = $this->model->checkCredentials($data["email"], $data["password"]);

                if ($loggedInUser) {
                    //Create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data["passwordError"] = "Password incorrect";
                    $this->loadView("users/login", $data);
                }
            } else {
                //Load view with errors
                $this->loadView("users/login", $data);
            }
        } else {
            //Init data
            $data = [
                "email" => "",
                "password" => "",
                "emailError" => "",
                "passwordError" => "",
            ];

            //Load view
            $this->loadView("users/login", $data);
        }
    }

    /**
     * Creates user session once the user has logged in.
     * @param $user - row returned by SQL query as an object, the logged in user
     */
    public function createUserSession($user) {
        $_SESSION["userId"] = $user->id;
        $_SESSION["userEmail"] = $user->email;
        $_SESSION["userName"] = $user->name;
        redirect("pages/index");
    }

    /**
     * Logs user out.
     */
    public function logOut() {
        unset($_SESSION["userId"]);
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userName"]);
        session_destroy();
        redirect("users/login");
    }

    /**
     * Checks whether or not the user is logged in.
     * @return bool
     */
    public function isLoggedIn() {
        return isset($_SESSION["userId"]);
    }
}