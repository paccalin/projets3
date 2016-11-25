#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys

from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre diaporama
class CHeader(QWidget):
    def __init__(self):
        QWidget.__init__(self)
        self.__windowStruct = appWindow()
        self.__logoLabel = QLabel("", self)
        self.__logoLabel.setScaledContents(True)

    #get
    def WindowStruct(self):
        return self.__windowStruct

    def ScaleContent(self):
        #logo
        aviableSpace = vector2D(
            self.__windowStruct.Size().X()-self.__windowStruct.Size().Y() - 20,
            self.__windowStruct.Size().Y() - 20)
        logoPos = vector2D(10, 10)
        logoSize = None
        #format logo w=648 h=71
        if(aviableSpace.X() / 648 * 71 <= aviableSpace.Y()):
            logoSize = vector2D(aviableSpace.X(),
                aviableSpace.X() / 648 * 71)
        else:
            logoSize = vector2D(aviableSpace.Y() / 71 * 648,
                aviableSpace.Y())
        
        logoSize.Floor()
        self.__logoLabel.setGeometry(logoPos.X(), logoPos.Y(), logoSize.X(), logoSize.Y())
        image = QPixmap("pictures/logo.png")
        self.__logoLabel.setPixmap(image)