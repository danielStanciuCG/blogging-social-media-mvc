<?php

/**
 * App core class - creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core {
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    /**
     * Core constructor - initialises the application
     */
    public function __construct() {
        //print_r($this->getURL());
        $url = $this->getURL();

        //Use the first item in the array to get the controller
        if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
            //If exists, set as controller
            $this->currentController = ucwords($url[0]);

            //Unset 0 Index
            unset($url[0]);
        }

        //Require and instantiate the controller
        require_once "../app/controllers/" . $this->currentController . ".php";
        $this->currentController = new $this->currentController;

        //Use the second item in the array to get the method
        if (isset($url[1])) {
            //Check if method exists in the controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
            }

            //Unset 1 Index
            unset($url[1]);
        }

        //Get parameters
        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of parameters
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    /** Returns the URL paramaters.
     * @return array|mixed|string String array with the URL paramaters
     */
    public function getURL() {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}