CREATE DATABASE IF NOT EXISTS tienda;

create TABLE productos(
    id_producto int NOT NULL AUTO_INCREMENT,
 	nombre varchar(50) NOT NULL,
    descripcion varchar(150),
    ruta varchar(50),
    PRIMARY KEY(id_producto)
 );

INSERT INTO productos(nombre,descripcion,ruta) VALUES ("funko1","funko muy bonito","imagenes/perro1")

 CREATE TABLE usuarios(
    nombre varchar(25),
    surname_1 varchar(25),
    surname_2 varchar(25),
    contra varchar(200),
    email varchar(50),
    PRIMARY KEY(nombre,contra)
 );