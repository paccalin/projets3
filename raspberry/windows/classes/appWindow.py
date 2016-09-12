#!/usr/bin/env python
# -*- coding: utf-8 -*-

import math

from windows.classes.vector2D import *
from windows.classes.MdiContent import *
from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *

#permet de structurer les fenêtres enfant de la mdi
class appWindow(object):

    __windowList = {}
    
    def __init__(self, pTargetWindow):
        self.__targetWindow = pTargetWindow
        self.__pos = vector2D(0, 0)
        self.__size = vector2D(0, 0)
        self.__onTop = False
        self.__borderLess = True
    
    #get
    def TargetWindow(self):
        return self.__targetWindow
    
    #get/set
    def Pos(self, pPos=None):
        if(pPos == None):
            return self.__pos
        else:
            self.__pos = pPos

    #get/set
    def Size(self, pSize=None):
        if(pSize == None):
            return self.__size
        else:
            self.__size = pSize

    #get/set
    def OnTop(self, pOnTop=None):
        if(pOnTop == None):
            return self.__onTop
        else:
            self.__onTop == pOnTop

    #get/set
    def BorderLess(self, pBorderless=None):
        if(pBorderless == None):
            return self.__borderLess
        else:
            self.__borderLess = pBorderless
    
    @classmethod
    def __load(cls):
        cls.__windowList = {"mdi": appWindow(MdiContent.Singleton().Mdi),
            "diapo": appWindow(MdiContent.Singleton().Diapo),
            "bandeImages": appWindow(MdiContent.Singleton().BandeImages),
            "description": appWindow(MdiContent.Singleton().Description)}


    #applique la structure aux fenêtres
    @classmethod
    def SetStruct(cls):
        for anIndex, aWindow in cls.__windowList.items():
            targetWindow = aWindow.TargetWindow()
            targetWindow().setGeometry(aWindow.Pos().X(), aWindow.Pos().Y(), aWindow.Size().X(), aWindow.Size().Y())
            if(aWindow.OnTop() and aWindow.BorderLess()):
                targetWindow().setWindowFlags(Qt.WindowStaysOnTopHint | Qt.FramelessWindowHint)
            elif(aWindow.OnTop()):
                targetWindow().setWindowFlags(Qt.WindowStaysOnTopHint)
            elif(aWindow.BorderLess()):
                targetWindow().setWindowFlags(Qt.FramelessWindowHint)
            if(anIndex == "diapo"):
                targetWindow().widget().imgLabel.setGeometry(aWindow.Pos().X(), aWindow.Pos().Y(), aWindow.Size().X(), aWindow.Size().Y())


    #calcul de la structure à appliquer
    @classmethod
    def CaltulateStruct(cls):
        cls.__load()
        #calcul de la structure de la mdi
        screen = QDesktopWidget().screenGeometry()
        screenSize = vector2D(screen.width(), screen.height())
        cls.__windowList["mdi"].Pos(vector2D(0, 0))
        cls.__windowList["mdi"].Size(screenSize)
        cls.__windowList["mdi"].OnTop(False)
        cls.__windowList["mdi"].BorderLess(True)

        #calcul de la structure du diapo
        diapoSize = None
        if(cls.__windowList["mdi"].Size().X() / 16 * 9 <= cls.__windowList["mdi"].Size().Y()):
            diapoSize = vector2D(int(math.floor(cls.__windowList["mdi"].Size().X() * 0.8)), 
                int(math.floor(cls.__windowList["mdi"].Size().X() / 16 * 9 * 0.8)))
        else:
            diapoSize = vector2D(int(math.floor(cls.__windowList["mdi"].Size().Y()*0.8)),
                int(math.floor(cls.__windowList["mdi"].Size().Y() / 9 * 16 * 0.8)))

        cls.__windowList["diapo"].Pos(vector2D(0, 0))
        cls.__windowList["diapo"].Size(diapoSize)
        cls.__windowList["diapo"].OnTop(True)
        cls.__windowList["diapo"].BorderLess(True)
        
        #calcul de la structure de la bande d'images
        bandeImagesPos = vector2D(0,diapoSize.Y())
        bandeImagesSize = vector2D(diapoSize.X(),screenSize.Y()-diapoSize.Y())
        cls.__windowList["bandeImages"].Pos(bandeImagesPos)
        cls.__windowList["bandeImages"].Size(bandeImagesSize)
        cls.__windowList["bandeImages"].OnTop(False)
        cls.__windowList["bandeImages"].BorderLess(False)

        #calcul de la structure de la Description
        descriptionPos = vector2D(diapoSize.X(), 0)
        descriptionSize = vector2D(screenSize.X() - diapoSize.X(),screenSize.Y()) 
        cls.__windowList["description"].Pos(descriptionPos)
        cls.__windowList["description"].Size(descriptionSize)
        cls.__windowList["description"].OnTop(False)
        cls.__windowList["description"].BorderLess(False)