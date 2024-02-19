FROM python:3.8

WORKDIR /app

COPY mqtt-publisher/requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY mqtt-publisher/publisher.py .

CMD ["python", "-c", "bash"]
