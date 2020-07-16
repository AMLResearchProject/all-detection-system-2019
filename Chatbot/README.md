# Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
## Acute Lymphoblastic Leukemia Detection System 2019
### Chatbot

![Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project](../Media/Images/Peter-Moss-Acute-Myeloid-Lymphoblastic-Leukemia-Research-Project.png)

&nbsp;

# Table Of Contents

- [Introduction](#introduction)
- [Example Output](#example-output)
- [System Requirements](#system-requirements)
- [Software Requirements](#software-requirements)
- [Hardware Requirements](#hardware-requirements)
- [Installation](#server-setup)
  - [UFW Firewall](#ufw-firewall)
  - [Clone the repository](#clone-the-repository)
      - [Developer Forks](#developer-forks)
  - [Install Required Software](#install-requried-software)
- [Training Data](#training-data)
- [Extensions](#extensions)
- [Training](#training)
- [Communicate Locally](#communicate-locally)
- [HTTP Request Inference](#http-request-inference)
- [Useful Links](#useful-links)
- [Stay Tuned](#stay-tuned)
- [Contributing](#contributing)
    - [Contributors](#contributors)
- [Versioning](#versioning)
- [License](#license)
- [Bugs/Issues](#bugs-issues)

&nbsp;

# Introduction
The **Acute Lymphoblastic Detection System 2019 Chatbot** is a Tensorflow Natural Language Understanding Engine trained with basic knowledge of AML & ALL. The system hosts a REST API endpoint that exposes the model for remote classification. A small dataset is provided for you to build on and is based on knowledge about Acute Myeloid Leukemia.

In detail this guide will cover the following:

- Installing and setting up required software
- Creating your intent and entity training data
- Training your intent and entity classifiers
- Testing your classifier locally in real time
- Testing your classifier API via a client

&nbsp;

# Example Output

The following is an unedited basic conversation within the capabilities provided by the example training data:

```
2020-07-16 11:38:49|Data|INFO: Training Data Ready
2020-07-16 11:38:49|Data|INFO: Model Data Ready
>hi
2020-07-16 11:38:52|Human|Intent: hi
2020-07-16 11:38:52|GeniSys|Response: Hello

>What is Acute Myeloid Leukemia?
2020-07-16 11:39:04|Human|Intent: What is Acute Myeloid Leukemia?
2020-07-16 11:39:04|GeniSys|Response: Acute Myeloid Leukemia, or AML, is a rare form of Leukemia where mutated white blood cells attack and kill healthy red cells.

>I was wondering if AML affects people that older more than younger people, or the other way round?
2020-07-16 11:39:12|Human|Intent: I was wondering if AML affects people that older more than younger people, or the other way round?
2020-07-16 11:39:12|GeniSys|Response: According to cancer.org, AML is generally a disease of older people and is uncommon before the age of 45. The average age of people when they are first diagnosed with AML is about 68. But AML can occur in children as well.

>OK, I am interested about the Acute Lypmphoblastic Leukemia Detection System
2020-07-16 11:39:23|Human|Intent: OK, I am interested about the Acute Lypmphoblastic Leukemia Detection System
2020-07-16 11:39:23|GeniSys|Response: The Acute Lymphoblastic Leukemia (ALL) Detection System is an open source project including data management, training and running facial and image classifiers on the edge with Intel technologies. The project includes a natural language understanding engine, a convolutional neural network classifier, a siamese neural network classifier and a locally hosted web based UI. This project is part of the Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project, a Asociacion De Investigacion En Inteligencia Artificial Para La Leucemia Peter Moss research project.

>Ah, what is the AML Research Project?
2020-07-16 11:39:34|Human|Intent: Ah, what is the AML Research Project?
2020-07-16 11:39:34|GeniSys|Response: The Acute Myeloid & Lymphoblastic Leukemia AI Research Project is a research project within Peter Moss Leukemia AI Research Association (Asociacion De Investigacion En Inteligencia Artificial Para La Leucemia Peter Moss). The research project focuses on developing Artificial Intelligence for early detection of Acute Myeloid & Lymphoblastic Leukemia.

>Thanks
2020-07-16 11:39:40|Human|Intent: Thanks
2020-07-16 11:39:40|GeniSys|Response: No problem! Glad I could help!
```

&nbsp;

# System Requirements

- Tested on Ubuntu 18.04 & 16.04
- [Python 3.6](https://www.python.org/ "Python 3.6")
- Requires PIP3

&nbsp;

# Software Requirements

- [Tensorflow 1.4.0](https://www.tensorflow.org/install "Tensorflow 1.4.0")
- [TFLearn](http://tflearn.org/ "TFLearn")
- [MITIE](https://github.com/mit-nlp/MITIE "MITIE")
- [NTLK (Natural Language Toolkit)](https://www.nltk.org/ "NTLK (Natural Language Toolkit)")

&nbsp;

# Hardware Requirements

- 1 x Desktop device or laptop for development and training, preferably with an NVIDIA GPU

&nbsp;

# Installation
The following guides will give you the basics of setting up a GeniSys NLU Engine.

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

Navigate to **ALL-Detection-System-2019/Chatbot** directory, this is your project root directory for this tutorial.

### Developer Forks

Developers from the Github community that would like to contribute to the development of this project should first create a fork, and clone that repository. For detailed information please view the [CONTRIBUTING](../CONTRIBUTING.md "CONTRIBUTING") guide. You should pull the latest code from the development branch.

```
  git clone -b "0.2.0" https://github.com/AMLResearchProject/ALL-Detection-System-2019.git
```

The **-b "0.2.0"** parameter ensures you get the code from the latest master branch. Before using the below command please check our latest master branch in the button at the top of the project README.

## Install Required Software

Now you need to install the required software, I have provided a requirements file that will contain all required modules for the project. You can use it to install the modules using the following command:

```
  sed -i 's/\r//' Setup.sh
  sh Setup.sh
```

The command execute the setup shell file which will istall the required software for the project including **NTLK**, **TFLearn**, **MITIE**. If for any reason the pip3 installs fail, you will have to install them manually:

```
  pip3 install ..... --user
```

&nbsp;

# Training Data

Now it is time to think about training data. In the [Model/Data/training.json](Model/Data/training.json "Model/Data/training.json") file I have provided some starter data, it is not a lot but enough to have a good test and show the example further on in the tutorial.

&nbsp;

# Extensions

Extensions are external Python classes that you can use to extend the functionality used to generate a response. Extensions should be stored in the [extensions](Chatbot/extensions "extensions") directory.

&nbsp;

# Training

Now everything is set up, it is time to train. The main functionality for the training process can be found in [Train.py](Train.py "Train.py"), [Classes/Data.py](Classes/Data.py "Classes/Data.py"), [Classes/Model.py](Classes/Model.py "Classes/Model.py") and [Classes/Mitie.py](Classes/Mitie.py "Classes/Mitie.py"), the configuration for training can be found and modified in [Required/confs.json](Required/confs.json "Required/confs.json"). If you have modified your training data, you may need to update your configuration from time to time.

To begin training, make sure you are all set up, navigate to the root of the project and execute the following command:

```
 $ python3 Run.py TRAIN
```

&nbsp;

# Communicate Locally

Now you have trained your AI, it is time to test her out! In this tutorial I will base my explanation on the conversation block at the beginning of this tutorial. As your AI is now trained, all you need to do (assuming you are in the project root), is execute the following code:

```
 $ python3 run.py INPUT
```

If you have looked through the example dataset, you may notice that **I was wondering if AML affects people that older more than younger people, or the other way round?** is not in the training data, the actual training data provided to the AI related to this question is actually:

```
"intent": "AMLAge",
"text": [
    "Who does AML affect?",
    "Who does Acute Myeloid Leukemia affect?",
    "What age group does AML affect?",
    "What age group does Acute Myeloid Leukemia affect?",
    "How old do you have to be to get AML?",
    "How old do you have to be to get Acute Myeloid Leukemia?",
    "Does Acute Myeloid Leukemia affect older or younger people?"
]
```

You can see that although **I was wondering if AML affects people that older more than younger people, or the other way round?** is not in the training data, the AI was still able to classify and respond correctly.

&nbsp;

# HTTP Request Inference

You can run the Run program in server mode to fire up an API endpoint that allows you to do inference via HTTP calls. To start your NLU engine in server mode, you can enter the following commands into terminal:

```
 $ python3 run.py SERVER
```

You will now be able to access your NLU by posting to http://YourIP:YourPort/infer, to do this, I provided an an API client programmed in Python which takes your input from console and sends it to the server for processing: [Acute Lymphoblastic Detection System Chatbot Client](Chatbot/Client.py "Acute Lymphoblastic Detection System Chatbot Client").

Navigate to the project root and execute the following command to send a query to your NLU engine, you can use any question or statement, but bear in mind it must be within the boundaries of variations of the training date.

```
 $ python3 Client.py "Can you tell me what age groups Acute Myeloid Leukemia would mainly affect?"
```

You should see the following output: 

```
2020-07-16 11:30:45|CLIENT|INFO: Client Ready
2020-07-16 11:30:45|CLIENT|INFO: Sending string for classification...
2020-07-16 11:30:46|CLIENT|OK: Response: {
    "Response": "OK",
    "ResponseData": [
        {
            "Confidence": "0.993163",
            "Context": [
                {
                    "Current": "",
                    "In": "",
                    "Out": ""
                }
            ],
            "Entities": [],
            "Extension": null,
            "Intent": "WhatIsAMLDetectionSystem",
            "Received": "What is the Peter Moss Acute Lymphoblastic Leukemia Detection System?",
            "Response": "The Acute Lymphoblastic Leukemia (ALL) Detection System is an open source project including data management, training and running facial and image classifiers on the edge with Intel technologies. The project includes a natural language understanding engine, a convolutional neural network classifier, a siamese neural network classifier and a locally hosted web based UI. This project is part of the Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project, a Asociacion De Investigacion En Inteligencia Artificial Para La Leucemia Peter Moss research project."
        }
    ]
}
```

&nbsp;

# Useful Links

Links to related articles that helped at various stages of the project for research / code examples:

- [TFLearn Quickstart](http://tflearn.org/tutorials/quickstart.html "TFLearn Quickstart")
- [Bag of Words Algorithm in Python Introduction](http://insightsbot.com/blog/R8fu5/bag-of-words-algorithm-in-python-introduction "Bag of Words Algorithm in Python Introduction")
- [Chatbot Architecture](https://medium.com/@surmenok/chatbot-architecture-496f5bf820ed "Chatbot Architecture")
- [Contextual Chatbots with Tensorflow](https://chatbotsmagazine.com/contextual-chat-bots-with-tensorflow-4391749d0077 "Contextual Chatbots with Tensorflow")
- [RasaNLU](https://github.com/RasaHQ/rasa_nlu/ "RasaNLU")

&nbsp;

# Stay Tuned!!

The dataset will continue to grow so if you use this project, make sure you return regularly to get the latest dataset and any code updates for your project.

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