create database moviePass;
use moviePass;

#drop database moviePass;

create table cinemas (
id_cine int not null auto_increment,
cinemaName varchar(255) not null,
cinemaAddress varchar (255) not null,
capacity int not null, #Cantidad maxima de salas
constraint pk_cines primary key (id_cine),
constraint unq_cinemas unique (cinemaName, cinemaAddress));

create table rooms (
id_room int not null auto_increment,
roomName varchar (255) not null,
seatsCapacity int not null,
ticketValue float not null,
id_cine int not null, 
constraint pk_rooms primary key (id_room),
constraint fk_cinemaRoom foreign key (id_cine) references cinemas(id_cine) on update cascade on delete cascade);

create table functions (
id_function int not null auto_increment,
id_room int not null,
id_movie int not null, 
occupiedSeats int not null default 0,
functionDate datetime not null,
functionsHour VARCHAR(255),
constraint pk_function primary key (id_function),
constraint fk_functionsRooms foreign key (id_room) references rooms (id_room) on update cascade on delete cascade,
constraint fk_movieId foreign key (id_movie) references movies (id_movie) on update cascade on delete cascade,
constraint unq_movieRoom unique (id_room, functionDate,functionsHour)); #Para que en una sala, en un dia determinado, no se puedan reproducir dos peliculas

select * from functions;
select * from movies;
drop table functions;
#------------------------------- Como guardar una imagen en BDD ------------------------ :) 
drop table movies;
create table movies(
id_movie int not null auto_increment,
id int not null, #del json
title varchar (255) not null, 
original_title varchar (255) not null,
overview varchar (1000) not null,
original_language varchar (255) not null,
vote_average float not null,
vote_count float not null,
video boolean not null,
release_date date not null, 
popularity float not null,
poster_path varchar(255) not null,
backdrop_path varchar(255) not null,
adult boolean not null,
genre_ids varchar (255) not null, 
constraint pk_movies primary key (id_movie),
constraint unq_title unique (title));


create table genres (
id_genre int not null,
genreName varchar (255),
constraint pk_genres primary key (id_genre));

create table userTypes (
id_userType int not null auto_increment,
nameType varchar (255),
constraint pk_userTye primary key (id_userType));

insert into userTypes (nameType) values ("Administrador"),("Usuario"),("Dueño cine");

create table users (
id_user int not null auto_increment,
firstName varchar (255) not null, 
lastName varchar (255) not null,
userName varchar (255) not null,
pass varchar (255) not null,
mail varchar (255) not null,
dni varchar (255) not null,
birthDate date not null,
id_userType int not null,
constraint pk_users primary key (id_user),
constraint fk_usersType foreign key (id_userType) references userTypes (id_userType) on update cascade on delete cascade);

insert into users (firstName, lastName, userName, pass, mail, dni, birthDate, id_userType) VALUES
("Rodrigo", "Perez", "ropeque19", "hola123", "rope@rope", "40123123", "2000-1-19", 1);
