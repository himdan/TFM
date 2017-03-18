-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 23 Juillet 2016 à 13:22
-- Version du serveur :  5.7.11-0ubuntu6
-- Version de PHP :  7.0.4-7ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lilot`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  `image_categorie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `image_categorie`) VALUES
(1, 'CABINE DE DOUCHE', '11.png'),
(2, 'MODELS INTERIEURS', 'GIS-PA032.jpg'),
(3, 'Models Exterieurs', '19.jpg'),
(4, 'Sanitaire', '3-1.png'),
(5, 'Inteligent Toilet', '4.png');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  `ref_produit` varchar(255) NOT NULL,
  `detail_produit` text NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `image_produit`, `ref_produit`, `detail_produit`, `id_categorie`, `id_sous`) VALUES
(1, '11', '11.jpg', '11', '', 1, 0),
(2, '13', '13.jpg', '13', '', 1, 0),
(3, '14-1', '14-1.jpg', '14-1', '', 1, 0),
(4, '20', '20.jpg', '20', '', 1, 0),
(5, '21', '21.jpg', '21', '', 1, 0),
(6, '22', '22.jpg', '22', '', 1, 0),
(7, '23', '23.jpg', '23', '', 1, 0),
(8, '27.1', '271.jpg', '27.1', '', 1, 0),
(9, '28', '28.jpg', '28', '', 1, 0),
(10, '118.1', '118-1.jpg', '118.1', '', 1, 0),
(11, 'BT-65103 BT-65103A', 'BT-65103 BT-65103A.jpg', 'BT-65103 BT-65103A', '', 1, 0),
(12, 'BT-67100', 'BT-67100.jpg', 'BT-67100', '', 1, 0),
(13, 'COLONE DE DOUCHE', 'COLONE DE DOUCHE.jpg', 'COLONE DE DOUCHE', '', 1, 0),
(14, 'OLS-6082C', 'OLS-6082C.jpg', 'OLS-6082C', '', 1, 0),
(15, 'OLS-6801', 'OLS-6801.jpg', 'OLS-6801', '', 1, 0),
(16, 'OLS-8058', 'OLS-8058.jpg', 'OLS-8058', '', 1, 0),
(17, 'OLS-9501R', 'OLS-9501R.jpg', 'OLS-9501R', '', 1, 0),
(18, 'OLS-9501R', 'OLS-9501R.jpg', 'OLS-9501R', '', 1, 0),
(19, 'OLS-9907 OLS-9909', 'OLS-9907 OLS-9909.jpg', 'OLS-9907 OLS-9909', '', 1, 0),
(20, 'OLS-87009', 'OLS-87009.jpg', 'OLS-87009', '', 1, 0),
(21, 'OLS-87010', 'OLS-87010.jpg', 'OLS-87010', '', 1, 0),
(22, 'OLS-A67R', 'OLS-A67R.jpg', 'OLS-A67R', '', 1, 0),
(23, 'OLS-A612R', 'OLS-A612R.jpg', 'OLS-A612R', '', 1, 0),
(24, 'OLS-C106', 'OLS-C106.jpg', 'OLS-C106', '', 1, 0),
(25, 'OLS-S704', 'OLS-S704.jpg', 'OLS-S704', '', 1, 0),
(26, 'OLS-S711', 'OLS-S711.jpg', 'OLS-S711', '', 1, 0),
(27, 'OLS-S7003A', 'OLS-S7003A.jpg', 'OLS-S7003A', '', 1, 0),
(28, 'OLS-S7012', 'OLS-S7012.jpg', 'OLS-S7012', '', 1, 0),
(29, 'SAUNA', 'SAUNA.jpg', 'SAUNA', '', 1, 0),
(30, 'SP-G101S', 'SP-G101S.jpg', 'SP-G101S', '', 1, 0),
(31, 'SR-1205', 'SR-1205.jpg', 'SR-1205', '', 1, 0),
(32, 'SR-1206', 'SR-1206.jpg', 'SR-1206', '', 1, 0),
(33, 'SR-1301', 'SR-1301.jpg', 'SR-1301', '', 1, 0),
(34, 'SR-1302', 'SR-1302.jpg', 'SR-1302', '', 1, 0),
(35, 'SR-1611', 'SR-1611.jpg', 'SR-1611', '', 1, 0),
(36, 'SR-1613', 'SR-1613.jpg', 'SR-1613', '', 1, 0),
(37, 'SR-1621', 'SR-1621.jpg', 'SR-1621', '', 1, 0),
(38, 'SR-1711', 'SR-1711.jpg', 'SR-1711', '', 1, 0),
(39, 'SR-1712', 'SR-1712.jpg', 'SR-1712', '', 1, 0),
(40, 'SR-1713', 'SR-1713.jpg', 'SR-1713', '', 1, 0),
(41, 'SR-1723', 'SR-1723.jpg', 'SR-1723', '', 1, 0),
(42, 'SR-1922', 'SR-1922.jpg', 'SR-1922', '', 1, 0),
(43, 'SR-1951', 'SR-1951.jpg', 'SR-1951', '', 1, 0),
(44, 'SR-1952', 'SR-1952.jpg', 'SR-1952', '', 1, 0),
(45, 'SR-86102S', 'SR-86102S.jpg', 'SR-86102S', '', 1, 0),
(46, 'SR-86118', 'SR-86118.jpg', 'SR-86118', '', 1, 0),
(47, 'SR-87101LS', 'SR-87101LS.jpg', 'SR-87101LS', '', 1, 0),
(48, 'SR-87101 LS', 'SR-87101 LS.jpg', 'SR-87101 LS', '', 1, 0),
(49, 'SR-87102RS', 'SR-87102RS.jpg', 'SR-87102RS', '', 1, 0),
(50, 'SR-89101RS-black', 'SR-89101RS-black.jpg', 'SR-89101RS-black', '', 1, 0),
(51, 'SR-89101RS-white', 'SR-89101RS-white.jpg', 'SR-89101RS-white', '', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE `sous_categorie` (
  `id_sous` int(11) NOT NULL,
  `nom_sous` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD PRIMARY KEY (`id_sous`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id_sous` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
