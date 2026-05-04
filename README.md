# Marina Neuville - Site PHP/MySQL

Site vitrine moderne pour une marina, inspiré de la structure classique d'un site institutionnel (Accueil, Services, Tarifs, Galerie, Contact), développé en **PHP** avec persistance **MySQL**.

## Fonctionnalités

- Page d'accueil moderne avec sections hero, services, tarifs et témoignages.
- Liste dynamique des services depuis MySQL.
- Formulaire de contact persistant en base.
- Galerie d'images (données en base, URLs modifiables).
- Interface d'administration légère protégée par mot de passe de session.

## Structure

- `public/` : point d'entrée web
- `src/` : logique applicative
- `config/` : configuration
- `database/` : schéma SQL

## Prérequis

- PHP 8.1+
- MySQL 8+
- Extension PDO MySQL active

## Installation locale

1. Créez la base et les tables:

```bash
mysql -u root -p < database/schema.sql
```

2. Copiez et ajustez la config:

```bash
cp config/config.example.php config/config.php
```

3. Lancez le serveur local:

```bash
php -S localhost:8000 -t public
```

4. Ouvrez `http://localhost:8000`.

## Déploiement GitHub

```bash
git init
git add .
git commit -m "Initial PHP/MySQL marina website"
git remote add origin <VOTRE_URL_GITHUB>
git push -u origin main
```

## Accès admin

- URL: `/admin.php`
- Identifiants par défaut: `admin` / `marina123`
- À modifier dans `config/config.php`.
