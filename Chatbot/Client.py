############################################################################################
#
# Project:       Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
# Repository:    ALL Detection System 2019
# Project:       Chatbot
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Client Class
# Description:   Sends requests to the ALL Detection System 2019 Chatbot.
# License:       MIT License
# Last Modified: 2020-07-16
#
# Example Usage:
#
#   $ python3 Client.py "What is the Peter Moss Acute Lymphoblastic Leukemia Detection System?"
#
################################################################################################################

import sys, time, string, requests, json

from Classes.Helpers  import Helpers


class Client():
    """ ALL Detection System 2019 Chatbot Client Class

    Sends requests to the ALL Detection System 2019 Chatbot.
    """
    
    def __init__(self):
        """ Initializes the Chatbot Client class. """
        
        self.Helpers = Helpers()
        self.LogFile = self.Helpers.setLogFile(self.Helpers.confs["System"]["Logs"]+"Client/")
        
        self.apiUrl  = "http://" + self.Helpers.confs["System"]["IP"] + ":" + str(self.Helpers.confs["System"]["Port"])+"/infer"
        self.headers = {"content-type": 'application/json'}
            
        self.Helpers.logMessage(self.LogFile, "CLIENT", "INFO", "Client Ready")
            
if __name__ == "__main__":
        
    Client = Client()
    data   = {"query": str(sys.argv[1])}
        
    Client.Helpers.logMessage(Client.LogFile, "CLIENT",
        "INFO", "Sending string for classification...")
        
    response = requests.post(Client.apiUrl, data=json.dumps(data),
                                headers=Client.headers)
        
    Client.Helpers.logMessage(Client.LogFile, "CLIENT",
        "OK", "Response: "+str(response.text))
