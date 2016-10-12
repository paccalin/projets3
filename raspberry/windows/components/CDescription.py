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
		#Création de plusieurs QLabel, qui permettent d'afficher du texte sur la fenêtre
        self.windowSize = self.__windowStruct.Size()
        self.labeltitre = QLabel("Description du produit", self)
        self.labelMarque = QLabel("Marque", self)
        self.labelModele = QLabel("Modele", self)
        self.labelOption = QLabel ("Options :", self)
    
    #get
    def WindowStruct(self):
        return self.__windowStruct
    #mise à l'échelle des composants
    def ScaleContent(self):
        windowSize = self.__windowStruct.Size()
        self.labeltitre.move(0.25*windowSize.X(),0.05*windowSize.Y())
        self.labeltitre.show()
        self.labelMarque.move(0.25*windowSize.X(),0.15*windowSize.Y())
        self.labelMarque.show()
        self.labelModele.move(0.60*windowSize.X(),0.15*windowSize.Y())
        self.labelModele.show()
        self.labelOption.move(0.40*windowSize.X(), 0.30*windowSize.Y())
        self.labelOption.show()

    def Update(self, pImg):
        windowSize = self.__windowStruct.Size()
        currentVehicle = pImg.Vehicle()
        if (currentVehicle==None):
            self.labelTest=QLabel("Il n'y a rien à afficher pour le moment", self)
            self.labelTest.move(0.05*windowSize.X(),0.40*windowSize.Y())
            self.labelTest.show()
        else:
            self.labelLibelle = QLabel(" " + currentVehicle.model().libelle(), self)
            self.labelLibelle.move(0.25*windowSize.X(),0.50*windowSize.Y())
            self.labelLibelle.show()
            self.labelMarque.setText(" " + currentVehicle.manufacturer())
            self.labelModele.setText(" " + currentVehicle.model())
        
