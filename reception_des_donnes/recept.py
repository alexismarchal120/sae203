import json
import paho.mqtt.client as mqtt
import sqlite3

# Fonction de callback exécutée lors de la connexion au broker MQTT
def on_connect(client, userdata, flags, rc):
    print("Connecté au broker MQTT")
    # Abonnement au sujet approprié
    client.subscribe("topic/json")  # Remplacez par le sujet MQTT approprié

# Fonction de callback exécutée lors de la réception d'un message MQTT
def on_message(client, userdata, msg):
    print("Message reçu : " + msg.topic + " " + str(msg.payload))
    # Vérification du sujet MQTT pour s'assurer qu'il correspond au sujet attendu
    if msg.topic == "topic/json":  # Remplacez par le sujet MQTT approprié
        # Conversion du message MQTT en objet JSON
        data = json.loads(msg.payload)
        conn = sqlite3.connect('/home/marchal/Bureau/sae203/basededonnee/sae203.db')
        cur = conn.cursor()
        t=data['Temperature']
        T=data['Humidity']
        j=data['j']
        M=data['M']
        a=data['a']
        h=data['h']
        m=data['m']
        s=data['s']
        Insert_hummydite =f"INSERT INTO hummydite(taux,jour,mois,annee,heure,min,seconde) VALUES({T},{j},{M},{a},{h},{m},{s})"
        Insert_temperature =f"INSERT INTO temperature(temp,jour,mois,annee,heure,min,seconde) VALUES({t},{j},{M},{a},{h},{m},{s})"
        cur.execute(Insert_hummydite)
        cur.execute(Insert_temperature)
        conn.commit()
        print("transfer")
        # Traitement des données JSON
        # Vous pouvez accéder aux valeurs spécifiques en utilisant la notation data["clé"]
        
# Création d'une instance du client MQTT
client = mqtt.Client()

# Configuration des fonctions de callback
client.on_connect = on_connect
client.on_message = on_message

# Connexion au broker MQTT
client.connect("192.168.247.145", 1883, 60)  # Remplacez par l'adresse IP et le port du broker MQTT

# Démarrage de la boucle de gestion des messages MQTT
client.loop_forever()
