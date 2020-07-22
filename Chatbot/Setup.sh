#!/bin/sh
echo "!! This program will set up everything you need to use the GeniSys NLU Engine !!"
echo " "
echo "-- Installing requirements"

sudo apt-get install python3.6-dev
pip3 install --user regex
pip3 install --user nltk
pip3 install --user flask
pip3 install --user TFLearn
echo " "
echo "-- Installing MITIE"
git clone https://github.com/mit-nlp/MITIE.git
cd MITIE/mitielib
mkdir build && cd build
cmake ..
cmake --build . --config Release --target install
cd ../../
make MITIE-models