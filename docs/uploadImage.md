# Comment stocker une image depuis un formulaire

Pour gérer l'upload d'une image via un formulaire PHP en méthode POST, vous avez deux options principales pour stocker l'image : soit dans une base de données, soit dans un dossier sur le serveur. Chacune de ces méthodes a ses avantages et ses inconvénients, et le choix dépend de vos besoins spécifiques.

## Stocker l'image dans une base de données

**Avantages** :

Contrôle centralisé : Toutes les images sont stockées au même endroit, ce qui facilite leur gestion.
Intégration avec d'autres données : Si l'image est liée à d'autres informations (par exemple, des métadonnées), stocker l'image dans la base de données peut être plus logique.

**Inconvénients** :

Performance : Stocker des images directement dans la base de données peut ralentir les requêtes et augmenter la taille de la base de données.
Complexité : Nécessite une gestion spécifique des types de données BLOB (Binary Large Object) et peut compliquer les requêtes SQL.

## Stocker l'image dans un dossier sur le serveur

**Avantages** :

Performance : Les images sont stockées en dehors de la base de données, ce qui peut améliorer les performances des requêtes.
Simplicité : Les images peuvent être facilement accessibles via des URL, ce qui est pratique pour l'affichage sur un site web.

**Inconvénients** :

Gestion des fichiers : Nécessite une gestion appropriée des fichiers et des dossiers pour éviter les problèmes de sécurité et de performance.
Intégrité des données : Si une image est supprimée ou déplacée, cela peut rompre les liens vers elle dans la base de données.

## Comment procéder

### Upload de l'image : 

Utilisez la méthode move_uploaded_file() pour déplacer l'image téléchargée vers un dossier sur le serveur. Assurez-vous de vérifier la taille, le type de fichier et d'autres propriétés de l'image pour des raisons de sécurité 3.
Stockage dans la base de données : Si vous choisissez de stocker l'image dans la base de données, vous pouvez stocker le chemin de l'image ou les données binaires de l'image dans une colonne BLOB. Cependant, cette approche est généralement déconseillée pour les raisons de performance et de gestion des fichiers mentionnées ci-dessus.

### Stockage dans un dossier : 

Si vous choisissez de stocker l'image dans un dossier, stockez simplement le chemin de l'image dans la base de données. Cela permet de récupérer facilement l'image via son URL.
Voici un exemple simplifié de code pour l'upload d'une image et son stockage dans un dossier :

```php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $errors = [];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $extensions = ["jpeg", "jpg", "png"];

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be exactly 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        echo "Success";
    } else {
        print_r($errors);
    }
}
```

Dans cet exemple, l'image est téléchargée et vérifiée pour s'assurer qu'elle est du bon type et ne dépasse pas la taille maximale autorisée. Ensuite, elle est déplacée vers un dossier images/ sur le serveur. Vous pouvez ensuite stocker le chemin de l'image (images/nom_de_l_image.jpg) dans votre base de données pour y faire référence ultérieurement.

[Documentation](https://www.php.net/manual/fr/features.file-upload.post-method.php)

[Medium](https://medium.com/@antoine.sueur17/upload-de-photo-en-php-52a3390ce3)