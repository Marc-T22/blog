<?php
session_start();

require 'functions.php';
require 'app/functionCreat.php';

// Connexion à la base de données (utilisez vos propres identifiants et votre base de données)
$pdo = getConnection();
/**************************************************/
if (!empty($_POST)) {
    //on créai un new commentaire**************************************************************
    creatComment($pdo, $_POST, $_SESSION['auth']['firstname']." ".$_SESSION['auth']['lastname']);
    // On redirige vers l'article sur lequel on a écrit un commentaire
    header('Location: article.php?title=' . $_GET['title']);
    exit();
} 
// Récupération de l'article 
$query = $pdo->prepare('
    SELECT title, posts.content, posts.creation_date, firstname, lastname, posts.id AS POSTid
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    WHERE title = ?
');

$query->execute([$_GET['title']]);
$article = $query->fetch(); 

//*********************************************************************************************

$query = $pdo->prepare('
    SELECT username, comments.content, comments.creation_date
    FROM comments
    INNER JOIN posts ON comments.post_id = posts.id
    WHERE title = ?
');

$query->execute([$_GET['title']]);

$comments = $query->fetchall(); 
//*******************************************************************************************



// Ficher phtml spéficique à la page 
$template = 'article';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';