# Connexion à la base de données avec PDO

## Peux tu m'expliquer pourquoi je dois écrire \Exception pour ne pas avoir d'erreur ?

catch (\Exception $exception)
ANSWER | PHIND-34B MODEL
L'utilisation de \Exception dans un bloc catch est nécessaire pour éviter des erreurs de portée de nom (namespace) dans PHP. Lorsque vous utilisez Exception sans le préfixe de barre oblique inverse (\), PHP cherche la classe Exception dans le namespace actuel. Si votre code n'est pas dans le namespace global (qui est le cas par défaut pour les scripts PHP), PHP ne pourra pas trouver la classe Exception et générera une erreur.

En ajoutant le préfixe \, vous indiquez explicitement à PHP de chercher la classe Exception dans le namespace global, ce qui permet d'éviter cette erreur. Cela est particulièrement important dans les applications PHP modernes qui utilisent des namespaces pour organiser le code, car sans le préfixe \, PHP pourrait ne pas être en mesure de trouver la classe Exception si elle est utilisée dans un contexte où le namespace actuel n'est pas le namespace global.

Voici un exemple pour illustrer cela :
```php
namespace MonApp;

try {
    // Code qui peut générer une exception
} catch (\Exception $e) {
    // Gestion de l'exception
}
```

Dans cet exemple, sans le préfixe \ devant Exception, PHP chercherait une classe Exception dans le namespace MonApp, ce qui entraînerait une erreur car cette classe n'existe pas dans ce namespace. En ajoutant le préfixe \, vous indiquez à PHP de chercher la classe Exception dans le namespace global, où elle est définie.