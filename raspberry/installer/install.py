#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import get_pip
import os

#verification de l'absence de la librairie
try:
    import get_PyQt5
    print("PyQt5 est déja installé")
except:
    print("Le package PyQt5 est manquant")
    print("installation du package PyQt5 en cours")

    #execution d'une commande shell pour installer la librairie
    try:
        os.system("sudo apt install python3-pyqt5")
    except:
        print("Echec de l'installation de PyQt5, veuillez vérifier votre connexion internet et contacter le développeur")
    
    #verification de la réussite de l'installation'
    try:
        import get_PyQt5
        print("PyQt5 à bien été installé")
    except:
        print("Echec de l'installation de PyQt5, veuillez vérifier votre connexion internet et contacter le développeur")
    