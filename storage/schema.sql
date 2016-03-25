create table if not exists meter_read (
	meter_id integer primary key,
	value integer not null,
	time_read date not null
);