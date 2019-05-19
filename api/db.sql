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

create table user_tokens (
    id int(11) auto_increment primary key,
    user_id int(11),
    token varchar(100) not null,
    status BOOLEAN default true,
    date_created datetime not null default now(),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

create table products (
    id int(11) auto_increment primary key,
    description varchar(50) not null unique,
    barcode varchar(50) not null unique,
    price decimal(19,4) not null default 0,
    date_created datetime not null default now(),
    date_updated datetime not null default now() on update CURRENT_TIMESTAMP,
    picture text not null,
    inventory decimal(19,4) not null default 0,
    status BOOLEAN default true
);

create table featured (
    id int(11) auto_increment primary key,
    product_id int(11),
    status BOOLEAN default true,
    date_created datetime not null default now(),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

create table carts (
    id int(11) auto_increment primary key,
    user_id int(11),
    total_price decimal(19,4),
    address text not null,
    date_created datetime not null default now(),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

create table cart_items (
    id int(11) auto_increment primary key,
    cart_id int(11) default null,
    quantity int(11) not null,
    product_id int(11),
    price decimal(19,4),
    description varchar(50) not null,
    picture text not null,
    barcode varchar(50) not null,
    status BOOLEAN default true,
    date_created datetime not null default now(),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (cart_id) REFERENCES carts(id)
);