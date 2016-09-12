DROP TABLE devis;
DROP SEQUENCE devis_id_seq;

CREATE SEQUENCE devis_id_seq;
CREATE TABLE IF NOT EXISTS "devis" (
  "devis_id" integer PRIMARY KEY default nextval('devis_id_seq'),
  "client_id" integer NOT NULL,
  "utilisateur_id" integer NOT NULL,
  "devis_path" varchar(30) NOT NULL,
  "devis_actif" boolean NOT NULL
);
ALTER SEQUENCE devis_id_seq OWNED BY devis.devis_id;
