create table if not exists meter_read (
	read_id integer primary key autoincrement,
	meter_id integer not null,
	value integer not null,
	time_read date not null,
	constraint meter_read_unq unique (meter_id, value, time_read)
);

create index if not exists meter_read_sorted on meter_read(meter_id,time_read);