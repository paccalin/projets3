#!/usr/bin/env python
# -*- coding: utf-8 -*-

from appdata.DbAccess import *
import pg8000
import datetime

class option():
    __optionList = []

    def __init__(self, pLibelle, pDesc, pInsertionDate, pDbId = None):
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
        results = None
        if(cursor != None):
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
        optionToReturn = None
        for anOption in cls.__optionList:
            if (anOption.DbId()) == pId:
                optionToReturn = anOption
        if (optionToReturn == None):
            cursor = DbAccess.Querry("SELECT * FROM option WHERE option_id = " + str(pId))
            results = None
            if(cursor != None):
                results = cursor.fetchall()
                for row in results:
                    id, libelle, desc, insertionDate = row
                    anOption = option(libelle, desc, insertionDate, id)
                    cls.__optionList.append(anOption)
                    optionToReturn = anOption
        return optionToReturn

    #chargement des orrurences correspondantes à un l'id d'un véhicule passé en paramètre
    @classmethod
    def FindByVehicle(cls, pVehicleId):
        provOptionList = []
        cursor = DbAccess.Querry("SELECT option_id FROM join_vehicule_option WHERE vehicule_id = " + str(pVehicleId))
        results = None
        if(cursor != None):
            results = cursor.fetchall()
            for row in results:
                id = row[0]
                provOptionList.append(cls.FindById(id))
        return provOptionList