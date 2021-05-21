<?php
//recuper les users****************************************************
function recupUser(PDO $connection): array
{
   $query = $connection->prepare('
    SELECT firstname, lastname, id
    FROM users
    ');
    
    $query->execute();
    
    return $query->fetchAll();
}
//recup les Categories*************************************************
function recupCat(PDO $connection): array
{
     $query = $connection->prepare('
        SELECT name, id
        FROM categories
    ');
    
    $query->execute();
    return $query->fetchAll();
}
//Recup les info sur l'article pour le modifier*************************
function recupInfoArt(PDO $connection, $id): array
{
    $query = $connection->prepare('
    SELECT title, content, creation_date, firstname, lastname,name ,  posts.id AS POSTid
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    INNER JOIN categories ON categories.id = posts.category_id
    WHERE posts.id = ?
    ');
    $query->execute([
        $id
    ]);
    return $query->fetch();
}
//Recup Article*********************************************************
function recupArticl(PDO $connection, $rpp, $off): array
{
    $query = $connection->prepare("
    SELECT title, content, creation_date, firstname, lastname
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    ORDER BY creation_date
    LIMIT $rpp OFFSET $off
    ");
    $query->execute();
    return $query->fetchAll();
}
//Recup Categorie et le nb de post/category******************************
function recupCatpND(PDO $connection ): array
{
    $query = $connection->prepare('
    SELECT name, categories.id AS ID, COUNT(title) AS nbART
    FROM categories
    INNER JOIN posts ON posts.category_id = categories.id
    GROUP BY categories.id  
    ');
    $query->execute();
    return $query->fetchAll();
}
//Recupe les Article de la bonne categorie****************************
function recupArtgoodCat(PDO $connection, $id ): array
{
    $query = $connection->prepare('
    SELECT title, content, creation_date, firstname, lastname
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    WHERE category_id = ?
    ORDER BY creation_date
');

$query->execute([
    $id
    ]);

return $query->fetchAll();
}
