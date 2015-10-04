
CREATE DATABASE mxhacks;

DROP TABLE   User;
CREATE TABLE User
(
id_user int NOT NULL AUTO_INCREMENT ,
first_name varchar(255) NOT NULL ,
last_name varchar(255) NOT NULL ,
address varchar(255),
credit_candidate int NOT NULL DEFAULT 0 ,
monthly_earnings int NOT NULL DEFAULT 0 ,
has_partner int NOT NULL DEFAULT 0 ,
PRIMARY KEY (id_user)
);
INSERT INTO User(first_name, last_name, address, credit_candidate, monthly_earnings) VALUES ("Emilio", "Flores", "Monterrey", 1, 10000);
INSERT INTO User(first_name, last_name, address, credit_candidate, monthly_earnings) VALUES ("Enrique", "Hernandez", "Chihuahua", 0, 10000);
DROP TABLE Transaction;
CREATE TABLE Transaction
(
id_trans int NOT NULL AUTO_INCREMENT ,
id_user int NOT NULL ,
type int NOT NULL ,
amount float NOT NULL ,
monthly int NOT NULL ,
created date NOT NULL ,
PRIMARY KEY (id_trans)
);
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 1, 666, 0, '2015/10/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 1, 420, 0, '2015-10-03');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 1, 800, 0, '2015/11/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 1, 200, 0, '2015-12-03');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 1, 3000, 1, '2015/10/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 1, 4000, 1, '2015/10/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 2, 540, 0, '2015/10/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 2, 40, 0, '2015-10-03');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 2, 800, 0, '2015/11/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (1, 2, 4000, 1, '2015/10/06');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (2, 1, 420, 200, '2015-10-03');
INSERT INTO Transaction(id_user, type, amount, monthly, created) VALUES (2, 1, 420, 200, '2015-10-03');
DROP TABLE  Product;
CREATE TABLE Product
(
id_product int NOT NULL AUTO_INCREMENT ,
id_user int NOT NULL ,
name varchar(255) NOT NULL ,
description varchar(255) ,
amount float NOT NULL ,
completed boolean NOT NULL DEFAULT 0 ,
id_trans int ,
PRIMARY KEY (id_product)
);
DROP TABLE  Tanda;
CREATE TABLE Tanda
(
id_tanda int NOT NULL AUTO_INCREMENT ,
id_user int NOT NULL ,
intervalo_dias int NOT NULL,
num_personas int NOT NULL, 
num_repeticiones int NOT NULL,
cantidad int NOT NULL,
id_active int NOT NULL,
fecha_inicial DATE NOT NULL,
PRIMARY KEY (id_tanda)
);
DROP TABLE  UsuariosTanda;
CREATE TABLE UsuariosTanda
(
id_usuarios_tanda int NOT NULL AUTO_INCREMENT,
id_tanda int NOT NULL,
nombre varchar(255) NOT NULL,
PRIMARY KEY (id_usuarios_tanda)
);
