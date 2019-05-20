############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
# Project:       Movidius NCS1 Classifier
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Movidius NCS1 Classifier Movidius Class
# Description:   Movidius NCS1 functions for the AML/ALL Detection System Movidius NCS1
#                Classifier.
# License:       MIT License
# Last Modified: 2019-05-09
#
# NCS1 API:      https://movidius.github.io/ncsdk/ncapi/ncapi1/py_api/readme.html
#
############################################################################################

import os
import json
import cv2

from mvnc import mvncapi as mvnc

from Classes.Helpers import Helpers


class Movidius():
    """ AML/ALL Detection System Movidius NCS1 Classifier Movidius Class

    Movidius NCS1 functions for the AML/ALL Detection System Movidius NCS1
    Classifier.
    """

    def __init__(self):
        """ Initializes the Movidius NCS1 Classifier Movidius Class """

        self.Helpers = Helpers("Movidius")
        self.confs = self.Helpers.confs

        self.classes = []
        self.ncsGraph = None
        self.ncsDevice = None
        self.reqsize = None

        self.mean = 128
        self.std = 1 / 128

        #mvnc.SetGlobalOption(mvnc.GlobalOption.LOG_LEVEL, 2)

        self.Helpers.logger.info("Movidius class initialization complete.")

    def checkNCS(self):
        """ Checks for NCS devices

        Returns True if devices are found else quits """

        ncsDevices = mvnc.EnumerateDevices()

        if len(ncsDevices) == 0:
            self.Helpers.logger.error("No NCS1 devices found.")
            quit()

        self.ncsDevice = mvnc.Device(ncsDevices[0])
        self.ncsDevice.OpenDevice()

        self.Helpers.logger.info("Connected To NCS1 successfully.")

        return True

    def allocateGraph(self, graphfile):
        """ Allocate a graph using path to graph file  """

        self.ncsGraph = self.ncsDevice.AllocateGraph(graphfile)
        self.Helpers.logger.info("Movidius graph allocated successfully.")

    def loadInception(self):
        """ Loads the Inception graph and classes """

        self.reqsize = self.confs["Classifier"]["ImageSize"]

        with open(self.confs["Classifier"]["NetworkPath"] + self.confs["Classifier"]["InceptionGraph"], mode='rb') as f:
            ncsGraphFile = f.read()

        self.allocateGraph(ncsGraphFile)

        with open(self.confs["Classifier"]["DatasetDir"] + "/" + self.confs["Classifier"]["Classes"], 'r') as f:
            for line in f:
                cat = line.split('\n')[0]
                if cat != 'classes':
                    self.classes.append(cat)
            f.close()

        self.Helpers.logger.info("Inception loaded successfully.")
