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
# Title:         Security Server
# Description:   Serves a Facenet classifier on a local API.
# Configuration: required/Configuration.json
# Last Modified: 2018-12-09
#
# Usage:
#
#   $ python3.5 Server.py
#
############################################################################################

import os, sys, cv2, jsonpickle

import numpy as np

from Tools.Helpers import Helpers
from Tools.Configuration import Configuration
from Tools.Movidius import Movidius
from Tools.Facenet import Facenet

from flask import Flask, request, Response

class Server():

    ###############################################################
    #
    # Initiates Facial Identification Server.
    #
    ###############################################################

    def __init__(self):

        ###############################################################
        #
        # Sets up all default requirements and placeholders 
        # needed for the program to run. 
        #
        ###############################################################

        # Server setup
        self.Helpers = Helpers()
        self.Configuration = Configuration()
        self.LogFile = self.Helpers.setLogFile(self.Configuration.AiCore["Logs"]+"/Server")
        
        # Movidius setup 
        self.Movidius = Movidius(self.Configuration.AiCore["Logs"])
        self.Movidius.checkNCS()
        self.ValidDir   = self.Configuration.Classifier["NetworkPath"] + self.Configuration.Classifier["ValidPath"]
        self.TestingDir = self.Configuration.Classifier["NetworkPath"] + self.Configuration.Classifier["TestingPath"]
        
        self.Helpers.logMessage(self.LogFile,
                                "TASS Server",
                                "STATUS",
                                "Movidius configured")

        # Facenet setup
        self.Facenet = Facenet(self.Configuration.AiCore["Logs"], self.Configuration)
        self.Movidius.allocateGraph(self.Facenet.LoadGraph())
        self.Facenet.PreprocessKnown(self.ValidDir, self.Movidius.Graph)
        
        self.Helpers.logMessage(self.LogFile,
                                "TASS Server",
                                "STATUS",
                                "Facenet configured")

app = Flask(__name__)
Server = Server()

@app.route('/inference', methods=['POST'])
# Responds to POST requests sent to the /inference API endpoint
def Inference():

    Human = "INTRUDER"
    ServerResponse = None

    # Processes the image looking for faces
    Faces = Server.Facenet.ProcessFrame(np.fromstring(request.data, np.uint8))
 
    if len(Faces) != 0:
        # Loops through processed known images
        for Known in Server.Facenet.Known:
            
            # Times the classification process
            humanInferStart, computerInferStart = Server.Helpers.timerStart()
            Match, Confidence = Server.Facenet.Compare(Known["Score"], Server.Facenet.Infer(Faces[0], Server.Movidius.Graph))
            humanInferEnd, computerInferEnd, humanInferTime = Server.Helpers.timerEnd(computerInferStart)

            Message = ""

            if Match is True: 
                Human = os.path.splitext(Known["File"])[0]
                Message = "Identified " + Human + " with confidence " + str(Confidence) + " in " + str(computerInferStart - computerInferEnd)
                ServerResponse =  jsonpickle.encode({
                                                    'Response': 'KNOWN',
                                                    'Image': Known["File"],
                                                    'Classification': Human,
                                                    'Confidence': Confidence,
                                                    'Message': Message
                                                })
            else:
                Message = "Identified INTRUDER with confidence " + str(Confidence) + " in " + str(computerInferStart - computerInferEnd)
                ServerResponse =  jsonpickle.encode({
                                                    'Response': 'KNOWN',
                                                    'Image': Known["File"],
                                                    'Classification': Human,
                                                    'Confidence': Confidence,
                                                    'Message': Message
                                                })

            Server.Helpers.logMessage(Server.LogFile,
                                        "TASS Server",
                                        "CLASSIFICATION",
                                        Message)

            return Response(response=ServerResponse, status=200, mimetype="application/json") 

    else:

        ServerResponse =  jsonpickle.encode({
                                            'Response': 'FAILED',
                                            'Image': 'NA',
                                            'Classification': "NA",
                                            'Confidence': "NA",
                                            'Message': "No face detected in image!"
                                        })

        return Response(response=ServerResponse, status=400, mimetype="application/json")

    #Server.Movidius.Graph.DeallocateGraph()
    #Server.Movidius.ncsDevice.CloseDevice()

if __name__ == "__main__":
    app.run(host=Server.Configuration.Cameras[0]["API"]["IP"], port=Server.Configuration.Cameras[0]["API"]["Port"])
