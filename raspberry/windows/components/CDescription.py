#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys


from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre diaporama
class CDescription(QWidget):
    def __init__(self):
        QWidget.__init__(self)
        self.__windowStruct = appWindow()
		
		#Création des éléments
		#Création de plusieurs QLabel, qui permettent d'afficher du texte sur la fenêtre, puis positionnement et dimensionnement de celui-ci
        self.windowSize = self.__windowStruct.Size()
        self.labelInformations = QLabel("Vehicule", self)
        self.labelMarque = QLabel("Marque", self)
        self.labelModele = QLabel("Modele", self)
    
    #get
    def WindowStruct(self):
        return self.__windowStruct
    #mise à l'échelle des composants
    def ScaleContent(self):
        self.labelInformations.move(0.5*self.windowSize.X(),0.8*self.windowSize.Y())
        self.labelInformations.show()
        self.labelMarque.move(0.5*self.windowSize.X(),0.6*self.windowSize.Y())
        self.labelMarque.show()
        self.labelModele.move(0.5*self.windowSize.X(),0.4*self.windowSize.Y())
        self.labelModele.show()
		
		