# Création de la base de donné

Dans cette parti nous allons vous montrer la création de notre base de donné.

## premiere étape définir nos bessions 
Notre besions de donné aura besions de  deux tableaux:
- Température
- hummydite
car le capteur ne peut que relever ceci comme donnée. Puis dans ces tableaux il aura:

- id 
- Température
- le jour
- le mois 
- l'année
- l'heure
- les minutes
- les secondes

## deuxieme étape installations de sqlite3
## Ubuntu

```shell
sudo apt update
```
```shell
sudo apt upgrade
```
```shell
sudo apt install sqlite3
```
## troisieme étape la création de la base de donné
Lancer sqlite3 dans le terminal:(n'oublier pas avant de vous mettre dans le répétoire ou vous voulez la mettre via "cd")
```shell
    sqlite3 "nom de votre base de donne".bd
```
création du premier tableau:
```shell
    CREATE TABLE Temperature ("id"	INTEGER NOT NULL,"temp"	NUMERIC,"jour"NUMERIC NOT NULL,"mois"	NUMERIC NOT NULL,"annee"	NUMERIC NOT NULL,"heure"	NUMERIC,"min"	NUMERIC,"seconde"	NUMERIC,PRIMARY KEY("id" AUTOINCREMENT));
```
création du deuxieme tableau:
```shell
    CREATE TABLE Temperature ("id"	INTEGER NOT NULL,"taux"	NUMERIC,"jour"NUMERIC NOT NULL,"mois"	NUMERIC NOT NULL,"annee"	NUMERIC NOT NULL,"heure"	NUMERIC,"min"	NUMERIC,"seconde"	NUMERIC,PRIMARY KEY("id" AUTOINCREMENT));
```
puis faite:
```shell
    .save
```
```shell
    .quit
```
et voilà votre base de donné et maintenant prete!!!


