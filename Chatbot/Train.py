############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Training Class
# Description:   Trains the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################
 
import sys, os, json, re, time, warnings

from Classes.Helpers import Helpers
from Classes.Data import Data
from Classes.Model import Model
from Classes.Mitie import Entities

if not sys.warnoptions:
    warnings.simplefilter("ignore")

class Trainer():
    """ ALL Detection System 2019 Chatbot Training Class

    Trains the ALL Detection System 2019 Chatbot. 
    """

    def __init__(self): 
        """ Initializes the Training class. """
            
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(self.Helpers.confs["System"]["Logs"]+"Train/")

        self.intentMap = {}
        self.words = []
        self.classes = [] 
        self.dataCorpus = []
        
        self.Model = Model()
        self.Data = Data()
        
    def setupData(self):
        """ Prepares the data. """

        self.trainingData = self.Data.loadTrainingData()

        self.words, self.classes, self.dataCorpus, self.intentMap = self.Data.prepareData(self.trainingData)
        self.x, self.y = self.Data.finaliseData(self.classes, self.dataCorpus, self.words)
        
        self.Helpers.logMessage(self.LogFile, "TRAIN", "INFO", "NLU Training Data Ready")
        
    def setupEntities(self):
        """ Prepares the entities. """
            
        if self.Helpers.confs["NLU"]["Entities"] == "Mitie":
            self.entityController = Entities()
            self.entityController.trainEntities(
                self.Helpers.confs["NLU"]["Mitie"]["ModelLocation"],
                self.trainingData) 
            self.Helpers.logMessage( self.LogFile, "TRAIN", "OK", "NLU Trainer Entities Ready")
        
    def trainModel(self):
        """ Trains the model. """
        
        while True:
            self.Helpers.logMessage(self.LogFile, "TRAIN", "ACTION", "Ready To Begin Training ? (Yes/No)")
            userInput = input(">")

            if userInput == 'Yes': break
            if userInput == 'No':  exit()

        self.setupData()
        self.setupEntities()
            
        humanStart, trainingStart = self.Helpers.timerStart()

        self.Model.trainDNN(self.x, self.y, self.words,
                      self.classes, self.intentMap)
            
        trainingEnd, trainingTime, humanEnd = self.Helpers.timerEnd(trainingStart)
        
        self.Helpers.logMessage(self.LogFile, "TRAIN", "OK", "NLU Model Trained At "+ humanEnd + " In " + str(trainingEnd) + " Seconds")