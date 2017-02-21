
create table courses
	(
	id int primary key,
	name varchar(50) not null,
	duration int 

    );

create table courses_objectives
	(
	id int ,
	objective varchar(500) ,
	primary key(id,objective),
	foreign key(id) references courses(id)
	on delete cascade on update cascade

    );

 create table courses_audience
	(
	id int ,
	audience varchar(50) ,
	primary key(id,audience),
	foreign key(id) references courses(id)
	on delete cascade on update cascade

    );

create table questions
	(
		id int primary key,
		subject varchar(1000)

    );

create table events
	(
		id int primary key,
		title varchar(100) not null,
		edate date ,
		image longblob,
		description varchar(1000)



    );

create table clients
	(
	name varchar(50) primary key,
	information varchar(1000)

    );

create table online_reservation
	(   id int primary key,
		firstname varchar(50) not null,
		lastname varchar(50) not null,
		telephone int(10) not null,
		mobile_number int(11) not null,
		email varchar(60) not null,
		courseid int not null,
		foreign key(courseid) references courses(id)
		on delete cascade on update cascade
	);
