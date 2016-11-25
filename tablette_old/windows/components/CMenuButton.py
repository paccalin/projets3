#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys

from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre Boutton du menu
class CMenuButton(QWidget):
    def __init__(self, pShowMenuFunction):
        QWidget.__init__(self)
        self.__struct = {}
        self.__struct["open"] = appWindow()
        self.__struct["hidden"] = appWindow()
        self.__windowStruct = self.__struct["hidden"]
        self.__isOpen = False
        self.__buttonLabel = QLabel("", self)
        self.__buttonLabel.setScaledContents(True)
        self.__showMenuFunction = pShowMenuFunction
        self.mouseReleaseEvent=self.OnClick

    #get
    def WindowStruct(self):
        return self.__windowStruct
    
    #get
    def Struct(self):
        return self.__struct 

    def ScaleContent(self):
        self.__buttonLabel.setGeometry(
            0, 0, 
            self.__windowStruct.Size().X(), self.__windowStruct.Size().Y())
        image = QPixmap("pictures/menuIcon.png")
        self.__buttonLabel.setPixmap(image)

    #action à effectuer lors du click (ouverture du menu)
    def OnClick(self, event):
        if(self.__isOpen):
            self.__showMenuFunction(False)
            self.__isOpen = False            
        else:
            self.__showMenuFunction(True)
            self.__isOpen = True

    #fonction d'affichage du menu
    def Show(self):
        #animation = QPropertyAnimation(self, "geometry".encode('utf-8'))
        #animation.setDuration(1000)
        #animation.setStartValue(QRect(
        #    self.Struct()["hidden"].Pos().X(), self.Struct()["hidden"].Pos().Y(), 
        #    self.Struct()["hidden"].Size().X(), self.Struct()["hidden"].Size().Y()))
        #animation.setEndValue(QRect(
        #    self.Struct()["open"].Pos().X(), self.Struct()["open"].Pos().Y(), 
        #    self.Struct()["open"].Size().X(), self.Struct()["open"].Size().Y()))
        #animation.start()
        self.__windowStruct = self.Struct()["open"]

    #fonction de cachage du menu
    def Hide(self):
        #animation = QPropertyAnimation(self, "geometry".encode('utf-8'))
        #animation.setDuration(1000)
        #animation.setStartValue(QRect(
        #    self.Struct()["open"].Pos().X(), self.Struct()["open"].Pos().Y(), 
        #    self.Struct()["open"].Size().X(), self.Struct()["open"].Size().Y()))
        #animation.setEndValue(QRect(
        #    self.Struct()["hidden"].Pos().X(), self.Struct()["hidden"].Pos().Y(), 
        #    self.Struct()["hidden"].Size().X(), self.Struct()["hidden"].Size().Y()))
        #animation.start()
        self.__windowStruct = self.Struct()["hidden"]