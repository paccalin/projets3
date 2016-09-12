DROP TABLE constructeur;
DROP SEQUENCE constructeur_id_seq;

CREATE SEQUENCE constructeur_id_seq;
CREATE TABLE IF NOT EXISTS "constructeur" (
  "constructeur_id" integer PRIMARY KEY default nextval('constructeur_id_seq'),
  "constructeur_libelle" varchar(30) NOT NULL,
  "constructeur_date_insertion" timestamp NOT NULL
);
ALTER SEQUENCE constructeur_id_seq OWNED BY constructeur.constructeur_id;