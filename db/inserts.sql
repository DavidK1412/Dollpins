INSERT INTO public."AuthUser" (id, email, password, active, created_at, updated_at) VALUES ('d975e0b9-efa4-4df4-801b-5568ea391204', 'andresguevaraalvarez99@gmail.com', '$2y$12$rYQgEfsTvS9Ez11ryYW2BugzuurodjbXkgZXIx0S3uou09HYKu6UO', true, '2024-10-11 21:55:42.000000', '2024-10-11 22:16:04.000000');
INSERT INTO public."AuthUser" (id, email, password, active, created_at, updated_at) VALUES ('26d787c2-1ec5-414c-804a-90c751361212', 'davidcasallas013@gmail.com', '$2y$12$ihs4pOV7Jvf/9hIUwe.mpODaNhU9asH3vPMUojVgleMGHVh4j.N3.', true, '2024-10-11 21:32:32.000000', '2024-10-15 03:03:47.000000');

INSERT INTO public."Employee" (id, name, document, email, address, city_id, user_id, status) VALUES ('73f2c922-12f6-4bd1-b70d-8ad64f97dc6b', 'Dollpins Admin', '10159930021', 'davidcasallas013@gmail.com', 'Transversal 96B #21A - 70', 81, '26d787c2-1ec5-414c-804a-90c751361212', 1);
INSERT INTO public."Employee" (id, name, document, email, address, city_id, user_id, status) VALUES ('ebb12a2e-f334-4d16-bf7a-0a76fae069ea', 'Andres Guevara Alvarez', '1015483714', 'andresguevaraalvarez99@gmail.com', 'Transversal 98A # 21 - 91', 79, 'd975e0b9-efa4-4df4-801b-5568ea391204', 1);

INSERT INTO public."EmployeeCellphone" (employee_id, cellphone, relationship) VALUES ('73f2c922-12f6-4bd1-b70d-8ad64f97dc6b', '3012345678', 'Madre');
INSERT INTO public."EmployeeCellphone" (employee_id, cellphone, relationship) VALUES ('ebb12a2e-f334-4d16-bf7a-0a76fae069ea', '3123459892', 'Moza');

INSERT INTO public."Role" (id, name, created_at, updated_at) VALUES (1, 'ADMIN', '2024-10-07 21:47:37.845155', '2024-10-07 21:47:37.845155');
INSERT INTO public."Role" (id, name, created_at, updated_at) VALUES (2, 'SALES', '2024-10-07 21:47:37.845155', '2024-10-07 21:47:37.845155');
INSERT INTO public."Role" (id, name, created_at, updated_at) VALUES (3, 'STOCK', '2024-10-07 21:47:37.845155', '2024-10-07 21:47:37.845155');
INSERT INTO public."Role" (id, name, created_at, updated_at) VALUES (4, 'FINANCES', '2024-10-07 21:47:37.845155', '2024-10-07 21:47:37.845155');

INSERT INTO public."Position" (id, name, created_at, updated_at) VALUES (1, 'ADMINISTRADOR', '2024-10-11 19:13:53.928442', '2024-10-11 19:13:53.928442');
INSERT INTO public."Position" (id, name, created_at, updated_at) VALUES (2, 'COMERCIAL', '2024-10-11 19:13:53.928442', '2024-10-11 19:13:53.928442');
INSERT INTO public."Position" (id, name, created_at, updated_at) VALUES (3, 'GESTOR DE INVENTARIO', '2024-10-11 19:13:53.928442', '2024-10-11 19:13:53.928442');
INSERT INTO public."Position" (id, name, created_at, updated_at) VALUES (4, 'GERENTE CONTABLE', '2024-10-11 19:13:53.928442', '2024-10-11 19:13:53.928442');

INSERT INTO public."EmployeePosition" (id, employee_id, position_id) VALUES ('d80c8acc-607d-4cd2-930c-2d38b3eeb508', '73f2c922-12f6-4bd1-b70d-8ad64f97dc6b', 2);
INSERT INTO public."EmployeePosition" (id, employee_id, position_id) VALUES ('0979bd30-2aaf-4453-9dc0-987fc675d427', '73f2c922-12f6-4bd1-b70d-8ad64f97dc6b', 4);
INSERT INTO public."EmployeePosition" (id, employee_id, position_id) VALUES ('7cedd4ab-9cd8-450f-b06f-aa9d5dd6ac72', 'ebb12a2e-f334-4d16-bf7a-0a76fae069ea', 3);

INSERT INTO public."UserRole" (id, user_id, role_id) VALUES ('cd993bd5-fd9e-45ad-9bcb-5dd33c1486e9', '26d787c2-1ec5-414c-804a-90c751361212', 1);
INSERT INTO public."UserRole" (id, user_id, role_id) VALUES ('7005b837-6652-4052-af19-0e10f7f5d2e7', '26d787c2-1ec5-414c-804a-90c751361212', 2);
INSERT INTO public."UserRole" (id, user_id, role_id) VALUES ('7d3bbaae-c652-4997-ac24-775b8ec76099', 'd975e0b9-efa4-4df4-801b-5568ea391204', 3);

INSERT INTO public."OrderStatus"(id, name) VALUES (1, 'Pendiente');
INSERT INTO public."OrderStatus"(id, name) VALUES (2, 'Enviado');
INSERT INTO public."OrderStatus"(id, name) VALUES (3, 'Finalizado');

INSERT INTO public."TransactionsType"(id, name) VALUES (1, 'Venta');
INSERT INTO public."TransactionsType"(id, name) VALUES (2, 'Pago proveedor');
INSERT INTO public."TransactionsType"(id, name) VALUES (3, 'Pago nómina');
INSERT INTO public."TransactionsType"(id, name) VALUES (4, 'Pago servicios');
INSERT INTO public."TransactionsType"(id, name) VALUES (5, 'Pago terceros');
INSERT INTO public."TransactionsType"(id, name) VALUES (6, 'Imprevistos');
INSERT INTO public."TransactionsType"(id, name) VALUES (7, 'Inversiones');
INSERT INTO public."TransactionsType"(id, name) VALUES (8, 'Otros');
