#!/bin/sh

echo "!! This program will setup everything you need to use Facenet !!"
echo " "

echo "-- Installing requirements.txt"
echo " "

pip3 install --upgrade pip
pip3 install -r requirements.txt --user

echo "-- Installing NCSDK"
echo " "

mkdir -p ~/workspace && cd ~/workspace
git clone https://github.com/movidius/ncsdk.git
cd ~/workspace/ncsdk/api/src
make
sudo make install