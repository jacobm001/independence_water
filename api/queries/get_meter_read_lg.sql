select distinct
	strftime(:tformat, time_read) as `timestamp`,
	(
		select
			max(mr.value)
		from
			meter_read mr
		where
			mr.meter_id = meter_read.meter_id
			and strftime(:tformat, mr.time_read) = strftime(:tformat, meter_read.time_read)
	) - ( 
		select
			min(mr.value)
		from
			meter_read mr
		where
			mr.meter_id = meter_read.meter_id
			and strftime(:tformat, mr.time_read) = strftime(:tformat, meter_read.time_read)
	) as value
from
	meter_read
where
	meter_id = :meter_id
group by
	strftime(:tformat, time_read);