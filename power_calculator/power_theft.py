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

    get_start_id = "select * from power_usage where consumer_no = 1234567897 group by consumer_no"
    power_consumption_cursor.execute(get_start_id)
    start_id = power_consumption_cursor.fetchall()
    start_id = start_id[0][0]
    for i in range(0,500):
        update_power_usage_sql = "update power_usage set voltage = %s where id = %s"
        update_power_usage_value = (random.randint(1000, 2200) / 1000, start_id)
        power_consumption_cursor.execute(update_power_usage_sql, update_power_usage_value)
        start_id += 1
    power_consumption.commit()

except Exception as e: 
    print(e)