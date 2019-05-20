# Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project AML/ALL Detection System

![Peter Moss Acute Myeloid/Lymphoblastic Leukemia Detection System](Media/Images/banner.png)

The Peter Moss Acute Myeloid/Lymphoblastic Leukemia Detection System is an open source classifier including data management, training and running Convolutional Neural Networks on the edge with Intel technologies and a locally hosted PHP/MySQL webe/API server.

This project is made up of the below components which work together to provide a locally hosted management system that lets you upload and classifiy test data and see the results visually. Follow the completed tutorials above in the same order. A full system setup requires [Server](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Server/V1 "Server"), [Facial-Auth](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Facial-Auth/V1 "Facial-Auth"), [Data Augmentation](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1 "Data Augmentation"), [NCS1 Tensorflow Classifier](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1 "NCS1 Tensorflow Classifier"), [Chatbot](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Chatbot "Chatbot") and tutorials to be completed.

| Project                                                                                                                                                                            | Description                                                                                                    | Status            |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- | ----------------- |
| [Server V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Server "Server V1")                                                                         | A local PHP/MySQL server hosting a web based UI for managing and classifying data.                             | Development       |
| [Facial-Auth V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Facial-Auth "Facial-Auth V1")                                                          | Hosts a REST API with access to the Siamese Neural Networks classifier used for facial authentication.         | COMPLETE          |
| [Augmentation V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1 "Data Augmentation V1")                                               | Applies filters to the original dataset and increases the amount of training / test data.                      | COMPLETE          |
| [NCS1 Tensorflow Classifier V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1 "NCS1 Tensorflow Classifier V1") | Hosts a REST API with access to the AML/ALL NCS1 Classifier using NCS & NCSDK.                                 | Complete/Revising |
| [NCS2 Classifier V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS2/V1 "NCS2 Classifier V1")                                 | Hosts a REST API with access to the AML/ALL NCS2 Classifier using NCS2 & OpenVino.                             | Development       |
| [Chatbot V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Chatbot/V1 "Chatbot V1")                                                                   | Hosts a REST API with access to the Natural Language Understanding Engine trained with basic knowledge of AML. | COMPLETE          |
| [Android V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Android/V1 "Android V1")                                                                   | An Android application for speaking to the AML/ALL Natural Language Understanding Engine.                      | Development       |

# Contributing

The Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research project encourages and welcomes code contributions, bug fixes and enhancements from the community to the Github repositories. Please read the [CONTRIBUTING](https://github.com/AMLResearchProject/AML-ALL-Detection-System/blob/master/CONTRIBUTING.md "CONTRIBUTING") document for a full guide to forking our repositories and submitting your pull request. You will also find information about our code of conduct on this page.

## Peter Moss Acute Myeloid/Lymphoblastic Leukemia AI Research Project Team Contributors

- [Adam Milton-Barker](https://github.com/AdamMiltonBarker "Adam Milton-Barker") - Bigfinite IoT Network Engineer & Intel Software Innovator, Barcelona, Spain

&nbsp;

# Versioning

We use SemVer for versioning. For the versions available, see [Releases](https://github.com/AMLResearchProject/AML-ALL-Detection-System/releases "Releases").

# License

This project is licensed under the **MIT License** - see the [LICENSE](https://github.com/AMLResearchProject/AML-ALL-Detection-System/blob/master/LICENSE "LICENSE") file for details.

# Bugs/Issues

We use the [repo issues](https://github.com/AMLResearchProject/AML-ALL-Detection-System/issues "repo issues") to track bugs and general requests related to using this project.

&nbsp;

# Repository Manager

Adam is a [BigFinite](https://www.bigfinite.com "BigFinite") IoT Network Engineer, part of the team that works on the core IoT software. In his spare time he is an [Intel Software Innovator](https://software.intel.com/en-us/intel-software-innovators/overview "Intel Software Innovator") in the fields of Internet of Things, Artificial Intelligence and Virtual Reality.

[![Adam Milton-Barker: BigFinte IoT Network Engineer & Intel® Software Innovator](Media/Images/Adam-Milton-Barker.jpg)](https://github.com/AdamMiltonBarker)
