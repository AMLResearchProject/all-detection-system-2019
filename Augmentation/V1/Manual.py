
############################################################################################
#
# Project:       Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project
# Repository:    AML/ALL Detection System
#
# Author:        Adam Milton-Barker (AdamMiltonBarker.com)
# Title:         Manual Augmentation Class
# Description:   Manual augmentation class for the AML/ALL Detection System.
# License:       MIT License
# Last Modified: 2019-05-09
#
############################################################################################

import matplotlib.pyplot as plt

from Classes.Data import Data

plt.rcParams['figure.figsize'] = (5.0, 4.0)
plt.rcParams['image.interpolation'] = 'nearest'
plt.rcParams['image.cmap'] = 'gray'


class ManualAugmentation():
    """ AML/ALL Detection System Manual Augmentation Class

    Manual augmentation class for the AML/ALL Detection System.
    """

    def __init__(self):
        """ Initializes the AML/ALL Detection System Manual Augmentation Class. """

        self.Data = Data()

    def processDataset(self):
        """ Processes the AML/ALL Detection System Dataset. 
        Make sure you have your equal amounts of positive and negative
        samples in the Model/Data directories.

        Only run this function once! it will continually make copies
        of all images in the Settings->TrainDir directory specified
        in Required/confs.json
        """

        self.Data.processDataset()


print("!! Data Augmentation Program Starting !!")
print("")
ManualAugmentation = ManualAugmentation()
ManualAugmentation.processDataset()
print(" Data Augmentation Program Complete")
print("")
