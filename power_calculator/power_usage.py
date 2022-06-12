import mysql.connector
import random

power_consumption = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="power_consumption"
)

try:
    power_consumption_cursor = power_consumption.cursor()

    get_all_user = "select * from user_registration"
    power_consumption_cursor.execute(get_all_user)
    users = power_consumption_cursor.fetchall()
    for user in users:
      for i in range(0,1440):
        insert_power_usage_sql = "insert into power_usage (transformer_id, consumer_no, voltage) values (%s, %s, %s)"
        insert_power_usage_value = (user[2], user[5], random.randint(0,300) / 1000)
        power_consumption_cursor.execute(insert_power_usage_sql, insert_power_usage_value)
      power_consumption.commit()

except Exception as e: 
    print(e)