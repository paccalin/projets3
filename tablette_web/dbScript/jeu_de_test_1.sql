/*=== Socket ===*/
/*
insert into socket values(default,'centrale','insert','client','{"id":"14","nom":"Test","prenom":"Jean","rue":"1, rue du test","ville":"Testville","cp":"12345","mail":"jean.test@mail.com","tel":"0450123456"}',CURRENT_TIMESTAMP);
insert into socket values(default,'tablette','insert','client','{"id":"14","nom":"Test","prenom":"Jean-Socket","rue":"1, rue du test","ville":"Testville","cp":"12345","mail":"jean.test@mail.com","tel":"0450123456"}',CURRENT_TIMESTAMP);
insert into socket values(default,'tablette','insert','option','{"id":"10","libelle":"Option socket","desc":"Option générée par socket","prixDeBase":"150000","dateInsertion":"20/01/2017 11:00:13 pm"}',CURRENT_TIMESTAMP);
insert into socket values(default,'tablette','insert','constructeur','{"id":"6","libelle":"Constructsocket","dateInsertion":"20/01/2017 11:00:13 pm"}',CURRENT_TIMESTAMP);
insert into socket values(default,'tablette','insert','modele','{"id":"13","libelle":"Modelesocket","constructeur":"6","dateInsertion":"20/01/2017 11:00:13 pm"}',CURRENT_TIMESTAMP);
insert into socket values(default,'tablette','insert','utilisateur','{"id":"12","pseudo":"jeansocket","motDePasse":"123","droits":"1","dateInsertion":"20/01/2017 11:19:26 pm"}',CURRENT_TIMESTAMP);
insert into socket values(default,'tablette','insert','devis','{"id":"10","client":"1","utilisateur":"1","path":"devis/devis10.pdf","actif":1,"modele":"13","dateInsertion":"20/01/2017 11:15:17 pm"}',CURRENT_TIMESTAMP);
*/
/*=== Client ===*/

insert into client values(default,'Martin', 'Jean', '1, rue du centre', 'Annecy', '74000','jean.martin@gmail.com','0450672184', CURRENT_TIMESTAMP);
insert into client values(default,'Guy', 'Matis', '14, chemin des Roses', 'Lyon', '69004','matis.guy@gmail.com','0450642784', CURRENT_TIMESTAMP);
insert into client values(default,'Dupont', 'Gérard', '205, rue de du centre', 'Annecy-le-vieux', '74940','dupont.gerard@gmail.com','0450672154', CURRENT_TIMESTAMP);
insert into client values(default,'Dupuis', 'Marie', '4, avenue du stade', 'Bonneville', '74130','marie.dupuis@gmail.com','0450316428', CURRENT_TIMESTAMP);
insert into client values(default,'Haim', 'Julie', '16, rue du lac', 'Anency', '74000','julie.haim@hotmail.fr','0654813725', CURRENT_TIMESTAMP);
insert into client values(default,'Temil', 'Clément', '208, avenue de la gare', 'Annecy', '74000','clement.temil@aol.fr','0631572861', CURRENT_TIMESTAMP);
insert into client values(default,'Fernadez', 'Paul', '12, place Saint Jean-Michel', 'Paris', '75000','paul.fernandez@hotmail.fr','0624585197', CURRENT_TIMESTAMP);
insert into client values(default,'Martin', 'Anne', '1, rue du centre', 'Annecy', '74000','anne.martin@gmail.com','0654813728', CURRENT_TIMESTAMP);
insert into client values(default,'Geut', 'Michel', '17, place de l\'hotel de ville', 'Ayze', '74130','michel.geut@hotmail.fr','0450510468', CURRENT_TIMESTAMP);
insert into client values(default,'Hidoy', 'Adam', '7, place du centre', 'Annecy', '74000','adam.hidoy@gmail.com','0651876528', CURRENT_TIMESTAMP);

/*=== Constructeur ===*/

