CREATE DATABASE AFRDVS;

USE AFRDVS ;

CREATE TABLE Admin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  ref VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Client (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  age INT NOT NULL,
  prefession VARCHAR(50) NOT NULL,
  ref VARCHAR(255) NOT NULL UNIQUE,
  idAdmin INT,
  CONSTRAINT fk_admin FOREIGN KEY (idAdmin) REFERENCES Admin(id)
);


CREATE TABLE RDVs (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sujet_rdv VARCHAR(255) NOT NULL,
  date_rdv DATE NOT NULL,
  creneau_rdv INT NOT NULL CHECK(creneau_rdv > 0 && creneau_rdv <= 5),
  idClient INT ,
  idAdmin INT , 
  CONSTRAINT fk_rdv_client FOREIGN KEY (idClient) REFERENCES Client(id),
  CONSTRAINT fk_rdv_admin FOREIGN KEY (idAdmin) REFERENCES Admin(id)
);
INSERT INTO Client(nom, prenom, age,prefession,ref,idAdmin) Values ("Doufare","Jawad",21,"Programmer","d1rJaYo18",1);
INSERT INTO Client(nom, prenom, age,prefession,ref,idAdmin) Values ("Nemli","Youness",21,"Programmer","r1rJaYo23",1);
INSERT INTO admin(nom,prenom,ref) VALUES ("Ahmed","Flah","cheblaarbi");
INSERT INTO rdvs(sujet_rdv,creneau_rdv,idClient,idAdmin) VALUES ('Construire','something',2,2,1)
