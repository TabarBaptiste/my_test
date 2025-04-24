# 🧠 Mémo Symfony – Commandes Utiles et Bonnes Pratiques

Ce fichier est un pense-bête pour retrouver facilement les commandes Symfony courantes, notamment pour gérer la base de données, les entités, les contrôleurs, les fixtures, etc.

---

## ⚙️ Pré-requis

- PHP ≥ 8.1
- Symfony CLI installé (`symfony`)
- Composer
- MySQL ou PostgreSQL (ou autre)

---

## 💻 Création du projet Symfony
```bash
symfony new nom_projet --version="7.2.x" --webapp
```

## 📄 Configuration du `.env` (ex: `.env.dev`)

```env
DATABASE_URL="mysql://roott@127.0.0.1:3306/nom_de_la_bdd"
```
🔐 Ne jamais versionner .env.local (ajoute-le dans .gitignore) car il contient des infos sensibles.

## 🧱 1. Création de la base de données
```bash
php bin/console doctrine:database:create
```
Symfony lit la variable `DATABASE_URL` pour savoir quoi créer.

## 🧬 2. Créer une entité
```bash
php bin/console make:entity
```
Tu peux créer une entité vide ou ajouter directement ses propriétés (avec type, nullable, relations...).

## 🏗️ 3. Générer une migration (à faire après modification d'une entité)
```bash
php bin/console make:migration
```
Cette commande crée un fichier dans `migrations/` avec les instructions SQL.

## 🚀 4. Exécuter la migration (mise à jour réelle de la base)
```bash
php bin/console doctrine:migrations:migrate
```

## 🧪 5. Créer un contrôleur
```bash
php bin/console make:controller NomController
```
Cela génère un contrôleur dans `src/Controller/` et une vue Twig dans `templates/`.

## 🌱 6. Installer et utiliser les fixtures (données de test)
### A. Installer la librairie
```bash
composer require --dev orm-fixtures
```

### B. Créer une classe de fixture
```bash
php bin/console make:fixture NomFixture
```
Une classe est générée dans src/DataFixtures/. Tu peux y injecter les repositories ou Faker :

```php
use Faker\Factory;

public function load(ObjectManager $manager)
{
    $faker = Factory::create('fr_FR');

    for ($i = 0; $i < 10; $i++) {
        $user = new User();
        $user->setEmail($faker->email());
        $user->setPassword('1234');

        $manager->persist($user);
    }

    $manager->flush();
}
```
### C. Charger les fixtures en base
```bash
php bin/console doctrine:fixtures:load

> yes
```
🧨 Attention : cela vide la base avant de la remplir à nouveau.

## 🧾 7. Créer un formulaire Symfony
```bash
php bin/console make:form
```
👉 Tu choisis l’entité liée, Symfony génère un fichier dans src/Form/.

## 🔧 8. Créer un CRUD complet
```bash
php bin/console make:crud
```
👉 Cela génère :
- Un contrôleur avec les méthodes classiques (index, new, edit, delete, show)
- Les vues Twig dans templates/
- Le formulaire associé
- Le Repository si besoin

## 👤 9. Créer une entité User avec sécurité
```bash
php bin/console make:user
```
Tu choisis :
- Le nom de la classe (User)
- Si elle peut se connecter (implémentation de UserInterface)
- Les rôles (ex: ROLE_USER, ROLE_ADMIN)


### 🔐 Ensuite, crée une migration :
```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

## 🧪 10. Création et exécution de tests Symfony
### A. Installer les dépendances nécessaires
```bash
composer require --dev symfony/test-pack
```
Cela installe PHPUnit et d'autres outils utiles.

### B. Créer un test
### 🔹Test unitaire
```bash
php bin/console make:test

> TestCase
> Unitaire\MaClasseTest
```
Un fichier est généré dans tests/Unitaire/MaClasseTest.php.

### 🔹Test fonctionnel (ex: tester une page)
```bash
php bin/console make:test

> Fonctionnel\PageAccueilTest
```

### ▶️ C. Lancer les tests
```bash
php bin/phpunit
```
Symfony exécutera tous les fichiers de test dans tests/.

### 💡 Pour tester un fichier spécifique :

```bash
php bin/phpunit tests/Fonctionnel/MonTest.php
```

## 📚 Autres commandes utiles

| Commande                                          | Description                                                                 |
|--------------------------------------------------|-----------------------------------------------------------------------------|
| `symfony serve`                                    | Démarre le serveur local Symfony                                           |
| `symfony serve -d`                                 | Démarre le serveur en arrière-plan                                         |
| `php bin/console cache:clear`                      | Vide le cache Symfony                                                      |
| `php bin/console make:form`                        | Génère un formulaire Symfony à partir d’une entité                         |
| `php bin/console make:crud`                        | Crée le CRUD complet pour une entité (formulaire, vues, contrôleur)       |
| `php bin/console make:entity`                      | Crée ou modifie une entité (avec les relations OneToMany, ManyToOne...)   |
| `php bin/console make:controller`                  | Génère un contrôleur Symfony avec sa vue associée                         |
| `php bin/console make:repository`                  | Génère un Repository manquant pour une entité                             |
| `php bin/console make:subscriber`                  | Crée un EventSubscriber personnalisé                                       |
| `php bin/console make:command`                     | Crée une commande Symfony personnalisée                                   |
| `php bin/console make:fixture`                     | Crée une classe pour insérer des données de test                          |
| `php bin/console doctrine:fixtures:load`           | Charge les fixtures en base (⚠️ supprime d'abord les données existantes)  |
| `php bin/console make:migration`                   | Génère le fichier SQL suite à un changement d’entité                      |
| `php bin/console doctrine:migrations:migrate`      | Applique les modifications de la base via les migrations                  |
| `php bin/console doctrine:schema:validate`         | Vérifie la cohérence entités / base de données                            |
| `php bin/console doctrine:database:create`         | Crée la base de données définie dans le .env                              |
| `php bin/console debug:router`                     | Liste toutes les routes Symfony connues                                   |
| `php bin/console debug:container`                  | Liste les services disponibles dans le conteneur                          |
| `php bin/console make:test`                        | Crée un test (TestCase, WebTestCase, etc.)                                |
| `php bin/phpunit`                                  | Exécute les tests PHPUnit                                                  |
| `php bin/console lint:twig`                        | Analyse les fichiers Twig à la recherche d’erreurs de syntaxe             |
| `php bin/console lint:yaml`                        | Analyse les fichiers YAML                                                  |
| `php bin/console about`                            | Donne des infos sur l’environnement Symfony actuel                         |
| `php bin/console server:status`                    | Affiche le statut du serveur Symfony local                                |


<!-- ## 🔁 Exemple complet de flux de travail
```bash
php bin/console make:entity Product
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console make:controller ProductController
php bin/console make:fixture ProductFixture
php bin/console doctrine:fixtures:load
``` -->

## 🧠 Rappel
Utilise `.env.local` pour tes infos perso (BDD, mail…)

Ne mets jamais de mots de passe dans Git

Chaque entité peut avoir son propre Repository

Toujours faire `make:migration` puis `migrate` après avoir modifié une entité