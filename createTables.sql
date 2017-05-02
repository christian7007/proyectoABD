CREATE TABLE usuario(
    nombre varchar(15) PRIMARY KEY,
    pass varchar(128) not null,
    f_nacimiento date not null CHECK (f_nacimiento < CURRENT_DATE),
    admin integer not null CHECK (0 <= admin or admin <= 1));
    
CREATE TABLE generos(
    genero varchar(15) PRIMARY KEY);
    
CREATE TABLE gustos(
    usuario varchar(15) not null,
    genero varchar(15) not null,
    PRIMARY KEY (usuario, genero),
    FOREIGN KEY (usuario) REFERENCES usuario(nombre),
    FOREIGN KEY (genero) REFERENCES generos(genero));
    
CREATE TABLE grupos(
    nombre varchar(15) not null,
    usuario varchar(15) not null,
    PRIMARY KEY (nombre, usuario),
    FOREIGN key (usuario) REFERENCES usuario (nombre));
    

CREATE TABLE Mensajes(
    id int NOT null AUTO_INCREMENT PRIMARY KEY,
    emisor varchar(15) not null,
    usuarioDestinatario varchar(15) DEFAULT NULL,
    grupoDestinatario varchar(15) DEFAULT NULL,
    mensaje TEXT NOT NULL, 
    FOREIGN KEY (emisor) REFERENCES usuario(nombre),
    FOREIGN KEY (usuarioDestinatario) REFERENCES usuario(nombre),
    FOREIGN KEY (grupoDestinatario) REFERENCES grupos(nombre),
    CONSTRAINT chk_destinatario CHECK ((usuarioDestinatario is not null) XOR (grupoDestinatario is not null))
);