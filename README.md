J'ai réalisé mon stage dans l'entreprise Global Knowledge à Reuil-Malmaison (92).
Global Knowledge est une entreprise spécialisé dans la distribution de formations dans le domaine de l'informatique. Elle donne principalement des cours à des professionnels venus de tous les secteurs.

Le premier jour du stage, on nous a demandés de monter et d'installer des PC, car les PC présent dans les salles étaient obsolètes pour certains des cours que l'entrerpise fournissaient. Cela a duré pendant 3 jours et après cela il m'ont donnée un projet à réaliser dans le cadre de mon stage.

J'ai du réalisé un projet qui consistait à faire un audit des ressources du service informatique de Global Knowledge.
Dans cet audit, j'ai réuni tout les éléments utilisés par les membres du service informatique afin de pouvoir travailler dans les meilleurs conditions possibles.
Cet audit avait pour but de faire un inventaire des ressources informatiques ainsi que de leurs dépendances, ce qui permettrait d'avoir une idée précise du ou des problèmes encourus et en cas de problèmes, de pouvoir réagir dans les plus brefs de délai possibles.

Afin de réaliser ce projet, j'ai discuté avec chacun des membres du service informatique afin de faire un inventaire de tout les ressources importantes qu'ils utilisent.

Une fois fait, j'ai rentré toute ces données dans une base de données créer avec MySQL.

#!sql#
  DROP database IF EXISTS Ressources;
  CREATE database Ressources;
  USE Ressources;

  CREATE TABLE Criticité(
    idCriticité INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom varchar(10));

  CREATE TABLE Services(
    idService INT PRIMARY KEY NOT NULL,
    nom varchar(20),
    criticité INT,
    FOREIGN KEY (criticité) REFERENCES Criticité(idCriticité));

  CREATE TABLE Dépendances(
    service INT NOT NULL,
    dépendance INT,
    FOREIGN KEY (service) REFERENCES Services(idService),
    FOREIGN KEY (dépendance) REFERENCES  Services(idService));
