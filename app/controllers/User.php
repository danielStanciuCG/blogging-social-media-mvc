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

}