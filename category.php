<?php

require 'functions.php';
require 'app/functionrecup.php';

// Connexion à la base de données (utilisez vos propres identifiants et votre base de données)
$pdo = getConnection();

// Récupération des article de la bonne categorie********************************************************************************
$articles = recupArtgoodCat($pdo,$_GET['id']);

//affichage et recupe des categories pour la nav**********************************************************
$categories = recupCatpND($pdo);

// Ficher phtml spéficique à la page 
$template = 'category';    

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';