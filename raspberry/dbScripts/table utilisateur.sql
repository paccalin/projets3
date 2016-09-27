﻿DROP TABLE utilisateur;
CREATE TABLE IF NOT EXISTS "utilisateur" (
  "utilisateur_id" serial PRIMARY KEY,
  "utilisateur_pseudo" varchar(255) NOT NULL,
  "utilisateur_motDePasse" varchar(255) NOT NULL,
  "utilisateur_droits" int NOT NULL
);