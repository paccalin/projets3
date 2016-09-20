#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import *
from appdata.manufacturer import * 
import pg8000
import datetime

class model():
    __modleList = []

    def __init__(self, pLibelle, pManufacturer, pInsertionDate, pDbId = None):
        self.__dbId = pDbId
        self.__libelle = pLibelle
        self.__manufacturer = pManufacturer
        self.__insertionDate = pInsertionDate
    #get
    def DbId(self):
        return self.__dbId

    #get/set
    def Libelle(self, pLibelle = None):
        if(pLibelle == None):
            return self.__libelle
        else:
            self.__libelle = pLibelle
    
    #get/set
    def Manufacturer(self, pManufacturer = None):
        if(pManufacturer == None):
            return self.__manufacturer
        else:
            self.__manufacturer = pManufacturer

    #get
    def InsertionDate(self):
        return self.__insertionDate

    #chargement de tout les modèles
    @classmethod
    def FindAll(cls):
        provModelList = []
        cursor = DbAccess.Querry("SELECT * FORM modele")
        results = cursor.fetchall()
        for row in results:
            id, libelle, manufacturerId, insertionDate = row
            manufacturer = manufacturerId
            #load manufacturer
            aModel = model(libelle, manufacturer, insertionDate, id)
            provModelList.append(aModel)
        cls.__modelList = provModelList
        return cls.__modelList

    #chargement de tout les modèles
    @classmethod
    def FindById(cls, pId):
        result = filter(lambda x: x.DbId() == pId, cls.__modelList)
        if(len(result) != 0):
            return result[0]
        else:
            cursor = DbAccess.Querry("SELECT * FROM modele WHERE modele_id = " + pId)
            results = cursor.fetchall()
            for row in results:
                id, libelle, manufacturerId, insertionDate = row
                manufacturer = manufacturerId
                #load manufacturer
                aModel = model(libelle, manufacturer, insertionDate, id)
            cls.__modelList.append(aModel)
            return aModel

