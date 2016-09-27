DROP TABLE join_vehicule_image;

CREATE TABLE IF NOT EXISTS "join_vehicule_image" (
  "join_id" serial PRIMARY KEY,
  "vehicule_id" integer NOT NULL,
  "image_id" integer NOT NULL
);