select *, end_at - start_at
 from (
SELECT case when start_at >= current_date then start_at else current_date end as start_at, start_state, end_at
  FROM boiler_timing where start_state = true and (start_at >= current_date or end_at >= current_date)) as today_data;

select * from actuators_state_history order by date desc limit 1;

select *, 
	case when start_state = true then (end_at - start_at) else interval '0 seconds' end as go_interval,
	case when start_state = false then (end_at - start_at) else interval '0 seconds' end as stop_interval
 from (
SELECT case when start_at >= current_date then start_at else current_date end as start_at, start_state, end_at
  FROM boiler_timing where (start_at >= current_date or end_at >= current_date)) as today_data;

