############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Data Class
# Description:   Data class for the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################

import json, random, nltk, numpy as np 

from nltk.stem.lancaster import LancasterStemmer
from Classes.Helpers import Helpers

class Data():
    """ ALL Detection System 2019 Data Class

    Data class for the ALL Detection System 2019 Chatbot. 
    """

    def __init__(self):
        """ Initializes the Data class. """
        
        self.ignore  = [',','.','!','?']
        
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(self.Helpers.confs["System"]["Logs"]+"JumpWay/")
        
        self.LancasterStemmer = LancasterStemmer()
            
    def loadTrainingData(self):
        """ Loads the NLU and NER training data from Model/Data/training.json """

        with open("Model/Data/training.json") as jsonData:
            trainingData = json.load(jsonData)
            
        self.Helpers.logMessage(
            self.LogFile,
            "Data",
            "INFO",
            "Training Data Ready")
            
        return trainingData

    def loadTrainedData(self):
        """ Loads the saved training configuratuon """
    
        with open("Model/model.json") as jsonData:
            modelData = json.load(jsonData)
            
        self.Helpers.logMessage(
            self.LogFile,
            "Data",
            "INFO",
            "Model Data Ready")
        
        return modelData
            
    def sortList(self, listToSort):
        """ Sorts a list by sorting the list, and removing duplicates 
        
        More Info:
        https://www.programiz.com/python-programming/methods/built-in/sorted 
        https://www.programiz.com/python-programming/list
        https://www.programiz.com/python-programming/set
        """

        return sorted(list(set(listToSort)))
        
    def extract(self, data=None, splitIt=False):
        """ Extracts words from sentences  
        
        More Info:
        https://www.nltk.org/_modules/nltk/stem/lancaster.html
        http://insightsbot.com/blog/R8fu5/bag-of-words-algorithm-in-python-introduction
        """
        
        return [self.LancasterStemmer.stem(word) for word in (data.split() if splitIt == True else data) if word not in self.ignore]

    def makeBagOfWords(self, sInput, words):
        """ Makes a bag of words  
        
        Makes a bag of words used by the inference and training 
        features. If makeBagOfWords is called during training, sInput 
        will be a list.
         
        More Info:
        http://insightsbot.com/blog/R8fu5/bag-of-words-algorithm-in-python-introduction
        """
        
        if type(sInput) == list:
            bagOfWords = []
            for word in words: 
                if word in sInput:
                    bagOfWords.append(1)
                else:
                    bagOfWords.append(0)
            return bagOfWords
        
        else:
            bagOfWords = np.zeros(len(words))
            for cword in self.extract(sInput, True):
                for i, word in enumerate(words):
                    if word == cword: bagOfWords[i] += 1
            return np.array(bagOfWords)

    def prepareClasses(self, intent, classes):
        """ Prepares classes 
        
        Adds an intent key to classes if it does not already exist
        """

        if intent not in classes: classes.append(intent)
        return classes
        
    def prepareData(self, trainingData = [], wordsHldr = [], dataCorpusHldr = [], classesHldr = []):
        """ Prepares date 
        
        Prepares the NLU and NER training data, loops through the 
        intents from our dataset, converts any entities / synoynms  
        """

        counter   = 0
        intentMap = {}

        for intent in trainingData['intents']:

            theIntent = intent['intent']
            for text in intent['text']:

                if 'entities' in intent and len(intent['entities']):
                    i = 0
                    for entity in intent['entities']:
                        tokens = text.replace(trainingData['intents'][counter]["text"][i], "<"+entity["entity"]+">").lower().split()
                        wordsHldr.extend(tokens)
                        dataCorpusHldr.append((tokens, theIntent))
                        i = i + 1
                else:
                    tokens = text.lower().split()
                    wordsHldr.extend(tokens)
                    dataCorpusHldr.append((tokens, theIntent))

            intentMap[theIntent] = counter
            classesHldr          = self.prepareClasses(theIntent, classesHldr)
            counter              = counter + 1

        return self.sortList(self.extract(wordsHldr, False)), self.sortList(classesHldr), dataCorpusHldr, intentMap
        
    def finaliseData(self, classes, dataCorpus, words):
        """ Finalises the NLU training data  """

        trainData = []
        out = np.zeros(len(classes))

        for document in dataCorpus:
            output = list(out)
            output[classes.index(document[1])] = 1
            trainData.append([self.makeBagOfWords(self.extract(document[0], False), words), output])

        random.shuffle(trainData)
        trainData = np.array(trainData)
            
        self.Helpers.logMessage(
            self.LogFile,
            "Data",
            "INFO",
            "Finalised Training Data Ready")

        return list(trainData[:,0]), list(trainData[:,1])