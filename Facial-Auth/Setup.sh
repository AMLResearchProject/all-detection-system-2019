#!/bin/sh

echo "!! This program will setup everything you need to use Facenet !!"
echo " "

echo "-- Installing requirements"
echo " "

sudo apt update
sudo apt -y install cmake

pip3 install --user opencv-python
pip3 install --user jsonpickle 
pip3 install --user dlib 
pip3 install --user imutils
pip3 install --user flask

echo "-- Installing NCSDK"
echo " "

mkdir -p ~/workspace
cd ~/workspace
git clone https://github.com/movidius/ncsdk.git
cd ~/workspace/ncsdk
make install

cd ~/

if [ ! -f "ALL-Detection-System-2019/Facial-Auth/Model/20170512-110547.zip" ]
then
    echo "-- Facenet zip does not already exists in Model folder, downloading."
    rm -f ./cookies.txt
    touch ./cookies.txt
    wget --load-cookies ./cookies.txt "https://docs.google.com/uc?export=download&confirm=$(wget --quiet --save-cookies ./cookies.txt --keep-session-cookies --no-check-certificate 'https://docs.google.com/uc?export=download&id=0B5MzpY9kBtDVZ2RpVDYwWmxoSUk' -O- | sed -rn 's/.*confirm=([0-9A-Za-z_]+).*/\1\n/p')&id=0B5MzpY9kBtDVZ2RpVDYwWmxoSUk" -O ALL-Detection-System-2019/Facial-Auth/Model/20170512-110547.zip && rm -rf ./cookies.txt
    echo "-- Facenet zip  downloaded."
else
    echo "-- Facenet zip already exists in Model folder"
fi

if [ ! -f "ALL-Detection-System-2019/Facial-Auth/Model/20170512-110547" ]
then
    echo "-- Facenet zip not unzipped, unzipping."
    cd ALL-Detection-System-2019/Facial-Auth/Model
    unzip 20170512-110547.zip
    cd ~/
else
    echo "-- Facenet zip already unzipped."
fi

if [ ! -f "ALL-Detection-System-2019/Facial-Auth/Model/inception_resnet_v1.py" ]
then
    echo "-- Inception Resnet does not already exists in Model folder, downloading."
    cd ALL-Detection-System-2019/Facial-Auth/Model
    wget -c --no-cache -P . https://raw.githubusercontent.com/davidsandberg/facenet/master/src/models/inception_resnet_v1.py -O inception_resnet_v1.py
	sed -i 's/\r//' *.py
	chmod +x *.py
    cd ~/
else
    echo "-- Inception Resnet already exists in Model folder."
fi

cd ALL-Detection-System-2019/Facial-Auth/Model/20170512-110547

if [ ! -e facenet_celeb.data-00000-of-00001 ]
then 
    mv model-20170512-110547.ckpt-250000.data-00000-of-00001 facenet_celeb.data-00000-of-00001
else 
    echo "-- data file exists"
fi

if [ ! -e facenet_celeb.index ]
then 
    mv  model-20170512-110547.ckpt-250000.index facenet_celeb.index
else 
    echo "-- index file exists"
fi

if [ ! -e facenet_celeb.meta ]
then 
    mv model-20170512-110547.meta facenet_celeb.meta
else 
    echo "-- meta file exists"
fi

if [ ! -e facenet_celeb_ncs ]
then
    echo "-- Converted directory does not exist, doing conversion"
    python3 ../convert_facenet.py model_base=facenet_celeb
    echo "-- Converted directory"
else
    echo "-- Converted directory exists, skipping conversion. "
fi

cd ~/

if [ -e tass.graph ]
then
    echo "-- Graph file exists, skipping compilation"
else
    echo "-- Compiling graph file"
    cd ALL-Detection-System-2019/Facial-Auth/Model/20170512-110547/facenet_celeb_ncs
    mvNCCompile  facenet_celeb_ncs.meta -w facenet_celeb_ncs -s 12 -in input -on output -o tass.graph
    cp tass.graph ../..
    cd ../../../
    echo "-- Graph compiled"
fi

echo "-- Downloading shape_predictor_68_face_landmarks.dat"
cd ALL-Detection-System-2019/Facial-Auth/Model/dlib
wget http://dlib.net/files/shape_predictor_68_face_landmarks.dat.bz2 -O shape_predictor_68_face_landmarks.dat.bz2
bzip2 -dk shape_predictor_68_face_landmarks.dat.bz2
echo "-- Downloaded and decompressed shape_predictor_68_face_landmarks.dat"
echo "-- Installation complete!"