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
# Example Usage:
#
#   python3 Chatbot.py TRAIN
#   python3 Chatbot.py INPUT 
#   python3 Chatbot.py LOCAL "Hi how are you?"
#   python3 Chatbot.py SERVER 
#
############################################################################################
 
import sys, os, random, json, string, warnings

from flask import Flask, Response, request
from Train import Trainer

from Classes.Helpers import Helpers
from Classes.Data import Data
from Classes.Mitie import Entities
from Classes.Model import Model
from Classes.Context import Context
from Classes.Extensions import Extensions

app = Flask(__name__)

class Chatbot():
    """ ALL Detection System 2019 Chatbot Class

    The ALL Detection System 2019 Chatbot. 
    """
        
    def __init__(self):
        """ Initializes the Chatbot class. """
            
        self.isTraining  = False 
        self.ner = None 
            
        self.Helpers = Helpers()

        self.user = {}

        self.LogFile = self.Helpers.setLogFile(self.Helpers.confs["System"]["Logs"]+"NLU/")
        self.ChatLogFile = self.Helpers.setLogFile(self.Helpers.confs["System"]["Logs"]+"Chat/")
        
    def initiateSession(self):
        """ Initializes a Chatbot sesiion. 
        
        Initiates empty guest user session, GeniSys will ask the user 
        verify their GeniSys user by speaking or typing if it does
        not know who it is speaking to. 
        """

        self.userID = 0
        if not self.userID in self.user:
            self.user[self.userID] = {}
            self.user[self.userID]["history"] = {}

    def initNLU(self):
        """ Initializes a Chatbot sesiion. 
        
        Initiates the NLU setting up the data, NLU / entities models 
        and required modules such as context and extensions.
        """

        self.Data = Data()
        self.trainingData = self.Data.loadTrainingData()
        self.trainedData = self.Data.loadTrainedData()
        
        self.Model = Model()
        self.Context = Context()
        self.Extensions = Extensions()

        self.restoreData()
        self.restoreNER()
        self.restoreNLU()

        self.initiateSession()
        self.setThresholds()
        
    def commandsCallback(self,topic,payload):
        """ iotJumpWay callback function. 
        
        The callback function that is triggerend in the event of a 
        command communication from the iotJumpWay.
        """
        
        self.Helpers.logMessage(self.LogFile, "iotJumpWay", "INFO",
            "Recieved iotJumpWay Command Data : " + str(payload))
            
        commandData = json.loads(payload.decode("utf-8"))

    def restoreData(self):
        """ Restores the training data. 
        
        Sets the local trained data using data retrieved above
        """

        self.trainedWords = self.trainedData["words"]
        self.trainedClasses = self.trainedData["classes"]
        self.x = self.trainedData["x"]
        self.y = self.trainedData["y"]
        self.intentMap = self.trainedData["intentMap"][0]
        
    def loadEntityController(self):
        """ Initiates the entity extractor class """

        self.entityController = Entities()
        
    def restoreNER(self):
        """ Loads entity controller and restores the NER model """

        self.loadEntityController()
        self.ner = self.entityController.restoreNER()
        
    def restoreNLU(self):
        """ Restores the NLU model """

        self.tmodel = self.Model.buildDNN(self.x, self.y) 
        
    def setThresholds(self):
        """ Sets thresholds
        
        Sets the threshold for the NLU engine, this can be changed
        using arguments to commandline programs or paramters for 
        API calls.
        """

        self.threshold = self.Helpers.confs["NLU"]["Threshold"]
        self.entityThrshld = self.Helpers.confs["NLU"]["Mitie"]["Threshold"]
            
    def communicate(self, sentence):
        """ Responds to the user
        
        First checks to ensure that the program is not training, 
        then parses any entities that may be in the intent, then 
        checks context and extensions before providing a response.
        """

        if self.isTraining == False:

            parsed, fallback, entityHolder, parsedSentence = self.entityController.parseEntities(
                sentence,
                self.ner,
                self.trainingData
            )
            
            classification = self.Model.predict(self.tmodel, parsedSentence, 
                                                self.trainedWords, self.trainedClasses)

            if len(classification) > 0:

                clearEntities = False
                theIntent = self.trainingData["intents"][self.intentMap[classification[0][0]]]

                if len(entityHolder) and not len(theIntent["entities"]):
                    clearEntities = True

                if(self.Context.checkSessionContext(self.user[self.userID], theIntent)):

                    if self.Context.checkClearContext(theIntent, 0): 
                        self.user[self.userID]["context"] = ""

                    contextIn, contextOut, contextCurrent = self.Context.setContexts(theIntent, self.user[self.userID])
                    
                    if not len(entityHolder) and len(theIntent["entities"]):
                        response, entities = self.entityController.replaceResponseEntities(random.choice(theIntent["fallbacks"]), entityHolder)
                        extension, extensionResponses, exEntities = self.Extensions.setExtension(theIntent)
                    elif clearEntities:
                        entityHolder = []
                        response = random.choice(theIntent["responses"])
                        extension, extensionResponses, exEntities = self.Extensions.setExtension(theIntent)
                    else:
                        response, entities = self.entityController.replaceResponseEntities(random.choice(theIntent["responses"]), entityHolder)
                        extension, extensionResponses, exEntities = self.Extensions.setExtension(theIntent)

                    if extension != None:
                        classParts = extension.split(".")
                        classFolder = classParts[0]
                        className = classParts[1]
                        theEntities = None

                        if exEntities != False:
                            theEntities = entities
                        
                        module = __import__(classParts[0]+"."+classParts[1], globals(), locals(), [className])
                        extensionClass = getattr(module, className)()
                        response = getattr(extensionClass, classParts[2])(extensionResponses, theEntities)
                        
                    return {
                        "Response": "OK",
                        "ResponseData": [{
                            "Received": sentence,
                            "Intent": classification[0][0],
                            "Confidence": str(classification[0][1]),
                            "Response": response,
                            "Context":  [{
                                "In": contextIn,
                                "Out": contextOut,
                                "Current": contextCurrent
                            }],
                            "Extension": extension,
                            "Entities": entityHolder
                        }]
                    }

                else:

                    self.user[self.userID]["context"] = ""
                    contextIn, contextOut, contextCurrent = self.Context.setContexts(theIntent, self.user[self.userID])

                    if fallback and fallback in theIntent and len(theIntent["fallbacks"]):
                        response, entities = self.entityController.replaceResponseEntities(random.choice(theIntent["fallbacks"]), entityHolder)
                        extension, extensionResponses = None, []
                    else:
                        response, entities = self.entityController.replaceResponseEntities(random.choice(theIntent["responses"]), entityHolder)
                        extension, extensionResponses, exEntities = self.Extensions.setExtension(theIntent)

                    if extension != None:
                        classParts  = extension.split(".")
                        classFolder = classParts[0]
                        className = classParts[1]
                        theEntities = None

                        if exEntities != False:
                            theEntities = entities
                        
                        module = __import__(classParts[0]+"."+classParts[1], globals(), locals(), [className])
                        extensionClass = getattr(module, className)()
                        response = getattr(extensionClass, classParts[2])(extensionResponses, theEntities)

                    else:
                        response = self.entityController.replaceResponseEntities(random.choice(theIntent["responses"]), entityHolder)
                        if(type(response)==tuple):
                            response = response[0]
                            
                    return {
                        "Response": "OK",
                        "ResponseData": [{
                            "Received": sentence,
                            "Intent": classification[0][0],
                            "Confidence": str(classification[0][1]),
                            "Response": response,
                            "Context":  [{
                                "In": contextIn,
                                "Out": contextOut,
                                "Current": contextCurrent
                            }],
                            "Extension": extension,
                            "Entities": entityHolder
                        }]
                    }

            else:

                contextCurrent = self.Context.getCurrentContext(self.user[self.userID])

                return {
                    "Response": "FAILED",
                    "ResponseData": [{
                        "Received": sentence,
                        "Intent": "UNKNOWN",
                        "Confidence": "NA",
                        "Responses": [],
                        "Response": random.choice(self.Helpers.confs["NLU"]["defaultResponses"]),
                        "Context":  [{
                            "In": "NA",
                            "Out": "NA",
                            "Current": contextCurrent
                        }],
                        "Extension":"NA",
                        "Entities": entityHolder
                    }]
                }
        else:    

            return {
                "Response": "FAILED",
                "ResponseData": [{
                    "Status": "Training",
                    "Message": "NLU Engine is currently training"
                }]
            }


