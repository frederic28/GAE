# Organisation des sources
Le projet (au sens de l'ide) contient un repertoire avec les services sur GAE et un répertoire
pour chaque ressources d'exemple par langage de programmation. Le repertoire "services" contient
un repertoire pour chaque service (module)

## Les repertoires exemple sont installés à partir de GIT

```
cd <projet ide>
git clone https://github.com/GoogleCloudPlatform/php-docs-samples.git php-docs-samples
git clone https://github.com/GoogleCloudPlatform/nodejs-docs-samples.git nodejs-docs-samples
etc.
```

## Les repertoires "service"
Contiennent :
* un fichier pour la construction de l'image docker (en local)
* un fichier <nom du service>.yaml pour la configuration du service sur GAE
* un README.md pour la doc du service
* normalement un repertoire test :)
* les sources du service
* le fichier de dépendance en fonction de l'environnement choisi, npm, composer, pip ...

L'installation de l'image docker en local se fait à partir du langage (environement )choisi puis 
complété par le SDK de google et d'un accès ssh pour un utilisateur donné.
On part d'une distrib debian/jessie (pas tester sur les autres)

Exemple pour une image nodejs 

```
cd <service sous node>
docker build -t node/gcloud .
docker run -p 22:22 -p 80:8080  -ti --name <nom du container> --mount type=bind,src="$(pwd)",dst=/projet node/gcloud
```

pour version docker 17.04 (linux) 

```
docker run -p 22:22 -p 80:8080 -p 8000:8000 -ti --name <nom du container> -v "$(pwd)":/projet node/gcloud
```
Ensuite vous devez initialiser votre connexion à google cloud échange de clef

```
$ gcloud auth login
```

Ensuite fixer le projet cible pour le déployement

```
$ gcloud config set projet <projet ID>
```