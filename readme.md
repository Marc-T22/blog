# Blog

## Création de la base de données

1. Créer une nouvelle base de données live-46_{nom utilisateur}_blog, interclassement utf8mb4_unicode_ci
2. Créer les différentes tables selon ce [schéma] (http://live-46.sites.3wa.io/dev/php/m01/exercices/blog/blog.png)
 * les id (clés primaires) : type int, pas de taille/valeurs, index primary (cliquer sur exécuter sur la modale), cocher la case AI
 * title et les name : type varchar, préciser la taille maximum dans taille/valeurs
 * creation_date : type datetime, pas de taille/valeurs
 * content: type text
 * les clés étrangères (post_id, author_id, category_id) : type int, pas de taille/valeurs
3. Faire le lien entre les tables
Contraintes de clé étrangère sur les tables posts et comments :
Aller dans la table sur laquelle vous voulez créer une ou plusieurs contraintes de clé étrangère 
puis dans structure > vue relationnelle, créer les contraintes de clé étrangère
post_id -> posts.id
author_id -> users.id
category_id -> categories.id
4. Créer quelques catégories, quelques auteurs puis quelques articles

## Création du site

Démo : [Lien vers le blog](http://cedricleclinche.sites.3wa.io/blog/src/index.php)

### Fonctionnalités attendues

* Liste des articles (sur index et admin)
* Détail d'un article
* Liste des commentaires d'un article
* Créer un nouvel article
* Créer un nouveau commentaire
* Modifier un article existant
* Supprimer un article

## Connexion/Inscription

* Créer dans la table des utilisateurs 2 nouvelles colonnes: email, password
email : varchar(100) - cocher la case "null"
password: varchar(60) - cocher la case "null"
* Créer une page login.php et register.php ainsi que 2 templates login.phtml et register.phtml
* Créer les formulaires d'inscription et de connexion sur les templates
Inscription:
email
mot de passe
nom
prénom
Connexion
email
mot de passe
* Gérer l'inscription de l'utilisateur lorsque l'on soumet le formulaire d'inscription 
(ajout d'un nouvel utilisateur dans la base de données)