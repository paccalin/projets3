DROP TABLE modele;
DROP SEQUENCE modele_id_seq;

CREATE SEQUENCE modele_id_seq;
CREATE TABLE IF NOT EXISTS "modele" (
  "modele_id" integer PRIMARY KEY default nextval('modele_id_seq'),
  "modele_libelle" varchar(30) NOT NULL,
  "constructeur_id" integer NOT NULL,
  "modele_date_insertion" timestamp NOT NULL
);
ALTER SEQUENCE modele_id_seq OWNED BY modele.modele_id;