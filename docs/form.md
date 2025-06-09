# Les formulaires

## GET et POST

Les méthodes GET et POST sont deux méthodes HTTP utilisées pour envoyer des données du client (navigateur) au serveur. Elles sont spécifiées dans l'attribut method d'un formulaire HTML et déterminent comment les données du formulaire sont envoyées au serveur.

### GET:

**Transfert de données**: Les données sont ajoutées à l'URL sous forme de chaîne de requête. Cela signifie que les données sont visibles dans l'URL du navigateur.
**Sécurité**: Moins sécurisé que POST car les données sont visibles dans l'URL et peuvent être enregistrées dans l'historique du navigateur ou dans les journaux du serveur web. Ne pas utiliser GET pour envoyer des mots de passe ou d'autres informations sensibles.
Longueur des données: Limité par la longueur maximale de l'URL (généralement 2048 caractères). Seuls les caractères ASCII sont autorisés.
**Cache**: Peut être mis en cache par le navigateur.
Réutilisation: Les données peuvent être réutilisées en appuyant sur le bouton Retour ou en actualisant la page. Les données sont également enregistrées dans l'historique du navigateur.

### POST:

**Transfert de données**: Les données sont envoyées dans le corps de la requête HTTP, ce qui signifie qu'elles ne sont pas visibles dans l'URL. Cela permet d'envoyer des données plus volumineuses et de différents types, y compris des fichiers binaires, en utilisant l'encodage multipart/form-data 123.
**Sécurité**: Plus sécurisé que GET car les données ne sont pas visibles dans l'URL et ne sont pas enregistrées dans l'historique du navigateur ou dans les journaux du serveur web. Utilisé pour envoyer des mots de passe ou d'autres informations sensibles.
Longueur des données: Pas de restrictions sur la longueur des données. Peut envoyer des données binaires.
**Cache**: Les données ne sont pas mises en cache par le navigateur.
Réutilisation: Les données ne sont pas réutilisées en appuyant sur le bouton Retour ou en actualisant la page. Les données ne sont pas enregistrées dans l'historique du navigateur.

Exemple de formulaire utilisant GET:

```php
<form action="getmethod.php" method="GET">
 Username: <input type="text" name="username" /><br>
 City: <input type="text" name="city" /><br>
 <input type="submit" />
</form>
```

