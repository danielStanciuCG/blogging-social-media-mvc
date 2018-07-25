<?php

session_start();

//Flash message helper

/**
 * Function to create and display error and success messages
 * @access public
 * @param string session name (key of the array)
 * @param string message (value of key)
 * @param string display class
 * @return string message
 */
function genFlashMsg($name = "", $message = "", $class = "alert alert-success") {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name . "_class"])) {
                unset($_SESSION[$name . "_class"]);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . "_class"] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . "_class"]) ? $_SESSION[$name . "_class"] : "";
            echo "<div class=\"" . $class . "\" id=\"msg-flash\">" . $_SESSION[$name] . "</div>";
            unset($_SESSION[$name]);
            unset($_SESSION[$name . "_class"]);
        }
    }
}