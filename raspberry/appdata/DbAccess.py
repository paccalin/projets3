#!/usr/bin/env python
# -*- coding: utf-8 -*-

import pg8000

class DbAccess(object):
    __dbSingleton = None
    __dbHost = "localhost"
    __dbPort = "5432"
    __dbName = "showRoomContent"
    __dbUser = "postgres"
    __dbPass = ""

    #!ne pas instancier cette classe manuellement
    #constructeur du singleton
    def __init__(self):
        __conn = None
        try:
            __conn = pg8000.connect(host=__dbHost, port=__dbPort, user=__dbUser, password=__dbPass, database=__dbName)
        except:
            print("erreur lors de la connection a la base de donnée: {}, a l'adresse: //{}:{}, avec l'utilisateur: {}, en utilisant le mot de passe: {}".format(__dbName, __dbHost, __dbPort, __dbUser, __dbPass))

    #gestion de la création du singleton
    @classmethod
    def Connect(cls):
        if(cls.__dbSingleton == None):
            cls.__dbSingleton = DataAccess()
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
        if(Connect != None):
            cursor = Connect().cursor()
            try:
                cursor.execute(pQuerry)
                return cursor
            except:
                print("Erreur lors de l'execution de la requete: {}".format(pQuerry))

