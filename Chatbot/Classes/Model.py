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
# Title:         Acute Myeloid Leukemia Detection System Model Tools
# Description:   Model functions for the Acute Myeloid Leukemia Detection System.
# Configuration: required/confs.json
# Last Modified: 2018-12-22
#
############################################################################################

import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'

import tflearn, json
import tensorflow as tf

from Classes.Data    import Data
from Classes.Helpers import Helpers

class Model():
    
    def __init__(self):

        ###############################################################
        #
        # Sets up all default requirements
        #
        # - Helpers: Useful global functions
        # - Data: Data functions
        #
        ###############################################################
        
        self.Helpers = Helpers()
        self.confs  = self.Helpers.loadConfigs()

        self.Data = Data()
            
    def createDNNLayers(self, x, y):

        ###############################################################
        #
        # Sets up the DNN layers, configuration in required/confs.json
        #
        ###############################################################
        
        net = tflearn.input_data(shape=[None, len(x[0])])

        for i in range(self.confs["NLU"]['FcLayers']):
            net = tflearn.fully_connected(net, self.confs["NLU"]['FcUnits'])
        net = tflearn.fully_connected(net, len(y[0]), activation=str(self.confs["NLU"]['Activation']))

        if self.confs["NLU"]['Regression']:
            net = tflearn.regression(net)

        return net
            
    def trainDNN(self, x, y, words, classes, intentMap):

        ###############################################################
        #
        # Trains the DNN, configuration in required/confs.json
        #
        ###############################################################

        tf.reset_default_graph()

        tmodel = tflearn.DNN(
                        self.createDNNLayers(x, y), 
                        tensorboard_dir = self.confs["NLU"]['TFLearn']['Logs'], 
                        tensorboard_verbose = self.confs["NLU"]['TFLearn']['LogsLevel'])

        tmodel.fit(
                x, 
                y, 
                n_epoch = self.confs["NLU"]['Epochs'], 
                batch_size = self.confs["NLU"]['BatchSize'], 
                show_metric = self.confs["NLU"]['ShowMetric'])
            
        self.saveModelData(
            self.confs["NLU"]['TFLearn']['Data'],
            {
                'words': words, 
                'classes': classes, 
                'x': x, 
                'y': y,
                'intentMap' : [intentMap]
            },
            tmodel)
        
    def saveModelData(self, path, data, tmodel):

        ###############################################################
        #
        # Saves the model data for TFLearn and the NLU engine, 
        # configuration in required/confs.json
        #
        ###############################################################

        tmodel.save(self.confs["NLU"]['TFLearn']['Path'])
        
        with open(path, "w") as outfile:
            json.dump(data, outfile)

    def buildDNN(self, x, y):

        ###############################################################
        #
        # Loads the DNN model, configuration in required/confs.json
        #
        ###############################################################

        tf.reset_default_graph()
        tmodel = tflearn.DNN(self.createDNNLayers(x, y))
        tmodel.load(self.confs["NLU"]['TFLearn']['Path'])
        return tmodel
        
    def predict(self, tmodel, parsedSentence, trainedWords, trainedClasses):
        
        ###############################################################
        #
        # Makes a prediction against the trained model, checking the 
        # confidence and then logging the results.
        #
        ###############################################################
         
        predictions = [[index, confidence] for index, confidence in enumerate(
			tmodel.predict([
				self.Data.makeBagOfWords(
					parsedSentence,
					trainedWords)])[0])]
        predictions.sort(key=lambda x: x[1], reverse=True)
        
        classification = []
        for prediction in predictions:  classification.append((trainedClasses[prediction[0]], prediction[1]))
            
        return classification