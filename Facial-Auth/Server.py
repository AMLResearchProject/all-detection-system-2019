############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Facial Authentication Server
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Server Class
# Description:   Serves a Facenet classifier on a local API for facial identification.
# License:       MIT License
# Last Modified: 2020-07-14
#
############################################################################################

import os, sys, cv2, jsonpickle

import numpy as np

from Classes.Helpers import Helpers
from Classes.Movidius import Movidius
from Classes.Facenet import Facenet

from flask import Flask, request, Response


class Server():
    """ ALL Detection System 2019 Facial Authentication Server Class

    ALL Detection System 2019 Facial Authentication Server. 
    """

    def __init__(self):
        """ Initializes the Server class. """

        # Server setup
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(
            self.Helpers.confs["Server"]["Logs"]+"/Server")
        
        # Movidius setup 
        self.Movidius = Movidius(self.Helpers.confs["Server"]["Logs"])
        self.Movidius.checkNCS()
        
        self.ValidDir   = self.Helpers.confs["Classifier"]["ValidPath"]
        self.TestingDir = self.Helpers.confs["Classifier"]["TestingPath"]
        
        self.Helpers.logMessage(self.LogFile, "Facial Recognition Server", 
                                "STATUS", "Movidius configured")

        # Facenet setup
        self.Facenet = Facenet(self.Helpers.confs["Server"]["Logs"])
        
        self.Movidius.allocateGraph(self.Facenet.LoadGraph())
        
        self.Facenet.PreprocessKnown(self.ValidDir, 
                                     self.Movidius.Graph)
        
        self.Helpers.logMessage(self.LogFile, "Facial Recognition Server",
                                "STATUS", "Facenet configured")

app = Flask(__name__)
Server = Server()

@app.route('/Encode', methods=['POST'])
def Encode():
    """ Responds to POST requests sent to the /Encode API endpoint. """
    
    return Server.Facenet.Infer(cv2.resize(Server.Facenet.ProcessFrame(np.fromstring(request.data, np.uint8)), 
                                           (640, 480)), Server.Movidius.Graph)
   
@app.route('/Inference', methods=['POST']) 
def Inference():
    """ Responds to POST requests sent to the /Inference API endpoint. """

    Human = "INTRUDER"
    ServerResponse = None

    # Reads the image
    Frame = Server.Facenet.ProcessFrame(np.fromstring(request.data, np.uint8))
    
    # Loops through processed known images
    for Known in Server.Facenet.Known:
        
        # Times the classification process
        humanInferStart, computerInferStart = Server.Helpers.timerStart()
        Match, Confidence = Server.Facenet.Compare(Known["Score"], 
                                                   Server.Facenet.Infer(Frame, Server.Movidius.Graph))
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
                                    "Facial Recognition Server",
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

        return Response(response=ServerResponse, 
                        status=400, mimetype="application/json")

    Server.Movidius.Graph.DeallocateGraph()
    Server.Movidius.ncsDevice.CloseDevice()

if __name__ == "__main__":
    app.run(host=Server.Helpers.confs["Server"]["IP"],
            port=Server.Helpers.confs["Server"]["Port"])
