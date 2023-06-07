import matplotlib.pyplot as plt
import pdfkit
import sqlite3

conn = sqlite3.connect('/basededonnee/sae203.db')
cur=conn.cursor()


# Générer un graphique
def température():
    # ... Code de génération du graphique avec matplotlib ...
    plt.plot([1, 2, 3, 4])
    plt.ylabel('Y')
    plt.xlabel('X')
    plt.savefig('température.png')
def humidyte():
    # ... Code de génération du graphique avec matplotlib ...
    plt.plot([1, 2, 3, 4])
    plt.ylabel('Y')
    plt.xlabel('X')
    plt.savefig('humidyte.png')
# Appeler la fonction pour générer le graphique
température()
humidyte()
# Convertir l'image en PDF
pdfkit.from_file('température.png'+'humidyte.png', 'température.pdf')
