# Sparfind.v1
Projet Annuel ESGI 1
https://sparfind.com
https://51.222.13.147/ (si problème de DNS)

## L’union fait la force

### Présentation

**SPARFIND** a pour mission de faciliter la recherche de partenaires d'entraînement et de groupes pour les sportifs désireux de pratiquer leur discipline de manière plus régulière grâce à une application web.

SPARFIND permet aux utilisateurs d'améliorer leur niveau en rencontrant et en s'entraînant avec des athlètes diversifiés, tout en favorisant la création d'une communauté sportive locale dynamique.

### Équipe

- **Benjamin DARMON**: Mise en place de l'infrastructure et gestion du système de gestion des e-mails.
- **Ismael DHIMENE**: Développement de la charte graphique et de l'identité visuelle de l'application web.
- **Nathanael BUKIATME**: Développement du front-end et intégration de la charte graphique.
- **Benjamin WAGNER**: Développement du back-end et gestion des API pour la géolocalisation.

### Public Ciblé

SPARFIND s'adresse aux sportifs de tous niveaux souhaitant trouver un partenaire d'entraînement ou un groupe pour une pratique plus régulière et efficace. Notre solution facilite la connexion entre sportifs, permettant aux utilisateurs d'améliorer leur niveau en rencontrant des amateurs variés, favorisant ainsi la création d'une communauté sportive locale grâce à de nouvelles rencontres.

SPARFIND propose une solution innovante, gratuite et accessible à tous.

### Fonctionnalités In Scope

- **Recherche de partenaires et de groupes**: Facilite la recherche de partenaires d'entraînement ou de groupes pour une pratique sportive plus régulière.
- **Géolocalisation**: Utilisez la géolocalisation pour trouver des sportifs à proximité.
- **Système de vérification des utilisateurs**: Garantie des rencontres sûres et fiables.
- **Système de notation**: Évaluez et choisissez vos partenaires d'entraînement en toute confiance.

### Fonctionnalités Out of Scope

- **Pas de support pour des sports autres que les sports de combat**: Actuellement, notre association ne prend en charge que les sports de combat.
- **Absence de coaching personnalisé**: Nous ne proposons pas de services de coaching personnalisé ou de programmes d'entraînement sur mesure.
- **Pas de fonctionnalités de suivi des performances**: L'association n'inclut pas de fonctionnalités pour suivre les performances sportives ou les progrès des utilisateurs.
- **Absence de forums de discussion**: L'association ne dispose pas de forums de discussion ou de groupes de chat en ligne.

### Personas

#### Lucie
- **Âge**: 35 ans
- **Profession**: Ingénieur en informatique
- **Niveau sportif**: Pratiquante confirmée
- **Sport pratiqué**: M.M.A

**Objectif**: Perfectionner son art martial en élargissant son cercle d'entraînement et en échangeant avec des partenaires de différents niveaux de compétence. Grâce à SPARFIND, elle peut renforcer ses compétences en s'entraînant avec des athlètes variés et jouer un rôle de mentor pour les débutants.

#### Damien
- **Âge**: 27 ans
- **Profession**: Graphiste
- **Niveau sportif**: Débutant
- **Sports pratiqués**: Boxe, kickboxing

**Objectif**: Améliorer son endurance et perfectionner sa technique en boxe et en kickboxing. En tant que débutant, il cherche à progresser rapidement en s'entraînant avec des partenaires adaptés et motivés. Grâce à SPARFIND, il peut trouver des partenaires, bénéficier de conseils et de soutien pour atteindre ses objectifs sportifs.

### Technologies Utilisées

#### Front-End
- **HTML**: Structure de la page
- **JavaScript**: Fonctionnalités interactives
- **CSS**: Style visuel

#### Back-End
- **PHP**: Logique côté serveur
- **MariaDB**: Système de Gestion de Base de Données
- **Docker**: Gestion des conteneurs
- **Traefik**: Reverse proxy pour le load balancing

### Schéma Technique et Applicatif

- **Virtual Private Server**: Héberge le serveur web NGINX et MariaDB.
- **Conteneurs (Docker)**: Les différentes parties de l’application web sont encapsulées dans des conteneurs Docker.
- **Reverse Proxy (Traefik)**: Assure le load balancing entre les conteneurs pour une répartition efficace de la charge.

### Répartition des Tâches

