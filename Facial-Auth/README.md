# Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
## Acute Lymphoblastic Leukemia Detection System 2019
### Facial Authentication Server

![Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project](../Media/Images/Peter-Moss-Acute-Myeloid-Lymphoblastic-Leukemia-Research-Project.png)

&nbsp;

# Table Of Contents

- [Introduction](#introduction)
- [Projects](#projects)
- [Siamese Neural Networks](#siamese-neural-networks)
- [Triplet Loss](#triplet-loss)
- [Intel® Movidius™ Neural Compute Stick](#intel-movidius-neural-compute-stick)
- [System Requirements](#system-requirements)
- [Hardware Requirements](#hardware-requirements)
- [Server Setup](#server-setup)
  - [UFW Firewall](#ufw-firewall)
  - [Clone the repository](#clone-the-repository)
      - [Developer Forks](#developer-forks)
  - [Install Dependencies](#install-dependencies)
  - [Known & Test Datasets](#known--test-datasets)
  - [Configuration](#configuration)
- [Server Test](#server-test)
- [Conclusion](#conclusion)

- [Contributing](#contributing)
    - [Contributors](#contributors)
- [Versioning](#versioning)
- [License](#license)
- [Bugs/Issues](#bugs-issues)

&nbsp;

# Introduction
The Facial Authentication Server hosts API endpoints exposing a **Facenet** classifier. Facenet uses **Siamese Neural Networks** trained with **Triplet Loss**, Siamese Networks and Triplet Loss, and is used in this project due to it's ability to help overcome the **Open Set Recognition Issue** in **facial recogniton**.

The project runs on an **UP Squared** IoT development board and uses an **Intel® Movidius™ Neural Compute Stick** showing how computer vision can be run on gateway devices on **the edge** using smaller, lower spec IoT devices such as UP Squared or Raspberry Pi.

&nbsp;

# Siamese Neural Networks

![Siamese Neural Networks](Media/Images/siamese-neural-networks.jpg)

Siamese Neural Networks are made up of 2 **Convolutional Neural Networks** that are exactly identical, hence the name Siamese Neural Networks. Siamese Neural Networks can be used to differentiate between objects, or in this case, faces. Facenet uses Siamese Neural Networks that have been trained with Triplet Loss.

Given an unseen example and a known example / multiple known examples we can pass the unseen example through the first Siamese Neural Network, and then compare the output encodings with output encodings from the single or multiple examples by calculating the difference between them. Using this method we are able to determine if the example passed to the first network is the same as one of the known examples, verifying if the person is known or not.

&nbsp;

# Triplet Loss

Triplet Loss was used when training Facenet and reduces the difference between an anchor (an image) and a positive sample from the same class, and increases the difference between the ancher and a negative sample from an opposite class. Basically this means that 2 images with the same class (in this case, the same person) will have a smaller distance than two images from different classes (or 2 different people).

&nbsp;

# Intel® Movidius™ Neural Compute Stick

![Intel® Movidius™ Neural Compute Stick](Media/Images/Movidius-NCS1.jpg)
The Intel® Movidius™ Neural Compute Stick is a piece of hardware, specifically a USB device, used for enhancing the inference process of computer vision models on low-powered/edge devices. The Intel® Movidius™ product is a USB appliance that can be plugged into devices such as Raspberry Pi and UP Squared, and basically takes the processing power off the device and onto the Intel Movidius brand chip, making the classification process a lot faster.

&nbsp;

# System Requirements

- Tested on Ubuntu 18.04 & 16.04
- [Python 3.6](https://www.python.org/ "Python 3.6")
- Requires PIP3
- [Intel® Movidius™ NCSDK](https://github.com/movidius/ncsdk "Intel® Movidius™ NCSDK")
- [Tensorflow 1.4.0](https://www.tensorflow.org/install "Tensorflow 1.4.0")

# Hardware Requirements

- 1 x [Intel® Movidius™ Neural Compute Stick](https://www.movidius.com/ "Intel® Movidius™ Neural Compute Stick")
- 1 x UP Squared (Raspberry Pi 3 etc) for the API server and classifier

&nbsp;

# Server Setup

Now we will setup the Acute Lymphoblastic Leukemia Detection System 2019 Facial Recognition Server. The following tutorial will take you through the steps required to setup a local facial recognition server that can be used to classify images using REST requests.

## UFW Firewall

UFW firewall is used to protect the ports of your TASS device. Use the following command to check the status of your firewall:

```
  sudo ufw status
```
You should see the output:
```
  Status: inactive
```

The ports are specified in **Required/confs.json**. The default setting is set to **8080** for the streaming port. 

**FOR YOUR SECURITY YOU SHOULD CHANGE THIS!**.

```
  "Server": {
      "Logs": "Logs/",
      "IP": "",
      "Port": 8080
  }
```

To allow access to the ports use the following command for each of your ports:

```
  sudo ufw allow 22
  sudo ufw allow 8080
  audo ufw enable
  sudo ufw status
```

You should see the following output:

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

Clone the [ALL Detection System 2019](https://github.com/AMLResearchProject/ALL-Detection-System-2019 "ALL Detection System 2019") repository from the [Peter Moss Acute Myleoid & Lymphoblastic AI Research Project](https://github.com/AMLResearchProject "Peter Moss Acute Myleoid & Lymphoblastic AI Research Project") Github Organization.

To clone the repository and install the ALL Detection System 2019, make sure you have Git installed. Now navigate to the home directory on your device using terminal/commandline, and then use the following command.

```
  git clone https://github.com/AMLResearchProject/ALL-Detection-System-2019.git
```

Once you have used the command above you will see a directory called **ALL-Detection-System-2019** in your home directory.

```
ls
```

Using the ls command in your home directory should show you the following.

```
ALL-Detection-System-2019
```

Navigate to **ALL-Detection-System-2019/Facial-Auth** directory, this is your project root directory for this tutorial.

### Developer Forks

Developers from the Github community that would like to contribute to the development of this project should first create a fork, and clone that repository. For detailed information please view the [CONTRIBUTING](../CONTRIBUTING.md "CONTRIBUTING") guide. You should pull the latest code from the development branch.

```
  git clone -b "0.2.0" https://github.com/AMLResearchProject/ALL-Detection-System-2019.git
```

The **-b "0.2.0"** parameter ensures you get the code from the latest master branch. Before using the below command please check our latest master branch in the button at the top of the project README.

## Install Dependencies

Now you will install the required dependencies. [Setup.sh](Setup.sh "Setup.sh")is an executable shell script that will do the following:

- Install the required packages named in **requirements.txt**
- Install full NCSDK
- Downloads the pretrained Facenet model (**davidsandberg/facenet**)
- Downloads the pretrained **Inception V3** model
- Converts the **Facenet** model to a **Intel® Movidius/NCSDK** compatible graph

To execute the script, make enter the following commands. This will take a long time!

```
  sed -i 's/\r//' Setup.sh
  sh Setup.sh
```

## Known & Test Datasets

Before you can use your facial identification server, you need to add 1 image of all people that you want your server to classify as known to the **Data/Known** directory and as many different faces as you like to the **Data/Test** directory. The provided [client](Client.py "client") can be used to loop through this directory and send them to the inference endpoint for classification.

## Configuration

You need to updated the following settings in [Required/confs.json](Required/confs.json "Required/confs.json") to ensure that your server is accessible.

- The value **Server->IP** should be the IP of your server machine.
- The value **Server->Port** should be the port that the server is listening on.

```
  "Server": {
      "Logs": "Logs/",
      "IP": "",
      "Port": 8080
  }
```

&nbsp;

# Server Test

To make sure that your server is responding correctly, you can use [Client.py](Client.py "Client.py") in **Test** mode which will loop through all the images in your **Data/Test** and compare them with your known dataset in **Data/Known**.

Execute the following command to start your server:

```
 python3 Server.py
```

You should see the following output:

```
2020-07-16 12:59:03|Movdius|Status: Connected To NCS
2020-07-16 12:59:03|Facial Recognition Server|STATUS: Movidius configured
2020-07-16 12:59:05|Facenet|Status: Loaded TASS Graph
2020-07-16 12:59:05|Movdius|Status: Graph Allocated
2020-07-16 12:59:06|Facenet|STATUS: 1 known images found.
2020-07-16 12:59:06|Facial Recognition Server|STATUS: Facenet configured
 * Serving Flask app "Server" (lazy loading)
 * Environment: production
   WARNING: This is a development server. Do not use it in a production deployment.
   Use a production WSGI server instead.
 * Debug mode: off
 * Running on http://###.###.#.##:8080/ (Press CTRL+C to quit)
```

Next open a new terminal, navigate to the Server directory on your server machine, and execute the following command:

```
 python3 Client.py Test
```

The output from my test dataset was as follows:

```
2020-07-16 12:59:42|Facial Recognition Server|Classification: Sending Model/Data/Test/Adam-4.jpg
2020-07-16 12:59:42|Facial Recognition Server|Classification: Model/Data/Test/Adam-4.jpg | Identified Adam with confidence 0.9011024236679077 in 1594897182.2476964
2020-07-16 12:59:47|Facial Recognition Server|Classification: Sending Model/Data/Test/Adam-6.jpg
2020-07-16 12:59:48|Facial Recognition Server|Classification: Model/Data/Test/Adam-6.jpg | Identified Adam with confidence 0.8284957408905029 in 1594897187.9830785
2020-07-16 12:59:53|Facial Recognition Server|Classification: Sending Model/Data/Test/Adam-5.jpg
2020-07-16 12:59:53|Facial Recognition Server|Classification: Model/Data/Test/Adam-5.jpg | Identified Adam with confidence 1.0380238890647888 in 1594897193.2432468
2020-07-16 12:59:58|Facial Recognition Server|Classification: Sending Model/Data/Test/Test-2.jpg
2020-07-16 12:59:58|Facial Recognition Server|Classification: Model/Data/Test/Test-2.jpg | Identified INTRUDER with confidence 1.8498228788375854 in 1594897198.6103692
2020-07-16 13:00:03|Facial Recognition Server|Classification: Sending Model/Data/Test/Test-1.jpg
2020-07-16 13:00:04|Facial Recognition Server|Classification: Model/Data/Test/Test-1.jpg | Identified INTRUDER with confidence 1.7948155999183655 in 1594897203.9611313
2020-07-16 13:00:09|Facial Recognition Server|Classification: Sending Model/Data/Test/Adam-1.jpg
2020-07-16 13:00:09|Facial Recognition Server|Classification: Model/Data/Test/Adam-1.jpg | Identified Adam with confidence 0.0 in 1594897209.1807644
2020-07-16 13:00:14|Facial Recognition Server|Classification: Sending Model/Data/Test/Adam-2.jpg
2020-07-16 13:00:14|Facial Recognition Server|Classification: Model/Data/Test/Adam-2.jpg | Identified Adam with confidence 0.917761504650116 in 1594897214.6492035
2020-07-16 13:00:19|Facial Recognition Server|Classification: Sending Model/Data/Test/Adam-3.jpg
2020-07-16 13:00:20|Facial Recognition Server|Classification: Model/Data/Test/Adam-3.jpg | Identified Adam with confidence 1.1433035135269165 in 1594897220.0568533
```

&nbsp;

# Contributing

The Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research project encourages and welcomes code contributions, bug fixes and enhancements from the Github.

Please read the [CONTRIBUTING](../CONTRIBUTING.md "CONTRIBUTING") document for a full guide to forking our repositories and submitting your pull requests. You will also find information about our code of conduct on this page.

## Contributors

- [Adam Milton-Barker](https://www.leukemiaresearchassociation.ai/team/adam-milton-barker "Adam Milton-Barker") - [Asociacion De Investigation En Inteligencia Artificial Para La Leucemia Peter Moss](https://www.leukemiaresearchassociation.ai "Asociacion De Investigation En Inteligencia Artificial Para La Leucemia Peter Moss") President & Lead Developer, Sabadell, Spain

&nbsp;

# Versioning

We use SemVer for versioning. For the versions available, see [Releases](../releases "Releases").

&nbsp;

# License

This project is licensed under the **MIT License** - see the [LICENSE](../LICENSE "LICENSE") file for details.

&nbsp;

# Bugs/Issues

We use the [repo issues](../issues "repo issues") to track bugs and general requests related to using this project.