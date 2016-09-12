DROP TABLE rdv;
DROP SEQUENCE rdv_id_seq;

CREATE SEQUENCE rdv_id_seq;
CREATE TABLE IF NOT EXISTS "rdv" (
  "rdv_id" integer PRIMARY KEY default nextval('rdv_id_seq'),
  "rdv_libelle" varchar(30) NOT NULL,
  "utilisateur_id" integer NOT NULL,
  "client_id" integer NOT NULL,
  "rdv_date" timestamp NOT NULL,
  "rdv_duree" time NOT NULL
);
ALTER SEQUENCE rdv_id_seq OWNED BY rdv.rdv_id;
