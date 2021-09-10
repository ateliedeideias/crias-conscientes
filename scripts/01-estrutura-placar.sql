CREATE TABLE partidas (
	codigo int(11) NOT NULL AUTO_INCREMENT,
	codigo_usuario int(11) NOT NULL,
	datahora_inicio datetime NOT NULL,
	datahora_fim datetime,
	uuid varchar(36) NOT NULL,
	personagem smallint(5) unsigned not null,
	fase int(3) unsigned not null,
	pontos int(3) unsigned NOT NULL, 
	tempo int(6) unsigned NOT NULL, 
	finalizado tinyint(1) NOT NULL,
PRIMARY KEY (codigo),
CONSTRAINT partida_usuario_FK FOREIGN KEY (codigo_usuario) REFERENCES usuarios (codigo),
UNIQUE KEY partida_usuario_uuid_UN (codigo_usuario, uuid)
);

CREATE TABLE partida_fases (
	codigo_partida int(11) NOT NULL,
	fase int(3) unsigned NOT NULL,
	datahora datetime NOT NULL,
	pontos int(3) unsigned NOT NULL, 
	tempo int(6) unsigned NOT NULL, 
PRIMARY KEY (codigo_partida, fase),
CONSTRAINT partida_fase_partida_FK FOREIGN KEY (codigo_partida) REFERENCES partidas (codigo)
);

CREATE INDEX partida_usuario_uuid_IX ON partidas (codigo_usuario, uuid);

CREATE INDEX partida_finalizada_IX ON partidas (finalizado);

CREATE INDEX partida_fase_IX ON partida_fases (codigo_partida, fase);

