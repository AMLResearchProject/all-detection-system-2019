# Acute Myeloid/Lymphoblastic (AML/ALL) Leukemia  Detection System
![Peter Moss AML (Acute Myeloid Leukemia) Detection System](Media/Images/banner.png)
The AML/ALL Detection System is an open source classifier including data management, training and running Convolutional Neural Networs on the edge with Intel technologies and a locally hosted PHP/MySQL webe/API server.|

This project is made up of the above components which work together to provide a locally hosted management system that lets you upload and classifiy test data and see the results visually. Follow the completed tutorials above in the same order.  A full system setup requires [Server](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Server "Server"), [Data Augmentation](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Augmentation "Data Augmentation") and [NCS1 Classifier](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Classifier/ "NCS1 Classifier") tutorials to be completed. You will be able to find each of the components used below in our other project repositories which will allow you to run them as standalone devices, in the future this repository will be checked to ensure they can be run both independently as well as running as part of the GeniSys network.

| Project  | Description | Status |
| ------------- | ------------- |  ------------- | 
| [Server](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Server "Server") | A local PHP/MySQL server hosting a web based UI for managing and classifying data. Uses facial recognition for authentication. | In Progress | 
| [Security](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Server "Security") | Hosts a REST API with access to the AML/ALL NCS1 facial recognition security classifier using NCS/NCSDK & Siamese Neural Networks. | COMPLETE |
| [*Data Augmentation](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Augmentation "Data Augmentation") | Applies filters to the original dataset and increases the amount of training / test data. | COMPLETE |
| [**NCS1 Classifier](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Classifier/ "NCS1 Classifier") | Hosts a REST API with access to the AML/ALL NCS1 Classifier using NCS & NCSDK. | COMPLETE |   
| [NCS2 Classifier](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Classifier/ "NCS2 Classifier") | Hosts a REST API with access to the AML/ALL NCS1 Classifier using NCS2 & OpenVino. | In Progress | [Chatbot](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Chatbot "Chatbot") | A REST API hosting an endpoint for Natural Language Understanding. Trained on knowledge of AML. | COMPLETE | 
| [Android](https://github.com/AMLResearchProject/AML-Detection-System/tree/master/Android "Android") | An Android application for speaking to the AML/ALL Naturall Language Understanding Engine. | In Progress |In Progress |

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

[![Adam Milton-Barker: BigFinte IoT Network Engineer & Intel® Software Innovator](Media/Images/Adam-Milton-Barker.jpg)](https://github.com/AdamMiltonBarker)