/*=== Socket ===*/
insert into socket values('zcyCvHpkNxoXINvet3Ec','centrale','insert','client','{"id":"CUIkCWpC8j7YF1VyRBTe","nom":"Test","prenom":"Jean","rue":"1, rue du test","ville":"Testville","cp":"12345","mail":"jean.test@mail.com","tel":"0450123456"}',CURRENT_TIMESTAMP);
insert into socket values('MnYRo0ChnNDvZE1SOfIW','tablette','insert','client','{"id":"xLaRk8irLaSBfAiGTYvD","nom":"Test","prenom":"Jean-Socket","rue":"1, rue du test","ville":"Testville","cp":"12345","mail":"jean.test@mail.com","tel":"0450123456"}',CURRENT_TIMESTAMP);
insert into socket values('Y1MmDpMXDmYKHMr1rAQ2','tablette','insert','option','{"id":"v8vzrjBLZGzHkOTfkacy","libelle":"Option socket","desc":"Option générée par socket","prixDeBase":"150000","dateInsertion":"20/01/2017 11:00:13 pm"}',CURRENT_TIMESTAMP);
insert into socket values('fFZtPRoQD26XMPeODR6K','tablette','insert','constructeur','{"id":"5eA0eB848IPGdIiU5TQf","libelle":"Constructsocket","dateInsertion":"20/01/2017 11:00:13 pm"}',CURRENT_TIMESTAMP);
insert into socket values('4a4v01eTxVPT1foqWlEg','tablette','insert','utilisateur','{"id":"akzFQsgx0N76V0uRYukG","pseudo":"jeansocket","motDePasse":"123","droits":"1","dateInsertion":"20/01/2017 11:19:26 pm"}',CURRENT_TIMESTAMP);

/*=== Client ===*/

insert into client values('E2t4Oaw1IadUzxCguDeN','Martin', 'Jean', '1, rue du centre', 'Annecy', '74000','jean.martin@gmail.com','0450672184', CURRENT_TIMESTAMP);
insert into client values('a59pn10VwKoRWByjrVGV','Guy', 'Matis', '14, chemin des Roses', 'Lyon', '69004','matis.guy@gmail.com','0450642784', CURRENT_TIMESTAMP);
insert into client values('tUnlUhOvZqPxStpxySjC','Dupont', 'Gérard', '205, rue de du centre', 'Annecy-le-vieux', '74940','dupont.gerard@gmail.com','0450672154', CURRENT_TIMESTAMP);
insert into client values('IJg8EN7uszWsZ0a7RSGA','Dupuis', 'Marie', '4, avenue du stade', 'Bonneville', '74130','marie.dupuis@gmail.com','0450316428', CURRENT_TIMESTAMP);
insert into client values('yr8t54drKojHd7w0XD5G','Haim', 'Julie', '16, rue du lac', 'Anency', '74000','julie.haim@hotmail.fr','0654813725', CURRENT_TIMESTAMP);
insert into client values('HJa0ISw3HthsfiEBUsmv','Temil', 'Clément', '208, avenue de la gare', 'Annecy', '74000','clement.temil@aol.fr','0631572861', CURRENT_TIMESTAMP);
insert into client values('CCcmuGHebDKosYmp9FKC','Fernadez', 'Paul', '12, place Saint Jean-Michel', 'Paris', '75000','paul.fernandez@hotmail.fr','0624585197', CURRENT_TIMESTAMP);
insert into client values('9dDXj8OXtH4elsvwEb3X','Martin', 'Anne', '1, rue du centre', 'Annecy', '74000','anne.martin@gmail.com','0654813728', CURRENT_TIMESTAMP);
insert into client values('ULeafRMMG6IUnKREQACm','Geut', 'Michel', '17, place de l\'hotel de ville', 'Ayze', '74130','michel.geut@hotmail.fr','0450510468', CURRENT_TIMESTAMP);
insert into client values('QSun4mt5W3pPIL3lP8PQ','Hidoy', 'Adam', '7, place du centre', 'Annecy', '74000','adam.hidoy@gmail.com','0651876528', CURRENT_TIMESTAMP);

/*=== Constructeur ===*/

