#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from PyQt5.QtWidgets import *
from windows.components.CImgDiapo import *
from windows.components.CBandeImages import *
from windows.components.CDescription import *


class MdiContent(object):
    __classSingleton = None

    #!ne pas instancier cette classe manuellement
    #constructeur du singleton
    def __init__(self, pMdi):
        #initialisation de la liste
        self.__windowList = {}
        #ajout de la fenêtre MDI
        self.__windowList["mdi"] = pMdi
        #création de la sous-fenêtre de diapo
        self.__windowList["diapo"] = QMdiSubWindow()
        self.__windowList["diapo"].setWidget(CImgDiapo())
        #création de la sous-fenêtre bande d'images
        self.__windowList["bandeImages"] = QMdiSubWindow()
        self.__windowList["bandeImages"].setWidget(CBandeImages())#changer CImgDiapo par le widget une fois terminé
        #création de la sous-fenêtre de description
        self.__windowList["description"] = QMdiSubWindow()
        self.__windowList["description"].setWidget(CDescription())
        #ajout des sous-fenêtres à la mdi
        for anIndex, aSubWindow in self.__windowList.items():
            if(anIndex != "mdi"):
                self.__windowList["mdi"].mdi.addSubWindow(aSubWindow)

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