#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
from PyQt5.QtGui import *
from windows.WMain import *
from windows.classes.MdiContent import *
from windows.classes.diapoData import *
from windows.classes.appWindow import *
from appdata.picture import *
from appdata.vehicle import *

app = QApplication(sys.argv)
MdiContent.Singleton(WMain())
diapoData.Singleton().ImgList(picture.FindAll())
appWindow.CaltulateStruct(MdiContent.Singleton().WindowList())
appWindow.SetStruct(MdiContent.Singleton().WindowList())
diapoData.Singleton().UpdateDiapo()
MdiContent.StartGui()
sys.exit(app.exec_())