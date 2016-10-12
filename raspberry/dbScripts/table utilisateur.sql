﻿DROP TABLE if exists utilisateur;

CREATE TABLE IF NOT EXISTS "utilisateur" (
  "utilisateur_id" serial,
  "utilisateur_pseudo" varchar(255) DEFAULT '',
  "utilisateur_motDePasse" varchar(255) DEFAULT '',
  "utilisateur_droits" int NOT NULL,
  CONSTRAINT pk_utilisateur_id PRIMARY KEY utilisateur_id
);