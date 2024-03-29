# Projet GiftBox

- SIMONIN Enzo
- HOLDER Jules
- GROMANGIN Clément

## Mettre en place le projet GiftBox sur votre machine :

### Installation :
```
git clone git@github.com:ClemGrom/Gromangin_Holder_Simonin_GiftBox.git
```

### Configuration de la base de donnée :
Dans le dossier "gift.api/src/conf" et dans le dossier "gift.appli/src/conf", créer un fichier nommé "db.conf.ini" contenant :
```
driver=mysql
username=root
password=root
host=sql
database=le_nom_de_votre_base_de_donnée
charset=utf8
collation=utf8_unicode_ci
```

### Lancement du projet avec docker :
Dans le dossier "docker" utilisez la commande : 
```
docker-compose up -d
```
    
### Installation des dépendances :
Dans le dossier "gift.api/src" et "gift.appli/src" utilisez la commande : 
```
composer install
```

### Initialisation de la base de données :
    - Rendez-vous sur l'URL de phpmyadmin: localhost:82
    - Connectez-vous avec les identifiants de votre base de données.
    - Créez une nouvelle base de données, qui contient le nom qui vous lui avez attribué
    dans votre fichier de configuration.
    - Importez le fichier "sql/giftbox.sql" dans votre base de données.

### Connexion à l'application :
Rendez-vous sur l'URL :
```
localhost:81/GiftBox
```
Pour vous connecter et accéder à toutes les fonctionnalités de l'application : 
```
    - Appuyez sur le bouton "Inscription" et créez un compte.
    - /!\ Attention /!\ : le mot de passe doit contenir minimum 8 caractères ainsi qu'une 
    majuscule minimum.
    - Connectez-vous avec vos identifiants.
```

### Tester les services de l'application avec PHPUnit :
Mise en place de la base de données :
 * Dans le dossier "gift.appli/src/conf", créer un fichier nommé "db.test.conf.ini" contenant :
```
driver=mysql
username=votre_username
password=votre_password
host=localhost:3306
database=le_nom_de_votre_base_de_donnée_de_test
charset=utf8
collation=utf8_unicode_ci
```
 * Sur phpmyadmin créez une base de données vide 
 * Pour tester les presations utilisez la commande :
```
gift.appli/src/vendor/bin/phpunit gift.appli/tests/services/prestations/PrestationServiceTest.php
```

### Connexion à l'API : 
Accéder à la liste des catégories :
```
localhost:8080/api/categories
```
Accéder à la liste des prestations :
```
localhost:8080/api/prestations
```
Accéder à la liste des prestations d'une catégorie :
```
localhost:8080/api/categories/{id}/prestations
```
Accéder à une box :
```
localhost:8080/api/coffrets
```