insert into constructeur values('lKELz0AdvgE10Mz6gzWj','Mercedes', CURRENT_TIMESTAMP);
insert into constructeur values('PS7UeP8eoGQix8ssvDbd','Renault', CURRENT_TIMESTAMP);
insert into constructeur values('kAPKsUnbuggQr20I3SXz','Nissan', CURRENT_TIMESTAMP);
insert into constructeur values('vDkGtdWUatwjBKG8AsHl','Citroën', CURRENT_TIMESTAMP);
insert into constructeur values('mGxJWusEbbtcvQSSHNKg','Ford', CURRENT_TIMESTAMP);

/*=== TypeModele ===*/
insert into typeModele values('IEgNSVQVNfGrDhpV1BNp','A',CURRENT_TIMESTAMP);
insert into typeModele values('4203h1sl7kN2ODbj9bE3','B',CURRENT_TIMESTAMP);
insert into typeModele values('mDGqxTxGBMsgVt3d4gLl','C',CURRENT_TIMESTAMP);

/*=== Modele ===*/
insert into modele values('FLxZAs51Ao0Yn0LUZKrq','Citan', (select id from constructeur where libelle='Mercedes'), (select id from typemodele where libelle='A'), CURRENT_TIMESTAMP);
insert into modele values('N1VxLxYlVJwyNDRQUT5Q','Sprinter', (select id from constructeur where libelle='Mercedes'), (select id from typemodele where libelle='B'),CURRENT_TIMESTAMP);
insert into modele values('vD8OR79ro2450ZfUo57F','Vito', (select id from constructeur where libelle='Mercedes'), (select id from typemodele where libelle='C'),CURRENT_TIMESTAMP);
insert into modele values('89hFxeztDVCuEVtbQMLm', 'Kangoo ', (select id from constructeur where libelle='Renault'), (select id from typemodele where libelle='A'),CURRENT_TIMESTAMP);
insert into modele values('EqpgGsdEr7dxlebgMqms', 'Master', (select id from constructeur where libelle='Renault'), (select id from typemodele where libelle='B'),CURRENT_TIMESTAMP);
insert into modele values('RpAgqKaPlGjsRSh0Qml2', 'Trafic', (select id from constructeur where libelle='Renault'), (select id from typemodele where libelle='C'),CURRENT_TIMESTAMP);
insert into modele values('uyuejJ2PowY6oIAcridK', 'Movano', (select id from constructeur where libelle='Nissan'), (select id from typemodele where libelle='A'),CURRENT_TIMESTAMP);
insert into modele values('hgRa1p9MJ83P2wn5qENl', 'Berlingo', (select id from constructeur where libelle='Citroën'), (select id from typemodele where libelle='B'),CURRENT_TIMESTAMP);
insert into modele values('Hzr10kReQETEcfjRIwkA', 'Jumpy', (select id from constructeur where libelle='Citroën'), (select id from typemodele where libelle='C'),CURRENT_TIMESTAMP);
insert into modele values('FXqZgfCMWzAk2FYMlAW6', 'Jumper', (select id from constructeur where libelle='Citroën'), (select id from typemodele where libelle='A'),CURRENT_TIMESTAMP);
insert into modele values('A2dyt47t3UreNFkU4emF', 'Transit', (select id from constructeur where libelle='Ford'), (select id from typemodele where libelle='B'),CURRENT_TIMESTAMP);
insert into modele values('1Nskr4WTIf4s7TV6Fk1m', 'Ranger', (select id from constructeur where libelle='Ford'), (select id from typemodele where libelle='C'),CURRENT_TIMESTAMP);

/*=== Options ===*/

insert into options values('kMwG85Hao84G05ys7XAE', 'couleur', 'changement de la couleur du camion', 3500.0, CURRENT_TIMESTAMP);
insert into options values('BW9rYK9OINMR0zHzP53A', 'passager', 'ajout de siege afin de transporter des passagers', 1000.0,  CURRENT_TIMESTAMP);
insert into options values('iHwhkPwn7GVgxGWIRDh7', 'benne', 'transformation de l\'arrière du camion afin d\'y ajouter une benne', 2000.0, CURRENT_TIMESTAMP);
insert into options values('Q9WcxWmYGxxZwM4lLoNe', 'rangements', 'transformation de l\'arrière du camion afin d\'y ajouter des rangements', 1500.0, CURRENT_TIMESTAMP);
insert into options values('e30G6K10Rmr9rWexMoO2', 'luxe', 'modification afin d\'apporter du luxe au vehicule', 4000.0, CURRENT_TIMESTAMP);
insert into options values('PasYOtVWny0TflRP3oPb', 'rally', 'modification afin de créer un véritable véhicule de rally', 2500.0, CURRENT_TIMESTAMP);
insert into options values('3lYVG6Q4qdVlyHeihkJY', 'sport', 'changement du moteur et ajout de bande sportive', 8000.0,  CURRENT_TIMESTAMP);
insert into options values('O03WwjQkWlO8RpJJf0Q6', 'climatisation', 'ajout de la climatisation', 750.0, CURRENT_TIMESTAMP);

