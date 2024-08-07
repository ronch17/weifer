#!/usr/bin/env bash
# first upload new repo to remote server

sudo apt-get install rsync
# create Proftit user
useradd -m -s /bin/bash proftit
# default password located in LastPass by `Default ssh password`
passwd proftit
sudo visudo
proftit ALL=(ALL) NOPASSWD:ALL
su - proftit
# install and config docker
sudo apt update -y && sudo apt upgrade -y
sudo apt install -y aptitude && sudo aptitude update && sudo aptitude -y upgrade
sudo aptitude install -y apt-transport-https ca-certificates curl gnupg2 software-properties-common htop screen iftop iotop vim bash-completion net-tools telnet dnsutils git dirmngr
curl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo "$ID")/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/$(. /etc/os-release; echo "$ID") $(lsb_release -cs) stable"
sudo aptitude update
sudo aptitude install -y docker-ce
sudo usermod -G docker,adm,dip,video,plugdev ${USER}
sudo curl -L "https://github.com/docker/compose/releases/download/v2.11.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose
ssh-keygen
cat ~/.ssh/id_rsa.pub
# add to https://bitbucket.org/binaricore/weifer/admin/access-keys/ as a new key
# enable ssh login without type password & disable login with password instead private key
# on docker daemon permissions error:
sudo chmod 666 /var/run/docker.sock

vi ~/.ssh/authorized_keys
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC+v5DIoSb50N4rIcANwp2j0PNonP1WFbTsfHgJNQfWOHm3meLiAkshNCALWTrPgTz/3RYxHneutPc32AnPWIO8HbMZ1KgPc2S2bdLTUxMgpeSlpmSTqPsMFXQ2ZrPaOCRCQljeMEgOX9ta+jwzBMX4hUwxkS+knOjkynmrrIRqCjRMD55hiSaSDRVqb/uEfreueNPBTATwW0SJDKREVv+KNVyvhSL2vhjVZEEz6YgVLpX34m8qKpsdtIvY7OsGhEXPYW2Vu5l3WwOTsAT50atDjfL5HRZ1lnpALP9FaPtVOJSb6OrzR1Zr9yZ6TaGMhJGpftImtp5f1oVVvDg2eGsZ work
vi ~/.ssh/config
PasswordAuthentication no
git clone git@bitbucket.org:binaricore/weifer
cd weifer/ && git config core.filemode false && cd
mkdir ssl-for-origin/ && cd ssl-for-origin && sudo openssl req -x509 -nodes -days 3650 -newkey rsa:4096 -keyout weifer.key -out weifer.crt && cd


# In project directory (cd ~/wordpress/weifer) run deploy bash script sh ./scripts/deploy_dest.sh && sh ./scripts/restart_dest.sh
# If the project not up in local run sh  ./scripts/restart_local.sh and make sure that it loaded with correct DB and content.
# To publish DB to dest run: sh ./scripts/db_update_\!NOT_SAFE\!_dest.sh

#Deploy weifer.co.key & weifer.co.crt for root user:
scp -r /home/${LOCAL_USER}/ssl-keys/weifer/ssl-for-origin  root@{DEST_SERVER_IP}:/home/proftit/
#OR for AMZ ec2-user
scp -i .ssh/weifer -r /home/${LOCAL_USER}/ssl-keys/weifer/ssl-for-origin ec2-user@{DEST_SERVER_IP}:~/
