<?php

/**
 * Class User
 * Manages the registration and log in processes.
 */
class User extends Controller {
    public function __construct() {

    }

    /**
     * Handles user registrations
     */
    public function register() {
        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Process form

            //Sanatize POST data
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
                die("SUCCESS");
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
            //Process form
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
}