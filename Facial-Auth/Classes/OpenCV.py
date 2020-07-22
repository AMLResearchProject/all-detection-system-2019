############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Facial Authentication Server
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         OpenCV Class
# Description:   OpenCV class for the ALL Detection System 2019 Facial Authentication Server.
# License:       MIT License
# Last Modified: 2020-07-16
#
############################################################################################

import os, json, cv2, time
import numpy as np
from datetime import datetime


class OpenCV():
    """ ALL Detection System 2019 OpenCV Class

    OpenCV helper functions for the ALL Detection System 2019 Facial Authentication Server project. 
    """

    def __init__(self, helpers):
        """ Initializes the OpenCV class. """
        
        self.Helpers = helpers

    def SaveFrame(self, path, fileName, frame):
        """ Saves an image. """

        if not os.path.exists(path):
            os.makedirs(path)

        currentImage=path+'/'+datetime.now().strftime('%M-%S')+'.jpg'
        cv2.imwrite(currentImage, frame)

        return currentImage

    def loadImage(self, imgID):
        """ Loads an image. """
    
        imgLoadStart  = time.time()

        img = cv2.imread("data/captured/"+str(imgID)+'.png')

        imgLoadEnd    = (imgLoadStart - time.time())

        return img

    def whiten(self, source_image):
        """ Creates a whitened image.  """

        source_mean = np.mean(source_image)
        source_standard_deviation = np.std(source_image)
        std_adjusted = np.maximum(source_standard_deviation, 1.0 / np.sqrt(source_image.size))
        whitened_image = np.multiply(np.subtract(source_image, source_mean), 1 / std_adjusted)
        return whitened_image

    def preprocess(self, src):
        """ Preprocesses an image.  """
        
        NETWORK_WIDTH = 160
        NETWORK_HEIGHT = 160
        
        preprocessed_image = cv2.resize(src, (NETWORK_WIDTH, NETWORK_HEIGHT))
        preprocessed_image = cv2.cvtColor(preprocessed_image, cv2.COLOR_BGR2RGB)
        preprocessed_image = self.whiten(preprocessed_image)

        return preprocessed_image
