############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
# Project:       Movidius NCS1 Classifier
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Contributors:
# Title:         Augmentation Data Helper Class
# Description:   Helper functions for the AML/ALL Detection System Movidius NCS1
#                Classifier.
# License:       MIT License
# Last Modified: 2019-05-09
#
############################################################################################

import sys
import time
import logging
import logging.handlers as handlers
import json

from datetime import datetime


class Helpers():
    """ AML/ALL Detection System Movidius NCS1 Classifier Helper Class

    Common helper functions for the AML/ALL Detection System Movidius NCS1 Classifier.
    """

    def __init__(self, loggerType):
        """ Initializes the AML/ALL Detection System Movidius NCS1 Classifier Helpers Class. """

        self.confs = {}
        self.loadConfs()

        self.logger = logging.getLogger(loggerType)
        self.logger.setLevel(logging.INFO)

        formatter = logging.Formatter(
            '%(asctime)s - %(name)s - %(levelname)s - %(message)s')

        allLogHandler = handlers.TimedRotatingFileHandler(
            self.confs["Settings"]["Logs"] + 'all.log', when='H', interval=1, backupCount=0)
        allLogHandler.setLevel(logging.INFO)
        allLogHandler.setFormatter(formatter)

        errorLogHandler = handlers.TimedRotatingFileHandler(
            self.confs["Settings"]["Logs"] + 'error.log', when='H', interval=1, backupCount=0)
        errorLogHandler.setLevel(logging.ERROR)
        errorLogHandler.setFormatter(formatter)

        warningLogHandler = handlers.TimedRotatingFileHandler(
            self.confs["Settings"]["Logs"] + 'warning.log', when='H', interval=1, backupCount=0)
        warningLogHandler.setLevel(logging.WARNING)
        warningLogHandler.setFormatter(formatter)

        consoleHandler = logging.StreamHandler(sys.stdout)
        consoleHandler.setFormatter(formatter)

        self.logger.addHandler(allLogHandler)
        self.logger.addHandler(errorLogHandler)
        self.logger.addHandler(warningLogHandler)
        self.logger.addHandler(consoleHandler)

        self.logger.info("Helpers class initialization complete.")

    def loadConfs(self):
        """ Load the AML DNN Classifier configuration. """

        with open('Required/confs.json') as confs:
            self.confs = json.loads(confs.read())

    def currentDateTime(self):
        """ Gets the current date and time in words. """

        return datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    def timerStart(self):
        """ Starts the timer. """

        return str(datetime.now()), time.time()

    def timerEnd(self, start):
        """ Ends the timer. """

        return time.time(), (time.time() - start), str(datetime.now())
