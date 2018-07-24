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
        //Run SQL
        $this->db->query("SELECT * FROM users WHERE email = :email");
        //Bind values
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

    /**
     * Registers a user.
     * @param $data - string array, contains all the registration from data
     * @return bool
     */
    public function registerUser($data) {
        //Run SQL
        $this->db->query("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");

        //Bind values
        $this->db->bind(":name", $data["name"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":password", $data["password"]);

        //Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}