with cte as (
	select
		(
			select
				max(mr.value)
			from
				meter_read mr
			where
				mr.meter_id = meter_read.meter_id
				and strftime("%Y-%m-%d", mr.time_read) = strftime("%Y-%m-%d", meter_read.time_read)
		) - ( 
			select
				max(mr.value)
			from
				meter_read mr
			where
				mr.meter_id = meter_read.meter_id
				and strftime("%Y-%m-%d", mr.time_read) = strftime("%Y-%m-%d", meter_read.time_read, "-1 day")
		) as value
	from
		meter_read
	where
		meter_id = :meter_id
)
select
	avg(value) as value
from
	cte