############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
# Project:       Movidius NCS1 Classifier
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Movidius NCS1 Classifier OpenCV Class
# Description:   Movidius NCS1 OpenCV functions for the AML/ALL Detection System Movidius NCS1
#                Classifier.
# License:       MIT License
# Last Modified: 2019-05-09
#
############################################################################################

import os
import json
import cv2
import numpy as np
from datetime import datetime


class OpenCV():
    """ AML/ALL Detection System Movidius NCS1 Classifier OpenCV Class

    Trains the AML/ALL Detection System Movidius NCS1 Classifier.
    """

    def __init__(self):
        """ Initializes the AML/ALL Detection System Movidius NCS1 Classifier OpenCV Class. """
        pass

    def SaveFrame(self, path, fileName, frame):
        """ Saves an image using path, fileName & frame. """

        if not os.path.exists(path):
            os.makedirs(path)

        currentImage = path+'/'+fileName
        cv2.imwrite(currentImage, frame)

        return currentImage

    def loadImage(self, Frame):
        """ Decodes & saves an image from Frame. """

        Path = "Model/Data/Captured/" + datetime.now().strftime("%Y-%m-%d") + "/" + \
            datetime.now().strftime("%H") + "/"
        FileName = datetime.now().strftime('%M-%S') + ".jpg"

        self.SaveFrame(Path, FileName, cv2.resize(
            cv2.imdecode(Frame, cv2.IMREAD_UNCHANGED), (257, 257)))
        return cv2.imread(Path + FileName).astype(np.float32)

    def rect_to_bb(self, rect):
        """ Converts rect to bounding box. """

        x = rect.left()
        y = rect.top()
        w = rect.right() - x
        h = rect.bottom() - y

        return (x, y, w, h)

    def shape_to_np(self, shape, dtype="int"):
        """ Initialize the list of (x, y)-coordinates. """

        coords = np.zeros((68, 2), dtype=dtype)
        for i in range(0, 68):
            coords[i] = (shape.part(i).x, shape.part(i).y)
        return coords

    def whiten(self, source_image):
        """ Creates a whitened image. """

        source_mean = np.mean(source_image)
        source_standard_deviation = np.std(source_image)
        std_adjusted = np.maximum(
            source_standard_deviation, 1.0 / np.sqrt(source_image.size))
        whitened_image = np.multiply(np.subtract(
            source_image, source_mean), 1 / std_adjusted)
        return whitened_image

    def preprocess(self, src):
        """ Scales an image. """

        NETWORK_WIDTH = 160
        NETWORK_HEIGHT = 160
        preProcImg = cv2.resize(src, (NETWORK_WIDTH, NETWORK_HEIGHT))
        preProcImg = cv2.cvtColor(
            preProcImg, cv2.COLOR_BGR2RGB)
        preProcImg = self.whiten(preProcImg)
        return preProcImg
