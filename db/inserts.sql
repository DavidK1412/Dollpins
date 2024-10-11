INSERT INTO auth_user(
    id,
    email,
    password,
    active
) VALUES (
    'ad7570be-9c51-4450-a535-0f1b8eb2274a',
    'davidcasallas013@gmail.com',
    '$2y$10$Nz62x1imfqm4LfO6oyc49.2V28B47qTIKlqFSju/3jgW.SZilsrZ.',
    true
);

INSERT INTO role(
    name
) VALUES (
    'ADMIN'
), (
    'SALES'
), (
    'STOCK'
), (
    'FINANCES'
);

INSERT INTO userrole(
    id,
    user_id,
    role_id
) VALUES (
    '4153eaa0-8a55-45fe-a6c7-7cae4c60ea2d',
    'ad7570be-9c51-4450-a535-0f1b8eb2274a',
    1
);

INSERT INTO Position(
    name
) VALUES (
    'ADMINISTRADOR'
), (
    'COMERCIAL'
), (
    'GESTOR DE INVENTARIO'
), (
    'GERENTE CONTABLE'
);

INSERT INTO Employee(
    id,
    name,
    document,
    email,
    phone,
    address,
    city_id,
    user_id
) VALUES (
    'eb6d6768-47a5-426d-b063-4f1ef25b433f',
    'David Casallas',
    '123456789',
    'davidcasallas013@gmail.com',
    '3225318966',
    'Cra. 63 #22-45',
    81,
    'ad7570be-9c51-4450-a535-0f1b8eb2274a'
);

INSERT INTO EmployeePosition(
    employee_id,
    position_id
) VALUES (
    'eb6d6768-47a5-426d-b063-4f1ef25b433f',
    1
);
