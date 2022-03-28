CREATE DATABASE AFRDVS;

USE AFRDVS;

CREATE TABLE Client (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  age INT NOT NULL,
  prefession VARCHAR(50) NOT NULL,
  ref VARCHAR(255) NOT NULL UNIQUE,
  id_admin INT REFERENCES Admin(id)
);


CREATE TABLE Admin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  ref VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE RDVs (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sujet_rdv VARCHAR(255) NOT NULL,
  date_rdv DATE NOT NULL,
  creneau_rdv INT NOT NULL CHECK(creneau_rdv > 0 && creneau_rdv <= 5),
  id_client INT REFERENCES Client(id),
  id_admin INT REFERENCES Admin(id)
);
