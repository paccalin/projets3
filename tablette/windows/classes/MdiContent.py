#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from PyQt5.QtWidgets import *


class MdiContent(object):
    __classSingleton = None

    #!ne pas instancier cette classe manuellement
    #constructeur du singleton
    def __init__(self, pMdi):
        #initialisation de la liste
        self.__windowList = {}
        #ajout de la fenêtre MDI
        self.__windowList["mdi"] = pMdi
        #ajout de la fenetre header
        self.__windowList["header"]

    #get
    def WindowList(self):
        return self.__windowList

    #gestion de la création du singleton
    @classmethod
    def Singleton(cls, pMdi=None):
        if(cls.__classSingleton == None):
            if(pMdi != None):
                cls.__classSingleton = MdiContent(pMdi)
            else:
                print("Il faut procurer une instance de la classe WMain lors du premier appel de la méthode Singleton()")
        else:
            return cls.__classSingleton

    #methode pour afficher les fenetres
    @classmethod
    def StartGui(cls):
        cls.Singleton().WindowList()["mdi"].showFullScreen()
        for aWidget in cls.Singleton().WindowList()["mdi"].subWindows:
            aWidget.show()