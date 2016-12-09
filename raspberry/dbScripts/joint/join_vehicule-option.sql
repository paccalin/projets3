DROP TABLE if exists join_vehicule_option;

CREATE TABLE IF NOT EXISTS "join_vehicule_option" (
  "join_id" serial,
  "vehicule_id" integer NOT NULL,
  "option_id" integer NOT NULL,
  CONSTRAINT pk_join_id PRIMARY KEY join_id
);