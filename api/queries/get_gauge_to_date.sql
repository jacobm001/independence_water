select distinct
	strftime(:tformat, time_read) as timeperiod
	sum(value) as value
from
	meter_read
where
	strftime(:tformat, time_read) = :period;