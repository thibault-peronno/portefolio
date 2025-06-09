# Sécurité

## FILTER_SANITIZE_STRING

Les filtres `filter_sanitize` en PHP sont utilisés pour nettoyer les données d'entrée, en supprimant ou en modifiant les caractères illégaux ou indésirables. **Ils sont particulièrement utiles pour prévenir les attaques par injection de code, comme les attaques XSS (Cross-Site Scripting) ou SQL Injection, en s'assurant que les données sont sûres avant de les utiliser dans des requêtes ou en les affichant dans le navigateur.**

La fonction `filter_var()` est le cœur de l'extension de filtres PHP. Elle permet de filtrer une seule variable avec un filtre spécifié. Cette fonction prend trois paramètres : la variable à filtrer, l'ID du filtre à appliquer, et éventuellement un tableau d'options liées au filtre.

Voici quelques exemples de filtres filter_sanitize et de leur utilisation :

**FILTER_SANITIZE_STRING** : Supprime les balises HTML et les caractères spéciaux d'une chaîne de caractères. Cependant, à partir de PHP 8.1, cette constante est dépréciée. Pour remplacer FILTER_SANITIZE_STRING, vous pouvez utiliser `htmlspecialchars()` pour encoder les caractères spéciaux ou `strip_tags()` pour supprimer les balises HTML.

Cependant, avec la dépréciation de `FILTER_SANITIZE_STRING`, il est recommandé d'utiliser `FILTER_SANITIZE_FULL_SPECIAL_CHARS` comme remplacement, qui est le filtre le plus proche qui reste valide. Cette constante supprime également les balises HTML et les caractères spéciaux, mais elle est plus claire dans son objectif et son comportement.

Voici comment vous pourriez réécrire la ligne de code en utilisant FILTER_SANITIZE_FULL_SPECIAL_CHARS :

```php
$title = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
```

Si vous avez besoin de protéger contre les attaques XSS lors de l'affichage des données, il est recommandé d'utiliser `htmlspecialchars()` sur les données avant de les afficher dans le HTML. Cela convertit les caractères spéciaux en entités HTML, empêchant l'exécution de scripts malveillants 1.

```php
echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
```

Cette approche garantit que les données sont nettoyées lors de leur récupération et lorsqu'elles sont affichées, réduisant ainsi le risque d'attaques par injection de code.

**FILTER_SANITIZE_URL**

Supprime tous les caractères illégaux d'une URL, sauf les lettres, les chiffres et certains caractères spéciaux. Cela peut être utilisé pour nettoyer les URL avant de les utiliser dans des requêtes ou les afficher.

**FILTER_SANITIZE_EMAIL**
Supprime tous les caractères illégaux d'une adresse e-mail, sauf les lettres, les chiffres et certains caractères spéciaux. Cela peut être utilisé pour nettoyer les adresses e-mail avant de les utiliser dans des requêtes ou les afficher.

**FILTER_SANITIZE_NUMBER_FLOAT**

Supprime tous les caractères illégaux d'une chaîne de caractères représentant un nombre à virgule flottante. Cela peut être utilisé pour nettoyer les nombres à virgule flottante avant de les utiliser dans des calculs ou les afficher.

Les filtres filter_sanitize peuvent être utilisés avec différentes options pour personnaliser leur comportement, comme FILTER_FLAG_STRIP_LOW pour supprimer les caractères avec une valeur ASCII inférieure à 32, ou FILTER_FLAG_ENCODE_HIGH pour encoder les caractères avec une valeur ASCII supérieure à 127.

Il est important de noter que bien que les filtres filter_sanitize soient utiles pour nettoyer les données d'entrée, ils ne remplacent pas la validation des données. La validation des données est nécessaire pour s'assurer que les données correspondent à un format attendu, comme une adresse e-mail valide ou un nombre dans une plage spécifique. Pour cela, vous pouvez utiliser les filtres filter_validate en combinaison avec `filter_var()`.
