create DATABASE alarma;

use alarma;

CREATE TABLE usuarios(
    dni int(8),
    nombre varchar(30) NOT NULL,
    apellido varchar(30) NOT NULL,
    partido varchar(30) NOT NULL,
    localidad varchar(30) NOT NULL,
    direccion point NOT NULL,
    telefono int NOT NULL,
    mail varchar(255) NOT NULL,
    clave varchar(255) NOT NULL,
    PRIMARY KEY(dni)
);

CREATE TABLE incidentes(
    id_incidente int AUTO_INCREMENT, 
    dni_usuario int NOT NULL,
    tipo_victima varchar(30) NOT NULL,
    observacion varchar(255) NOT NULL,
    tipo varchar(30) NOT NULL,
    ubicacion point NOT NULL,
    partido varchar(30) NOT NULL,
    localidad varchar(30) NOT NULL,
    PRIMARY KEY(id_incidente),
    FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni)
);

CREATE TABLE comentario(
    id_comentario int AUTO_INCREMENT, 
    dni_usuario int NOT NULL,
    asunto varchar(50) NOT NULL,
    observacion varchar(255) NOT NULL,
    PRIMARY KEY(id_comentario),
    FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni)
);

-- Datos de ejemplo para alarma

INSERT INTO usuarios (dni, nombre, apellido, partido, localidad, direccion, telefono, mail, clave) VALUES
('12345678', 'Juan', 'Pérez', 'Quilmes', 'Ezpeleta', POINT(34.7212, -58.2494), '0111234567', 'juan.perez@example.com', 'clave1234'),
('87654321', 'Ana', 'Gómez', 'Berazategui', 'El Pato', POINT(34.7499, -58.1462), '0112345678', 'ana.gomez@example.com', 'clave5678'),
('11223344', 'Luis', 'Martínez', 'Florencio Varela', 'Bosques', POINT(34.7986, -58.3000), '0113456789', 'luis.martinez@example.com', 'claveabcd'),
('22334455', 'Laura', 'Rodríguez', 'Quilmes', 'Bernal', POINT(34.7085, -58.2370), '0119876543', 'laura.rodriguez@example.com', 'claveefgh');

INSERT INTO incidentes (dni_usuario, tipo_victima, observacion, tipo, ubicacion, partido, localidad) VALUES
('12345678','Personal','Robo en la oficina central', 'Robo', POINT(34.7212, -58.2494), 'Florencio Varela', 'Bosques'),
('12345678','Personal','Robo en el kiosco', 'Robo', POINT(34.7499, -58.1462)'Berazategui', 'El Pato'),
('11223344', 'De terceros','Robo en la sucursal del banco', 'Robo', POINT(34.7986, -58.3000)'Berazategui', 'Pereyra'),
('22334455','De terceros', 'Robo en la casa de la esquina', 'Robo', POINT(34.7085, -58.2370), 'Quilmes', 'Ezpeleta');


INSERT INTO comentario (dni_usuario, asunto, observacion) VALUES
('12345678','Sugerencia sobre color','Deberían poner otro color'),
('22334455','otro comentario de prueba','Comentario de prueba');


-- Ver coordenadas con el select
SELECT ST_X(ubicacion) AS longitud,
    ST_Y(ubicacion) AS latitud
FROM incidentes;