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

    #get/set
    def InsertionDate(self, pInsertionDate=None):
        if(pInsertionDate == None):
            return self.__insertionDate
        else:
            self.__insertionDate = pInsertionDate
    
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

    #chargement de toutes les orrurences d'un complément de requete passé en paramètre
    @classmethod
    def FindBySelection(cls, pRequestComplement):
        pictureList = []
        cursor = DbAccess.Querry("SELECT * FROM photo" + pRequestComplement)
        results = cursor.fetchall()
        for row in results:
            id, path, insertionDate = row
            aPicture = picture(path, insertionDate, id)
            pictureList.append(aPicture)
        return pictureList