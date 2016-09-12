#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
from PyQt5.QtGui import *
from windows.WMain import *
from windows.classes.MdiContent import *
from windows.classes.appWindow import *
from windows.classes.diapoData import *

app = QApplication(sys.argv)
MdiContent.Singleton(WMain())
appWindow.CaltulateStruct()
appWindow.SetStruct()
diapoData.Singleton()
MdiContent.StartGui()
sys.exit(app.exec_())