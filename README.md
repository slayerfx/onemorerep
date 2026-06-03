# OneMoreRep

Forge ton programme, forge ton corps.

Site de musculation permettant de consulter une bibliothèque d'exercices, créer des programmes d'entraînement personnalisés et calculer sa dépense énergétique journalière (TDEE).

Projet de fin de formation - Louenn Penanc'hoat, BRE05 3W Academy 

## Stack technique

- PHP 8.x (architecture MVC sans framework)
- MySQL via PDO (requêtes préparées)
- Templates .phtml (layout + partials)
- CSS natif (mobile-first, Flexbox, Grid)
- JavaScript vanilla (Fetch API)
- Composer (vlucas/phpdotenv)

## Prérequis

- PHP 8.x
- MySQL 8.x
- Composer
- Un serveur local (Laragon, WAMP, XAMPP ou MAMP)

## Installation en local

1. Cloner le dépôt

```bash
git clone https://github.com/slayerfx/onemorerep.git
cd onemorerep
```

2. Installer les dépendances PHP

```bash
composer install
```

3. Créer le fichier d'environnement

Copier le fichier `.env.example` en `.env` et remplir avec vos identifiants de base de données.

```bash
cp .env.example .env
```

```
DB_HOST=localhost
DB_NAME=onemorerep
DB_CHARSET=utf8mb4
DB_USER=root
DB_PASSWORD=
```

4. Importer la base de données

Importer le fichier `onemorerep.sql` dans phpMyAdmin ou en ligne de commande :

```bash
mysql -u root -p onemorerep < onemorerep.sql
```

5. Lancer le serveur local

Placer le projet dans le dossier de votre serveur local (ex : `C:\laragon\www\onemorerep`) et accéder à `http://localhost/onemorerep`.

## Compte admin de test

- Email : louenn@onemorerep.fr
- Mot de passe : voir le jeu de données de test

## Structure du projet

```
onemorerep/
├── index.php              Point d'entrée unique
├── config/                Configuration et autoload
├── controllers/           Controllers MVC
├── managers/              Accès base de données (PDO)
├── models/                Classes PHP (objets métier)
├── services/              Router et services
├── templates/             Templates .phtml (layout, partials, pages)
├── assets/                CSS, JavaScript, images
└── onemorerep.sql         Script SQL de la base de données
```