insert into constructeur values(default,'Mercedes', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Renault', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Nissan', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Citroën', CURRENT_TIMESTAMP);
insert into constructeur values(default,'Ford', CURRENT_TIMESTAMP);

/*=== Modele ===*/
insert into modele values(default,'Citan', (select id from constructeur where libelle='Mercedes'), CURRENT_TIMESTAMP);
insert into modele values(default,'Sprinter', (select id from constructeur where libelle='Mercedes'), CURRENT_TIMESTAMP);
insert into modele values(default,'Vito', (select id from constructeur where libelle='Mercedes'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Kangoo ', (select id from constructeur where libelle='Renault'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Master', (select id from constructeur where libelle='Renault'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Trafic', (select id from constructeur where libelle='Renault'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Movano', (select id from constructeur where libelle='Nissan'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Berlingo', (select id from constructeur where libelle='Citroën'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Jumpy', (select id from constructeur where libelle='Citroën'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Jumper', (select id from constructeur where libelle='Citroën'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Transit', (select id from constructeur where libelle='Ford'), CURRENT_TIMESTAMP);
insert into modele values(default, 'Ranger', (select id from constructeur where libelle='Ford'), CURRENT_TIMESTAMP);

/*=== Options ===*/

insert into options values(default, 'couleur', 'changement de la couleur du camion', 3500, CURRENT_TIMESTAMP);
insert into options values(default, 'passager', 'ajout de siege afin de transporter des passagers', 1000,  CURRENT_TIMESTAMP);
insert into options values(default, 'benne', 'transformation de l\'arrière du camion afin d\'y ajouter une benne', 2000, CURRENT_TIMESTAMP);
insert into options values(default, 'rangements', 'transformation de l\'arrière du camion afin d\'y ajouter des rangements', 1500, CURRENT_TIMESTAMP);
insert into options values(default, 'luxe', 'modification afin d\'apporter du luxe au vehicule', 4000, CURRENT_TIMESTAMP);
insert into options values(default, 'rally', 'modification afin de créer un véritable véhicule de rally', 2500, CURRENT_TIMESTAMP);
insert into options values(default, 'sport', 'changement du moteur et ajout de bande sportive', 8000,  CURRENT_TIMESTAMP);
insert into options values(default, 'climatisation', 'ajout de la climatisation', 750, CURRENT_TIMESTAMP);

/*=== Vehicule ===*/

insert into vehicule values (default, (select id from modele where libelle='Sprinter'), (select id from client where nom='Martin' and prenom='Jean'), 'AA001ZZ',CURRENT_TIMESTAMP);
insert into vehicule values (default, (select id from modele where libelle='Sprinter'), (select id from client where nom='Guy' and prenom='Matis'), 'AA002ZZ',CURRENT_TIMESTAMP);
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

/*=== Utilisateur ===*/

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

/*=== Devis ===*/

insert into devis values(default, 1, (select id from utilisateur where pseudo='commercial'), 'devis/devis1.pdf', 1, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into devis values(default, 1, (select id from utilisateur where pseudo='commercial'), 'devis/devis2.pdf', 1, (select id from modele where libelle='Master'), CURRENT_TIMESTAMP);
insert into devis values(default, 2, (select id from utilisateur where pseudo='commercial1'), 'devis/devis3.pdf', 1, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into devis values(default, 2, (select id from utilisateur where pseudo='commercial1'), 'devis/devis4.pdf', 1, (select id from modele where libelle='Berlingo'), CURRENT_TIMESTAMP);
insert into devis values(default, 3, (select id from utilisateur where pseudo='commercial2'), 'devis/devis5.pdf', 1, (select id from modele where libelle='Vito'), CURRENT_TIMESTAMP);
insert into devis values(default, 4, (select id from utilisateur where pseudo='commercial2'), 'devis/devis6.pdf', 0, (select id from modele where libelle='Movano'), CURRENT_TIMESTAMP);
insert into devis values(default, 5, (select id from utilisateur where pseudo='commercial3'), 'devis/devis7.pdf', 0, (select id from modele where libelle='Kangoo'), CURRENT_TIMESTAMP);
insert into devis values(default, 6, (select id from utilisateur where pseudo='commercial4'), 'devis/devis8.pdf', 0, (select id from modele where libelle='Master'), CURRENT_TIMESTAMP);
insert into devis values(default, 7, (select id from utilisateur where pseudo='commercial5'), 'devis/devis9.pdf', 0, (select id from modele where libelle='Trafic'), CURRENT_TIMESTAMP);


/*=== Rendezvous ===*/

insert into rendezvous values(default,'contrôle qualité', (select id from utilisateur where pseudo='commercial'), 1, '2017-01-04', '01:00:00', CURRENT_TIMESTAMP);
insert into rendezvous values(default,'vente à domicile', (select id from utilisateur where pseudo='commercial'), 2, '2017-01-06', '00:30:00', CURRENT_TIMESTAMP);
insert into rendezvous values(default,'explication contrat', (select id from utilisateur where pseudo='commercial'), 3, '2017-01-07', '01:45:00', CURRENT_TIMESTAMP);

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
/*
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='climatisation'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='benne'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='sport'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rally'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 2, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='luxe'), 2, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='passager'), 2, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 3, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 3, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 4, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 3, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 5, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 5, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 6, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='climatisation'), 6, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 7, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 7, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 8, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='climatisation'), 8, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='couleur'), 9, CURRENT_TIMESTAMP);
insert into join_devis_option values (default, (select id from options where libelle='rangements'), 9, CURRENT_TIMESTAMP);
*/

/*=== JoinModeleOption ===*/
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Citan'), 3200, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Sprinter'), 3100, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Vito'), 3600, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Kangoo'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Master'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Trafic'), 2600, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Movano'), 2800, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Berlingo'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Jumpy'), 2700, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Jumper'), 2800, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Transit'), 2900, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='couleur'), (select id from modele where libelle='Ranger'), 2700, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Citan'), 1000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Sprinter'), 1100, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Vito'), 900, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Kangoo'), 800, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Master'), 900, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Trafic'), 1000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Movano'), 1000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Berlingo'), 1200, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Jumpy'), 900, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Jumper'), 1100, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Transit'), 1200, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='passager'), (select id from modele where libelle='Ranger'), 900, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Citan'), 1900, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Sprinter'), 2100, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Vito'), 1800, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Kangoo'), 1900, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Master'), 2100, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Trafic'), 2200, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Movano'), 2100, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Berlingo'), 2200, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Jumpy'), 2300, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Jumper'), 1800, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Transit'), 1800, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='benne'), (select id from modele where libelle='Ranger'), 1700, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Citan'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Sprinter'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Vito'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Kangoo'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Master'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Trafic'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Movano'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Berlingo'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Jumpy'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Jumper'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Transit'), 1500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rangements'), (select id from modele where libelle='Ranger'), 1500, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Citan'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Sprinter'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Vito'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Kangoo'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Master'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Trafic'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Movano'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Berlingo'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Jumpy'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Jumper'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Transit'), 4000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='luxe'), (select id from modele where libelle='Ranger'), 4000, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Citan'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Sprinter'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Vito'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Kangoo'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Master'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Trafic'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Movano'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Berlingo'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Jumpy'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Jumper'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Transit'), 2500, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='rally'), (select id from modele where libelle='Ranger'), 2500, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Citan'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Sprinter'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Vito'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Kangoo'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Master'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Trafic'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Movano'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Berlingo'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Jumpy'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Jumper'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Transit'), 8000, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='sport'), (select id from modele where libelle='Ranger'), 8000, CURRENT_TIMESTAMP);

insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Citan'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Sprinter'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Vito'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Kangoo'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Master'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Trafic'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Movano'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Berlingo'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Jumpy'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Jumper'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Transit'), 750, CURRENT_TIMESTAMP);
insert into join_modele_option values (default, (select id from options where libelle='climatisation'), (select id from modele where libelle='Ranger'), 750, CURRENT_TIMESTAMP);
