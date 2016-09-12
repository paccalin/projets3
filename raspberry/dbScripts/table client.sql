DROP TABLE client;
DROP SEQUENCE client_id_seq;

CREATE SEQUENCE client_id_seq;
CREATE TABLE IF NOT EXISTS "client" (
  "client_id" integer PRIMARY KEY default nextval('client_id_seq'),
  "client_nom" varchar(30) NOT NULL,
  "client_prenom" varchar(30) NOT NULL,
  "client_rue" varchar(30),
  "client_ville" varchar(30),
  "client_cp" varchar(30),
  "client_mail" varchar(30),
  "client_tel" varchar(30)
);
ALTER SEQUENCE client_id_seq OWNED BY client.client_id;