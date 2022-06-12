import mysql.connector
import random

power_consumption = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="power_consumption"
)

try:
    def getAmount(units):
        rate = 0
        if units >= 101 and units < 201:
            rate = rate + ((units - 100) * 1.5)
        elif units >= 201 and units < 501:
            rate = rate + (100 * 2)
            rate = rate + ((units - 200) * 3)
        else:
            rate = rate + (100 * 3.5)
            rate = rate + (300 * 4.6)
            rate = rate + ((units - 500) * 6.6)   
        return rate

    power_consumption_cursor = power_consumption.cursor()

    get_user = "select * from user_registration"
    power_consumption_cursor.execute(get_user)
    users = power_consumption_cursor.fetchall()
    for user in users:
        consumer_no = user[5]
        get_reading_sql = "select sum(voltage) from power_usage where consumer_no = " + str(consumer_no)
        power_consumption_cursor.execute(get_reading_sql)
        units = power_consumption_cursor.fetchall()[0][0]
        amount = getAmount(units)
        insert_reading_sql = "update user_registration set units = %s, amount = %s where consumer_no = %s"
        insert_reading_values = (units, amount, consumer_no)
        power_consumption_cursor.execute(insert_reading_sql, insert_reading_values)
    power_consumption.commit()

except Exception as e: 
    print(e)