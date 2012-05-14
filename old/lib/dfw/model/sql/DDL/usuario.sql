-- Table: usuario

-- DROP TABLE usuario;

CREATE TABLE usuario
(
  id_usuario serial NOT NULL,
  nome character varying(70) NOT NULL,
  email character varying(100),
  "login" character varying(15),
  "password" character varying(64),
  status smallint,
  data_criacao timestamp without time zone,
  CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE usuario OWNER TO postgres;

