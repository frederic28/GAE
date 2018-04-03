FROM php:5.5

# install google cloud sdk
# ajout de la source de paquet
RUN echo "deb http://packages.cloud.google.com/apt cloud-sdk-jessie main" | tee -a /etc/apt/sources.list.d/google-cloud-sdk.list
RUN curl https://packages.cloud.google.com/apt/doc/apt-key.gpg | apt-key add -
RUN apt update
RUN apt install -y google-cloud-sdk
# les sources exemples en node se trouve sur GitHub à l'url ci-dessous
# git clone https://github.com/GoogleCloudPlatform/nodejs-docs-samples .

RUN apt install -y openssh-server
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config
CMD ["service ssh start"]

RUN useradd -m -s /bin/bash -p $(openssl passwd -1 "upjv") upjv
RUN echo "root:upjv" | chpasswd
USER upjv
WORKDIR /home/upjv

# pour avoir la main au démarage
CMD ["/bin/bash"]