#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import csv
from manufacturer import manufacturer
from option import option
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
        #range(1,4) pour [1,2,3] et pas range(1,3)
        file.close()
        file  = open(self.__nomFichier, "wb")
        if(self.__nomClasse=="client"):
            fieldnames = range(1, 9)
        elif(self.__nomClasse=="manufacturer"):
            fieldnames = range(1, 4)
        elif(self.__nomClasse=="devis"):
            fieldnames = range(1, 6)
        elif(self.__nomClasse=="modele"):
            fieldnames = range(1, 5)
        elif(self.__nomClasse=="option"):
            fieldnames = range(1, 5)
        elif(self.__nomClasse=="picture"):
            fieldnames = range(1, 5)
        elif(self.__nomClasse=="rdv"):
            fieldnames = range(1, 7)
        elif(self.__nomClasse=="utilisateur"):
            fieldnames = range(1, 5)
        elif(self.__nomClasse=="vehicule"):
            fieldnames = range(1, 4)
        writer = csv.writer(file, delimiter=';', quotechar='"', quoting=csv.QUOTE_MINIMAL)
        # writer = csv.DictWriter(file, fieldnames=fieldnames)

        #ajout des objets avec les nouveaux et insertion dans le fichier CSV
        objets.append(objet)

        for ob in objets:
            if(self.__nomClasse=="client"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Nom(), ob.Prenom(), ob.Rue(), ob.Ville(), ob.CP(), ob.Mail(), ob.Tel()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Nom(), ob.Prenom(), ob.Rue(), ob.Ville(), ob.CP(), ob.Mail(), ob.Tel()])
            elif(self.__nomClasse=="manufacturer"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Libelle(), ob.InsertionDate()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Libelle(), ob.InsertionDate()])
            elif(self.__nomClasse=="devis"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Client_id(), ob.Utilisateur_id(), ob.Path(), ob.Actif()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Client_id(), ob.Utilisateur_id(), ob.Path(), ob.Actif()])
            elif(self.__nomClasse=="modele"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Libelle(), ob.Constructeur_id(), ob.InsertionDate()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Libelle(), ob.Constructeur_id(), ob.InsertionDate()])
            elif(self.__nomClasse=="option"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Libelle(), ob.Description(), ob.InsertionDate()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([ob.DbId(), ob.Libelle(), ob.Description(), ob.InsertionDate()])
            elif(self.__nomClasse=="photo"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Path(), ob.Vehicle_id(), ob.Date_creation()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Path(), ob.Vehicle_id(), ob.Date_creation()])
            elif(self.__nomClasse=="rdv"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Libelle(), ob.Utilisateur_id(), ob.Client_id(), ob.rdv_Date(), ob.rdv_Duree()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Libelle(), ob.Utilisateur_id(), ob.Client_id(), ob.rdv_Date(), ob.rdv_Duree()])
            elif(self.__nomClasse=="utilisateur"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.Pseudo(), ob.MotPasse(), ob.Droits()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.Pseudo(), ob.MotPasse(), ob.Droits()])
            elif(self.__nomClasse=="vehicule"):
                if(ob.DbId()==None):
                    insertID+=1
                    writer.writerow([insertID, ob.modele_id(), ob.Date_insertion()])
                else:
                    insertID=int(ob.DbId())
                    writer.writerow([insertID, ob.modele_id(), ob.Date_insertion()])
        
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