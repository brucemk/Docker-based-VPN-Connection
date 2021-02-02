# Docker-based-VPN-Connection

To be able to deploy to certain environments, the developer or release manager needs to be connected to a VPN. As some VPNs do not allow external communications once connected, it can impact productivity if you will be connected for a longer time period for example when running a deployment that takes 40 minutes or more. As a solution to this you can use a Docker to connect to a VPN and deploy. This Docker image allows you to create a 'subnet' that your VPN runs in and handles the deployment without affecting the internet connectivity of the whole computer. In other words you can continue doing other things while the deployment runs.

## Tools Used
* Docker
* Ubuntu
* open connect

## Quick Start
* For Automated deployment to a VPN using Docker & Jenkins see Jenkinsfile
* For Manual deployment to a VPN using Docker see manual-deploy.php