- **Benjamin DARMON**: Mise en place de toute l'infrastructure et développement du système de gestion des e-mails.
- **Ismael DHIMENE**: Développement et création de la charte graphique et l'identité visuelle de l'application web.
- **Nathanael BUKIATME**: Développement de l'intégralité du front-end et intégration de la charte graphique et l'identité visuelle.
- **Benjamin WAGNER**: Développement de l'intégralité du back-end et prise en charge de la gestion des API pour la géolocalisation.

### Tests

#### Réussis
- Implémentation du back-end en production.
- Mise en place des mails automatiques.
- Création d’un dépôt git partagé.

#### Échoués
- Intégration de la géolocalisation en temps réel.
- Création d’une BDD et accès via VPN.
- Création d’une application mobile.

## Audit de Sécurité

### Faille Critique à Modifier

Une faille critique a été identifiée : l'utilisateur peut changer de compte en modifiant l'ID présent dans l'URL. Cette vulnérabilité compromet la sécurité en permettant un accès non autorisé aux comptes des utilisateurs. PATCHER

### Problèmes de Sécurité Identifiés

1. **Absence de Vérification du Mot de Passe** :
   - Malgré la confirmation par e-mail lors de l'inscription, il n'y a pas de vérification pour changer le mot de passe ni de processus pour réinitialiser un mot de passe oublié.

2. **Champ de Code Postal Non Sécurisé** :
   - Le champ de code postal est actuellement un champ texte, ce qui peut conduire à des erreurs de validation et à des injections de données non sécurisées.

3. **Port 3306 Non Sécurisé** :
   - Le port 3306 utilisé par MariaDB est ouvert sans nécessité apparente. Il a été ensuite fermé.

4. **Anti-Brute Force pour SSH** :
   - Mise en place de fail2ban pour contrer les attaques par force brute contre SSH.

## Axes d'Amélioration

1. **Développement d'une Application Mobile** :
   - Créer une application mobile pour offrir une expérience utilisateur plus fluide et accessible.

2. **URLs Propres sans Extensions** :
   - Réécrire les URLs pour les rendre propres et sans extensions visibles, améliorant ainsi la sécurité et l'esthétique.

3. **Validation et Sanitization des Entrées** :
   - Mettre en place une validation rigoureuse et une sanitization des entrées utilisateur pour éviter les erreurs et les attaques par injection.

4. **Conditions Générales d'Utilisation (CGU)** :
   - Rédiger et implémenter des CGU pour clarifier les droits et obligations des utilisateurs, renforçant ainsi la transparence et la sécurité juridique.

5. **Pentest Complet du Site** :
   - Effectuer un test de pénétration complet du site pour identifier et corriger d'autres éventuelles failles de sécurité.

# PERSONNA

## Profil de Lucie Cielu

**Prénom :** Lucie  
**Nom :** Cielu  
**Âge :** 35 ans  
**Code Postal :** 13090  
**Ville :** Aix-En-Provence  
**Adresse :** Rue du général Carrefour  
**E-Mail :** lucie@gmail.com  
**Mot de passe :** PASSWORD 

**Profession :** Ingénieur en informatique  
**Niveau sportif :** Pratiquante confirmée  
**Sport pratiqué :** M.M.A  

### PROFIL
Lucie vise à perfectionner son art martial en élargissant son cercle d'entraînement et en échangeant avec des partenaires de différents niveaux de compétence.

### OBJECTIF
Grâce à Sparfind, je vais pouvoir renforcer mes compétences en m'entraînant avec des athlètes variés, mais aussi jouer un rôle de mentor pour les débutants, en les guidant dans leur progression.

## Profil de Damien Miendu

**Prénom :** Damien  
**Nom :** Miendu  
**Âge :** 27 ans  
**Code Postal :** 13090  
**Ville :** Aix-En-Provence  
**Adresse :** Rue du colonel Moutarde  
**E-Mail :** damien@gmail.com  
**Mot de passe :** PASSWORD

Profession : Graphiste
Niveau sportif : Débutant
Sports pratiqués : Boxe, kickboxing

### PROFIL
L'objectif de Damien est d'améliorer son endurance et de perfectionner sa technique en boxe et en kickboxing.
En tant que débutant, il cherche à progresser rapidement en s'entraînant avec des partenaires adaptés et motivés.

### OBJECTIF
Grâce à Sparfind, je vais pouvoir trouver des partenaires, tout en me permettant de bénéficier de conseils et de soutien pour atteindre mes objectifs sportifs.
