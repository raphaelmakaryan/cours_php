-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 27 mai 2025 à 15:30
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `iteration2`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouter_seances` (IN `idFIlm` INT, IN `idCinema` INT, IN `idSalle` INT, IN `laDate` DATE, IN `heure` INT)   BEGIN
    DECLARE trouve_seance INT;
    SELECT COUNT(*) INTO trouve_seance FROM seances WHERE idSalle = idSalle AND idFilm = idFilm;
     SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = trouve_seance;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

CREATE TABLE `acteurs` (
  `ID` int(11) NOT NULL,
  `identite` varchar(2000) NOT NULL,
  `naissance` date NOT NULL,
  `nationalite` varchar(1000) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`ID`, `identite`, `naissance`, `nationalite`, `type`) VALUES
(1, 'Chantal Lauby', '1948-03-23', 'française', 'comique'),
(2, 'Alain Chabat', '1958-11-24', 'française', 'acteur, réalisateur'),
(3, 'Dominique Farrugia', '1962-09-02', 'française', 'comique'),
(4, 'Gérard Darmon', '1948-02-29', 'française', 'acteur, chanteur'),
(5, 'Albert Hall', '1937-11-10', 'américain', 'acteur polyvalent'),
(6, 'Robert Duvall', '1931-01-05', 'américaine', 'acteur, réalisateur, producteur'),
(7, 'Frederic Forrest', '1936-12-23', 'américaine', 'acteur de film de guerre'),
(8, 'Martin Sheen', '1940-08-03', 'américaine', 'acteur'),
(9, 'Milla Jovovich', '1975-12-17', 'ukrainienne', 'actrice'),
(10, 'Ian Holm', '1931-09-12', 'anglaise', 'acteur'),
(11, 'Bruce Willis', '1955-03-19', 'américaine', 'acteur de film d\'action'),
(12, 'John Travolta', '1954-02-18', 'américaine', 'acteur, danseur'),
(13, 'Samuel L. Jackson', '1948-12-21', 'américain', 'acteur'),
(14, 'Uma Thurman', '1970-04-29', 'américaine', 'actrice'),
(15, 'Mark Hamill', '1951-09-25', 'américaine', 'maîtrise la force'),
(16, 'Harrison Ford', '1942-07-13', 'américain', 'acteur'),
(17, 'Carrie Fisher', '1956-10-27', 'américaine', 'actrice'),
(18, 'Karen Allen', '1951-10-05', 'américaine', 'actrice');

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `ID` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `idActor` int(11) NOT NULL,
  `role` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`ID`, `idFilm`, `idActor`, `role`) VALUES
(1, 1, 16, 'Indiana Jones'),
(2, 1, 18, 'Marion Ravenwood'),
(3, 2, 15, 'Luke Skywalker'),
(4, 2, 16, 'Han Solo'),
(5, 2, 17, 'La princesse Leia Organa'),
(6, 3, 12, 'Vincent Vega'),
(7, 3, 13, 'Jules Winnfield'),
(8, 3, 14, 'Mia Wallace'),
(9, 3, 11, 'Butch Coolidge'),
(10, 4, 11, 'Korben Dallas'),
(11, 4, 10, 'Father Vito Cornelius'),
(12, 4, 9, 'Leeloo'),
(13, 5, 8, 'le capitaine Willard'),
(14, 5, 7, 'Chef'),
(15, 5, 6, 'le lieutenant-colonel Kilgore'),
(16, 5, 5, 'Chef Phillips'),
(17, 6, 1, 'Odile Deray'),
(18, 6, 2, 'Serge Karamazov'),
(19, 6, 3, 'Simon Jérémi'),
(20, 6, 4, 'Commissaire Patrick Bialès');

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE `cinema` (
  `ID` int(11) NOT NULL,
  `nom` varchar(1000) NOT NULL,
  `adresse` varchar(1000) NOT NULL,
  `tel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cinema`
--

INSERT INTO `cinema` (`ID`, `nom`, `adresse`, `tel`) VALUES
(1, 'Pathée Annecy', '7 Av. de Brogny', '0 892 69 66 96'),
(2, 'Megarama Seynod', '1 Rue du Tremblay', '04 85 92 00 50'),
(3, 'Turbine Cran-Gevrier', '3 Rue des Tisserands', '09 64 40 04 71'),
(4, 'Le Grand Rex', '1 Bd Poissonnière, 75002 Paris', '00000000');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `ID` int(11) NOT NULL,
  `nom` varchar(1000) NOT NULL,
  `annee` year(4) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `budget` float NOT NULL COMMENT 'Compte en millions',
  `duree` float NOT NULL COMMENT 'Compte en heures'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`ID`, `nom`, `annee`, `type`, `budget`, `duree`) VALUES
(1, 'Indiana Jones, Les Aventuriers de l\'Arche perdue', '1981', 'aventure', 20, 1.55),
(2, 'Star wars', '1977', 'aventure', 11.5, 1.45),
(3, 'Pulp fiction', '1994', 'drame', 8, 2.34),
(4, 'Le cinquième élément', '1997', 'action', 75, 2.06),
(5, 'Apocalypse Now', '1979', 'guerre', 31, 2.33),
(6, 'La cité de la peur', '1994', 'comédie', 7.5, 1.33),
(8, 'One Piece RED', '2022', 'action', 21, 1.55);

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE `salles` (
  `ID` int(11) NOT NULL,
  `idCinema` int(11) NOT NULL,
  `nom` varchar(1000) NOT NULL,
  `places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`ID`, `idCinema`, `nom`, `places`) VALUES
