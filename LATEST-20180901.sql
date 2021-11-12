-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2018 at 03:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sohessi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acl`
--

CREATE TABLE `tbl_acl` (
  `id` int(255) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `feature_code` text NOT NULL,
  `fcontrol` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_acl`
--

INSERT INTO `tbl_acl` (`id`, `emp_id`, `feature_code`, `fcontrol`) VALUES
(1, 18, 'home', 1),
(2, 18, 'profile', 1),
(3, 18, 'employee', 1),
(4, 18, 'employee-create', 1),
(5, 18, 'employee-update', 1),
(6, 18, 'employee-view', 1),
(7, 18, 'employee-delete', 1),
(8, 18, 'patients', 1),
(9, 18, 'patients-create', 1),
(10, 18, 'patients-update', 1),
(11, 18, 'patients-view', 1),
(12, 18, 'patients-delete', 1),
(13, 18, 'patients-disease-create', 1),
(14, 18, 'patients-disease-delete', 1),
(15, 18, 'department', 1),
(16, 18, 'department-create', 1),
(17, 18, 'department-update', 1),
(18, 18, 'department-view', 1),
(19, 18, 'department-delete', 1),
(20, 18, 'company', 1),
(21, 18, 'company-create', 1),
(22, 18, 'company-update', 1),
(23, 18, 'company-view', 1),
(24, 18, 'company-lab', 1),
(25, 18, 'company-delete', 1),
(26, 18, 'tests', 1),
(27, 18, 'tests-create', 1),
(28, 18, 'tests-update', 1),
(29, 18, 'tests-view', 1),
(30, 18, 'tests-delete', 1),
(31, 18, 'materials', 1),
(32, 18, 'materials-create', 1),
(33, 18, 'materials-update', 1),
(34, 18, 'materials-view', 1),
(35, 18, 'materials-delete', 1),
(36, 18, 'patient', 1),
(37, 18, 'patient-create', 1),
(38, 18, 'patient-update', 1),
(39, 18, 'patient-view', 1),
(40, 18, 'patient-delete', 1),
(41, 18, 'transactions', 1),
(42, 18, 'transactions-create', 1),
(43, 18, 'transactions-update', 1),
(44, 18, 'transactions-view', 1),
(45, 18, 'transactions-delete', 1),
(46, 18, 'consultation', 1),
(47, 18, 'consult', 1),
(48, 18, 'access-controls', 1),
(49, 18, 'medicines', 1),
(50, 18, 'medicines-create', 1),
(51, 18, 'medicines-update', 1),
(52, 18, 'medicines-view', 1),
(53, 18, 'medicines-delete', 1),
(54, 18, 'diseases', 1),
(55, 18, 'diseases-create', 1),
(56, 18, 'diseases-update', 1),
(57, 18, 'diseases-view', 1),
(58, 18, 'diseases-delete', 1),
(59, 18, 'symptoms', 1),
(60, 18, 'symptoms-create', 1),
(61, 18, 'symptoms-update', 1),
(62, 18, 'symptoms-view', 1),
(63, 18, 'symptoms-delete', 1),
(64, 18, 'operations', 1),
(65, 18, 'operations-create', 1),
(66, 18, 'operations-update', 1),
(67, 18, 'operations-view', 1),
(68, 18, 'operations-delete', 1),
(69, 18, 'prescription', 1),
(70, 18, 'prescription-create', 1),
(71, 18, 'prescription-update', 1),
(72, 18, 'prescription-view', 1),
(73, 18, 'prescription-delete', 1),
(74, 18, 'brands', 1),
(75, 18, 'brands-create', 1),
(76, 18, 'brands-update', 1),
(77, 18, 'brands-view', 1),
(78, 18, 'brands-delete', 1),
(79, 18, 'vital', 1),
(80, 18, 'vital-create', 1),
(81, 18, 'vital-update', 1),
(82, 18, 'vital-view', 1),
(83, 18, 'vital-delete', 1),
(84, 18, 'transaction', 1),
(85, 18, 'transaction-create', 1),
(86, 18, 'transaction-update', 1),
(87, 18, 'transaction-view', 1),
(88, 18, 'settings', 1),
(89, 18, 'reports', 1),
(90, 18, 'access-log', 1),
(91, 18, 'acl', 1),
(92, 19, 'home', 1),
(93, 19, 'profile', 1),
(94, 19, 'employee', 1),
(95, 19, 'employee-create', 1),
(96, 19, 'employee-update', 1),
(97, 19, 'employee-view', 1),
(98, 19, 'employee-delete', 1),
(99, 19, 'patients', 1),
(100, 19, 'patients-create', 1),
(101, 19, 'patients-update', 1),
(102, 19, 'patients-view', 1),
(103, 19, 'patients-delete', 1),
(104, 19, 'patients-disease-create', 1),
(105, 19, 'patients-disease-delete', 1),
(106, 19, 'department', 1),
(107, 19, 'department-create', 1),
(108, 19, 'department-update', 1),
(109, 19, 'department-view', 1),
(110, 19, 'department-delete', 1),
(111, 19, 'company', 1),
(112, 19, 'company-create', 1),
(113, 19, 'company-update', 1),
(114, 19, 'company-view', 1),
(115, 19, 'company-lab', 1),
(116, 19, 'company-delete', 1),
(117, 19, 'tests', 1),
(118, 19, 'tests-create', 1),
(119, 19, 'tests-update', 1),
(120, 19, 'tests-view', 1),
(121, 19, 'tests-delete', 1),
(122, 19, 'materials', 1),
(123, 19, 'materials-create', 1),
(124, 19, 'materials-update', 1),
(125, 19, 'materials-view', 1),
(126, 19, 'materials-delete', 1),
(127, 19, 'patient', 1),
(128, 19, 'patient-create', 1),
(129, 19, 'patient-update', 1),
(130, 19, 'patient-view', 1),
(131, 19, 'patient-delete', 1),
(132, 19, 'transactions', 1),
(133, 19, 'transactions-create', 1),
(134, 19, 'transactions-update', 1),
(135, 19, 'transactions-view', 1),
(136, 19, 'transactions-delete', 1),
(137, 19, 'consultation', 1),
(138, 19, 'consult', 1),
(139, 19, 'access-controls', 1),
(140, 19, 'medicines', 1),
(141, 19, 'medicines-create', 1),
(142, 19, 'medicines-update', 1),
(143, 19, 'medicines-view', 1),
(144, 19, 'medicines-delete', 1),
(145, 19, 'diseases', 1),
(146, 19, 'diseases-create', 1),
(147, 19, 'diseases-update', 1),
(148, 19, 'diseases-view', 1),
(149, 19, 'diseases-delete', 1),
(150, 19, 'symptoms', 1),
(151, 19, 'symptoms-create', 1),
(152, 19, 'symptoms-update', 1),
(153, 19, 'symptoms-view', 1),
(154, 19, 'symptoms-delete', 1),
(155, 19, 'operations', 1),
(156, 19, 'operations-create', 1),
(157, 19, 'operations-update', 1),
(158, 19, 'operations-view', 1),
(159, 19, 'operations-delete', 1),
(160, 19, 'prescription', 1),
(161, 19, 'prescription-create', 1),
(162, 19, 'prescription-update', 1),
(163, 19, 'prescription-view', 1),
(164, 19, 'prescription-delete', 1),
(165, 19, 'brands', 1),
(166, 19, 'brands-create', 1),
(167, 19, 'brands-update', 1),
(168, 19, 'brands-view', 1),
(169, 19, 'brands-delete', 1),
(170, 19, 'vital', 1),
(171, 19, 'vital-create', 1),
(172, 19, 'vital-update', 1),
(173, 19, 'vital-view', 1),
(174, 19, 'vital-delete', 1),
(175, 19, 'transaction', 1),
(176, 19, 'transaction-create', 1),
(177, 19, 'transaction-update', 1),
(178, 19, 'transaction-view', 1),
(179, 19, 'settings', 1),
(180, 19, 'reports', 1),
(181, 19, 'access-log', 1),
(182, 19, 'acl', 1),
(183, 18, 'testcategory', 1),
(184, 18, 'testcategory-create', 1),
(185, 18, 'testcategory-update', 1),
(186, 18, 'testcategory-view', 1),
(187, 18, 'testcategory-delete', 1),
(188, 20, 'home', 1),
(189, 20, 'profile', 1),
(190, 20, 'employee', 0),
(191, 20, 'employee-create', 0),
(192, 20, 'employee-update', 0),
(193, 20, 'employee-view', 0),
(194, 20, 'employee-delete', 0),
(195, 20, 'patients', 0),
(196, 20, 'patients-create', 0),
(197, 20, 'patients-update', 0),
(198, 20, 'patients-view', 0),
(199, 20, 'patients-delete', 0),
(200, 20, 'patients-disease-create', 0),
(201, 20, 'patients-disease-delete', 0),
(202, 20, 'department', 0),
(203, 20, 'department-create', 0),
(204, 20, 'department-update', 0),
(205, 20, 'department-view', 0),
(206, 20, 'department-delete', 0),
(207, 20, 'company', 0),
(208, 20, 'company-create', 0),
(209, 20, 'company-update', 0),
(210, 20, 'company-view', 0),
(211, 20, 'company-lab', 0),
(212, 20, 'company-delete', 0),
(213, 20, 'tests', 0),
(214, 20, 'tests-create', 0),
(215, 20, 'tests-update', 0),
(216, 20, 'tests-view', 0),
(217, 20, 'tests-delete', 0),
(218, 20, 'testcategory', 0),
(219, 20, 'testcategory-create', 0),
(220, 20, 'testcategory-update', 0),
(221, 20, 'testcategory-view', 0),
(222, 20, 'testcategory-delete', 0),
(223, 20, 'materials', 0),
(224, 20, 'materials-create', 0),
(225, 20, 'materials-update', 0),
(226, 20, 'materials-view', 0),
(227, 20, 'materials-delete', 0),
(228, 20, 'patient', 0),
(229, 20, 'patient-create', 0),
(230, 20, 'patient-update', 0),
(231, 20, 'patient-view', 0),
(232, 20, 'patient-delete', 0),
(233, 20, 'transactions', 0),
(234, 20, 'transactions-create', 0),
(235, 20, 'transactions-update', 0),
(236, 20, 'transactions-view', 0),
(237, 20, 'transactions-delete', 0),
(238, 20, 'consultation', 0),
(239, 20, 'consult', 0),
(240, 20, 'access-controls', 0),
(241, 20, 'medicines', 0),
(242, 20, 'medicines-create', 0),
(243, 20, 'medicines-update', 0),
(244, 20, 'medicines-view', 0),
(245, 20, 'medicines-delete', 0),
(246, 20, 'diseases', 0),
(247, 20, 'diseases-create', 0),
(248, 20, 'diseases-update', 0),
(249, 20, 'diseases-view', 0),
(250, 20, 'diseases-delete', 0),
(251, 20, 'symptoms', 0),
(252, 20, 'symptoms-create', 0),
(253, 20, 'symptoms-update', 0),
(254, 20, 'symptoms-view', 0),
(255, 20, 'symptoms-delete', 0),
(256, 20, 'operations', 0),
(257, 20, 'operations-create', 0),
(258, 20, 'operations-update', 0),
(259, 20, 'operations-view', 0),
(260, 20, 'operations-delete', 0),
(261, 20, 'prescription', 0),
(262, 20, 'prescription-create', 1),
(263, 20, 'prescription-update', 1),
(264, 20, 'prescription-view', 1),
(265, 20, 'prescription-delete', 1),
(266, 20, 'brands', 0),
(267, 20, 'brands-create', 0),
(268, 20, 'brands-update', 0),
(269, 20, 'brands-view', 0),
(270, 20, 'brands-delete', 0),
(271, 20, 'vital', 0),
(272, 20, 'vital-create', 0),
(273, 20, 'vital-update', 0),
(274, 20, 'vital-view', 0),
(275, 20, 'vital-delete', 0),
(276, 20, 'transaction', 0),
(277, 20, 'transaction-create', 0),
(278, 20, 'transaction-update', 0),
(279, 20, 'transaction-view', 0),
(280, 20, 'settings', 0),
(281, 20, 'reports', 1),
(282, 20, 'access-log', 0),
(283, 20, 'acl', 0),
(284, 18, 'crete-lab-result', 1),
(285, 18, 'patient-test', 1),
(286, 18, 'process-test', 1),
(287, 18, 'result-create', 1),
(288, 18, 'patient-result', 1),
(289, 18, 'result-update', 1),
(290, 20, 'patient-test', 1),
(291, 20, 'process-test', 1),
(292, 20, 'result-create', 1),
(293, 20, 'patient-result', 0),
(294, 20, 'result-update', 0),
(295, 20, 'crete-lab-result', 0),
(296, 21, 'home', 1),
(297, 21, 'profile', 1),
(298, 21, 'employee', 0),
(299, 21, 'employee-create', 0),
(300, 21, 'employee-update', 0),
(301, 21, 'employee-view', 0),
(302, 21, 'employee-delete', 0),
(303, 21, 'patients', 0),
(304, 21, 'patients-create', 0),
(305, 21, 'patients-update', 0),
(306, 21, 'patients-view', 0),
(307, 21, 'patients-delete', 0),
(308, 21, 'patients-disease-create', 0),
(309, 21, 'patients-disease-delete', 0),
(310, 21, 'department', 0),
(311, 21, 'department-create', 0),
(312, 21, 'department-update', 0),
(313, 21, 'department-view', 0),
(314, 21, 'department-delete', 0),
(315, 21, 'company', 0),
(316, 21, 'company-create', 0),
(317, 21, 'company-update', 0),
(318, 21, 'company-view', 0),
(319, 21, 'company-lab', 0),
(320, 21, 'company-delete', 0),
(321, 21, 'tests', 0),
(322, 21, 'tests-create', 0),
(323, 21, 'tests-update', 0),
(324, 21, 'tests-view', 0),
(325, 21, 'tests-delete', 0),
(326, 21, 'testcategory', 0),
(327, 21, 'testcategory-create', 0),
(328, 21, 'testcategory-update', 0),
(329, 21, 'testcategory-view', 0),
(330, 21, 'testcategory-delete', 0),
(331, 21, 'materials', 0),
(332, 21, 'materials-create', 0),
(333, 21, 'materials-update', 0),
(334, 21, 'materials-view', 0),
(335, 21, 'materials-delete', 0),
(336, 21, 'patient', 0),
(337, 21, 'patient-create', 0),
(338, 21, 'patient-update', 0),
(339, 21, 'patient-view', 0),
(340, 21, 'patient-delete', 0),
(341, 21, 'transactions', 0),
(342, 21, 'transactions-create', 0),
(343, 21, 'transactions-update', 0),
(344, 21, 'transactions-view', 0),
(345, 21, 'transactions-delete', 0),
(346, 21, 'consultation', 0),
(347, 21, 'consult', 0),
(348, 21, 'patient-test', 1),
(349, 21, 'process-test', 1),
(350, 21, 'result-create', 1),
(351, 21, 'patient-result', 0),
(352, 21, 'result-update', 1),
(353, 21, 'access-controls', 0),
(354, 21, 'medicines', 0),
(355, 21, 'medicines-create', 0),
(356, 21, 'medicines-update', 0),
(357, 21, 'medicines-view', 0),
(358, 21, 'medicines-delete', 0),
(359, 21, 'diseases', 0),
(360, 21, 'diseases-create', 0),
(361, 21, 'diseases-update', 0),
(362, 21, 'diseases-view', 0),
(363, 21, 'diseases-delete', 0),
(364, 21, 'symptoms', 0),
(365, 21, 'symptoms-create', 0),
(366, 21, 'symptoms-update', 0),
(367, 21, 'symptoms-view', 0),
(368, 21, 'symptoms-delete', 0),
(369, 21, 'operations', 0),
(370, 21, 'operations-create', 0),
(371, 21, 'operations-update', 0),
(372, 21, 'operations-view', 0),
(373, 21, 'operations-delete', 0),
(374, 21, 'prescription', 0),
(375, 21, 'prescription-create', 0),
(376, 21, 'prescription-update', 0),
(377, 21, 'prescription-view', 0),
(378, 21, 'prescription-delete', 0),
(379, 21, 'brands', 0),
(380, 21, 'brands-create', 0),
(381, 21, 'brands-update', 0),
(382, 21, 'brands-view', 0),
(383, 21, 'brands-delete', 0),
(384, 21, 'vital', 0),
(385, 21, 'vital-create', 0),
(386, 21, 'vital-update', 0),
(387, 21, 'vital-view', 0),
(388, 21, 'vital-delete', 0),
(389, 21, 'transaction', 0),
(390, 21, 'transaction-create', 0),
(391, 21, 'transaction-update', 0),
(392, 21, 'transaction-view', 0),
(393, 21, 'settings', 0),
(394, 21, 'reports', 0),
(395, 21, 'access-log', 0),
(396, 21, 'acl', 0),
(397, 21, 'crete-lab-result', 0),
(398, 18, 'purchaserequest-delete', 1),
(399, 18, 'purchaserequest-create', 1),
(400, 18, 'purchase', 1),
(401, 18, 'purchase-create', 1),
(402, 18, 'purchase-update', 1),
(403, 18, 'purchase-delete', 1),
(404, 18, 'purchase-view', 1),
(405, 18, 'payments', 1),
(406, 18, 'payments-create', 1),
(407, 18, 'payments-update', 1),
(408, 18, 'payments-delete', 1),
(409, 18, 'payments-view', 1),
(410, 18, 'materials-stock', 1),
(411, 18, 'purchasing', 1),
(412, 18, 'orders', 1),
(413, 18, 'orders-create', 1),
(414, 18, 'orders-update', 1),
(415, 18, 'orders-view', 1),
(416, 18, 'orders-delete', 1),
(417, 20, 'materials-stock', 0),
(418, 20, 'purchaserequest-delete', 0),
(419, 20, 'purchaserequest-create', 0),
(420, 20, 'purchasing', 0),
(421, 20, 'purchase', 0),
(422, 20, 'purchase-create', 0),
(423, 20, 'purchase-update', 0),
(424, 20, 'purchase-delete', 0),
(425, 20, 'purchase-view', 0),
(426, 20, 'orders', 0),
(427, 20, 'orders-create', 0),
(428, 20, 'orders-update', 0),
(429, 20, 'orders-view', 0),
(430, 20, 'orders-delete', 0),
(431, 20, 'payments', 0),
(432, 20, 'payments-create', 0),
(433, 20, 'payments-update', 0),
(434, 20, 'payments-delete', 0),
(435, 20, 'payments-view', 0),
(436, 19, 'testcategory', 0),
(437, 19, 'testcategory-create', 0),
(438, 19, 'testcategory-update', 0),
(439, 19, 'testcategory-view', 0),
(440, 19, 'testcategory-delete', 0),
(441, 19, 'materials-stock', 0),
(442, 19, 'patient-test', 0),
(443, 19, 'process-test', 0),
(444, 19, 'result-create', 0),
(445, 19, 'patient-result', 0),
(446, 19, 'result-update', 0),
(447, 19, 'purchaserequest-delete', 0),
(448, 19, 'purchaserequest-create', 0),
(449, 19, 'purchasing', 0),
(450, 19, 'purchase', 0),
(451, 19, 'purchase-create', 0),
(452, 19, 'purchase-update', 0),
(453, 19, 'purchase-delete', 0),
(454, 19, 'purchase-view', 0),
(455, 19, 'orders', 0),
(456, 19, 'orders-create', 0),
(457, 19, 'orders-update', 0),
(458, 19, 'orders-view', 0),
(459, 19, 'orders-delete', 0),
(460, 19, 'payments', 0),
(461, 19, 'payments-create', 0),
(462, 19, 'payments-update', 0),
(463, 19, 'payments-delete', 0),
(464, 19, 'payments-view', 0),
(465, 19, 'crete-lab-result', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_availedlab`
--

CREATE TABLE `tbl_availedlab` (
  `id` int(255) NOT NULL,
  `lab_id` int(255) NOT NULL,
  `trans_id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `amount` double NOT NULL,
  `lab_date` datetime NOT NULL,
  `status` text NOT NULL,
  `queuing_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`id`, `name`, `description`) VALUES
(1, 'sample Brand 1', 'Test Only 1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `id` int(11) NOT NULL,
  `company` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `company_number` text NOT NULL,
  `branch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `company`, `address`, `phone`, `email`, `company_number`, `branch`) VALUES
