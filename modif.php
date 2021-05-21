<?php
session_start();

if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit();
}

require 'functions.php';
require 'app/functionrecup.php';
require 'app/functionCreat.php';

// Connexion à la base de données 
$pdo = getConnection();

// Modifier l'article dans la base de donnée***********************************************************
if (!empty($_POST['articleModif'])) {
    
    modifyArticle($pdo, $_POST, $_GET['thisID']);
    header('Location: index.php');
    exit();
}
// Afficher le contenu de l'article à modifié**********************************************************
$article = recupInfoArt($pdo, $_GET['thisID']);

// Afficher les categories*****************************************************************************
$categories = recupCat($pdo);

$template = 'modif';
require "layout.phtml";