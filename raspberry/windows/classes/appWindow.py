#!/usr/bin/env python
# -*- coding: utf-8 -*-

import math

from windows.classes.vector2D import *
from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *

#permet de structurer les fenêtres enfant de la mdi
class appWindow(object):    
    def __init__(self):
        self.__pos = vector2D(0, 0)
        self.__size = vector2D(0, 0)
        self.__onTop = False
        self.__borderLess = True
    
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


    #applique la structure aux fenêtres
    @classmethod
    def SetStruct(cls, pWindowList):
        for anIndex, aWindow in pWindowList.items():
            if(anIndex == "mdi"):
                targetStruct = aWindow.WindowStruct()
            else:
                targetStruct = aWindow.widget().WindowStruct()
            aWindow.setGeometry(targetStruct.Pos().X(), targetStruct.Pos().Y(), targetStruct.Size().X(), targetStruct.Size().Y())
            if(targetStruct.OnTop() and targetStruct.BorderLess()):
                aWindow.setWindowFlags(Qt.WindowStaysOnTopHint | Qt.FramelessWindowHint)
            elif(targetStruct.OnTop()):
                aWindow.setWindowFlags(Qt.WindowStaysOnTopHint)
            elif(targetStruct.BorderLess()):
                aWindow.setWindowFlags(Qt.FramelessWindowHint)
            if(anIndex != "mdi"):
                aWindow.widget().ScaleContent()


    #calcul de la structure à appliquer
    @classmethod
    def CaltulateStruct(cls, pWindowList):
        #calcul de la structure de la mdi
        mdiStruct = pWindowList["mdi"].WindowStruct()
        screen = QDesktopWidget().screenGeometry()
        screenSize = vector2D(screen.width(), screen.height())
        mdiStruct.Pos(vector2D(0, 0))
        mdiStruct.Size(screenSize)
        mdiStruct.OnTop(False)
        mdiStruct.BorderLess(True)

        #calcul de la structure du diapo
        diapoStruct = pWindowList["diapo"].widget().WindowStruct()
        diapoSize = None
        if(mdiStruct.Size().X() / 16 * 9 <= mdiStruct.Size().Y()):
            diapoSize = vector2D(int(math.floor(mdiStruct.Size().X() * 0.8)), 
                int(math.floor(mdiStruct.Size().X() / 16 * 9 * 0.8)))
        else:
            diapoSize = vector2D(int(math.floor(mdiStruct.Size().Y()*0.8)),
                int(math.floor(mdiStruct.Size().Y() / 9 * 16 * 0.8)))

        diapoStruct.Pos(vector2D(0, 0))
        diapoStruct.Size(diapoSize)
        diapoStruct.OnTop(True)
        diapoStruct.BorderLess(True)
        
        #calcul de la structure de la bande d'images
        bandeImagesStruct = pWindowList["bandeImages"].widget().WindowStruct()
        bandeImagesPos = vector2D(0,diapoSize.Y())
        bandeImagesSize = vector2D(diapoSize.X(),screenSize.Y()-diapoSize.Y())
        bandeImagesStruct.Pos(bandeImagesPos)
        bandeImagesStruct.Size(bandeImagesSize)
        bandeImagesStruct.OnTop(False)
        bandeImagesStruct.BorderLess(False)

        #calcul de la structure de la Description
        descriptionStruct = pWindowList["description"].widget().WindowStruct()
        descriptionPos = vector2D(diapoSize.X(), 0)
        descriptionSize = vector2D(screenSize.X() - diapoSize.X(),screenSize.Y()) 
        descriptionStruct.Pos(descriptionPos)
        descriptionStruct.Size(descriptionSize)
        descriptionStruct.OnTop(False)
        descriptionStruct.BorderLess(True)