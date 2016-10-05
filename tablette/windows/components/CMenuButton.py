#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys

from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre Boutton du menu
class CMenuButton(QWidget):
    def __init__(self):
        QWidget.__init__(self)
        self.__windowStruct = appWindow()
        self.__buttonLabel = QLabel("", self)
        self.__buttonLabel.setScaledContents(True)

    #get
    def WindowStruct(self):
        return self.__windowStruct

    def ScaleContent(self):
        self.__buttonLabel.setGeometry(
            0, 0, 
            self.__windowStruct.Size().X(), self.__windowStruct.Size().Y())
        image = QPixmap("pictures/menuIcon.png")
        self.__buttonLabel.setPixmap(image)