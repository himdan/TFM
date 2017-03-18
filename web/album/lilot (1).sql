-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 23 Juillet 2016 à 15:15
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
(51, 'SR-89101RS-white', 'SR-89101RS-white.jpg', 'SR-89101RS-white', '', 1, 0),
(52, 'GIS-MP049', 'GIS-MP049.jpg', 'GIS-MP049', '', 2, 1),
(53, 'GIS-MP051', 'GIS-MP051.jpg', 'GIS-MP051', '', 2, 1),
(54, 'GIS-MP052', 'GIS-MP052.jpg', 'GIS-MP052', '', 2, 1),
(55, 'GIS-MP053', 'GIS-MP053.jpg', 'GIS-MP053', '', 2, 1),
(56, 'GIS-MP054', 'GIS-MP054.jpg', 'GIS-MP054', '', 2, 1),
(57, 'GIS-P234', 'GIS-P234.jpg', 'GIS-P234', '', 2, 1),
(58, 'GIS-P237', 'GIS-P237.jpg', 'GIS-P237', '', 2, 1),
(59, 'GIS-P243', 'GIS-P243.jpg', 'GIS-P243', '', 2, 1),
(60, 'GIS-P244', 'GIS-P244.jpg', 'GIS-P244', '', 2, 1),
(61, 'GIS-P245', 'GIS-P245.jpg', 'GIS-P245', '', 2, 1),
(62, 'GIS-PA026', 'GIS-PA026.jpg', 'GIS-PA026', '', 2, 1),
(63, 'GIS-PA027', 'GIS-PA027.jpg', 'GIS-PA027', '', 2, 1),
(64, 'GIS-PA029', 'GIS-PA029.jpg', 'GIS-PA029', '', 2, 1),
(65, 'GIS-PA032', 'GIS-PA032.jpg', 'GIS-PA032', '', 2, 1),
(66, 'GIS-PA036', 'GIS-PA036.jpg', 'GIS-PA036', '', 2, 1),
(67, 'GIS-PA040', 'GIS-PA040.jpg', 'GIS-PA040', '', 2, 1),
(68, 'GIS-PP002', 'GIS-PP002.jpg', 'GIS-PP002', '', 2, 1),
(69, 'GIS-PP007', 'GIS-PP007.jpg', 'GIS-PP007', '', 2, 1),
(70, 'GIS-W055', 'GIS-W055.jpg', 'GIS-W055', '', 2, 1),
(71, 'GIS-W277', 'GIS-W277.jpg', 'GIS-W277', '', 2, 1),
(72, 'GIS-W284', 'GIS-W284.jpg', 'GIS-W284', '', 2, 1),
(73, 'GIS-G0701', 'GIS-G0701.jpg', 'GIS-G0701', '', 3, 5),
(74, 'GIS-G0702', 'GIS-G0702.jpg', 'GIS-G0702', '', 3, 5),
(75, 'GIS-G0711', 'GIS-G0711.jpg', 'GIS-G0711', '', 3, 5),
(76, 'GIS-G0712', 'GIS-G0712.jpg', 'GIS-G0712', '', 3, 5),
(77, 'GIS-G0725', 'GIS-G0725.jpg', 'GIS-G0725', '', 3, 5),
(78, 'GIS-G0742', 'GIS-G0742.jpg', 'GIS-G0742', '', 3, 5),
(79, 'GIS-G0746', 'GIS-G0746.jpg', 'GIS-G0746', '', 3, 5),
(80, 'GIS-G0901', 'GIS-G0901.jpg', 'GIS-G0901', '', 3, 5),
(81, 'GIS-G0902', 'GIS-G0902.jpg', 'GIS-G0902', '', 3, 5),
(82, 'GIS-G0906', 'GIS-G0906.jpg', 'GIS-G0906', '', 3, 5),
(83, 'GIS-G0907', 'GIS-G0907.jpg', 'GIS-G0907', '', 3, 5),
(84, 'GIS-G0908', 'GIS-G0908.jpg', 'GIS-G0908', '', 3, 5),
(85, 'GIS-G0910', 'GIS-G0910.jpg', 'GIS-G0910', '', 3, 5),
(86, 'GIS-G0922', 'GIS-G0922.jpg', 'GIS-G0922', '', 3, 5),
(87, 'GIS-G0928', 'GIS-G0928.jpg', 'GIS-G0928', '', 3, 5),
(88, 'GIS-G1001', 'GIS-G1001.jpg', 'GIS-G1001', '', 3, 5),
(89, 'GIS-GM0021', 'GIS-GM0021.jpg', 'GIS-GM0021', '', 3, 5),
(90, 'GIS-P105', 'GIS-P105.jpg', 'GIS-P105', '', 3, 5),
(91, 'GIS-P106-1', 'GIS-P106-1.jpg', 'GIS-P106-1', '', 3, 5),
(92, 'GIS-P108-1', 'GIS-P108-1.jpg', 'GIS-P108-1', '', 3, 5),
(93, 'GIS-P108-2', 'GIS-P108-2.jpg', 'GIS-P108-2', '', 3, 5),
(94, 'GIS-P110', 'GIS-P110.jpg', 'GIS-P110', '', 3, 5),
(95, 'GIS-P201', 'GIS-P201.jpg', 'GIS-P201', '', 3, 5),
(96, 'GIS-P203', 'GIS-P203.jpg', 'GIS-P203', '', 3, 5),
(97, 'GIS-P206', 'GIS-P206.jpg', 'GIS-P206', '', 3, 5),
(98, 'GIS-P206-1', 'GIS-P206-1.jpg', 'GIS-P206-1', '', 3, 5),
(99, 'GIS-P208', 'GIS-P208.jpg', 'GIS-P208', '', 3, 5),
(100, 'PND1011 v1', 'PND1011 v1.jpg', 'PND1011 v1', '', 3, 6),
(101, 'PND1050', 'PND1050.jpg', 'PND1050', '', 3, 6),
(102, 'PND1300', 'PND1300.jpg', 'PND1300', '', 3, 6),
(103, 'PND2100', 'PND2100.jpg', 'PND2100', '', 3, 6),
(104, 'PND 1070', 'PND 1070.jpg', 'PND 1070', '', 3, 6),
(105, 'PND 2501 v2', 'PND 2501 v2.jpg', 'PND 2501 v2', '', 3, 6),
(106, '200A', '200A.jpg', '200A', '', 4, 0),
(107, 'BD13', 'BD13.jpg', 'BD13', '', 4, 0),
(108, 'CN-M59', 'CN-M59.jpg', 'CN-M59', '', 4, 0),
(109, 'CN-PVC41', 'CN-PVC41.jpg', 'CN-PVC41', '', 4, 0),
(110, 'CN-PVC54', 'CN-PVC54.jpg', 'CN-PVC54', '', 4, 0),
(111, 'CN-PVC57', 'CN-PVC57.jpg', 'CN-PVC57', '', 4, 0),
(112, 'CN-PVC59', 'CN-PVC59.jpg', 'CN-PVC59', '', 4, 0),
(113, 'CN-PVC76', 'CN-PVC76.jpg', 'CN-PVC76', '', 4, 0),
(114, 'CN-SW70', 'CN-SW70.jpg', 'CN-SW70', '', 4, 0),
(115, 'GB30-60', 'GB30-60.jpg', 'GB30-60', '', 4, 0),
(116, 'GB30-75', 'GB30-75.jpg', 'GB30-75', '', 4, 0),
(117, 'GB30-90L', 'GB30-90L.jpg', 'GB30-90L', '', 4, 0),
(118, 'GB30-90R', 'GB30-90R.jpg', 'GB30-90R', '', 4, 0),
(119, 'GB30-120D', 'GB30-120D.jpg', 'GB30-120D', '', 4, 0),
(120, 'GB30-150', 'GB30-150.jpg', 'GB30-150', '', 4, 0),
(121, 'GB30-150D', 'GB30-150D.jpg', 'GB30-150D', '', 4, 0),
(122, 'GB50-60', 'GB50-60.jpg', 'GB50-60', '', 4, 0),
(123, 'GB50-75', 'GB50-75.jpg', 'GB50-75', '', 4, 0),
(124, 'GB50-90', 'GB50-90.jpg', 'GB50-90', '', 4, 0),
(125, 'GB60-60', 'GB60-60.jpg', 'GB60-60', '', 4, 0),
(126, 'GB60-75', 'GB60-75.jpg', 'GB60-75', '', 4, 0),
(127, 'GB60-90', 'GB60-90.jpg', 'GB60-90', '', 4, 0),
(128, 'GB280-60', 'GB280-60.jpg', 'GB280-60', '', 4, 0),
(129, 'GB280-80', 'GB280-80.jpg', 'GB280-80', '', 4, 0),
(130, 'GB280-100', 'GB280-100.jpg', 'GB280-100', '', 4, 0),
(131, 'jasmin serie', 'jasmin serie.jpg', 'jasmin serie', '', 4, 0),
(132, 'OLS-992', 'OLS-992.jpg', 'OLS-992', '', 4, 0),
(133, 'OLS-993', 'OLS-993.jpg', 'OLS-993', '', 4, 0),
(134, 'OLS-997', 'OLS-997.jpg', 'OLS-997', '', 4, 0),
(135, 'OLS-999', 'OLS-999.jpg', 'OLS-999', '', 4, 0),
(136, 'OLS-3003', 'OLS-3003.jpg', 'OLS-3003', '', 4, 0),
(137, 'OLS-3005', 'OLS-3005.jpg', 'OLS-3005', '', 4, 0),
(138, 'OLS-3006A', 'OLS-3006A.jpg', 'OLS-3006A', '', 4, 0),
(139, 'OLS-3007', 'OLS-3007.jpg', 'OLS-3007', '', 4, 0),
(140, 'OLS-3008A', 'OLS-3008A.jpg', 'OLS-3008A', '', 4, 0),
(141, 'OLS-3009', 'OLS-3009.jpg', 'OLS-3009', '', 4, 0),
(142, 'PB12', 'PB12.jpg', 'PB12', '', 4, 0),
(143, 'PB20', 'PB20.jpg', 'PB20', '', 4, 0),
(144, 'PB122', 'PB122.jpg', 'PB122', '', 4, 0),
(145, 'PB150', 'PB150.jpg', 'PB150', '', 4, 0),
(146, 'PB150S', 'PB150S.jpg', 'PB150S', '', 4, 0),
(147, 'PB168', 'PB168.jpg', 'PB168', '', 4, 0),
(148, 'TSSB12', 'TSSB12.jpg', 'TSSB12', '', 4, 0),
(149, 'TSSB14', 'TSSB14.jpg', 'TSSB14', '', 4, 0),
(150, 'TSSB227', 'TSSB227.jpg', 'TSSB227', '', 4, 0),
(151, 'TSSB245', 'TSSB245.jpg', 'TSSB245', '', 4, 0),
(152, 'TSSB248', 'TSSB248.jpg', 'TSSB248', '', 4, 0),
(153, 'TSSB264', 'TSSB264.jpg', 'TSSB264', '', 4, 0),
(154, 'UB45', 'UB45.jpg', 'UB45', '', 4, 0),
(155, 'UB46', 'UB46.jpg', 'UB46', '', 4, 0),
(156, 'UB47', 'UB47.jpg', 'UB47', '', 4, 0),
(157, 'VB11', 'VB11.jpg', 'VB11', '', 4, 0),
(158, 'WB171-50', 'WB171-50.jpg', 'WB171-50', '', 4, 0),
(159, 'WB171-58', 'WB171-58.jpg', 'WB171-58', '', 4, 0),
(160, 'WB171-60', 'WB171-60.jpg', 'WB171-60', '', 4, 0),
(161, 'WB171-80', 'WB171-80.jpg', 'WB171-80', '', 4, 0),
(162, 'WB308', 'WB308.jpg', 'WB308', '', 4, 0),
(163, 'WB310', 'WB310.jpg', 'WB310', '', 4, 0),
(164, 'WB314', 'WB314.jpg', 'WB314', '', 4, 0),
(165, 'WB340', 'WB340.jpg', 'WB340', '', 4, 0),
(166, 'WB343', 'WB343.jpg', 'WB343', '', 4, 0),
(167, 'WB346', 'WB346.jpg', 'WB346', '', 4, 0),
(168, 'WB346', 'WB360.jpg', 'WB360', '', 4, 0),
(169, 'WB411', 'WB411.jpg', 'WB411', '', 4, 0),
(170, 'WB621', 'WB621.jpg', 'WB621', '', 4, 0),
(171, 'WB625', 'WB625.jpg', 'WB625', '', 4, 0),
(172, 'WB698', 'WB698.jpg', 'WB698', '', 4, 0),
(173, 'WCSB09', 'WCSB09.jpg', 'WCSB09', '', 4, 0),
(174, 'WCSB13', 'WCSB13.jpg', 'WCSB13', '', 4, 0),
(175, '1', '1.jpg', '1', '', 4, 0),
(176, '2', '2.jpg', '2', '', 4, 0),
(177, '2-1-1', '2-1-1.jpg', '2-1-1', '', 4, 0),
(178, '2-1-2', '2-1-2.jpg', '2-1-2', '', 4, 0),
(179, '2-1-3', '2-1-3.jpg', '2-1-3', '', 4, 0),
(180, '2-2', '2-2.jpg', '2-2', '', 4, 0),
(181, '3', '3.jpg', '3', '', 4, 0),
(182, '3-1', '3-1.jpg', '3-1', '', 4, 0),
(183, '3-2', '3-2.jpg', '3-2', '', 4, 0),
(184, '3-2 1', '3-2 1.jpg', '3-2 1', '', 4, 0),
(185, '4', '4.jpg', '4', '', 4, 0),
(186, '4-1.1', '4-1.1.jpg', '4-1.1', '', 4, 0),
(187, '4-1.2', '4-1.2.jpg', '4-1.2', '', 4, 0),
(188, '4-1', '4-1.jpg', '4-1', '', 4, 0),
(189, '4-2', '4-2.jpg', '4-2', '', 4, 0),
(190, '5', '5.jpg', '5', '', 4, 0),
(191, '5-1', '5-1.jpg', '5-1', '', 4, 0),
(192, '5-1-1', '5-1-1.jpg', '5-1-1', '', 4, 0),
(193, '5-1-2', '5-1-2.jpg', '5-1-2', '', 4, 0),
(194, '5-2', '5-2.jpg', '5-2', '', 4, 0),
(195, '6', '6.jpg', '6', '', 4, 0),
(196, '7', '7.jpg', '7', '', 4, 0),
(197, '7-1', '7-1.jpg', '7-1', '', 4, 0),
(198, '7-1-1', '7-1-1.jpg', '7-1-1', '', 4, 0),
(199, '7-1-2', '7-1-2.jpg', '7-1-2', '', 4, 0),
(200, '7-2', '7-2.jpg', '7-2', '', 4, 0),
(201, '8', '8.jpg', '8', '', 4, 0),
(202, '10', '10.jpg', '10', '', 4, 0),
(203, '11', '11.jpg', '11', '', 4, 0),
(204, '12', '12.jpg', '12', '', 4, 0),
(205, '13', '13.jpg', '13', '', 4, 0),
(206, '14', '14.jpg', '14', '', 4, 0),
(207, '15', '15.jpg', '15', '', 4, 0),
(208, '16', '16.jpg', '16', '', 4, 0),
(209, '20GB30-120D', '20GB30-120D.jpg', '20GB30-120D', '', 4, 0),
(210, '36', '36.jpg', '36', '', 4, 0),
(211, '37', '37.jpg', '37', '', 4, 0),
(212, '38', '38.jpg', '38', '', 4, 0),
(213, '44', '44.jpg', '44', '', 4, 0),
(214, '100BL', '100BL.jpg', '100BL', '', 4, 0),
(215, '100DL', '100DL.jpg', '100DL', '', 4, 0),
(216, 'EB-200', 'EB-200.jpg', 'EB-200', '', 5, 0),
(217, 'EB-600', 'EB-600.jpg', 'EB-600', '', 5, 0),
(218, 'OLS-606W', 'OLS-606W.jpg', 'OLS-606W', '', 5, 0),
(219, 'OLS-0702', 'OLS-0702.jpg', 'OLS-0702', '', 5, 0),
(220, 'OLS-989', 'OLS-989.jpg', 'OLS-989', '', 5, 0),
(221, 'OLS-990', 'OLS-990.jpg', 'OLS-990', '', 5, 0),
(222, 'toilet1', 'toilet1.jpg', 'toilet1', '', 5, 0),
(223, 'toilet14', 'toilet14.jpg', 'toilet14', '', 5, 0),
(224, '2101', '2101.jpg', '2101', '', 3, 7),
(225, '2106', '2106.jpg', '2106', '', 3, 7),
(226, '2401', '2401.jpg', '2401', '', 3, 7),
(227, '2406', '2406.jpg', '2406', '', 3, 7),
(228, '3510', '3510.jpg', '3510', '', 3, 7),
(229, '3680', '3680.jpg', '3680', '', 3, 7),
(230, '3684', '3684.jpg', '3684', '', 3, 7),
(231, '3685', '3685.jpg', '3685', '', 3, 7),
(232, '3710', '3710.jpg', '3710', '', 3, 7),
(233, '3771', '3771.jpg', '3771', '', 3, 7),
(234, '3780', '3780.jpg', '3780', '', 3, 7);

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
-- Contenu de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id_sous`, `nom_sous`, `id_categorie`) VALUES
(1, 'Modeles Lilot Group', 2),
(2, 'Modeles Formet', 2),
(3, 'Portes pannels Formet', 3),
(4, 'Portes EcoPannels Formet', 3),
(5, 'steel security doors', 3),
(6, 'les portes PVC ', 3),
(7, 'les portes aluminium', 3);

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
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id_sous` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
