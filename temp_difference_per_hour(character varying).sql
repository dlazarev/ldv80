-- Function: temp_difference_per_hour(character varying)

-- DROP FUNCTION temp_difference_per_hour(character varying);

CREATE OR REPLACE FUNCTION temp_difference_per_hour(sensor_address character varying)
  RETURNS numeric AS
$BODY$
select (sum(temp_hour_ago) - sum(temp_now)) as temp_diff from (
	select temp_hour_ago, 0 as temp_now from (
		select date, to_number(value, '99.9') as temp_hour_ago from 
			onewire_sensors where address = sensor_address order by date desc limit 1 offset 6) as t_hour_ago

	union

	select 0, temp_now from (
		select date, to_number(value, '99.9') as temp_now from onewire_sensors where address = sensor_address 
			order by date desc limit 1 offset 0) as t_now ) as t_data;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION temp_difference_per_hour(character varying)
  OWNER TO ldv80;
COMMENT ON FUNCTION temp_difference_per_hour(character varying) IS 'возвращает разницу температур за последний час по определенному датчику';
