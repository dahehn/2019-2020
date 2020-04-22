import mysql.connector
import paho.mqtt.client as mqtt

db = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="",
    database="mqtt"
)

def on_message(client, userdata, message):
    print("message received ",str(message.payload.decode("utf-8")))
    msg = str(message.payload.decode()).split(",")
    cursor = db.cursor()
    query = "Insert INTO data (temp,hum,press,stamp) VALUES (%s,%s,%s,%s)"
    values = (msg[0],msg[1],msg[2],msg[3])
    cursor.execute(query,values)
    db.commit()
    print(cursor.rowcount, "Record inserted successfully into data table")
    cursor.close()

def on_connect(client, userdata, flags, rc):
  print("Connected with result code "+str(rc))
  client.subscribe("/data")

client = mqtt.Client()
client.connect("192.168.178.40")
client.on_connect = on_connect
client.on_message = on_message
client.loop_forever()