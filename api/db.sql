DROP DATABASE IF EXIST ECOMMERCE;

CREATE DATABASE ECOMMERCE;

USE ECOMMERCE;

create table users (
    id int auto_increment primary key,
    email varchar(50) not null unique key,
    full_name varchar(100) not null,
    birthday date not null,
    gender varchar(1) not null,
    password varchar(100) not null,
    date_created datetime not null default now(),
    date_updated datetime not null default now() ON UPDATE CURRENT_TIMESTAMP
);

create table products (
    id int(11) auto_increment primary key,
    description varchar(50) not null unique,
    barcode varchar(50) not null unique,
    date_created datetime not null default now(),
    date_updated datetime not null default now() on update CURRENT_TIMESTAMP,
    picture text not null,
    inventory decimal(19,4) not null default 0
);