<?php

class User {
    private $db;

    /**
     * User model constructor - connects to the database.
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Returns true of the email address exists in the database or false if it doesn't.
     * @param $email - string
     * @return bool
     */
    public function findUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(":email", $email);

        //Store row returned by the SQL query
        $row = $this->db->getSingleObj();

        //Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}