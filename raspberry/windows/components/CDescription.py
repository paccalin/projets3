#!/usr/bin/env python
# -*- coding: utf-8 -*-

import math

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
        self.__labelMarque = QLabel("Marque", self)
        self.__labelModele = QLabel("Modele", self)
        self.__labelOption = QLabel ("Options :", self)
        self.__labelOptionList = []
        self.labelVide = QLabel("Il n'y a rien à afficher pour le moment", self)
    
    #get
    def WindowStruct(self):
        return self.__windowStruct
    #mise à l'échelle des composants
    def ScaleContent(self):
        windowSize = self.__windowStruct.Size()
        marqueModelWidth = self.__labelMarque.width() + self.__labelModele.width()
        startingPosX = math.floor((windowSize.X() - marqueModelWidth) / 2)
        self.__labelMarque.move(startingPosX,0.05*windowSize.Y())
        self.__labelModele.move(startingPosX + self.__labelMarque.width(),0.05*windowSize.Y())
        self.__labelOption.move(0.40*windowSize.X(), 0.30*windowSize.Y())

        labelHeight = self.__labelMarque.height()
        startingPosY = 0.30*windowSize.Y() + 2 * labelHeight
        for aLabel in self.__labelOptionList:
            aLabel.move(0.25*windowSize.X(), startingPosY)
            aLabel.show()
            startingPosY += labelHeight
        

    def Update(self, pImg):
        windowSize = self.__windowStruct.Size()
        currentVehicle = pImg.Vehicle()
        if (currentVehicle==None):
            self.labelVide.move(0.05*windowSize.X(),0.40*windowSize.Y())
        else:
            if (len(self.__labelOptionList) != 0):
                for aLabel in self.__labelOptionList:
                    aLabel.hide()
            self.__labelOptionList = []
            self.labelVide.hide()
            options = currentVehicle.OptionList()
            for anOption in options:
                aLabel = QLabel("", self)
                aLabel.setText("- " + anOption.Libelle())
                self.__labelOptionList.append(aLabel)
            self.__labelMarque.setText(currentVehicle.Model().Manufacturer().Libelle() + "  ")
            self.__labelModele.setText(currentVehicle.Model().Libelle())
        self.ScaleContent()

        