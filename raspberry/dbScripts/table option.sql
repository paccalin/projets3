DROP TABLE if exists option;

CREATE TABLE IF NOT EXISTS "option" (
  "option_id" serial,
  "option_libelle" varchar(30) DEFAULT '',
  "option_desc" varchar(255) DEFAULT '',
  "option_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_option_id PRIMARY KEY option_id
);