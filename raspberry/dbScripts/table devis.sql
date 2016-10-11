DROP TABLE if exists devis;

CREATE TABLE IF NOT EXISTS "devis" (
  "devis_id" serial,
  "client_id" integer DEFAULT '',
  "utilisateur_id" integer DEFAULT '',
  "devis_path" varchar(30) DEFAULT '',
  "devis_actif" boolean NOT NULL,
  CONSTRAINT pk_devis_id PRIMARY KEY devis_id
);
