#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys


from PyQt5.QtCore import *
from PyQt5.QtGui import *
from PyQt5.QtWidgets import *
from windows.classes.appWindow import *

#fenêtre diaporama
class CBandeImage(QWidget):
    def __init__(self):
        QWidget.__init__(self)
        self.__windowStruct = appWindow()

    def ScaleContent(self):
        #lol