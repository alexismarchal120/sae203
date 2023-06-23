# Serveur MQTT
## Introduction
Plus connu sous l'acronyme MQTT, le protocole Message Queuing Telemetry Transport est un protocole de messagerie léger adapté aux situations où les clients doivent utiliser peu de code et sont connectés à des réseaux peu fiables ou limités en bande passante.
### Comment ça fonctionne: 
Un client MQTT établit une connexion avec l'agent MQTT. Une fois connecté, le client peut soit publier des messages, soit s'abonner à des messages spécifiques, soit faire les deux. Lorsque l'agent MQTT reçoit un message, il le transmet aux abonnés qui sont intéressés.
nous allons reprondre le schèma mis en introduction de mon GITHUB:
![App Screenshot](https://github.com/Tutanka01/SAE-23/blob/main/images/architecture.png?raw=true)
Nous allons dévouper en 3 parties de ce shéma:

- Le client  
- Le serveur 
- L'abonné ou les abonnées

### Le client: 
Le client est représentée par les servises suivant qui sont service sur le web donc tout ce qui sont les API ou autre comme par exemple les logs ou les API météo et les IOT dites Web ce sont par exemple des sonde à température relier à internet. Le client peut aussi être représenté par un simple programme qui envoie des données.
### Le serveur:
Représsenter par le nuage orange c'est là ou tout est centraliser et il sert de routeur entre le client et l'abonnée donc on est sur une configuration dit en étoile pour notre cas.
### L'abonné: 
L'abonné sera celui qui va venir ce connecter à notre serveur pour récupérer les données d'un client. Attention l'abonnée si il ce mets à envoyer des données au serveur l'abonné devient client et inversement mais cette situation ne sera pas mis en pratique. Sur notre schèma l'abonné ce trouve à droite est en bas du schèma.
## Installation & paramétrage
### Préliminaire:
Nous allons vous apprendre à installer est à configurer un serveur sous une distribution Linux pour notre part on la fait sous ubuntu mais ça fonctionnerai très bien sous une debian ou autre.
### Installation
première étape avant de faire quoi que ce soit comme toute installation faites la comande ci-dessous:
```shell
sudo apt update
```
Puis :
```shell
sudo apt install mosquitto
```
### Paramétrage 
