<?php

//Créer un Article******************************************************************************************
function creatArticle(PDO $connection, array $data): void
{
    $query = $connection->prepare('
        INSERT INTO posts (title, content, author_id, category_id, creation_date) VALUES (?, ?, ?, ?, NOW())
    ');
    
    $query->execute([
        $data['title'],
        $data['articleNew'],
        $data['author'],
        $data['category']
    ]);
}
//Modifier un Article**************************************************************************************
function modifyArticle(PDO $connection, array $data, $id): void
{
    $query = $connection->prepare('
    UPDATE posts SET title = ?, content = ?, category_id =?
    WHERE id = ?
    ');
    $query->execute([
        $data['titleModif'],
        $data['articleModif'],
        $data['categoryModif'],
        $id
    ]);
}
//Créer un Commentaire***********************************************************************************
function creatComment(PDO $connection, array $data, string $auteur): void
{
    $query = $connection->prepare('
        INSERT INTO comments (username, content, post_id, creation_date) VALUES (?, ?, ?, NOW())
    ');
    $query->execute([
        $auteur,
        $data['commentaireNew'],
        $data['POSTid']
    ]);
}