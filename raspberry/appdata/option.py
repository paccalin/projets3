#!/usr/bin/env python
# -*- coding: utf-8 -*-

import pg8000
import datetime

class option():
    __optionList = []

    def __init__(self, pLibelle, pDesc, pDbId = None):
        self.__dbId = pDbId
        self.__libelle = pLibelle
        self.__desc = pDesc
        self.__insertionDate = pInsertionDate
    #get
    def DbId(self):
        return self.__dbId

    #get
    def Libelle(self):
        return self.__libelle

    #get
    def Descripton(self):
        return self.__desc

    #get
    def InsertionDate(self):
        return self.__insertionDate

    #chargement de toutes les options
    @classmethod
    def FindAll(cls):
        provOptionList = []
        cursor = DbAccess.Querry("SELECT * FROM option")
        results = cursor.fetchall()
        for row in results:
            id, libelle, pDesc, insertionDate = row
            anOption = option(libelle, desc, insertionDate, id)
            provOptionList.append(anOption)
        cls.__optionList = provOptionList
        return cls.__optionList

    #chargement de l'orrurence correspondant à un id passé en paramètre
    @classmethod
    def FindById(cls, pId):
        result = filter(lambda x: x.DbId() == pId, cls.__optionList)
        if(len(result) != 0):
            return result[0]
        else:
            cursor = DbAccess.Querry("SELECT * FROM modele WHERE modele_id = " + pId)
            results = cursor.fetchall()
            for row in results:
                id, libelle, pDesc, insertionDate = row
                anOption = option(libelle, desc, insertionDate, id)
            cls.__optionList.append(anOption)
            return anOption