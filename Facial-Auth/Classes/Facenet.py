############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Facial Authentication Server
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Facenet Class
# Description:   Facenet class for the ALL Detection System 2019 Facial Authentication Server.
# License:       MIT License
# Last Modified: 2020-07-16
#
############################################################################################

import os, json, cv2, dlib, imutils

import numpy as np

from imutils import face_utils
from datetime import datetime

from Classes.Helpers import Helpers
from Classes.OpenCV import OpenCV


class Facenet():
    """ ALL Detection System 2019 Facenet Class

    Facenet helper functions for the ALL Detection System 2019 Facial Authentication Server project. 
    """
    
    def __init__(self, LogPath):
        """ Initializes the Facenet class. """

        # Class settings
        self.Known = []
        
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(self.Helpers.confs["Server"]["Logs"]+"/Facenet")
        
        # OpenCV settings 
        self.OpenCV = OpenCV(self.Helpers)
        
        # Dlib settings 
        self.Detector   = dlib.get_frontal_face_detector()
        self.Predictor  = dlib.shape_predictor(self.Helpers.confs["Classifier"]["Dlib"])

    def PreprocessKnown(self, ValidDir, Graph):
        """ Preprocesses known images. """
        
        for validFile in os.listdir(ValidDir):
            if os.path.splitext(validFile)[1] in self.Helpers.confs["Classifier"]["ValidIType"]:
                self.Known.append({"File": validFile, "Score": self.Infer(cv2.resize(cv2.imread(ValidDir+validFile), (640, 480)), Graph)})
        
        self.Helpers.logMessage(self.LogFile,
                                "Facenet",
                                "STATUS",
                                str(len(self.Known)) + " known images found.") 

    def ProcessFrame(self, Frame):
        """ Preprocesses frame. """

        Known = []

        Frame = cv2.resize(cv2.imdecode(Frame, cv2.IMREAD_UNCHANGED), (640, 480)) 
        RawFrame = Frame.copy()
        Gray = cv2.cvtColor(Frame, cv2.COLOR_BGR2GRAY)

        Path = "Data/Captured/" + datetime.now().strftime("%Y-%m-%d") + "/" + datetime.now().strftime("%H") + "/"
        FileName = datetime.now().strftime('%M-%S') + ".jpg"
        FileNameGray = datetime.now().strftime('%M-%S') + "-Gray.jpg"

        self.OpenCV.SaveFrame(Path + "/", FileName, Frame)
        self.OpenCV.SaveFrame(Path + "/", FileNameGray, Gray)

        return Frame

    def LoadGraph(self):
        """ Loads Facenet graph. """

        with open(self.Helpers.confs["Classifier"]["Graph"], mode='rb') as f:
            graphFile = f.read()
            
        self.Helpers.logMessage(self.LogFile, "Facenet", "Status", "Loaded TASS Graph")

        return graphFile
        
    def Infer(self, face, graph):
        """ Runs the image through Facenet. """
        
        graph.LoadTensor(self.PreProcess(face).astype(np.float16), None)
        output, userobj = graph.GetResult()

        return output

    def PreProcess(self, src):
        """ Preprocesses an image. """
        
        NETWORK_WIDTH = 160
        NETWORK_HEIGHT = 160
        
        preprocessed_image = cv2.resize(src, (NETWORK_WIDTH, NETWORK_HEIGHT))
        preprocessed_image = cv2.cvtColor(preprocessed_image, cv2.COLOR_BGR2RGB)
        preprocessed_image = self.OpenCV.whiten(preprocessed_image)
        
        return preprocessed_image

    def Compare(self, face1, face2):
        """ Determines whether two images are a match. """

        if (len(face1) != len(face2)):
            self.Helpers.logMessage(self.LogFile, "Facenet", "!ERROR!", "Distance Missmatch")
            return False

        tdiff = 0
        for index in range(0, len(face1)):
            diff = np.square(face1[index] - face2[index])
            tdiff += diff

        if (tdiff < 1.3):
            self.Helpers.logMessage(self.LogFile, "Facenet", "Classification", "Calculated Match: " + str(tdiff))
            return True, tdiff
        else:
            self.Helpers.logMessage(self.LogFile, "Facenet", "Classification", "Calculated Mismatch: " + str(tdiff))
            return False, tdiff