(1, 1, 'Salle 1', 350),
(2, 1, 'Salle 2', 420),
(3, 1, 'Salle 3', 220),
(4, 1, 'Salle 4', 270),
(5, 1, 'Salle 5', 280),
(6, 2, 'Salle 1', 157),
(7, 2, 'Salle 2', 158),
(8, 2, 'Salle 3', 120),
(9, 2, 'Salle 4', 130),
(10, 3, 'Salle 1', 157),
(11, 4, 'Grande Salle', 2700),
(12, 4, 'Rex 7', 109);

-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

CREATE TABLE `seances` (
  `ID` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `idCinema` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  `laDate` date NOT NULL,
  `heure` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `seances`
--

INSERT INTO `seances` (`ID`, `idFilm`, `idCinema`, `idSalle`, `laDate`, `heure`) VALUES
(1, 3, 1, 5, '2023-12-09', 18),
(2, 2, 1, 4, '2023-12-27', 20),
(3, 2, 3, 10, '2023-12-02', 20),
(4, 5, 1, 1, '2023-12-02', 18),
(5, 1, 1, 2, '2023-12-19', 20),
(6, 3, 2, 7, '2023-12-20', 18),
(7, 5, 2, 7, '2023-12-15', 21),
(8, 5, 1, 5, '2023-12-22', 21),
(9, 3, 2, 6, '2023-12-23', 17),
(10, 1, 2, 9, '2023-12-07', 21),
(11, 6, 1, 2, '2023-12-16', 16.3),
(12, 4, 1, 1, '2023-12-21', 18),
(13, 1, 2, 9, '2023-12-26', 15),
(14, 5, 1, 4, '2023-12-07', 12),
(15, 2, 2, 8, '2023-12-25', 21),
(16, 1, 1, 2, '2023-12-01', 20),
(17, 5, 1, 1, '2023-12-01', 21),
(18, 4, 2, 9, '2023-12-14', 19),
(19, 3, 2, 7, '2023-12-06', 18),
(20, 4, 2, 7, '2023-12-29', 18),
(21, 4, 1, 4, '2023-12-18', 18),
(22, 3, 1, 5, '2023-12-19', 18),
(23, 2, 3, 10, '2023-12-20', 21),
(24, 1, 2, 7, '2023-12-21', 22),
(25, 1, 1, 4, '2023-12-22', 18),
(26, 6, 2, 7, '2023-12-02', 22),
(27, 8, 1, 1, '2025-06-30', 18),
(28, 8, 2, 1, '2025-06-26', 18),
(29, 8, 3, 1, '2025-06-27', 18),
(30, 2, 1, 1, '2025-05-26', 18),
(31, 2, 1, 3, '2025-05-27', 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteurs`
--
ALTER TABLE `acteurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idFIlm` (`idFilm`),
  ADD KEY `idActor` (`idActor`);

--
-- Index pour la table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `salles`
--
ALTER TABLE `salles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `indexCinema` (`idCinema`);

--
-- Index pour la table `seances`
--
ALTER TABLE `seances`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `indexFilm` (`idFilm`),
  ADD KEY `indexCinema` (`idCinema`),
  ADD KEY `indexSalle` (`idSalle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteurs`
--
ALTER TABLE `acteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `casting`
--
ALTER TABLE `casting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `salles`
--
ALTER TABLE `salles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `seances`
--
ALTER TABLE `seances`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`idActor`) REFERENCES `acteurs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`idFilm`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `salles`
--
ALTER TABLE `salles`
  ADD CONSTRAINT `salles_ibfk_1` FOREIGN KEY (`idCinema`) REFERENCES `cinema` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seances`
--
ALTER TABLE `seances`
  ADD CONSTRAINT `seances_ibfk_1` FOREIGN KEY (`idFilm`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seances_ibfk_2` FOREIGN KEY (`idCinema`) REFERENCES `cinema` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seances_ibfk_3` FOREIGN KEY (`idSalle`) REFERENCES `salles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
