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
		
		#Création des éléments
		#Création de plusieurs QLabel, qui permettent d'afficher du texte sur la fenêtre, puis positionnement et dimensionnement de celui-ci

        labelInformations = QLabel("Vehicule", self)
        labelInformations.move(0.5*WindowList()["description"].Size().X(),0.8*WindowList()["description"].Size().Y())
        labelInformations.show()

        labelMarque = QLabel("Marque", self)
        labelMarque.move(0.5*WindowList()["description"].Size().X(),0.6*WindowList()["description"].Size().Y())
        labelMarque.show()

        labelModele = QLabel("Modele", self)
        labelModele.move(0.5*WindowList()["description"].Size().X(),0.4*WindowList()["description"].Size().Y())
        labelModele.show()

        appWindow::WindowList()["description"].Size().Y()
        appWindow::WindowList()["description"].Size().X()
		
		#Affichage de la description suivant l'objet
		
		