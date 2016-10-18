#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys

from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *
from windows.classes.vector2D import *


#fenêtre diaporama
class CBandeImages(QWidget):
	def __init__(self):
		QWidget.__init__(self)
		self.__windowStruct = appWindow()
		#différencier la fenêtre des images
		self.imgLabelList = []
		self.marges = vector2D(5,5) #(X horizontale,Y verticale) a changer par la suite
		#Y correspond a la marge au dessus des images
		#X correspond a la marge entre les images
	
	
	#get
	def WindowStruct(self):
		return self .__windowStruct
	
	
	#mise à l'échelle des composants
	def ScaleContent(self):
		TailleFenetre = self.WindowStruct().Size()
		TailleImg = vector2D()
		TailleImg.Y(TailleFenetre.Y() - (2 * self.marges.Y()))
		TailleImg.X((TailleImg.Y() / 9) * 16)
		PosImg = vector2D()
		PosImg.X(0)
		PosImg.Y(0)
		#positionner toutes les images
		for aLabel in self.imgLabelList:
			aLabel.setGeometry(PosImg.X(), PosImg.Y(), TailleImg.X() + self.marges.X(), TailleImg.Y() + self.marges.Y())
			PosImg.X(PosImg.X() + TailleImg.X() + self.marges.X() * 2)
	
	
	#toutes les images qui vont apparaître dans la barre
	def Update (self, pList, pStep):
		self.imgLabelList = []
		for aPicture in pList:
			aLabel = QLabel("", self)
			aImage = QPixmap(aPicture.Path())
			aLabel.setPixmap(aImage)
			self.imgLabelList.append(aLabel)
			aLabel.setScaledContents(True)
			self.ScaleContent()
	
	
	
	
	
	
	
	
	