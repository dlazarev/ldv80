#!/usr/bin/env python
import psycopg2
from datetime import tzinfo, timedelta, datetime
import sys

try:
    pg_conn = psycopg2.connect("dbname='ldv80' user='ldv80' host='ldv80.ddns.net' password='sE48zc6RQjrD' connect_timeout=10")
except psycopg2.DatabaseError, err:
    print "Unable to connect to the postgreSQL"
    print str(err)
    sys.exit(1)
pg_cursor = pg_conn.cursor()

query = "SELECT date, address, name, value from get_onewire_sensors_last_values()"
try:
	pg_cursor.execute(query)
except psycopg2.Error as err:
	print str(err)
	sys.exit(1)
	
rows = pg_cursor.fetchall()
now = datetime.now()
two_hours_ago = now + timedelta(hours=-2)

for row in rows:
	s_date = row[0]
	if two_hours_ago > s_date:
		print("Last value: " + str(row[3]) + " for sensor \"" + row[2] + "\" was obtained at: " + str(row[0]))
	
pg_conn.commit()
pg_cursor.close()
pg_conn.close()
