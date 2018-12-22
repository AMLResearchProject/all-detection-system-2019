################################################################################################################
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
# Title:         Acute Myeloid Leukemia Detection System Chatbot Client
# Description:   Sends requests to the Acute Myeloid Leukemia Detection System Chatbot.
# Configuration: required/confs.json
# Training Data: data/training.json
# Last Modified: 2018-12-22
#
# Example Usage:
#
#   $ python3 Client.py CLASSIFY "What is the Peter Moss Acute Myeloid Leukemia Detection AI Research Project?"
#
################################################################################################################

import sys, time, string, requests, json

from Classes.Helpers  import Helpers

class Client():
    
    def __init__(self):
        
        self.Helpers = Helpers()
        
        self.Helpers = Helpers()
        self.confs  = self.Helpers.loadConfigs()
        self.LogFile = self.Helpers.setLogFile(self.confs["aiCore"]["Logs"]+"Client/")
        
        self.apiUrl  = "http://" + self.confs["aiCore"]["IP"] + ":" + str(self.confs["aiCore"]["Port"])+"/infer"
        self.headers = {"content-type": 'application/json'}
            
        self.Helpers.logMessage(
            self.LogFile,
            "CLIENT",
            "INFO",
            "Client Ready")
            
if __name__ == "__main__":
    
    if sys.argv[1] == "CLASSIFY":
        
        Client = Client()
        data   = {"query": str(sys.argv[2])}
            
        Client.Helpers.logMessage(
            Client.LogFile,
            "CLIENT",
            "INFO",
            "Sending string for classification...")
            
        response = requests.post(
                            Client.apiUrl,
                            data=json.dumps(data), 
                            headers=Client.headers)
            
        Client.Helpers.logMessage(
            Client.LogFile,
            "CLIENT",
            "OK",
            "Response: "+str(response.text))