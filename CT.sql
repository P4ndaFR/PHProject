create table AUTEUR
(
	nom 		 VARCHAR(25) 		PRIMARY KEY,
	prenom 		 VARCHAR(15),
	age 		 INTEGER,
	sexe 		 VARCHAR(5),
	codepostal 	 INTEGER,
	autorisation INTEGER(1)
)engine=innodb;
create table PUBLICATION
(
	id 			VARCHAR(10)				PRIMARY KEY,
	texte 		VARCHAR(140),	
)engine=innodb;
create table CATEGORIE
(
	activite 	VARCHAR(25) 		PRIMARY KEY
)engine=innodb;

alter table COMMANDE add FOREIGN KEY(numclient) REFERENCES CLIENT(numclient);
alter table COMMANDE_PRODUIT 
	add FOREIGN KEY	(numcde) 	REFERENCES COMMANDE (numcde),
	add FOREIGN KEY	(reference) REFERENCES PRODUIT(reference);
alter table FACTURE add FOREIGN KEY (numcde)	REFERENCES COMMANDE (numcde);
alter table FACTURE_PRODUIT
	add FOREIGN KEY (numfact)			REFERENCES FACTURE (numfact),
	add FOREIGN KEY (reference) 		REFERENCES PRODUIT (reference);