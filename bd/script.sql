CREATE DATABASE api;
USE api;
CREATE TABLE info(
	id int,
	name varchar(255)
);

select * from info;

delete from info where id!=0;
