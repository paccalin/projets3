DROP TABLE join_vehicule_option;

CREATE TABLE IF NOT EXISTS "join_vehicule_option" (
  "join_id" serial PRIMARY KEY,
  "vehicule_id" integer NOT NULL,
  "option_id" integer NOT NULL
);