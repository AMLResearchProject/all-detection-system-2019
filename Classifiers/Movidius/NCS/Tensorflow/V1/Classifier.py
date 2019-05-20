############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
# Project:       Movidius NCS1 Classifier
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Movidius NCS1 Classifier Class
# Description:   Movidius NCS1 classfier functions for the AML/ALL Detection System Movidius
#                NCS1 Classifier.
# License:       MIT License
# Last Modified: 2019-05-09
#
############################################################################################

import os
import sys
import time
import cv2

import numpy as np

from mvnc import mvncapi as mvnc

from Classes.Helpers import Helpers
from Classes.Movidius import Movidius


class Classifier():
    """ AML/ALL Detection System Movidius NCS1 Classifier Class

    Classifier for the AML/ALL Detection System Movidius NCS1 Classifier.
    """

    def __init__(self):
        """ Initializes the AML/ALL Detection System Movidius NCS1 Classifier Class. """

        self.Helpers = Helpers("Classifier")
        self.confs = self.Helpers.confs

        self.Movidius = Movidius()
        self.Movidius.checkNCS()
        self.Movidius.loadInception()

        self.Helpers.logger.info("Classifier class initialization complete.")


Classifier = Classifier()


def main(argv):

    humanStart, clockStart = Classifier.Helpers.timerStart()

    Classifier.Helpers.logger.info(
        "AML/ALL Detection System Movidius NCS1 Classifier started.")

    files = 0
    correct = 0
    incorrect = 0
    low = 0
    lowCorrect = 0
    lowIncorrect = 0

    rootdir = Classifier.confs["Classifier"]["NetworkPath"] + \
        Classifier.confs["Classifier"]["TestImagePath"]

    for testFile in os.listdir(rootdir):
        if os.path.splitext(testFile)[1] in Classifier.confs["Classifier"]["ValidIType"]:

            files += 1
            fileName = rootdir + "/" + testFile

            img = cv2.imread(fileName).astype(np.float32)

            Classifier.Helpers.logger.info(
                "Loaded test image " + fileName)

            dx, dy, dz = img.shape
            delta = float(abs(dy-dx))

            if dx > dy:
                img = img[int(0.5*delta):dx-int(0.5*delta), 0:dy]
            else:
                img = img[0:dx, int(0.5*delta):dy-int(0.5*delta)]

            img = cv2.resize(img, (Classifier.Movidius.reqsize,
                                   Classifier.Movidius.reqsize))
            img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

            for i in range(3):
                img[:, :, i] = (
                    img[:, :, i] - Classifier.Movidius.mean) * Classifier.Movidius.std

            detectionStart, detectionStart = Classifier.Helpers.timerStart()

            Classifier.Helpers.logger.info(
                "AML/ALL Detection System Movidius NCS1 detection started.")

            Classifier.Movidius.ncsGraph.LoadTensor(
                img.astype(np.float16), 'user object')
            output, userobj = Classifier.Movidius.ncsGraph.GetResult()

            detectionClockEnd, difference, detectionEnd = Classifier.Helpers.timerEnd(
                detectionStart)

            Classifier.Helpers.logger.info(
                "AML/ALL Detection System Movidius NCS1 detection ended taking " + str(difference))

            top_inds = output.argsort()[::-1][:5]

            if output[top_inds[0]] >= Classifier.confs["Classifier"]["InceptionThreshold"] and Classifier.Movidius.classes[top_inds[0]] == "1":
                if "_1." in fileName:
                    correct += 1
                    Classifier.Helpers.logger.info(
                        "ALL correctly detected with confidence of " + str(output[top_inds[0]]) + " in " + str(difference))
                else:
                    incorrect += 1
                    Classifier.Helpers.logger.warning(
                        "ALL incorrectly detected with confidence of " + str(output[top_inds[0]]) + " in " + str(difference))

            elif output[top_inds[0]] >= Classifier.confs["Classifier"]["InceptionThreshold"] and Classifier.Movidius.classes[top_inds[0]] == "0":
                if "_0." in fileName:
                    correct += 1
                    Classifier.Helpers.logger.info(
                        "ALL correctly not detected with confidence of " + str(output[top_inds[0]]) + " in " + str(difference))
                else:
                    incorrect += 1
                    Classifier.Helpers.logger.warning(
                        "ALL incorrectly not detected with confidence of " + str(output[top_inds[0]]) + " in " + str(difference))

            elif output[top_inds[0]] <= Classifier.confs["Classifier"]["InceptionThreshold"] and Classifier.Movidius.classes[top_inds[0]] == "1":
                if "_1." in fileName:
                    correct += 1
                    low += 1
                    lowCorrect += 1
                    Classifier.Helpers.logger.info(
                        "ALL correctly detected with LOW confidence of " + str(output[top_inds[0]]) + " in " + str(difference))
                else:
                    incorrect += 1
                    low += 1
                    lowIncorrect += 1
                    Classifier.Helpers.logger.warning(
                        "ALL incorrectly detected with LOW confidence of " + str(output[top_inds[0]]) + " in " + str(difference))

            elif output[top_inds[0]] <= Classifier.confs["Classifier"]["InceptionThreshold"] and Classifier.Movidius.classes[top_inds[0]] == "0":
                if "_0." in fileName:
                    correct += 1
                    low += 1
                    lowCorrect += 1
                    Classifier.Helpers.logger.info(
                        "ALL correctly not detected with LOW confidence of " + str(output[top_inds[0]]) + " in " + str(difference))
                else:
                    low += 1
                    incorrect += 1
                    lowIncorrect += 1
                    Classifier.Helpers.logger.warning(
                        "ALL incorrectly not detected with LOW confidence of " + str(output[top_inds[0]]) + " in " + str(difference))

    clockEnd, difference, humanEnd = Classifier.Helpers.timerEnd(clockStart)
    Classifier.Helpers.logger.info("Testing ended. " + str(correct) + " correct, " + str(incorrect) +
                                   " incorrect, " + str(low) + " low confidence: (" + str(lowCorrect) + " correct, " + str(lowIncorrect) + " incorrect)")

    Classifier.Movidius.ncsDevice.CloseDevice()


if __name__ == "__main__":
    main(sys.argv[1:])
