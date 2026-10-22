# Popy Space

Application Symfony de **gestion de planètes et de voyages** : fiches, formulaires et pages Twig.

Exercice de modélisation : une planète a des caractéristiques, un voyage relie des planètes, les écrans permettent de créer, filtrer et feuilleter les deux catalogues.

<p align="center">
  <img src="https://img.shields.io/badge/php-8.2-777BB4?logo=php&logoColor=white" alt="PHP 8.2" />
  <img src="https://img.shields.io/badge/symfony-7.3-000000?logo=symfony&logoColor=white" alt="Symfony 7.3" />
  <img src="https://img.shields.io/badge/doctrine-ORM-1A1A1A" alt="Doctrine" />
  <img src="https://img.shields.io/badge/docker-ready-2496ED?logo=docker&logoColor=white" alt="Docker" />
</p>

<p align="center">
  <strong>Dépôt :</strong> <a href="https://github.com/Meriem1403/PopySpaceOrigin">github.com/Meriem1403/PopySpaceOrigin</a>
</p>

---

## Sommaire

- [Présentation](#présentation)
- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Tests](#tests)
- [Sécurité](#sécurité)
- [Structure du projet](#structure-du-projet)

---

## Présentation

Deux ressources suffisent à couvrir le sujet : `Planete` et `Voyage`. Les contrôleurs exposent les listes et les formulaires. L'interface s'appuie sur les composants Twig et Live Component de Symfony UX, avec autocomplétion et pagination.

---

## Fonctionnalités

| Module | Description |
|--------|-------------|
| **Planètes** | Création, édition, liste paginée |
| **Voyages** | Liaison entre planètes, formulaire, consultation |
| **Accueil** | Entrée vers les deux catalogues |
| **Composants** | Modales, sélecteur de date, autocomplétion |

---

## Stack technique

| Couche | Technologies |
|--------|----------------|
| Backend | PHP 8.2, Symfony 7.3 |
| Données | Doctrine ORM 3, migrations |
| Pagination | Pagerfanta |
| Interface | Twig, Stimulus, Turbo, UX Live Component, UX Autocomplete |
| Styles | Tailwind (build dans `tailwind-build/`) |
| Tests | PHPUnit |
| Conteneurisation | Docker Compose (`compose.yaml`) |

---

## Prérequis

- **Docker** et Docker Compose
- **Git**

---

## Installation

```bash
git clone https://github.com/Meriem1403/PopySpaceOrigin.git
cd PopySpaceOrigin
docker compose up --build
```

Le compose démarre PostgreSQL (recette Doctrine). Créer un `.env.local` non versionné avec `APP_SECRET` et `DATABASE_URL`, puis lancer l'application avec `symfony serve`.

Le mot de passe par défaut du conteneur est celui de `compose.yaml`. Le remplacer avant tout usage autre que le poste de développement.

Appliquer les migrations une fois la base joignable :

```bash
php bin/console doctrine:migrations:migrate
```

---

## Tests

```bash
php bin/phpunit
```

La configuration est `phpunit.dist.xml`.

---

## Sécurité

`.env` hors de Git. Le jeu de planètes est fictif : ne pas y mélanger de donnée personnelle.

---

## Structure du projet

```
PopySpaceOrigin/
├── src/Controller/     # Main, Planete, Voyage
├── src/Entity/         # Planete, Voyage
├── templates/
├── migrations/
├── tests/
└── compose.yaml
```

---

<p align="center">
  <sub>Popy Space — planètes et voyages, Symfony et Doctrine.</sub>
</p>
