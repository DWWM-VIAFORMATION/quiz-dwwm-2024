QUIZ-DWWM
=======
Quiz-dwwm est un projet exemple réalisé par le formateur en cours de formation. Il est conforme aux attendus du référentiel en dehors de la sécurisation pour tout ce qui concerne le BACK. La partie visuelle est inexistante.
# Points évoqués
- [x] PHP Objet (classe, encapsulation, relations, collections, héritage, interfaces, polymorphisme)
- [x] DESIGN PATTERNS: Singleton, Factory
- [x] Modèle MVC
# Fonctionnalités
- [x] Accès à la base de données via le singleton Database
- [x] Fichier de configurations: config.php
- [x] Auto-chargement des classes
- [x] Tests unitaires
- [x] URL Rewriting
- [x] routage avec gestion route, paramètres et droits d'accès
- [x] Système d'authentification basique
- [x] démonstration d'une API avec retour en JSON
# Administration serveur
- [x] Containers
- [x] Scripts de déploiement

Il est à disposition pour accompagner les bénéficiaires pendant le stage notamment. Il n'est pas utilisable en l'état:
- [] sécurisation du container insuffisante 
- [] serveur apache non sécurisé: manque notamment le protocole HTTPS
- [] non prise en compte accessibilité des pages (bien trop sommaires!)
- [] sécurisation de la connection insuffisante avec notamment possibilité de voler le cookie de session!
- [] non sécurisation des passages de paramètres: en l'état la faille XSS n'est absoluement pas bouchée!
- [] les fichiers de sécurisation ne sont pas caché et publiés dans le repository avec les mots de passe!

Ces failles sont connues: c'est au bénéficiaire de sécuriser son application à partir de ses apprentissages et recherches ! Ces manques sont totalement volontaires.
