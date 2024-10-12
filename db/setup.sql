create table if not exists authuser
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

create table if not exists role
(
    id         serial
        primary key,
    name       varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists userrole
(
    id      varchar(36) not null
        primary key,
    user_id varchar(36) not null
        references authuser,
    role_id integer     not null
        references role
);

create table if not exists recoverypassword
(
    id      varchar(36)  not null
        primary key,
    user_id varchar(36)  not null
        references authuser,
    token   varchar(255) not null
);

create table if not exists city
(
    id         serial
        primary key,
    name       varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists position
(
    id         serial
        primary key,
    name       varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

create table if not exists employee
(
    id       varchar(36)  not null
        primary key,
    name     varchar(255) not null,
    document varchar(15)  not null,
    email    varchar(255) not null,
    phone    varchar(15)  not null,
    address  varchar(255) not null,
    city_id  integer      not null
        references city,
    user_id  varchar(36)  not null
        references authuser,
    status   integer
);

create table if not exists employeeposition
(
    id          varchar(36) not null
        primary key,
    employee_id varchar(36) not null
        references employee,
    position_id integer     not null
        references position
);

create table if not exists migrations
(
    id        serial
        primary key,
    migration varchar(255) not null,
    batch     integer      not null
);

create table if not exists sessions
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
    on sessions (last_activity);

create index if not exists sessions_user_id_index
    on sessions (user_id);

create table if not exists cache
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

