
select (sum(temp_hour_ago) - sum(temp_now)) as temp_diff from (
select temp_hour_ago, 0 as temp_now from (
select date, to_number(value, '99.9') as temp_hour_ago from onewire_sensors where address = '28FFB21A9015037E' order by date desc limit 1 offset 6) as t_hour_ago

union

select 0, temp_now from (
select date, to_number(value, '99.9') as temp_now from onewire_sensors where address = '28FFB21A9015037E' order by date desc limit 1 offset 0) as t_now ) as t_data