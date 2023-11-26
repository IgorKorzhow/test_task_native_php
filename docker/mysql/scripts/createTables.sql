USE testDB;

CREATE TABLE users
(
    id         int auto_increment primary key,
    name       varchar(50)  not null unique ,
    email      varchar(50)  not null unique,
    phone varchar(50) not null unique ,
    password   varchar(255) not null,
    created_at date         not null
);

