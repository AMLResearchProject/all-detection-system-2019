############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Context Class
# Description:   Context class for the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-15
#
############################################################################################

class Context():
    """ ALL Detection System 2019 Context Class

    Context class for the ALL Detection System 2019 Chatbot. 
    """
    
    def __init__(self):
        """ Initializes the Context class. """
        
        pass
        
    def setContexts(self, theIntent, session):
        """ Sets all contexts. """

        contextIn  = self.setContextIn(theIntent)
        contextOut = self.setContextOut(theIntent)
        context    = self.getCurrentContext(session)

        return contextIn, contextOut, context

    def setContextIn(self, intent):
        """ Sets the current context in. """

        return intent["context"]["in"] if intent["context"]["in"] != "" else ""

    def setContextOut(self, intent):
        """ Sets the current context out. """
        
        return intent["context"]["out"] if intent["context"]["out"] != "" else ""

    def checkSessionContext(self, session, intent):
        """ Checks the current context session. """
        
        if("context" in session and intent["context"]["in"] == session["context"]): 
            return True 
        else: 
            return False

    def checkClearContext(self, intent, override=0):
        """ Checks if we are to clear the current context. """

        return True if intent["context"]["clear"] == True or override == 1 else False

    def getCurrentContext(self, session):
        """ Gets the current context. """

        return session["context"] if "context" in session else "NA"