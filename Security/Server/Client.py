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
# Title:         Facial Identification Client
# Description:   Sends images to the Facial Identification Server.
# Configuration: required/Configuration.json
# Last Modified: 2018-12-09
#
# Usage:
#
#   $ python3.5 Client.py Test
#   $ python3.5 Client.py Send PathToImage
#
############################################################################################

import os, sys

import requests, json, cv2, time

from Tools.Helpers import Helpers
from Tools.Configuration import Configuration

class Client():

    ###################################################################
    #
    # Sends single or multiple images to Facial Identification Server.
    #
    ###################################################################

    def __init__(self):

        ###############################################################
        #
        # Sets up all default requirements and placeholders 
        # needed for the program to run. 
        #
        ###############################################################

        # Client setup
        self.Helpers = Helpers()
        self.Configuration = Configuration()
        self.LogFile = self.Helpers.setLogFile(self.Configuration.AiCore["Logs"]+"/Client")

        # Request setup
        self.addr = "http://"+self.Configuration.Cameras[0]["API"]["IP"]+':'+str(self.Configuration.Cameras[0]["API"]["Port"]) + '/inference'
        self.headers = {'content-type': 'image/jpeg'}
                    
    def send(self, imagePath):

        ###############################################################
        #
        # Sends image to the inference API endpoint.
        #
        ###############################################################

        img = cv2.imread(imagePath)
        _, img_encoded = cv2.imencode('.png', img)
        response = requests.post(self.addr, data = img_encoded.tostring(), headers = self.headers)
        response = json.loads(response.text)
        self.Helpers.logMessage(self.LogFile,
                                "TASS Server",
                                "CLASSIFICATION",
                                imagePath + ": " + response["Message"])

    def test(self): 

        ###############################################################
        #
        # Loops through all images in the testing directory and sends 
        # them to the inference API endpoint.
        #
        ###############################################################

        testingDir  = self.Configuration.Classifier["NetworkPath"] + self.Configuration.Classifier["TestingPath"] + "/"

        for test in os.listdir(testingDir):
            if os.path.splitext(test)[1] in self.Configuration.Classifier["ValidIType"]:
                self.send(testingDir+test)

if __name__ == "__main__":
    
    Client = Client()

    if sys.argv[1] == "Test": 

        ###############################################################
        #
        # Sends all images in the Testing directory.
        #
        ###############################################################

        Client.test()

    elif sys.argv[1] == "Send":

        ###############################################################
        #
        # Sends a single image, path for image is sent as argument 2.
        #
        ###############################################################

        Client.send(sys.argv[2])



