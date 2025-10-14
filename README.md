# Camagru

Camagru est une application web complète de capture, d’édition et de partage d’images.  
Conçue en PHP natif, HTML, CSS et JavaScript pur, elle propose une expérience fluide, sécurisée et entièrement auto-hébergée.

---

## Présentation

L’application permet à tout utilisateur de créer un compte, de prendre une photo avec sa webcam ou d’importer une image, d’y superposer des calques transparents, puis de publier sa création dans une galerie publique.  
Chaque publication peut être consultée, commentée et aimée par d’autres utilisateurs connectés.

Camagru met l’accent sur la fiabilité, la sécurité et la performance, tout en respectant les standards modernes du Web.  

---

## Fonctionnalités principales

### Gestion des utilisateurs
- Inscription avec validation par e-mail et lien de confirmation unique  
- Authentification sécurisée avec mot de passe chiffré (bcrypt)  
- Réinitialisation de mot de passe par e-mail  
- Modification du profil : nom d’utilisateur, adresse e-mail, mot de passe  
- Gestion des préférences de notification

### Édition d’images
- Capture d’image en direct via la webcam (API `getUserMedia`)  
- Téléversement manuel d’une image en alternative  
- Sélection et superposition d’images PNG transparentes  
- Fusion côté serveur via GD ou Imagick  
- Miniatures automatiques et suppression des créations personnelles  

### Galerie publique
- Affichage paginé des images de tous les utilisateurs  
- Classement par date de création  
- Système de likes et de commentaires  
- Notification automatique par e-mail lors de nouveaux commentaires  
- Interface responsive et adaptée aux mobiles  

### Sécurité et conformité
- Chiffrement des mots de passe avec `password_hash()`  
- Protection CSRF sur tous les formulaires  
- Échappement du contenu utilisateur (prévention XSS)  
- Requêtes SQL sécurisées avec PDO et statements préparés  
- Données sensibles isolées dans un fichier `.env` non versionné  
- Validation stricte des entrées et des fichiers envoyés  

---

## Architecture technique

| Couche | Technologie |
|---------|--------------|
| Backend | PHP 8.x (standard library uniquement) |
| Base de données | MySQL / MariaDB |
| Frontend | HTML5, CSS3, JavaScript natif |
| Serveur | Nginx / Apache / PHP built-in |
| Déploiement | Docker Compose |

---

## Structure du projet

```
Camagru/
├── docker-compose.yml
├── nginx.conf
├── src/
│   ├── index.php
│   ├── config/
│   │   └── database.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── ImageController.php
│   │   ├── GalleryController.php
│   │   └── CommentController.php
│   ├── models/
│   │   ├── User.php
│   │   ├── Image.php
│   │   ├── Comment.php
│   │   └── Like.php
│   ├── views/
│   │   ├── layout.php
│   │   ├── editor.php
│   │   ├── gallery.php
│   │   └── auth/
│   │       ├── login.php
│   │       ├── register.php
│   │       └── reset_password.php
│   ├── lib/
│   │   ├── mail.php
│   │   ├── csrf.php
│   │   ├── security.php
│   │   └── utils.php
│   └── public/
│       ├── css/
│       ├── js/
│       └── overlays/
└── README.md
```

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/ifranc-r/Camagru.git
cd Camagru
```

### 2. Créer le fichier `.env`

```
DB_HOST=localhost
DB_NAME=camagru
DB_USER=root
DB_PASS=motdepasse
APP_URL=http://localhost:8080
MAIL_FROM=no-reply@camagru.local
```

### 3. Lancer l’environnement

```bash
docker compose up -d
```

Application disponible sur :  
[http://localhost:8080](http://localhost:8080)

### 4. Initialiser la base de données

```bash
mysql -u root -p camagru < database/schema.sql
```

---

## Mise à jour et maintenance

Le rafraîchissement de la galerie et les notifications automatiques sont gérés par des scripts PHP appelables via cron.  
Les logs d’erreurs sont redirigés vers un fichier dédié pour garantir un environnement propre en production.

---

## Licence

Projet distribué sous licence MIT.  
Libre d’utilisation, de modification et de diffusion, à condition d’en conserver la mention d’auteur.

---

## Auteur

**FRANC-REGIS TERENCE**  
[GitHub](https://github.com/ifranc-r)  

