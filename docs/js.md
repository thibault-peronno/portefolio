# Javascript

## Comment placer le script

Pour intégrer un script dans un code HTML, vous avez plusieurs options pour contrôler quand et comment le script est chargé et exécuté. Voici les principales méthodes :
 
Sans attribut spécifique : Le navigateur exécute le script immédiatement, bloquant le rendu des éléments HTML qui suivent la balise ```<script>```.

**Avec l'attribut async** : Le navigateur continue à charger et à rendre la page HTML pendant qu'il charge et exécute le script simultanément. Les scripts async sont exécutés dès qu'ils sont téléchargés, sans considération pour leur ordre dans le fichier HTML. Cela signifie que l'ordre d'exécution des scripts async n'est pas garanti, ce qui peut poser problème si un script dépend d'un autre 15.

**Avec l'attribut defer** : Le navigateur exécute le script après avoir terminé l'analyse du document HTML, mais avant que l'événement DOMContentLoaded ne soit déclenché. Les scripts defer sont exécutés dans l'ordre dans lequel ils apparaissent dans le document. Cela permet d'éviter le blocage du rendu de la page pendant le chargement des scripts, tout en garantissant que les scripts sont exécutés dans l'ordre attendu.

**Placement du script** : Placer les scripts juste avant la balise de fermeture ```</body>``` est une pratique courante pour assurer un chargement rapide de la page, surtout dans les navigateurs plus anciens. Cela fonctionne dans tous les navigateurs et n'a pas besoin d'attributs async ou defer pour fonctionner.

**Utilisation de async dans le ```<head>```** : Pour des scénarios spécifiques où vous souhaitez initier le chargement du script tôt dans le processus de rendu de la page, mais exécuter le script dès qu'il est téléchargé, vous pouvez placer le script dans le ```<head>``` avec l'attribut async. Cela permet d'éviter le blocage du rendu de la page par le chargement du script, tout en exécutant le script dès qu'il est prêt.

En résumé, l'utilisation de async ou defer dépend de vos besoins spécifiques en termes de performance et d'ordre d'exécution des scripts. async est utile pour les scripts qui ne dépendent pas du DOM et qui doivent être exécutés dès qu'ils sont téléchargés, tandis que defer est préférable pour les scripts qui dépendent du DOM et qui doivent être exécutés après que le DOM ait été entièrement analysé.

[Async and defert](https://codedamn.com/news/javascript/async-and-defer-in-script-tag)

## Cibler un élément

Pour cibler un élément en JavaScript, vous avez plusieurs méthodes à votre disposition. Voici un résumé des différentes façons de sélectionner des éléments :

getElementById() : Sélectionne un élément par son attribut id. Cette méthode retourne le premier élément trouvé avec l'ID spécifié.
```JS
document.getElementById("monId");
```

getElementsByTagName() : Sélectionne tous les éléments avec le nom de balise HTML spécifié. Elle retourne une collection d'éléments.

```JS
document.getElementsByTagName("p");
```

getElementsByName() : Sélectionne tous les éléments avec l'attribut name spécifié. Elle retourne une collection d'éléments.

```JS
document.getElementsByName("nom");
```
getElementsByClassName() : Sélectionne tous les éléments avec la classe CSS spécifiée. Elle retourne une collection d'éléments.

```JS
document.getElementsByClassName("maClasse");
```
querySelector() : Sélectionne le premier élément qui correspond au sélecteur CSS spécifié. Elle retourne un seul élément.

```JS
document.querySelector(".maClasse");
```

querySelectorAll() : Sélectionne tous les éléments qui correspondent au sélecteur CSS spécifié. Elle retourne une collection d'éléments.

```JS
document.querySelectorAll(".maClasse");
```

closest() : Sélectionne l'élément le plus proche qui correspond au sélecteur CSS spécifié, en remontant dans l'arbre DOM. Elle retourne un seul élément.

```JS
document.querySelector(".maClasse").closest("div");
```

Chacune de ces méthodes a ses propres cas d'utilisation et ses avantages. Par exemple, ```getElementById()``` est rapide et efficace pour sélectionner un élément unique par son ID, tandis que ```querySelector()``` et ```querySelectorAll()``` offrent une grande flexibilité en utilisant des sélecteurs CSS pour cibler des éléments. ```closest()``` est utile pour naviguer dans l'arbre DOM et trouver un élément parent qui correspond à un sélecteur spécifique.

Il est important de noter que ```querySelector()``` et ```querySelectorAll()``` sont généralement plus lents que les autres méthodes, donc si la performance est une préoccupation, il peut être préférable d'utiliser ```getElementById()``` pour les sélections par ID