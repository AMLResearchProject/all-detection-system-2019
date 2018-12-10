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
# Title:         Facenet Helper Class
# Description:   Facenet helper functions for the Acute Myeloid Leukemia Detection System.
# Configuration: required/Configuration.json
# Last Modified: 2018-12-09
#
############################################################################################

import os, json, cv2, dlib, imutils

import numpy as np

from imutils import face_utils
from datetime import datetime

from Tools.Helpers import Helpers
from Tools.OpenCV import OpenCV

class Facenet():

    ###############################################################
    #
    # Facenet helper functions
    #
    ###############################################################
    
    def __init__(self, LogPath, Configuration):

        ###############################################################
        #
        # Sets up all default requirements and placeholders
        #
        ###############################################################

        # Class settings
        self.Known = []
        self.Configuration = Configuration
        
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(self.Configuration.AiCore["Logs"]+"/Facenet")
        
        # OpenCV settings 
        self.OpenCV = OpenCV()
        
        # Dlib settings 
        self.Detector   = dlib.get_frontal_face_detector()
        self.Predictor  = dlib.shape_predictor(self.Configuration.Classifier["Dlib"])

    def PreprocessKnown(self, ValidDir, Graph):

        ###############################################################
        #
        # Preprocesses known images
        #
        ###############################################################
        
        for validFile in os.listdir(ValidDir):
            if os.path.splitext(validFile)[1] in self.Configuration.Classifier["ValidIType"]:
                self.Known.append({"File": validFile, "Score": self.Infer(cv2.resize(cv2.imread(ValidDir+validFile), (640, 480)), Graph)})
        
        self.Helpers.logMessage(self.LogFile,
                                "TASS Server",
                                "STATUS",
                                str(len(self.Known)) + " known images found.") 

    def ProcessFrame(self, Frame):

        ###############################################################
        #
        # Processes frame
        #
        ###############################################################

        Known = []

        Frame = cv2.resize(cv2.imdecode(Frame, cv2.IMREAD_UNCHANGED), (640, 480)) 
        RawFrame = Frame.copy()
        Gray = cv2.cvtColor(Frame, cv2.COLOR_BGR2GRAY)

        Path = "Data/Captured/" + datetime.now().strftime("%Y-%m-%d") + "/" + datetime.now().strftime("%H") + "/"
        FileName = datetime.now().strftime('%M-%S') + ".jpg"
        FileNameGray = datetime.now().strftime('%M-%S') + "-Gray.jpg"

        self.OpenCV.SaveFrame(Path + "/" + FileName, Frame)
        self.OpenCV.SaveFrame(Path + "/" + FileNameGray, Gray)

        return Frame

    def LoadGraph(self):

        ###############################################################
        #
        # Loads Facenet graph 
        #
        ###############################################################

        with open(self.Configuration.Classifier["NetworkPath"] + self.Configuration.Classifier["Graph"], mode='rb') as f:
            graphFile = f.read()
            
        self.Helpers.logMessage(self.LogFile,
                            "TASS Server",
                            "INFO",
                            "Loaded TASS Graph")

        return graphFile
        
    def Infer(self, face, graph):

        ###############################################################
        #
        # Runs the image through Facenet
        #
        ###############################################################
        
        graph.LoadTensor(self.PreProcess(face).astype(np.float16), None)
        output, userobj = graph.GetResult()

        return output

    def PreProcess(self, src):

        ###############################################################
        #
        # Preprocesses an image
        #
        ###############################################################
        
        NETWORK_WIDTH = 160
        NETWORK_HEIGHT = 160
        preprocessed_image = cv2.resize(src, (NETWORK_WIDTH, NETWORK_HEIGHT))
        preprocessed_image = cv2.cvtColor(preprocessed_image, cv2.COLOR_BGR2RGB)
        preprocessed_image = self.OpenCV.whiten(preprocessed_image)
        
        return preprocessed_image

    def Compare(self, face1, face2):

        ###############################################################
        #
        # Determines whether two images are a match
        #
        ###############################################################

        if (len(face1) != len(face2)):
            self.Helpers.logMessage(self.LogFile,
                                    "TASS Server",
                                    "ERROR",
                                    "Distance Missmatch")
            return False

        tdiff = 0
        for index in range(0, len(face1)):
            diff = np.square(face1[index] - face2[index])
            tdiff += diff

        if (tdiff < 1.3):
            self.Helpers.logMessage(self.LogFile,
                                    "TASS Server",
                                    "CLASSIFICATION",
                                    "Calculated Match: " + str(tdiff))
            return True, tdiff
        else:
            self.Helpers.logMessage(self.LogFile,
                                    "TASS Server",
                                    "CLASSIFICATION",
                                    "Calculated Mismatch: " + str(tdiff))
            return False, tdiff

    def addFrameBB(self, frame, x, y, w, h):

        ###############################################################
        #
        # Adds bounding box to the passed frame
        #
        ###############################################################

        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)

        return frame

    def addFrameFeatures(self, frame, shape, x, y):

        ###############################################################
        #
        # Adds facial features to the passed frame
        #
        ###############################################################
                
        for (x, y) in shape:
            cv2.circle(frame, (x, y), 1, (0, 255, 0), -1)

        return frame