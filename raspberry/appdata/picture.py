#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import * 
from appdata.vehicle import *
import pg8000
import datetime

class picture():
    __pictureList = []

    def __init__(self, pPath, pVehicle, pInsertionDate, pDbId=None):
        self.__dbId = pDbId
        self.__path = pPath
        self.__vehicle = pVehicle
        self.__insertionDate = pInsertionDate

    #get
    def DbId(self):
        return self.__dbId
    
    #get/set
    def Path(self, pPath = None):
        if(pPath == None):
            return self.__path
        else:
            self.__path = pPath

    #get
    def InsertionDate(self):
        return self.__insertionDate

    #get
    def Vehicle(self):
        return self.__vehicle

    #chargement de toutes les photos
    @classmethod
    def FindAll(cls):
        provPictureList = []
        cursor = DbAccess.Querry("SELECT * FROM photo")
        results = None
        if(cursor != None):
            results = cursor.fetchall()
            for row in results:
                id, path, vehicleId, insertionDate = row
                iVehicle = vehicle.FindById(vehicleId)
                aPicture = picture(path, iVehicle, insertionDate, id)
                provPictureList.append(aPicture)
        cls.__pictureList = provPictureList
        if(len(cls.__pictureList) == 0):
            print("retourne une liste vide !")
        return cls.__pictureList

    #chargement de l'orrurence correspondant à un id passé en paramètre
    @classmethod
    def FindById(cls, pId):
        result = filter(lambda x: x.DbId() == pId, cls.__pictureList)
        if(len(result) != 0):
            return result[0]
        else:
            cursor = DbAccess.Querry("SELECT * FROM photo WHERE photo_id = " + str(pId))
            results = None
            if(cursor != None):
                results = cursor.fetchall()
                for row in results:
                    id, path, vehicleId, insertionDate = row
                    iVehicle = vehicle.FindById(vehicleId)
                    aPicture = picture(path, iVehicle, insertionDate, id)
            cls.__pictureList.append(aPicture)
            return aPicture