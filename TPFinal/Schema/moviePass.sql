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
constraint unq_cinemas unique (cinemaName, cinemaAddress))engine=InnoDB;


create table rooms (
id_room int not null auto_increment,
roomName varchar (50) not null,
seatsCapacity int not null,
ticketValue float not null,
id_cine int not null, 
constraint pk_rooms primary key (id_room),
constraint fk_cinemaRoom foreign key (id_cine) references cinemas(id_cine) on update cascade on delete cascade)engine=InnoDB;

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
constraint pk_movies primary key (id_movie),
constraint unq_title unique (title))engine=InnoDB;

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
constraint unq_movieRoom unique (id_room, functionDate, functionsHour))engine=InnoDB; #Para que en una sala, en un dia determinado, no se puedan reproducir dos peliculas

create table genres (
id_genre int not null,
genreName varchar (50),
constraint pk_genres primary key (id_genre))engine=InnoDB;

create table genresXmovies(
id_genre int not null,
id_movie int not null,
constraint pk_gxm primary key (id_genre,id_movie),
constraint fk_genre foreign key (id_genre) references genres(id_genre),
constraint fk_movie foreign key (id_movie) references movies(id_movie))engine=InnoDB;



create table userTypes (
id_userType int not null auto_increment,
nameType varchar (50),
constraint pk_userTye primary key (id_userType))engine=InnoDB;

insert into userTypes (nameType) values ("Administrador"),("Usuario"),("Dueño cine");

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
constraint fk_usersType foreign key (id_userType) references userTypes(id_userType) on update cascade on delete cascade)engine=InnoDB;

create table companies(
id_company int AUTO_INCREMENT not null, 
companyName varchar(255) not null,
constraint pk_company primary key (id_company))engine=InnoDB;

create table creditCards (
id_creditCard int AUTO_INCREMENT not null,
cardHolder varchar(255) not null, 
expiration date not null, 
numberCC varchar(255) not null, 
id_company int not null, 
id_user int not null,
constraint pk_creditCard primary key (id_creditCard),
constraint fk_user foreign key (id_user) references users(id_user),
constraint fk_company foreign key (id_company) references companies(id_company) on delete cascade on update cascade)engine=InnoDB;

create table tickets(
id_ticket int auto_increment not null,
id_function int not null,
qr int not null, #--------------- PREGUNTAR
constraint pk_ticket primary key (id_ticket),
constraint fk_function foreign key (id_function) references functions(id_function)on update cascade on delete cascade)engine=InnoDB;
  
  create table ticketXpurchase(
      id_txp int auto_increment,
      id_ticket int not null,
      id_purchase int not null
      constraint pk_txP primary key (id_txp),
      constraint fk_idTicket foreign key (id_ticket) references tickets(id_ticket)on update cascade on delete cascade,
      constraint fk_idPurchase foreign key (id_purchase) references purchases(id_purchase)on update cascade on delete cascade

  )engine=InnoDB;

create table purchases(
id_purchase int AUTO_INCREMENT not null,
total float not null, 
id_creditCard int not null,
purchaseDate date not null,
constraint pk_purchase primary key (id_purchase),
constraint fk_ticket foreign key (id_ticket) references tickets(id_ticket) on delete cascade,
constraint fk_creditCard foreign key (id_creditCard) references creditCards (id_creditCard))engine=InnoDB;


create table discounts (
id_discount int auto_increment not null,
percentage int not null, 
descript varchar (255) not null, 
minCant int not null, 
constraint pk_discount primary key (id_discount))engine=InnoDB;



create table discountsXcinema (
id_dxc int AUTO_INCREMENT not null, 
id_cine int not null,
id_discount int not null,
constraint pk_dxc primary key (id_dxc),
constraint fk_cine2 foreign key (id_cine) references cinemas (id_cine),
constraint fk_discount foreign key (id_discount) references discounts (id_discount))engine=InnoDB;


create table dayOfDiscount (
id_dod int AUTO_INCREMENT not null,
id_discount int not null,
dia varchar (255) not null,
constraint pk_dod primary key (id_dod),
constraint fk_discount2 foreign key (id_discount) references discounts(id_discount))engine=InnoDB;