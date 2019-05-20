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
# Title:         Movidius Helper Class
# Description:   Movidius helper functions for the Acute Myeloid Leukemia Detection System.
# Configuration: required/confs.json
# Last Modified: 2018-12-08
#
############################################################################################

import json

class Configuration():

    def __init__(self):

        self.AiCore = None
        self.Cameras = None
        self.Classifier = None
        self.IotJumpWay = None
        self.MySql = None

        self.loadConfiguration()

    def loadConfiguration(self):

		###############################################################
		#
		# Loads the core JSON configuration from required/confs.json 
		#
		###############################################################

        with open("required/confs.json") as configs:
            self.configs = json.loads(configs.read())
            
        self.AiCore = self.configs["AiCore"]
        self.Cameras = self.configs["Cameras"]
        self.Classifier = self.configs["Classifier"]
        self.IotJumpWay = self.configs["IotJumpWay"]
        self.MySql = self.configs["MySql"]

        



