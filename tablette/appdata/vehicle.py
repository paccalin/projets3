#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import * 
import pg8000
import datetime

class vehicle():
    __vehicleList
    def __init__(self, pModel, pInsertionDate, pDbId = None):
        self.__dbId = pDbId
        self.__model = pModel
        self.__insertionDate = pInsertionDate
    
    #get
    def DbId(self):
        return self.__dbId
    
    #get/set
    def Model(self, pModel = None):
        if(pModel == None):
            return self.__model
        else:
            self.__model = pModel
    
    #get
    def InsertionDate(self):
        return self.__insertionDate

    #chargement de tout les véhicules
    @classmethod
    def FindAll(cls):
        provVehicleList = []
        cursor = DbAccess.Querry("SELECT * FROM vehicule")
        results = cursor.fetchall()
        for row in results:
            id, modelId, insertionDate = row
            model = modelId
            #load model
            aVehicle = vehicle(model, insertionDate, id)
            vehicleList.append(aVehicle)
        cls.__vehicleList = provVehicleList
        return cls.__vehicleList

    #chargement de l'orrurence correspondant à un id passé en paramètre
    @classmethod
    def FindById(cls, pId):
        result = filter(lambda x: x.DbId() == pId, cls.__vehicleList)
        if(len(result) != 0):
            return result[0]
        else:
            cursor = DbAccess.Querry("SELECT * FROM vehicule WHERE vehicule_id = " + pId)
            results = cursor.fetchall()
            for row in results:
                id, modelId, insertionDate = row
                model = modelId
                #load model
                aVehicle = vehicle(model, insertionDate, id)
            cls.__vehicleList.append(aVehicle)
            return aVehicle