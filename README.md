#Présentation du lieu du stage#
J'ai réalisé mon stage dans l'entreprise Global Knowledge à Reuil-Malmaison (92).
Global Knowledge est une entreprise spécialisé dans la distribution de formations dans le domaine de l'informatique. Elle donne principalement des cours à des professionnels venus de tous les secteurs.

##Objectif du stage##
J'ai du réalisé un projet qui consistait à faire un audit des ressources du service informatique de Global Knowledge.
Dans cet audit, j'ai réuni tout les éléments utilisés par les membres du service informatique afin de pouvoir travailler dans les meilleurs conditions possibles.
Cet audit avait pour but de faire un inventaire des ressources informatiques ainsi que de leurs dépendances, ce qui permettrait d'avoir une idée précise du ou des problèmes encourus et en cas de problèmes, de pouvoir réagir dans les plus brefs de délai possibles.

Afin de réaliser ce projet, j'ai discuté avec chacun des membres du service informatique afin de faire un inventaire de tout les ressources importantes qu'ils utilisent.

Une fois fait, j'ai rentré toute ces données dans une base de données créer avec MySQL.


![](https://www.zupimages.net/up/19/27/lxen.png)

Cette photo nous montre les tables créer pour mon stage : La table services qui va retenir toutes les ressources. La table criticité qui va indiquer des niveau de criticité (1 étant faible et 4 étant important) et dépendances va mettre en lien les services afin d'afficher leurs dépendances.

Une fois fait j'ai réalisé un code php qui permettait d'afficher le contenu de ma base de données sur un navigateur.

![](https://zupimages.net/up/19/27/968n.png)

Dans cette portion de code nous pouvons voir la manière dont j'accède à la base de données grâce à mysqli_connect. Grâce à cette fonction je vais pouvoir accéder et afficher le contenu de ma base de données.


![](https://zupimages.net/up/19/27/jghw.png)

Dans cette 3ème image, nous pouvons voir 2 fonctions javascript.
La première nommée my_function me permet de récupérer une variable php sur laquelle on a cliqué (onclick) et de la stocker dans une variable php.
La seconde la fonction redirect_post, me permet de prendre la variable récupérer avec my_function, et de la transformer en variable php $_POST[], ce qui me permet de l'utiliser sur toute les pages.

**Une fois que j'y ai accédée**, L'utilisateur n'aura plus qu'à cliquer sur un nom ou a entré l'id ou le nom d'une ressource dans un des champs prévu à cet effet afin d' afficher les dépendances de cette ressource. C'est-à-dire, les ressources dont elles dépend et les ressources qui dépendent de celle sélectionné.

Une fois fait, le nom de la ressource est stockée dans une variable appelé $_POST["nom"].


![]()

Cette variable permettra ensuite d'utiliser le nom de la ressource dans de 2 requêtes.
La première nommée $req permettant d'afficher les dépendances d'une ressource.