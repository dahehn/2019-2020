from sense_emu import SenseHat
from datetime import datetime
import paho.mqtt.client as mqtt
import time

sense = SenseHat()
client = mqtt.Client()
client.connect("192.168.178.40")

while True:
    humidity = sense.humidity
    temp = sense.temperature
    press = sense.pressure
    message = str(humidity) + "," +
    str(humidity) + "," + str(temp) + "," +
    datetime.now().strftime("%d.%m.%Y %H:%M:%S")
    
    print ("published:",message)
    client.publish("/data",message)
    time.sleep(5)
