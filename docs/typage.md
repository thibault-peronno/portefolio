# Typer une function php et les paramètres

Pour typer une fonction en PHP, notamment ses paramètres, plusieurs méthodes sont disponibles. Voici un résumé des approches les plus courantes :

Type Hinting pour les objets et les types scalaires : À partir de PHP 7.0, il est possible d'utiliser le type hinting pour les types scalaires (int, float, bool, string) ainsi que pour les objets. Cela permet de s'assurer que les paramètres passés à une fonction correspondent au type attendu. Si un type incorrect est passé, PHP générera une erreur.

```php
function maFonction(int $param) {
    // Votre code ici
}
```

Pour les objets, vous pouvez spécifier le nom de la classe attendue

```php
function maFonction(MonObjet $param) {
    // Votre code ici
}
```

SPL Types : La bibliothèque Standard PHP Library (SPL) offre des classes pour les types scalaires, comme SplInt, SplFloat, etc. Ces classes permettent de typer les paramètres de manière plus explicite, bien que cela nécessite de passer des objets au lieu de valeurs scalaires directes.

```php
function maFonction(SplInt $param) {
    // Votre code ici
}
$param = new SplInt(10);
maFonction($param);
```

Doc-comments : Bien que PHP ne force pas l'utilisation de doc-comments pour le type hinting, ils peuvent être utilisés pour documenter les types attendus par une fonction. Certains IDEs peuvent utiliser ces annotations pour fournir des avertissements de type lors de l'écriture du code.

```php
/**
 * @param int $param
 */
function maFonction($param) {
    // Votre code ici
}
```

Casting des paramètres : Une autre approche consiste à utiliser le casting pour s'assurer que les paramètres sont du type attendu. Cela peut être utile pour les types scalaires, mais il est important de gérer les erreurs ou les exceptions si le casting échoue.

```php
function maFonction($param) {
    $param = (int)$param;
    // Votre code ici
}
```

Validation des types avec `is_*` fonctions : Pour une validation plus simple, vous pouvez utiliser les fonctions `is_*` pour vérifier le type d'un paramètre avant de l'utiliser. Cela permet de gérer les erreurs de manière plus flexible.

```php
function maFonction($param) {
    if (!is_int($param)) {
        throw new InvalidArgumentException('Le paramètre doit être un entier.');
    }
    // Votre code ici
}
```

Chacune de ces méthodes a ses avantages et ses inconvénients, et le choix dépend de vos besoins spécifiques en matière de typage et de validation des paramètres dans vos fonctions PHP.

## Pour un tableau

Pour typer un paramètre de type array dans une fonction PHP, vous pouvez utiliser le type hinting array. Cela garantit que la fonction ne recevra que des valeurs de type array comme argument. Voici un exemple de comment cela peut être fait :

```php
function setValues(array $values): void {
    foreach ($values as $key => $value) {
        // Traitez chaque valeur ici
    }
}
```

Dans cet exemple, la fonction `setValues` attend un paramètre `$values` qui doit être un tableau. Le type hinting array garantit que si une valeur non-array est passée à la fonction, PHP générera une erreur de type TypeError.

Il est important de noter que le type hinting array ne permet pas de spécifier le type des éléments contenus dans le tableau. Si vous avez besoin de garantir que le tableau contient des éléments d'un certain type, vous devrez effectuer une validation supplémentaire à l'intérieur de la fonction.

En PHP 7 et versions ultérieures, vous pouvez également utiliser le type hinting pour les types scalaires (comme int, float, bool, string) ainsi que pour les objets. Cependant, pour les tableaux, le type hinting array est la méthode recommandée pour s'assurer que la fonction reçoit un tableau comme argument
