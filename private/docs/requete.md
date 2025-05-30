# Iteration 3

## Écrire les requêtes de sélection sur une table

1. Lister l’ensemble des films. -> SELECT * FROM `films`
2. Liste des films plus long que 2 heures -> SELECT * FROM `films` WHERE duree >= 2;
3. Liste des films par ordre alphabétique décroissant -> SELECT * FROM `films` ORDER BY nom DESC;
4. Liste des séances sur les 10 derniers jours


## Créer les différentes tables de la base de données

1. Liste des films avec Harrison Ford dans son casting 
-> SELECT *  FROM `casting` 
INNER JOIN films
on casting.idFilm = films.ID
WHERE casting.idActor = 16;


2. Liste des toutes les salles avec un film ayant Bruce Willis ou Harrison Ford dans son
casting
->
SELECT cinema.nom, salles.nom, acteurs.identite FROM `seances` INNER JOIN casting on casting.idActor = 16 || casting.idActor = 11 INNER join acteurs on acteurs.ID = casting.idActor INNER JOIN salles on seances.idSalle = salles.ID inner join cinema on cinema.ID = seances.idCinema;

3. Nombre de places totale pour le cinéma Mégarama
-> SELECT SUM(places) AS total_places FROM salles WHERE idCinema = 2;

4. Liste des films projetés dans une salle entre 100 et 200 places
->SELECT films.nom as 'Nom film', cinema.nom as "Nom cinema",salles.nom as "Salle" FROM `seances` INNER join salles on salles.ID = seances.idSalle INNER join films on films.ID = seances.idFilm inner join cinema on cinema.ID = seances.idCinema WHERE salles.places BETWEEN 100 AND 200;

5. Tous les cinémas qui ont passé ou vont passer star wars
-> SELECT cinema.nom FROM `seances` INNER join cinema on cinema.ID = seances.idCinema WHERE `idFilm` = 2;

6. Nombre total de place par cinéma
-> SELECT c.nom as "Nom cinema", SUM(s.places) as "Nombre total de places" FROM salles s INNER JOIN cinema c ON s.idCinema = c.ID GROUP BY c.nom;

7. Budget total de tous les films par année de sortie
-> SELECT Sum(films.budget) as "Budget", films.annee FROM `films` GROUP by films.annee;

## Insertion, mise à jour et suppression
1. Créer un film avec au moins trois projections pour le mois prochain

2. Ajouter un cinéma et ses salles
-> INSERT INTO `salles`(`ID`, `idCinema`, `nom`, `places`) VALUES
(null,4,'Grande Salle',2700),
(null,4,'Rex 7',109)

3. Ajouter 1 000 000 au budget du film que vous avez créé
-> UPDATE `films` SET `budget`='21' WHERE `ID` = 8

4. Augmenter de 5% le budget de tous les films
-> SELECT films.nom as "Film", SUM(films.budget * (1 + (5 / 100))) as "Budget" FROM `films` GROUP by films.nom;

5. Supprimer un film
-> DELETE FROM `films` WHERE ID = 9

6. Supprimer les films n’ayant aucune projection
-> SELECT * FROM `films` WHERE `id` NOT IN (SELECT `idFilm` FROM `seances` WHERE `idFilm` IS NOT NULL);
-> DELETE FROM `films` WHERE `id` NOT IN (SELECT `idFilm` FROM `seances` WHERE `idFilm` IS NOT NULL);

(recuperer les seances qu'ils ont un film : SELECT * FROM `seances` WHERE `idFilm` IS NOT NULL)


## Pour aller plus loin (optionnel)
1. Liste de tous les films qui passent aujourd’hui
-> SELECT * FROM `seances` WHERE `date` = CURDATE();

2. Durée totale de projection pour chaque cinéma
-> 
3. Liste de tous les films ne contenant pas Harrison Ford
4. Liste des cinéma qui passent tous les films

<br>

# Iteration 4

## NoSQL, Quésako ?
NoSQL est un non relationnel, auquel il aborde une structure document en json (objet), avec un schema dynamique, il est pas ACID (atomicité, cohérence, isolation et durabilité), avec aucune jointure donc pas de clée etrangere, utile pour une performance de donnée non structuré.
Il est surtout utilisé par Mongodb.

## Écrivez dans Compass les requêtes suivantes :
*Les commandes sont faite dans le shell de Mongo compass*

Récupérer les informations le film dont l nom est Star wars : 
->  db.collectionName.find({"nom" : "Star Wars"})

Récupérer tous les films dont la durée est supérieure à deux heures
-> db.films.find({"duree" : {$gt:2}})

Récupérer le titre des films dont le budget dépasse les 30 millions
-> db.films.find({"budget" : {$gt: 30}}, {"nom" : true}).pretty()


Récupérer les cinémas avec au moins une salle ayant plus de 300 places
-> db.cinemav2.find({"salles" ; {$gt : 300}})