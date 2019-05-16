-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 16 mai 2019 à 16:13
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sondage` varchar(10) CHARACTER SET latin1 NOT NULL,
  `pseudo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `valeur` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sondage` (`id_sondage`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `id_sondage`, `pseudo`, `valeur`) VALUES
(1, 'H4C1FiPy', 'Sevla', '[\"oui\",\"oui\",\"oui\",\"oui\"]'),
(2, 'H4C1FiPy', 'Sevla', '[\"oui\",\"oui\",\"oui\",\"oui\"]'),
(3, 'H4C1FiPy', 'Keyser', '[\"oui\",\"mais\",\"non\",\"oui\"]'),
(4, 'H4C1FiPy', 'test', '[\"non\",\"oui mais\",\"oui\",\"oui\"]'),
(5, 'ZlCyjYuN', 'Sevla', '[\"oui\",\"oui\",\"oui\",\"oui\",\"oui\",\"oui\",\"oui\",\"oui\"]'),
(6, 'ZlCyjYuN', 'Ribeiro', '[\"oui mais\",\"non\",\"oui\",\"oui\",\"non\",\"oui\",\"oui mais\",\"oui\"]');

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

DROP TABLE IF EXISTS `sondage`;
CREATE TABLE IF NOT EXISTS `sondage` (
  `id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nom_createur` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nom_sondage` varchar(255) CHARACTER SET latin1 NOT NULL,
  `commentaire` text CHARACTER SET latin1 NOT NULL,
  `valeur` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Déchargement des données de la table `sondage`
--

INSERT INTO `sondage` (`id`, `nom_createur`, `nom_sondage`, `commentaire`, `valeur`) VALUES
('1TalI78S', 'azerty', 'aqwzsx', '', '[\"n\"]'),
('H4C1FiPy', 'Alves', 'test', 'no comments', '[\"aller au parc\",\"aller \\u00e0 la piscine\",\"aller dormir\",\"rester immobile\"]'),
('ZlCyjYuN', 'azerty', 'aqwzsx', 'no comments bitch', '[\"boire\",\"manger\",\"ronfler\",\"dormir\",\"p\\u00e9ter\",\"sauter\",\"voler\",\"grandir\"]');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_sondage`) REFERENCES `sondage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
