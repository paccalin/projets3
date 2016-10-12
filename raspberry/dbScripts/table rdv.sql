DROP TABLE if exists rdv;

CREATE TABLE IF NOT EXISTS "rdv" (
  "rdv_id" serial,
  "rdv_libelle" varchar(30) DEFAULT '',
  "utilisateur_id" integer NOT NULL,
  "client_id" integer NOT NULL,
  "rdv_date" timestamp NOT NULL,
  "rdv_duree" time NOT NULL,
  CONSTRAINT pk_rdv_id PRIMARY KEY rev_id
);
