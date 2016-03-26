create table if not exists meter_read (
	read_id integer primary key autoincrement,
	meter_id integer not null,
	value integer not null,
	time_read date not null
);