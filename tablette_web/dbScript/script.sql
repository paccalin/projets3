DROP TABLE IF EXISTS join_vehicule_option;
DROP TABLE IF EXISTS photo;
DROP TABLE IF EXISTS vehicule;
DROP TABLE IF EXISTS join_devis_option;
DROP TABLE IF EXISTS devis;
DROP TABLE IF EXISTS rdv;
DROP TABLE IF EXISTS modele;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS constructeur;
DROP TABLE IF EXISTS options;
DROP TABLE IF EXISTS client;

CREATE TABLE client (
  client_id int NOT NULL AUTO_INCREMENT,
  client_nom varchar(50) DEFAULT '',
  client_prenom varchar(30) DEFAULT '',
  client_rue varchar(100) DEFAULT '',
  client_ville varchar(30) DEFAULT '',
  client_cp varchar(6) DEFAULT '',
  client_mail varchar(100) DEFAULT '',
  client_tel varchar(12) DEFAULT '',
  client_date_insertion DATETIME,
  CONSTRAINT pk_client_id PRIMARY KEY (client_id)
);

CREATE TABLE constructeur (
  constructeur_id int NOT NULL AUTO_INCREMENT,
  constructeur_libelle varchar(30) DEFAULT '',
  constructeur_date_insertion DATETIME,
  CONSTRAINT pk_constructeur_id PRIMARY KEY (constructeur_id),
  CONSTRAINT uq_constructeur_libelle UNIQUE (constructeur_libelle)
);

CREATE TABLE devis (
  devis_id int NOT NULL AUTO_INCREMENT,
  client_id int NOT NULL,
  utilisateur_id integer NOT NULL,
  devis_path varchar(30) DEFAULT '',
  devis_actif boolean NOT NULL,
  modele_id int NOT NULL,
  devis_date_insertion DATETIME,
  CONSTRAINT pk_devis_id PRIMARY KEY (devis_id)
);

CREATE TABLE modele (
  modele_id int NOT NULL AUTO_INCREMENT,
  modele_libelle varchar(30) DEFAULT '',
  constructeur_id int NOT NULL,
  modele_date_insertion DATETIME,
  CONSTRAINT pk_modele_id PRIMARY KEY (modele_id)
);

CREATE TABLE options (
  option_id int NOT NULL AUTO_INCREMENT,
  option_libelle varchar(30) DEFAULT '',
  option_desc varchar(255) DEFAULT '',
  option_date_insertion DATETIME,
  CONSTRAINT pk_option_id PRIMARY KEY (option_id)
);

CREATE TABLE photo (
  photo_id int NOT NULL AUTO_INCREMENT,
  photo_path varchar(30) DEFAULT '',
  vehicule_id integer NOT NULL,
  photo_date_insertion DATETIME,
  CONSTRAINT pk_photo_id PRIMARY KEY (photo_id)
);


CREATE TABLE rdv (
  rdv_id int NOT NULL AUTO_INCREMENT,
  rdv_libelle varchar(30) DEFAULT '',
  utilisateur_id integer NOT NULL,
  client_id integer NOT NULL,
  rdv_date timestamp NOT NULL,
  rdv_duree time NOT NULL,
  rdv_date_insertion DATETIME,
  CONSTRAINT pk_rdv_id PRIMARY KEY (rdv_id)
);

CREATE TABLE utilisateur (
  utilisateur_id int NOT NULL AUTO_INCREMENT,
  utilisateur_pseudo varchar(255) DEFAULT '',
  utilisateur_motDePasse varchar(255) DEFAULT '',
  utilisateur_droits int NOT NULL,
  utilisateur_date_insertion DATETIME,
  CONSTRAINT pk_utilisateur_id PRIMARY KEY (utilisateur_id)
);

CREATE TABLE vehicule (
  vehicule_id int NOT NULL AUTO_INCREMENT,
  modele_id integer NOT NULL,
  vehicule_date_insertion DATETIME,
  CONSTRAINT pk_vehicule_id PRIMARY KEY (vehicule_id)
);

CREATE TABLE join_vehicule_option (
  join_id int NOT NULL AUTO_INCREMENT,
  vehicule_id integer NOT NULL,
  option_id integer NOT NULL,
  join_date_insertion DATETIME,
  CONSTRAINT pk_join_veh_opt_id PRIMARY KEY (join_id)
);

CREATE TABLE join_devis_option (
	join_id int NOT NULL AUTO_INCREMENT,
	option_id int NOT NULL,
	devis_id int NOT NULL,
  join_date_insertion DATETIME,
	CONSTRAINT pk_join_dev_opt_id PRIMARY KEY (join_id)
);


ALTER TABLE devis
ADD CONSTRAINT fk_devis_client_id FOREIGN KEY (client_id) REFERENCES client(client_id),
ADD CONSTRAINT fk_devis_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(utilisateur_id),
ADD CONSTRAINT fk_devis_modele_id FOREIGN KEY (modele_id) REFERENCES modele(modele_id);

ALTER TABLE modele
ADD CONSTRAINT fk_modele_constructeur_id FOREIGN KEY (constructeur_id) REFERENCES constructeur(constructeur_id);

ALTER TABLE photo
ADD CONSTRAINT fk_photo_vehicule_id FOREIGN KEY (vehicule_id) REFERENCES vehicule(vehicule_id);


ALTER TABLE rdv
ADD CONSTRAINT fk_rdv_client_id FOREIGN KEY (client_id) REFERENCES client(client_id),
ADD CONSTRAINT fk_rdv_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(utilisateur_id);

ALTER TABLE vehicule
ADD CONSTRAINT fk_vehicule_modele_id FOREIGN KEY (modele_id) REFERENCES modele(modele_id);

ALTER TABLE join_vehicule_option
ADD CONSTRAINT fk_join_veh_opt_vehicule_id FOREIGN KEY (vehicule_id) REFERENCES vehicule(vehicule_id),
ADD CONSTRAINT fk_join_dev_opt_option_id FOREIGN KEY  (option_id) REFERENCES options(option_id);

ALTER TABLE join_devis_option
ADD CONSTRAINT fk_join_dev_opt_dev_id FOREIGN KEY (devis_id) REFERENCES devis(devis_id),
ADD CONSTRAINT fk_join_dev_opt_opt_id FOREIGN KEY (option_id) REFERENCES options(option_id);