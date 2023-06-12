import Adafruit_DHT
from time import sleep
import paho.mqtt.client as mqtt
import json
from datetime import date
from datetime import datetime

DHT_SENSOR = Adafruit_DHT.DHT22
DHT_PIN = 4
mqtt_broker = "192.168.247.145"
mqtt_port = 1883
mqtt_topic = "topic/json"

while True:
    humidity, temperature = Adafruit_DHT.read_retry(DHT_SENSOR, DHT_PIN)
    #list1=[]
    today=date.today()
    heure= datetime.now().time()
    if humidity is not None and temperature is not None:
        #list1.append("Temp={0:0.1f}*C  Humidity={1:0.1f}%".format(temperature, humidity))
        #nomfichier=time.ctime()+".json"
        #fichier=open(nomfichier,"w")
        #for i in range(len(list1)):    
        #    fichier.write(list1[i])
        #fichier.close()
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