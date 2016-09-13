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
		#Création d'un QLabel, qui permet d'afficher du texte sur la fenêtre, puis positionnement et dimensionnement de celui-ci
        self.label = QLabel("Informations", self)
        self.label.setGeometry(, , , )
		self.show()
		
		#Affichage de la description suivant l'objet
		
		