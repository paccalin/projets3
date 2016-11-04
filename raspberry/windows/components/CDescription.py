#!/usr/bin/env python
# -*- coding: utf-8 -*-


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
        self.labelMarque = QLabel("Marque", self)
        self.labelModele = QLabel("Modele", self)
        self.labelOption = QLabel ("Options :", self)
        self.labelOptionList = []
        self.labelVide = QLabel("Il n'y a rien à afficher pour le moment", self)
    
    #get
    def WindowStruct(self):
        return self.__windowStruct
    #mise à l'échelle des composants
    def ScaleContent(self):
        windowSize = self.__windowStruct.Size()
        self.labelMarque.move(0.25*windowSize.X(),0.05*windowSize.Y())
        self.labelModele.move(0.60*windowSize.X(),0.05*windowSize.Y())
        self.labelOption.move(0.40*windowSize.X(), 0.30*windowSize.Y())
        

    def Update(self, pImg):
        windowSize = self.__windowStruct.Size()
        currentVehicle = pImg.Vehicle()
        if (currentVehicle==None):
            self.labelVide.move(0.05*windowSize.X(),0.40*windowSize.Y())
        else:
            self.labelVide.hide()
            options = currentVehicle.OptionList()
            labelSize = self.labelMarque.height()
            i = 0
            for anOption in options:
                aLabel = QLabel("", self)
                aLabel.setText(anOption.Libelle())
                aLabel.move(0.25*windowSize.X(),0.50*windowSize.Y() + i * labelSize)
                self.labelOptionList.append(aLabel)
                i += 1
            self.labelMarque.setText(" " + currentVehicle.Model().Manufacturer().Libelle())
            self.labelModele.setText(" " + currentVehicle.Model().Libelle())

        