#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import * 
import pg8000
import datetime

class manufacturer():
    __manufacturerList = []

    def __init__(self, pLibelle, pInsertionDate, pDbId=None):
        self.__dbId = pDbId
        self.__libelle = pLibelle
        self.__insertionDate = pInsertionDate

    #get
    def DbId(self):
        return self.__dbId
    
    #get/set
    def Libelle(self):
        return self.__libelle

    #get
    def InsertionDate(self):
        return self.__insertionDate

    #chargement de toutes les photos
    @classmethod
    def FindAll(cls):
        provManufacturerList = []
        cursor = DbAccess.Querry("SELECT * FROM constructeur")
        results = None
        if(cursor != None):
            results = cursor.fetchall()
            for row in results:
                id, libelle, insertionDate = row
                aManufacturer = manufacturer(libelle, insertionDate, id)
                provManufacturerList.append(aManufacturer)
        cls.__manufacturerList = provManufacturerList
        return cls.__manufacturerList

    #chargement de l'orrurence correspondant à un id passé en paramètre
    @classmethod
    def FindById(cls, pId):
        result = filter(lambda x: x.DbId() == pId, cls.__manufacturerList)
        if(len(result) != 0):
            return result[0]
        else:
            cursor = DbAccess.Querry("SELECT * FROM constructeur WHERE constructeur_id = " + pId)
            results = None
            if(cursor != None):
                results = cursor.fetchall()
                for row in results:
                    id, libelle, insertionDate = row
                    aManufacturer = manufacturer(libelle, insertionDate, id)
            cls.__manufacturerList.append(aManufacturer)
            return aManufacturer