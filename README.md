# Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project
## Acute Lymphoblastic Leukemia Detection System 2019

![Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research Project](Media/Images/Peter-Moss-Acute-Myeloid-Lymphoblastic-Leukemia-Research-Project.png)

[![CURRENT RELEASE](https://img.shields.io/badge/CURRENT%20RELEASE-0.1.0-blue.svg)](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/0.1.0)
[![UPCOMING RELEASE](https://img.shields.io/badge/UPCOMING%20RELEASE-0.2.0-blue.svg)](https://github.com/AMLResearchProject/AML-ALL-Detection-System/tree/0.2.0) [![Issues Welcome!](https://img.shields.io/badge/Contributions-Welcome-lightgrey.svg)](CONTRIBUTING.md) [![Issues](https://img.shields.io/badge/Issues-Welcome-lightgrey.svg)](issues) [![LICENSE](https://img.shields.io/badge/LICENSE-MIT-blue.svg)](LICENSE)

&nbsp;

# Table Of Contents

- [Introduction](#introduction)
- [Projects](#projects)
- [Contributing](#contributing)
    - [Contributors](#contributors)
- [Versioning](#versioning)
- [License](#license)
- [Bugs/Issues](#bugs-issues)

&nbsp;

# Introduction
The Peter Moss Acute Myeloid & Lymphoblastic Leukemia Detection System is an opensource classifier with a locally hosted, database driven UI for data management, training, and running inference on Convolutional Neural Networks on the edge. This project was our official demo for 2019 and leverages Intel technologies such as the UP2/UP2 AI Vision Dev Kit and Movidius NCS.

This project is made up of a number of components which work together to provide a locally hosted management system. Follow the completed tutorials below in the provided order. A full system setup requires [Server](Server "Server"), [Facial-Auth](Facial-Auth "Facial-Auth"), [Data Augmentation](Augmentation "Data Augmentation"), [NCS1 Tensorflow Classifier](NCS1/ "NCS1 Tensorflow Classifier"), and [Chatbot](Chatbot "Chatbot").

&nbsp;

# Projects

| Project                                                                                                                                                                                                                                                                                                                                                                      | Description                                                                                                                         | Status      |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------- | ----------- |
| [Server](Server "Server")                                                                                                                                                                                                                                                                   | A local PHP/MySQL server hosting a web based UI for managing and classifying data. Based on the [GeniSysAI Server](https://github.com/GeniSysAI/Server "GeniSysAI Server").                                             | Complete |
| [Facial-Auth](Facial-Auth "Facial-Auth")                                                                                                                                                                                                                                                    | Siamese Neural Networks used for facial authentication. Hosts a REST API endpoint that exposes the model for remote classification.          | Complete    |
| [Augmentation](Augmentation "Data Augmentation")                                                                                                                                                                                                                                         | Applies filters to the original dataset and increases the amount of training data used for the [NCS1 Tensorflow Classifier](NCS1 "NCS1 Tensorflow Classifier").                                           | Complete    |
| [NCS1 Tensorflow Classifier](NCS1 "NCS1 Tensorflow Classifier") | The Acute Lyphoblastic Leukemia Detection System 2019 Tensorflow NCS1 Classifier, using NCS & NCSDK. Hosts a REST API endpoint that exposes the model for remote classification. | Complete    |
| [Chatbot](Chatbot "Chatbot")                                                                                                                                                                                                                                                             | A Tensorflow Natural Language Understanding Engine trained with basic knowledge of AML. Hosts a REST API endpoint that exposes the model for remote classification                     | Complete    |

&nbsp;

# Contributing

The Peter Moss Acute Myeloid & Lymphoblastic Leukemia AI Research project encourages and welcomes code contributions, bug fixes and enhancements from the Github.

Please read the [CONTRIBUTING](CONTRIBUTING.md "CONTRIBUTING") document for a full guide to forking our repositories and submitting your pull requests. You will also find information about our code of conduct on this page.

## Contributors

- [Adam Milton-Barker](https://www.leukemiaresearchassociation.ai/team/adam-milton-barker "Adam Milton-Barker") - [Asociacion De Investigation En Inteligencia Artificial Para La Leucemia Peter Moss](https://www.leukemiaresearchassociation.ai "Asociacion De Investigation En Inteligencia Artificial Para La Leucemia Peter Moss") President & Lead Developer, Sabadell, Spain

&nbsp;

# Versioning

We use SemVer for versioning. For the versions available, see [Releases](releases "Releases").

&nbsp;

# License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE "LICENSE") file for details.

&nbsp;

# Bugs/Issues

We use the [repo issues](issues "repo issues") to track bugs and general requests related to using this project.
