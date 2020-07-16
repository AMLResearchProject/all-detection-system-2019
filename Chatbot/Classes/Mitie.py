############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         MITIE Class
# Description:   MITIE NER class for the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################
 
import sys, os, nltk

parent = os.path.dirname(os.path.realpath(__file__))
sys.path.append(parent + '/../MITIE/mitielib')

from nltk.stem.lancaster import LancasterStemmer
from Classes.Helpers import Helpers
from mitie import *

class Entities():
    """ ALL Detection System 2019 MITIE Class

    MITIE NER class for the ALL Detection System 2019 Chatbot. 
    """
    
    def __init__(self):
        """ Initializes the MITIE class. """
        
        self.Helpers = Helpers()
        self.stemmer = LancasterStemmer()
        
    def restoreNER(self):
        """ Restores the NER model """
         
        if os.path.exists(self.Helpers.confs["NLU"]["EntitiesDat"]):
            return named_entity_extractor(self.Helpers.confs["NLU"]["EntitiesDat"])

    def parseEntities(self, sentence, ner, trainingData):
        """ Parses entities in intents/sentences """

        entityHolder = []
        fallback = False
        parsedSentence = sentence
        parsed = ""

        if os.path.exists(self.Helpers.confs["NLU"]["EntitiesDat"]):

            tokens = sentence.lower().split()
            entities = ner.extract_entities(tokens)

            for e in entities:
                range = e[0]
                tag = e[1]
                score = e[2]
                scoreText = "{:0.3f}".format(score)
                
                if score > self.Helpers.confs["NLU"]["Mitie"]["Threshold"]:
                    
                    parsed, fallback = self.replaceEntity(
                        " ".join(tokens[i] for i in range),
                        tag,
                        trainingData)

                    entityHolder.append({
                        "Entity":tag,
                        "ParsedEntity":parsed,
                        "Confidence":str(scoreText)})

                    parsedSentence = sentence.replace(
                        " ".join(sentence.split()[i] for i in range), 
                        "<"+tag+">")

                else:
                    
                    parsed, fallback = self.replaceEntity(
                        " ".join(tokens[i] for i in range),
                        tag,
                        trainingData)

                    entityHolder.append({
                        "Entity":tag,
                        "ParsedEntity":parsed,
                        "Confidence":str(scoreText)})

                    parsed = parsedSentence
                    
        return parsed, fallback, entityHolder, parsedSentence
        
    def replaceResponseEntities(self, response, entityHolder):
        """ Replaces entities in responses """

        entities = []

        for entity in entityHolder: 
            response = response.replace("<"+entity["Entity"]+">", entity["ParsedEntity"].title())
            entities.append( entity["ParsedEntity"].title())

        return response, entities

    def replaceEntity(self, value, entity, trainingData):
        """ Replaces entities/synonyms """

        lowEntity = value.lower()
        match = True

        if "entitieSynonyms" in trainingData:
            for entities in trainingData["entitieSynonyms"]:
                for synonyms in entities[entity]:
                    for synonym in synonyms["synonyms"]:
                        if lowEntity == synonym.lower():
                            lowEntity = synonyms["value"]
                            match = False
                            break

        return lowEntity, match 

    def trainEntities(self, mitiemLocation, trainingData):
        """ Trains the NER model """
        
        trainer = ner_trainer(mitiemLocation)
        counter = 0
        hasEnts = 0

        for intents in trainingData['intents']:

            i = 0
            for entity in intents['entities']:

                hasEnts = 1
                tokens = trainingData['intents'][counter]["text"][i].lower().split()
                data = ner_training_instance(tokens)
                data.add_entity(
                    xrange(
                        entity["rangeFrom"],
                        entity["rangeTo"]), 
                    entity["entity"])
                trainer.add(data)
                
                i = i + 1
            counter = counter + 1

        if hasEnts:
            trainer.num_threads = 4
            ner = trainer.train()
            ner.save_to_disk(self.Helpers.confs["NLU"]["EntitiesDat"])