drop database note;
create database if not exists note character set utf8;

use note;

CREATE TABLE matiere(
   id_matiere int auto_increment not nul,
   cofficient int NOT NULL,
   nom VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_matiere)
);

CREATE TABLE classe(
   id_classe int auto_increment not nul,
   nom VARCHAR(50),
   PRIMARY KEY(id_classe)
);

CREATE TABLE proffeseur(
   id_proffeseur int auto_increment not nul,
   photo VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   mat VARCHAR(50) NOT NULL,
   sexe VARCHAR(2) NOT NULL,
   age int NOT NULL,
   PRIMARY KEY(id_proffeseur),
   UNIQUE(mat)
);

CREATE TABLE eleve(
   id_etudiant INT auto_increment not nul,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   sexe VARCHAR(2) NOT NULL,
   age int NOT NULL,
   matricule VARCHAR(50) NOT NULL,
   photo VARCHAR(50),
   id_classe int NOT NULL,
   PRIMARY KEY(id_etudiant),
   UNIQUE(matricule),
   FOREIGN KEY(id_classe) REFERENCES classe(id_classe)
);

CREATE TABLE suivre(
   id_etudiant INT,
   id_matiere int,
   note DECIMAL(15,2),
   PRIMARY KEY(id_etudiant, id_matiere),
   FOREIGN KEY(id_etudiant) REFERENCES eleve(id_etudiant),
   FOREIGN KEY(id_matiere) REFERENCES matiere(id_matiere)
);

CREATE TABLE enseigner(
   id_matiere int,
   id_classe int,
   PRIMARY KEY(id_matiere, id_classe),
   FOREIGN KEY(id_matiere) REFERENCES matiere(id_matiere),
   FOREIGN KEY(id_classe) REFERENCES classe(id_classe)
);

CREATE TABLE donner(
   id_matiere int,
   id_proffeseur int,
   PRIMARY KEY(id_matiere, id_proffeseur),
   FOREIGN KEY(id_matiere) REFERENCES matiere(id_matiere),
   FOREIGN KEY(id_proffeseur) REFERENCES proffeseur(id_proffeseur)
);
