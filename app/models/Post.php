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
                          posts.id AS postID,
                          users.id AS userID,
                          posts.created_at AS postDate,
                          users.created_at AS userSignupDate
                          from posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          ORDER BY posts.created_at DESC
                          ");

        return $this->db->getMultipleObjects();
    }
}