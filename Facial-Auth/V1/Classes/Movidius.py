############################################################################################
#
# The MIT License (MIT)
# 
# Acute Myeloid Leukemia Detection System 
# Copyright (C) 2018 Adam Milton-Barker (AdamMiltonBarker.com)
# 
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
# 
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
# 
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.
#
# Title:         Movidius Helper Class
# Description:   Movidius helper functions for the Acute Myeloid Leukemia Detection System.
# Configuration: required/confs.json
# Last Modified: 2018-12-09
#
############################################################################################

import os, json, cv2

from mvnc import mvncapi as mvnc

from Classes.Helpers import Helpers

class Movidius():

    ###############################################################
    #
    # Movidius helper functions
    #
    ###############################################################
    
    def __init__(self, LogPath):
        
        ###############################################################
        # 
        # Sets up all default requirements and placeholders
        #
        ###############################################################
         
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(LogPath+"/Movidius")

        self.ncsDevices = None
        self.ncsDevice = None
        
    def checkNCS(self):
        
        ###############################################################
        #
        # Checks for NCS devices and returns True if devices are fol
        #
        ###############################################################

        #mvnc.SetGlobalOption(mvnc.GlobalOption.LOG_LEVEL, 2)
        self.ncsDevices = mvnc.EnumerateDevices()
        
        if len(self.ncsDevices) == 0:
            self.Helpers.logMessage(self.LogFile, "Movdius", "Status", "No NCS devices found, TASS exiting!")
            quit()
            
        self.ncsDevice = mvnc.Device(self.ncsDevices[0])
        self.ncsDevice.OpenDevice()
        
        self.Helpers.logMessage(self.LogFile, "Movdius", "Status", "Connected To NCS")

    def allocateGraph(self, graphfile):
        
        ###############################################################
        #
        # Checks for NCS devices and returns True if devices are fol
        #
        ###############################################################

        self.Graph = self.ncsDevice.AllocateGraph(graphfile)
        
        self.Helpers.logMessage(self.LogFile, "Movdius", "Status", "Graph Allocated")