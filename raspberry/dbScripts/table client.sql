DROP TABLE client;

CREATE TABLE IF NOT EXISTS "client" (
  "client_id" serial PRIMARY KEY,
  "client_nom" varchar(50) NOT NULL,
  "client_prenom" varchar(30) NOT NULL,
  "client_rue" varchar(100),
  "client_ville" varchar(30),
  "client_cp" varchar(6),
  "client_mail" varchar(100),
  "client_tel" varchar(12)
);