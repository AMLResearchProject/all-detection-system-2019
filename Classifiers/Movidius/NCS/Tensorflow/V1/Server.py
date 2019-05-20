############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
# Project:       Movidius NCS1 Classifier
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Movidius NCS1 Classifier Server Class
# Description:   Flask server that hosts an API endpoint for the
#                AML/ALL Detection System Movidius NCS1 Classifier.
# License:       MIT License
# Last Modified: 2019-05-09
#
############################################################################################

import os
import sys
import time
import json
import cv2
import jsonpickle

import numpy as np

from mvnc import mvncapi as mvnc
from datetime import datetime
from skimage.transform import resize

from Classes.Helpers import Helpers
from Classes.OpenCV import OpenCV
from Classes.Movidius import Movidius

from flask import Flask, request, Response


class Server():
    """ AML/ALL Detection System Movidius NCS1 Classifier Class

    API server for the AML/ALL Detection System Movidius NCS1 Classifier.
    """

    def __init__(self):
        """ Initializes the AML/ALL Detection System Movidius NCS1 Classifier Class. """

        self.Helpers = Helpers("ClassifierServer")
        self.confs = self.Helpers.confs

        self.OpenCV = OpenCV()

        self.Movidius = Movidius()
        self.Movidius.checkNCS()
        self.Movidius.loadInception()

        self.Helpers.logger.info(
            "Classifier server class initialization complete.")


app = Flask(__name__)
Server = Server()


@app.route('/Inference', methods=['POST'])
def Inference():

    if len(request.files) != 0:
        img = Server.OpenCV.loadImage(np.fromstring(
            request.files['file'].read(), np.uint8))
    else:
        img = Server.OpenCV.loadImage(np.fromstring(request.data, np.uint8))

    dx, dy, dz = img.shape
    delta = float(abs(dy-dx))

    if dx > dy:
        img = img[int(0.5*delta):dx-int(0.5*delta), 0:dy]
    else:
        img = img[0:dx, int(0.5*delta):dy-int(0.5*delta)]

    img = cv2.cvtColor(cv2.resize(
        img, (Server.Movidius.reqsize, Server.Movidius.reqsize)), cv2.COLOR_BGR2RGB)

    for i in range(3):
        img[:, :, i] = (img[:, :, i] - Server.Movidius.mean) * \
            Server.Movidius.std

    detectionStart, detectionStart = Server.Helpers.timerStart()
    Server.Helpers.logger.info("API detection started.")

    Server.Movidius.ncsGraph.LoadTensor(img.astype(np.float16), 'user object')
    output, userobj = Server.Movidius.ncsGraph.GetResult()

    detectionClockEnd, difference, detectionEnd = Server.Helpers.timerEnd(
        detectionStart)
    Server.Helpers.logger.info("API detection ended taking " + str(difference))

    top_inds = output.argsort()[::-1][:5]

    if output[top_inds[0]] >= Server.confs["Classifier"]["InceptionThreshold"] and Server.Movidius.classes[top_inds[0]] == "1":
        classification = "AML Positive"
        message = "ALL detected with a confidence of " + \
            str(output[top_inds[0]]) + " in " + str(difference)
    elif output[top_inds[0]] >= Server.confs["Classifier"]["InceptionThreshold"] and Server.Movidius.classes[top_inds[0]] == "0":
        classification = "AML Negative"
        message = "ALL not detected with a confidence of " + \
            str(output[top_inds[0]]) + " in " + str(difference)
    elif output[top_inds[0]] <= Server.confs["Classifier"]["InceptionThreshold"] and Server.Movidius.classes[top_inds[0]] == "1":
        classification = "AML Positive"
        message = "ALL detected with a LOW confidence of " + \
            str(output[top_inds[0]]) + " in " + str(difference)
    elif output[top_inds[0]] <= Server.confs["Classifier"]["InceptionThreshold"] and Server.Movidius.classes[top_inds[0]] == "0":
        classification = "AML Negative"
        message = "ALL not detected with a LOW confidence of " + \
            str(output[top_inds[0]]) + " in " + str(difference)

    Server.Helpers.logger.info(message)

    ServerResponse = jsonpickle.encode({
        'Response': 'OK',
        'Classification': classification,
        'aClassification': Server.Movidius.classes[top_inds[0]],
        'Confidence': str(output[top_inds[0]]),
        'Message': message
    })

    return Response(response=ServerResponse, status=200, mimetype="application/json")


if __name__ == "__main__":
    app.run(host=Server.confs["Classifier"]["IP"],
            port=Server.confs["Classifier"]["Port"])
