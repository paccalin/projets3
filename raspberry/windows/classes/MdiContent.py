#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from PyQt5.QtWidgets import *
from windows.components.CImgDiapo import *

class MdiContent(object):
    __classSingleton = None

    #!ne pas instancier cette classe manuellement
    #constructeur du singleton
    def __init__(self, pMdi):
        self.__mdiSingleton = pMdi

        #création de la fenêtre de diapo
        self.__diapoSingleton = QMdiSubWindow()
        self.__diapoSingleton.setWidget(CImgDiapo())

        #création de la fenêtre bande d'images
        self.__bandeSingleton = QMdiSubWindow()
        self.__bandeSingleton.setWidget(CImgDiapo())#changer CImgDiapo par le widget une fois terminé

        #création de la fenêtre de description
        self.__descriptionSingleton = QMdiSubWindow()
        self.__descriptionSingleton.setWidget(CImgDiapo())#changer CImgDiapo par le widget une fois terminé

        #ajout des fenêtres à la mdi
        self.__mdiSingleton.mdi.addSubWindow(self.__diapoSingleton)
        self.__mdiSingleton.mdi.addSubWindow(self.__bandeSingleton)
        self.__mdiSingleton.mdi.addSubWindow(self.__descriptionSingleton)

    #get
    def Mdi(self):
        return self.__mdiSingleton
    #get
    def Diapo(self):
        return self.__diapoSingleton
    #get
    def BandeImages(self):
        return self.__bandeSingleton
    #get
    def Description(self):
        return self.__descriptionSingleton

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
        cls.Singleton().Mdi().showFullScreen()
        for aWidget in cls.Singleton().Mdi().subWindows:
            aWidget.show()