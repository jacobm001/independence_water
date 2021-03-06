select distinct
	strftime(:tformat, time_read) as `timestamp`,
	avg((
		select
			max(mr.value)
		from
			meter_read mr
		where
			mr.meter_id = meter_read.meter_id
			and strftime(:tformat, mr.time_read) = strftime(:tformat, meter_read.time_read)
	) - ( 
		select
			max(mr.value)
		from
			meter_read mr
		where
			mr.meter_id = meter_read.meter_id
			and strftime(:tformat, mr.time_read) = strftime(:tformat, meter_read.time_read, :dec_value)
	)) as value
from
	meter_read
group by
	strftime(:tformat, time_read);