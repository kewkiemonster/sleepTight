import time, math, socket, grovepi, ssl, os
import paho.mqtt.client as paho

#PORTS 
pir_sensor = 8 #D8
sensor = 7 #D7
sound_sensor = 0 #A0
light_sensor = 4 #D4
led = 5 #D5

grovepi.pinMode(light_sensor, "INPUT")
grovepi.pinMode(pir_sensor, "INPUT") 
grovepi.pinMode(sound_sensor, "INPUT")
grovepi.pinMode(led, "OUTPUT")
blue = 0 #temp&hum sensor

threshold_value = 200
threshold_light = 10

#method for connecting and sending a message
connflag = False

def on_connect(client, userdata, flags, rc):
        global connflag
        print "Successfully Connected to AWS"
        connflag = True
        print("Connection Result: " + str(rc))

def on_message(client, userdata, msg):
        print(msg.topic+" "+str(msg.payload))
        
#mqttc object
mqttc = paho.Client()

#assigns connect and message functions
mqttc.on_connect = on_connect 
mqttc.on_message = on_message

awshost = "a26kbc29d6odzh.iot.us-west-2.amazonaws.com"
awsport = 8883
clientId = "pi"
thingName = "pi"
caPath = "root-CA.crt"
certPath = "pi.cert.pem"
keyPath = "pi.private.key"

#parameters that needs to be passed
mqttc.tls_set(caPath, certfile=certPath, keyfile=keyPath, cert_reqs=ssl.CERT_REQUIRED, tls_version=ssl.PROTOCOL_TLSv1_2, ciphers=None)

#connect to AWS
mqttc.connect(awshost, awsport, keepalive=60)
mqttc.loop_start()

while True:
	if connflag == True:
	  try:
	  	if grovepi.digitalRead(pir_sensor):
			print "Motion Detected"
	  	else:
			print "-"

	  	time.sleep(3)

	  	sensor_value = grovepi.analogRead(sound_sensor)
	  	if sensor_value > threshold_value:
	        	grovepi.digitalWrite(led,1)
	  	else:
			grovepi.digitalWrite(led,0)

	  	print "sound value = ",sensor_value,"%D"
	  	time.sleep(3)

	  	light_value = grovepi.analogRead(light_sensor)
	  	resistance = (float)(1023 - light_value) * 10 / light_value
	  	if resistance > threshold_light:
			grovepi.digitalWrite(led,1)
	  	else:
			grovepi.digitalWrite(led,0)

	  	print("light value = %d resistance = %.2f" %(light_value, resistance))
	  	time.sleep(3)

	  	[temp,humidity] = grovepi.dht(sensor,blue)
	  	print "Tempt = ", temp,"C\thumidity = ", humidity,"%"
	  	time.sleep(3)

	  	mqttc.publish("Readings: ", temp, humidity, light_value, resistance, sensor_value, qos=1)
          	print "Sent Successfully"

		except IOError:
                print "Error"
