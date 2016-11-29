insert into constructeur(constructeur_libelle, constructeur_date_insertion) values('Mercedes','2016-09-27 00:00:01');
insert into constructeur(constructeur_libelle, constructeur_date_insertion) values('Renault','2016-09-27 00:00:01');
insert into constructeur(constructeur_libelle, constructeur_date_insertion) values('Nissan','2016-09-27 00:00:01');
insert into constructeur(constructeur_libelle, constructeur_date_insertion) values('Citroën','2016-09-27 00:00:01');
insert into constructeur(constructeur_libelle, constructeur_date_insertion) values('Ford','2016-09-27 00:00:01');

insert into modele(modele_libelle, constructeur_id, modele_date_insertion) values('Sprinter', (select constructeur_id from constructeur where constructeur_libelle='Mercedes'), '2016-09-27 00:00:00');
insert into modele(modele_libelle, constructeur_id, modele_date_insertion) values('Master', (select constructeur_id from constructeur where constructeur_libelle='Renault'), '2016-09-27 00:00:00');
insert into modele(modele_libelle, constructeur_id, modele_date_insertion) values('Movano', (select constructeur_id from constructeur where constructeur_libelle='Nissan'), '2016-09-27 00:00:00');
insert into modele(modele_libelle, constructeur_id, modele_date_insertion) values('Jumper', (select constructeur_id from constructeur where constructeur_libelle='Citroën'), '2016-09-27 00:00:00');
insert into modele(modele_libelle, constructeur_id, modele_date_insertion) values('Transit', (select constructeur_id from constructeur where constructeur_libelle='Ford'), '2016-09-27 00:00:00');

insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Sprinter'), '2016-09-27 00:00:01');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Sprinter'), '2016-09-27 00:00:02');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Sprinter'), '2016-09-27 00:00:03');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Master'), '2016-09-27 00:00:04');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Master'), '2016-09-27 00:00:05');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Movano'), '2016-09-27 00:00:06');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Jumper'), '2016-09-27 00:00:07');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Jumper'), '2016-09-27 00:00:08');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Transit'), '2016-09-27 00:00:09');
insert into vehicule(modele_id, vehicule_date_insertion) values ((select modele_id from modele where modele_libelle='Transit'), '2016-09-27 00:00:10');

insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/sprinter_1.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:01'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/sprinter_2.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:02'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/sprinter_3.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:03'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/master_1-1.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:04'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/master_1-2.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:04'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/master_2.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:05'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/movano_1.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:06'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/jumper_1.png', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:07'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/jumper_2.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:08'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/transit_1.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:09'), '2016-09-27 00:00:11');
insert into photo(photo_path, vehicule_id, photo_date_insertion) values ('pictures/transit_2.jpg', (select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:10'), '2016-09-27 00:00:11');

insert into options(option_libelle, option_desc, option_date_insertion) values('couleur', 'changement de la couleur du camion', '2016-09-27 00:00:20');
insert into options(option_libelle, option_desc, option_date_insertion) values('passager', 'ajout de siege afin de transporter des passagers', '2016-09-27 00:00:20');
insert into options(option_libelle, option_desc, option_date_insertion) values('benne', 'trasformation de l arriëre du camion afin d y ajouter une benne', '2016-09-27 00:00:20');
insert into options(option_libelle, option_desc, option_date_insertion) values('luxe', 'modification afin d apporter du luxe au vehicule', '2016-09-27 00:00:20');
insert into options(option_libelle, option_desc, option_date_insertion) values('rally', 'modification afin de créer un véritable véhicule de rally', '2016-09-27 00:00:20');
insert into options(option_libelle, option_desc, option_date_insertion) values('sport', 'changement du moteur et ajout de bande sportive', '2016-09-27 00:00:20');

insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:01'), (select option_id from options where option_libelle='luxe'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:02'), (select option_id from options where option_libelle='rally'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:03'), (select option_id from options where option_libelle='couleur'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:04'), (select option_id from options where option_libelle='couleur'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:04'), (select option_id from options where option_libelle='passager'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:05'), (select option_id from options where option_libelle='benne'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:06'), (select option_id from options where option_libelle='couleur'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:07'), (select option_id from options where option_libelle='couleur'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:08'), (select option_id from options where option_libelle='passager'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:09'), (select option_id from options where option_libelle='luxe'));
insert into join_vehicule_option(vehicule_id, option_id) values ((select vehicule_id from vehicule where vehicule_date_insertion = '2016-09-27 00:00:10'), (select option_id from options where option_libelle='sport'));
