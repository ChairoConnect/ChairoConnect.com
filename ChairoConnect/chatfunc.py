import mysql.connector
from flask import Flask, request, jsonify

# Connect to database for XAMPP
conn = mysql.connector.connect(
    host="localhost",
    user="root",  # Default XAMPP username
    password="",
    database="chairo_social"
)

# Create Flask app
app = Flask(__name__)

# Handle chat messages
@app.route('/send_message', methods=['POST'])
def send_message():
    sender_id = request.form['sender_id']
    receiver_id = request.form['receiver_id']
    message = request.form['message']

    # Insert message into database
    cursor = conn.cursor()
    sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (%s, %s, %s)"
    val = (sender_id, receiver_id, message)
    cursor.execute(sql, val)
    conn.commit()
    cursor.close()

    return "Message sent successfully"

# Retrieve chat messages
@app.route('/get_messages', methods=['GET'])
def get_messages():
    user_id = request.args.get('user_id')

    # Retrieve messages from database
    cursor = conn.cursor(dictionary=True)
    sql = "SELECT * FROM messages WHERE sender_id = %s OR receiver_id = %s ORDER BY sent_at DESC"
    val = (user_id, user_id)
    cursor.execute(sql, val)
    messages = cursor.fetchall()
    cursor.close()

    return jsonify(messages)

if __name__ == "__main__":
    app.run(debug=True)
