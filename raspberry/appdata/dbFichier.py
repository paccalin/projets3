#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import csv
from manufacturer import manufacturer
import datetime
from socket import socket

class dbFichier():

    def __init__(self, nomClasse):
        self.__nomClasse=nomClasse
        self.__nomFichier="../DB/"+nomClasse+"s.csv"

    def insert(self,objet):
        #ouverture du csv en lecture
        file  = open(self.__nomFichier,"rb")
        reader = csv.reader(file)
        insertID = 0

        #instanciation et stockage des objets dans un vecteur
        objets = []
        for row in reader:
            string = row[0]
            st=string.split(';')
            if(self.__nomClasse=="client"):
                objets.append(client(st[1],st[2],st[3],st[4],st[5],st[6],st[7],st[0]))
            elif(self.__nomClasse=="manufacturer"):
                objets.append(manufacturer(st[1],st[2],st[0]))
            elif(self.__nomClasse=="devis"):
                objets.append(devis(st[1],st[2],st[3],st[4],st[0]))
            elif(self.__nomClasse=="modele"):
                objets.append(model(st[1],st[2],st[3],st[0]))
            elif(self.__nomClasse=="option"):
                objets.append(option(st[1],st[2],st[3],st[0]))
            elif(self.__nomClasse=="picture"):
                objets.append(picture(st[1],st[2],st[3],st[0]))
            elif(self.__nomClasse=="rdv"):
                objets.append(rdv(st[1],st[2],st[3],st[4],st[5],st[0]))
            elif(self.__nomClasse=="utilisateur"):
                objets.append(utlisateur(st[1],st[2],st[3],st[0]))
            elif(self.__nomClasse=="vehicule"):
                objets.append(vehicule(st[1],st[2],st[0]))
            if insertID<int(st[0]):
                insertID=int(st[0])
            
        #fermeture du fichier en lecture et ouverture en ecriture
        file.close()
        file  = open(self.__nomFichier, "wb")
        if(self.__nomClasse=="client"):
            fieldnames = range(1, 8)
        elif(self.__nomClasse=="manufacturer"):
            fieldnames = range(1, 3)
        elif(self.__nomClasse=="devis"):
            fieldnames = range(1, 5)
        elif(self.__nomClasse=="modele"):
            fieldnames = range(1, 4)
        elif(self.__nomClasse=="option"):
            fieldnames = range(1, 4)
        elif(self.__nomClasse=="picture"):
            fieldnames = range(1, 4)
        elif(self.__nomClasse=="rdv"):
            fieldnames = range(1, 6)
        elif(self.__nomClasse=="utilisateur"):
            fieldnames = range(1, 4)
        elif(self.__nomClasse=="vehicule"):
            fieldnames = range(1, 3)
        writer = csv.DictWriter(file, delimiter=';', fieldnames=fieldnames, quotechar='"', quoting=csv.QUOTE_MINIMAL)

        #ajout des objets avec les nouveaux et insertion dans le fichier CSV
        objets.append(objet)

        for ob in objets:
            if(self.__nomClasse=="client"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Nom(), '3': ob.Prenom(),'4': ob.Rue(), '5': ob.Ville(),'6': ob.CP(), '7': ob.Mail(),'8': ob.Tel()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Nom(), '3': ob.Prenom(),'4': ob.Rue(), '5': ob.Ville(),'6': ob.CP(), '7': ob.Mail(),'8': ob.Tel()})
            elif(self.__nomClasse=="manufacturer"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Libelle(), '3': ob.Date_insertion()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Libelle(), '3': ob.Date_insertion()})
            elif(self.__nomClasse=="devis"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Client_id(), '3': ob.Utilisateur_id(), '4': ob.Path(), '5': ob.Actif()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Client_id(), '3': ob.Utilisateur_id(), '4': ob.Path(), '5': ob.Actif()})
            elif(self.__nomClasse=="modele"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Libelle(), '3': ob.Constructeur_id(), '4': ob.Date_insertion()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Libelle(), '3': ob.Constructeur_id(), '4': ob.Date_insertion()})
            elif(self.__nomClasse=="option"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Libelle(), '3': ob.Description(), '4': ob.Date_insertion()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Libelle(), '3': ob.Description(), '4': ob.Date_insertion()})
            elif(self.__nomClasse=="photo"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Path(), '3': ob.Vehicle_id(), '4': ob.Date_creation()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Path(), '3': ob.Vehicle_id(), '4': ob.Date_creation()})
            elif(self.__nomClasse=="rdv"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Libelle(), '3': ob.Utilisateur_id(), '4': ob.Client_id(), '5': ob.rdv_Date(), '6': ob.rdv_Duree()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Libelle(), '3': ob.Utilisateur_id(), '4': ob.Client_id(), '5': ob.rdv_Date(), '6': ob.rdv_Duree()})
            elif(self.__nomClasse=="utilisateur"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.Pseudo(), '3': ob.MotPasse(), '4': ob.Droits()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.Pseudo(), '3': ob.MotPasse(), '4': ob.Droits()})
            elif(self.__nomClasse=="vehicule"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow({'1': insertID,'2': ob.modele_id(), '3': ob.Date_insertion()})
                else:
                    insertID=ob.DbId()
                    writer.writerow({'1': ob.DbId(),'2': ob.modele_id(), '3': ob.Date_insertion()})
        
        #fermeture du fichier
        file.close()

    def select(self,numCol,value):
        file  = open(self.__nomFichier,"rb")
        reader = csv.reader(file)

        objets = []
        for row in reader:
            string = row[0]
            st=string.split(';')
            if(row[numCol]==value):
                if(self.__nomClasse=="client"):
                    objets.append(client(st[1],st[2],st[3],st[4],st[5],st[6],st[7],st[0]))
                elif(self.__nomClasse=="manufacturer"):
                    objets.append(manufacturer(st[1],st[2],st[0]))
                elif(self.__nomClasse=="devis"):
                    objets.append(devis(st[1],st[2],st[3],st[4],st[0]))
                elif(self.__nomClasse=="modele"):
                    objets.append(model(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="option"):
                    objets.append(option(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="picture"):
                    objets.append(picture(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="rdv"):
                    objets.append(rdv(st[1],st[2],st[3],st[4],st[5],st[0]))
                elif(self.__nomClasse=="utilisateur"):
                    objets.append(utlisateur(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="vehicule"):
                    objets.append(vehicule(st[1],st[2],st[0]))

        return objets

    #Utilisation :
    #numCols = liste des numero des collones à comparer, values = liste des valeurs attendues
    # select * from table where col1 = "a" and col3 = "b" -> numcols = [1,3] et values = ["a","b"]
    def selectMultiple(self,numCols,values):
        file  = open(self.__nomFichier,"rb")
        reader = csv.reader(file)

        objets = []
        for row in reader:
            string = row[0]
            st=string.split(';')
            selectable = true
            # selectable = vrai, on compare tous le attributs des objets du CSV aux attributs passés en paramètre
            # si un ne correspond pas, on passe à faux
            for i in range(len(numCols)):
                if(row[i]!=values[i]):
                    selectable=false
            if(selectable==true):
                if(self.__nomClasse=="client"):
                    objets.append(client(st[1],st[2],st[3],st[4],st[5],st[6],st[7],st[0]))
                elif(self.__nomClasse=="manufacturer"):
                    objets.append(manufacturer(st[1],st[2],st[0]))
                elif(self.__nomClasse=="devis"):
                    objets.append(devis(st[1],st[2],st[3],st[4],st[0]))
                elif(self.__nomClasse=="modele"):
                    objets.append(model(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="option"):
                    objets.append(option(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="picture"):
                    objets.append(picture(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="rdv"):
                    objets.append(rdv(st[1],st[2],st[3],st[4],st[5],st[0]))
                elif(self.__nomClasse=="utilisateur"):
                    objets.append(utlisateur(st[1],st[2],st[3],st[0]))
                elif(self.__nomClasse=="vehicule"):
                    objets.append(vehicule(st[1],st[2],st[0]))

        return objets

dbManu = dbFichier("manufacturer")
man1 = manufacturer('TEST',datetime.date(2010,5,10))
dbManu.insert(man1)