CREATE TABLE users (
 id_usuario tinyint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 nome_usuario varchar(10) NOT NULL,
 password varchar(100) NOT NULL,
 email_usuario varchar(100) NOT NULL,
 tipo_usuario varchar(100) NOT NULL,
 data_cadastro timestamp ,
 idade varchar(100) NOT NULL,
 sexo varchar(100) NOT NULL
 );

create table questao(
id_questao tinyint(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
titulo varchar(30) NOT NULL,
descricao varchar(150) NOT NULL,
tipo varchar(30) NOT NULL
);

CREATE TABLE questionario(
 id_questionario tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 titulo varchar(10) NOT NULL,
 descricao varchar(100) NOT NULL,
 data_ini timestamp NOT NULL,
 data_fim timestamp NOT NULL
 );

create table questionario_questao(
id_questionario_questao tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_questao tinyint NOT NULL,
id_questionario tinyint NOT NULL,
peso varchar(10) NOT NULL,
CONSTRAINT fk_questionario_questao1 FOREIGN KEY (id_questao)references questao(id_questao),
CONSTRAINT fk_questionario_questao2 FOREIGN KEY (id_questionario)references questionario(id_questionario)
);

create table respostas(
id_resposta tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_usuario tinyint NOT NULL,
id_questionario tinyint NOT NULL,
id_questao tinyint NOT NULL,
resposta varchar(500),
data_fim timestamp NOT NULL,
CONSTRAINT fk_respostas1 FOREIGN KEY (id_questao)references questao(id_questao),
CONSTRAINT fk_respostas2 FOREIGN KEY (id_questionario)references questionario(id_questionario),
CONSTRAINT fk_respostas3 FOREIGN KEY (id_usuario)references users(id_usuario)
);

create table questionario_demografico(
id_questionario_demografico tinyint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_usuario tinyint(4) NOT NULL,
data_resp timestamp NOT NULL,
nome_respondente varchar(100) NOT NULL,
idade_respondente varchar(3) NOT NULL,
ec_respondente varchar(100) NOT NULL,
cidade_respondente varchar(100) NOT NULL,
qtd_automoveis varchar(100) NOT NULL,
qtd_empregados varchar(100) NOT NULL,
qtd_maquina_lavar varchar(100) NOT NULL,
qtd_banheiro varchar(100) NOT NULL,
qtd_dvd varchar(100) NOT NULL,
qtd_geladeira varchar(100) NOT NULL,
qtd_freezer varchar(100) NOT NULL,
qtd_pc varchar(100) NOT NULL,
qtd_lava varchar(100) NOT NULL,
qtd_micro varchar(100) NOT NULL,
qtd_moto varchar(100) NOT NULL,
qtd_secadora varchar(100) NOT NULL,
origem_agua varchar(100) NOT NULL,
tipo_rua varchar(100) NOT NULL,
renda varchar(100) NOT NULL,
escolaridade_chefe varchar(100) NOT NULL, 
CONSTRAINT fk_questionario_demografico1 FOREIGN KEY (id_usuario)references users(id_usuario),
);

