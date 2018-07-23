<?php

/**
 * Class Controller - base controller, loads the models and views.
 */
class Controller {

    /**
     * Loads model.
     * @param $model - string, the model that needs to be loaded.
     * @return mixed - the instantiated model
     */
    public function loadModel($model) {
       if(file_exists("../app/models/" . $model . ".php")) {
           //Require model file
           require_once "../app/models/" . $model . ".php";

           //Instantiate model
           return new $model();
       } else {
           die("Model does not exist");
       }
    }

    /**
     * Loads the view if it exists.
     * @param $view - string, the view that needs to be loaded.
     * @param array $data - OPTIONAL, data that needs to be passed to the view.
     */
    public function loadView($view, $data = []) {
        //Check for view file
        if (file_exists("../app/views/" . $view . ".php")) {
            require_once "../app/views/" . $view . ".php";
        } else {
            //View does not exist;
            die("View does not exist.");
        }
    }
}