/*=== Client ===*/

insert into client values(default,'Martin', 'Jean', '1, rue du centre', 'Annecy', '74000','jean.martin@gmail.com','0450672184', CURRENT_TIMESTAMP);
insert into client values(default,'Mac Kenell', 'Bob', 'Fort Mac Kenell', 'Kenelltown', '00466','bob.mackenell@mackenell.com','0102030405', CURRENT_TIMESTAMP);
insert into client values(default,'Dupont', 'Gérard', '205, rue de du centre', 'Annecy-le-vieux', '74940','dupont.gerard@gmail.com','0450672154', CURRENT_TIMESTAMP);
insert into client values(default,'Dupuis', 'Marie', '4, avenue du stade', 'Bonneville', '74130','marie.dupuis@gmail.com','0450316428', CURRENT_TIMESTAMP);
insert into client values(default,'Haim', 'Julie', '16, rue du lac', 'Anency', '74000','julie.haim@hotmail.fr','0654813725', CURRENT_TIMESTAMP);
insert into client values(default,'Damas', 'Luc', '208, avenue de la gare', 'Annecy', '74000','luc.damas@univ-savoie.fr','0631572861', CURRENT_TIMESTAMP);
insert into client values(default,'Ochom', 'Paul', '12, place Saint Jean-Michel', 'Paris', '75000','paul.ochom@hotmail.fr','0624585197', CURRENT_TIMESTAMP);
insert into client values(default,'Martin', 'Anne', '1, rue du centre', 'Annecy', '74000','anne.martin@gmail.com','0654813728', CURRENT_TIMESTAMP);
insert into client values(default,'Aiphant', 'Michel', '17, place de l\'hotel de ville', 'Ayze', '74130','michel.aiphant@hotmail.fr','TEL', CURRENT_TIMESTAMP);
insert into client values(default,'Labrausse', 'Adam', '7, place du centre', 'Annecy', '74000','adam.labrausse@gmail.com','0651876528', CURRENT_TIMESTAMP);

/*=== Constructeur ===*/

insert into constructeur values(default,'Mercedes', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Renault', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Nissan', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Citroën', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Ford', CURRENT_TIMESTAMP);

/*=== Devis ===*/



/*=== Modele ===*/

insert into modele values(default,'Sprinter', (select id from constructeur where libelle='Mercedes'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Master', (select id from constructeur where libelle='Renault'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Movano', (select id from constructeur where libelle='Nissan'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Jumper', (select id from constructeur where libelle='Citroën'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Transit', (select id from constructeur where libelle='Ford'), CURRENT_TIMESTAMP);

/*=== Options ===*/

insert into options values(default, 'couleur', 'changement de la couleur du camion', CURRENT_TIMESTAMP);
insert into options values(default, 'passager', 'ajout de siege afin de transporter des passagers', CURRENT_TIMESTAMP);
insert into options values(default, 'benne', 'trasformation de l arriëre du camion afin d y ajouter une benne', CURRENT_TIMESTAMP);
insert into options values(default, 'luxe', 'modification afin d apporter du luxe au vehicule', CURRENT_TIMESTAMP);
insert into options values(default, 'rally', 'modification afin de créer un véritable véhicule de rally', CURRENT_TIMESTAMP);
insert into options values(default, 'sport', 'changement du moteur et ajout de bande sportive', CURRENT_TIMESTAMP);

/*=== Vehicule ===*/

insert into vehicule values (default, (select id from modele where libelle='Sprinter'), (select id from client where nom='Martin' and prenom='Jean'), 'AA001ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Sprinter'), (select id from client where nom='Mac Kenell' and prenom='Bob'), 'AA002ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Sprinter'), (select id from client where nom='Dupont' and prenom='Gérard'), 'AA003ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Master'), (select id from client where nom='Martin' and prenom='Jean'), 'AA004ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Master'), (select id from client where nom='Dupuis' and prenom='Marie'), 'AA005ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Movano'), (select id from client where nom='Haim' and prenom='Julie'), 'AA006ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Jumper'), (select id from client where nom='Martin' and prenom='Jean'), 'AA007ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Jumper'), (select id from client where nom='Martin' and prenom='Jean'), 'AA008ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Transit'), (select id from client where nom='Martin' and prenom='Jean'), 'AA009ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Transit'), (select id from client where nom='Martin' and prenom='Jean'), 'AA010ZZ',CURRENT_TIMESTAMP);

/*=== Photo ===*/

insert into photo values (default, 'pictures/sprinter_1.jpg', 1, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/sprinter_2.jpg', 2, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/sprinter_3.jpg', 3, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/master_1-1.jpg', 4, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/master_1-2.jpg', 4, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/master_2.jpg', 5, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/movano_1.jpg', 6, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/jumper_1.png', 7, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/jumper_2.jpg', 8, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/transit_1.jpg', 9, CURRENT_TIMESTAMP);
insert into photo values (default, 'pictures/transit_2.jpg', 10, CURRENT_TIMESTAMP);

/*=== Rendezvous ===*/



/*=== Utilisateur ===*/

insert into utilisateur values (default, 'root', 'root', 3, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'superadmin', '123', 3, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'admin', '123', 2, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'admin1', '123', 2, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'admin2', '123', 2, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'commercial', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'commercial1', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'commercial2', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'commercial3', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'commercial4', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values (default, 'commercial5', '123', 1, CURRENT_TIMESTAMP);

/*=== JoinVehiculeOption ===*/

insert into join_vehicule_option values (default, 1, (select id from options where libelle='luxe'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 2, (select id from options where libelle='rally'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 3, (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 4, (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 4, (select id from options where libelle='passager'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 5, (select id from options where libelle='benne'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 6, (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 7, (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 8, (select id from options where libelle='passager'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 9, (select id from options where libelle='luxe'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values (default, 10, (select id from options where libelle='sport'), CURRENT_TIMESTAMP);

/*=== JoinDevisOption ===*/

