create table if not exists users (
	user_id  integer primary key autoincrement,
	username text not null,
	password text not null,
	name     text
);

create table if not exists meter_info (
	meter_id integer primary key,
	address  text not null
);

create table if not exists user_owns (
	id       integer primary key autoincrement,
	user_id  integer not null,
	meter_id integer not null,
	foreign key(user_id)  references users(user_id),
	foreign key(meter_id) references users(meter_id)
);

create table if not exists meter_read (
	read_id   integer primary key autoincrement,
	meter_id  integer not null,
	value     integer not null,
	time_read date not null,
	constraint meter_read_unq unique (meter_id, value, time_read)
);

create table if not exists users (
	id       integer primary key autoincrement,
	username text not null unique,
	password text not null unique
);

create index if not exists meter_read_sorted on meter_read(meter_id desc,time_read desc);
insert into users(`username`, `password`) values('admin', 'admin');