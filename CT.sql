create table AUTEUR
(
	nom 		 VARCHAR(25) 		PRIMARY KEY,
	prenom 		 VARCHAR(15),
	age 		 INTEGER,
	sexe 		 VARCHAR(5),
	codepostal 	 INTEGER,
	autorisation     INTEGER(1)
)engine=innodb;
create table PUBLICATION
(
	id 		VARCHAR(10)		PRIMARY KEY,
	texte 		VARCHAR(140),	
)engine=innodb;
create table CATEGORIE
(
	activite 	VARCHAR(25) 		PRIMARY KEY
)engine=innodb;
