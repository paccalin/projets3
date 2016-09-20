#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import * 
import pg8000
import datetime

class picture():
    __pictureList = []

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
        provPictureList = []
        cursor = DbAccess.Querry("SELECT * FROM photo")
        results = cursor.fetchall()
        for row in results:
            id, path, insertionDate = row
            aPicture = picture(path, insertionDate, id)
            provPictureList.append(aPicture)
        cls.__pictureList = provPictureList
        return cls.__pictureList

    #chargement de l'orrurence correspondant à un id passé en paramètre
    @classmethod
    def FindById(cls, pId):
        result = filter(lambda x: x.DbId() == pId, cls.__pictureList)
        if(len(result) != 0):
            return result[0]
        else:
            cursor = DbAccess.Querry("SELECT * FROM photo WHERE photo_id = " + pId)
            results = cursor.fetchall()
            for row in results:
                id, path, insertionDate = row
                aPicture = picture(path, insertionDate, id)
            cls.__pictureList.append(aPicture)
            return aPicture