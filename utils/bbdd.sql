CREATE DATABASE IF NOT EXISTS tienda;

CREATE TABLE IF NOT EXISTS PRODUCTOS(
		id_productos int NOT NULL AUTO_INCREMENT, 
		nombre varchar(30) NOT NULL,
		stock int NOT NULL,
		ruta VARCHAR(50) NOT NULL,
		descripcion varchar(60) NOT NULL,
		precio int NOT NULL,
		categoria VARCHAR(30) NOT NULL,
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
		correo varchar(30),
    	PRIMARY KEY(id_pedido),
		FOREIGN KEY (correo) REFERENCES usuarios(correo)
    );

CREATE TABLE IF NOT EXISTS REL_PEDIDOS_PRODUCTOS(
	id_pedido int NOT NULL,
	id_producto int NOT NULL,
	cantidad_products int,
	PRIMARY KEY(id_pedido,id_producto),
	FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
	FOREIGN KEY (id_producto) REFERENCES productos(id_productos)
);

INSERT INTO ROLES (tipo) VALUES("Admin");
INSERT INTO ROLES (tipo) VALUES("Cliente");


INSERT INTO `productos` (`id_productos`, `nombre`, `stock`, `ruta`, `descripcion`, `precio`) VALUES (NULL, 'Funko1', '5', 'imagenes/funko1.jpg', 'Este es el funko de harry potter', '12.95'), (NULL, 'Funko2', '9', 'imagenes/funko2.jpg', 'este es el funko de miguel de coco', '15');
INSERT INTO `productos` (`id_productos`, `nombre`, `stock`, `ruta`, `descripcion`, `precio`) VALUES (NULL, 'Funko3', '5', 'imagenes/funko3.jpg', 'Este es el funko de owi wan', '12.95');
INSERT INTO `productos` (`id_productos`, `nombre`, `stock`, `ruta`, `descripcion`, `precio`) VALUES (NULL, 'Harry con la escoba ', '9', './img/harry-escoba.jpg', 'Este es el funko de harry potter con la escoba', '12.95'), (NULL, 'Harry Potter con mandragora', '9', './img/harry-mandragora.jpg', 'este es el funko de Harry Potter con una mandragora', '15');