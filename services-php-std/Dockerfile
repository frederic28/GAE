# ------ image php 5.6 cgi pour mode std --------

FROM debian:jessie

RUN apt update
RUN apt install -y php5-cgi php5-xdebug

# ---------- La configuration suivante est a utiliser pour tous les langages (flex ou std) -----------

# dependance
RUN apt update
RUN apt install -y python curl zip

# ajout du server ssh pour se connecter en ssh sur le conteneur docker (quand il tourne !)
RUN apt install -y openssh-server
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config

# ajout de l'utilisateur qui se servira de gcloud
RUN useradd -m -s /bin/bash -p $(openssl passwd -1 "upjv") upjv
RUN echo "root:upjv" | chpasswd

# install google cloud sdk
RUN curl https://dl.google.com/dl/cloudsdk/channels/rapid/downloads/google-cloud-sdk-192.0.0-linux-x86_64.tar.gz > /tmp/sdk.tar.gz
WORKDIR /opt
RUN tar -xzf /tmp/sdk.tar.gz
RUN chown -R upjv: /opt/google-cloud-sdk
USER upjv
WORKDIR /opt/google-cloud-sdk
RUN ./install.sh --quiet --additional-components app-engine-php \
    --command-completion true \
    --bash-completion true \
    --path-update true


# pour avoir la main au démarage
WORKDIR /home/upjv/
CMD ["/bin/bash"]