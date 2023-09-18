<?php

require_once('C:\laragon\www\Blogy\config\database.php');
require_once('C:\laragon\www\Blogy\classes\Post.php');


$post = new Post($pdo);


$posts = $post->readAllPosts();

if ($posts)
    print_r($posts);


?>