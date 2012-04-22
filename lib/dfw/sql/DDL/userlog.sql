
CREATE TABLE userlog
(
  id_log serial PRIMARY KEY,
  id_usuario int NOT NULL,
  ip character varying(15),
  mensagem character varying(30),
  sql varchar(200),
  data_hora timestamp without time zone
);
ALTER TABLE userlog ADD CONSTRAINT fk_userlog__id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);

