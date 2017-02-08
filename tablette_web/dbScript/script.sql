DROP TABLE IF EXISTS join_modele_option;
DROP TABLE IF EXISTS join_vehicule_option;
DROP TABLE IF EXISTS photo;
DROP TABLE IF EXISTS vehicule;
DROP TABLE IF EXISTS join_devis_option;
DROP TABLE IF EXISTS join_panier_option;
DROP TABLE IF EXISTS devis;
DROP TABLE IF EXISTS panier;
DROP TABLE IF EXISTS rendezvous;
DROP TABLE IF EXISTS modele;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS constructeur;
DROP TABLE IF EXISTS options;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS socket;

CREATE TABLE socket (
	id varchar(20),
	destinataire varchar(10) DEFAULT '',
	action varchar(10) DEFAULT '',
	tableDb varchar(30) DEFAULT '',
	json varchar(150) DEFAULT '',
	date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pk_socket_id PRIMARY KEY (id)
);

CREATE TABLE client (
  id varchar(20),
  nom varchar(50) DEFAULT '',
  prenom varchar(30) DEFAULT '',
  rue varchar(100) DEFAULT '',
  ville varchar(30) DEFAULT '',
  cp varchar(6) DEFAULT '',
  mail varchar(100) DEFAULT '',
  tel varchar(12) DEFAULT '',
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_client_id PRIMARY KEY (id)
);

CREATE TABLE constructeur (
  id varchar(20),
  libelle varchar(30) DEFAULT '',
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_constructeur_id PRIMARY KEY (id),
  CONSTRAINT uq_constructeur_libelle UNIQUE (libelle)
);

CREATE TABLE devis (
  id varchar(20),
  client_id varchar(20),
  utilisateur_id varchar(20),
  path varchar(30) DEFAULT '',
  actif boolean NOT NULL,
  modele_id varchar(20),
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_devis_id PRIMARY KEY (id)
);

CREATE TABLE panier (
  id varchar(20),
  client_id varchar(20),
  utilisateur_id varchar(20),
  path varchar(30) DEFAULT '',
  actif boolean NOT NULL,
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_devis_id PRIMARY KEY (id)
);

CREATE TABLE modele (
  id varchar(20),
  libelle varchar(30) DEFAULT '',
  constructeur_id varchar(20),
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_modele_id PRIMARY KEY (id)
);

CREATE TABLE options (
  id varchar(20),
  libelle varchar(30) DEFAULT '',
  description varchar(255) DEFAULT '',
  prixDeBase float NOT NULL,
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_option_id PRIMARY KEY (id)
);

CREATE TABLE photo (
  id varchar(20),
  path varchar(30) DEFAULT '',
  vehicule_id varchar(20),
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_photo_id PRIMARY KEY (id)
);


CREATE TABLE rendezvous (
  id varchar(20),
  libelle varchar(30) DEFAULT '',
  utilisateur_id varchar(20),
  client_id varchar(20),
  date DATETIME NOT NULL,
  duree time NOT NULL,
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_rendezvous_id PRIMARY KEY (id)
);

CREATE TABLE utilisateur (
  id varchar(20),
  pseudo varchar(255) DEFAULT '',
  motDePasse varchar(255) DEFAULT '',
  droits int NOT NULL,
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_utilisateur_id PRIMARY KEY (id)
);

CREATE TABLE vehicule (
  id varchar(20),
  modele_id varchar(20),
  client_id varchar(20),
  immatriculation varchar(7) NOT NULL,
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_vehicule_id PRIMARY KEY (id)
);

CREATE TABLE join_vehicule_option (
  id varchar(20),
  vehicule_id varchar(20),
  option_id varchar(20),
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_join_veh_opt_id PRIMARY KEY (id)
);

CREATE TABLE join_devis_option (
	id varchar(20),
	option_id varchar(20),
	devis_id varchar(20),
	date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pk_join_dev_opt_id PRIMARY KEY (id)
);

CREATE TABLE join_panier_option (
	id varchar(20),
	option_id varchar(20) NOT NULL,
	panier_id varchar(20) NOT NULL,
	nombre integer NOT NULL,
	date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pk_join_pan_opt_id PRIMARY KEY (id)
);

CREATE TABLE join_modele_option (
	id varchar(20),
	option_id varchar(20),
	modele_id varchar(20),
	prix float NOT NULL,
	date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pk_join_dev_opt_id PRIMARY KEY (id)
);

ALTER TABLE devis
ADD CONSTRAINT fk_devis_client_id FOREIGN KEY (client_id) REFERENCES client(id),
ADD CONSTRAINT fk_devis_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id),
ADD CONSTRAINT fk_devis_modele_id FOREIGN KEY (modele_id) REFERENCES modele(id);

ALTER TABLE modele
ADD CONSTRAINT fk_modele_constructeur_id FOREIGN KEY (constructeur_id) REFERENCES constructeur(id);

ALTER TABLE photo
ADD CONSTRAINT fk_photo_vehicule_id FOREIGN KEY (vehicule_id) REFERENCES vehicule(id);

ALTER TABLE rendezvous
ADD CONSTRAINT fk_rendezvous_client_id FOREIGN KEY (client_id) REFERENCES client(id),
ADD CONSTRAINT fk_rendezvous_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id);

ALTER TABLE panier
ADD CONSTRAINT fk_panier_client_id FOREIGN KEY (client_id) REFERENCES client(id),
ADD CONSTRAINT fk_panier_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id);

ALTER TABLE vehicule
ADD CONSTRAINT fk_vehicule_modele_id FOREIGN KEY (modele_id) REFERENCES modele(id),
ADD CONSTRAINT fk_vehicule_client_id FOREIGN KEY (client_id) REFERENCES client(id);

ALTER TABLE join_vehicule_option
ADD CONSTRAINT fk_join_veh_opt_vehicule_id FOREIGN KEY (vehicule_id) REFERENCES vehicule(id),
ADD CONSTRAINT fk_join_veh_opt_option_id FOREIGN KEY  (option_id) REFERENCES options(id);

ALTER TABLE join_devis_option
ADD CONSTRAINT fk_join_dev_opt_dev_id FOREIGN KEY (devis_id) REFERENCES devis(id),
ADD CONSTRAINT fk_join_dev_opt_opt_id FOREIGN KEY (option_id) REFERENCES options(id);

ALTER TABLE join_panier_option
ADD CONSTRAINT fk_join_pan_opt_pan_id FOREIGN KEY (panier_id) REFERENCES panier(id),
ADD CONSTRAINT fk_join_pan_opt_opt_id FOREIGN KEY (option_id) REFERENCES options(id);

ALTER TABLE join_modele_option
ADD CONSTRAINT fk_join_mod_opt_modele_id FOREIGN KEY (modele_id) REFERENCES modele(id),
ADD CONSTRAINT fk_join_mod_opt_option_id FOREIGN KEY  (option_id) REFERENCES options(id);
