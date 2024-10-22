create table if not exists "AuthUser"
(
    id         varchar(36)             not null
        primary key,
    email      varchar(255)            not null
        unique,
    password   varchar(255)            not null,
    active     boolean   default false not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists "Role"
(
    id         serial
        primary key,
    name       varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists "UserRole"
(
    id      varchar(36) not null
        primary key,
    user_id varchar(36) not null
        references "AuthUser",
    role_id integer     not null
        references "Role"
);

create table if not exists "RecoveryPassword"
(
    id      varchar(36)  not null
        primary key,
    user_id varchar(36)  not null
        references "AuthUser",
    token   varchar(255) not null
);

create table if not exists "City"
(
    id         serial
        primary key,
    name       varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists "Position"
(
    id         serial
        primary key,
    name       varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists "Employee"
(
    id       varchar(36)  not null
        primary key,
    name     varchar(255) not null,
    document varchar(15)  not null,
    email    varchar(255) not null,
    address  varchar(255) not null,
    city_id  integer      not null
        references "City",
    user_id  varchar(36)  not null
        references "AuthUser",
    status   integer
);

CREATE TABLE IF NOT EXISTS "EmployeeCellphone" (
    id serial PRIMARY KEY,
    employee_id varchar(36) NOT NULL REFERENCES "Employee",
    cellphone varchar(15) NOT NULL,
    relationship varchar(36) NOT NULL
);

create table if not exists "EmployeePosition"
(
    id          varchar(36) not null
        primary key,
    employee_id varchar(36) not null
        references "Employee",
    position_id integer     not null
        references "Position"
);

create table if not exists Migrations
(
    id        serial
        primary key,
    migration varchar(255) not null,
    batch     integer      not null
);

create table if not exists Sessions
(
    id            varchar(255) not null
        primary key,
    user_id       varchar(36),
    ip_address    varchar(45),
    user_agent    text,
    payload       text         not null,
    last_activity integer      not null
);

create index if not exists sessions_last_activity_index
    on Sessions (last_activity);

create index if not exists sessions_user_id_index
    on Sessions (user_id);

create table if not exists Cache
(
    key        varchar(255) not null
        primary key,
    value      text         not null,
    expiration integer      not null
);

create table if not exists cache_locks
(
    key        varchar(255) not null
        primary key,
    owner      varchar(255) not null,
    expiration integer      not null
);

CREATE TABLE IF NOT EXISTS "TypeClient" (
    id serial PRIMARY KEY,
    name varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS "Client" (
    id varchar(36) PRIMARY KEY,
    id_type_client integer NOT NULL REFERENCES "TypeClient",
    name varchar(255) NOT NULL,
    document varchar(15) NOT NULL,
    cellphone varchar(15) NOT NULL,
    address varchar(255) NOT NULL,
    postal_code varchar(10) NOT NULL,
    mail varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS "Category" (
    id serial PRIMARY KEY,
    name varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS "Product" (
    id varchar(36) PRIMARY KEY,
    name varchar(255) NOT NULL,
    description text NOT NULL,
    price decimal NOT NULL,
    stock integer NOT NULL,
    category_id integer NOT NULL REFERENCES "Category"
);