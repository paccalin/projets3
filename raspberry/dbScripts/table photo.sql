DROP TABLE if exists photo;

CREATE TABLE IF NOT EXISTS "photo" (
  "photo_id" serial,
  "photo_path" varchar(30) DEFAULT '',
  "vehicule_id" integer NOT NULL,
  "photo_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_photo_id PRIMARY KEY photo_id
);