<?php

function getConnection(): PDO
{
    return new PDO(
        'mysql:host=db.3wa.io;dbname=marctri_blog;charset=UTF8', 
        'marctri', 
        '9f313bd57b7742a7cef96cdce500131e', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
}

