DROP TABLE devis;

CREATE TABLE IF NOT EXISTS "devis" (
  "devis_id" serial PRIMARY KEY,
  "client_id" integer NOT NULL,
  "utilisateur_id" integer NOT NULL,
  "devis_path" varchar(30) NOT NULL,
  "devis_actif" boolean NOT NULL
);
