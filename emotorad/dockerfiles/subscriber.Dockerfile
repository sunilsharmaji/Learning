FROM python:3.8

WORKDIR /app

COPY mqtt-subscriber/requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY mqtt-subscriber/subscriber.py .

CMD ["python","subscriber.py"]
