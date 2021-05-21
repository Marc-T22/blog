<?php

session_start();

if (isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit();
}

require 'functions.php';
$pdo = getConnection();

if (!empty($_POST)) {
    $query = $pdo->prepare('
    INSERT INTO users (firstName, lastname, email, password) VALUES (?, ?, ?, ?)
    ');
    
    $query->execute([
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_BCRYPT)
    ]);
    header('Location: login.php');
    exit();
}


$template = 'register';
require "layout.phtml";