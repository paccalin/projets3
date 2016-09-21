DROP TABLE rdv;

CREATE TABLE IF NOT EXISTS "rdv" (
  "rdv_id" serial PRIMARY KEY,
  "rdv_libelle" varchar(30) NOT NULL,
  "utilisateur_id" integer NOT NULL,
  "client_id" integer NOT NULL,
  "rdv_date" timestamp NOT NULL,
  "rdv_duree" time NOT NULL
);
