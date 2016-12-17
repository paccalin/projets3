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

insert into constructeur values(default,'Mercedes', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Renault', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Nissan', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Citroën', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Ford', CURRENT_TIMESTAMP);

insert into modele values(default,'Sprinter', (select id from constructeur where libelle='Mercedes'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Master', (select id from constructeur where libelle='Renault'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Movano', (select id from constructeur where libelle='Nissan'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Jumper', (select id from constructeur where libelle='Citroën'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Transit', (select id from constructeur where libelle='Ford'), CURRENT_TIMESTAMP);

insert into vehicule values (default, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Master'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Master'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Movano'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Jumper'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Jumper'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Transit'), CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Transit'), CURRENT_TIMESTAMP);

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

insert into options values(default, 'couleur', 'changement de la couleur du camion', CURRENT_TIMESTAMP);
insert into options values(default, 'passager', 'ajout de siege afin de transporter des passagers', CURRENT_TIMESTAMP);
insert into options values(default, 'benne', 'trasformation de l arriëre du camion afin d y ajouter une benne', CURRENT_TIMESTAMP);
insert into options values(default, 'luxe', 'modification afin d apporter du luxe au vehicule', CURRENT_TIMESTAMP);
insert into options values(default, 'rally', 'modification afin de créer un véritable véhicule de rally', CURRENT_TIMESTAMP);
insert into options values(default, 'sport', 'changement du moteur et ajout de bande sportive', CURRENT_TIMESTAMP);

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
