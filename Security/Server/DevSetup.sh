#!/bin/sh

echo "!! This program will compile a graph using Facenet and the NCSDK !!"
echo " "

echo "-- Installing requirements.txt"
echo " "

pip3 install --upgrade pip
pip3 install -r requirements.txt --user

echo "-- Installing NCSDK"
echo " "

mkdir -p ~/workspace
cd ~/workspace
git clone https://github.com/movidius/ncsdk.git
cd ~/workspace/ncsdk
make install

if [ ! -f "Model/20170512-110547.zip" ]
then
    echo "-- Facenet zip does not already exists in Model folder, downloading."
    rm -f ./cookies.txt
    touch ./cookies.txt
    wget --load-cookies ./cookies.txt "https://docs.google.com/uc?export=download&confirm=$(wget --quiet --save-cookies ./cookies.txt --keep-session-cookies --no-check-certificate 'https://docs.google.com/uc?export=download&id=0B5MzpY9kBtDVZ2RpVDYwWmxoSUk' -O- | sed -rn 's/.*confirm=([0-9A-Za-z_]+).*/\1\n/p')&id=0B5MzpY9kBtDVZ2RpVDYwWmxoSUk" -O Model/20170512-110547.zip && rm -rf ./cookies.txt
else
    echo "-- Facenet zip already exists in Model folder"
fi

if [ ! -f "Model/20170512-110547" ]
then
    echo "-- Facenet zip not unzipped, unzipping."
    cd Model
    unzip 20170512-110547.zip
    cd ../
else
    echo "-- Facenet zip already unzipped."
fi

if [ ! -f "Model/inception_resnet_v1.py" ]
then
    echo "-- Inception Resnet does not already exists in Model folder, downloading."
    cd Model
    wget -c --no-cache -P . https://raw.githubusercontent.com/davidsandberg/facenet/361c501c8b45183b9f4ad0171a9b1b20b2690d9f/src/Models/inception_resnet_v1.py -O inception_resnet_v1.py
	sed -i 's/\r//' *.py
	chmod +x *.py
    cd ../
else
    echo "-- Inception Resnet already exists in Model folder."
fi

cd Model/20170512-110547

if [ ! -e facenet_celeb.data-00000-of-00001 ]
then 
    mv Model-20170512-110547.ckpt-250000.data-00000-of-00001 facenet_celeb.data-00000-of-00001
else 
    echo "-- data file exists"
fi

if [ ! -e facenet_celeb.index ]
then 
    mv  Model-20170512-110547.ckpt-250000.index facenet_celeb.index
else 
    echo "-- index file exists"
fi

if [ ! -e facenet_celeb.meta ]
then 
    mv Model-20170512-110547.meta facenet_celeb.meta
else 
    echo "-- meta file exists"
fi

if [ ! -e facenet_celeb_ncs ]
then
    echo "-- Converted directory does not exist, doing conversion"
    python3.5 ../convert_facenet.py Model_base=facenet_celeb
else
    echo "-- Converted directory exists, skipping conversion. "
fi

cd ../../

if [ -e tass.graph ]
then
    echo "-- Graph file exists, skipping compilation"
else
    echo "-- Compiling graph file"
    cd Model/20170512-110547/facenet_celeb_ncs
    mvNCCompile  facenet_celeb_ncs.meta -w facenet_celeb_ncs -s 12 -in input -on output -o tass.graph
    cp tass.graph ../..
    cd ../../../
fi

