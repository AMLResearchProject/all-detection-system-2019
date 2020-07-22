############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Facial Authentication Server
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Movidius Class
# Description:   Movidius class for the ALL Detection System 2019 Facial Authentication Server.
# License:       MIT License
# Last Modified: 2020-07-16
#
############################################################################################

import os, json, cv2

from mvnc import mvncapi as mvnc

from Classes.Helpers import Helpers


class Movidius():
    """ ALL Detection System 2019 Movidius Class

    Movidius helper functions for the ALL Detection System 2019 Facial Authentication Server project. 
    """
    
    def __init__(self, LogPath):
        """ Initializes the Movidius class. """
         
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(LogPath+"/Movidius")

        self.ncsDevices = None
        self.ncsDevice = None
        
    def checkNCS(self):
        """ Checks for NCS devices and returns True if devices are found. """

        self.ncsDevices = mvnc.EnumerateDevices()
        
        if len(self.ncsDevices) == 0:
            self.Helpers.logMessage(self.LogFile, "Movdius", "Status", "No NCS devices found, TASS exiting!")
            quit()
            
        self.ncsDevice = mvnc.Device(self.ncsDevices[0])
        self.ncsDevice.OpenDevice()
        
        self.Helpers.logMessage(self.LogFile, "Movdius", "Status", "Connected To NCS")

    def allocateGraph(self, graphfile):
        """ Allocates the NCS graph. """

        self.Graph = self.ncsDevice.AllocateGraph(graphfile)
        
        self.Helpers.logMessage(self.LogFile, "Movdius", "Status", "Graph Allocated")
