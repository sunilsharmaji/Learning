import paho.mqtt.client as mqtt
import json
import redis

# MQTT Settings
MQTT_BROKER = "emqx"  # Use the name of the EMQ X Docker service
MQTT_PORT = 1883
MQTT_TOPIC = "mqtt_topic"

# Redis Settings
REDIS_HOST = "redis"
REDIS_PORT = 6379
REDIS_DB = 0

# Create a Redis connection
redis_client = redis.Redis(host=REDIS_HOST, port=REDIS_PORT, db=REDIS_DB)

# MQTT Callbacks
def on_connect(client, userdata, flags, rc):
    print(f"Connected with result code {rc}")
    client.subscribe(MQTT_TOPIC)

def on_message(client, userdata, msg):
    payload = json.loads(msg.payload.decode())
    print(f"Received message: {payload}")

    # Store data in Redis
    store_data_in_redis(payload)

def store_data_in_redis(data):
    # Assuming data is a dictionary
    for key, value in data.items():
        # redis_client.hset(MQTT_TOPIC, key, value)
        print(f"Stored {key}: {value} in Redis")

# MQTT Client Setup
mqtt_client = mqtt.Client()
mqtt_client.on_connect = on_connect
mqtt_client.on_message = on_message

# Connect to MQTT broker
mqtt_client.connect(MQTT_BROKER, MQTT_PORT, 60)

# Start the MQTT loop
mqtt_client.loop_start()

# Keep the program running
try:
    while True:
        pass
except KeyboardInterrupt:
    print("Subscriber terminated.")

