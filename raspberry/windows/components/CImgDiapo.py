#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys

from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre diaporama
class CImgDiapo(QWidget):
    def __init__(self):
        QWidget.__init__(self)
        self.__windowStruct = appWindow()
        #permet à la classe appwindow de différencier les différentes fenêtres
        self.__image_files = []
        self.__imgLabel = QLabel("", self)
        self.__imgLabel.setScaledContents(True)

    #get
    def WindowStruct(self):
        return self.__windowStruct
    
    #mise à l'échelle des composants
    def ScaleContent(self):
        self.__imgLabel.setGeometry(
            self.WindowStruct().Pos().X(), self.WindowStruct().Pos().Y(), 
            self.WindowStruct().Size().X(), self.WindowStruct().Size().Y())

    #rafraichissement de l'image affichée
    def Update(self, pPath):
            image = QPixmap(pPath)
            self.__imgLabel.setPixmap(image)

