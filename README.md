# Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project

## Acute Myeloid & Lymphoblastic Leukemia Detection System

[![CURRENT RELEASE](https://img.shields.io/badge/CURRENT%20RELEASE-0.0.0-blue.svg)](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/0.0.0)
[![UPCOMING RELEASE](https://img.shields.io/badge/UPCOMING%20RELEASE-0.0.1-blue.svg)](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/0.0.1)

![Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project](https://www.PeterMossAmlAllResearch.com/media/images/banner.png)

The Peter Moss Acute Myeloid & Lymphoblastic Leukemia Detection System is a range of opensource classifiers with a locally hosted, database driven UI for data management, training, and running inference on Convolutional Neural Networks on the edge. This project is our official demo and leverages Intel technologies such as the UP2/UP2 AI Vision Dev Kit and Movidius NCS.

This project is made up of a number of components which work together to provide a locally hosted management system. Follow the completed tutorials below in the provided order. A full system setup requires [Server](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Server/V1 "Server"), [Facial-Auth](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Facial-Auth/V1 "Facial-Auth"), [Data Augmentation](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1 "Data Augmentation"), [NCS1 Tensorflow Classifier](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1 "NCS1 Tensorflow Classifier") or [NCS1 Keras/TFLite Classifier](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Keras/V1 "NCS1 Keras/TFLite Classifier"), and [Chatbot](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Chatbot "Chatbot") tutorials to be completed.

&nbsp;

| Project                                                                                                                                                                                                                                                                                                                                                                      | Description                                                                                                                         | Status      |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------- | ----------- |
| [Server V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Server "Server V1")                                                                                                                                                                                                                                                                   | A local PHP/MySQL server hosting a web based UI for managing and classifying data.                                                  | Development |
| [Facial-Auth V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Facial-Auth "Facial-Auth V1")                                                                                                                                                                                                                                                    | Siamese Neural Networks classifier used for facial authentication. Hosts a REST API endpoint that provides classification.          | Complete    |
| [Augmentation V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Augmentation/V1 "Data Augmentation V1")                                                                                                                                                                                                                                         | Applies filters to the original dataset and increases the amount of training / test data.                                           | Complete    |
| [NCS1 Tensorflow Classifier V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1 "NCS1 Tensorflow Classifier V1") or [NCS1 Keras/TFlite Classifier V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS/Tensorflow/V1 "NCS1 Keras/TFlite Classifier V1") | The AML & ALL Tensorflow or Keras/TFlite NCS1 Classifier using NCS & NCSDK. Hosts a REST API endpoint that provides classification. | Complete    |
| [NCS2 Classifier V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Classifiers/Movidius/NCS2/V1 "NCS2 Classifier V1")                                                                                                                                                                                                                           | Hosts a REST API with access to the AML & ALL NCS2 Classifier using NCS2 & OpenVino.                                                | Development |
| [Chatbot V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Chatbot/V1 "Chatbot V1")                                                                                                                                                                                                                                                             | Hosts a REST API with access to the Natural Language Understanding Engine trained with basic knowledge of AML.                      | Complete    |
| [Android V1](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/master/Android/V1 "Android V1")                                                                                                                                                                                                                                                             | An Android application for speaking to the AML & ALL Natural Language Understanding Engine.                                         | Development |

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
