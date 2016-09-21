DROP TABLE option;

CREATE TABLE IF NOT EXISTS "option" (
  "option_id" serial PRIMARY KEY,
  "option_libelle" varchar(30) NOT NULL,
  "option_desc" varchar(255) NOT NULL,
  "option_date_insertion" timestamp NOT NULL
);