Dans cet exemple, lorsque le formulaire est soumis, les données du formulaire (nom d'utilisateur et ville) sont ajoutées à l'URL sous forme de chaîne de requête, et la requête GET est envoyée au serveur

https://www.w3schools.com/tags/ref_httpmethods.asp
https://softuni.org/dev-concepts/handling-an-html-form/#:~:text=The%20GET%20method%20transfers%20data,via%20the%20HTTP%20message%20body.

## enctype="multipart/form-data"

L'attribut enctype="multipart/form-data" dans un formulaire HTML est utilisé pour spécifier comment les données du formulaire doivent être encodées lors de leur envoi au serveur. Cet attribut est particulièrement important lors de l'envoi de fichiers, car il permet d'envoyer des données binaires telles que des images ou des fichiers audio sans altérer le flux de données.

**Utilisation**

L'attribut enctype est utilisé uniquement avec la méthode POST d'un formulaire. Il indique au navigateur comment encoder les données du formulaire avant de les envoyer au serveur. La valeur par défaut est application/x-www-form-urlencoded, qui est adaptée pour les données textuelles, mais pas pour les fichiers. Pour les fichiers, multipart/form-data est nécessaire pour s'assurer que les données binaires sont correctement transmises.

**Fonctionnement**

Lorsque multipart/form-data est utilisé, les données du formulaire sont divisées en plusieurs parties, une pour chaque champ du formulaire et une pour chaque fichier. Cela permet d'envoyer des fichiers de grande taille sans problème de taille de requête. Les données sont ensuite regroupées par le serveur pour être traitées.

**Sécurité**

L'utilisation de multipart/form-data est également recommandée pour des raisons de sécurité, car elle empêche l'injection de données malveillantes dans les fichiers téléchargés. Cela est particulièrement important pour les applications web qui permettent aux utilisateurs de télécharger des fichiers.

Voici un exemple simple de formulaire HTML utilisant enctype="multipart/form-data" pour permettre l'envoi d'un fichier :

```php
<form action="upload.php" method="post" enctype="multipart/form-data">
 Sélectionnez le fichier à télécharger :
 <input type="file" name="fileToUpload" id="fileToUpload">
 <input type="submit" value="Télécharger le fichier" name="submit">
</form>
```

Dans cet exemple, le formulaire permet à l'utilisateur de sélectionner un fichier à télécharger, qui sera ensuite envoyé au serveur via la méthode POST avec l'encodage multipart/form-data

https://herotofu.com/terms/multipart-form-data

## Action

Si action est vide, le script revient sur la page actuel pour le traitement du formulaire. Sous-entendu que le traitement du script est sur la page.
Si vous remplissez l'attribut action pour rediriger vers une page, le traitement sera à faire sur la page redirigée.

L'attribut action dans un formulaire HTML spécifie l'URL vers laquelle les données du formulaire doivent être envoyées lors de la soumission. Si vous souhaitez rediriger vers une autre page après la soumission du formulaire, vous pouvez utiliser l'attribut action pour spécifier cette URL. Cela peut être particulièrement utile pour les scénarios où vous souhaitez traiter les données du formulaire sur un serveur et ensuite rediriger l'utilisateur vers une autre page, comme une page de remerciement ou une page de confirmation.

Voici un exemple basé sur les informations fournies :

```php
<html>
 <body>
    <form action="https://website.com/action.php" method="POST">
      <input type="hidden" name="fullname" value="john" />
      <input type="hidden" name="address" value="street 2, 32 ave" />
      <input type="submit" value="Submit request" />
    </form>
 </body>
</html>
```

Dans cet exemple, lorsque le formulaire est soumis, les données sont envoyées à https://website.com/action.php via la méthode POST. Si vous souhaitez rediriger l'utilisateur vers une autre page après la soumission du formulaire, vous pouvez gérer cela côté serveur dans le script action.php. Après avoir traité les données du formulaire, vous pouvez utiliser une instruction de redirection pour envoyer l'utilisateur vers la page souhaitée.

Voici un exemple simplifié de comment cela pourrait être géré dans action.php :

```php
<?php
// Traitement des données du formulaire ici

// Redirection vers une autre page
header('Location: https://website.com/confirmation.php');
exit;
?>
```

Dans cet exemple, après le traitement des données du formulaire, l'utilisateur est redirigé vers https://website.com/confirmation.php 12.

Il est important de noter que la redirection doit être gérée côté serveur, car le navigateur doit d'abord envoyer les données du formulaire au serveur avant de pouvoir être redirigé vers une autre page.

## Les super global

### $\_SERVER['PHP_SELF']

L'utilisation de $\_SERVER['PHP_SELF'] dans l'attribut action d'un formulaire HTML permet de spécifier que les données du formulaire doivent être envoyées au même script PHP qui a généré le formulaire. Cela peut être utile pour les formulaires où la logique de traitement des données est contenue dans le même fichier que le formulaire lui-même.

**Fonctionnement**

$\_SERVER['PHP_SELF'] retourne le nom du fichier PHP actuellement en cours d'exécution. En l'utilisant dans l'attribut action d'un formulaire, vous indiquez au navigateur de soumettre les données du formulaire au même script PHP. Cela peut simplifier le développement, car vous n'avez pas besoin de mettre à jour manuellement l'attribut action si le nom du fichier change.

**Sécurité**

Bien que $\_SERVER['PHP_SELF'] puisse être pratique, il est important de noter que son utilisation peut présenter des risques de sécurité, notamment en matière d'injection de code malveillant. Pour éviter ces risques, il est recommandé d'utiliser la fonction htmlentities() ou htmlspecialchars() pour échapper les caractères spéciaux dans $\_SERVER['PHP_SELF']. Cela empêche l'exécution de code malveillant injecté dans l'URL.

Voici un exemple de formulaire utilisant $\_SERVER['PHP_SELF'] avec htmlentities() pour sécuriser l'attribut action :

```php
<form name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
 <!-- Champs du formulaire -->
 <input type="submit" value="Envoyer">
</form>
```

Dans cet exemple, htmlentities($\_SERVER['PHP_SELF']) garantit que les caractères spéciaux dans le chemin du script PHP sont correctement échappés, réduisant ainsi le risque d'attaques par injection de code.

Il est également important de noter que l'utilisation de $\_SERVER['PHP_SELF'] peut ne pas transmettre les variables GET avec le formulaire. Si vous avez besoin de conserver les variables GET dans l'URL après la soumission du formulaire, il peut être préférable d'utiliser action="" ou de construire manuellement l'URL avec les variables nécessaires
