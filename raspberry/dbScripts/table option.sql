DROP TABLE option;
DROP SEQUENCE option_id_seq;

CREATE SEQUENCE option_id_seq;
CREATE TABLE IF NOT EXISTS "option" (
  "option_id" integer PRIMARY KEY default nextval('option_id_seq'),
  "option_nom" varchar(30) NOT NULL,
  "option_desc" varchar(255) NOT NULL,
  "option_date_insertion" timestamp NOT NULL
);
ALTER SEQUENCE option_id_seq OWNED BY option.option_id;