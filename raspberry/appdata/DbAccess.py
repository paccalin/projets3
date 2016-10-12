#!/usr/bin/env python
# -*- coding: utf-8 -*-

import pg8000

class DbAccess(object):
    __dbSingleton = None
    __dbHost = "localhost"
    __dbName = "showRoomContent"
    __dbUser = "postgres"
    __dbPass = "123"

    #!ne pas instancier cette classe manuellement
    #constructeur du singleton
    def __init__(self, pHost, pName, pUser, pPass):
        self.__conn = None
        try:
            self.__conn = pg8000.connect(user=pUser, host=pHost, password=pPass, database=pName)
        except:
            print("erreur lors de la connection a la base de donnée: {}, a l'adresse: //{}, avec l'utilisateur: {}, en utilisant le mot de passe: {}".format(
                pName, pHost, pUser, pPass))

    #get
    def Db(self):
        return self.__conn

    #gestion de la création du singleton
    @classmethod
    def Connect(cls):
        if(cls.__dbSingleton == None):
            cls.__dbSingleton = DbAccess(cls.__dbHost, cls.__dbName, cls.__dbUser, cls.__dbPass)
        return cls.__dbSingleton
    
    #gestion de la destruction du singleton
    @classmethod
    def Disconnect(cls):
        if(cls.__dbSingleton != None):
            cls.__dbSingleton.__conn.close()
        cls.__dbSingleton = None
    
    #execution d'une requete sql'
    @classmethod
    def  Querry(cls, pQuerry):
        if(cls.Connect().Db() != None):
            cursor = cls.Connect().Db().cursor()
            try:
                cursor.execute(pQuerry)
                return cursor
            except:
                print("Erreur lors de l'execution de la requete: {}".format(pQuerry))

