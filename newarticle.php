<?php
session_start();

if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit();
}

require 'functions.php';
require 'app/functionrecup.php';
require 'app/functionCreat.php';
// Connexion à la base de données (utilisez vos propres identifiants et votre base de données)
$pdo = getConnection();

//********************************************************************************************************

//Création d'un nouvel article****************************************************************************
if (!empty($_POST)) {
     creatArticle($pdo, $_POST);
     header('Location: index.php');
     exit();
} else {
//recupe des hauteurs *************************************************************************************
    $usersliste = recupUSER($pdo);
    
//recupe des categorie*************************************************************************************
    $categories = recupCat($pdo);
}

// Ficher phtml spéficique à la page 
$template = 'newarticle';   
// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';