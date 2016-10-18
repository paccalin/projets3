#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys


from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre diaporama
class CBandeImages(QWidget):
    def __init__(self):
        QWidget.__init__(self)
        self.__windowStruct = appWindow()
    
    #get
    def WindowStruct(self):
        return self.__windowStruct

    def ScaleContent(self):
        print("Fonction non implémentée")

    def Update(self, pImgList, pStep):
        print("Fonction non implémentée")