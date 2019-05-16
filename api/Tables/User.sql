create table user(
    id int auto_increment primary key,
    email varchar(50) not null unique key,
    full_name varchar(100) not null,
    birthday date not null,
    gender varchar(1) not null,
    password varchar(100) not null,
    date_created datetime not null default now(),
    date_updated datetime not null default now()
)