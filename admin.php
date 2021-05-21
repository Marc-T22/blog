<?php

session_start();

require 'functions.php';

// var_dump($_SESSION['auth']);

if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit();
}

// Connexion à la base de données
$pdo = getConnection();
// var_dump($_POST);

//Supretion des Comments et de l'article********************************************************************************
if(!empty($_POST['sup'])){
    $query = $pdo->prepare('
        DELETE FROM comments WHERE post_id = ?
    ');
    $query->execute([
        $_POST['supC']
    ]);
    
    $query = $pdo->prepare('
        DELETE FROM posts WHERE title = ?
    ');
    $query->execute([
        $_POST['sup']
    ]);
}

// Récupération et affichage des articles*****************************************************************
$query = $pdo->prepare('
    SELECT title, content, creation_date, firstname, lastname,name ,  posts.id AS POSTid
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    INNER JOIN categories ON categories.id = posts.category_id
    ORDER BY creation_date
');

$query->execute();
$articles = $query->fetchAll();


//appel des pages necessaire à l'affichage****************************************************************
$template = 'admin';
require "layout.phtml";