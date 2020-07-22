############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Extensions Class
# Description:   Extensions class for the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################

class Extensions():
    """ ALL Detection System 2019 Extensions Class

    Extensions class for the ALL Detection System 2019 Chatbot. 
    """

    def __init__(self):
        """ Initializes the Extensions class. """
        pass

    def setExtension(self, intent):
        """ Sets and returns the extension path and responses. """

        extensionResponses = []
        extension = None
        entities  = False

        extension = intent["extension"]["function"] if intent["extension"]["function"] !="" else None

        if extension != None:
            extensionResponses = intent["extension"]["responses"]
            entities = intent["extension"]["entities"]

        return extension, extensionResponses, entities