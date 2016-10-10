#!/usr/bin/env python
# -*- coding: utf-8 -*-

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
            self.__onTop = pOnTop

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
                if(targetStruct.OnTop() and targetStruct.BorderLess()):
                    aWindow.setWindowFlags(Qt.WindowStaysOnTopHint | Qt.FramelessWindowHint)
                elif(targetStruct.OnTop()):
                    aWindow.setWindowFlags(Qt.WindowStaysOnTopHint)
                elif(targetStruct.BorderLess()):
                    aWindow.setWindowFlags(Qt.FramelessWindowHint)
                aWindow.widget().ScaleContent()

            aWindow.setGeometry(
                targetStruct.Pos().X(), targetStruct.Pos().Y(), 
                targetStruct.Size().X(), targetStruct.Size().Y())



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

        #calcul de la structure du header
        headerStruct = pWindowList["header"].widget().WindowStruct()
        headerStruct.Pos(vector2D(0, 0))
        headerSize = vector2D(
            mdiStruct.Size().X(),    
            mdiStruct.Size().Y()*0.1)
        headerSize.Floor()
        headerStruct.Pos(vector2D(0, 0))
        headerStruct.Size(headerSize)
        headerStruct.OnTop(False)
        headerStruct.BorderLess(True)

        #calcul de la structure du menu
        menuStructGlobal = pWindowList["menu"].widget().Struct()
        menuWidth = 0
        if(mdiStruct.Size().X() >= 500):
            menuWidth = 500
        else:
            menuWidth = mdiStruct.Size().X()

        menuStructGlobal["open"].Pos(
            vector2D(mdiStruct.Size().X()-menuWidth, 0))
        menuStructGlobal["hidden"].Pos(
            vector2D(mdiStruct.Size().X(), 0))

        for anIndex, aStruct in menuStructGlobal.items():
            aStruct.Size(vector2D(menuWidth, mdiStruct.Size().Y()))
            aStruct.OnTop(True)
            aStruct.BorderLess(True)

        #calcul de la structure du boutton de menu
        menuButtonStructGlobal = pWindowList["menuButton"].widget().Struct()
        menuButtonStructGlobal["hidden"].Pos(vector2D(
            headerStruct.Size().X() - headerStruct.Size().Y(),
            headerStruct.Pos().Y()))
        menuButtonStructGlobal["open"].Pos(vector2D(
            headerStruct.Size().X() - headerStruct.Size().Y() - menuWidth,
            headerStruct.Pos().Y()))

        for anIndex, aStruct in menuButtonStructGlobal.items():
            aStruct.OnTop(True)
            aStruct.BorderLess(True)
            aStruct.Size(vector2D(
                headerStruct.Size().Y(),
                headerStruct.Size().Y()))
