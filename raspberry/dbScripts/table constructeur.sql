DROP TABLE if exists constructeur;

CREATE TABLE IF NOT EXISTS "constructeur" (
  "constructeur_id" serial,
  "constructeur_libelle" varchar(30) DEFAULT '',
  "constructeur_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_constructeur_id PRIMARY KEY constructeur_id
);