#!/bin/sh

echo "-- Installing requirements"
echo " "

pip3 install --user  opencv-python==3.4.5.20
pip3 install --user matplotlib
pip3 install --user numpy
pip3 install --user scipy
pip3 install --user Pillow
sudo apt-get install python python3-tk 

echo "-- Done"