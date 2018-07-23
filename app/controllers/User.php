<?php

class User extends Controller {
    public function __construct() {

    }

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