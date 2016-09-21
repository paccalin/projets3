DROP TABLE modele;

CREATE TABLE IF NOT EXISTS "modele" (
  "modele_id" serial PRIMARY KEY,
  "modele_libelle" varchar(30) NOT NULL,
  "constructeur_id" integer NOT NULL,
  "modele_date_insertion" timestamp NOT NULL
);