Chatbot = Chatbot()

@app.route("/infer", methods = ["POST"])
def infer():
    """ Inference endpoint

    Is triggered when an authorized request is made to the infer 
    endpoint.
    """

    Chatbot.initiateSession()

    if request.headers["Content-Type"] == "application/json":
        query = request.json
        response = Chatbot.communicate(query["query"])
        
        return Response(response=json.dumps(response, indent=4, sort_keys=True), 
                        status=200, mimetype="application/json")
    
if __name__ == "__main__":
        
    if sys.argv[1] == "TRAIN":
        """ Training mode

        Is triggered when the 1st commandline line argument is TRAIN.
        """

        Train = Trainer()
        Train.trainModel()
        
    elif sys.argv[1] == "SERVER":
        """ Server mode

        Is triggered when the 1st commandline line argument is SERVER.
        """

        Chatbot.initNLU()

        Chatbot.Helpers.logMessage(
            Chatbot.LogFile,
            "Inference",
            "INFO",
            "Inference Started In SERVER Mode") 

        app.run(host=Chatbot.Helpers.confs["System"]["IP"], port=Chatbot.Helpers.confs["System"]["Port"])
        
    elif sys.argv[1] == "INPUT":
        """ Input mode

        Is triggered when the 1st commandline line argument is INPUT.
        """

        Chatbot.initNLU()
            
        while True:

            intent = input(">")

            Chatbot.Helpers.logMessage(Chatbot.ChatLogFile,
                "Human", "Intent", intent)
                
            response = Chatbot.communicate(intent)
            
            Chatbot.Helpers.logMessage(Chatbot.ChatLogFile, "GeniSys", 
                                       "Response", str(response["ResponseData"][0]["Response"])) 
            
            Chatbot.Helpers.logMessage(Chatbot.ChatLogFile, "GeniSys", 
                                       "Raw Response", str(response["ResponseData"]), True) 
