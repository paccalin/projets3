DROP TABLE IF EXISTS vehicule;

CREATE TABLE IF NOT EXISTS "vehicule" (
  "vehicule_id" serial,
  "modele_id" integer NOT NULL,
  "vehicule_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_vehicule_id PRIMARY KEY vehicule_id
);