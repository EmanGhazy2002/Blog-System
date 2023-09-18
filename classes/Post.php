<?php

Class Post {


  private $pdo;
  private $table = "posts";
  public $id;



    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function createPost($title, $content , $author_id) {

        $query = "INSERT INTO ".$this->table ."(title, content,author_id) VALUES (:title, :content, :author_id)";

        try {

            $stmt = $this->pdo->prepare($query);


            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author_id', $author_id);


            $stmt->execute();


            return true;
        } catch(PDOException $e) {

            echo $e->getMessage();
            return false;
        }
    }

    public function readAllPosts() {

        $query = 'SELECT ' . $this->table . '.* , users.username FROM ' . $this->table . ' LEFT JOIN users
        ON(' . $this->table . '.author_id = users.id ) ORDER BY ' . $this->table . '.created_at DESC' ;

        try {

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch(PDOException $e) {

            echo $e->getMessage();
            return false;
        }


    }

    function readOne($id)
    {

        $query = "SELECT p.title, p.content , p.author_id , p.created_at, u.username as author_name 
        FROM " . $this->table . " p INNER JOIN users u
         ON p.author_id = u.id WHERE p.id = ? LIMIT 0,1";

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;

        } catch (PDOException $e) {

            echo $e->getMessage();
            return false;
        }
    }



}


?>