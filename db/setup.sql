CREATE TABLE IF NOT EXISTS AuthUser (
    id varchar(255) PRIMARY KEY NOT NULL UNIQUE,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    active boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Role (
    id SERIAL PRIMARY KEY  NOT NULL,
    name varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS UserRole (
    id varchar(255) PRIMARY KEY NOT NULL UNIQUE,
    user_id varchar(255) NOT NULL,
    role_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES AuthUser(id),
    FOREIGN KEY (role_id) REFERENCES Role(id)
);

CREATE TABLE IF NOT EXISTS RecoveryPassword (
    id SERIAL PRIMARY KEY NOT NULL,
    user_id varchar(255) NOT NULL,
    token varchar(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES AuthUser(id)
);

CREATE TABLE IF NOT EXISTS City (
    id SERIAL PRIMARY KEY NOT NULL,
    name varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Position (
    id SERIAL PRIMARY KEY NOT NULL,
    name varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Employee (
    id VARCHAR(255) PRIMARY KEY NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    document VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city_id INT NOT NULL,
    user_id VARCHAR(255) NOT NULL,
    FOREIGN KEY (city_id) REFERENCES City(id),
    FOREIGN KEY (user_id) REFERENCES AuthUser(id)
);

CREATE TABLE IF NOT EXISTS EmployeePosition (
    id SERIAL PRIMARY KEY NOT NULL,
    employee_id VARCHAR(255) NOT NULL,
    position_id INT NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Employee(id),
    FOREIGN KEY (position_id) REFERENCES Position(id)
);