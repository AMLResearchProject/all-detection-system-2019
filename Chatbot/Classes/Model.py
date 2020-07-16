############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Model Class
# Description:   Model class for the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################

import json, os, tflearn, warnings

import tensorflow as tf

warnings.simplefilter(action='ignore', category=FutureWarning)
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
tf.logging.set_verbosity(tf.logging.ERROR)

from Classes.Data import Data
from Classes.Helpers import Helpers

class Model():
    """ ALL Detection System 2019 Model Class

    Model class for the ALL Detection System 2019 Chatbot. 
    """
    
    def __init__(self):
        """ Initializes the Model class. """
        
        self.Helpers = Helpers()
        self.Data = Data()
            
    def createDNNLayers(self, x, y):
        """ Sets up the DNN layers """
        
        net = tflearn.input_data(shape=[None, len(x[0])])

        for i in range(self.Helpers.confs["NLU"]['FcLayers']):
            net = tflearn.fully_connected(net, self.Helpers.confs["NLU"]['FcUnits'])
        net = tflearn.fully_connected(net, len(y[0]), activation=str(self.Helpers.confs["NLU"]['Activation']))

        if self.Helpers.confs["NLU"]['Regression']:
            net = tflearn.regression(net)

        return net
            
    def trainDNN(self, x, y, words, classes, intentMap):
        """ Trains the DNN """

        tf.reset_default_graph()

        tmodel = tflearn.DNN(self.createDNNLayers(x, y), 
                        tensorboard_dir = self.Helpers.confs["NLU"]['TFLearn']['Logs'], 
                        tensorboard_verbose = self.Helpers.confs["NLU"]['TFLearn']['LogsLevel'])

        tmodel.fit(x, y, n_epoch = self.Helpers.confs["NLU"]['Epochs'], 
                batch_size = self.Helpers.confs["NLU"]['BatchSize'], 
                show_metric = self.Helpers.confs["NLU"]['ShowMetric'])
            
        self.saveModelData(
            self.Helpers.confs["NLU"]['TFLearn']['Data'],
            {
                'words': words, 
                'classes': classes, 
                'x': x, 
                'y': y,
                'intentMap' : [intentMap]
            },
            tmodel)
        
    def saveModelData(self, path, data, tmodel):
        """ Saves the model data """

        tmodel.save(self.Helpers.confs["NLU"]['TFLearn']['Path'])
        
        with open(path, "w") as outfile:
            json.dump(data, outfile)

    def buildDNN(self, x, y):
        """ Loads the DNN model """

        tf.reset_default_graph()
        tmodel = tflearn.DNN(self.createDNNLayers(x, y))
        tmodel.load(self.Helpers.confs["NLU"]['TFLearn']['Path'])
        return tmodel
        
    def predict(self, tmodel, parsedSentence, trainedWords, trainedClasses):
        """ Makes a prediction """
         
        predictions = [[index, confidence] for index, confidence in enumerate(
            tmodel.predict([
                self.Data.makeBagOfWords(
                    parsedSentence,
                    trainedWords)])[0])]
        predictions.sort(key=lambda x: x[1], reverse=True)
        
        classification = []
        for prediction in predictions:  classification.append((trainedClasses[prediction[0]], prediction[1]))
            
        return classification
