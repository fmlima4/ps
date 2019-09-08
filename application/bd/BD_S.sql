create table cliente(
id_cliente tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome varchar(30) NOT NULL,
cpf varchar(30) NOT NULL,
telefone varchar(30) NOT NULL,
responsavel varchar(30) NOT NULL,
cep varchar(30) NOT NULL,
rua varchar(30) NOT NULL,
bairro varchar(30) NOT NULL,
cidade varchar(30) NOT NULL,
data_inclusao varchar(30) NOT NULL
);

CREATE TABLE formulario(
 id_formulario tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 titulo varchar(10) NOT NULL,
 descricao varchar(100) NOT NULL
 );

create table fomularios_cliente(
id tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
cliente tinyint NOT NULL,
formulario tinyint NOT NULL,
data_inclusao varchar(300) NOT NULL,
conteudo varchar(5000),
CONSTRAINT fk_fomularios_cliente1 FOREIGN KEY (cliente)references cliente(id_cliente),
CONSTRAINT fk_fomularios_cliente2 FOREIGN KEY (formulario)references formulario(id_formulario)
);

CREATE TABLE users (
 id tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 username varchar(10) NOT NULL,
 password varchar(100) NOT NULL,
 cargo varchar(100) NOT NULL,
 ativo int(10) NOT NULL
 );
