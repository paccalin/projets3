DROP TABLE vehicule;

CREATE TABLE IF NOT EXISTS "vehicule" (
  "vehicule_id" integer PRIMARY KEY,
  "modele_id" integer NOT NULL,
  "vehicule_date_insertion" timestamp NOT NULL
);