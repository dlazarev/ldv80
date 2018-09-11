#!/usr/bin/env python
import fcntl, sys
import socket
import psycopg2
import datetime

TCP_IP = 'ldv80.ddns.net'
TCP_PORT = 8082
BUFFER_SIZE = 4096
MESSAGE = "Hello, World!"

pid_file = '/var/run/ldv80/get_sensor_data.pid'
fp = open(pid_file, 'w')
try:
    fcntl.lockf(fp, fcntl.LOCK_EX | fcntl.LOCK_NB)
except IOError:
    print "Another instance is running"
    sys.exit(0)

try:
	pg_conn = psycopg2.connect("dbname='ldv80' user='ldv80' host='localhost' connect_timeout=10")
except:
	print "Unable to connect to the postgresql database"
	exit(1)

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.settimeout(180.0)

try:
	s.connect((TCP_IP, TCP_PORT))
except:
    print "Unable to connect to the host " + TCP_IP
    pg_conn.close()
    exit(1)

pg_cur = pg_conn.cursor()

now = str(datetime.datetime.now())
i = 0
j = 0
while i < 3 and j < 100:
	data = s.recv(BUFFER_SIZE)
	if i > 1:
		query = "INSERT INTO onewire_sensors (date,address,value) VALUES('" + now +"', "
		sensor_data = data.split()
		for l in sensor_data:
			query += "'" + l + "', "
		query = query[:-2] + ");"
		try:
			pg_cur.execute(query)
		except psycopg2.Error as e:
                    print "Can't execute query: " + e.pgerror
		    exit(1) 
	if data[-4:] == '\r\n\r\n':
		i += 1
        j += 1

s.close()
pg_conn.commit()
pg_cur.close()
pg_conn.close()
