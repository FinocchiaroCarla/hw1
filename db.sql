CREATE database hw1;
USE hw1;

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(255) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;

CREATE TABLE saved(
    id integer primary key auto_increment,
    user varchar(255),
    content json,
    foreign key(user) references users(username) on delete cascade on update cascade
) Engine = InnoDB;
