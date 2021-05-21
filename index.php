<?php

require 'functions.php';
require 'app/functionrecup.php';

// Connexion à la base de données
$pdo = getConnection();

// Récupération et affichage des diferantes Categories*************************************************************
$categories = recupCatpND($pdo);

/********************************************************pagination*/
$query = $pdo->prepare('
    SELECT COUNT(title) AS totalposts
    FROM posts
');

$query->execute();
$results = $query->fetch();

$resultsPerPage = 3;
$totalPages = ceil($results['totalposts'] / $resultsPerPage);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    // Page par défaut quand aucune page n'est stipulée dans l'url
    $page = 1;
}

$offset = ($page - 1) * $resultsPerPage;

//Recuperation et affichage des Articles*******************************************************************

$articles = recupArticl($pdo,$resultsPerPage,$offset);

// Ficher phtml spéficique à la page 
$template = 'index';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';