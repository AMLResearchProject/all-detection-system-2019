############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
# Project:       Movidius NCS1 Classifier
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Movidius NCS1 Classifier Server Client Class
# Description:   Sends single or multiple images to the AML/ALL Detection System Movidius
#                NCS1 Classifier API server.
# License:       MIT License
# Last Modified: 2019-05-09
#
# Usage:
#
#   $ python3 Client.py Test
#   $ python3 Client.py Send PathToImage
#
############################################################################################

import os
import sys
import time

import requests
import json
import cv2

from Classes.Helpers import Helpers


class Client():
    """ AML/ALL Detection System Movidius NCS1 Classifier Server Client Class

    Sends single or multiple images to the AML/ALL Detection System Movidius 
    NCS1 Classifier API server.
    """

    def __init__(self):
        """ Initializes the AML/ALL Detection System Movidius NCS1 Classifier Server Client Class. """

        self.Helpers = Helpers("ClassifierServerClient")
        self.confs = self.Helpers.confs

        self.addr = "http://"+self.confs["Classifier"]["IP"] + \
            ':'+str(self.confs["Classifier"]["Port"]) + '/Inference'
        self.headers = {'content-type': 'image/jpeg'}

        self.Helpers.logger.info("Classifier class initialization complete.")

    def send(self, imagePath):
        """ Sends image to the inference API endpoint. """

        _, img_encoded = cv2.imencode('.png', cv2.imread(imagePath))
        response = requests.post(
            self.addr, data=img_encoded.tostring(), headers=self.headers)
        response = json.loads(response.text)

        self.Helpers.logger.info(imagePath + ": " + response["Message"])

    def test(self):
        """ Loops through all images in the testing directory and sends
        them to the inference API endpoint. """

        testingDir = self.confs["Classifier"]["NetworkPath"] + \
            self.confs["Classifier"]["TestImagePath"] + "/"

        for test in os.listdir(testingDir):
            if os.path.splitext(test)[1] in self.confs["Classifier"]["ValidIType"]:
                self.send(testingDir+test)
                time.sleep(7)


if __name__ == "__main__":

    Client = Client()

    if sys.argv[1] == "Send":

        Client.send(sys.argv[2])

    elif sys.argv[1] == "Test":

        Client.test()
