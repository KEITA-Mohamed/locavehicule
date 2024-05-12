# Application de Gestion de Location de Véhicules

## Description
Cette application web permet de gérer la location de véhicules. Elle offre la possibilité de créer des véhicules, ainsi que de définir les dates de disponibilité pour la location. Les utilisateurs peuvent ensuite effectuer des recherches en spécifiant une date de début et une date de fin pour trouver les véhicules disponibles pendant cette période.

## Fonctionnalités
- Création, modification et suppression de véhicules avec leurs informations (marque, modèle, prix par jour).
- Définition des dates de disponibilité pour la location des véhicules.
- Recherche de véhicules disponibles pour la location en spécifiant une date de début , une date de fin et le prix maximum par jour.

## Technologies Utilisées
- Symfony Framework : Utilisé pour développer le backend de l'application.
- HTML, CSS, JavaScript : Utilisés pour développer le frontend de l'application.
- Bootstrap : Utilisé pour le design et la mise en page responsives de l'interface utilisateur.
- Base de données MySQL : Utilisée pour stocker les données des véhicules et des disponibilités.
- Git : Utilisé pour la gestion de version du code source.
- GitHub : Utilisé pour héberger le dépôt du projet.

## Installation
1. Clonez ce dépôt sur votre machine locale en exécutant la commande suivante dans votre terminal : git clone https://github.com/KEITA-Mohamed/locavehicule.git
2. Installez les dépendances PHP en exécutant la commande suivante dans le répertoire du projet : composer install
3. Configurez votre base de données dans le fichier `.env` en définissant les paramètres de connexion.
4. Créez la base de données en exécutant la commande suivante dans le répertoire du projet : php bin/console doctrine:database:create
5. Exécutez les migrations pour créer les tables de la base de données : php bin/console doctrine:migrations:migrate
6. Lancez le serveur Symfony en exécutant la commande suivante : symfony serve -d
7. Accédez à l'application dans votre navigateur en vous rendant sur l'URL indiquée dans le terminal
