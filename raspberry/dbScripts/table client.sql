DROP TABLE client;

CREATE TABLE IF NOT EXISTS "client" (
  "client_id" serial PRIMARY KEY,
  "client_nom" varchar(30) NOT NULL,
  "client_prenom" varchar(30) NOT NULL,
  "client_rue" varchar(30),
  "client_ville" varchar(30),
  "client_cp" varchar(30),
  "client_mail" varchar(30),
  "client_tel" varchar(30)
);