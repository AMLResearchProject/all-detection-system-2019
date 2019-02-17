# Acute Myeloid/Lymphoblastic Leukemia Movidius NCS Classifier
![Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project](../Media/Images/banner.jpg) 

The Peter Moss Acute Myeloid/Lymphoblastic Leukemia Classifier Movidius NCS Classifier is a Python Convolutional Neural Network coded in Python using Tensorflow, Inception V3 and Transfer Learning. The classifier is part of the [Peter Moss Acute Myeloid/Lymphoblastic (AML/ALL) Leukemia AI Research Project](https://www.facebook.com/AMLResearchProject/) computer vision R&D with the focus of detection/early detection of AML & ALL.

The classifier and tutorial allow you to train a Convolutional Neural Network using TensorFlow [8] and transfer learning trained, using a dataset of images containing positive and negative Acute Lymphoblastic Leukemia: Acute Lymphoblastic Leukemia Image Database for Image Processing [9]. The Tensorflow model is trained on Intel AI DevCloud [10] and then converted to a format compatible with the Movidius NCS by freezing the Tensorflow model and then running it through the NCSDK [11]. The model is then downloaded to an UP Squared, and then used for inference with NCSDK. 

This classifier is an upgrade to the classifier previously built for the sister project, [Breast Cancer AI/Invasice Ductal Carcinoma Classifier](https://www.breastcancerai.com/).

# Acute Myeloid Leukemia (AML)
Despite being one of the most common forms of Leukemia, Acute Myeloid Leukemia (AML) is a still a relatively rare form of Leukemia that is more common in adults, but does affect children also. AML is an agressive Leukemia where white blood cells mutate, attack and replace healthy red blood cells, effectively killing them. 

"About 19,520 new cases of acute myeloid leukemia (AML). Most will be in adults (United States)." [6]

In comparrison, there are 180,000 women a year in the United States being diagnosed with Invasive Ductal Carcinoma (IDC), a type of breast cancer which forms in the breast duct and invades the areas surrounding it [7].

# Acute Lymphoblastic Leukemia (ALL)
Acute Lymphoblastic Leukemia is found in children and causes abnormally excesive ammount of white blood cells known as lymphocytes. This form of Leukemia is also known as Acute Lymphocytic Leukemia.

# Acute Lymphoblastic Leukemia Image Database for Image Processing (ALL-IDB)
![Acute Lymphoblastic Leukemia Image Database for Image Processing](Media/Images/slides.png)
Figure 1. Samples of augmented data generated from the Acute Lymphoblastic Leukemia Image Database for Image Processing dataset.

The [Acute Lymphoblastic Leukemia Image Database for Image Processing](https://homes.di.unimi.it/scotti/all/) dataset is used for this project. The dataset was created by [Fabio Scotti, Associate Professor Dipartimento di Informatica, Università degli Studi di Milano](https://homes.di.unimi.it/scotti/). Big thanks to Fabio for his research and time put in to creating the dataset and documentation, it is one of his personal projects.

# Convolutional Neural Networks
![Inception v3 architecture](Media/Images/CNN.jpg)
Figure 2. Inception v3 architecture ([Source](https://github.com/tensorflow/models/tree/master/research/inception)).

Convolutional neural networks are a type of deep learning neural network. These types of neural nets are widely used in computer vision and have pushed the capabilities of computer vision over the last few years, performing exceptionally better than older, more traditional neural networks; however, studies show that there are trade-offs related to training times and accuracy.

# Transfer Learning
![Inception v3 model diagram](Media/Images/Transfer-Learning.jpg)
Figure 3. Inception V3 Transfer Learning ([Source](https://github.com/Hvass-Labs/TensorFlow-Tutorials)).

Transfer learning allows you to retrain the final layer of an existing model, resulting in a significant decrease in not only training time, but also the size of the dataset required. One of the most famous models that can be used for transfer learning is the Inception V3 model created by Google This model was trained on thousands of images from 1,001 classes on some very powerful devices. Being able to retrain the final layer means that you can maintain the knowledge that the model had learned during its original training and apply it to your smaller dataset, resulting in highly accurate classifications without the need for extensive training and computational power.

# Hardware & Software
In this particular part of the project I use Intel® technologies such as Intel® AI DevCloud for data sorting and training and UP Squared with Intel Movidius (NCS) for inference.

# System Requirements
- Tested on Ubuntu 18.04 & 16.04
- [Tested with Python 3.5](https://www.python.org/downloads/release/python-350/ "Tested with Python 3.5")
- Requires PIP3
- [Intel® Movidius™ NCSDK](https://github.com/movidius/ncsdk "Intel® Movidius™ NCSDK")
- [Tensorflow 1.4.0](https://www.tensorflow.org/install "Tensorflow 1.4.0")

###  - Gain Access To ALL-IDB
You you need to be granted access to use the Acute Lymphoblastic Leukemia Image Database for Image Processing dataset. You can find the application form and information about getting access to the dataset on [this page](https://homes.di.unimi.it/scotti/all/#download) as well as information on how to contribute back to the project [here](https://homes.di.unimi.it/scotti/all/results.php). If you are not able to obtain a copy of the dataset please feel free to try this tutorial on your own dataset.

### - Data Augmentation
Assuming you have received permission to use the Acute Lymphoblastic Leukemia Image Database for Image Processing, you should follow the related Notebook first to generate a larger training and testing dataset. Follow the AML/ALL Classifier [Data Augmentation Notebook](https://github.com/AMLResearchProject/AML-Detection-System/blob/master/Augmentation/Augmentation.ipynb) to apply various filters to the dataset. If you have not been able to obtain a copy of the dataset please feel free to try this tutorial on your own dataset.

Data augmentations included are as follows...

- Grayscaling
- Histogram Equalization
- Reflection
- Gaussian Blur
- Rotation

# Installation
Below is a guide on how to install the augmentation program on your device, as mentioned above the program has been tested with Ubuntu 18.04 & 16.04, but may work on other versions of Linux and possibly Windows.

## UFW Firewall

UFW firewall is used to protect the ports of your device. 

```
 $ sudo ufw status
   Status: inactive
```
If you are using this system on the same device as your GeniSys server, the local firewall has already been set up when you set up the server all you need to do is open the ports that you decide to use for this project.

The ports are specified in **required/confs.json**. The default port is set to **8080**. **FOR YOUR SECURITY YOU SHOULD CHANGE THESE!**.

```
"Classifier":
    {
        "API": {
            "IP": "Your IP",
            "Port": 8080
        },
   }
```

To allow access to the ports use the following command for each of your ports:

```
 $ sudo ufw allow 8080
 $ sudo ufw status
```

```
 Status: active

 To                         Action      From
 --                         ------      ----
 22                         ALLOW       Anywhere
 8080                       ALLOW       Anywhere
 22 (v6)                    ALLOW       Anywhere (v6)
 8080 (v6)                  ALLOW       Anywhere (v6)
```

## Clone the repository
First of all you should clone the [AML/ALL Detection System](https://github.com/AMLResearchProject/AML-Detection-System/ "AML/ALL Detection System") repo to your device. To do this can you navigate to the location you want to download to on your device using terminal  (cd Your/Download/Location), and then use the following commands:

```
  $ git clone https://github.com/AMLResearchProject/AML-Detection-System.git
```

Once you have used the command above you will see a directory called __AML-Detection-System__ in the location you chose to download the repo to. In terminal, navigate to the __AML-Detection-System/AMLResearchProject/AML-Detection-System/tree/master/Classifiers/Movidius/NCS__, you are now ready to upload your project to Intel aI DevCloud to train your classifier.

## Upload project to AI DevCloud
Assuming you have followed the [AML/ALL Movidius NCS Classifier README](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Classifiers/Movidius/NCS "AML/ALL Movidius NCS Classifier README"), you now need to upload the related project from the repo to the AI DevCloud. The directory you need to upload is __AML-Detection-System/Classifiers/Movidius/NCS__. Once you have uploaded the project structure you need to upload your augmented dataset created in the previous tutorial. Upload your data to the __0__ and __1__ directories in the __Model/Data/__ directory, you should also remove the init files from these directories.

## Interactive Tutorial
Once you have completed the above, navigate to this Jupyter Notebook and continue the tutorial there.

# Contributing
We welcome contributions of the project. Please read [CONTRIBUTING.md](https://github.com/AMLResearchProject/AML-Detection-System/blob/master/CONTRIBUTING.md "CONTRIBUTING.md") for details on our code of conduct, and the process for submitting pull requests.

# Versioning
We use SemVer for versioning. For the versions available, see [Releases](https://github.com/AMLResearchProject/AML-Detection-System/releases "Releases").

# License
This project is licensed under the **MIT License** - see the [LICENSE](https://github.com/AMLResearchProject/AML-Detection-System/blob/master/LICENSE "LICENSE") file for details.

# Bugs/Issues
We use the [repo issues](https://github.com/AMLResearchProject/AML-Detection-System/issues "repo issues") to track bugs and general requests related to using this project. 

# Repository Manager
Adam is a [BigFinite](https://www.bigfinite.com "BigFinite") IoT Network Engineer, part of the team that works on the core IoT software. In his spare time he is an [Intel Software Innovator](https://software.intel.com/en-us/intel-software-innovators/overview "Intel Software Innovator") in the fields of Internet of Things, Artificial Intelligence and Virtual Reality.

[![Adam Milton-Barker: BigFinte IoT Network Engineer & Intel® Software Innovator](../Media/Images/Adam-Milton-Barker.jpg)](https://github.com/AdamMiltonBarker)