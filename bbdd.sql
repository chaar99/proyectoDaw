CREATE DATABASE IF NOT EXISTS tienda;

CREATE TABLE IF NOT EXISTS PRODUCTOS(
		id_productos int NOT NULL AUTO_INCREMENT, 
		nombre varchar(30) NOT NULL,
		stock int NOT NULL,
		ruta VARCHAR(50) NOT NULL,
		descripcion varchar(60) NOT NULL,
		precio int NOT NULL,
		primary key (id_productos)
	);

CREATE TABLE IF NOT EXISTS USUARIOS(
		correo varchar(30) NOT NULL, 
		nombre varchar(30) NOT NULL,
		surname_1 VARCHAR(30),
		surname_2 VARCHAR(30),
		contrasenia varchar(150) NOT NULL,
		DNI varchar(9) NOT NULL,
		primary key (correo)
	);

CREATE TABLE IF NOT EXISTS ROLES(
		id int NOT NULL AUTO_INCREMENT, 
		tipo varchar(7) NOT NULL,
		primary key (id)
	);

CREATE TABLE IF NOT EXISTS USUARIOS_ROLES(
		correo varchar(30) NOT NULL, 
		idR int NOT NULL,
		primary key ( correo,idR),
		FOREIGN KEY (correo) REFERENCES usuarios(correo),
		FOREIGN KEY (idR) REFERENCES ROLES(id)
	);

CREATE TABLE IF NOT EXISTS PEDIDOS(
    	id_pedido int NOT NULL AUTO_INCREMENT,
    	calle varchar(50) NOT NULL,
    	detalle_calle varchar(50),
    	ciudad varchar(20) NOT NULL,
    	provincia varchar(20) NOT NULL,
    	postal_code int NOT NULL,
    	precio_t INT,
    	PRIMARY KEY(id_pedido)
    );

CREATE TABLE IF NOT EXISTS REL_PEDIDOS_CLIENTES_PRODUCTOS(
	id_rel int NOT NULL AUTO_INCREMENT,
	id_pedido int NOT NULL,
	correo varchar(30) NOT NULL,
	id_producto int NOT NULL,
	cantidad_products int,
	PRIMARY KEY(id_rel),
	FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
	FOREIGN KEY (correo) REFERENCES usuarios(correo),
	FOREIGN KEY (id_producto) REFERENCES productos(id_productos)
);

INSERT INTO ROLES (tipo) VALUES("Admin");
INSERT INTO ROLES (tipo) VALUES("Cliente");
