# Forum - TP CRUD + MVC

## Installation

### Prérequis
- PHP 7.4+
- MySQL
- Apache (ou serveur web compatible)
- MAMP/LAMP/WAMP

### Étapes d'installation

1. **Cloner ou télécharger le projet**

2. **Configurer la base de données**
   - Modifier les paramètres de connexion MySQL dans `Core/config.xml`
   ```xml
   <host>localhost</host>
   <user>****</user>
   <password>****</password>
   <db>forum</db>
   ```

3. **Créer la base de données**
   - Exécuter le fichier SQL : `SQL/forum.sql`

4. **Vérifier l'accès**
   - Mettre à jour l'URI de base quand on est en local dans `Core/Router.php` et `ROOT_URL`dans `index.php`
   - Accéder au site en local, ex: `http://localhost:8888/orphee/POO/TP-CRUD`
   - Créer un compte utilisateur
   - Utiliser le forum

## Architecture du projet: `MVC + Service`

### Flux de requête

1. **Router** : Analyse l'URL et appelle le bon Controller
2. **Controller** : Reçoit la requête, fait appel au Service
3. **Service** : Contient la logique métier et les validations
4. **Model** : Accède à la base de données
5. **View** : Affiche le résultat

### Pourquoi `Service`

1. **Séparation des responsabilités**
   - Controller : Orchestration HTTP
   - Service : Logique métier
   - Model : Accès données
   - View : Affichage

2. **Maintenabilité**
   - Code organisé et lisible
   - Chaque classe a une responsabilité unique
   - Modifications facilitées

## Fonctionnalités principales

### Utilisateurs
- Inscription avec validation email
- Connexion avec session
- Modification du profil
- Déconnexion
- Unicité email (amélioration future)
- Utilisateur sans avatar (amélioration future)

### Posts
- Créer un post (titre + contenu)
- Afficher la liste des posts avec nombre de commentaires
- Voir le détail d'un post
- Modifier/Supprimer son propre post
- Lazy loading + Pagination (amélioration future)
- Réagir aux posts (amélioration future)

### Commentaires
- Ajouter un commentaire sur un post
- Affichage chronologique
- Voir l'auteur du commentaire
- Modification/Suppression possible (amélioration future)
