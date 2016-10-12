#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from PyQt5.QtCore import *
from appdata.picture import *
from windows.classes.MdiContent import *
from windows.classes.appWindow import *
import datetime

class diapoData(QWidget):
    __classSingleton = None

    #!ne pas instancier cette classe manuellement
    #constructeur du singleton
    def __init__(self):
        QWidget.__init__(self)
        self.__no_image = picture("pictures/no-image.png", None, datetime.datetime.now())
        self.__imgList = [self.__no_image]
        self.__step = 0
        self.timer = QBasicTimer()
        self.__delay = 100  # milliseconds
        self.timerEvent()

    #get/set
    def ImgList(self, pList = None):
        if(pList == None):
            return self.__imgList
        else:
            if(len(pList) != 0):
                self.__imgList = pList
            else:
                self.__imgList = [self.__no_image]
            appWindow.SetStruct(MdiContent.Singleton().WindowList())
    
    #get/set
    def Step(self, pStep = None):
        if(pStep == None):
            return self.__step
        else:
            if(pStep < 0 or pStep >= len(self.__imgList)):
                print("index out of range in diapoData step setter")
            else:
                self.__step = pStep
        

    #methode déclenchée par le timer
    def timerEvent(self, e=None):
        if self.__step >= len(self.__imgList):
            self.__step = 0
        self.timer.start(self.__delay, self)
        MdiContent.Singleton().WindowList()["diapo"].widget().Update(self.__imgList[self.__step].Path())
        MdiContent.Singleton().WindowList()["bandeImages"].widget().Update(self.__imgList, self.Step)
        MdiContent.Singleton().WindowList()["description"].widget().Update(self.__imgList[self.__step])
        self.__step += 1

    #gestion de la création du singleton
    @classmethod 
    def Singleton(cls):
        if(cls.__classSingleton == None):
            cls.__classSingleton = diapoData()
        return cls.__classSingleton
