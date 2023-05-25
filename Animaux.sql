DROP TABLE IF EXISTS `Animaux`;
CREATE TABLE Animaux ( idP INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, `dateN` DATE, telephone VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, nom_animal VARCHAR(100) NOT NULL, type_animal VARCHAR(100) NOT NULL, race_animal VARCHAR(100) NOT NULL);

INSERT INTO `Animaux` (`idP`, `nom`, `prenom`, `dateN`, `telephone`, `adresse`, `nom_animal`, `type_animal`,`race_animal`) VALUES
(1, 'Devignes', 'Michel', '2021-03-21', '06 24 07 24 64', 'Bayeux', 'Cookie', 'Chat', 'Siamois'),
(2, 'Chambeaux', 'Jean-Marc', '2000-08-02', '06 07 08 09 02', 'Caen', 'Volt', 'Chien', 'Labrador'),
(3, 'Bernard', 'Jean-Luc', '1998-04-12', '07 22 59 09 45', 'Breteville', 'Berlioz', 'Chat', 'Chartreux'),
(4, 'Lefevre', 'François', '2004-05-09', '06 55 27 80 64', 'Falaise', 'Luna', 'Chien', 'Dalmatien');
