DROP TABLE vehicule;
DROP SEQUENCE vehicule_id_seq;

CREATE SEQUENCE vehicule_id_seq;
CREATE TABLE IF NOT EXISTS "vehicule" (
  "vehicule_id" integer PRIMARY KEY default nextval('vehicule_id_seq'),
  "modele_id" integer NOT NULL,
  "vehicule_date_insertion" timestamp NOT NULL
);
ALTER SEQUENCE vehicule_id_seq OWNED BY vehicule.vehicule_id;