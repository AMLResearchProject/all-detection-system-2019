# Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project

## Acute Myeloid & Lymphoblastic Leukemia Detection System

![Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project](https://www.PeterMossAmlAllResearch.com/media/images/repositories/banner.png)

### Acute Lymphoblastic Leukemia TF Slim Inception V3 NCS1 Classifier

The Acute Lymphoblastic Leukemia Inception V3 NCS1 TF Slim Classifier is a CNN (Convolutional Neural Network) coded in Python using Tensorflow/TF Slim, Inception V3 and Transfer Learning. The classifier is part of the [Peter Moss Acute Myeloid & Lymphoblastic (AML & ALL) Leukemia AI Research Project](https://www.amlresearchproject.com) computer vision R&D with the focus of detection/early detection of AML & ALL.

This tutorial allows you to train a CNN locally on CPU/GPU or on Intel AI DevCloud. The classifier is trained on data provided in the [Acute Lymphoblastic Leukemia Image Database for Image Processing](https://homes.di.unimi.it/scotti/all/) that has been augmented to increase our data using the [AML & ALL Detection System Data Augmentation program](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1 "AML & ALL Detection System Data Augmentation program"). The Tensorflow model is trained and then converted to a format compatible with the Movidius NCS1 by freezing the Tensorflow model and then running it through the NCSDK compiler. In this project I use an an UP Squared and the NCS1 for inference, but you can use any device that is running Ubuntu 16.04 or 18.04.

This classifier is an upgrade to the classifier previously built for the sister project, [Invasive Ductal Carcinoma Classifier](https://www.breastcancerai.com/).

&nbsp;

# Acute Myeloid Leukemia (AML)

Despite being one of the most common forms of Leukemia, Acute Myeloid Leukemia (AML) is a still a relatively rare form of Leukemia that is more common in adults, but does affect children also. AML is an aggressive Leukemia where white blood cells mutate, attack and replace healthy red blood cells, effectively killing them.

The American Cancer Society's [estimates for leukemia in the United States for 2019 are](https://www.cancer.org/cancer/acute-myeloid-leukemia/about/key-statistics.html "estimates for leukemia in the United States for 2019 are"):

- About 61,780 new cases of leukemia (all kinds) and 22,840 deaths from leukemia (all kinds)
- About 21,450 new cases of acute myeloid leukemia (AML). Most will be in adults.
- About 10,920 deaths from AML. Almost all will be in adults.

In comparison, according to the [American Cancer Society](https://www.cancer.org/cancer/acute-myeloid-leukemia/about/key-statistics.html "American Cancer Society") there are 180,000 women a year in the United States being diagnosed with Invasive Ductal Carcinoma (IDC), a type of breast cancer which forms in the breast duct and invades the areas surrounding it.

&nbsp;

# Acute Lymphoblastic Leukemia (ALL)

Acute Lymphoblastic Leukemia is found in children and causes abnormally excessive amount of white blood cells known as lymphocytes. This form of Leukemia is also known as Acute Lymphocytic Leukemia. In this project we use data for ALL as we have yet to discover a good computer vision dataset for AML.

The American Cancer Society’s [estimates for acute lymphocytic leukemia (ALL) in the United States for 2019 (including both children and adults) are](https://www.cancer.org/cancer/acute-lymphocytic-leukemia/about/key-statistics.html "estimates for acute lymphocytic leukemia (ALL) in the United States for 2019 (including both children and adults) are"):

- About 5,930 new cases of ALL (3,280 in males and 2,650 in females)
- About 1,500 deaths from ALL (850 in males and 650 in females)

&nbsp;

# Acute Lymphoblastic Leukemia Image Database for Image Processing (ALL-IDB)

![Acute Lymphoblastic Leukemia Image Database for Image Processing](https://www.PeterMossAmlAllResearch.com/media/images/repositories/ALL_IDB1_Augmented_Slides.png)
_Samples of augmented data generated using the Acute Lymphoblastic Leukemia Image Database for Image Processing dataset and the [AML & ALL Detection System Data Augmentation program](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1 "AML & ALL Detection System Data Augmentation program")._

The [Acute Lymphoblastic Leukemia Image Database for Image Processing](https://homes.di.unimi.it/scotti/all/) dataset is used for this project. The dataset was created by [Fabio Scotti, Associate Professor Dipartimento di Informatica, Università degli Studi di Milano](https://homes.di.unimi.it/scotti/). Big thanks to Fabio for his research and time put in to creating the dataset and documentation, it is one of his personal projects and without the dataset this project would not be possible.

&nbsp;

# Convolutional Neural Networks

![Inception v3 architecture](https://www.PeterMossAmlAllResearch.com/media/images/repositories/CNN.jpg)
_Inception v3 architecture_ ([Source](https://github.com/tensorflow/models/tree/master/research/inception)).

Convolutional neural networks are a type of deep learning neural network. These types of neural nets are widely used in computer vision and have pushed the capabilities of computer vision over the last few years, performing exceptionally better than older, more traditional neural networks; however, studies show that there are trade-offs related to training times and accuracy.

&nbsp;

# Transfer Learning

![Inception v3 model diagram](https://www.PeterMossAmlAllResearch.com/media/images/repositories/Transfer-Learning.jpg)  
_Inception V3 Transfer Learning_ ([Source](https://github.com/Hvass-Labs/TensorFlow-Tutorials)).

Transfer learning allows you to retrain the final layer of an existing model, resulting in a significant decrease in not only training time, but also the size of the dataset required. One of the most famous models that can be used for transfer learning is the Inception V3 model. Inception V3 by Google is the 3rd version in a series of Deep Learning Convolutional Architectures. Inception V3 was trained using a dataset of 1,000 classes ([See the list of classes here](https://gist.github.com/yrevar/942d3a0ac09ec9e5eb3a "See the list of classes here")) from the original ImageNet dataset which was trained with over 1 million training images, the Tensorflow version has 1,001 classes which is due to an additional "background' class not used in the original ImageNet. Inception V3 was trained for the ImageNet Large Visual Recognition Challenge where it was a first runner up.

&nbsp;

# System Requirements

- Tested on Ubuntu 18.04 & 16.04
- [Tested with Python 3 and above](https://www.python.org/download/releases/3.0/ "Tested with Python 3 and above")
- Requires PIP3

&nbsp;

# Hardware

![UP Squared & Movidius NCS1](https://www.PeterMossAmlAllResearch.com/media/images/repositories/UP2.jpg)
_UP Squared & Movidius NCS1._

- Training device with NVIDIA GPU or [Intel® AI DevCloud](https://software.intel.com/en-us/ai/devcloud "Intel® AI DevCloud")
- [UP2](https://up-shop.org/28-up-squared "UP2"), Raspberry Pi or other Linux device for testing
- [Intel Movidius Neural Compute Stick 1](https://software.intel.com/en-us/neural-compute-stick "Intel Movidius Neural Compute Stick 1")

&nbsp;

# Software

- [Tensorflow 1.4.0](https://www.tensorflow.org/install "Tensorflow 1.4.0")
- [Tensorflow Slim](https://github.com/tensorflow/tensorflow/tree/master/tensorflow/contrib/slim "Tensorflow Slim")
- [Intel® Movidius™ NCSDK](https://github.com/movidius/ncsdk "Intel® Movidius™ NCSDK")

Installed using Setup.sh, more information can be found later in the tutorial.

&nbsp;

# Gain Access To ALL-IDB

You you need to be granted access to use the Acute Lymphoblastic Leukemia Image Database for Image Processing dataset. You can find the application form and information about getting access to the dataset on [this page](https://homes.di.unimi.it/scotti/all/#download) as well as information on how to contribute back to the project [here](https://homes.di.unimi.it/scotti/all/results.php). If you are not able to obtain a copy of the dataset please feel free to try this tutorial on your own dataset, we would be very happy to find additional AML & ALL datasets.

&nbsp;

# Data Augmentation

Assuming you have received permission to use the Acute Lymphoblastic Leukemia Image Database for Image Processing, you should follow the [Data Augmentation Jupyter Notebook](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1/Augmentation.ipynb "Data Augmentation Jupyter Notebook") or [Data Augmentation Using Python](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1/Manual.py "Data Augmentation Using Python") ([Tutorial](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1/ "Tutorial"))to generate a larger training and testing dataset. Follow the Notebook or README to apply various filters to the dataset.

Data augmentations included are as follows:

- Grayscaling
- Histogram equalization
- Horizontal and vertical reflection
- Rotation
- Translation
- Gaussian blur

In my case the exact testing data that I extracted before creating the augmentation data set is as follows:

- Im006_1.jpg
- Im020_1.jpg
- Im024_1.jpg
- Im026_1.jpg
- Im028_1.jpg
- Im031_1.jpg
- Im035_1.jpg
- Im041_1.jpg
- Im047_1.jpg
- Im053_1.jpg
- Im057_1.jpg
- Im060_1.jpg
- Im063_1.jpg
- Im069_1.jpg
- Im074_1.jpg
- Im088_1.jpg
- Im095_1.jpg
- Im099_1.jpg
- Im0101_1.jpg
- Im0106_1.jpg

It is important that your testing data is removed from your training data. The point is to ensure that when testing, you are using images that the network has never seen before.

&nbsp;

# Installation

Below is a guide on how to install the Acute Lymphoblastic Leukemia TF Slim Inception V3 NCS1 Classifier on your device, as mentioned above the program has been tested with Ubuntu 18.04 & 16.04, but may work on other versions of Linux and possibly Windows.

## UFW Firewall

UFW firewall is used to protect the ports of your device.

```
 $ sudo ufw status
```

```
   Status: inactive
```

If you are using this system on the same device as your GeniSysAI server, the local firewall has already been set up when you set up the server, all you need to do is open the ports that you decide to use for this project and add the port to the configuration file.

The ports are specified in **Required/confs.json**. The default port is set to **8080**. **FOR YOUR SECURITY YOU SHOULD CHANGE THESE!**.

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

First of all you should clone the [AML & ALL Detection System](https://github.com/AMLResearchProject/AML-ALL-Detection-System/ "AML & ALL Detection System") repo to your device. To do this you can navigate to the location you want to download to on your device using terminal (cd Your/Download/Location), and then use the following commands:

```
  $ git clone https://github.com/AMLResearchProject/AML-ALL-Detection-System.git
```

Once you have used the command above you will see a directory called **AML-ALL-Detection-System** in the location you chose to download the repo to. In terminal, navigate to the **AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1** and use the following command to install the required software for this program.

```
 $ sh Setup.sh
```

This file will install everything you need for the Acute Lymphoblastic Leukemia Tensorflow/TF Slim Inception V3 NCS1 Classifier.

If you have problems running the above program and have errors try run the following command before executing the shell script. You may be getting errors due to the shell script having been edited on Windows, the following command will clean the setup file.

```
 $ sed -i 's/\r//' setup.sh
 $ sh setup.sh
```

&nbsp;

# Augment Your Data

Once you have everything installed if you have not yet done so you need to follow the [Data Augmentation Jupyter Notebook](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1/Augmentation.ipynb "Data Augmentation Jupyter Notebook") or [Data Augmentation Using Python](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1/Manual.py "Data Augmentation Using Python") ([Tutorial](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1/ "Tutorial")) to generate a larger training and testing dataset.

Once you have the augmented dataset you should have 1053 training images per class. You now need to move the augmented dataset to the [AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model/Data directory](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1/Model/Data/ "AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model/Data directory") to your training device or AI DevCloud, and also move your testing data to the [AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model/Test directory](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1/Model/Test/ "AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model/Test directory") on your testing device.

&nbsp;

# Adjusting Your Configuration

You can modify the configuration for your model using the configuration file in **Required/confs.json**. If you would like to try and replicate my results exactly, all you need to modify is the IP address that will be used by the API server.

```
{
  "Settings": {
    "Logs": "Logs/"
  },
  "Classifier": {
    "ALLGraph": "Model/ALLGraph.pb",
    "BatchSize": 10,
    "BatchTestSize": 30,
    "Classes": "Classes.txt",
    "DatasetDir": "Model/Data",
    "Domain": "",
    "Epochs": 65,
    "EpochsTest": 1,
    "EpochsDevCloud": 40,
    "EpochsBeforeDecay": 10,
    "FilePattern": "ALL_%s_*.tfrecord",
    "ImageSize": 299,
    "InceptionThreshold": 0.8,
    "InceptionGraph": "Model/ALL.graph",
    "IP": "",
    "Labels": "Labels.txt",
    "LearningRate": 0.0001,
    "LearningRateDecay": 0.8,
    "LogDir": "Model/_logs",
    "LogDirEval": "Model/_logs_eval",
    "Mean": 128,
    "NetworkPath": "",
    "NumClasses": 2,
    "OutputNode": "InceptionV3/Predictions/Softmax",
    "Port": 8080,
    "RandomSeed": 50,
    "Shards": 10,
    "TestImagePath": "Model/Test",
    "TFRecordFile": "ALL",
    "TFRecordPattern": "ALL_%s_*.tfrecord",
    "ValidationSize": 0.3,
    "ValidIType": [
      ".JPG",
      ".JPEG",
      ".PNG",
      ".GIF",
      ".jpg",
      ".jpeg",
      ".png",
      ".gif"
    ]
  }
}
```

&nbsp;

# Training On CPU/NVIDIA GPU

It is not recommended to train on CPU, although it should be possible it will take a long time and may max out resources. If you are training on your own device I would recommended that you use an NVIDIA GPU. You need to make sure you have Tensorflow/Tensprflow GPU 1.4.0 and related CUDA/CUDNN libraries installed before you can begin.

## Prepare Your Data For Training

The first thing you need to do is prepare your data ready to be used for training. Ensure you have moved your augmented data to the correct location and then use the following command:

```
 $ python3 Data.py
```

## Training Your Model

Now it is time to train your model. To do so, you simply need to run the following command and wait for the program to finish, this will take some time so take a break from the computer.

```
 $ python3 Trainer.py
```

Once the program is finished you should see something similar to the below output:

```
INFO:tensorflow: Epch 65.97 Glb Stp 9551: Loss: 0.5637 (0.54 sec/step)
INFO:tensorflow: Epch 65.97 Glb Stp 9552: Loss: 0.5905 (0.59 sec/step)
INFO:tensorflow: Epch 65.98 Glb Stp 9553: Loss: 0.5823 (0.55 sec/step)
INFO:tensorflow: Epch 65.99 Glb Stp 9554: Loss: 0.5867 (0.57 sec/step)
INFO:tensorflow: Epch 65.99 Glb Stp 9555: Loss: 0.5619 (0.57 sec/step)
INFO:tensorflow:Final Loss: 0.56189835
INFO:tensorflow:Final Accuracy: 0.96698064
INFO:tensorflow:Finished training! Saving model to disk now.
2019-05-16 18:41:31.789112: I tensorflow/core/common_runtime/gpu/gpu_device.cc:1120] Creating TensorFlow device (/device:GPU:0) -> (device: 0, name: GeForce GTX 1050 Ti, pci bus id: 0000:01:00.0, compute capability: 6.1)
INFO:tensorflow:Restoring parameters from Model/_logs/model.ckpt-9343
Exporting graph...
INFO:tensorflow:Froze 378 variables.
Converted 378 variables to const ops.
2019-05-16 18:41:33,286 - Trainer - INFO - AML & ALL Detection System Movidius NCS1 Trainer ended in 5538.545530080795
```

You will see that our final training loss is **0.56189835** and our final training accuracy is **0.96698064** so there is still room for improvement. You will find out how to see more info about the training process in the **Tensorboard** section below.

## Validate Your Model

Now we need to validate your model. To do this run the below code:

```
 $ python3 Validation.py
```

Once the program is finished you should see something similar to the below output although results may vary depending on your setup and data splits:

```
INFO:tensorflow:Global Step 17: Streaming Accuracy: 0.9625 (0.51 sec/step)
INFO:tensorflow:Global Step 18: Streaming Accuracy: 0.9588 (0.54 sec/step)
INFO:tensorflow:Global Step 19: Streaming Accuracy: 0.9556 (0.54 sec/step)
INFO:tensorflow:Global Step 20: Streaming Accuracy: 0.9544 (0.53 sec/step)
INFO:tensorflow:Global Step 21: Streaming Accuracy: 0.9533 (0.53 sec/step)
INFO:tensorflow:Final Streaming Accuracy: 0.9540
INFO:tensorflow:Model evaluation has completed! Visit TensorBoard for more information regarding your evaluation.
```

You will see that our final streaming accuracy is **0.9540** which is a little lower than the training accuracy shown above. We need to look more into what happened during training so we can see how to improve our model for version 2. To do this we can use Tensorboard, follow the instructions below.

&nbsp;

# Tensorboard

Tensorboard is a graphical interface that can give you more detailed information and specfics about what went on during your training and validation. During the training and validation stages, logs were written to **AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model/\_logs** & **AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model/\_logs_eval**. These logs can be used by Tensorboard to view more detailed information about your model. To run Tensorboard, navigate to the **AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/** directory and use the following commands, you will be given a URL in the output which will allow you to access Tensorboard on your local network.

**Training Logs**

```
 $ tensorboard --logdir=Model/_logs
```

**Validation Logs**

```
 $ tensorboard --logdir=Model/_logs_eval
```

## Tensorboard Training Graphs

There are two main graphs we are interested in, Training_Accuracy & Training_losses/Total_Loss.

![Training_Accuracy](https://www.PeterMossAmlAllResearch.com/media/images/repositories/Training-Accuracy.png)
_CPU/GPU Training Accuracy._

![Training_losses/Total_Loss](https://www.PeterMossAmlAllResearch.com/media/images/repositories/Training-Loss.png)
_CPU/GPU Training Loss._

## Tensorboard Validation Graphs

There are two main graphs we are interested in, Valdation_Accuracy & Validation_losses/Total_Loss.

![Validation_Accuracy](https://www.PeterMossAmlAllResearch.com/media/images/repositories/Validation-Accuracy.png)
_CPU/GPU Validation Accuracy._

![Training_losses/Total_Loss](https://www.PeterMossAmlAllResearch.com/media/images/repositories/Validation-Loss.png)
_CPU/GPU Validation Loss._

Overall our model seems to be good, in V2 we will look at ways we can improve this model. You can now skip the **Training On AI DevCloud** section below and move on to the **Intel Movidius Neural Compute Stick 1** section.

&nbsp;

# Intel Movidius Neural Compute Stick 1

![Intel® Movidius NCS1](https://www.PeterMossAmlAllResearch.com/media/images/repositories/Movidius-NCS1.jpg)

In this project we use NCS1 to run classifications in near real time. If your testing device is an IoT development device such as am UP Squared or Raspberry Pi it is recommended that you install the full NCSDK on your training device and the NCSDK API on your testing device. You can of course simply use your training device for both training and testing, in which case you only need to follow the guide for installing the full SDK.

## Install Full NCSDK On Your Training Device

The **NCSDK** needs to be installed on your training device, this will be used to convert the trained model into a format that is compatible with the Movidius NCS1. To install NCSDK use the following commands:

```
 $ mkdir -p ~/workspace && cd ~/workspace
 $ git clone https://github.com/movidius/ncsdk.git
 $ cd ~/workspace/ncsdk
 $ make install
```

If you want to play around with the examples, plug your Movidius into your device and issue the following commands:

```
 $ cd ~/workspace/ncsdk
 $ make examples
```

## Install NCSDK API On Your Testing Device

If you are using a smaller device for your testing device, you may need to install the NCSDK API which is a lot smaller than the full SDK but has some features that are not available such as compiling your graph. This will be used by the classifier to carry out inference on local images or images received via the API hosted on the GeniSysAI server you installed. Make sure you have the Movidius plugged in.

```
 $ mkdir -p ~/workspace && cd ~/workspace
 $ git clone https://github.com/movidius/ncsdk.git
 $ cd ~/workspace/ncsdk/api/src
 $ make
 $ sudo make install
```

## Converting Your Graph

Now we need to compile the frozen Tensorflow/TF Slim graph produced during training into a format that is compatible with the NCS1. To do this we need to ensure that the file **ALLGraph.pb** is in the **AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model** directory and navigate to the **AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/** directory in terminal. Once there you can execute the following commands to compile the graph:

```
 $ mvNCCompile  -s 12 Model/ALLGraph.pb -in=input -on=InceptionV3/Predictions/Softmax -o Model/ALL.graph
```

The above command will save ALL.graph to the **AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Model** directory.

&nbsp;

# Testing On Unseen Data

Now we will use [AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Classifier.py](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1/Classifier.py "AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Classifier.py") with your test data. This classifier passes your test data through the NCS1 and predicts if Acute Lymphoblastic Leukemia is found in the images. You will see the output in console and you can also locate all AML & ALL Detection System logs in the [AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Logs](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1/Logs "AML-ALL-Detection-System/Classifiers/Movidius/NCS/Tensorflow/V1/Logs") directory. To run the classifier, use the following command:

```
 $ python3 Classifier.py
```

This will run the classifier program using your test data. If you used the exact configuration and data splits you should see the following output although results may vary depending on your setup and data splits:

<details> 
  <summary>CPU/GPU Trained Results</summary>

```
2019-05-16 18:54:21,860 - Classifier - INFO - Helpers class initialization complete.
2019-05-16 18:54:21,860 - Movidius - INFO - Helpers class initialization complete.
2019-05-16 18:54:21,860 - Movidius - INFO - Movidius class initialization complete.
2019-05-16 18:54:22,430 - Movidius - INFO - Connected To NCS1 successfully.
2019-05-16 18:54:22,596 - Movidius - INFO - Movidius graph allocated successfully.
2019-05-16 18:54:22,597 - Movidius - INFO - Inception loaded successfully.
2019-05-16 18:54:22,602 - Classifier - INFO - Classifier class initialization complete.
2019-05-16 18:54:22,602 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 Classifier started.
2019-05-16 18:54:22,717 - Classifier - INFO - Loaded test image Model/Test/Im047_0.jpg
2019-05-16 18:54:22,727 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:23,104 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.3772411346435547
2019-05-16 18:54:23,105 - Classifier - INFO - ALL correctly not detected with confidence of 0.996 in 0.3772411346435547
2019-05-16 18:54:23,188 - Classifier - INFO - Loaded test image Model/Test/Im069_0.jpg
2019-05-16 18:54:23,193 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:23,523 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.32992982864379883
2019-05-16 18:54:23,524 - Classifier - INFO - ALL correctly not detected with confidence of 0.998 in 0.32992982864379883
2019-05-16 18:54:23,588 - Classifier - INFO - Loaded test image Model/Test/Im024_1.jpg
2019-05-16 18:54:23,592 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:23,922 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.329970121383667
2019-05-16 18:54:23,923 - Classifier - INFO - ALL correctly detected with confidence of 0.9717 in 0.329970121383667
2019-05-16 18:54:24,028 - Classifier - INFO - Loaded test image Model/Test/Im063_1.jpg
2019-05-16 18:54:24,033 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:24,364 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.3305361270904541
2019-05-16 18:54:24,364 - Classifier - INFO - ALL correctly detected with confidence of 1.0 in 0.3305361270904541
2019-05-16 18:54:24,466 - Classifier - INFO - Loaded test image Model/Test/Im060_1.jpg
2019-05-16 18:54:24,471 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:24,801 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.3299868106842041
2019-05-16 18:54:24,801 - Classifier - INFO - ALL correctly detected with confidence of 1.0 in 0.3299868106842041
2019-05-16 18:54:24,836 - Classifier - INFO - Loaded test image Model/Test/Im028_1.jpg
2019-05-16 18:54:24,839 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:25,169 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33057355880737305
2019-05-16 18:54:25,170 - Classifier - INFO - ALL correctly detected with LOW confidence of 0.535 in 0.33057355880737305
2019-05-16 18:54:25,244 - Classifier - INFO - Loaded test image Model/Test/Im041_0.jpg
2019-05-16 18:54:25,249 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:25,579 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.329897403717041
2019-05-16 18:54:25,579 - Classifier - INFO - ALL correctly not detected with confidence of 1.0 in 0.329897403717041
2019-05-16 18:54:25,656 - Classifier - INFO - Loaded test image Model/Test/Im101_0.jpg
2019-05-16 18:54:25,661 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:25,991 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33039259910583496
2019-05-16 18:54:25,992 - Classifier - INFO - ALL correctly not detected with confidence of 0.999 in 0.33039259910583496
2019-05-16 18:54:26,050 - Classifier - INFO - Loaded test image Model/Test/Im006_1.jpg
2019-05-16 18:54:26,053 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:26,382 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.3289906978607178
2019-05-16 18:54:26,382 - Classifier - INFO - ALL correctly detected with confidence of 1.0 in 0.3289906978607178
2019-05-16 18:54:26,456 - Classifier - INFO - Loaded test image Model/Test/Im106_0.jpg
2019-05-16 18:54:26,461 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:26,792 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.330230712890625
2019-05-16 18:54:26,792 - Classifier - INFO - ALL correctly not detected with confidence of 1.0 in 0.330230712890625
2019-05-16 18:54:26,849 - Classifier - INFO - Loaded test image Model/Test/Im031_1.jpg
2019-05-16 18:54:26,851 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:27,181 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.3298039436340332
2019-05-16 18:54:27,181 - Classifier - INFO - ALL correctly detected with LOW confidence of 0.627 in 0.3298039436340332
2019-05-16 18:54:27,277 - Classifier - INFO - Loaded test image Model/Test/Im095_0.jpg
2019-05-16 18:54:27,282 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:27,613 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33101320266723633
2019-05-16 18:54:27,614 - Classifier - INFO - ALL correctly not detected with LOW confidence of 0.6353 in 0.33101320266723633
2019-05-16 18:54:27,712 - Classifier - INFO - Loaded test image Model/Test/Im057_1.jpg
2019-05-16 18:54:27,717 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:28,047 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33032727241516113
2019-05-16 18:54:28,048 - Classifier - INFO - ALL correctly detected with confidence of 1.0 in 0.33032727241516113
2019-05-16 18:54:28,122 - Classifier - INFO - Loaded test image Model/Test/Im053_1.jpg
2019-05-16 18:54:28,128 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:28,460 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.3321037292480469
2019-05-16 18:54:28,461 - Classifier - INFO - ALL correctly detected with confidence of 1.0 in 0.3321037292480469
2019-05-16 18:54:28,563 - Classifier - INFO - Loaded test image Model/Test/Im088_0.jpg
2019-05-16 18:54:28,568 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:28,898 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33005690574645996
2019-05-16 18:54:28,898 - Classifier - INFO - ALL correctly not detected with confidence of 0.9395 in 0.33005690574645996
2019-05-16 18:54:28,931 - Classifier - INFO - Loaded test image Model/Test/Im020_1.jpg
2019-05-16 18:54:28,933 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:29,263 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.329453706741333
2019-05-16 18:54:29,263 - Classifier - WARNING - ALL incorrectly not detected with LOW confidence of 0.6143 in 0.329453706741333
2019-05-16 18:54:29,294 - Classifier - INFO - Loaded test image Model/Test/Im026_1.jpg
2019-05-16 18:54:29,297 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:29,627 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.32950830459594727
2019-05-16 18:54:29,627 - Classifier - INFO - ALL correctly detected with confidence of 0.993 in 0.32950830459594727
2019-05-16 18:54:29,701 - Classifier - INFO - Loaded test image Model/Test/Im099_0.jpg
2019-05-16 18:54:29,706 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:30,036 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.32971668243408203
2019-05-16 18:54:30,036 - Classifier - INFO - ALL correctly not detected with confidence of 1.0 in 0.32971668243408203
2019-05-16 18:54:30,111 - Classifier - INFO - Loaded test image Model/Test/Im074_0.jpg
2019-05-16 18:54:30,116 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:30,447 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33063435554504395
2019-05-16 18:54:30,447 - Classifier - INFO - ALL correctly not detected with confidence of 0.9863 in 0.33063435554504395
2019-05-16 18:54:30,522 - Classifier - INFO - Loaded test image Model/Test/Im035_0.jpg
2019-05-16 18:54:30,527 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection started.
2019-05-16 18:54:30,857 - Classifier - INFO - AML & ALL Detection System Movidius NCS1 detection ended taking 0.33020448684692383
2019-05-16 18:54:30,858 - Classifier - INFO - ALL correctly not detected with confidence of 0.999 in 0.33020448684692383
2019-05-16 18:54:30,858 - Classifier - INFO - Testing ended. 19 correct, 1 incorrect, 4 low confidence: (3 correct, 1 incorrect)
```

</details>

&nbsp;

# Serving Your ALL Model

Now that we are all trained and tested, it is time to set up the server that will serve an **API endpoint** that provides access to your trained model via HTTP requests. The GeniSysAI UI will use this API to interact with the AI for training / classifying etc.

- **Server.py** starts a **Rest api server** with **API endpoints** for your **ALL** classifier.
- **Client.py** is provided to test sending images via HTTP to the API to receive a classification.

The server will run on the IP you specify in the configuration file. The server will use the following files/folders on your testing device.

```
Model/Data/Captured/
Model/Data/Classes.txt
Model/Data/Labels.txt

Model/Test/

Model/ALL.graph

Required/confs.json

Client.py
Server.py
```

On your testing device, open up a terminal and navigate to the to the folder containing Server.py then issue the following command. This will start the server and wait to receive images for classification.

```
$ python3 Server.py
```

You should see the following output:

```
2019-05-18 11:04:35,149 - ClassifierServer - INFO - Helpers class initialization complete.
2019-05-18 11:04:35,150 - Movidius - INFO - Helpers class initialization complete.
2019-05-18 11:04:35,150 - Movidius - INFO - Movidius class initialization complete.
2019-05-18 11:04:36,253 - Movidius - INFO - Connected To NCS1 successfully.
2019-05-18 11:04:36,447 - Movidius - INFO - Movidius graph allocated successfully.
2019-05-18 11:04:36,451 - Movidius - INFO - Inception loaded successfully.
2019-05-18 11:04:36,456 - ClassifierServer - INFO - Classifier server class initialization complete.
 * Serving Flask app "Server" (lazy loading)
 * Environment: production
   WARNING: Do not use the development server in a production environment.
   Use a production WSGI server instead.
 * Debug mode: off
 * Running on http://###.###.#.##:8080/ (Press CTRL+C to quit)
```

With your API server now running you can now start the client with the following command, you need to make sure your testing data is in the correct location:

```
$ python3 Client.py Test
```

This will send the test data to the model API and return the predictions. You should see the following output:

```
2019-05-18 11:26:28,534 - ClassifierServerClient - INFO - Helpers class initialization complete.
2019-05-18 11:26:28,534 - ClassifierServerClient - INFO - Classifier class initialization complete.
2019-05-18 11:26:29,300 - ClassifierServerClient - INFO - Model/Test/Im047_0.jpg: ALL not detected with a confidence of 0.994 in 0.3762204647064209
2019-05-18 11:26:37,019 - ClassifierServerClient - INFO - Model/Test/Im069_0.jpg: ALL not detected with a confidence of 0.994 in 0.3306772708892822
2019-05-18 11:26:44,547 - ClassifierServerClient - INFO - Model/Test/Im024_1.jpg: ALL detected with a confidence of 0.948 in 0.32995152473449707
2019-05-18 11:26:52,220 - ClassifierServerClient - INFO - Model/Test/Im063_1.jpg: ALL detected with a confidence of 1.0 in 0.32984113693237305
2019-05-18 11:26:59,931 - ClassifierServerClient - INFO - Model/Test/Im060_1.jpg: ALL detected with a confidence of 1.0 in 0.3300290107727051
2019-05-18 11:27:07,461 - ClassifierServerClient - INFO - Model/Test/Im028_1.jpg: ALL not detected with a LOW confidence of 0.728 in 0.3310720920562744
2019-05-18 11:27:15,173 - ClassifierServerClient - INFO - Model/Test/Im041_0.jpg: ALL not detected with a confidence of 1.0 in 0.33055758476257324
2019-05-18 11:27:22,882 - ClassifierServerClient - INFO - Model/Test/Im101_0.jpg: ALL not detected with a confidence of 0.997 in 0.3307199478149414
2019-05-18 11:27:30,387 - ClassifierServerClient - INFO - Model/Test/Im006_1.jpg: ALL detected with a confidence of 1.0 in 0.331148624420166
2019-05-18 11:27:38,092 - ClassifierServerClient - INFO - Model/Test/Im106_0.jpg: ALL not detected with a confidence of 0.999 in 0.33028388023376465
2019-05-18 11:27:45,613 - ClassifierServerClient - INFO - Model/Test/Im031_1.jpg: ALL not detected with a LOW confidence of 0.6533 in 0.33055925369262695
2019-05-18 11:27:53,294 - ClassifierServerClient - INFO - Model/Test/Im095_0.jpg: ALL not detected with a confidence of 0.8965 in 0.3296163082122803
2019-05-18 11:28:01,009 - ClassifierServerClient - INFO - Model/Test/Im057_1.jpg: ALL detected with a confidence of 1.0 in 0.3306884765625
2019-05-18 11:28:08,715 - ClassifierServerClient - INFO - Model/Test/Im053_1.jpg: ALL detected with a confidence of 1.0 in 0.3295555114746094
2019-05-18 11:28:16,418 - ClassifierServerClient - INFO - Model/Test/Im088_0.jpg: ALL not detected with a confidence of 0.992 in 0.33016419410705566
2019-05-18 11:28:23,946 - ClassifierServerClient - INFO - Model/Test/Im020_1.jpg: ALL not detected with a confidence of 0.8745 in 0.33075666427612305
2019-05-18 11:28:31,453 - ClassifierServerClient - INFO - Model/Test/Im026_1.jpg: ALL detected with a confidence of 0.9624 in 0.3315463066101074
2019-05-18 11:28:39,155 - ClassifierServerClient - INFO - Model/Test/Im099_0.jpg: ALL not detected with a confidence of 0.999 in 0.331071138381958
2019-05-18 11:28:46,860 - ClassifierServerClient - INFO - Model/Test/Im074_0.jpg: ALL not detected with a confidence of 0.9707 in 0.3293898105621338
2019-05-18 11:28:54,534 - ClassifierServerClient - INFO - Model/Test/Im035_0.jpg: ALL not detected with a confidence of 0.998 in 0.3307936191558838
```

&nbsp;

# Conclusion

Based on training and validation statistics, it is clear that we can still improve our model. However on unseen data the classifier functions well with 19 correct classifications (3 with low confidence) and 1 incorrect classifications (1 with low confidence). In V2 we will enhance this model and aim to create a more reliable and accurate model. Feel free to play with different testing data and/or modify the configuration / code to see how you do.

&nbsp;

# About the author

[Adam Milton-Barker](https://www.petermossamlallresearch.com/team/adam-milton-barker/profile "Adam Milton-Barker") is a [Bigfinite](https://www.bigfinite.com "Bigfinite") IoT Network Engineer, part of the team that works on the core IoT software. In his spare time he is an [Intel Software Innovator](https://software.intel.com/en-us/intel-software-innovators/overview "Intel Software Innovator") in the fields of Internet of Things, Artificial Intelligence and Virtual Reality.

&nbsp;

# Contributing

The Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research project encourages and welcomes code contributions, bug fixes and enhancements from the Github.

Please read the [CONTRIBUTING](https://github.com/AMLResearchProject/AML-ALL-Detection-System/blob/master/CONTRIBUTING.md "CONTRIBUTING") document for a full guide to forking our repositories and submitting your pull requests. You will also find information about our code of conduct on this page.

## Acute Myeloid & Lymphoblastic Leukemia Detection System Contributors

- [Adam Milton-Barker](https://www.petermossamlallresearch.com/team/adam-milton-barker/profile "Adam Milton-Barker") - Bigfinite IoT Network Engineer & Intel Software Innovator, Barcelona, Spain
- [Dr Amita Kapoor](https://www.petermossamlallresearch.com/team/amita-kapoor/profile "Dr Amita Kapoor") - Associate Professor in the Department of Electronics, SRCASW, Delhi University, Delhi, India
- [Taru Jane](https://www.petermossamlallresearch.com/team/salvatore-raieli/profile "Taru Jane") - Pre-final year undergraduate pursuing B.Tech in IT, Project Research Intern, Delhi, India

&nbsp;

# Versioning

We use SemVer for versioning. For the versions available, see [Releases](https://github.com/AMLResearchProject/AML-ALL-Detection-System/releases "Releases").

# License

This project is licensed under the **MIT License** - see the [LICENSE](https://github.com/AMLResearchProject/AML-ALL-Detection-System/blob/master/LICENSE "LICENSE") file for details.

# Bugs/Issues

We use the [repo issues](https://github.com/AMLResearchProject/AML-ALL-Detection-System/issues "repo issues") to track bugs and general requests related to using this project.
