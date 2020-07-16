############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Facial Authentication Server
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Client Class
# Description:   Sends images to the Facial Identification Server for classification.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################

import cv2, json, os, requests, sys, time

from Classes.Helpers import Helpers


class Client():
    """ ALL Detection System 2019 Facial Authentication Client Class

    Client for ALL Detection System 2019 Facial Authentication Server. 
    """

    def __init__(self):
        """ Initializes the Server class. """

        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(self.Helpers.confs["Server"]["Logs"]+"/Client")

        self.addr = "http://"+self.Helpers.confs["Server"]["IP"]+':'+str(self.Helpers.confs["Server"]["Port"]) + '/Inference'
        self.headers = {'content-type': 'image/jpeg'}
                    
    def send(self, imagePath):
        """ Sends image to the inference API endpoint. """

        img = cv2.imread(imagePath)
        _, img_encoded = cv2.imencode('.png', img)
        
        response = requests.post(self.addr, data = img_encoded.tostring(), 
                                 headers = self.headers)
        
        response = json.loads(response.text)
        self.Helpers.logMessage(self.LogFile, "Facial Recognition Server", "Classification", 
                                imagePath + " | " + response["Message"])

    def test(self):
        """ Loops through all images in the testing directory and sends them to the inference API endpoint. """

        testingDir  = self.Helpers.confs["Classifier"]["TestingPath"]

        for test in os.listdir(testingDir):
            if os.path.splitext(test)[1] in self.Helpers.confs["Classifier"]["ValidIType"]:
                self.Helpers.logMessage(self.LogFile, "Facial Recognition Server", "Classification", 
                                        "Sending " + testingDir+test)
                self.send(testingDir+test)
                time.sleep(5)
    
Client = Client()

if __name__ == "__main__":

    if sys.argv[1] == "Test":
        """ Sends all images in the test directory. """

        Client.test()

    elif sys.argv[1] == "Send":
        """ Sends a single image, path for image is sent as argument 2. """

        Client.send(sys.argv[2])



