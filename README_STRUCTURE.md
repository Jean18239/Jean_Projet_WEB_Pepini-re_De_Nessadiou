# Structure du projet Nessadiou

Le projet est organise autour de dossiers fonctionnels. La racine garde seulement `index.php` comme point d'entree principal; les autres points d'entree publics sont ranges dans `public/`.

## Installation avec XAMPP sur Windows

1. Copier le dossier du projet dans `C:\xampp\htdocs\Nessadiou`.
2. Lancer Apache et MySQL depuis le panneau XAMPP.
3. Ouvrir `http://localhost/Nessadiou/index.php`.
4. Laisser le projet creer automatiquement la base `nessadiou` et les tables au premier acces a une page qui utilise la base de donnees.

Par defaut, la connexion MySQL utilise `root` sans mot de passe, ce qui correspond a une installation XAMPP locale classique. Si la configuration MySQL est differente, copier `config/database.example.php` vers `config/database.php`, puis modifier les valeurs. Le fichier `config/database.php` est ignore par Git pour eviter de partager des identifiants locaux.

Le projet vise PHP 7.4+ et fonctionne avec les XAMPP recents. Les liens principaux utilisent `public/`, donc le site ne depend pas obligatoirement de la reecriture Apache pour naviguer. Le fichier `.htaccess` sert surtout a garder des anciennes URLs plus propres quand `mod_rewrite` est actif.

## Dossiers principaux

- `pages/site/` : pages publiques du site, connexion, inscription, commandes et ateliers.
- `pages/produits/` : fiches detaillees des produits.
- `pages/admin/` : pages d'administration et suivi des commandes.
- `public/` : wrappers publics qui chargent les fichiers ranges dans `pages/site`, `pages/produits` ou `pages/admin`.
- `assets/css/` : feuilles de style.
- `assets/images/` : images utilisees par les pages.
- `config/` : configuration, notamment la connexion a la base de donnees.
- `src/` : dependances PHP locales, dont PHPMailer.
- `sql/` : scripts SQL de creation et de mise a jour.
- `_archives/doublons-racine/` : anciennes copies de fichiers rangees pour ne pas encombrer la racine.

## Regles de chemins

- Depuis `pages/site/*` et `pages/admin/*`, utiliser `../../assets/...`, `../../config/...` et `../../src/...`.
- Depuis `pages/produits/*`, utiliser `../../assets/images/...` pour les images.
- Depuis `assets/css/*`, les images se referencent avec `../images/...`.
- Les images en base de donnees peuvent rester sous forme de nom de fichier simple, par exemple `manguier.webp`; les pages catalogue les resolvent vers `../../assets/images/`.

## Points d'entree utiles

- `index.php` charge `public/index.php`, qui charge `pages/site/index.php`.
- `public/*.php` charge les pages correspondantes dans `pages/site`, `pages/produits` ou `pages/admin`.
