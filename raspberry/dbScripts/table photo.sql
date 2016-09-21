DROP TABLE photo;

CREATE TABLE IF NOT EXISTS "photo" (
  "photo_id" serial PRIMARY KEY,
  "photo_path" varchar(30) NOT NULL,
  "vehicule_id" integer NOT NULL,
  "photo_date_insertion" timestamp NOT NULL
);