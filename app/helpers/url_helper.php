<?php

/**
 * Redirects to a specific page.
 * @param $page - string, the location to the page to be redirected too.
 */
function redirect($page) {
    header("location: " . URL_ROOT . "/" . $page);
}