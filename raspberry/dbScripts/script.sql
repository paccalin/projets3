DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS devis;
DROP TABLE IF EXISTS constructeur;
DROP TABLE IF EXISTS modele;
DROP TABLE IF EXISTS option;
DROP TABLE IF EXISTS photo;
DROP TABLE IF EXISTS rdv;
DROP TABLE IF EXISTS vehicule;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS join_vehicule_option;

CREATE TABLE IF NOT EXISTS "client" (
  "client_id" serial,
  "client_nom" varchar(50) DEFAULT '',
  "client_prenom" varchar(30) DEFAULT '',
  "client_rue" varchar(100) DEFAULT '',
  "client_ville" varchar(30) DEFAULT '',
  "client_cp" varchar(6) DEFAULT '',
  "client_mail" varchar(100) DEFAULT '',
  "client_tel" varchar(12) DEFAULT '',
  CONSTRAINT pk_client_id PRIMARY KEY (client_id)
);

CREATE TABLE IF NOT EXISTS "constructeur" (
  "constructeur_id" serial,
  "constructeur_libelle" varchar(30) DEFAULT '',
  "constructeur_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_constructeur_id PRIMARY KEY (constructeur_id)
);

CREATE TABLE IF NOT EXISTS "devis" (
  "devis_id" serial,
  "client_id" integer NOT NULL,
  "utilisateur_id" integer NOT NULL,
  "devis_path" varchar(30) DEFAULT '',
  "devis_actif" boolean NOT NULL,
  CONSTRAINT pk_devis_id PRIMARY KEY (devis_id)
);

CREATE TABLE IF NOT EXISTS "modele" (
  "modele_id" serial,
  "modele_libelle" varchar(30) DEFAULT '',
  "constructeur_id" integer NOT NULL,
  "modele_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_modele_id PRIMARY KEY (modele_id)
);

CREATE TABLE IF NOT EXISTS "option" (
  "option_id" serial,
  "option_libelle" varchar(30) DEFAULT '',
  "option_desc" varchar(255) DEFAULT '',
  "option_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_option_id PRIMARY KEY (option_id)
);

CREATE TABLE IF NOT EXISTS "photo" (
  "photo_id" serial,
  "photo_path" varchar(30) DEFAULT '',
  "vehicule_id" integer NOT NULL,
  "photo_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_photo_id PRIMARY KEY (photo_id)
);


CREATE TABLE IF NOT EXISTS "rdv" (
  "rdv_id" serial,
  "rdv_libelle" varchar(30) DEFAULT '',
  "utilisateur_id" integer NOT NULL,
  "client_id" integer NOT NULL,
  "rdv_date" timestamp NOT NULL,
  "rdv_duree" time NOT NULL,
  CONSTRAINT pk_rdv_id PRIMARY KEY (rdv_id)
);

CREATE TABLE IF NOT EXISTS "utilisateur" (
  "utilisateur_id" serial,
  "utilisateur_pseudo" varchar(255) DEFAULT '',
  "utilisateur_motDePasse" varchar(255) DEFAULT '',
  "utilisateur_droits" int NOT NULL,
  CONSTRAINT pk_utilisateur_id PRIMARY KEY (utilisateur_id)
);

CREATE TABLE IF NOT EXISTS "vehicule" (
  "vehicule_id" serial,
  "modele_id" integer NOT NULL,
  "vehicule_date_insertion" timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_vehicule_id PRIMARY KEY (vehicule_id)
);

CREATE TABLE IF NOT EXISTS "join_vehicule_option" (
  "join_id" serial,
  "vehicule_id" integer NOT NULL,
  "option_id" integer NOT NULL,
  CONSTRAINT pk_join_id PRIMARY KEY (join_id)
);