create database moviePass;
use moviePass;

#drop database moviePass;

create table cinemas (
id_cine int not null auto_increment,
cinemaName varchar(50) not null,
cinemaAddress varchar (50) not null,
capacity int not null, #Cantidad maxima de salas
aperHour varchar(50) not null,
closeHour varchar(50) not null,
constraint pk_cines primary key (id_cine),
constraint unq_cinemas unique (cinemaName, cinemaAddress));

select * from cinemas;

create table rooms (
id_room int not null auto_increment,
roomName varchar (50) not null,
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
functionsHour varchar (50) not null,
constraint pk_function primary key (id_function),
constraint fk_functionsRooms foreign key (id_room) references rooms (id_room) on update cascade on delete cascade,
constraint fk_movieId foreign key (id_movie) references movies (id_movie) on update cascade on delete cascade,
constraint unq_movieRoom unique (id_room, functionDate, functionsHour)); #Para que en una sala, en un dia determinado, no se puedan reproducir dos peliculas


#------------------------------- Como guardar una imagen en BDD ------------------------ :) 

create table movies (
id_movie int not null auto_increment,
id int not null, #del json
title varchar (100) not null, 
original_title varchar (100) not null,
overview varchar (1000) not null,
original_language varchar (50) not null,
vote_average float not null,
vote_count float not null,
video boolean not null,
release_date date not null, 
popularity float not null,
poster_path varchar(100) not null,
backdrop_path varchar(100) not null,
adult boolean not null,
genre_ids varchar (50) not null, 
constraint pk_movies primary key (id_movie),
constraint unq_title unique (title));


create table genres (
id_genre int not null,
genreName varchar (50),
constraint pk_genres primary key (id_genre));

create table userTypes (
id_userType int not null auto_increment,
nameType varchar (50),
constraint pk_userTye primary key (id_userType));

insert into userTypes (nameType) values ("Administrador"),("Usuario"),("Dueño cine");
select * from users;

update table users modify id_userType where id_user = 2;

create table users (
id_user int not null auto_increment,
firstName varchar (50) not null, 
lastName varchar (50) not null,
userName varchar (50) not null,
pass varchar (999) not null,
mail varchar (50) not null,
dni varchar (50) not null,
birthDate date not null,
id_userType int not null,
constraint pk_users primary key (id_user),
constraint fk_usersType foreign key (id_userType) references userTypes(id_userType) on update cascade on delete cascade);
