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
        #permet à la classe appwindow de différencier les différentes fenêtres
        self.__image_files = []
        self.imgLabel = QLabel("", self)
        self.imgLabel.setScaledContents(True)
    
    #rafraichissement de l'image affichée
    def ShowImg(self, pPath):
            image = QPixmap(pPath)
            self.imgLabel.setPixmap(image)

