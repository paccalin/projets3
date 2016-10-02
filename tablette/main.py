#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
from PyQt5.QtGui import *
from windows.WMain import *
from windows.classes.MdiContent import *
from windows.classes.appWindow import *
from appdata.picture import *

app = QApplication(sys.argv)
MdiContent.Singleton(WMain())
appWindow.CaltulateStruct(MdiContent.Singleton().WindowList())
appWindow.SetStruct(MdiContent.Singleton().WindowList())
MdiContent.StartGui()
sys.exit(app.exec_())