/*=== Vehicule ===*/

insert into vehicule values ('9HWMJP3zAl330Sn8fCiw', (select id from modele where libelle='Sprinter'), (select id from client where nom='Martin' and prenom='Jean'), 'AA001ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('SuC8WIoYCAucjasH5lLK', (select id from modele where libelle='Sprinter'), (select id from client where nom='Guy' and prenom='Matis'), 'AA002ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('PhHc6k4ypsBWPKe0wmsD', (select id from modele where libelle='Sprinter'), (select id from client where nom='Dupont' and prenom='Gérard'), 'AA003ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('Imr9AhCAbiPE1AkOT1Uy', (select id from modele where libelle='Master'), (select id from client where nom='Martin' and prenom='Jean'), 'AA004ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('u1DOCW8ktdhNYEVawgEV', (select id from modele where libelle='Master'), (select id from client where nom='Dupuis' and prenom='Marie'), 'AA005ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('Cgds0JCvdglxciAgjPeS', (select id from modele where libelle='Movano'), (select id from client where nom='Haim' and prenom='Julie'), 'AA006ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('dQIz8aR8TANcNCvJkSBE', (select id from modele where libelle='Jumper'), (select id from client where nom='Martin' and prenom='Jean'), 'AA007ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('HYhMlJDZtrUb1LScfjAM', (select id from modele where libelle='Jumper'), (select id from client where nom='Martin' and prenom='Jean'), 'AA008ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('0H61BX125pGLTDlu6gas', (select id from modele where libelle='Transit'), (select id from client where nom='Martin' and prenom='Jean'), 'AA009ZZ',CURRENT_TIMESTAMP);
insert into vehicule values ('Ljg6gd594EsdDoRxf6mw', (select id from modele where libelle='Transit'), (select id from client where nom='Martin' and prenom='Jean'), 'AA010ZZ',CURRENT_TIMESTAMP);

/*=== Photo ===*/

insert into photo values ('AdOfEJQBeuYQbizMrQNb', 'pictures/sprinter_1.jpg', '9HWMJP3zAl330Sn8fCiw', CURRENT_TIMESTAMP);
insert into photo values ('vJ8AMr7akWAivT74CzDt', 'pictures/sprinter_2.jpg', 'SuC8WIoYCAucjasH5lLK', CURRENT_TIMESTAMP);
insert into photo values ('Vol9mRl04mKygOyTPB7Y', 'pictures/sprinter_3.jpg', 'PhHc6k4ypsBWPKe0wmsD', CURRENT_TIMESTAMP);
insert into photo values ('DOPzECOgRJKHgkqCQa4X', 'pictures/master_1-1.jpg', 'Imr9AhCAbiPE1AkOT1Uy', CURRENT_TIMESTAMP);
insert into photo values ('oc7sjtqCRm6iomsK4yx4', 'pictures/master_1-2.jpg', 'Imr9AhCAbiPE1AkOT1Uy', CURRENT_TIMESTAMP);
insert into photo values ('Z9R2jQpbIgzMQgdTxaQA', 'pictures/master_2.jpg', 'u1DOCW8ktdhNYEVawgEV', CURRENT_TIMESTAMP);
insert into photo values ('U2OiDGUcdCZHg9iCrFUD', 'pictures/movano_1.jpg', 'Cgds0JCvdglxciAgjPeS', CURRENT_TIMESTAMP);
insert into photo values ('olXWKvNv12Jl7iZ5uLMM', 'pictures/jumper_1.png', 'dQIz8aR8TANcNCvJkSBE', CURRENT_TIMESTAMP);
insert into photo values ('1La6hAph6wWrcj5ngueE', 'pictures/jumper_2.jpg', 'HYhMlJDZtrUb1LScfjAM', CURRENT_TIMESTAMP);
insert into photo values ('Uy4q0yGpH10lPKwD2H84', 'pictures/transit_1.jpg', '0H61BX125pGLTDlu6gas', CURRENT_TIMESTAMP);
insert into photo values ('CSNtUdZJ9DLGa4KqM3HE', 'pictures/transit_2.jpg', 'Ljg6gd594EsdDoRxf6mw', CURRENT_TIMESTAMP);

/*=== Utilisateur ===*/

insert into utilisateur values ('BE4LvihlGE2Ecm9gIPvx', 'superadmin', '123', 3, CURRENT_TIMESTAMP);
insert into utilisateur values ('PJaM5xjmYmvDhVEd54Qn', 'admin', '123', 2, CURRENT_TIMESTAMP);
insert into utilisateur values ('TH2YTfynXPBjvgxROkyS', 'admin1', '123', 2, CURRENT_TIMESTAMP);
insert into utilisateur values ('IknHu3azlIkBE06NrA4T', 'admin2', '123', 2, CURRENT_TIMESTAMP);
insert into utilisateur values ('ta5Pk2K4l2lMuz4FTRq4', 'commercial', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values ('QQ4ZCP5mWBMoUsLEqZf4', 'commercial1', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values ('OvkY62KoY6RK9sCWolh5', 'commercial2', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values ('UQSQaXQJTSXOLDxcFOa5', 'commercial3', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values ('WdN4jXw4JzyudG4u2s7s', 'commercial4', '123', 1, CURRENT_TIMESTAMP);
insert into utilisateur values ('7qhQv8jLuit8fCxbM1KV', 'commercial5', '123', 1, CURRENT_TIMESTAMP);

/*=== Devis ===*/
/*
insert into devis values('vdozOiydtgtUXSpgxA7A', 1, (select id from utilisateur where pseudo='commercial'), 'devis/devis1.pdf', 1, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into devis values('vagxo2O8lAlZWdWEpMBq', 1, (select id from utilisateur where pseudo='commercial'), 'devis/devis2.pdf', 1, (select id from modele where libelle='Master'), CURRENT_TIMESTAMP);
insert into devis values('8X2KN5AU2gJZTpaQxaOx', 2, (select id from utilisateur where pseudo='commercial1'), 'devis/devis3.pdf', 1, (select id from modele where libelle='Sprinter'), CURRENT_TIMESTAMP);
insert into devis values('hRuKQ1zWrP2BGeCYFr9K', 2, (select id from utilisateur where pseudo='commercial1'), 'devis/devis4.pdf', 1, (select id from modele where libelle='Berlingo'), CURRENT_TIMESTAMP);
insert into devis values('tNMowQBdW7RAcld8tKTd', 3, (select id from utilisateur where pseudo='commercial2'), 'devis/devis5.pdf', 1, (select id from modele where libelle='Vito'), CURRENT_TIMESTAMP);
insert into devis values('pejQITpboQdDqgsa9YiH', 4, (select id from utilisateur where pseudo='commercial2'), 'devis/devis6.pdf', 0, (select id from modele where libelle='Movano'), CURRENT_TIMESTAMP);
insert into devis values('MLc8BZSFaNsCUnBwou18', 5, (select id from utilisateur where pseudo='commercial3'), 'devis/devis7.pdf', 0, (select id from modele where libelle='Kangoo'), CURRENT_TIMESTAMP);
insert into devis values('ZrTMhXdEKsfza77WRe3d', 6, (select id from utilisateur where pseudo='commercial4'), 'devis/devis8.pdf', 0, (select id from modele where libelle='Master'), CURRENT_TIMESTAMP);
insert into devis values('QYwqz1EyTqKZTTlLrrsC', 7, (select id from utilisateur where pseudo='commercial5'), 'devis/devis9.pdf', 0, (select id from modele where libelle='Trafic'), CURRENT_TIMESTAMP);
*/


/*=== Rendezvous ===*/

insert into rendezvous values('t0VFXWrlHtmwDeZen5Tl','contrôle qualité', (select id from utilisateur where pseudo='superadmin'), (select id from client where nom='Martin' and prenom='Jean'), '2017-01-04', '01:00:00', CURRENT_TIMESTAMP);
insert into rendezvous values('OWUZNhgtLpO1iuYUif9u','vente à domicile', (select id from utilisateur where pseudo='superadmin'), (select id from client where nom='Guy' and prenom='Matis'), '2017-01-06', '00:30:00', CURRENT_TIMESTAMP);
insert into rendezvous values('Q3jPQLoIn2NoWTwAM4s0','explication contrat', (select id from utilisateur where pseudo='superadmin'), (select id from client where nom='Dupont' and prenom='Gérard'), '2017-01-07', '01:45:00', CURRENT_TIMESTAMP);

/*=== JoinVehiculeOption ===*/

insert into join_vehicule_option values ('eqkKqM1UsnQmKjHCREGk', '9HWMJP3zAl330Sn8fCiw', (select id from options where libelle='luxe'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('Tzd6DtONI905dJYG9O1L', 'SuC8WIoYCAucjasH5lLK', (select id from options where libelle='rally'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('67gZ1LOVp9bwjQLnTOWK', 'PhHc6k4ypsBWPKe0wmsD', (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('l9MxHpQWrndFPZHSKbTu', 'Imr9AhCAbiPE1AkOT1Uy', (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('PqNvfaQPth2HSFcCzCAk', 'Imr9AhCAbiPE1AkOT1Uy', (select id from options where libelle='passager'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('Fhkxyn0nWK9vMvAfRvII', 'u1DOCW8ktdhNYEVawgEV', (select id from options where libelle='benne'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('e6ZWs4vfyG4On1uppk8K', 'Cgds0JCvdglxciAgjPeS', (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('Ds8U1bfOReT7RJXv0PMV', 'dQIz8aR8TANcNCvJkSBE', (select id from options where libelle='couleur'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('Tw4Cr3ieRvWeLG7oNl9M', 'HYhMlJDZtrUb1LScfjAM', (select id from options where libelle='passager'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('SKF4upbfFOE5zn9VId5w', '0H61BX125pGLTDlu6gas', (select id from options where libelle='luxe'), CURRENT_TIMESTAMP);
insert into join_vehicule_option values ('RrCPF8cuxZKl5Vgnbc0k', 'Ljg6gd594EsdDoRxf6mw', (select id from options where libelle='sport'), CURRENT_TIMESTAMP);

/*=== JoinDevisOption ===*/
/*
insert into join_devis_option values ('X886x3gPiq7kwIsfEeUU', (select id from options where libelle='couleur'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values ('4f0Ni5XHWswxrwXmr3vL', (select id from options where libelle='climatisation'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values ('MVCwkqeS5JRzwq9l0JeG', (select id from options where libelle='benne'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values ('0CAeZZrajLgOS4EFBarY', (select id from options where libelle='sport'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values ('bSQQiz44hRmlf8ML0yTk', (select id from options where libelle='rally'), 1, CURRENT_TIMESTAMP);
insert into join_devis_option values ('RmypAjY0rvyg2D84VNlL', (select id from options where libelle='couleur'), 2, CURRENT_TIMESTAMP);
insert into join_devis_option values ('Sz3BzXzidjxDI8oLlJm8', (select id from options where libelle='luxe'), 2, CURRENT_TIMESTAMP);
insert into join_devis_option values ('HEiGXTcvfOyE3VXCWqEJ', (select id from options where libelle='passager'), 2, CURRENT_TIMESTAMP);
insert into join_devis_option values ('QzfR1KITcBnJOXH8OxTw', (select id from options where libelle='couleur'), 3, CURRENT_TIMESTAMP);
insert into join_devis_option values ('EkieXoTAIRBrMEWykWPz', (select id from options where libelle='rangements'), 3, CURRENT_TIMESTAMP);
insert into join_devis_option values ('KgGExQ0sp4xOS3jGdZzR', (select id from options where libelle='couleur'), 4, CURRENT_TIMESTAMP);
insert into join_devis_option values ('uJfEs7Q15WFUmcqBXoKD', (select id from options where libelle='rangements'), 3, CURRENT_TIMESTAMP);
insert into join_devis_option values ('vmddr2NvtFWN52Am1Mcl', (select id from options where libelle='couleur'), 5, CURRENT_TIMESTAMP);
insert into join_devis_option values ('q9h9sfKu9BomYW2DKXNp', (select id from options where libelle='rangements'), 5, CURRENT_TIMESTAMP);
insert into join_devis_option values ('mC8rbA3UfJuW5ZqxTtHO', (select id from options where libelle='rangements'), 6, CURRENT_TIMESTAMP);
insert into join_devis_option values ('eeZPz8XcG78ZeghbD9dI', (select id from options where libelle='climatisation'), 6, CURRENT_TIMESTAMP);
insert into join_devis_option values ('ZBpV7D3aRepGLUrdG8SA', (select id from options where libelle='couleur'), 7, CURRENT_TIMESTAMP);
insert into join_devis_option values ('A67BUniRTpEsb4qjxs8G', (select id from options where libelle='rangements'), 7, CURRENT_TIMESTAMP);
insert into join_devis_option values ('OerwHCiZuTCCZQLM8kvq', (select id from options where libelle='rangements'), 8, CURRENT_TIMESTAMP);
insert into join_devis_option values ('YQLUUi1xMOPGbTS21qwA', (select id from options where libelle='climatisation'), 8, CURRENT_TIMESTAMP);
insert into join_devis_option values ('7s6Htmq9WINpz29DMgnJ', (select id from options where libelle='couleur'), 9, CURRENT_TIMESTAMP);
insert into join_devis_option values ('aDVIan7U5GQpJLIBc2MU', (select id from options where libelle='rangements'), 9, CURRENT_TIMESTAMP);
*/

/*=== Panier ===*/

insert into panier values('UD07OUNBBdcl8Qdw3T9s', (select id from client where nom='Martin' and prenom='Jean'), (select id from utilisateur where pseudo='superadmin'), 'panier/panier1.pdf', 1, CURRENT_TIMESTAMP);
insert into panier values('P9y8JVLXFmN9a5vn9quu', (select id from client where nom='Guy' and prenom='Matis'), (select id from utilisateur where pseudo='commercial'), 'panier/panier2.pdf', 1,CURRENT_TIMESTAMP);
insert into panier values('KFR8oM7JfATxD4Q0QPzf', (select id from client where nom='Dupont' and prenom='Gérard'), (select id from utilisateur where pseudo='commercial'), 'panier/panier3.pdf', 1, CURRENT_TIMESTAMP);
insert into panier values('au7xJJaEBVJhQlGqYT9u', (select id from client where nom='Dupuis' and prenom='Marie'), (select id from utilisateur where pseudo='commercial'), 'panier/panier4.pdf', 0, CURRENT_TIMESTAMP);
insert into panier values('lNu6bQ6nP9MxHVghcwup', (select id from client where nom='Haim' and prenom='Julie'), (select id from utilisateur where pseudo='commercial'), 'panier/panier5.pdf', 0, CURRENT_TIMESTAMP);

/*=== JoinPanierOption ===*/
insert into join_panier_option values ('03UU6365H89tRxkHVDIy', (select id from options where libelle='couleur'), 'UD07OUNBBdcl8Qdw3T9s', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('UTnrKzhzTNsq7jnaRmiQ', (select id from options where libelle='climatisation'), 'UD07OUNBBdcl8Qdw3T9s', 2, CURRENT_TIMESTAMP);
insert into join_panier_option values ('0LOfqwm8VRohn6LHsoES', (select id from options where libelle='rangements'), 'UD07OUNBBdcl8Qdw3T9s', 1,CURRENT_TIMESTAMP);
insert into join_panier_option values ('nhjqSepz2MFZgdCbPk1v', (select id from options where libelle='couleur'), 'P9y8JVLXFmN9a5vn9quu', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('LWRa49b72SMODdSCYnK5', (select id from options where libelle='climatisation'), 'P9y8JVLXFmN9a5vn9quu', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('ldFzTUD9trX1NnCZNh8d', (select id from options where libelle='rangements'), 'P9y8JVLXFmN9a5vn9quu', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('FPOSJUgBmzy5Nwy5VYtH', (select id from options where libelle='couleur'), 'KFR8oM7JfATxD4Q0QPzf', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('Urp771H9bgoE41Hx21e9', (select id from options where libelle='climatisation'), 'KFR8oM7JfATxD4Q0QPzf', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('19SEBrUh9AlOJxRLsuVe', (select id from options where libelle='couleur'), 'au7xJJaEBVJhQlGqYT9u', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('uuB7FDL7yPvaKkuOe12K', (select id from options where libelle='climatisation'), 'au7xJJaEBVJhQlGqYT9u', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('gCyqzbk0VwKF6lXIq1za', (select id from options where libelle='couleur'), 'lNu6bQ6nP9MxHVghcwup', 1, CURRENT_TIMESTAMP);
insert into join_panier_option values ('wmXR1elDFXI4RTSYWac3', (select id from options where libelle='climatisation'), 'lNu6bQ6nP9MxHVghcwup', 1, CURRENT_TIMESTAMP);

/*=== JoinTypeModeleOption ===*/
insert into join_typemodele_option values ('mxiR3rRJxrkWNcrOyiEQ', (select id from options where libelle='couleur'), (select id from typeModele where libelle='A'), 300, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('MKs0PbsGETh8BRdLLfSK', (select id from options where libelle='couleur'), (select id from typeModele where libelle='B'), 3100, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('Gozkr31VwqNMx0KXlMOB', (select id from options where libelle='couleur'), (select id from typeModele where libelle='C'), 3300, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('F0F6K4IGi0YkdWBJ5JOD', (select id from options where libelle='passager'), (select id from typeModele where libelle='A'), 900, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('J5MKOlyfX4Zw04GtrtvB', (select id from options where libelle='passager'), (select id from typeModele where libelle='B'), 1000, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('Hg3jpU8CoforEy1TYfpQ', (select id from options where libelle='passager'), (select id from typeModele where libelle='C'), 1100, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('bSZyFhTZBuYR9345EDK1', (select id from options where libelle='benne'), (select id from typeModele where libelle='A'), 1800, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('SGpO17R7YAlW7nu3TwJ6', (select id from options where libelle='benne'), (select id from typeModele where libelle='B'), 1900, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('Nlj3Qr3UtksDst4EKNvH', (select id from options where libelle='benne'), (select id from typeModele where libelle='C'), 2100, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('aFr2QL6mESwig9SfGHJH', (select id from options where libelle='rangements'), (select id from typeModele where libelle='A'), 1500, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('wyWsVVx8jpzZnTOB81kP', (select id from options where libelle='rangements'), (select id from typeModele where libelle='B'), 1500, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('ahYUapvLJrk0AUkxwmw9', (select id from options where libelle='rangements'), (select id from typeModele where libelle='C'), 1500, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('SkUwOnoKIzhp5x9MagmC', (select id from options where libelle='luxe'), (select id from typeModele where libelle='A'), 4000, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('jHtX0QVZ5vrL9vLCHYY6', (select id from options where libelle='luxe'), (select id from typeModele where libelle='B'), 4000, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('SjoCzgUKBY43mk6ZK41w', (select id from options where libelle='luxe'), (select id from typeModele where libelle='C'), 4000, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('NUmXMO8xKr6pquIOq0Bg', (select id from options where libelle='rally'), (select id from typeModele where libelle='A'), 2500, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('yjpeAoGUIKDxOMlKdR07', (select id from options where libelle='rally'), (select id from typeModele where libelle='B'), 2500, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('kFr6w9vhQXRwBDFIQEhv', (select id from options where libelle='rally'), (select id from typeModele where libelle='C'), 2500, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('1xFtkf5HX3ZlcbNyKtVy', (select id from options where libelle='sport'), (select id from typeModele where libelle='A'), 8000, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('97xzw3DMTHV0YP0H7rK5', (select id from options where libelle='sport'), (select id from typeModele where libelle='B'), 8000, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('zElhhnoWpUanbqSSUr9t', (select id from options where libelle='sport'), (select id from typeModele where libelle='C'), 8000, CURRENT_TIMESTAMP);

insert into join_typemodele_option values ('6biAqXkaBqLq2hTW3oef', (select id from options where libelle='climatisation'), (select id from typeModele where libelle='A'), 750, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('q7BdXkW9RZsc1WatXAmV', (select id from options where libelle='climatisation'), (select id from typeModele where libelle='B'), 750, CURRENT_TIMESTAMP);
insert into join_typemodele_option values ('8pRYv4RiZ5YIXQcR51k5', (select id from options where libelle='climatisation'), (select id from typeModele where libelle='C'), 750, CURRENT_TIMESTAMP);