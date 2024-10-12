INSERT INTO public.authuser (id, email, password, active, created_at, updated_at) VALUES ('eed47f04-5526-42a3-a3be-d34dd906ea57', 'test@test.com', '$2y$12$mj/Mg32Z/n9EEgch5Fb5u.kcZTw5Hwfsd.tBFSJfBen0O.VF.vbuq', true, '2024-10-07 21:47:58.000000', '2024-10-10 21:39:42.000000');
INSERT INTO public.authuser (id, email, password, active, created_at, updated_at) VALUES ('d975e0b9-efa4-4df4-801b-5568ea391204', 'andresguevaraalvarez99@gmail.com', '$2y$12$rYQgEfsTvS9Ez11ryYW2BugzuurodjbXkgZXIx0S3uou09HYKu6UO', true, '2024-10-11 21:55:42.000000', '2024-10-11 22:16:04.000000');
INSERT INTO public.authuser (id, email, password, active, created_at, updated_at) VALUES ('3c0e63ee-5d48-45ed-9c88-a639e3764240', 'asad@gmail.com', '$2y$12$RTrChUiIOAcTiqD1o56C3uWhelEl8s8wiZms6VbyaAOOBabythDG6', false, '2024-10-12 02:13:10.000000', '2024-10-12 04:03:22.000000');
INSERT INTO public.authuser (id, email, password, active, created_at, updated_at) VALUES ('26d787c2-1ec5-414c-804a-90c751361212', 'davidcasallas013@gmail.com', '$2y$12$M9TqUjMmLuEzbWbJRQafQeEPbAIBTWq63pMHXj4hRN0fHx1pe64xi', true, '2024-10-11 21:32:32.000000', '2024-10-12 12:14:38.000000');
INSERT INTO public.authuser (id, email, password, active, created_at, updated_at) VALUES ('7bddac6d-e459-46fc-98ba-c1f7d93757a2', 'dhcasallasb@udistrital.edu.co', '$2y$12$cUpQG1jscxgdwprBojt5fOJqBJ.VI2b4Q/hm9/L6J4Nfnc/Rf.Sxq', true, '2024-10-12 02:11:58.000000', '2024-10-12 13:39:30.000000');

INSERT INTO public.employee (id, name, document, email, phone, address, city_id, user_id, status) VALUES ('c195f37a-ccb2-47e7-832c-b627a12cbb1a', 'David Test 2', '101599300233', 'asad@gmail.com', '2112312', 'Transversal 98A # 21 - 91', 4, '3c0e63ee-5d48-45ed-9c88-a639e3764240', 2);
INSERT INTO public.employee (id, name, document, email, phone, address, city_id, user_id, status) VALUES ('73f2c922-12f6-4bd1-b70d-8ad64f97dc6b', 'asdas', '10159930021', 'davidcasallas013@gmail.com', '123123', 'asdada', 2, '26d787c2-1ec5-414c-804a-90c751361212', 1);
INSERT INTO public.employee (id, name, document, email, phone, address, city_id, user_id, status) VALUES ('ebb12a2e-f334-4d16-bf7a-0a76fae069ea', 'Andres Guevara1', '1015483714', 'andresguevaraalvarez99@gmail.com', '3225312982', 'Transversal 98A # 21 - 91', 79, 'd975e0b9-efa4-4df4-801b-5568ea391204', 1);
INSERT INTO public.employee (id, name, document, email, phone, address, city_id, user_id, status) VALUES ('55667d35-3819-421c-b1e0-3db3677502c6', 'David Test', '10159930022', 'dhcasallasb@udistrital.edu.co', '3225318900', 'Transversal 98A # 21 - 90', 11, '7bddac6d-e459-46fc-98ba-c1f7d93757a2', 1);


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

INSERT INTO public.employeeposition (id, employee_id, position_id) VALUES ('b53ed97b-a2f8-4bae-be3c-5f0878e666ed', 'ebb12a2e-f334-4d16-bf7a-0a76fae069ea', 3);
INSERT INTO public.employeeposition (id, employee_id, position_id) VALUES ('63e2b828-3901-4d3a-ba00-3a77268f5cd1', '55667d35-3819-421c-b1e0-3db3677502c6', 3);
INSERT INTO public.employeeposition (id, employee_id, position_id) VALUES ('664abf90-aaa3-48e9-8bc4-d84b7f3d5403', '55667d35-3819-421c-b1e0-3db3677502c6', 4);


INSERT INTO public.recoverypassword (id, user_id, token) VALUES ('66f9fb30-74db-4463-94b2-468b9cc9bf93', 'eed47f04-5526-42a3-a3be-d34dd906ea57', 'JDJ5JDEyJG9RT2tBak5UTWIyRWFReHRqSzV0U084OUkzWHk3WFFuR2RXaWlWQzVYUXRIMHh0eGc5bm9h');
INSERT INTO public.recoverypassword (id, user_id, token) VALUES ('81ec7716-136a-4997-8743-b74b1cd1d78c', 'd975e0b9-efa4-4df4-801b-5568ea391204', 'JDJ5JDEyJDlrd1ZDNE9RSVNEYVptdVA0OW5TNU9sY1oydWhiR3FMUUdnQ213NEk5RWZQaUF4UGhBSjNx');
INSERT INTO public.recoverypassword (id, user_id, token) VALUES ('55fa0fa8-0efa-4364-b0b0-800f3f09310c', '3c0e63ee-5d48-45ed-9c88-a639e3764240', 'JDJ5JDEyJC8wUjlsOGVseUsxalVScWQwUC5EVXVOZU9MOFF1cUszdEhrWkhuN3hVQ24yWjYuOUdPSS5t');

INSERT INTO public.userrole (id, user_id, role_id) VALUES ('b2cfb321-00c0-49f0-b691-2646a9bca09a', 'eed47f04-5526-42a3-a3be-d34dd906ea57', 2);
INSERT INTO public.userrole (id, user_id, role_id) VALUES ('3ce3bb74-f10a-453c-8875-7b3907958a32', '26d787c2-1ec5-414c-804a-90c751361212', 1);
INSERT INTO public.userrole (id, user_id, role_id) VALUES ('8964931e-1708-4d29-a392-677e21ea0e07', '26d787c2-1ec5-414c-804a-90c751361212', 2);
INSERT INTO public.userrole (id, user_id, role_id) VALUES ('2822f4d2-e5fb-44fa-8fad-62567a08ffc9', '3c0e63ee-5d48-45ed-9c88-a639e3764240', 3);
INSERT INTO public.userrole (id, user_id, role_id) VALUES ('3cb69e41-3dfe-4096-b024-7022a9fb8bf4', '3c0e63ee-5d48-45ed-9c88-a639e3764240', 4);
INSERT INTO public.userrole (id, user_id, role_id) VALUES ('36a9a1d0-7650-4f46-92ad-3826dc0446f5', 'd975e0b9-efa4-4df4-801b-5568ea391204', 2);
INSERT INTO public.userrole (id, user_id, role_id) VALUES ('ad51251c-3ac5-4c54-b84d-002b7b6a1285', '7bddac6d-e459-46fc-98ba-c1f7d93757a2', 4);
