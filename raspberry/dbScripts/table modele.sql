DROP TABLE if exists modele;

CREATE TABLE IF NOT EXISTS "modele" (
  "modele_id" serial,
  "modele_libelle" varchar(30) DEFAULT '',
  "constructeur_id" integer NOT NULL,
  "modele_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_modele_id PRIMARY KEY modele_id
);