#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import math

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
		self.__imgList = []
		self.__imgLabelList = []
		self.__step = None
		self.__marges = vector2D(5,5) #(X horizontale,Y verticale) a changer par la suite
		#Y correspond a la marge au dessus des images
		#X correspond a la marge entre les images
	
	
	#get
	def WindowStruct(self):
		return self .__windowStruct
	
	
	#mise à l'échelle des composants
	def ScaleContent(self):
		TailleFenetre = self.WindowStruct().Size()
		milieuFenetre = math.floor(TailleFenetre.X() / 2)
		TailleImg = vector2D()
		TailleImg.Y(TailleFenetre.Y() - (2 * self.__marges.Y()))
		TailleImg.X((TailleImg.Y() / 9) * 16)
		reminingHalfSize = (TailleFenetre.X() / 2) - (TailleImg.X() / 2) - self.__marges.X()
		nbImageSide = math.floor(reminingHalfSize / (TailleImg.X() - (self.__marges.X() * 2)))
		PosImg = vector2D()
		PosImg.X(milieuFenetre - (TailleImg.X() / 2) - self.__marges.X() - (nbImageSide * (2 * self.__marges.X() + TailleImg.X())))
		PosImg.Y(self.__marges.Y())
		nbImageTot = nbImageSide * 2 + 1
		#positionner toutes les images
		compteur = 0
		if(len(self.__imgLabelList) != 0):
			for aLabel in self.__imgLabelList:
					aLabel.hide()
		self.__imgLabelList = []
		if (len(self.__imgList) >= (nbImageSide * 2 + 1)):
			for i in range(self.__step - nbImageSide, self.__step + nbImageSide +1):
				trueIndex = i
				if(i > len(self.__imgList) -1 ):
					trueIndex = i - len(self.__imgList)
				elif (i < 0):
					trueIndex = len(self.__imgList) + i
				aLabel = QLabel("", self)
				aImage = QPixmap(self.__imgList[trueIndex].Path())
				aLabel.setPixmap(aImage)
				self.__imgLabelList.append(aLabel)
				aLabel.setScaledContents(True)
				PosImg.X(PosImg.X() + self.__marges.X())
				aLabel.setGeometry(
					PosImg.X(),
					PosImg.Y(),
					TailleImg.X(),
					TailleImg.Y())
				PosImg.X(PosImg.X() + TailleImg.X() + self.__marges.X())
				aLabel.show()
				compteur+=1
		
	
	
	#toutes les images qui vont apparaître dans la barre
	def Update (self, pList, pStep):
		self.__step = pStep()
		self.__imgList = pList
		self.ScaleContent()
			
	