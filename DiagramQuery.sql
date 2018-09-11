select to_char(date, 'DD.MM.YY HH:MI') as fdate, cast(new_state as integer) as new_state from actuators_state_history where actuator_id = 1 order by date desc

select to_char(date, 'DD.MM.YY HH:MI') as fdate, value from onewire_sensors where address = '28FF846AA31503F4' order by date desc limit 50

select * from onewire_sensors order by date desc limit 10

select * from (
select date as sort_date, date as start_date, null as stop_date, new_state from actuators_state_history where actuator_id = 1 and new_state  
union
select date as sort_date, null, date as stop_date, new_state from actuators_state_history where actuator_id = 1 and not new_state) as boiler
order by sort_date