#!/usr/bin/env python
# -*- coding: utf-8 -*-

from PyQt5.QtCore import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *
from windows.classes.vector2D import *

#MDI class
class WMain(QMainWindow):
    def __init__(self):
        super().__init__()
        self.__windowStruct = appWindow()
        self.subWindows = []
        self.initUI()
        self.setCentralWidget(self.mdi)

    #get
    def WindowStruct(self):
        return self.__windowStruct

    def initUI(self):
        self.setWindowTitle('Projet ShowRoom')
        self.mdi = QMdiArea()
        self.setCentralWidget(self.mdi)

    def keyPressEvent(self, e):

        if e.key() == Qt.Key_Escape:
            self.close()
