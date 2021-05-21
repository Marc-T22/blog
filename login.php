<?php

// Démarrage de la session
// Fonction à appeler tout en haut des fichiers (avant le moindre affichage)
session_start();

if (isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit();
}

require 'functions.php';
$pdo = getConnection();

if (!empty($_POST)) {
    // On récupère l'utilisateur à partir de son email
    $query = $pdo->prepare('
    SELECT email, password, firstname, lastname, id
    FROM users
    WHERE email = ?
    ');
    $query->execute([
        $_POST['email']
    ]);
    $user = $query->fetch();
    
    // Si l'utilisateur n'a pas été trouvé => aucun email ne correspond dans la base de données
    if ($user === null) {
        header('Location: login.php');
        exit();
    }
    
    // On vérifie que le mot de passe est correct
    if (password_verify($_POST['password'], $user['password'])) {
        // Mot de passe OK : on connecte l'utilisateur
         $_SESSION['auth'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname']
        ];
        header('Location: index.php');
        exit();
    } else {
        // Gestion de l'erreur : identifiants erronnés
        header('Location: login.php');
        exit();
    }
}
//Si l'utilisateur n'a pas été trouvé => aucun email ne correspond dans la base de données
$template = 'login';
require 'layout.phtml';