#!/usr/bin/env python
# -*- coding: utf-8 -*-

# import pg8000
import csv

class DbPicture():
    
    def __init__(self, insertID=0):
        self.__insertID=insertID

    def insert(self,picture):
        #ouverture du csv en lecture
        file  = open("../DB/pictures.csv","rb")
        reader = csv.reader(file)

        #instanciation et stockage des objets dans un vecteur
        pictures = []
        for row in reader:
            string = row[0]
            st=string.split(';')
            pictureos.append(picture(st[1],st[2],st[3],st[0]))
            if insertID<int(st[0]):
                insertID=int(st[0])

        #fermeture du fichier en lecture et ouverture en ecriture
        file.close()
        file  = open("../DB/picture.csv", "wb")
        fieldnames = ['picture_id','picture_path','picture_vehicule','picture_insertionDate']
        writer = csv.DictWriter(file, delimiter=';', fieldnames=fieldnames, quotechar='"', quoting=csv.QUOTE_MINIMAL)

        #ajout des anciens objets et du nouveau puis insertion dans le fichier
        pictures.append(picture)
        for p in pictures:
            if(p.DbId()==None):
                insertID+=1
                writer.writerow({'picture_id': insertID,'picture_path': p.Path(), 'picture_vehicule': p.InsertionDate()})
            else:
                writer.writerow({'picture_id': p.DbId(),'picture_path': p.Path(), 'picture_vehicule': p.InsertionDate()})

        #fermeture du fichier
        file.close()

        # def __init__(self, pPath, pVehicle, pInsertionDate, pDbId=None):
        # self.__dbId = pDbId
        # self.__path = pPath
        # self.__vehicle = pVehicle
        # self.__insertionDate = pInsertionDate