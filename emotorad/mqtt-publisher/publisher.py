import paho.mqtt.client as mqtt
import json
import time

# MQTT Settings
MQTT_BROKER = "localhost"  # Use the name of the EMQ X Docker service
MQTT_PORT = 1883
MQTT_TOPIC = "mqtt_topic"

# MQTT Publisher
def publish_message(client):
    message = {"data1": "value1", "data2": "value2"}
    client.publish(MQTT_TOPIC, json.dumps(message))
    print(f"Published message: {message}")

# MQTT Client Setup
mqtt_client = mqtt.Client()
mqtt_client.connect(MQTT_BROKER, MQTT_PORT, 60)

# Publish messages every 5 seconds
try:
    # while True:
    publish_message(mqtt_client)
    time.sleep(5)
except KeyboardInterrupt:
    print("Publisher terminated.")
