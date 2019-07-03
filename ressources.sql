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
	
INSERT INTO Criticité(nom)
	values('Basse'),
			('Moyenne'),
			('Grande'),
			('Enorme');

INSERT INTO Services
	values(1,'3CX',2),
			(2,'Adobe Connect',2),
			(3,'Adobe Creative Cloud',2),
			(4,'Apache Guacamole',3),
			(5,'Articulate 360',3),
			(6,'BAPS',4),
			(7,'Edoc',3),
			(8,'Internet',4),
			(9,'List Generator',2),
			(10,'Microsoft Office 365',2),
			(11,'Mideobox',1),
			(12,'NAS',2),
			(13,'Notepad++',1),
			(14,'OS Ticket Client',2),
			(15,'OS Ticket Employé',2),
			(16,'PABX',3),
			(17,'Requêteur universel',3),
			(18,'Serveur FTP',2),
			(19,'Serveur SMTP',3),
			(20,'Téléphone IP',2),
			(21,'VMware',2),
			(22,'LAMPP',3),
			(23,'SAN',4),
			(24,'ESXI',3),
			(25,'Outlook',3),
			(26,'Mailing Formateur',2);
			
INSERT INTO Dépendances
	values(1,NULL),
			(2,8),
			(2,6),
			(3,8),
			(4,8),
			(5,NULL),
			(6,8),
			(7,8),
			(8,NULL),
			(9,6),
			(9,10),
			(10,8),
			(11,8),
			(11,16),
			(12,NULL),
			(13,NULL),
			(14,NULL),
			(15,NULL),
			(16,NULL),
			(17,10),
			(18,NULL),
			(19,NULL),
			(20,1),
			(20,16),
			(21,23),
			(22,NULL),
			(23,NULL),
			(24,23),
			(25,8),
			(25,19),
			(26,25);