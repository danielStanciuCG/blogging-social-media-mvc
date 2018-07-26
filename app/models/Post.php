<?php

class Post {
    private $db;

    /**
     * User model constructor - connects to the database.
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Returns all posts in the database as an arrray
     * @return array
     */
    public function getPosts() {
        $this->db->query("SELECT *,
                          posts.id AS postId,
                          users.id AS userId,
                          posts.created_at AS postDate,
                          users.created_at AS userSignupDate
                          from posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          ORDER BY posts.created_at DESC
                          ");

        return $this->db->getMultipleObjects();
    }

    /**
     * Adds post to the database.
     * @param $data - array (title, body)
     * @return bool - returns true if the SQL statements is executed successfully, false if otherwise.
     */
    public function addPost($data) {
        //Run SQL
        $this->db->query("INSERT INTO posts (title, user_id, body) VALUES(:title, :userId, :body)");

        //Bind values
        $this->db->bind(":title", $data["title"]);
        $this->db->bind(":userId", $data["userId"]);
        $this->db->bind(":body", $data["body"]);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}