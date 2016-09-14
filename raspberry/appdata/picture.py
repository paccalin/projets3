#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import * 
import pg8000
import datetime

class picture():
    def __init__(self, pPath, pInsertionDate, pDbId=None):
        self.__dbId = pDbId
        self.__path = pPath
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
    
    #chargement de toutes les photos
    @classmethod
    def FindAll(cls):
        pictureList = []
        cursor = DbAccess.Querry("SELECT * FROM photo")
        results = cursor.fetchall()
        for row in results:
            id, path, insertionDate = row
            aPicture = picture(path, insertionDate, id)
            pictureList.append(aPicture)
        return pictureList

    #chargement de l'orrurence correspondant à un id passé en paramètre
    @classmethod
    def FindBySelection(cls, pId):
        cursor = DbAccess.Querry("SELECT * FROM photo WHERE photo_id = " + pId)
        results = cursor.fetchall()
        for row in results:
            id, path, insertionDate = row
            aPicture = picture(path, insertionDate, id)
        return aPicture