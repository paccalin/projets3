DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS devis;
DROP TABLE IF EXISTS constructeur;
DROP TABLE IF EXISTS modele;
DROP TABLE IF EXISTS options;
DROP TABLE IF EXISTS photo;
DROP TABLE IF EXISTS rdv;
DROP TABLE IF EXISTS vehicule;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS join_vehicule_option;

CREATE TABLE client (
  client_id int NOT NULL AUTO_INCREMENT,
  client_nom varchar(50) DEFAULT '',
  client_prenom varchar(30) DEFAULT '',
  client_rue varchar(100) DEFAULT '',
  client_ville varchar(30) DEFAULT '',
  client_cp varchar(6) DEFAULT '',
  client_mail varchar(100) DEFAULT '',
  client_tel varchar(12) DEFAULT '',
  CONSTRAINT pk_client_id PRIMARY KEY (client_id)
);

CREATE TABLE constructeur (
  constructeur_id int NOT NULL AUTO_INCREMENT,
  constructeur_libelle varchar(30) DEFAULT '',
  constructeur_date_insertion timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_constructeur_id PRIMARY KEY (constructeur_id),
  CONSTRAINT uq_constructeur_id UNIQUE (constructeur_id),
  CONSTRAINT uq_constructeur_libelle UNIQUE (constructeur_libelle)
);

CREATE TABLE devis (
  devis_id int NOT NULL AUTO_INCREMENT,
  client_id integer NOT NULL,
  utilisateur_id integer NOT NULL,
  devis_path varchar(30) DEFAULT '',
  devis_actif boolean NOT NULL,
  CONSTRAINT pk_devis_id PRIMARY KEY (devis_id),
  CONSTRAINT uq_devis_id UNIQUE (devis_id)
);

CREATE TABLE modele (
  modele_id int NOT NULL AUTO_INCREMENT,
  modele_libelle varchar(30) DEFAULT '',
  constructeur_id integer NOT NULL,
  modele_date_insertion timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_modele_id PRIMARY KEY (modele_id),
  CONSTRAINT uq_modele_id UNIQUE (modele_id)
);

CREATE TABLE options (
  option_id int NOT NULL AUTO_INCREMENT,
  option_libelle varchar(30) DEFAULT '',
  option_desc varchar(255) DEFAULT '',
  option_date_insertion timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_option_id PRIMARY KEY (option_id),
  CONSTRAINT uq_option_id UNIQUE (option_id)
);

CREATE TABLE photo (
  photo_id int NOT NULL AUTO_INCREMENT,
  photo_path varchar(30) DEFAULT '',
  vehicule_id integer NOT NULL,
  photo_date_insertion timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_photo_id PRIMARY KEY (photo_id),
  CONSTRAINT uq_photo_id UNIQUE (photo_id)
);


CREATE TABLE rdv (
  rdv_id int NOT NULL AUTO_INCREMENT,
  rdv_libelle varchar(30) DEFAULT '',
  utilisateur_id integer NOT NULL,
  client_id integer NOT NULL,
  rdv_date timestamp NOT NULL,
  rdv_duree time NOT NULL,
  CONSTRAINT pk_rdv_id PRIMARY KEY (rdv_id),
  CONSTRAINT uq_rdv_id UNIQUE (rdv_id)
);

CREATE TABLE utilisateur (
  utilisateur_id int NOT NULL AUTO_INCREMENT,
  utilisateur_pseudo varchar(255) DEFAULT '',
  utilisateur_motDePasse varchar(255) DEFAULT '',
  utilisateur_droits int NOT NULL,
  CONSTRAINT pk_utilisateur_id PRIMARY KEY (utilisateur_id),
  CONSTRAINT uq_utilisateur_id UNIQUE (utilisateur_id)
);

CREATE TABLE vehicule (
  vehicule_id int NOT NULL AUTO_INCREMENT,
  modele_id integer NOT NULL,
  vehicule_date_insertion timestamp DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_vehicule_id PRIMARY KEY (vehicule_id),
  CONSTRAINT uq_vehicule_id UNIQUE (vehicule_id)
);

CREATE TABLE join_vehicule_option (
  join_id int NOT NULL AUTO_INCREMENT,
  vehicule_id integer NOT NULL,
  option_id integer NOT NULL,
  CONSTRAINT pk_join_id PRIMARY KEY (join_id),
  CONSTRAINT uq_join_id UNIQUE (join_id)
);