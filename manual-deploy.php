 ## To do deployments to a VPN manually from your local machine follow the steps below:

Install docker on your machine
docker pull ubuntu:latest
//Create a container with a Networking mode and enter its shell
docker run  --net=bridge --env="DISPLAY" --privileged --name CONTAINER_NAME -it ubuntu /bin/bash

// Install the all the tools you will need to deploy inside the Docker container
apt update
apt install openconnect screen ssh git -y

//connect to a VPN using openconnect
// Run the VPN in the background using screen and then do other things in the foreground

screen
echo 'YOUR_VPN_PASWSWORD' | openconnect VPN-IP-ADDRESS --passwd-on-stdin --user=YOUR_VPN_USERNAME --no-dtls --servercert sha256:<HASH>

//Detach from this session with Ctrl+a d command and do other things in foreground. eg Cloning a remote repo  or pushing code over a VPN.

// When you need to read openconnect messages or close VPN connection you can resume detached session with screen -r command.
 
