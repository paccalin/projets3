#!/usr/bin/env python
# -*- coding: utf-8 -*-

class vector2D(object):
    def __init__(self, pX = 0, pY = 0):
        self.__x = pX
        self.__y = pY

    #get/set
    def X(self, pX = None):
        if(pX == None):
            return self.__x
        else:
            self.__x = pX

    #get/set
    def Y(self, pY = None):
        if(pY == None):
            return self.__y
        else:
            self.__y = pY
