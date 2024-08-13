DROP DATABASE IF EXISTS modeshops;

CREATE DATABASE modeshops;

use modeshops;

CREATE TABLE User (
    u_id int auto_increment PRIMARY KEY,
    fname varchar(255),
    lname varchar(255),
    email varchar(255) unique ,
    password varchar(255),
    address varchar(255)
);

CREATE TABLE Products (
    p_id int auto_increment PRIMARY KEY,
    p_name varchar(255),
    details text,
    role varchar(10),
    price float,
    image VARCHAR(255)

);

CREATE TABLE Bestellung (
    b_id int auto_increment PRIMARY KEY,
    u_id int,
    p_id int,
    dateTime DATETIME,
    amount int,
    ordernum int,

    FOREIGN KEY (u_id) REFERENCES User(u_id),
    FOREIGN KEY (p_id) REFERENCES Products(p_id)
);