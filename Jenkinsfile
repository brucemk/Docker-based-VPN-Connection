// Automated deployment to a VPN using Jenkins. You use the step below in your jenkinsfile to do automated deployments over VPN
node {
  try {
        stage('Connect to Remote Repo and checkout Repo') {
        // using the ubuntu 20.10 / groovy Docker image
         docker.image('ubuntu:groovy').inside('-it --net=bridge --env="DISPLAY" --privileged --user="root"') {
            withEnv(["HOME=${WORKSPACE}"]) {
            	// working in the deploy direcory inside the workspace
                dir('deploy'){
                withCredentials([string(credentialsId: 'your-vpn-username', variable: 'YOUR_VPN_USERNAME'),
                 string(credentialsId: 'your-url-encoded-vpn-pass', variable: 'YOUR_URL_ENCODED_VPN_PASSWORD')]) {

                   sh '''
                   set +x
                   apt-get -q update
                   
                   # You use this mode when you need zero interaction while installing or upgrading the system via apt.
                   export DEBIAN_FRONTEND=noninteractive
                   apt-get -q -y install openconnect ssh sshpass rsync git sudo
                   
                   # sha256:<hash> - is the oppen connect certificate validation hash
                   echo ${YOUR_VPN_PASSWORD} | openconnect VPN-IP-ADDRESS --protocol=gp --passwd-on-stdin  --servercert sha256:<hash> --user="${YOUR_VPN_USERNAME}" &
                   sleep 10

                   # perform deployment operations here like cloning a remote repo  or pushing code over a VPN. 
                   # Example command below shows cloning of a remote repo over vpn and authenticating using Jenkins Credentials

                   git clone http://${YOUR_VPN_USERNAME}:'${YOUR_URL_ENCODED_VPN_PASSWORD}'@1github.com//repo_name/project_name.git .

                   echo  'Closing VPN connection after deployment'
                   sudo ps -aef | grep openconnect
                   sudo kill -9 $(pidof openconnect)

                   '''
                }
              }
            }
           }
          }
  } catch (Exception exc) {
      echo "Caught: ${exc}"
      throw exc
  } finally {
      cleanWs()
  }
}
