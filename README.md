# Nessadiou

Site PHP local pour la Pepiniere de Nessadiou.

Le projet est prevu pour tourner simplement avec XAMPP, dans le dossier
`htdocs/Nessadiou`, puis etre ouvert avec :

```text
http://localhost/Nessadiou/
```

## Installation locale

1. Copier le dossier du projet dans `C:\xampp\htdocs\Nessadiou`.
2. Lancer Apache et MySQL dans XAMPP.
3. Ouvrir `http://localhost/Nessadiou/`.
4. Au premier acces a une page qui utilise la base, le projet cree automatiquement :
   - la base `nessadiou`,
   - les tables `clients`, `produits`, `commandes`,
   - quelques produits de depart,
   - un compte administrateur par defaut.

Par defaut, la connexion MySQL utilise :

```text
host: localhost
user: [OULA NON]
password: [OULA NON]
database: [OULA NON]
```

Si ta configuration locale est differente, copier :

```text
config/database.example.php
```

vers :

```text
config/database.php
```

puis modifier les valeurs. Le fichier `config/database.php` n'est pas versionne, pour eviter de partager des identifiants locaux.

## Structure du projet

- `index.php` : point d'entree principal du site.
- `public/router.php` : routeur qui choisit quelle page PHP charger.
- `config/routes.php` : noms de routes et generation des liens.
- `config/connexion.php` : connexion MySQL et initialisation de la base.
- `pages/site/` : pages principales du site.
- `pages/produits/` : fiches detaillees des produits.
- `pages/admin/` : pages d'administration.
- `pages/partials/` : morceaux communs, comme le header et le footer.
- `assets/css/` : styles CSS.
- `assets/images/` : images utilisees par le site.
- `src/` : dependances PHP locales, dont PHPMailer.
- `sql/` : scripts SQL utiles.

## Fonctionnement des liens

Les liens internes doivent passer par `route_url(...)`.

Exemple :

```php
<a href="<?php echo route_url('catalogue.fruitiers'); ?>">Fruitiers</a>
```

Cela genere une URL compatible avec Apache local, meme si la reecriture d'URL n'est pas active :

```text
/Nessadiou/catalogue/nos-fruitiers
```

Eviter de coder directement des liens comme :

```text
/public/nos-fruitiers.php
index.php/catalogue/nos-fruitiers
```

Le premier correspond a l'ancienne organisation, et le second garde inutilement `index.php` dans l'URL.

## Ajouter une nouvelle page simple

Exemple : ajouter une page `contact`.

1. Creer le fichier :

```text
pages/site/contact.php
```

2. Commencer la page avec les routes :

```php
<?php
require_once __DIR__ . '/../../config/routes.php';
?>
```

3. Ajouter la route dans `public/router.php` :

```php
'contact' => ROOT_PATH . '/pages/site/contact.php',
```

4. Creer le dossier public de la route :

```text
contact/index.php
```

avec ce contenu :

```php
<?php
require dirname(__DIR__) . '/index.php';
```

5. Si la page doit etre appelee avec un nom simple, ajouter aussi son nom dans `config/routes.php` :

```php
'contact' => 'contact',
```

6. Creer les liens avec :

```php
<a href="<?php echo route_url('contact'); ?>">Contact</a>
```

7. Si le lien doit apparaitre partout, l'ajouter dans :

```text
pages/partials/header.php
```

8. Tester dans le navigateur :

```text
http://localhost/Nessadiou/contact
```

## Ajouter une fiche produit

Exemple : ajouter une fiche `vanillier`.

1. Ajouter l'image dans :

```text
assets/images/vanillier.jpg
```

2. Creer la fiche :

```text
pages/produits/vanillier.php
```

3. Dans cette page, charger les routes :

```php
<?php require_once __DIR__ . '/../../config/routes.php'; ?>
```

4. Ajouter la route dans `public/router.php` :

```php
'produits/vanillier' => ROOT_PATH . '/pages/produits/vanillier.php',
```

5. Creer le dossier public de la route :

```text
produits/vanillier/index.php
```

avec ce contenu :

```php
<?php
require dirname(__DIR__, 2) . '/index.php';
```

6. Si la fiche doit etre liee depuis une autre page, utiliser :

```php
<a href="<?php echo route_url('produits/vanillier'); ?>">Voir la fiche</a>
```

7. Pour afficher le produit dans un catalogue, ajouter une ligne dans la table `produits`.

Les types utilises par les catalogues sont :

```text
arbre
fruitier
saisonnier
```

Exemple SQL :

```sql
INSERT INTO produits (nom, type, description, prix, image)
VALUES ('Vanillier', 'fruitier', 'Description du produit', 1500, 'vanillier.jpg');
```

## Ajouter un lien dans le menu

Le menu principal est dans :

```text
pages/partials/header.php
```

Ajouter un lien avec `route_url(...)`.

Exemple :

```php
<a href="<?php echo route_url('catalogue.arbres'); ?>">Arbres</a>
```

## Verifier avant de rendre

Verifier la syntaxe PHP :

```bash
find . -path './_archives' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
```

Tester quelques URLs dans le navigateur :

```text
http://localhost/Nessadiou/
http://localhost/Nessadiou/catalogue/nos-arbres
http://localhost/Nessadiou/catalogue/nos-fruitiers
http://localhost/Nessadiou/catalogue/nos-saisonniers
http://localhost/Nessadiou/compte/login
http://localhost/Nessadiou/panier
```
