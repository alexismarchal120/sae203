
# Programme du raspberry

## Cablâge 
![App Screenshot](https://net-security.fr/images/DHT22/DHT22_2.jpeg)

Avec une sonde nue il faut donc rajouter une résistance et une plaque d'essai pour réaliser un branchement comme celui-là :
![App Screenshot](https://net-security.fr/images/DHT22/DHT22_4.jpg)

Le 3ème PIN de la sonde n'est pas utilisé, sinon les autres sont reliés aux mêmes PIN sur le raspberry, l'alimentation, la masse et le PIN 7 pour les données.
## Installation des bibliothèque
Dans un premier dans on va s'assurer que python 3 est bien installer pour ça on faire taper la commande suivante:
```shell
sudo apt update
```
puis:
```shell
sudo apt install python3
```
```shell
sudo apt install python3-pip
```
Maintenant nous allons installer les bibliothèque suivante qui sont:

- Adafruit_DHT
- paho.mqtt.client

#### Adafruit_DHT:
```shell
sudo apt install git
```
```shell
sudo git clone https://github.com/adafruit/Adafruit_Python_DHT.git
```
```shell
sudo apt update
```
```shell
sudo apt install build-essential python-dev python-openssl
```
```shell
sudo python setup.py install
```
#### paho.mqtt.client:
```shell
sudo pip install paho-mqtt
```
Les autres bibliothèque sont déjà installer par défaut si ce n'est pas le cas il suffit juste d'utiliser la commande pip pour l'installation:

## Programme
L'hors de la création du fichier l'extension vous aurez mis un .py sinon par defaut l'os va le mettre comme un fichier txt mes la line suivante dans votre programme sous les distributions linux il suffit d'écricre la ligne suivante au début du programme:
```shell
#!/usr/bin/python
```
Voilà votre fichier est bien reconnu comme un fichier python.

Maintenant que tout est pret nous allons pouvoir commencer à coder.
première étape c'est d'importer tout les librairie dans notre programme comme ceci: 
```python
import Adafruit_DHT
from time import sleep
import paho.mqtt.client as mqtt
import json
from datetime import date
from datetime import datetime
```
Nous allons crée des variables pour la connection entre le capteur et le raspberry puis du raspberry au broker mqtt.
```python
DHT_SENSOR = Adafruit_DHT.DHT22
DHT_PIN = 4
```
La variable DHT_SENSOR est là pour sélectionner les paramètre qui va êtres utiliser par le capteur qu'on utiliser qui sont prédéfinis dans la bibliothèque Adafruit_DHT donc en rajoute le .DHT22.

Le DHT_PIN est là pour dire qu'elle pin va devoir rester sur écouter du gpio pour la réception des données dans notre cas c'est le GPIO 4 d'où le chiffre 4 en paramètre.
![App Screenshot](https://www.raspberrypi-france.fr/wp-content/uploads/2022/12/capture-1-16-1024x577.jpg)
```python
mqtt_broker = "192.168.247.145"
mqtt_port = 1883
mqtt_topic = "topic/json"
```
La variable mqtt_broker en paramètre on lui à mis l'addresse IP du serveur mqtt et pareille pour la mqtt_port en paramètre à le port sur le qu'elle notre serveur écoute.

La variable mqtt_topic à comme paramètre notre topic dans le qu'elle on veut envoyer les données. Un topic c'est une chaîne, au format UTF-8, que le broker utilise pour identifier et filtrer les messages de chaque client connecté. Le topic est constitué d'un ou de plusieurs niveaux. Chaque niveau de sujet est séparé par une barre oblique (séparateur de niveau de sujet).

Ensuite nous allons crée une boucle pour que le programme une fois lancer ce répete toute les 30 min.
```python
while True:
    humidity, temperature = Adafruit_DHT.read_retry(DHT_SENSOR, DHT_PIN)
    today=date.today()
    heure= datetime.now().time()
    if humidity is not None and temperature is not None:
     
        data= {
            "Temperature": "{0:0.1f}".format(temperature),
            "Humidity": "{0:0.1f}".format(humidity),
            "j":today.day,
            "M":today.month,
            "a":today.year,
            "h":heure.strftime("%H"),
            "m":heure.strftime("%M"),
            "s":heure.strftime("%S")
        }
        payload = json.dumps(data)
        client = mqtt.Client()
        client.connect(mqtt_broker, mqtt_port)
        client.publish(mqtt_topic, payload)
        client.disconnect()
        sleep(1800)
    else:
        print("Failed to retrieve data from humidity sensor")
```
Je vais juste vous expliquer ce que représente la variable data est ce que c'est le json et après je vous laisserez essayer le programme est n'héssiter pas à l'essayer pas à pas pour mieux le comprendre et de le modifier pour l'adapter à vos besions:

La variable data est sous forme d'un dictionnaire.Un dictionnaire c'est quoi en programation ? Un dictionnaire en programmation que ce soit C,php,python ou autre est toujours avec une clè est un paramètre qui correspond à cette mêmes clè ou dit une valeur.

exemple:
```python
classe ={
    "nombre d'élèves":30
}
```
donc là pour exemple ou un dictionnaire qui porte le nom de classe 
donc qui a une clè et une valeur:

- la clè est "nombre d'élèves"
- a pour valeur 30

si on rajoute un print:
```python
print(f"Il y a {classe['nombre délèves']} d'élèves")
```
donc ça vas nous afficher ceci:
```shell
Il y a 30 d'élèves
```
voilà comment fonction un dictionnaire dans un programme.

#### C'est quoi le Json:
JSON (JavaScript Objet Notation) est un langage léger d’échange de données textuelles. Pour les ordinateurs, ce format se génère et s’analyse facilement. Pour les humains, il est pratique à écrire et à lire grâce à une syntaxe simple et à une structure en arborescence. JSON permet de représenter des données structurées (comme XML par exemple).
