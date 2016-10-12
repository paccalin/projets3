DROP TABLE if exists client;

CREATE TABLE IF NOT EXISTS "client" (
  "client_id" serial,
  "client_nom" varchar(50) DEFAULT '',
  "client_prenom" varchar(30) DEFAULT '',
  "client_rue" varchar(100) DEFAULT '',
  "client_ville" varchar(30) DEFAULT '',
  "client_cp" varchar(6) DEFAULT '',
  "client_mail" varchar(100) DEFAULT '',
  "client_tel" varchar(12) DEFAULT '',
  CONSTRAINT pk_client_id PRIMARY KEY client_id
);