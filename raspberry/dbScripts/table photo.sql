DROP TABLE photo;
DROP SEQUENCE photo_id_seq;

CREATE SEQUENCE photo_id_seq;
CREATE TABLE IF NOT EXISTS "photo" (
  "photo_id" integer PRIMARY KEY default nextval('photo_id_seq'),
  "photo_path" varchar(30) NOT NULL,
  "photo_date_insertion" timestamp NOT NULL
);
ALTER SEQUENCE photo_id_seq OWNED BY photo.photo_id;