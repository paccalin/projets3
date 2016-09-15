#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
from PyQt5.QtGui import *
from windows.WMain import *
from windows.classes.MdiContent import *
from windows.classes.diapoData import *
from windows.classes.appWindow import *

app = QApplication(sys.argv)
MdiContent.Singleton(WMain())
appWindow.CaltulateStruct(MdiContent.Singleton().WindowList())
appWindow.SetStruct(MdiContent.Singleton().WindowList())
diapoData.Singleton()
MdiContent.StartGui()
sys.exit(app.exec_())