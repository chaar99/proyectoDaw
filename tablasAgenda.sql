CREATE TABLE IF NOT EXISTS USUARIOS(
						correo varchar(30) NOT NULL, 
						nombre varchar(30) NOT NULL,
						contrasenia varchar(50) NOT NULL,
    					DNI varchar(9) NOT NULL,
						primary key (correo)
						)
CREATE TABLE IF NOT EXISTS ROLES(
						id int NOT NULL AUTO_INCREMENT, 
						tipo varchar(7) NOT NULL,
						primary key ( id)
						)
CREATE TABLE IF NOT EXISTS USUARIOS_ROLES(
						correo varchar(30) NOT NULL, 
						idR int NOT NULL,
						primary key ( correo,idR),
                        FOREIGN KEY (correo) REFERENCES usuarios(correo),
                        FOREIGN KEY (idR) REFERENCES ROLES(id)
						)
CREATE TABLE IF NOT EXISTS TLF_PUBLICOS(
						nombre varchar(100) NOT NULL, 
						numero int NOT NULL,
						primary key (numero)
						)
CREATE TABLE IF NOT EXISTS TLF_PRIVADOS(
						nombre varchar(30) NOT NULL, 
                        numero int NOT NULL,
                        apellido varchar(15),
                        correo varchar(25),
						primary key (numero)
						)
CREATE TABLE IF NOT EXISTS USUARIOS_TLF_PRIVADOS(
						correo varchar(30) NOT NULL ,
                        numero int NOT NULL,
						primary key ( correo,numero),
                        FOREIGN KEY (correo) REFERENCES usuarios(correo),
                        FOREIGN KEY (numero) REFERENCES TLF_PRIVADOS(numero)
						)

INSERT INTO USUARIOS (nombre,contrasenia) VALUES("carmen",12345);
INSERT INTO USUARIOS (nombre,contrasenia) VALUES("jorge",1235);
INSERT INTO USUARIOS (nombre,contrasenia) VALUES("edu",1345);
INSERT INTO USUARIOS (nombre,contrasenia) VALUES("borja",1245);

INSERT INTO ROLES (tipo) VALUES("Admin");
INSERT INTO ROLES (tipo) VALUES("Regis");

INSERT INTO USUARIOS_ROLES (idU,idR) VALUES(1,1);
INSERT INTO USUARIOS_ROLES (idU,idR) VALUES(2,2);
INSERT INTO USUARIOS_ROLES (idU,idR) VALUES(3,1);
INSERT INTO USUARIOS_ROLES (idU,idR) VALUES(4,2);

INSERT INTO `tlf_publicos` (`nombre`, `numero`) VALUES ('Servicio 1 - 1 - 2.', '112'), ('Unidad de Protección Civil de la Delegación de Gobierno.', '983999000');

INSERT INTO TLF_PRIVADOS (nombre,numero) VALUES("hermana",698754911);
INSERT INTO TLF_PRIVADOS (nombre,numero) VALUES("tio",499847117);

INSERT INTO USUARIOS_TLF_PRIVADOS (idU,numero) VALUES(2,698754911);
INSERT INTO USUARIOS_TLF_PRIVADOS (idU,numero) VALUES(3,499847117);
