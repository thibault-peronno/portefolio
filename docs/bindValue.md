# binValue()

La méthode bindValue() de l'objet PDOStatement est utilisée pour lier une valeur à un paramètre nommé dans une requête SQL préparée. Cette méthode prend trois arguments :

**Identifiant du paramètre** : Pour une requête préparée utilisant des placeholders nommés, c'est le nom du paramètre sous la forme :name. Pour une requête préparée utilisant des placeholders de point d'interrogation, c'est la position indexée du paramètre (à partir de 1).

**Valeur à lier** : La valeur réelle à lier au paramètre.

**Type de données du paramètre** : Optionnel. Le type de données de la valeur, en utilisant les constantes PDO::PARAM_* pour spécifier le type de données. Cela peut aider à optimiser la requête et à éviter les erreurs de type de données.

La méthode bindValue() est particulièrement utile pour sécuriser les requêtes en évitant les injections SQL, car elle assure que les valeurs sont correctement échappées et traitées par le système de gestion de base de données. De plus, en spécifiant le type de données attendu, elle peut améliorer les performances de la requête et éviter des erreurs de type de données.

Il est important de noter que bindValue() lie la valeur au moment de l'appel, contrairement à bindParam() qui lie la variable elle-même et évalue sa valeur au moment de l'exécution de la requête. Cela signifie que si la valeur de la variable change après l'appel à bindValue(), la valeur liée à la requête ne changera pas, tandis que si la valeur de la variable change après l'appel à bindParam(), la valeur liée à la requête changera également.

Voici un exemple d'utilisation de bindValue() :

```php
$pdoStatement = $pdo->prepare("INSERT INTO ma_table (colonne1, colonne2) VALUES (:valeur1, :valeur2)");
$pdoStatement->bindValue(':valeur1', $valeur1, PDO::PARAM_STR);
$pdoStatement->bindValue(':valeur2', $valeur2, PDO::PARAM_INT);
$pdoStatement->execute();
```

Dans cet exemple, :valeur1 et :valeur2 sont des placeholders dans la requête SQL. Les valeurs réelles $valeur1 et $valeur2 sont liées à ces placeholders en utilisant bindValue(), et la requête est exécutée avec execute()