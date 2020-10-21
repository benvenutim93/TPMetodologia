create database moviePass;
use moviePass;

create table cinemas (
id_cine int not null auto_increment,
cinemaName varchar(50) not null,
cinemaAddress varchar (50) not null,
capacity int not null, #Cantidad maxima de salas
constraint pk_cines primary key (id_cine),
constraint unq_cinemas unique (cinemaName, cinemaAddress));

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
constraint pk_function primary key (id_function),
constraint fk_functionsRooms foreign key (id_room) references rooms (id_room) on update cascade on delete cascade,
constraint fk_movieId foreign key (id_movie) references movies (id_movie) on update cascade on delete cascade,
constraint unq_movieRoom unique (id_room, functionDate)); #Para que en una sala, en un dia determinado, no se puedan reproducir dos peliculas


#------------------------------- Como guardar una imagen en BDD ------------------------ :) 
create table movies (
id_movie int not null auto_increment,
title varchar (100) not null, 
overview varchar (1000) not null,
movieLanguage varchar (50) not null,
vote_avg float not null,
releaseDate date not null, 
constraint pk_movies primary key (id_movie),
constraint unq_title unique (title));