(6, 'Jolibee', 'Daraga Albay, 4501', '23453534', 'jolibee-daraga@gmail.com`', 'COM-20180813-B663', 'Daraga Branch');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `name`, `description`) VALUES
(1, 'Maintenance', 'Maintains facilities and equipment'),
(2, 'Accounting', 'Department of Accounting'),
(3, 'Production', 'sample here'),
(4, 'Information Technology', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diseases`
--

CREATE TABLE `tbl_diseases` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `symptoms` longtext NOT NULL,
  `medicines` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_diseases`
--

INSERT INTO `tbl_diseases` (`id`, `name`, `description`, `symptoms`, `medicines`) VALUES
(2, 'asd', 'asdasd', '["2"]', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(255) NOT NULL,
  `fname` text NOT NULL,
  `prename` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `department_id` int(255) NOT NULL,
  `position` text NOT NULL,
  `un` text NOT NULL,
  `up` text NOT NULL,
  `email` text NOT NULL,
  `image` text NOT NULL,
  `date_hired` date NOT NULL,
  `date_regularized` date NOT NULL,
  `last_session` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `address` text NOT NULL,
  `usertype` int(1) NOT NULL DEFAULT '7',
  `birthdate` date NOT NULL,
  `mobilenumber` text NOT NULL,
  `date_exit` date NOT NULL,
  `employee_number` text NOT NULL,
  `labcategory` longtext NOT NULL,
  `pf` double NOT NULL,
  `sp` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `fname`, `prename`, `mname`, `lname`, `department_id`, `position`, `un`, `up`, `email`, `image`, `date_hired`, `date_regularized`, `last_session`, `status`, `address`, `usertype`, `birthdate`, `mobilenumber`, `date_exit`, `employee_number`, `labcategory`, `pf`, `sp`) VALUES
(18, 'Mave Rick', 'Mr.', 'E.', 'Villar', 1, 'Software Developer', 'admin', '5c995bbb81b028b869ee4ea7c44bb1a9ea6152bc', 'maverickvillar@gmail.com', 'uploads/user.png', '2018-01-01', '2018-01-01', '2018-09-01 06:17:19', 1, 'Ilawod Daraga Albay', 0, '1987-10-30', '09171372982', '0000-00-00', 'HN-0000001', '', 0, ''),
(19, 'Liza', 'Dra.', 'So', 'Berano', 3, 'Dr of ....', 'dra', 'cc3518eef5ba00af0a72abc02546b3ce0afc806d', 'dra@yopmail.com', 'uploads/user.png', '2016-01-04', '2016-01-04', '2018-08-31 09:31:04', 1, 'Legazpi City', 2, '1989-01-04', '097777777', '0000-00-00', 'SEN-20180822-XH6G', '', 500, 'Sample'),
(20, 'Rio', 'Mr.', 'R.', 'Ria', 3, 'Lab Technician', 'rio', '4c32e786e200376f562647ecaff24378b1faccf0', 'rio@yopmail.com', 'uploads/user.png', '2017-02-14', '2017-08-14', '2018-08-31 07:39:55', 1, 'Daraga Albay', 3, '1985-01-01', '092777777777', '0000-00-00', 'SEN-20180824-6UI9', '1', 0, ''),
(21, 'lab', 'Mr.', 'lab', 'lab', 3, 'Lab Tech', 'lab', '3953f9ddf975ab5097ee468d99555c5b441169bf', 'lab@yopmail.com', 'uploads/user.png', '2015-01-01', '2015-06-01', '2018-08-30 06:41:28', 1, 'legazspi ciy', 3, '1979-01-01', '091723123', '0000-00-00', 'SEN-20180830-N68S', '1', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labcategory`
--

CREATE TABLE `tbl_labcategory` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_labcategory`
--

INSERT INTO `tbl_labcategory` (`id`, `name`, `description`) VALUES
(1, 'Serology', 'sample here a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labmaterials`
--

CREATE TABLE `tbl_labmaterials` (
  `id` int(255) NOT NULL,
  `test_id` int(255) NOT NULL,
  `material_id` int(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_labmaterials`
--

INSERT INTO `tbl_labmaterials` (`id`, `test_id`, `material_id`, `qty`) VALUES
(22, 1, 6, 2),
(23, 3, 7, 1),
(24, 3, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laboffered`
--

CREATE TABLE `tbl_laboffered` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL,
  `patient_queing` int(1) NOT NULL DEFAULT '0',
  `materials` longtext NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_laboffered`
--

INSERT INTO `tbl_laboffered` (`id`, `name`, `description`, `price`, `patient_queing`, `materials`, `category`) VALUES
(1, 'Blood Chem', 'Blood Chem', 2500, 0, '', '0'),
(2, 'Urinalysis', 'urine laboratory', 250, 0, '', ''),
(3, 'ASO TITER', 'sample description', 500, 0, '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labresults`
--

CREATE TABLE `tbl_labresults` (
  `id` int(255) NOT NULL,
  `test_id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `queuing_number` text NOT NULL,
  `resultdata` longtext NOT NULL,
  `image` longtext NOT NULL,
  `normal_range` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_labresults`
--

INSERT INTO `tbl_labresults` (`id`, `test_id`, `patient_id`, `queuing_number`, `resultdata`, `image`, `normal_range`) VALUES
(4, 1, 8, '98GNM', '{"sample 1":"3ul","masd":"30mul"}', '', '["1ul-5ul","35mul-30mul"]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_company`
--

CREATE TABLE `tbl_lab_company` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `ctype` int(1) NOT NULL DEFAULT '0',
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lab_company`
--

INSERT INTO `tbl_lab_company` (`id`, `company_id`, `lab_id`, `ctype`, `price`) VALUES
(4, 6, 2, 1, 230),
(6, 6, 1, 0, 2300),
(7, 6, 3, 0, 450);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materials`
--

CREATE TABLE `tbl_materials` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `qty` double NOT NULL,
  `reorder_level` double NOT NULL,
  `unit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materials`
--

INSERT INTO `tbl_materials` (`id`, `name`, `description`, `qty`, `reorder_level`, `unit`) VALUES
(6, 'Specimen Container', 'Just a sample', 1, 50, 'pc'),
(7, 'New sample ', 'asdasdsad', 1, 50, 'ml');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materials_new`
--

CREATE TABLE `tbl_materials_new` (
  `id` int(255) NOT NULL,
  `material_id` int(255) NOT NULL,
  `dateinput` datetime NOT NULL,
  `expiry` date NOT NULL,
  `qty` double NOT NULL,
  `userid` int(255) NOT NULL,
  `datereceived` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materials_new`
--

INSERT INTO `tbl_materials_new` (`id`, `material_id`, `dateinput`, `expiry`, `qty`, `userid`, `datereceived`) VALUES
(3, 6, '2018-08-31 11:46:49', '2019-05-31', 50, 0, '2018-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicines`
--

CREATE TABLE `tbl_medicines` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `brands` longtext NOT NULL,
  `diseases` longtext NOT NULL,
  `symptoms` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_medicines`
--

INSERT INTO `tbl_medicines` (`id`, `name`, `description`, `brands`, `diseases`, `symptoms`) VALUES
(1, 'sample only', 'asdasd asd asdas', '["1"]', '["2"]', '["2","3"]'),
(2, 'test medicines', 'asd asd ', '["1"]', '["2"]', '["3"]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operations`
--

CREATE TABLE `tbl_operations` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_operations`
--

INSERT INTO `tbl_operations` (`id`, `name`, `description`) VALUES
(1, 'sample operations', 'asd asd as das dasd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordered`
--

CREATE TABLE `tbl_ordered` (
  `id` int(11) NOT NULL,
  `order_number` text NOT NULL,
  `date` int(11) NOT NULL,
  `inclusives` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `pstatus` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ordered`
--

INSERT INTO `tbl_ordered` (`id`, `order_number`, `date`, `inclusives`, `status`, `pstatus`) VALUES
(2, 'ORD-20180831-6V1S', 2018, '["1"]', 1, 1),
(3, 'ORD-20180831-JAD6', 2018, '["4","3"]', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderpayments`
--

CREATE TABLE `tbl_orderpayments` (
  `id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` double NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `check_number` text NOT NULL,
  `check_date` date NOT NULL,
  `account_number` text NOT NULL,
  `bank_name` text NOT NULL,
  `bank_branch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orderpayments`
--

INSERT INTO `tbl_orderpayments` (`id`, `order_id`, `payment_date`, `amount`, `type`, `check_number`, `check_date`, `account_number`, `bank_name`, `bank_branch`) VALUES
(5, 2, '2018-08-31', 23420.25, 0, '', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `id` int(255) NOT NULL,
  `prename` text NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `address` text NOT NULL,
  `bdate` text NOT NULL,
  `bloodtype` text NOT NULL,
  `date_start` date NOT NULL,
  `patient_number` text NOT NULL,
  `phone` text NOT NULL,
  `citizenship` text NOT NULL,
  `email` text NOT NULL,
  `occupation` text NOT NULL,
  `position` text NOT NULL,
  `gender` text NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`id`, `prename`, `fname`, `mname`, `lname`, `address`, `bdate`, `bloodtype`, `date_start`, `patient_number`, `phone`, `citizenship`, `email`, `occupation`, `position`, `gender`, `image`) VALUES
(7, 'Mr', 'Randy', 'G.', 'Gila', 'Sample Address', '18-06-05', 'A+', '2018-08-13', 'SHS-20180813-LHQMEK7W', '9783456436', 'Filipino', 'test@yopmail.com', 'Entrepreneur', 'Sample COmpany', 'Male', 'uploads/user.png'),
(8, 'Mr', 'Micheal', 'B', 'Cruz', 'Daraga', '2009-01-07', 'A+', '2018-08-14', 'SHS-20180814-ND1D6T4N', '09977777', 'Filipino', 'cruz@yopmail.com', 'None', 'Boxer', 'Male', 'uploads/user.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_disease`
--

CREATE TABLE `tbl_patient_disease` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `disease_id` int(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `queuing_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient_disease`
--

INSERT INTO `tbl_patient_disease` (`id`, `patient_id`, `disease_id`, `datetime`, `queuing_number`) VALUES
(1, 8, 2, '2018-08-22 07:42:40', 'QI8U6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_operations`
--

CREATE TABLE `tbl_patient_operations` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `queuing_number` text NOT NULL,
  `operation_id` int(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient_operations`
--

INSERT INTO `tbl_patient_operations` (`id`, `patient_id`, `queuing_number`, `operation_id`, `datetime`) VALUES
(2, 8, 'BJGNZ', 1, '2018-08-22 08:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_symptoms`
--

CREATE TABLE `tbl_patient_symptoms` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `symptom_id` int(255) NOT NULL,
  `queuing_number` text NOT NULL,
  `datetime` datetime NOT NULL,
  `days` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient_symptoms`
--

INSERT INTO `tbl_patient_symptoms` (`id`, `patient_id`, `symptom_id`, `queuing_number`, `datetime`, `days`) VALUES
(8, 8, 2, 'Z17OW', '2018-08-23 08:03:32', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phycisian`
--

CREATE TABLE `tbl_phycisian` (
  `id` int(255) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `fee` double NOT NULL,
  `specialist` text NOT NULL,
  `idfile` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_phycisian`
--

INSERT INTO `tbl_phycisian` (`id`, `fname`, `mname`, `lname`, `fee`, `specialist`, `idfile`) VALUES
(4, 'fdsfsdf', 'fsdfds', 'fsdf', 1000, 'General', '324sdf'),
(5, 'john', 'pat', 'rick', 2000, 'general', 'hgg21312');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription_medicines`
--

CREATE TABLE `tbl_prescription_medicines` (
  `id` int(255) NOT NULL,
  `prescription_id` int(255) NOT NULL,
  `medicine_id` int(255) NOT NULL,
  `qty` int(5) NOT NULL,
  `times` text NOT NULL,
  `days` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presription`
--

CREATE TABLE `tbl_presription` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `queuing_number` text NOT NULL,
  `dr_id` int(255) NOT NULL,
  `dr_name` text NOT NULL,
  `medecine_id` int(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `qty` text NOT NULL,
  `times` text NOT NULL,
  `days` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_presription`
--

INSERT INTO `tbl_presription` (`id`, `patient_id`, `queuing_number`, `dr_id`, `dr_name`, `medecine_id`, `datetime`, `qty`, `times`, `days`) VALUES
(3, 8, 'Z17OW', 19, 'Dra. Liza So Berano', 1, '2018-08-23 08:13:13', '18', '2', '6'),
(4, 8, 'Z17OW', 19, 'Dra. Liza So Berano', 2, '2018-08-23 08:14:08', '6', '0', '6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchaserequest`
--

CREATE TABLE `tbl_purchaserequest` (
  `id` int(255) NOT NULL,
  `material_id` int(255) NOT NULL,
  `qty` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `stocked` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchaserequest`
--

INSERT INTO `tbl_purchaserequest` (`id`, `material_id`, `qty`, `status`, `date`, `stocked`) VALUES
(1, 6, 50, 2, '2018-08-31 10:55:12', 0),
(3, 7, 50, 1, '2018-08-31 13:27:34', 0),
(4, 6, 60, 1, '2018-08-31 14:14:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_queuing`
--

CREATE TABLE `tbl_queuing` (
  `id` int(255) NOT NULL,
  `dtime` datetime NOT NULL,
  `queuing_number` text NOT NULL,
  `patient_type` text NOT NULL,
  `patient_id` int(255) NOT NULL,
  `trans_type` text NOT NULL,
  `which` text NOT NULL,
  `patient_class` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `or_number` text NOT NULL,
  `dr_id` int(255) NOT NULL,
  `dr_name` text NOT NULL,
  `skipwait` int(1) NOT NULL DEFAULT '0',
  `labcategory` int(255) NOT NULL,
  `followprice` double NOT NULL,
  `process_start` datetime NOT NULL,
  `material_count` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_queuing`
--

INSERT INTO `tbl_queuing` (`id`, `dtime`, `queuing_number`, `patient_type`, `patient_id`, `trans_type`, `which`, `patient_class`, `status`, `date`, `or_number`, `dr_id`, `dr_name`, `skipwait`, `labcategory`, `followprice`, `process_start`, `material_count`) VALUES
(12, '2018-08-21 14:15:52', '98GNM', 'OLD', 8, 'Laboratory', '1', 'Individual', 1, '2018-08-21', '0001', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(13, '2018-08-21 14:15:52', '98GNM', 'OLD', 8, 'Laboratory', '2', 'Individual', 1, '2018-08-21', '0001', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(14, '2018-08-21 14:16:09', 'XQM31', 'OLD', 7, 'Check-up', '0', 'Individual', 1, '2018-08-21', '0002', 17, 'Dra Riza N Thor', 0, 0, 0, '0000-00-00 00:00:00', 0),
(15, '2018-08-22 06:00:10', 'QI8U6', 'OLD', 8, 'Check-up', '0', 'Individual', 2, '2018-08-22', '0003', 17, 'Dra Riza N Thor', 0, 0, 0, '0000-00-00 00:00:00', 0),
(16, '2018-08-22 07:51:19', 'BJGNZ', 'OLD', 8, 'Check-up', '0', 'Individual', 2, '2018-08-22', '0004', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(17, '2018-08-23 06:27:38', 'Z17OW', 'OLD', 8, 'Check-up', '0', 'Individual', 5, '2018-08-23', '0005', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(18, '2018-08-23 08:00:00', 'JZMWT', 'OLD', 8, 'Check-up', '0', 'Individual', 0, '2018-08-23', '', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(19, '2018-08-30 05:45:43', 'UUWRN', 'OLD', 7, 'Check-up', '0', 'Individual', 0, '2018-08-30', '', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(20, '2018-08-30 05:48:52', '7WWI8', 'OLD', 7, 'Check-up', '0', 'Individual', 0, '2018-08-30', '', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(21, '2018-08-30 05:49:34', 'X72A7', 'OLD', 7, 'Check-up', '0', 'Individual', 0, '2018-08-30', '', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(22, '2018-08-30 06:04:27', 'K56SA', 'OLD', 7, 'Check-up', '0', 'Individual', 0, '2018-08-30', '', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0),
(23, '2018-08-30 06:09:21', 'H7UV5', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(24, '2018-08-30 06:09:21', 'H7UV5', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(25, '2018-08-30 06:10:21', 'PX932', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(26, '2018-08-30 06:10:21', 'PX932', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(27, '2018-08-30 06:12:18', 'GR3HS', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(28, '2018-08-30 06:12:18', 'GR3HS', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(29, '2018-08-30 06:12:38', 'ERA1B', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(30, '2018-08-30 06:12:38', 'ERA1B', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(31, '2018-08-30 06:14:15', 'V9IR5', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(32, '2018-08-30 06:14:15', 'V9IR5', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(33, '2018-08-30 06:14:49', '9XVHQ', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(34, '2018-08-30 06:14:49', '9XVHQ', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(35, '2018-08-30 06:15:49', 'MSAYE', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(36, '2018-08-30 06:15:49', 'MSAYE', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(37, '2018-08-30 06:18:17', 'MIFCD', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(38, '2018-08-30 06:18:17', 'MIFCD', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(39, '2018-08-30 06:30:12', '22I4S', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(40, '2018-08-30 06:30:12', '22I4S', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-30', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(41, '2018-08-30 06:31:25', '12W16', 'OLD', 8, 'Laboratory', '3', 'Individual', 1, '2018-08-30', '0006', 0, '', 1, 1, 0, '0000-00-00 00:00:00', 0),
(42, '2018-08-31 07:39:15', 'HE67S', 'OLD', 7, 'Laboratory', '1', 'Individual', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(43, '2018-08-31 07:39:15', 'HE67S', 'OLD', 7, 'Laboratory', '3', 'Individual', 0, '2018-08-31', '', 0, '', 1, 1, 0, '0000-00-00 00:00:00', 0),
(44, '2018-08-31 07:41:23', 'X54G6', 'OLD', 8, 'Laboratory', '1', 'Pre-employment', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(45, '2018-08-31 07:41:50', 'H6N16', 'OLD', 8, 'Laboratory', '2', 'Annual', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(46, '2018-08-31 07:42:13', 'YTT2X', 'OLD', 8, 'Laboratory', '3', '', 0, '2018-08-31', '', 0, '', 1, 1, 0, '0000-00-00 00:00:00', 0),
(47, '2018-08-31 07:42:13', 'YTT2X', 'OLD', 8, 'Laboratory', '1', '', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(48, '2018-08-31 07:43:07', 'BEEW3', 'OLD', 8, 'Laboratory', '3', 'Individual', 0, '2018-08-31', '', 0, '', 1, 1, 0, '0000-00-00 00:00:00', 0),
(49, '2018-08-31 07:43:07', 'BEEW3', 'OLD', 8, 'Laboratory', '1', 'Individual', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(50, '2018-08-31 07:47:49', '7LRUZ', 'OLD', 8, 'Laboratory', '2', 'Annual', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(51, '2018-08-31 07:48:59', '35WN7', 'OLD', 8, 'Laboratory', '2', 'Annual', 0, '2018-08-31', '', 0, '', 1, 0, 0, '0000-00-00 00:00:00', 0),
(52, '2018-08-31 07:50:16', '31K6L', 'OLD', 8, 'Laboratory', '2', 'Annual', 0, '2018-08-31', '', 0, '', 1, 0, 230, '0000-00-00 00:00:00', 0),
(53, '2018-08-31 16:41:28', 'LQ97Q', 'OLD', 8, 'Laboratory', '3', 'Individual', 3, '2018-08-31', '0007', 0, '', 1, 1, 500, '0000-00-00 00:00:00', 1),
(54, '2018-09-01 09:14:21', 'JG241', 'OLD', 8, 'Check-up', '0', 'Individual', 2, '2018-09-01', '0008', 19, 'Dra. Liza So Berano', 0, 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result_data`
--

CREATE TABLE `tbl_result_data` (
  `id` int(11) NOT NULL,
  `labtest_id` int(11) NOT NULL,
  `data_title` longtext NOT NULL,
  `normal_range` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_result_data`
--

INSERT INTO `tbl_result_data` (`id`, `labtest_id`, `data_title`, `normal_range`) VALUES
(1, 2, '["Color","Transparency","Ph","Specific gravity","Protien","Sugar","pus cells","Amorphous Urates","calcium oxalates","Amorphous phosphates"]', '["1ul-5ul","35mul-30mul"]'),
(3, 1, '["sample 1","masd"]', '["1ul-5ul","35mul-30mul"]'),
(4, 3, '["Sample New","dddddd"]', '["125ul-200ul","asdasd asd","asdasd asd","dfgfdg","ffffff","ddddddaaaaa"]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(255) NOT NULL,
  `title` text NOT NULL,
  `name` text NOT NULL,
  `value` longtext NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `title`, `name`, `value`, `create_date`, `update_date`) VALUES
(1, 'O.R. Start', 'or_start', '1', '2018-08-18 00:00:00', '2018-08-18 00:00:00'),
(2, 'VAT', 'vat', '0', '2018-08-19 00:00:00', '2018-08-19 00:00:00'),
(3, 'Withholding Tax', 'wht', '.05', '2018-08-19 00:00:00', '2018-08-19 00:00:00'),
(4, 'O.R. Prefix', 'orprefix', 'AAA', '2018-08-21 00:00:00', '2018-08-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_symptoms`
--

CREATE TABLE `tbl_symptoms` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_symptoms`
--

INSERT INTO `tbl_symptoms` (`id`, `name`, `description`) VALUES
(2, 'asdasd', 'asd asd asd'),
(3, 'dasf dsf sdf', ' sdf sdf sdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_time` time NOT NULL,
  `total_amount` double NOT NULL,
  `net` double NOT NULL,
  `or_number` text NOT NULL,
  `amount_paid` double NOT NULL,
  `queuing_number` text NOT NULL,
  `realdate` datetime NOT NULL,
  `vat` double NOT NULL,
  `wht` double NOT NULL,
  `orprefix` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `patient_id`, `trans_date`, `trans_time`, `total_amount`, `net`, `or_number`, `amount_paid`, `queuing_number`, `realdate`, `vat`, `wht`, `orprefix`) VALUES
(5, 8, '2018-08-21', '14:16:45', 2750, 2612.5, '0001', 2750, '98GNM', '2018-08-21 14:16:45', 0, 137.5, 'AAA'),
(7, 7, '2018-08-21', '14:19:20', 500, 475, '0002', 500, 'XQM31', '2018-08-21 14:19:20', 0, 25, 'AAA'),
(8, 8, '2018-08-22', '06:00:45', 500, 475, '0003', 500, 'QI8U6', '2018-08-22 06:00:45', 0, 25, 'AAA'),
(9, 8, '2018-08-22', '07:57:39', 500, 475, '0004', 500, 'BJGNZ', '2018-08-22 07:57:39', 0, 25, 'AAA'),
(10, 8, '2018-08-23', '06:27:59', 500, 475, '0005', 500, 'Z17OW', '2018-08-23 06:27:59', 0, 25, 'AAA'),
(11, 8, '2018-08-30', '06:37:48', 500, 475, '0006', 500, '12W16', '2018-08-30 06:37:48', 0, 25, 'AAA'),
(12, 8, '2018-08-31', '16:42:02', 500, 475, '0007', 500, 'LQ97Q', '2018-08-31 16:42:02', 0, 25, 'AAA'),
(13, 8, '2018-09-01', '09:14:40', 500, 475, '0008', 500, 'JG241', '2018-09-01 09:14:40', 0, 25, 'AAA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usedmaterials`
--

CREATE TABLE `tbl_usedmaterials` (
  `id` int(255) NOT NULL,
  `lab_id` int(255) NOT NULL,
  `consumed` double NOT NULL,
  `material_id` int(255) NOT NULL,
  `availedlab_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usedmaterials`
--

INSERT INTO `tbl_usedmaterials` (`id`, `lab_id`, `consumed`, `material_id`, `availedlab_id`) VALUES
(1, 2, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vitalsigns`
--

CREATE TABLE `tbl_vitalsigns` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `queuing_number` text NOT NULL,
  `type` int(1) NOT NULL,
  `datetime` datetime NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vitalsigns`
--

INSERT INTO `tbl_vitalsigns` (`id`, `patient_id`, `queuing_number`, `type`, `datetime`, `value`) VALUES
(8, 8, 'QI8U6', 1, '2018-08-22 07:03:35', '100/80');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acl`
--
ALTER TABLE `tbl_acl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_availedlab`
--
ALTER TABLE `tbl_availedlab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_diseases`
--
ALTER TABLE `tbl_diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_labcategory`
--
ALTER TABLE `tbl_labcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_labmaterials`
--
ALTER TABLE `tbl_labmaterials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_laboffered`
--
ALTER TABLE `tbl_laboffered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_labresults`
--
ALTER TABLE `tbl_labresults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lab_company`
--
ALTER TABLE `tbl_lab_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_materials`
--
ALTER TABLE `tbl_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_materials_new`
--
ALTER TABLE `tbl_materials_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_medicines`
--
ALTER TABLE `tbl_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_operations`
--
ALTER TABLE `tbl_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ordered`
--
ALTER TABLE `tbl_ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orderpayments`
--
ALTER TABLE `tbl_orderpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patient_disease`
--
ALTER TABLE `tbl_patient_disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patient_operations`
--
ALTER TABLE `tbl_patient_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patient_symptoms`
--
ALTER TABLE `tbl_patient_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_phycisian`
--
ALTER TABLE `tbl_phycisian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prescription_medicines`
--
ALTER TABLE `tbl_prescription_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_presription`
--
ALTER TABLE `tbl_presription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchaserequest`
--
ALTER TABLE `tbl_purchaserequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_queuing`
--
ALTER TABLE `tbl_queuing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_result_data`
--
ALTER TABLE `tbl_result_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_symptoms`
--
ALTER TABLE `tbl_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_usedmaterials`
--
ALTER TABLE `tbl_usedmaterials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vitalsigns`
--
ALTER TABLE `tbl_vitalsigns`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acl`
--
ALTER TABLE `tbl_acl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;
--
-- AUTO_INCREMENT for table `tbl_availedlab`
--
ALTER TABLE `tbl_availedlab`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_diseases`
--
ALTER TABLE `tbl_diseases`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_labcategory`
--
ALTER TABLE `tbl_labcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_labmaterials`
--
ALTER TABLE `tbl_labmaterials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_laboffered`
--
ALTER TABLE `tbl_laboffered`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_labresults`
--
ALTER TABLE `tbl_labresults`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_lab_company`
--
ALTER TABLE `tbl_lab_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_materials`
--
ALTER TABLE `tbl_materials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_materials_new`
--
ALTER TABLE `tbl_materials_new`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_medicines`
--
ALTER TABLE `tbl_medicines`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_operations`
--
ALTER TABLE `tbl_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_ordered`
--
ALTER TABLE `tbl_ordered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_orderpayments`
--
ALTER TABLE `tbl_orderpayments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_patient_disease`
--
ALTER TABLE `tbl_patient_disease`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_patient_operations`
--
ALTER TABLE `tbl_patient_operations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_patient_symptoms`
--
ALTER TABLE `tbl_patient_symptoms`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_phycisian`
--
ALTER TABLE `tbl_phycisian`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_prescription_medicines`
--
ALTER TABLE `tbl_prescription_medicines`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_presription`
--
ALTER TABLE `tbl_presription`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_purchaserequest`
--
ALTER TABLE `tbl_purchaserequest`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_queuing`
--
ALTER TABLE `tbl_queuing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `tbl_result_data`
--
ALTER TABLE `tbl_result_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_symptoms`
--
ALTER TABLE `tbl_symptoms`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_usedmaterials`
--
ALTER TABLE `tbl_usedmaterials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_vitalsigns`
--
ALTER TABLE `tbl_vitalsigns`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
