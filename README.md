# OneMoreRep

Forge ton programme, forge ton corps.

Site de musculation permettant de consulter une bibliothèque d'exercices, créer des programmes d'entraînement personnalisés et calculer sa dépense énergétique journalière (TDEE).

**🔗 Site en ligne :** https://onemorerep.infinityfree.io

Projet de fin de formation - Louenn Penanc'hoat, BRE05 3W Academy 

## Stack technique

- PHP 8.x (architecture MVC sans framework)
- MySQL 8.x via PDO (requêtes préparées)
- Templates .phtml (layout + partials)
- CSS natif (mobile-first, Flexbox, Grid)
- JavaScript vanilla (Fetch API)
- Composer (vlucas/phpdotenv)

Pour l'installer en local : PHP 8.x, MySQL 8.x, Composer et un serveur local (Laragon, WAMP, XAMPP ou MAMP).

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

Dans phpMyAdmin : créer une base nommée `onemorerep` (onglet « Bases de données »), la sélectionner, puis onglet « Importer », choisir `onemorerep.sql` et exécuter. Le fichier contient 5 tables + un jeu de données de test ; chaque table étant recréée via `DROP TABLE IF EXISTS`, il peut être réimporté à tout moment pour réinitialiser la base.

5. Lancer le serveur local

Placer le projet dans le dossier de votre serveur local (ex : `C:\laragon\www\onemorerep`) et accéder à `http://localhost/onemorerep`.

## Déploiement en production (InfinityFree)

Le site est hébergé sur InfinityFree, un hébergement mutualisé gratuit (PHP + MySQL + certificat SSL inclus). Le transfert des fichiers se fait via FileZilla en FTP. Vérifier dans le panneau InfinityFree que la version PHP sélectionnée est bien une 8.x.

1. Créer la base de données distante

Dans le panneau InfinityFree, section « MySQL Databases », créer une base. InfinityFree impose un nom préfixé (ex : `if0_XXXXXXX_onemorerep`) et fournit l'hôte MySQL, l'utilisateur et le mot de passe à réutiliser dans le `.env`.

2. Importer le jeu de données

Dans le phpMyAdmin d'InfinityFree, sélectionner la base créée à l'étape 1, onglet « Importer », choisir `onemorerep.sql` et exécuter. Le fichier s'importe directement dans la base sélectionnée (il ne contient pas de `CREATE DATABASE`).

3. Transférer les fichiers via FileZilla

Récupérer les identifiants FTP dans le panneau InfinityFree (hôte FTP, utilisateur, mot de passe), puis se connecter avec FileZilla. Transférer tout le contenu du projet dans le dossier `htdocs/` du serveur.

Le dossier `vendor/` (dépendances Composer) doit aussi être transféré : le plan gratuit InfinityFree ne permet pas de lancer `composer install`. Les dossiers `docs/`, `tests/` et `.git/` ne sont pas nécessaires en production.

4. Créer le fichier `.env` de production

Le `.env` n'est pas versionné (il est dans le `.gitignore`), il n'est donc pas dans le dépôt. Le créer directement sur le serveur (ou le transférer via FileZilla) avec les identifiants MySQL fournis par InfinityFree :

```
DB_HOST=sqlXXX.infinityfree.com
DB_NAME=if0_XXXXXXX_onemorerep
DB_CHARSET=utf8mb4
DB_USER=if0_XXXXXXX
DB_PASSWORD=votre_mot_de_passe
```

5. Tester en production

Accéder à l'URL du site (sous-domaine InfinityFree) et vérifier le parcours complet : accueil et carte, liste et filtres d'exercices, inscription et connexion, création d'un programme, calculateur TDEE. Remplacer enfin le mot de passe du compte administrateur par un mot de passe privé.

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Admin | louenn@onemorerep.fr | Test1234! |
| Utilisateur | sarah@test.fr | Test1234! |

Ces identifiants servent uniquement à la démo en local. En production, le mot de passe de l'administrateur doit être remplacé par un mot de passe privé qui n'apparaît jamais dans le dépôt.

## Tests

Les tests unitaires (PHPUnit) couvrent le calcul du TDEE selon la formule Mifflin-St Jeor (cas homme et femme). Pour les lancer :

```bash
composer test
```

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
