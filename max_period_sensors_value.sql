select date, value, name from (
select onewire_sensors.date, onewire_sensors.address, onewire_sensors.value from onewire_sensors inner join 
(select address, max(date) as maxdate from onewire_sensors group by address) as LASTPERIOD
on onewire_sensors.date = LASTPERIOD.maxdate and onewire_sensors.address = LASTPERIOD.address and now() - onewire_sensors.date < interval '2 week') as last_values
left join sensors_desc on last_values.address = sensors_desc.address where now() - last_values.date > interval '1 hour' 