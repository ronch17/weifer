# first upload new repo to remote AWS server
# default docker user is: tape

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#
scp -i ~/.ssh/wisetrade -r ~/ssl-keys/weifer/ssl-for-origin/ ec2-user@${DEST_SERVER_IP}:~/ && sleep 5 &&
ssh ${DEST_SERVER} "sudo yum update -y &&
sudo yum install -y docker &&
sudo service docker start &&
sudo usermod -a -G docker ec2-user &&
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose &&
sudo chmod +x /usr/local/bin/docker-compose &&
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose &&
sudo yum install -y git &&
ssh-keygen &&
echo -e '\n\n\n' | ssh-keygen -t rsa"
#
# git clone git@bitbucket.org:binaricore/weifer.git && cd weifer/ && git config core.fileMode false
