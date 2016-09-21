DROP TABLE constructeur;

CREATE TABLE IF NOT EXISTS "constructeur" (
  "constructeur_id" serial PRIMARY KEY,
  "constructeur_libelle" varchar(30) NOT NULL,
  "constructeur_date_insertion" timestamp NOT NULL
);