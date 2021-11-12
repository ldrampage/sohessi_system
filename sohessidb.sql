-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 10:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sohessidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `result_datas`
--

CREATE TABLE `result_datas` (
  `labtest_id` int(11) NOT NULL,
  `data_title` longtext NOT NULL,
  `normal_range` longtext NOT NULL,
  `options` longtext NOT NULL,
  `type` longtext NOT NULL,
  `id` int(255) NOT NULL,
  `order_number` longtext NOT NULL,
  `order_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_datas`
--

INSERT INTO `result_datas` (`labtest_id`, `data_title`, `normal_range`, `options`, `type`, `id`, `order_number`, `order_data`) VALUES
(161, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 1, '', '[\"1\",\"2\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 2, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 3, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 4, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 5, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 6, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 7, '', '[\"1\"]'),
(24, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Anti-HBS Screening\"],[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 8, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(26, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"Hepatitis IgG/IgM\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Hepatitis IgG/IgM\"],[\"Positive (+)\",\"  Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 9, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(122, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\"Positive (+)\",\"   Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 10, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(121, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"Hepatitis IgM\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Hepatitis IgM\"],[\"Positive (+)\",\"  Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 11, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(25, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"Hepatitis C Screening\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Hepatitis C Screening\"],[\"Positive (+)\",\"  Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 12, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(73, '[\"PSA\"]', '[\"0 - 4.00 ng/ml\"]', '[[\" \"]]', '[\"text\"]', 13, '', ''),
(179, '[\"Date and Time of Collection\",\"Collected By\",\"Drug Test Analyst\"]', '[\"mm/dd/yyyy hr:min\",\"ASC Name\",\"Analyst\"]', '[[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\"]', 14, '', '[\"1\",\"2\",\"3\"]'),
(27, '[\"Date Tested\",\"Kit Used\",\"Lot #\",\"Expiration Date\",\"Tested By\"]', '[\"mm/dd/yyyy\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 15, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(20, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"HBsAg Screening\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"HBsAg Screening\"],[\"Reactive\",\"  Non-Reactive\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 16, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(44, '[\"AFB Stain\"]', '[\"O+, +n, 1+, 2+, 3+\"]', '[[\" \"]]', '[\"text\"]', 17, '', '[\"1\"]'),
(40, '[\"Result\"]', '[\"N/A\"]', '[[\"Positive (+)\",\"  Negative (-)\"]]', '[\"text\"]', 18, '', '[\"1\"]'),
(38, '[\"Result\"]', '[\"N/A\"]', '[[\"Positive (+)\",\"  Negative (-)\"]]', '[\"text\"]', 19, '', '[\"1\"]'),
(96, '[\"Result\"]', '[\"3.4 tp 5.4 g/dL\"]', '[[\" \"]]', '[\"text\"]', 20, '', '[\"1\"]'),
(93, '[\"Result\"]', '[\"(F) 44-98 U/I | (M) 53-128 U/I\"]', '[[\" \"]]', '[\"text\"]', 21, '', '[\"1\"]'),
(82, '[\"Result\"]', '[\"(F) 149 - 405 umol/L | (M) 214 - 458 umol/L\"]', '[[\" \"]]', '[\"text\"]', 22, '', '[\"1\"]'),
(83, '[\"Result\"]', '[\"up to 8.3 mmol/L\"]', '[[\" \"]]', '[\"text\"]', 23, '', '[\"1\"]'),
(85, '[\"Result\"]', '[\"up to 5.2 mmol/L\"]', '[[\" \"]]', '[\"text\"]', 24, '', '[\"1\"]'),
(84, '[\"Result\"]', '[\"(F) 53 - 97 umol/L | (M) 62 - 115 umol/L\"]', '[[\" \"]]', '[\"text\"]', 25, '', '[\"1\"]'),
(89, '[\"Glucose (FBS)\",\"2 Hour PPBS\"]', '[\"4.1 - 5.9 mmol/L\",\"3.8 - 6.6 mmol/L\"]', '[[\" \"],[\" \"]]', '[\"text\",\"text\"]', 26, '', '[\"1\",\"2\"]'),
(81, '[\"Glucose (FBS)\",\"1st Hour OGTT\",\"2nd Hour OGTT\",\"2 Hour PPBS\"]', '[\"4.1 - 5.9 mmol/L\",\"6.6 - 9.9 mmol/L\",\"3.8 - 8.5 mmol/L\",\"3.8 - 6/6 mmol/L\"]', '[[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\"]', 27, '', '[\"01\",\"02\",\"03\",\"04\"]'),
(88, '[\"Glucose (FBS)\",\"1st Hour OGTT\",\"2nd Hour OGTT\"]', '[\"4.1 - 5.9 mmol/L\",\"6.6 - 9.9 mmol/L\",\"3.8 - 8.5 mmol/L\"]', '[[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\"]', 28, '', '[\"01\",\"02\",\"03\"]'),
(91, '[\"Result\"]', '[\"(F) up to 32 U/I | (M) up to 42 U/I\"]', '[[\"NONE\"]]', '[\"text\"]', 29, '', '[\"01\"]'),
(92, '[\"Result\"]', '[\"(F) up to 32 U/I | (M) up to 42 U/I\"]', '[[\" \"]]', '[\"text\"]', 30, '', '[\"01\"]'),
(95, '[\"Result\"]', '[\"6.60 - 8.70 g/dl\"]', '[[\" \"]]', '[\"text\"]', 31, '', '[\"01\"]'),
(106, '[\"Result\"]', '[\"4.5% - 6.5%\"]', '[[\" \"]]', '[\"text\"]', 32, '', '[\"01\"]'),
(97, '[\"Total Protein\",\"Albumin\",\"Globulin\",\"Albumin/Globulin Ratio\",\"Alkaline Phosphatase\"]', '[\"6.60 - 8.70 g/dl\",\"3.50 - 5.20 g/dl\",\"2.30 - 3.00 g/dl\",\"1.1 - 2.5\",\"54 - 369 U/L\"]', '[[\" \"],[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 33, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(86, '[\"Result\"]', '[\"up to 1.7 mmol/L\"]', '[[\" \"]]', '[\"text\"]', 34, '', '[\"01\"]'),
(160, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" N/A\"],[\"Positive (+)\",\"  Negative (-)\"]]', '[\"image\",\"text\"]', 35, '', '[\"1\",\"2\"]'),
(126, '[\"Level of Fluid\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 36, '', '[\"1\"]'),
(140, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 37, '', '[\"01\",\"02\"]'),
(154, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 38, '', '[\"01\",\"02\"]'),
(155, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 39, '', '[\"01\",\"02\"]'),
(159, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 40, '', '[\"1\",\"2\"]'),
(94, '[\"Acid Phosphatase\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 41, '', '[\"1\"]'),
(36, '[\"Yeast Cells\",\"Amorphous Urates\",\"Calcium Oxalates\",\"Amorphous Phospates\",\"Triple Phosphates\",\"Uric Acid\",\"Color\",\"Transparency\",\"Ph\",\"Specific Gravity\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\"]', 42, '', '[\"021\",\"022\",\"023\",\"024\",\"025\",\"026\",\"1\",\"2\",\"3\",\"4\"]'),
(35, '[\"Color\",\"Consistency\",\"Pus Cells\",\"Red Blood Cells\",\"Fat Globules\",\"Muscle Fiber\",\"Yeast Cells\",\"Vegetable Cells\",\"Occult Blood\",\"Parasites\"]', '[\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\"]', '[[\"Brown\",\"           Dark Brown\",\"           Greenish Brown\",\"           Light Brown\",\"           Yellow\",\"           Light Yellow\"],[\"Soft\",\"           Semi-Formed\",\"           Formed\",\"           Watery\",\"           Loose\"],[\"none\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"N/A\"],[\"n/a\"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\"]', 43, '', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\"]'),
(209, '[\"Images\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 44, '', '[\"1\",\"2\"]'),
(124, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\"Positive (+)\",\"     Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 45, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(178, '[\"Image\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 46, '', '[\"1\"]'),
(210, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 47, '', '[\"01\",\"02\"]'),
(211, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 48, '', '[\"01\",\"02\"]'),
(216, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 49, '', '[\"01\",\"02\"]'),
(217, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 50, '', '[\"01\",\"02\"]'),
(218, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 51, '', '[\"01\",\"02\"]'),
(212, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"text\",\"text\"]', 52, '', '[\"01\",\"02\"]'),
(213, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 53, '', '[\"01\",\"02\"]'),
(215, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 54, '', '[\"01\",\"02\"]'),
(214, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 55, '', '[\"01\",\"02\"]'),
(219, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 56, '', '[\"01\",\"02\"]'),
(220, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 57, '', '[\"01\",\"02\"]'),
(221, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 58, '', '[\"01\",\"02\"]'),
(222, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 59, '', '[\"01\",\"02\"]'),
(223, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 60, '', '[\"01\",\"02\"]'),
(224, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 61, '', '[\"01\",\"02\"]'),
(225, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 62, '', '[\"01\",\"02\"]'),
(226, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 63, '', '[\"01\",\"02\"]'),
(227, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 64, '', '[\"01\",\"02\"]'),
(228, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 65, '', '[\"1\",\"02\"]'),
(175, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 66, '', '[\"01\",\"02\"]'),
(233, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 67, '', '[\"01\",\"02\"]'),
(234, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 68, '', '[\"01\",\"02\"]'),
(176, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 69, '', '[\"01\",\"02\"]'),
(237, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 70, '', '[\"01\",\"02\"]'),
(238, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 71, '', '[\"01\",\"02\"]'),
(231, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 72, '', '[\"01\",\"02\"]'),
(239, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 73, '', '[\"01\",\"02\"]'),
(246, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 74, '', '[\"01\",\"02\"]'),
(240, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 75, '', ''),
(241, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 76, '', '[\"01\",\"02\"]'),
(242, '[\"Image 1\",\"Image 2\",\"Image 3\",\"Findings\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"image\",\"image\",\"image\",\"text\"]', 77, '', '[\"01\",\"02\",\"03\",\"04\"]'),
(232, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 78, '', '[\"01\",\"02\"]'),
(243, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 79, '', '[\"01\",\"02\"]'),
(245, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 80, '', '[\"01\",\"02\"]'),
(244, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 81, '', '[\"01\",\"02\"]'),
(235, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 82, '', '[\"01\",\"02\"]'),
(236, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 83, '', '[\"01\",\"02\"]'),
(0, '[\"1\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 84, '', '[\"1\"]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acl`
--

CREATE TABLE `tbl_acl` (
  `id` int(255) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `feature_code` text NOT NULL,
  `fcontrol` int(1) NOT NULL DEFAULT 0
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
(213, 20, 'tests', 1),
(214, 20, 'tests-create', 0),
(215, 20, 'tests-update', 0),
(216, 20, 'tests-view', 1),
(217, 20, 'tests-delete', 0),
(218, 20, 'testcategory', 1),
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
(262, 20, 'prescription-create', 0),
(263, 20, 'prescription-update', 0),
(264, 20, 'prescription-view', 0),
(265, 20, 'prescription-delete', 0),
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
(280, 20, 'settings', 1),
(281, 20, 'reports', 0),
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
(292, 20, 'result-create', 0),
(293, 20, 'patient-result', 1),
(294, 20, 'result-update', 0),
(295, 20, 'crete-lab-result', 0),
(296, 18, 'materials-stock', 1),
(297, 18, 'purchaserequest-delete', 1),
(298, 18, 'purchaserequest-create', 1),
(299, 18, 'purchasing', 1),
(300, 18, 'purchase', 1),
(301, 18, 'purchase-create', 1),
(302, 18, 'purchase-update', 1),
(303, 18, 'purchase-delete', 1),
(304, 18, 'purchase-view', 1),
(305, 18, 'orders', 1),
(306, 18, 'orders-create', 1),
(307, 18, 'orders-update', 1),
(308, 18, 'orders-view', 1),
(309, 18, 'orders-delete', 1),
(310, 18, 'payments', 1),
(311, 18, 'payments-create', 1),
(312, 18, 'payments-update', 1),
(313, 18, 'payments-delete', 1),
(314, 18, 'payments-view', 1),
(315, 18, 'patient-report', 1),
(316, 18, 'transaction-report', 1),
(317, 18, 'pricing-report', 1),
(318, 19, 'testcategory', 0),
(319, 19, 'testcategory-create', 0),
(320, 19, 'testcategory-update', 0),
(321, 19, 'testcategory-view', 0),
(322, 19, 'testcategory-delete', 0),
(323, 19, 'process', 0),
(324, 19, 'patient-test', 0),
(325, 19, 'process-test', 0),
(326, 19, 'result-create', 0),
(327, 19, 'patient-result', 0),
(328, 19, 'result-update', 0),
(329, 19, 'crete-lab-result', 0),
(330, 18, 'process', 1),
(331, 20, 'process', 0),
(332, 18, 'saveresult', 1),
(333, 18, 'suppliers', 1),
(334, 18, 'suppliers-create', 1),
(335, 18, 'suppliers-update', 1),
(336, 18, 'suppliers-view', 1),
(337, 18, 'suppliers-delete', 1),
(338, 21, 'home', 1),
(339, 21, 'profile', 1),
(340, 21, 'employee', 1),
(341, 21, 'employee-create', 1),
(342, 21, 'employee-update', 1),
(343, 21, 'employee-view', 1),
(344, 21, 'employee-delete', 1),
(345, 21, 'patients', 1),
(346, 21, 'patients-create', 1),
(347, 21, 'patients-update', 1),
(348, 21, 'patients-view', 1),
(349, 21, 'patients-delete', 1),
(350, 21, 'patients-disease-create', 1),
(351, 21, 'patients-disease-delete', 1),
(352, 21, 'department', 1),
(353, 21, 'department-create', 1),
(354, 21, 'department-update', 1),
(355, 21, 'department-view', 1),
(356, 21, 'department-delete', 1),
(357, 21, 'company', 1),
(358, 21, 'company-create', 1),
(359, 21, 'company-update', 1),
(360, 21, 'company-view', 1),
(361, 21, 'company-lab', 1),
(362, 21, 'company-delete', 1),
(363, 21, 'tests', 1),
(364, 21, 'tests-create', 1),
(365, 21, 'tests-update', 1),
(366, 21, 'tests-view', 1),
(367, 21, 'tests-delete', 1),
(368, 21, 'testcategory', 1),
(369, 21, 'testcategory-create', 1),
(370, 21, 'testcategory-update', 1),
(371, 21, 'testcategory-view', 1),
(372, 21, 'testcategory-delete', 1),
(373, 21, 'materials', 1),
(374, 21, 'materials-create', 1),
(375, 21, 'materials-update', 1),
(376, 21, 'materials-view', 1),
(377, 21, 'materials-delete', 1),
(378, 21, 'process', 1),
(379, 21, 'saveresult', 1),
(380, 21, 'patient', 1),
(381, 21, 'patient-create', 1),
(382, 21, 'patient-update', 1),
(383, 21, 'patient-view', 1),
(384, 21, 'patient-delete', 1),
(385, 21, 'transactions', 1),
(386, 21, 'transactions-create', 1),
(387, 21, 'transactions-update', 1),
(388, 21, 'transactions-view', 1),
(389, 21, 'transactions-delete', 1),
(390, 21, 'consultation', 1),
(391, 21, 'consult', 1),
(392, 21, 'patient-test', 1),
(393, 21, 'process-test', 1),
(394, 21, 'result-create', 1),
(395, 21, 'patient-result', 1),
(396, 21, 'result-update', 1),
(397, 21, 'access-controls', 1),
(398, 21, 'medicines', 1),
(399, 21, 'medicines-create', 1),
(400, 21, 'medicines-update', 1),
(401, 21, 'medicines-view', 1),
(402, 21, 'medicines-delete', 1),
(403, 21, 'diseases', 1),
(404, 21, 'diseases-create', 1),
(405, 21, 'diseases-update', 1),
(406, 21, 'diseases-view', 1),
(407, 21, 'diseases-delete', 1),
(408, 21, 'suppliers', 1),
(409, 21, 'suppliers-create', 1),
(410, 21, 'suppliers-update', 1),
(411, 21, 'suppliers-view', 1),
(412, 21, 'suppliers-delete', 1),
(413, 21, 'symptoms', 1),
(414, 21, 'symptoms-create', 1),
(415, 21, 'symptoms-update', 1),
(416, 21, 'symptoms-view', 1),
(417, 21, 'symptoms-delete', 1),
(418, 21, 'operations', 1),
(419, 21, 'operations-create', 1),
(420, 21, 'operations-update', 1),
(421, 21, 'operations-view', 1),
(422, 21, 'operations-delete', 1),
(423, 21, 'prescription', 1),
(424, 21, 'prescription-create', 1),
(425, 21, 'prescription-update', 1),
(426, 21, 'prescription-view', 1),
(427, 21, 'prescription-delete', 1),
(428, 21, 'brands', 1),
(429, 21, 'brands-create', 1),
(430, 21, 'brands-update', 1),
(431, 21, 'brands-view', 1),
(432, 21, 'brands-delete', 1),
(433, 21, 'vital', 1),
(434, 21, 'vital-create', 1),
(435, 21, 'vital-update', 1),
(436, 21, 'vital-view', 1),
(437, 21, 'vital-delete', 1),
(438, 21, 'transaction', 1),
(439, 21, 'transaction-create', 1),
(440, 21, 'transaction-update', 1),
(441, 21, 'transaction-view', 1),
(442, 21, 'settings', 1),
(443, 21, 'reports', 1),
(444, 21, 'access-log', 1),
(445, 21, 'acl', 1),
(446, 21, 'crete-lab-result', 1),
(447, 18, 'po', 1),
(448, 18, 'po-create', 1),
(449, 18, 'po-update', 1),
(450, 18, 'po-view', 1),
(451, 18, 'po-delete', 1),
(452, 18, 'po-approval', 1),
(453, 18, 'po-receive', 1),
(454, 18, 'po-order', 1),
(455, 18, 'po-approve', 1),
(456, 21, 'po', 1),
(457, 21, 'po-create', 1),
(458, 21, 'po-update', 1),
(459, 21, 'po-view', 1),
(460, 21, 'po-delete', 1),
(461, 21, 'po-approve', 1),
(462, 21, 'po-receive', 1),
(463, 21, 'po-order', 1),
(464, 32, 'home', 1),
(465, 32, 'profile', 1),
(466, 32, 'employee', 0),
(467, 32, 'employee-create', 0),
(468, 32, 'employee-update', 0),
(469, 32, 'employee-view', 0),
(470, 32, 'employee-delete', 0),
(471, 32, 'patients', 1),
(472, 32, 'patients-create', 0),
(473, 32, 'patients-update', 0),
(474, 32, 'patients-view', 0),
(475, 32, 'patients-delete', 0),
(476, 32, 'patients-disease-create', 0),
(477, 32, 'patients-disease-delete', 0),
(478, 32, 'department', 1),
(479, 32, 'department-create', 0),
(480, 32, 'department-update', 0),
(481, 32, 'department-view', 1),
(482, 32, 'department-delete', 0),
(483, 32, 'company', 1),
(484, 32, 'company-create', 0),
(485, 32, 'company-update', 0),
(486, 32, 'company-view', 0),
(487, 32, 'company-lab', 1),
(488, 32, 'company-delete', 0),
(489, 32, 'tests', 1),
(490, 32, 'tests-create', 0),
(491, 32, 'tests-update', 0),
(492, 32, 'tests-view', 0),
(493, 32, 'tests-delete', 0),
(494, 32, 'testcategory', 0),
(495, 32, 'testcategory-create', 0),
(496, 32, 'testcategory-update', 0),
(497, 32, 'testcategory-view', 0),
(498, 32, 'testcategory-delete', 0),
(499, 32, 'materials', 1),
(500, 32, 'materials-create', 0),
(501, 32, 'materials-update', 0),
(502, 32, 'materials-view', 1),
(503, 32, 'materials-delete', 0),
(504, 32, 'process', 1),
(505, 32, 'saveresult', 1),
(506, 32, 'patient', 1),
(507, 32, 'patient-create', 0),
(508, 32, 'patient-update', 1),
(509, 32, 'patient-view', 1),
(510, 32, 'patient-delete', 0),
(511, 32, 'transactions', 1),
(512, 32, 'transactions-create', 0),
(513, 32, 'transactions-update', 0),
(514, 32, 'transactions-view', 1),
(515, 32, 'transactions-delete', 0),
(516, 32, 'consultation', 0),
(517, 32, 'consult', 0),
(518, 32, 'patient-test', 1),
(519, 32, 'process-test', 0),
(520, 32, 'result-create', 0),
(521, 32, 'patient-result', 1),
(522, 32, 'result-update', 1),
(523, 32, 'access-controls', 0),
(524, 32, 'medicines', 0),
(525, 32, 'medicines-create', 0),
(526, 32, 'medicines-update', 0),
(527, 32, 'medicines-view', 0),
(528, 32, 'medicines-delete', 0),
(529, 32, 'diseases', 0),
(530, 32, 'diseases-create', 0),
(531, 32, 'diseases-update', 0),
(532, 32, 'diseases-view', 1),
(533, 32, 'diseases-delete', 0),
(534, 32, 'suppliers', 0),
(535, 32, 'suppliers-create', 0),
(536, 32, 'suppliers-update', 0),
(537, 32, 'suppliers-view', 0),
(538, 32, 'suppliers-delete', 0),
(539, 32, 'po', 0),
(540, 32, 'po-create', 0),
(541, 32, 'po-update', 0),
(542, 32, 'po-view', 0),
(543, 32, 'po-delete', 0),
(544, 32, 'po-approve', 0),
(545, 32, 'po-receive', 0),
(546, 32, 'po-order', 0),
(547, 32, 'symptoms', 0),
(548, 32, 'symptoms-create', 0),
(549, 32, 'symptoms-update', 0),
(550, 32, 'symptoms-view', 0),
(551, 32, 'symptoms-delete', 0),
(552, 32, 'operations', 0),
(553, 32, 'operations-create', 0),
(554, 32, 'operations-update', 0),
(555, 32, 'operations-view', 0),
(556, 32, 'operations-delete', 0),
(557, 32, 'prescription', 0),
(558, 32, 'prescription-create', 0),
(559, 32, 'prescription-update', 0),
(560, 32, 'prescription-view', 0),
(561, 32, 'prescription-delete', 0),
(562, 32, 'brands', 0),
(563, 32, 'brands-create', 0),
(564, 32, 'brands-update', 0),
(565, 32, 'brands-view', 0),
(566, 32, 'brands-delete', 0),
(567, 32, 'vital', 0),
(568, 32, 'vital-create', 0),
(569, 32, 'vital-update', 0),
(570, 32, 'vital-view', 0),
(571, 32, 'vital-delete', 0),
(572, 32, 'transaction', 0),
(573, 32, 'transaction-create', 0),
(574, 32, 'transaction-update', 0),
(575, 32, 'transaction-view', 0),
(576, 32, 'settings', 0),
(577, 32, 'reports', 0),
(578, 32, 'access-log', 0),
(579, 32, 'acl', 0),
(580, 32, 'crete-lab-result', 1),
(581, 24, 'home', 1),
(582, 24, 'profile', 1),
(583, 24, 'employee', 0),
(584, 24, 'employee-create', 0),
(585, 24, 'employee-update', 0),
(586, 24, 'employee-view', 0),
(587, 24, 'employee-delete', 0),
(588, 24, 'patients', 0),
(589, 24, 'patients-create', 0),
(590, 24, 'patients-update', 0),
(591, 24, 'patients-view', 0),
(592, 24, 'patients-delete', 0),
(593, 24, 'patients-disease-create', 0),
(594, 24, 'patients-disease-delete', 0),
(595, 24, 'department', 0),
(596, 24, 'department-create', 0),
(597, 24, 'department-update', 0),
(598, 24, 'department-view', 0),
(599, 24, 'department-delete', 0),
(600, 24, 'company', 0),
(601, 24, 'company-create', 0),
(602, 24, 'company-update', 0),
(603, 24, 'company-view', 0),
(604, 24, 'company-lab', 0),
(605, 24, 'company-delete', 0),
(606, 24, 'tests', 0),
(607, 24, 'tests-create', 0),
(608, 24, 'tests-update', 0),
(609, 24, 'tests-view', 0),
(610, 24, 'tests-delete', 0),
(611, 24, 'testcategory', 0),
(612, 24, 'testcategory-create', 0),
(613, 24, 'testcategory-update', 0),
(614, 24, 'testcategory-view', 0),
(615, 24, 'testcategory-delete', 0),
(616, 24, 'materials', 0),
(617, 24, 'materials-create', 0),
(618, 24, 'materials-update', 0),
(619, 24, 'materials-view', 0),
(620, 24, 'materials-delete', 0),
(621, 24, 'process', 0),
(622, 24, 'saveresult', 0),
(623, 24, 'patient', 0),
(624, 24, 'patient-create', 0),
(625, 24, 'patient-update', 0),
(626, 24, 'patient-view', 0),
(627, 24, 'patient-delete', 0),
(628, 24, 'transactions', 0),
(629, 24, 'transactions-create', 0),
(630, 24, 'transactions-update', 0),
(631, 24, 'transactions-view', 0),
(632, 24, 'transactions-delete', 0),
(633, 24, 'consultation', 0),
(634, 24, 'consult', 0),
(635, 24, 'patient-test', 0),
(636, 24, 'process-test', 0),
(637, 24, 'result-create', 0),
(638, 24, 'patient-result', 0),
(639, 24, 'result-update', 0),
(640, 24, 'access-controls', 0),
(641, 24, 'medicines', 0),
(642, 24, 'medicines-create', 0),
(643, 24, 'medicines-update', 0),
(644, 24, 'medicines-view', 0),
(645, 24, 'medicines-delete', 0),
(646, 24, 'diseases', 0),
(647, 24, 'diseases-create', 0),
(648, 24, 'diseases-update', 0),
(649, 24, 'diseases-view', 0),
(650, 24, 'diseases-delete', 0),
(651, 24, 'suppliers', 0),
(652, 24, 'suppliers-create', 0),
(653, 24, 'suppliers-update', 0),
(654, 24, 'suppliers-view', 0),
(655, 24, 'suppliers-delete', 0),
(656, 24, 'po', 0),
(657, 24, 'po-create', 0),
(658, 24, 'po-update', 0),
(659, 24, 'po-view', 0),
(660, 24, 'po-delete', 0),
(661, 24, 'po-approve', 0),
(662, 24, 'po-receive', 0),
(663, 24, 'po-order', 0),
(664, 24, 'symptoms', 0),
(665, 24, 'symptoms-create', 0),
(666, 24, 'symptoms-update', 0),
(667, 24, 'symptoms-view', 0),
(668, 24, 'symptoms-delete', 0),
(669, 24, 'operations', 0),
(670, 24, 'operations-create', 0),
(671, 24, 'operations-update', 0),
(672, 24, 'operations-view', 0),
(673, 24, 'operations-delete', 0),
(674, 24, 'prescription', 0),
(675, 24, 'prescription-create', 0),
(676, 24, 'prescription-update', 0),
(677, 24, 'prescription-view', 0),
(678, 24, 'prescription-delete', 0),
(679, 24, 'brands', 0),
(680, 24, 'brands-create', 0),
(681, 24, 'brands-update', 0),
(682, 24, 'brands-view', 0),
(683, 24, 'brands-delete', 0),
(684, 24, 'vital', 0),
(685, 24, 'vital-create', 0),
(686, 24, 'vital-update', 0),
(687, 24, 'vital-view', 0),
(688, 24, 'vital-delete', 0),
(689, 24, 'transaction', 0),
(690, 24, 'transaction-create', 0),
(691, 24, 'transaction-update', 0),
(692, 24, 'transaction-view', 0),
(693, 24, 'settings', 0),
(694, 24, 'reports', 0),
(695, 24, 'access-log', 0),
(696, 24, 'acl', 0),
(697, 24, 'crete-lab-result', 0),
(698, 29, 'home', 1),
(699, 29, 'profile', 1),
(700, 29, 'employee', 0),
(701, 29, 'employee-create', 0),
(702, 29, 'employee-update', 0),
(703, 29, 'employee-view', 0),
(704, 29, 'employee-delete', 0),
(705, 29, 'patients', 0),
(706, 29, 'patients-create', 0),
(707, 29, 'patients-update', 0),
(708, 29, 'patients-view', 0),
(709, 29, 'patients-delete', 0),
(710, 29, 'patients-disease-create', 0),
(711, 29, 'patients-disease-delete', 0),
(712, 29, 'department', 0),
(713, 29, 'department-create', 0),
(714, 29, 'department-update', 0),
(715, 29, 'department-view', 0),
(716, 29, 'department-delete', 0),
(717, 29, 'company', 0),
(718, 29, 'company-create', 0),
(719, 29, 'company-update', 0),
(720, 29, 'company-view', 0),
(721, 29, 'company-lab', 0),
(722, 29, 'company-delete', 0),
(723, 29, 'tests', 0),
(724, 29, 'tests-create', 0),
(725, 29, 'tests-update', 0),
(726, 29, 'tests-view', 0),
(727, 29, 'tests-delete', 0),
(728, 29, 'testcategory', 0),
(729, 29, 'testcategory-create', 0),
(730, 29, 'testcategory-update', 0),
(731, 29, 'testcategory-view', 0),
(732, 29, 'testcategory-delete', 0),
(733, 29, 'materials', 0),
(734, 29, 'materials-create', 0),
(735, 29, 'materials-update', 0),
(736, 29, 'materials-view', 0),
(737, 29, 'materials-delete', 0),
(738, 29, 'process', 0),
(739, 29, 'saveresult', 0),
(740, 29, 'patient', 0),
(741, 29, 'patient-create', 0),
(742, 29, 'patient-update', 0),
(743, 29, 'patient-view', 0),
(744, 29, 'patient-delete', 0),
(745, 29, 'transactions', 0),
(746, 29, 'transactions-create', 0),
(747, 29, 'transactions-update', 0),
(748, 29, 'transactions-view', 0),
(749, 29, 'transactions-delete', 0),
(750, 29, 'consultation', 0),
(751, 29, 'consult', 0),
(752, 29, 'patient-test', 0),
(753, 29, 'process-test', 0),
(754, 29, 'result-create', 0),
(755, 29, 'patient-result', 0),
(756, 29, 'result-update', 0),
(757, 29, 'access-controls', 0),
(758, 29, 'medicines', 0),
(759, 29, 'medicines-create', 0),
(760, 29, 'medicines-update', 0),
(761, 29, 'medicines-view', 0),
(762, 29, 'medicines-delete', 0),
(763, 29, 'diseases', 0),
(764, 29, 'diseases-create', 0),
(765, 29, 'diseases-update', 0),
(766, 29, 'diseases-view', 0),
(767, 29, 'diseases-delete', 0),
(768, 29, 'suppliers', 0),
(769, 29, 'suppliers-create', 0),
(770, 29, 'suppliers-update', 0),
(771, 29, 'suppliers-view', 0),
(772, 29, 'suppliers-delete', 0),
(773, 29, 'po', 0),
(774, 29, 'po-create', 0),
(775, 29, 'po-update', 0),
(776, 29, 'po-view', 0),
(777, 29, 'po-delete', 0),
(778, 29, 'po-approve', 0),
(779, 29, 'po-receive', 0),
(780, 29, 'po-order', 0),
(781, 29, 'symptoms', 0),
(782, 29, 'symptoms-create', 0),
(783, 29, 'symptoms-update', 0),
(784, 29, 'symptoms-view', 0),
(785, 29, 'symptoms-delete', 0),
(786, 29, 'operations', 0),
(787, 29, 'operations-create', 0),
(788, 29, 'operations-update', 0),
(789, 29, 'operations-view', 0),
(790, 29, 'operations-delete', 0),
(791, 29, 'prescription', 0),
(792, 29, 'prescription-create', 0),
(793, 29, 'prescription-update', 0),
(794, 29, 'prescription-view', 0),
(795, 29, 'prescription-delete', 0),
(796, 29, 'brands', 0),
(797, 29, 'brands-create', 0),
(798, 29, 'brands-update', 0),
(799, 29, 'brands-view', 0),
(800, 29, 'brands-delete', 0),
(801, 29, 'vital', 0),
(802, 29, 'vital-create', 0),
(803, 29, 'vital-update', 0),
(804, 29, 'vital-view', 0),
(805, 29, 'vital-delete', 0),
(806, 29, 'transaction', 0),
(807, 29, 'transaction-create', 0),
(808, 29, 'transaction-update', 0),
(809, 29, 'transaction-view', 0),
(810, 29, 'settings', 0),
(811, 29, 'reports', 0),
(812, 29, 'access-log', 0),
(813, 29, 'acl', 0),
(814, 29, 'crete-lab-result', 0),
(815, 28, 'home', 1),
(816, 28, 'profile', 1),
(817, 28, 'employee', 0),
(818, 28, 'employee-create', 0),
(819, 28, 'employee-update', 0),
(820, 28, 'employee-view', 0),
(821, 28, 'employee-delete', 0),
(822, 28, 'patients', 0),
(823, 28, 'patients-create', 0),
(824, 28, 'patients-update', 0),
(825, 28, 'patients-view', 0),
(826, 28, 'patients-delete', 0),
(827, 28, 'patients-disease-create', 0),
(828, 28, 'patients-disease-delete', 0),
(829, 28, 'department', 0),
(830, 28, 'department-create', 0),
(831, 28, 'department-update', 0),
(832, 28, 'department-view', 0),
(833, 28, 'department-delete', 0),
(834, 28, 'company', 0),
(835, 28, 'company-create', 0),
(836, 28, 'company-update', 0),
(837, 28, 'company-view', 0),
(838, 28, 'company-lab', 0),
(839, 28, 'company-delete', 0),
(840, 28, 'tests', 0),
(841, 28, 'tests-create', 0),
(842, 28, 'tests-update', 0),
(843, 28, 'tests-view', 0),
(844, 28, 'tests-delete', 0),
(845, 28, 'testcategory', 0),
(846, 28, 'testcategory-create', 0),
(847, 28, 'testcategory-update', 0),
(848, 28, 'testcategory-view', 0),
(849, 28, 'testcategory-delete', 0),
(850, 28, 'materials', 0),
(851, 28, 'materials-create', 0),
(852, 28, 'materials-update', 0),
(853, 28, 'materials-view', 0),
(854, 28, 'materials-delete', 0),
(855, 28, 'process', 0),
(856, 28, 'saveresult', 0),
(857, 28, 'patient', 0),
(858, 28, 'patient-create', 0),
(859, 28, 'patient-update', 0),
(860, 28, 'patient-view', 0),
(861, 28, 'patient-delete', 0),
(862, 28, 'transactions', 0),
(863, 28, 'transactions-create', 0),
(864, 28, 'transactions-update', 0),
(865, 28, 'transactions-view', 0),
(866, 28, 'transactions-delete', 0),
(867, 28, 'consultation', 0),
(868, 28, 'consult', 0),
(869, 28, 'patient-test', 0),
(870, 28, 'process-test', 0),
(871, 28, 'result-create', 0),
(872, 28, 'patient-result', 0),
(873, 28, 'result-update', 0),
(874, 28, 'access-controls', 0),
(875, 28, 'medicines', 0),
(876, 28, 'medicines-create', 0),
(877, 28, 'medicines-update', 0),
(878, 28, 'medicines-view', 0),
(879, 28, 'medicines-delete', 0),
(880, 28, 'diseases', 0),
(881, 28, 'diseases-create', 0),
(882, 28, 'diseases-update', 0),
(883, 28, 'diseases-view', 0),
(884, 28, 'diseases-delete', 0),
(885, 28, 'suppliers', 0),
(886, 28, 'suppliers-create', 0),
(887, 28, 'suppliers-update', 0),
(888, 28, 'suppliers-view', 0),
(889, 28, 'suppliers-delete', 0),
(890, 28, 'po', 0),
(891, 28, 'po-create', 0),
(892, 28, 'po-update', 0),
(893, 28, 'po-view', 0),
(894, 28, 'po-delete', 0),
(895, 28, 'po-approve', 0),
(896, 28, 'po-receive', 0),
(897, 28, 'po-order', 0),
(898, 28, 'symptoms', 0),
(899, 28, 'symptoms-create', 0),
(900, 28, 'symptoms-update', 0),
(901, 28, 'symptoms-view', 0),
(902, 28, 'symptoms-delete', 0),
(903, 28, 'operations', 0),
(904, 28, 'operations-create', 0),
(905, 28, 'operations-update', 0),
(906, 28, 'operations-view', 0),
(907, 28, 'operations-delete', 0),
(908, 28, 'prescription', 0),
(909, 28, 'prescription-create', 0),
(910, 28, 'prescription-update', 0),
(911, 28, 'prescription-view', 0),
(912, 28, 'prescription-delete', 0),
(913, 28, 'brands', 0),
(914, 28, 'brands-create', 0),
(915, 28, 'brands-update', 0),
(916, 28, 'brands-view', 0),
(917, 28, 'brands-delete', 0),
(918, 28, 'vital', 0),
(919, 28, 'vital-create', 0),
(920, 28, 'vital-update', 0),
(921, 28, 'vital-view', 0),
(922, 28, 'vital-delete', 0),
(923, 28, 'transaction', 0),
(924, 28, 'transaction-create', 0),
(925, 28, 'transaction-update', 0),
(926, 28, 'transaction-view', 0),
(927, 28, 'settings', 0),
(928, 28, 'reports', 0),
(929, 28, 'access-log', 0),
(930, 28, 'acl', 0),
(931, 28, 'crete-lab-result', 0),
(932, 27, 'home', 1),
(933, 27, 'profile', 1),
(934, 27, 'employee', 0),
(935, 27, 'employee-create', 0),
(936, 27, 'employee-update', 0),
(937, 27, 'employee-view', 0),
(938, 27, 'employee-delete', 0),
(939, 27, 'patients', 0),
(940, 27, 'patients-create', 0),
(941, 27, 'patients-update', 0),
(942, 27, 'patients-view', 0),
(943, 27, 'patients-delete', 0),
(944, 27, 'patients-disease-create', 0),
(945, 27, 'patients-disease-delete', 0),
(946, 27, 'department', 0),
(947, 27, 'department-create', 0),
(948, 27, 'department-update', 0),
(949, 27, 'department-view', 0),
(950, 27, 'department-delete', 0),
(951, 27, 'company', 0),
(952, 27, 'company-create', 0),
(953, 27, 'company-update', 0),
(954, 27, 'company-view', 0),
(955, 27, 'company-lab', 0),
(956, 27, 'company-delete', 0),
(957, 27, 'tests', 0),
(958, 27, 'tests-create', 0),
(959, 27, 'tests-update', 0),
(960, 27, 'tests-view', 0),
(961, 27, 'tests-delete', 0),
(962, 27, 'testcategory', 0),
(963, 27, 'testcategory-create', 0),
(964, 27, 'testcategory-update', 0),
(965, 27, 'testcategory-view', 0),
(966, 27, 'testcategory-delete', 0),
(967, 27, 'materials', 0),
(968, 27, 'materials-create', 0),
(969, 27, 'materials-update', 0),
(970, 27, 'materials-view', 0),
(971, 27, 'materials-delete', 0),
(972, 27, 'process', 0),
(973, 27, 'saveresult', 0),
(974, 27, 'patient', 0),
(975, 27, 'patient-create', 0),
(976, 27, 'patient-update', 0),
(977, 27, 'patient-view', 0),
(978, 27, 'patient-delete', 0),
(979, 27, 'transactions', 0),
(980, 27, 'transactions-create', 0),
(981, 27, 'transactions-update', 0),
(982, 27, 'transactions-view', 0),
(983, 27, 'transactions-delete', 0),
(984, 27, 'consultation', 0),
(985, 27, 'consult', 0),
(986, 27, 'patient-test', 0),
(987, 27, 'process-test', 0),
(988, 27, 'result-create', 0),
(989, 27, 'patient-result', 0),
(990, 27, 'result-update', 0),
(991, 27, 'access-controls', 0),
(992, 27, 'medicines', 0),
(993, 27, 'medicines-create', 0),
(994, 27, 'medicines-update', 0),
(995, 27, 'medicines-view', 0),
(996, 27, 'medicines-delete', 0),
(997, 27, 'diseases', 0),
(998, 27, 'diseases-create', 0),
(999, 27, 'diseases-update', 0),
(1000, 27, 'diseases-view', 0),
(1001, 27, 'diseases-delete', 0),
(1002, 27, 'suppliers', 0),
(1003, 27, 'suppliers-create', 0),
(1004, 27, 'suppliers-update', 0),
(1005, 27, 'suppliers-view', 0),
(1006, 27, 'suppliers-delete', 0),
(1007, 27, 'po', 0),
(1008, 27, 'po-create', 0),
(1009, 27, 'po-update', 0),
(1010, 27, 'po-view', 0),
(1011, 27, 'po-delete', 0),
(1012, 27, 'po-approve', 0),
(1013, 27, 'po-receive', 0),
(1014, 27, 'po-order', 0),
(1015, 27, 'symptoms', 0),
(1016, 27, 'symptoms-create', 0),
(1017, 27, 'symptoms-update', 0),
(1018, 27, 'symptoms-view', 0),
(1019, 27, 'symptoms-delete', 0),
(1020, 27, 'operations', 0),
(1021, 27, 'operations-create', 0),
(1022, 27, 'operations-update', 0),
(1023, 27, 'operations-view', 0),
(1024, 27, 'operations-delete', 0),
(1025, 27, 'prescription', 0),
(1026, 27, 'prescription-create', 0),
(1027, 27, 'prescription-update', 0),
(1028, 27, 'prescription-view', 0),
(1029, 27, 'prescription-delete', 0),
(1030, 27, 'brands', 0),
(1031, 27, 'brands-create', 0),
(1032, 27, 'brands-update', 0),
(1033, 27, 'brands-view', 0),
(1034, 27, 'brands-delete', 0),
(1035, 27, 'vital', 0),
(1036, 27, 'vital-create', 0),
(1037, 27, 'vital-update', 0),
(1038, 27, 'vital-view', 0),
(1039, 27, 'vital-delete', 0),
(1040, 27, 'transaction', 0),
(1041, 27, 'transaction-create', 0),
(1042, 27, 'transaction-update', 0),
(1043, 27, 'transaction-view', 0),
(1044, 27, 'settings', 0),
(1045, 27, 'reports', 0),
(1046, 27, 'access-log', 0),
(1047, 27, 'acl', 0),
(1048, 27, 'crete-lab-result', 0),
(1049, 33, 'home', 1),
(1050, 33, 'profile', 1),
(1051, 33, 'employee', 0),
(1052, 33, 'employee-create', 0),
(1053, 33, 'employee-update', 0),
(1054, 33, 'employee-view', 0),
(1055, 33, 'employee-delete', 0),
(1056, 33, 'patients', 0),
(1057, 33, 'patients-create', 0),
(1058, 33, 'patients-update', 0),
(1059, 33, 'patients-view', 0),
(1060, 33, 'patients-delete', 0),
(1061, 33, 'patients-disease-create', 0),
(1062, 33, 'patients-disease-delete', 0),
(1063, 33, 'department', 0),
(1064, 33, 'department-create', 0),
(1065, 33, 'department-update', 0),
(1066, 33, 'department-view', 0),
(1067, 33, 'department-delete', 0),
(1068, 33, 'company', 0),
(1069, 33, 'company-create', 0),
(1070, 33, 'company-update', 0),
(1071, 33, 'company-view', 0),
(1072, 33, 'company-lab', 0),
(1073, 33, 'company-delete', 0),
(1074, 33, 'tests', 0),
(1075, 33, 'tests-create', 0),
(1076, 33, 'tests-update', 0),
(1077, 33, 'tests-view', 0),
(1078, 33, 'tests-delete', 0),
(1079, 33, 'testcategory', 0),
(1080, 33, 'testcategory-create', 0),
(1081, 33, 'testcategory-update', 0),
(1082, 33, 'testcategory-view', 0),
(1083, 33, 'testcategory-delete', 0),
(1084, 33, 'materials', 0),
(1085, 33, 'materials-create', 0),
(1086, 33, 'materials-update', 0),
(1087, 33, 'materials-view', 0),
(1088, 33, 'materials-delete', 0),
(1089, 33, 'process', 0),
(1090, 33, 'saveresult', 0),
(1091, 33, 'patient', 0),
(1092, 33, 'patient-create', 0),
(1093, 33, 'patient-update', 0),
(1094, 33, 'patient-view', 0),
(1095, 33, 'patient-delete', 0),
(1096, 33, 'transactions', 0),
(1097, 33, 'transactions-create', 0),
(1098, 33, 'transactions-update', 0),
(1099, 33, 'transactions-view', 0),
(1100, 33, 'transactions-delete', 0),
(1101, 33, 'consultation', 0),
(1102, 33, 'consult', 0),
(1103, 33, 'patient-test', 0),
(1104, 33, 'process-test', 0),
(1105, 33, 'result-create', 0),
(1106, 33, 'patient-result', 0),
(1107, 33, 'result-update', 0),
(1108, 33, 'access-controls', 0),
(1109, 33, 'medicines', 0),
(1110, 33, 'medicines-create', 0),
(1111, 33, 'medicines-update', 0),
(1112, 33, 'medicines-view', 0),
(1113, 33, 'medicines-delete', 0),
(1114, 33, 'diseases', 0),
(1115, 33, 'diseases-create', 0),
(1116, 33, 'diseases-update', 0),
(1117, 33, 'diseases-view', 0),
(1118, 33, 'diseases-delete', 0),
(1119, 33, 'suppliers', 0),
(1120, 33, 'suppliers-create', 0),
(1121, 33, 'suppliers-update', 0),
(1122, 33, 'suppliers-view', 0),
(1123, 33, 'suppliers-delete', 0),
(1124, 33, 'po', 0),
(1125, 33, 'po-create', 0),
(1126, 33, 'po-update', 0),
(1127, 33, 'po-view', 0),
(1128, 33, 'po-delete', 0),
(1129, 33, 'po-approve', 0),
(1130, 33, 'po-receive', 0),
(1131, 33, 'po-order', 0),
(1132, 33, 'symptoms', 0),
(1133, 33, 'symptoms-create', 0),
(1134, 33, 'symptoms-update', 0),
(1135, 33, 'symptoms-view', 0),
(1136, 33, 'symptoms-delete', 0),
(1137, 33, 'operations', 0),
(1138, 33, 'operations-create', 0),
(1139, 33, 'operations-update', 0),
(1140, 33, 'operations-view', 0),
(1141, 33, 'operations-delete', 0),
(1142, 33, 'prescription', 0),
(1143, 33, 'prescription-create', 0),
(1144, 33, 'prescription-update', 0),
(1145, 33, 'prescription-view', 0),
(1146, 33, 'prescription-delete', 0),
(1147, 33, 'brands', 0),
(1148, 33, 'brands-create', 0),
(1149, 33, 'brands-update', 0),
(1150, 33, 'brands-view', 0),
(1151, 33, 'brands-delete', 0),
(1152, 33, 'vital', 0),
(1153, 33, 'vital-create', 0),
(1154, 33, 'vital-update', 0),
(1155, 33, 'vital-view', 0),
(1156, 33, 'vital-delete', 0),
(1157, 33, 'transaction', 0),
(1158, 33, 'transaction-create', 0),
(1159, 33, 'transaction-update', 0),
(1160, 33, 'transaction-view', 0),
(1161, 33, 'settings', 0),
(1162, 33, 'reports', 0),
(1163, 33, 'access-log', 0),
(1164, 33, 'acl', 0),
(1165, 33, 'crete-lab-result', 0),
(1166, 36, 'home', 1),
(1167, 36, 'profile', 1),
(1168, 36, 'employee', 0),
(1169, 36, 'employee-create', 0),
(1170, 36, 'employee-update', 0),
(1171, 36, 'employee-view', 0),
(1172, 36, 'employee-delete', 0),
(1173, 36, 'patients', 0),
(1174, 36, 'patients-create', 0),
(1175, 36, 'patients-update', 0),
(1176, 36, 'patients-view', 0),
(1177, 36, 'patients-delete', 0),
(1178, 36, 'patients-disease-create', 0),
(1179, 36, 'patients-disease-delete', 0),
(1180, 36, 'department', 0),
(1181, 36, 'department-create', 0),
(1182, 36, 'department-update', 0),
(1183, 36, 'department-view', 0),
(1184, 36, 'department-delete', 0),
(1185, 36, 'company', 0),
(1186, 36, 'company-create', 0),
(1187, 36, 'company-update', 0),
(1188, 36, 'company-view', 0),
(1189, 36, 'company-lab', 0),
(1190, 36, 'company-delete', 0),
(1191, 36, 'tests', 0),
(1192, 36, 'tests-create', 0),
(1193, 36, 'tests-update', 0),
(1194, 36, 'tests-view', 0),
(1195, 36, 'tests-delete', 0),
(1196, 36, 'testcategory', 0),
(1197, 36, 'testcategory-create', 0),
(1198, 36, 'testcategory-update', 0),
(1199, 36, 'testcategory-view', 0),
(1200, 36, 'testcategory-delete', 0),
(1201, 36, 'materials', 0),
(1202, 36, 'materials-create', 0),
(1203, 36, 'materials-update', 0),
(1204, 36, 'materials-view', 0),
(1205, 36, 'materials-delete', 0),
(1206, 36, 'process', 0),
(1207, 36, 'saveresult', 0),
(1208, 36, 'patient', 0),
(1209, 36, 'patient-create', 0),
(1210, 36, 'patient-update', 0),
(1211, 36, 'patient-view', 0),
(1212, 36, 'patient-delete', 0),
(1213, 36, 'transactions', 0),
(1214, 36, 'transactions-create', 0),
(1215, 36, 'transactions-update', 0),
(1216, 36, 'transactions-view', 0),
(1217, 36, 'transactions-delete', 0),
(1218, 36, 'consultation', 0),
(1219, 36, 'consult', 0),
(1220, 36, 'patient-test', 0),
(1221, 36, 'process-test', 0),
(1222, 36, 'result-create', 0),
(1223, 36, 'patient-result', 0),
(1224, 36, 'result-update', 0),
(1225, 36, 'access-controls', 0),
(1226, 36, 'medicines', 0),
(1227, 36, 'medicines-create', 0),
(1228, 36, 'medicines-update', 0),
(1229, 36, 'medicines-view', 0),
(1230, 36, 'medicines-delete', 0),
(1231, 36, 'diseases', 0),
(1232, 36, 'diseases-create', 0),
(1233, 36, 'diseases-update', 0),
(1234, 36, 'diseases-view', 0),
(1235, 36, 'diseases-delete', 0),
(1236, 36, 'suppliers', 0),
(1237, 36, 'suppliers-create', 0),
(1238, 36, 'suppliers-update', 0),
(1239, 36, 'suppliers-view', 0),
(1240, 36, 'suppliers-delete', 0),
(1241, 36, 'po', 0),
(1242, 36, 'po-create', 0),
(1243, 36, 'po-update', 0),
(1244, 36, 'po-view', 0),
(1245, 36, 'po-delete', 0),
(1246, 36, 'po-approve', 0),
(1247, 36, 'po-receive', 0),
(1248, 36, 'po-order', 0),
(1249, 36, 'symptoms', 0),
(1250, 36, 'symptoms-create', 0),
(1251, 36, 'symptoms-update', 0),
(1252, 36, 'symptoms-view', 0),
(1253, 36, 'symptoms-delete', 0),
(1254, 36, 'operations', 0),
(1255, 36, 'operations-create', 0),
(1256, 36, 'operations-update', 0),
(1257, 36, 'operations-view', 0),
(1258, 36, 'operations-delete', 0),
(1259, 36, 'prescription', 0),
(1260, 36, 'prescription-create', 0),
(1261, 36, 'prescription-update', 0),
(1262, 36, 'prescription-view', 0),
(1263, 36, 'prescription-delete', 0),
(1264, 36, 'brands', 0),
(1265, 36, 'brands-create', 0),
(1266, 36, 'brands-update', 0),
(1267, 36, 'brands-view', 0),
(1268, 36, 'brands-delete', 0),
(1269, 36, 'vital', 0),
(1270, 36, 'vital-create', 0),
(1271, 36, 'vital-update', 0),
(1272, 36, 'vital-view', 0),
(1273, 36, 'vital-delete', 0),
(1274, 36, 'transaction', 0),
(1275, 36, 'transaction-create', 0),
(1276, 36, 'transaction-update', 0),
(1277, 36, 'transaction-view', 0),
(1278, 36, 'settings', 0),
(1279, 36, 'reports', 0),
(1280, 36, 'access-log', 0),
(1281, 36, 'acl', 0),
(1282, 36, 'crete-lab-result', 0),
(1283, 25, 'home', 1),
(1284, 25, 'profile', 1),
(1285, 25, 'employee', 1),
(1286, 25, 'employee-create', 0),
(1287, 25, 'employee-update', 0),
(1288, 25, 'employee-view', 0),
(1289, 25, 'employee-delete', 0),
(1290, 25, 'patients', 1),
(1291, 25, 'patients-create', 0),
(1292, 25, 'patients-update', 1),
(1293, 25, 'patients-view', 1),
(1294, 25, 'patients-delete', 0),
(1295, 25, 'patients-disease-create', 1),
(1296, 25, 'patients-disease-delete', 0),
(1297, 25, 'department', 0),
(1298, 25, 'department-create', 0),
(1299, 25, 'department-update', 0),
(1300, 25, 'department-view', 0),
(1301, 25, 'department-delete', 0),
(1302, 25, 'company', 1),
(1303, 25, 'company-create', 0),
(1304, 25, 'company-update', 0),
(1305, 25, 'company-view', 1),
(1306, 25, 'company-lab', 1),
(1307, 25, 'company-delete', 0),
(1308, 25, 'tests', 1),
(1309, 25, 'tests-create', 0),
(1310, 25, 'tests-update', 0),
(1311, 25, 'tests-view', 1),
(1312, 25, 'tests-delete', 0),
(1313, 25, 'testcategory', 0),
(1314, 25, 'testcategory-create', 0),
(1315, 25, 'testcategory-update', 0),
(1316, 25, 'testcategory-view', 0),
(1317, 25, 'testcategory-delete', 0),
(1318, 25, 'materials', 0),
(1319, 25, 'materials-create', 0),
(1320, 25, 'materials-update', 0),
(1321, 25, 'materials-view', 0),
(1322, 25, 'materials-delete', 0),
(1323, 25, 'process', 1),
(1324, 25, 'saveresult', 0),
(1325, 25, 'patient', 1),
(1326, 25, 'patient-create', 0),
(1327, 25, 'patient-update', 1),
(1328, 25, 'patient-view', 1),
(1329, 25, 'patient-delete', 0),
(1330, 25, 'transactions', 1),
(1331, 25, 'transactions-create', 1),
(1332, 25, 'transactions-update', 0),
(1333, 25, 'transactions-view', 0),
(1334, 25, 'transactions-delete', 0),
(1335, 25, 'consultation', 0),
(1336, 25, 'consult', 0),
(1337, 25, 'patient-test', 1),
(1338, 25, 'process-test', 1),
(1339, 25, 'result-create', 0),
(1340, 25, 'patient-result', 1),
(1341, 25, 'result-update', 0),
(1342, 25, 'access-controls', 0),
(1343, 25, 'medicines', 0),
(1344, 25, 'medicines-create', 0),
(1345, 25, 'medicines-update', 0),
(1346, 25, 'medicines-view', 0),
(1347, 25, 'medicines-delete', 0),
(1348, 25, 'diseases', 0),
(1349, 25, 'diseases-create', 0),
(1350, 25, 'diseases-update', 0),
(1351, 25, 'diseases-view', 0),
(1352, 25, 'diseases-delete', 0),
(1353, 25, 'suppliers', 0),
(1354, 25, 'suppliers-create', 0),
(1355, 25, 'suppliers-update', 0),
(1356, 25, 'suppliers-view', 0),
(1357, 25, 'suppliers-delete', 0),
(1358, 25, 'po', 1),
(1359, 25, 'po-create', 1),
(1360, 25, 'po-update', 0),
(1361, 25, 'po-view', 1),
(1362, 25, 'po-delete', 0),
(1363, 25, 'po-approve', 1),
(1364, 25, 'po-receive', 1),
(1365, 25, 'po-order', 1),
(1366, 25, 'symptoms', 0),
(1367, 25, 'symptoms-create', 0),
(1368, 25, 'symptoms-update', 0),
(1369, 25, 'symptoms-view', 0),
(1370, 25, 'symptoms-delete', 0),
(1371, 25, 'operations', 1),
(1372, 25, 'operations-create', 0),
(1373, 25, 'operations-update', 0),
(1374, 25, 'operations-view', 1),
(1375, 25, 'operations-delete', 0),
(1376, 25, 'prescription', 0),
(1377, 25, 'prescription-create', 0),
(1378, 25, 'prescription-update', 0),
(1379, 25, 'prescription-view', 0),
(1380, 25, 'prescription-delete', 0),
(1381, 25, 'brands', 0),
(1382, 25, 'brands-create', 0),
(1383, 25, 'brands-update', 0),
(1384, 25, 'brands-view', 0),
(1385, 25, 'brands-delete', 0),
(1386, 25, 'vital', 0),
(1387, 25, 'vital-create', 0),
(1388, 25, 'vital-update', 0),
(1389, 25, 'vital-view', 0),
(1390, 25, 'vital-delete', 0),
(1391, 25, 'transaction', 1),
(1392, 25, 'transaction-create', 1),
(1393, 25, 'transaction-update', 1),
(1394, 25, 'transaction-view', 1),
(1395, 25, 'settings', 0),
(1396, 25, 'reports', 1),
(1397, 25, 'access-log', 0),
(1398, 25, 'acl', 0),
(1399, 25, 'crete-lab-result', 0),
(1400, 35, 'home', 1),
(1401, 35, 'profile', 1),
(1402, 35, 'employee', 0),
(1403, 35, 'employee-create', 0),
(1404, 35, 'employee-update', 0),
(1405, 35, 'employee-view', 0),
(1406, 35, 'employee-delete', 0),
(1407, 35, 'patients', 0),
(1408, 35, 'patients-create', 0),
(1409, 35, 'patients-update', 0),
(1410, 35, 'patients-view', 0),
(1411, 35, 'patients-delete', 0),
(1412, 35, 'patients-disease-create', 0),
(1413, 35, 'patients-disease-delete', 0),
(1414, 35, 'department', 0),
(1415, 35, 'department-create', 0),
(1416, 35, 'department-update', 0),
(1417, 35, 'department-view', 0),
(1418, 35, 'department-delete', 0),
(1419, 35, 'company', 0),
(1420, 35, 'company-create', 0),
(1421, 35, 'company-update', 0),
(1422, 35, 'company-view', 0),
(1423, 35, 'company-lab', 0),
(1424, 35, 'company-delete', 0),
(1425, 35, 'tests', 0),
(1426, 35, 'tests-create', 0),
(1427, 35, 'tests-update', 0),
(1428, 35, 'tests-view', 0),
(1429, 35, 'tests-delete', 0),
(1430, 35, 'testcategory', 0),
(1431, 35, 'testcategory-create', 0),
(1432, 35, 'testcategory-update', 0),
(1433, 35, 'testcategory-view', 0),
(1434, 35, 'testcategory-delete', 0),
(1435, 35, 'materials', 0),
(1436, 35, 'materials-create', 0),
(1437, 35, 'materials-update', 0),
(1438, 35, 'materials-view', 0),
(1439, 35, 'materials-delete', 0),
(1440, 35, 'process', 0),
(1441, 35, 'saveresult', 0),
(1442, 35, 'patient', 0),
(1443, 35, 'patient-create', 0),
(1444, 35, 'patient-update', 0),
(1445, 35, 'patient-view', 0),
(1446, 35, 'patient-delete', 0),
(1447, 35, 'transactions', 0),
(1448, 35, 'transactions-create', 0),
(1449, 35, 'transactions-update', 0),
(1450, 35, 'transactions-view', 0),
(1451, 35, 'transactions-delete', 0),
(1452, 35, 'consultation', 0),
(1453, 35, 'consult', 0),
(1454, 35, 'patient-test', 0),
(1455, 35, 'process-test', 0),
(1456, 35, 'result-create', 0),
(1457, 35, 'patient-result', 0),
(1458, 35, 'result-update', 0),
(1459, 35, 'access-controls', 0),
(1460, 35, 'medicines', 0),
(1461, 35, 'medicines-create', 0),
(1462, 35, 'medicines-update', 0),
(1463, 35, 'medicines-view', 0),
(1464, 35, 'medicines-delete', 0),
(1465, 35, 'diseases', 0),
(1466, 35, 'diseases-create', 0),
(1467, 35, 'diseases-update', 0),
(1468, 35, 'diseases-view', 0),
(1469, 35, 'diseases-delete', 0),
(1470, 35, 'suppliers', 0),
(1471, 35, 'suppliers-create', 0),
(1472, 35, 'suppliers-update', 0),
(1473, 35, 'suppliers-view', 0),
(1474, 35, 'suppliers-delete', 0),
(1475, 35, 'po', 0),
(1476, 35, 'po-create', 0),
(1477, 35, 'po-update', 0),
(1478, 35, 'po-view', 0),
(1479, 35, 'po-delete', 0),
(1480, 35, 'po-approve', 0),
(1481, 35, 'po-receive', 0),
(1482, 35, 'po-order', 0),
(1483, 35, 'symptoms', 0),
(1484, 35, 'symptoms-create', 0),
(1485, 35, 'symptoms-update', 0),
(1486, 35, 'symptoms-view', 0),
(1487, 35, 'symptoms-delete', 0),
(1488, 35, 'operations', 0),
(1489, 35, 'operations-create', 0),
(1490, 35, 'operations-update', 0),
(1491, 35, 'operations-view', 0),
(1492, 35, 'operations-delete', 0),
(1493, 35, 'prescription', 0),
(1494, 35, 'prescription-create', 0),
(1495, 35, 'prescription-update', 0),
(1496, 35, 'prescription-view', 0),
(1497, 35, 'prescription-delete', 0),
(1498, 35, 'brands', 0),
(1499, 35, 'brands-create', 0),
(1500, 35, 'brands-update', 0),
(1501, 35, 'brands-view', 0),
(1502, 35, 'brands-delete', 0),
(1503, 35, 'vital', 0),
(1504, 35, 'vital-create', 0),
(1505, 35, 'vital-update', 0),
(1506, 35, 'vital-view', 0),
(1507, 35, 'vital-delete', 0),
(1508, 35, 'transaction', 0),
(1509, 35, 'transaction-create', 0),
(1510, 35, 'transaction-update', 0),
(1511, 35, 'transaction-view', 0),
(1512, 35, 'settings', 0),
(1513, 35, 'reports', 0),
(1514, 35, 'access-log', 0),
(1515, 35, 'acl', 0),
(1516, 35, 'crete-lab-result', 0),
(1517, 34, 'home', 1),
(1518, 34, 'profile', 1),
(1519, 34, 'employee', 0),
(1520, 34, 'employee-create', 0),
(1521, 34, 'employee-update', 0),
(1522, 34, 'employee-view', 0),
(1523, 34, 'employee-delete', 0),
(1524, 34, 'patients', 0),
(1525, 34, 'patients-create', 0),
(1526, 34, 'patients-update', 0),
(1527, 34, 'patients-view', 0),
(1528, 34, 'patients-delete', 0),
(1529, 34, 'patients-disease-create', 0),
(1530, 34, 'patients-disease-delete', 0),
(1531, 34, 'department', 0),
(1532, 34, 'department-create', 0),
(1533, 34, 'department-update', 0),
(1534, 34, 'department-view', 0),
(1535, 34, 'department-delete', 0),
(1536, 34, 'company', 0),
(1537, 34, 'company-create', 0),
(1538, 34, 'company-update', 0),
(1539, 34, 'company-view', 0),
(1540, 34, 'company-lab', 0),
(1541, 34, 'company-delete', 0),
(1542, 34, 'tests', 0),
(1543, 34, 'tests-create', 0),
(1544, 34, 'tests-update', 0),
(1545, 34, 'tests-view', 0),
(1546, 34, 'tests-delete', 0),
(1547, 34, 'testcategory', 0),
(1548, 34, 'testcategory-create', 0),
(1549, 34, 'testcategory-update', 0),
(1550, 34, 'testcategory-view', 0),
(1551, 34, 'testcategory-delete', 0),
(1552, 34, 'materials', 0),
(1553, 34, 'materials-create', 0),
(1554, 34, 'materials-update', 0),
(1555, 34, 'materials-view', 0),
(1556, 34, 'materials-delete', 0),
(1557, 34, 'process', 0),
(1558, 34, 'saveresult', 0),
(1559, 34, 'patient', 0),
(1560, 34, 'patient-create', 0),
(1561, 34, 'patient-update', 0),
(1562, 34, 'patient-view', 0),
(1563, 34, 'patient-delete', 0),
(1564, 34, 'transactions', 0),
(1565, 34, 'transactions-create', 0),
(1566, 34, 'transactions-update', 0),
(1567, 34, 'transactions-view', 0),
(1568, 34, 'transactions-delete', 0),
(1569, 34, 'consultation', 0),
(1570, 34, 'consult', 0),
(1571, 34, 'patient-test', 0),
(1572, 34, 'process-test', 0),
(1573, 34, 'result-create', 0),
(1574, 34, 'patient-result', 0),
(1575, 34, 'result-update', 0),
(1576, 34, 'access-controls', 0),
(1577, 34, 'medicines', 0),
(1578, 34, 'medicines-create', 0),
(1579, 34, 'medicines-update', 0),
(1580, 34, 'medicines-view', 0),
(1581, 34, 'medicines-delete', 0),
(1582, 34, 'diseases', 0),
(1583, 34, 'diseases-create', 0),
(1584, 34, 'diseases-update', 0),
(1585, 34, 'diseases-view', 0),
(1586, 34, 'diseases-delete', 0),
(1587, 34, 'suppliers', 0),
(1588, 34, 'suppliers-create', 0),
(1589, 34, 'suppliers-update', 0),
(1590, 34, 'suppliers-view', 0),
(1591, 34, 'suppliers-delete', 0),
(1592, 34, 'po', 0),
(1593, 34, 'po-create', 0),
(1594, 34, 'po-update', 0),
(1595, 34, 'po-view', 0),
(1596, 34, 'po-delete', 0),
(1597, 34, 'po-approve', 0),
(1598, 34, 'po-receive', 0),
(1599, 34, 'po-order', 0),
(1600, 34, 'symptoms', 0),
(1601, 34, 'symptoms-create', 0),
(1602, 34, 'symptoms-update', 0),
(1603, 34, 'symptoms-view', 0),
(1604, 34, 'symptoms-delete', 0),
(1605, 34, 'operations', 0),
(1606, 34, 'operations-create', 0),
(1607, 34, 'operations-update', 0),
(1608, 34, 'operations-view', 0),
(1609, 34, 'operations-delete', 0),
(1610, 34, 'prescription', 0),
(1611, 34, 'prescription-create', 0),
(1612, 34, 'prescription-update', 0),
(1613, 34, 'prescription-view', 0),
(1614, 34, 'prescription-delete', 0),
(1615, 34, 'brands', 0),
(1616, 34, 'brands-create', 0),
(1617, 34, 'brands-update', 0),
(1618, 34, 'brands-view', 0),
(1619, 34, 'brands-delete', 0),
(1620, 34, 'vital', 0),
(1621, 34, 'vital-create', 0),
(1622, 34, 'vital-update', 0),
(1623, 34, 'vital-view', 0),
(1624, 34, 'vital-delete', 0),
(1625, 34, 'transaction', 0),
(1626, 34, 'transaction-create', 0),
(1627, 34, 'transaction-update', 0),
(1628, 34, 'transaction-view', 0),
(1629, 34, 'settings', 0),
(1630, 34, 'reports', 0),
(1631, 34, 'access-log', 0),
(1632, 34, 'acl', 0),
(1633, 34, 'crete-lab-result', 0),
(1634, 18, 'process-delete', 1),
(1635, 18, 'result-print', 1),
(1636, 18, 'result-view', 1),
(1637, 18, 'expenses', 1),
(1638, 18, 'expenses-create', 1),
(1639, 18, 'expenses-update', 1),
(1640, 18, 'expenses-view', 1),
(1641, 18, 'expenses-delete', 1),
(1642, 18, 'billings', 1),
(1643, 18, 'billings-create', 1),
(1644, 18, 'billings-update', 1),
(1645, 18, 'billings-view', 1),
(1646, 18, 'billings-delete', 1),
(1647, 18, 'returns', 1),
(1648, 18, 'returns-create', 1),
(1649, 18, 'returns-update', 1),
(1650, 18, 'returns-view', 1),
(1651, 18, 'returns-delete', 1),
(1652, 18, 'payment', 1),
(1653, 18, 'payment-create', 1),
(1654, 18, 'payment-update', 1),
(1655, 18, 'payment-view', 1),
(1656, 18, 'payment-delete', 1);

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
-- Table structure for table `tbl_billings`
--

CREATE TABLE `tbl_billings` (
  `id` int(255) NOT NULL,
  `date_bill` date NOT NULL,
  `date_due` date NOT NULL,
  `company_id` int(255) NOT NULL,
  `inclusives` longtext NOT NULL,
  `discount` double NOT NULL,
  `date_created` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `note` longtext NOT NULL,
  `date_updated` date NOT NULL,
  `updated_by` int(255) NOT NULL,
  `bill_id` text NOT NULL,
  `pref` text NOT NULL,
  `md_id` int(255) NOT NULL,
  `payment_id` int(255) NOT NULL DEFAULT 0,
  `payment_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_billings`
--

INSERT INTO `tbl_billings` (`id`, `date_bill`, `date_due`, `company_id`, `inclusives`, `discount`, `date_created`, `created_by`, `note`, `date_updated`, `updated_by`, `bill_id`, `pref`, `md_id`, `payment_id`, `payment_number`) VALUES
(2, '2020-02-07', '2020-02-15', 7, '[\"13\"]', 0, '2020-02-07', 18, '', '0000-00-00', 0, 'BID-00000002', 'company', 0, 0, '');

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
(6, 'Jollibee (SSA)', 'Daraga Albay, 4501', '23453534', 'jolibee-daraga@gmail.com`', 'COM-20180813-B663', 'Daraga Branch'),
(7, 'McDonald', 'Legazpi City', '123456', 'mcdonald@sample.com', 'COM-20190627-4POU', 'Legazpi'),
(8, 'Supra Feeds', 'Ligao', ' ', ' ', 'COM-20191002-DIB7', 'Ligao'),
(9, 'SUNWEST', 'Bogtong, Legazpi City', ' ', ' ', 'COM-20191002-QQGB', 'Bogtong'),
(10, 'Insular Life (FME, MUR)', 'Legazpi City', ' ', ' ', 'COM-20191002-L2SY', 'Legazpi'),
(11, 'Insular Life (Birthday Package)', 'Legazpi City', ' ', ' ', 'COM-20191002-8RQP', 'Legazpi'),
(12, 'Stretch Distribution INC.', ' ', ' ', '  ', 'COM-20191003-JLI1', ' '),
(13, 'BDO Life (FME, MUR)', ' ', ' ', ' ', 'COM-20191003-U7ZR', 'Legazpi'),
(14, 'Sunlife', ' ', ' ', ' ', 'COM-20191003-XALL', 'Legazpi'),
(15, 'CIBI', ' ', ' ', ' ', 'COM-20191003-N2UI', ' '),
(16, 'Therma Prime', ' ', ' ', ' ', 'COM-20191003-7BTZ', ' '),
(17, 'PAGCOR', ' ', ' ', ' ', 'COM-20191003-CQWG', 'Legazpi');

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
(1, 'Maintenance Department', 'Maintains facilities and equipment'),
(2, 'Accounting Department', 'Department of Accounting'),
(3, 'Marketing Department', 'sample here'),
(4, 'IT Department', ' '),
(5, 'Radiology Department', 'Radiology'),
(6, 'Information Department', 'Info Staff'),
(7, 'Laboratory Department', 'lab');

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
(2, 'asd', 'asdasd', '[\"2\"]', '');

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
  `status` int(1) NOT NULL DEFAULT 0,
  `address` text NOT NULL,
  `usertype` int(1) NOT NULL DEFAULT 7,
  `birthdate` date NOT NULL,
  `mobilenumber` text NOT NULL,
  `date_exit` date NOT NULL,
  `employee_number` text NOT NULL,
  `labcategory` longtext NOT NULL,
  `pf` double NOT NULL,
  `sp` longtext NOT NULL,
  `category` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `fname`, `prename`, `mname`, `lname`, `department_id`, `position`, `un`, `up`, `email`, `image`, `date_hired`, `date_regularized`, `last_session`, `status`, `address`, `usertype`, `birthdate`, `mobilenumber`, `date_exit`, `employee_number`, `labcategory`, `pf`, `sp`, `category`) VALUES
(18, 'Mave Rick', 'Mr.', 'E.', 'Villar', 1, 'Software Developer', 'admin', '5c995bbb81b028b869ee4ea7c44bb1a9ea6152bc', 'maverickvillar@gmail.com', 'uploads/user.png', '2018-01-01', '2018-01-01', '2021-09-04 12:59:22', 1, 'Ilawod Daraga Albay', 0, '1987-10-30', '09171372982', '0000-00-00', 'HN-0000001', '[\"8\",\"18\",\"17\",\"6\",\"15\",\"3\",\"10\",\"14\",\"20\",\"21\",\"5\",\"4\",\"19\",\"13\",\"1\",\"12\",\"7\",\"9\",\"16\"]', 0, '', 0),
(32, 'Mary Sharmaine', 'Ms.', 'B', 'Alcaide', 7, 'Med Tech', 'msharmA', '356a192b7913b04c54574d18c28d46e6395428ab', 'msb.alcaide@gmail.com', 'uploads/user.png', '2019-05-03', '1970-01-01', '2019-10-14 04:20:08', 1, '', 7, '1997-08-05', '09275947631', '0000-00-00', 'SEN-20190924-7YJW', '', 0, '', 0),
(24, 'Virgie Marie', 'Ms.', 'A', 'Anonuevo', 2, 'Accounting Staff', 'virgM', '356a192b7913b04c54574d18c28d46e6395428ab', 'marie.apuli@yaho.com.ph', 'uploads/user.png', '2017-12-18', '2018-06-18', '2019-10-01 10:25:09', 1, '', 6, '1970-01-01', '09354489285', '0000-00-00', 'SEN-20190629-QSLT', '', 0, '', 0),
(33, 'Karl Vincent', 'Mr', 'C', 'Mayor', 7, 'Med Tech', 'karlvM', '356a192b7913b04c54574d18c28d46e6395428ab', 'kvmayor10@gmail.com', 'uploads/user.png', '2019-05-03', '1970-01-01', '2019-10-01 10:25:58', 1, 'Brgy. 8 Bagumbayan Legazpi City', 7, '1993-02-10', '09187199831', '0000-00-00', 'SEN-20190924-A8FU', '', 0, '', 0),
(21, 'Mark', 'Mr.', 'Llasos', 'Villa', 4, 'IT', 'markV', 'e18b776a75bd27a74b7367494167f372a2af40a9', 'pzts@ymail.com', 'uploads/user.png', '2019-06-21', '2019-06-21', '2019-10-14 04:20:12', 1, 'Legazpi City', 1, '1997-03-05', '09562347693', '0000-00-00', 'SEN-20190624-3J8P', '', 0, '', 0),
(25, 'Angeline ', 'Ms.', 'G', 'Olavario', 2, 'Cashier', 'angieO', '356a192b7913b04c54574d18c28d46e6395428ab', 'gkangeline@yahoo.com', 'uploads/user.png', '2017-05-26', '2017-11-26', '2019-10-14 01:49:29', 1, 'Guinobatan, Albay', 4, '1970-01-01', '09351952822', '0000-00-00', 'SEN-20190629-GFVX', '', 0, '', 0),
(27, 'Ferdinand', 'Mr', 'D', 'Guardian', 5, 'Rad Tech', 'ferdG', '356a192b7913b04c54574d18c28d46e6395428ab', 'ferdinandguardian@gmail.com', 'uploads/user.png', '2018-05-07', '2018-11-07', '2019-10-01 10:25:47', 1, 'Bigaa, Legazpi City', 7, '1970-01-01', '09051521647', '0000-00-00', 'SEN-20190629-M79H', '', 0, '', 0),
(28, 'Kenneth Ivan Martin', 'Mr', 'C', 'Daza', 6, 'Info Clerk', 'kenM', '356a192b7913b04c54574d18c28d46e6395428ab', 'kimdee1024@gmail.com', 'uploads/user.png', '2018-04-04', '2018-10-04', '2019-10-01 10:25:34', 1, 'Old Bitano, Legazpi City', 5, '1995-12-16', '', '0000-00-00', 'SEN-20190629-BAFW', '', 0, '', 0),
(29, 'Maria Jennifer', 'Mrs', '', 'Belchez', 5, 'Rad Tech', 'mariajB', '356a192b7913b04c54574d18c28d46e6395428ab', 'ma.jenniferbelnchez@yahoo.com', 'uploads/user.png', '2018-05-07', '2018-11-07', '2019-10-01 10:25:22', 1, 'Lakandula, Legazpi City', 7, '1987-06-26', '09097654689', '0000-00-00', 'SEN-20190629-1ZHC', '', 0, '', 0),
(30, 'Mave Rick', 'Mr.', 'Enoejas', 'Villar', 4, 'IT Administrator', 'mavz', 'c417452cab36bb9abe2090431c114ef87b13187e', 'maverickvillar@gmail.com', 'uploads/user.png', '2019-09-01', '2019-09-30', '0000-00-00 00:00:00', 1, 'Daraga Philippines', 1, '2019-09-01', '09171372982', '0000-00-00', 'SEN-20190902-TACN', '', 0, '', 0),
(34, 'Jennifer', 'Mrs.', 'A', 'Vitasa', 7, 'Lab Tech', 'jenV', '356a192b7913b04c54574d18c28d46e6395428ab', 'jenny_jsa@yahoo.com', 'uploads/user.png', '1970-01-01', '1970-01-01', '2019-10-01 10:27:05', 1, 'Brgy. 16 East-Washington Drive, Legazpi City', 3, '1979-12-28', '09291743972', '0000-00-00', 'SEN-20190924-PRA7', '', 0, '', 0),
(35, 'Pristine Marie', 'Ms.', 'B', 'Prieto', 3, 'Marketing Staff', 'prisP', '356a192b7913b04c54574d18c28d46e6395428ab', 'pristinemarieprieto@gmail.com', 'uploads/user.png', '2019-05-30', '1970-01-01', '2019-10-01 10:26:53', 1, 'Benny Imperial St., Legazpi City', 7, '1998-11-29', '09771210060', '0000-00-00', 'SEN-20190924-4AHQ', '', 0, '', 0),
(36, 'Selfa Joy', 'Ms.', 'N', 'Nuylan', 3, 'Marketing Staff', 'selfaN', '356a192b7913b04c54574d18c28d46e6395428ab', 'selfajoynuylan@gmail.com', 'uploads/user.png', '2019-05-16', '1970-01-01', '2019-10-01 10:26:29', 1, 'Cotmon, Camalig, Almay', 7, '1998-08-30', '09270256454', '0000-00-00', 'SEN-20190924-S2DQ', '', 0, '', 0),
(39, 'Michael', 'Dr', 'A.', 'Angel', 4, 'Doctor', 'mica', '3a9755282369377bbef6641631938516ca7293d6', 'michaelangel@gmail.com', 'uploads/user.png', '2020-02-01', '2020-02-01', '0000-00-00 00:00:00', 1, 'Daraga Albay', 2, '2019-07-18', '0917777777', '0000-00-00', 'SEN-20200207-OX6Q', '[\"8\",\"18\",\"17\",\"6\",\"15\",\"3\",\"10\",\"14\",\"20\",\"21\",\"5\",\"4\",\"19\",\"13\",\"1\",\"12\",\"7\",\"9\",\"16\"]', 550, 'All', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `amount` double NOT NULL,
  `receipt` text NOT NULL,
  `date` date NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `updated_at` date NOT NULL,
  `updated_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`id`, `name`, `description`, `amount`, `receipt`, `date`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(9, 'Electric Bill', 'For the month of January 2020', 5000, 'ERT042', '2020-02-03', '0000-00-00', 0, '0000-00-00', 0);

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
(1, 'Serology', 'Serologic tests are blood tests that look for antibodies in your blood.'),
(3, 'Hematology', 'Hematology tests can be used to indicate, diagnose, and evaluate many conditions, including infection, inflammation, and anemia. '),
(4, 'Microscopy', '1'),
(5, 'Microbiology', '1'),
(6, 'Culture and Sensitivity', 'A culture is a test to find germs (such as bacteria or a fungus) that can cause an infection. A sensitivity test checks to see what kind of medicine, such as an antibiotic, will work best to treat the illness or infection.'),
(7, 'Thyroid Function', '1'),
(8, 'Blood Chemistry', 'Blood chemistry tests are blood tests that measure amounts of certain chemicals in a sample of blood. '),
(9, 'Ultrasound', 'Ultrasound uses high-frequency sound waves to make images of organs and structures inside the body.'),
(10, 'Hepatitis Profile', '1'),
(12, 'Special Monitoring Drugs', '1'),
(13, 'Other', '1'),
(14, 'Histopathology', 'Histopathology refers to the microscopic examination of tissue in order to study the manifestations of disease.'),
(15, 'Dental Services', 'Dental Services provides diagnosis, treats, and manages your overall oral health care needs, including gum care, root canals, fillings, crowns, veneers, bridges, and preventive education.'),
(16, 'X-Ray', 'X-Ray imaging creates pictures of the inside of your body. '),
(17, 'Consultation Fees', '1'),
(18, 'Clearances', '1'),
(19, 'Optical Services', '1'),
(20, 'Immunizations', 'Immunization shots, or vaccinations, are essential. They protect against things like measles, mumps, rubella, hepatitis B, polio, tetanus, diphtheria, and pertussis (whooping cough). '),
(21, 'Immunology', 'Used to help classify arthritis and diagnose rheumatoid arthritis. Other tests are often used as well to classify and determine types of arthritis. Tested to determine compatibility in organ, tissue, and bone marrow transplantation.');

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
(23, 247, 79, 1),
(24, 247, 82, 1),
(25, 5, 80, 1),
(26, 5, 82, 1),
(27, 5, 80, 0),
(28, 5, 80, 0),
(29, 38, 29, 1),
(30, 38, 78, 1),
(31, 39, 29, 1),
(32, 39, 80, 1),
(33, 36, 78, 1),
(34, 36, 42, 1),
(35, 19, 43, 1),
(36, 19, 80, 1),
(37, 19, 80, 0),
(38, 124, 87, 1),
(39, 124, 80, 1),
(40, 124, 45, 1),
(41, 25, 87, 1),
(42, 25, 80, 1),
(43, 25, 45, 1),
(44, 121, 65, 1),
(45, 121, 80, 1),
(46, 122, 80, 1),
(47, 122, 85, 1),
(48, 26, 80, 1),
(49, 26, 85, 1),
(50, 35, 78, 1),
(51, 20, 44, 1),
(52, 20, 80, 1),
(53, 116, 80, 1),
(54, 125, 80, 1),
(55, 73, 19, 1),
(56, 73, 80, 1),
(57, 27, 26, 1),
(58, 27, 80, 1),
(59, 179, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laboffered`
--

CREATE TABLE `tbl_laboffered` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL,
  `patient_queing` int(1) NOT NULL DEFAULT 0,
  `materials` longtext NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_laboffered`
--

INSERT INTO `tbl_laboffered` (`id`, `name`, `description`, `price`, `patient_queing`, `materials`, `category`) VALUES
(5, 'CBC w/ Platelet Count', 'Adult', 275, 1, '', '3'),
(6, 'WBC w/ Diff. Count', 'WBC w/ Diff Count', 100, 1, '', '3'),
(7, 'HGB/HCT', 'HGB/HCT', 100, 1, '', '3'),
(8, 'Platelet Count', 'Platelet Count', 120, 1, '', '3'),
(9, 'Retics Count*', 'Retics Count', 120, 1, '', '3'),
(10, 'CT/BT', 'CT/BT', 100, 1, '', '3'),
(11, 'ESR', 'ESR', 125, 1, '', '3'),
(12, 'Peripheral Smear w/ Reading', 'Peripheral Smear w/ Reading', 1800, 1, '', '3'),
(13, 'Peripheral Smear w/o Reading', 'Peripheral Smear w/o Reading', 120, 1, '', '3'),
(14, 'PTT', 'PTT', 995, 1, '', '3'),
(15, 'Prothrobim Time', 'Prothrobim Time', 950, 1, '', '3'),
(16, 'ABO/RH Typing', 'ABO/RH Typing', 135, 1, '', '3'),
(17, 'G6PD*', 'G6PD', 2000, 1, '', '3'),
(18, 'ASO Titer', 'ASO Titer', 500, 1, '', '1'),
(19, 'VDRL/RPR', 'VDRL/RPR', 275, 1, '', '1'),
(20, 'HBsAg Screening', 'HBsAg Screening', 275, 1, '', '1'),
(21, 'RA Factor*', 'RA Factor*', 495, 1, '', '1'),
(22, 'TRYPHIDOT', 'TRYPHIDOT', 700, 1, '', '1'),
(23, 'TPHA', 'TPHA*', 550, 1, '', '1'),
(24, 'Anti-HBS Screening', 'Anti-HBS Screening', 300, 1, '', '1'),
(25, 'Anti-HCV Screning (C)', 'Anti-HCV Screning (C)', 485, 1, '', '1'),
(26, 'Anti-HAV IgM/IgG / Hepa A', 'Anti-HAV IgM/IgG / Hepa A', 500, 1, '', '1'),
(27, 'HIV Screening', 'HIV Screening', 750, 1, '', '1'),
(28, 'DENGUE CHECK', 'DENGUE CHECK', 770, 1, '', '1'),
(29, 'DENGUE NSI', 'DENGUE NSI', 1200, 1, '', '1'),
(30, 'CRP*', 'CRP*', 400, 1, '', '1'),
(31, 'C3*', 'C3*', 630, 1, '', '1'),
(32, 'ANA* (Quali)', 'ANA* (Quali)', 770, 1, '', '1'),
(33, 'ANA* (Quanti)', 'ANA* (Quanti)', 3760, 1, '', '1'),
(35, 'Routine Fecalysis', 'Routine Fecalysis', 75, 1, '', '4'),
(36, 'Routine Urinalysis', 'Routine Urinalysis', 75, 1, '', '4'),
(37, 'Sperm Analysis', 'Sperm Analysis', 330, 1, '', '4'),
(38, 'Pregnancy Test (Urine)', 'Pregnancy Test (Urine)', 190, 1, '', '4'),
(39, 'Pregnancy Test (Serum)', 'Pregnancy Test (Serum)', 0, 1, '', '4'),
(40, 'Occult Blood', 'Occult Blood', 135, 1, '', '4'),
(41, 'Scotch Tape Method', 'Scotch Tape Method', 110, 1, '', '4'),
(42, 'Micral Test', 'Micral Test', 825, 1, '', '4'),
(43, 'Gram Stain', 'Gram Stain', 20, 1, '', '5'),
(44, 'AFB Stain', 'AFB Stain', 220, 1, '', '5'),
(45, 'Malarial Smear', 'Malarial Smear', 120, 1, '', '5'),
(46, 'Urine', 'Urine', 2000, 1, '', '6'),
(47, 'Blood ', 'Blood ', 2650, 1, '', '6'),
(48, 'Sputum', 'Sputum', 2000, 1, '', '6'),
(49, 'Exudates/Wound', 'Exudates/Wound', 1700, 1, '', '6'),
(50, 'Stool', 'Stool', 1700, 1, '', '6'),
(51, 'T3*', 'T3', 605, 1, '', '7'),
(52, 'T4*', 'T4', 605, 1, '', '7'),
(53, 'TSH*', 'TSH', 605, 1, '', '7'),
(54, 'ETR*', 'ETR', 605, 1, '', '7'),
(55, 'FTI*', 'FTI', 605, 1, '', '7'),
(56, 'T-Uptake*', 'T-Uptake', 467, 1, '', '7'),
(57, 'FT3*', 'FT3', 605, 1, '', '7'),
(58, 'FT4*', 'FT4', 605, 1, '', '7'),
(59, 'Progesterone*', 'Progesterone', 1760, 1, '', '21'),
(60, 'Anti-H-Pylori*', 'Anti-H-Pylori', 880, 1, '', '21'),
(61, 'FSH*', 'FSH', 770, 1, '', '21'),
(62, 'UH', 'UH', 0, 1, '', '21'),
(63, 'Prolactin*', 'Prolactin', 770, 1, '', '21'),
(64, 'CEA (Colon)*', 'CEA (Colon)', 935, 1, '', '21'),
(65, 'B-HCG (Chorion)*', 'B-HCG (Chorion)', 935, 1, '', '21'),
(66, 'Cortisol*', 'Cortisol', 770, 1, '', '21'),
(67, 'CA 125  (Ovary)*', 'CA 125  (Ovary)', 1650, 1, '', '20'),
(68, 'CA 15.3 (Breast)*', 'CA 15.3 (Breast)', 1760, 1, '', '21'),
(69, 'CA 19.9 (Pancreas)*', 'CA 19.9 (Pancreas)', 1925, 1, '', '21'),
(70, 'Estradiol', 'Estradiol', 1540, 1, '', '21'),
(71, 'Alpha Feto-Protein*', 'Alpha Feto-Protein', 935, 1, '', '21'),
(72, 'Rubella IgG (Quanti)', 'Rubella IgG (Quanti)', 1125, 1, '', '21'),
(73, 'PSA', 'PSA', 1500, 1, '', '21'),
(74, 'IgE', 'IgE', 2100, 1, '', '21'),
(75, 'GgTP', 'GgTP', 506, 1, '', '21'),
(76, 'GgT', 'GgT', 462, 1, '', '21'),
(78, 'LDH (Immunology)', 'LDH', 440, 1, '', '21'),
(79, 'FERRITIN', 'FERRITIN', 2500, 1, '', '21'),
(80, 'Leukocyte Antibody Test (LAT)', 'Leukocyte Antibody Test', 8030, 1, '', '21'),
(81, 'FBS/RBS/PPBS', 'FBS/RBS/PPBS', 150, 1, '', '8'),
(82, 'BUA', 'BUA', 150, 1, '', '8'),
(83, 'BUN', 'BUN', 150, 1, '', '8'),
(84, 'Creatinine', 'Creatinine', 150, 1, '', '8'),
(85, 'Cholesterol', 'Cholesterol', 150, 1, '', '8'),
(86, 'Triglycerides', 'Triglycerides', 250, 1, '', '8'),
(87, 'HDL/LDL/VLDL', 'HDL/LDL/VLDL', 250, 1, '', '8'),
(88, 'OGTT (FBS, 1 & 2 Hrs, 100gms)', 'OGTT (FBS 1 & 2 Hrs 100gms)', 715, 1, '', '8'),
(89, 'FBS + 2Hrs PPBS', 'FBS + 2Hrs PPBS', 385, 1, '', '8'),
(90, 'GCT (100 gms, RBS)', 'GCT (100 gms RBS)', 440, 1, '', '8'),
(91, 'SGOT', 'SGOT', 209, 1, '', '8'),
(92, 'SGPT', 'SGPT', 209, 1, '', '8'),
(93, 'Alkaline Phosphatase', 'Alkaline Phosphatase', 495, 1, '', '8'),
(94, 'Acid Phosphatase', 'Acid Phosphatase', 550, 1, '', '8'),
(95, 'Total Protein', 'Total Protein', 300, 1, '', '8'),
(96, 'Albumin', 'Albumin', 300, 1, '', '8'),
(97, 'TPAG', 'TPAG', 570, 1, '', '8'),
(98, 'Bilirubin, TOTAL', 'Bilirubin TOTAL', 400, 1, '', '8'),
(99, 'Sodium (Na)', 'Sodium (Na)', 242, 1, '', '8'),
(100, 'Potassium (K)', 'Potassium (K)', 242, 1, '', '8'),
(101, 'Chloride (Cl)', 'Chloride (Cl)', 242, 1, '', '8'),
(102, 'Calcium (Ca)', 'Calcium (Ca)', 252, 1, '', '8'),
(103, 'Inorganic Phosphorus', 'Inorganic Phophorus', 275, 1, '', '8'),
(104, 'Magnesium*', 'Magnesium', 450, 1, '', '8'),
(105, 'Troponin Quali*', 'Troponin Quali', 1300, 1, '', '8'),
(106, 'HBA1C (automated)', 'HBA1C (automated)', 795, 1, '', '8'),
(107, 'Amylase', 'Amylase', 1980, 1, '', '8'),
(108, 'Insulin*', 'Insulin', 1980, 1, '', '8'),
(109, 'Iron*', 'Iron', 605, 1, '', '8'),
(110, 'TIBC*', 'TIBC', 880, 1, '', '8'),
(111, 'Fructosamine*', 'Fructosamine', 506, 1, '', '8'),
(112, 'CPK*', 'CPK', 450, 1, '', '8'),
(113, 'LDH* (Blood Chem)', 'LDH', 600, 1, '', '8'),
(114, 'Complete Hepa B Profile', 'Complete Hepa B Profile', 2750, 1, '', '10'),
(115, 'Complete Hepatitis Profile', 'Complete Hepatitis Profile', 4895, 1, '', '10'),
(116, 'HBsAg Confirmatory*', 'HBsAg Confirmatory', 395, 1, '', '10'),
(117, 'Anti-HBC-IgG*', 'Anti-HBC-IgG', 484, 1, '', '10'),
(118, 'Anti-HBS*', 'Anti-HBS', 523, 1, '', '10'),
(119, 'Anti-HBC-IgM*', 'Anti-HBC-IgM', 517, 1, '', '10'),
(120, 'HBeAg*', 'HBeAg', 517, 1, '', '10'),
(121, 'Anti-HAV-IgM*', 'Anti-HAV-IgM', 600, 1, '', '10'),
(122, 'Anti-HAV-IgG*', 'Anti-HAV-IgG', 600, 1, '', '10'),
(123, 'Anti-HBe*', 'Anti-HBe', 517, 1, '', '10'),
(124, 'Anti-HCV', 'Anti-HCV', 880, 1, '', '10'),
(125, 'HBsAg ELISA', 'HBsAg ELISA', 600, 1, '', '10'),
(126, 'Amniotic Fluid Index (AFI)', 'Amniotic Fluid Index (AFI)', 700, 1, '', '9'),
(127, 'BPS', 'BPS', 1500, 0, '', '9'),
(128, 'BPS Twin', 'BPS Twin', 2500, 0, '', '9'),
(129, 'BPS Triplet', 'BPS Triplet', 3500, 0, '', '9'),
(130, 'BPS Quadruplet', 'BPS Quadruplet', 4500, 0, '', '9'),
(131, 'TVS', 'TVS', 1200, 1, '', '9'),
(132, 'TVS Twin', 'TVS Twin', 2000, 1, '', '9'),
(133, 'TVS Triplet', 'TVS Triplet', 2800, 1, '', '9'),
(134, 'TVS Quadruplet', 'TVS Quadruplet', 3500, 1, '', '9'),
(135, 'Congenital Anomaly Scan Cas', 'Congenital Anomaly Scan Cas', 2800, 0, '', '9'),
(136, 'Pelvic/Obstetric', 'Pelvic/Obstetric', 1000, 1, '', '9'),
(137, 'Pelvic/Obstetric Twin', 'Pelvic/Obstetric Twin', 1700, 1, '', '9'),
(138, 'Pelvic/Obstetric Triplet', 'Pelvic/Obstetric Triplet', 2700, 1, '', '9'),
(139, 'Pelvic/Obstetric Quadruplet', 'Pelvic/Obstetric Quadruplet', 3100, 1, '', '9'),
(140, 'Breast, Bilateral', 'Breast Bilateral', 1500, 0, '', '9'),
(141, 'Whole Abdomen', 'Whole Abdomen', 1800, 1, '', '9'),
(142, 'Whole Abdomen + OB', 'Whole Abdomen + OB', 2200, 1, '', '9'),
(143, 'Upper Abdomen', 'Upper Abdomen', 1500, 1, '', '9'),
(144, 'Lower Abdomen', 'Lower Abdomen', 1500, 1, '', '9'),
(145, 'HBT', 'HBT', 1200, 1, '', '9'),
(146, 'KUB & Prostate', 'KUB & Prostate', 1500, 1, '', '9'),
(147, 'KUB', 'KUB', 1200, 1, '', '9'),
(148, 'Kidneys', 'Kidneys', 1000, 1, '', '9'),
(149, 'Thyroid', 'Thyroid', 1000, 1, '', '9'),
(150, 'Scrotum / Ingunal', 'Scrotum / Ingunal', 1500, 1, '', '9'),
(151, 'Prostate', 'Prostate', 1000, 1, '', '9'),
(152, 'Single Organ', 'Single Organ', 1000, 1, '', '9'),
(153, 'Neck', 'Neck', 1320, 1, '', '9'),
(154, 'Chest Mapping', 'Chest Mapping', 1320, 1, '', '9'),
(155, 'Chest UTZ', 'Chest UTZ', 1000, 1, '', '9'),
(156, 'Mass', 'Mass', 1000, 1, '', '9'),
(158, 'Doppler Flow', 'Dopper Flow', 1500, 1, '', '9'),
(159, 'Complete 4D UTZ (Pelvic UTZ, CD, Pictures)', 'Complete 4D UTZ (Pelvic UTZ CD Pictures)', 3500, 0, '', '9'),
(160, '4D UTZ Only (CD, photos)', '4D UTZ Only (CD photos)', 3500, 0, '', '9'),
(161, '3D UTZ Photos Only', '3D UTZ Photos Only', 1650, 0, '', '9'),
(162, 'Small <5 cm', 'Small <5 cm', 1200, 1, '', '14'),
(163, 'Medium* 5-7 cm', 'Medium 5-7 cm', 1800, 1, '', '14'),
(164, 'Large* 8-15cm', 'Large 8-15cm', 4235, 1, '', '14'),
(165, 'Extra Large* 16-20cm', 'Extra Large 16-20cm', 4235, 1, '', '14'),
(166, 'Huge* > 20cm', 'Huge > 20cm', 6000, 1, '', '14'),
(167, 'FNAB', 'FNAB', 7700, 1, '', '14'),
(168, 'Cytology*', 'Cytology', 847, 1, '', '14'),
(169, 'Cytology with Cell Block*', 'Cytology with Cell Block', 1540, 1, '', '14'),
(170, 'Oral Prophylaxis', 'Oral Prophylaxis', 1000, 1, '', '15'),
(171, 'Restoration /Filling', 'Restoration /Filling', 1200, 1, '', '15'),
(172, 'Extraction /Tooth', 'Extraction /Tooth', 1200, 1, '', '15'),
(173, 'Root Canal /Root', 'Root Canal /Root', 4000, 1, '', '15'),
(174, 'Dentures', 'Dentures', 0, 1, '', '15'),
(175, 'Lumbosacral Spines AP/L', 'Lumbosacral Spines AP/L', 600, 1, '', '16'),
(176, 'Nasal Bone AP/L', 'Nasal Bone AP/L', 600, 1, '', '16'),
(177, 'Transrectal', 'Transrectal', 0, 1, '', '9'),
(178, 'ECG', 'ECG', 275, 1, '', '13'),
(179, 'Drug Test Screening (Urine)', 'Drug Test Screening (Urine)', 330, 1, '', '13'),
(180, 'Hair Follicle Drug Test*', 'Hair Follicle Drug Test', 0, 1, '', '13'),
(181, 'Pulmonary Function Test (PFT)', 'Pulmonary Function Test (PFT)', 990, 1, '', '13'),
(182, 'PAP SMEAR', 'PAP SMEAR             ', 950, 1, '', '13'),
(183, 'Mammography*', 'Mammography', 2420, 1, '', '13'),
(184, 'Treadmill Stress Test', 'Treadmill Stress Test', 1980, 1, '', '13'),
(187, 'EEG', 'EEG', 2500, 1, '', '13'),
(188, 'Visual Acquity Test', 'Visual Acquity Test', 250, 0, '', '19'),
(189, 'Ishihara /Color Vision Test', 'Ishihara /Color Vision Test', 250, 0, '', '13'),
(190, 'Corrective Lense', 'Corrective Lense', 0, 0, '', '19'),
(191, 'Pulmonary Clearance', 'Pulmonary Clearance', 1000, 0, '', '18'),
(192, 'Cardio Clearance', 'Cardio Clearance', 700, 0, '', '18'),
(193, 'Cardio Pulmonary Clearance Low-Risk', 'Cardio Pulmonary Clearance Low-Risk', 2000, 0, '', '18'),
(194, 'Cardio Pulmonary Clearance High-Risk', 'Cardio Pulmonary Clearance High-Risk', 2600, 0, '', '18'),
(195, 'Neuro-Psychological Clearance/Test', 'Neuro-Psychological Clearance/Test', 850, 1, '', '18'),
(196, 'Medical Certificate', 'Medical Certificate', 350, 1, '', '18'),
(197, 'Comparison Reading', 'Comparison Reading', 100, 1, '', '18'),
(198, 'Obstetric Gyncologist', 'Obstetric Gyncologist', 350, 1, '', '17'),
(199, 'Pediatrician', 'Pediatrician', 350, 0, '', '17'),
(200, 'General Practitioner', 'General Practitioner', 350, 0, '', '17'),
(201, 'General Medicine', 'General Medicine', 350, 0, '', '17'),
(202, 'General Surgeon', 'General Surgeon', 350, 0, '', '17'),
(203, 'Neuro-Psychiatrist', 'Neuro-Psychiatrist', 1000, 0, '', '17'),
(204, 'ENT', 'ENT', 350, 0, '', '17'),
(205, 'Pulmonologist', 'Pulmonologist', 350, 0, '', '17'),
(206, 'Gastroentologist', 'Gastroentologist', 350, 0, '', '17'),
(207, 'Dentist', 'Dentist', 350, 0, '', '17'),
(208, 'Optical', 'Optical', 350, 0, '', '17'),
(209, 'Ankle AP/L', 'Ankle AP/L', 600, 0, '', '16'),
(210, 'Arm AP/L', 'Arm AP/L', 0, 0, '', '16'),
(211, 'Cervical Spines AP/L', 'Cervical Spines AP/L', 600, 0, '', '16'),
(212, 'Chest PA Adult', 'Chest PA Adult', 300, 0, '', '16'),
(213, 'Chest PA Pedia', 'Chest PA Pedia', 300, 0, '', '16'),
(214, 'Chest Apicolordotic View', 'Chest Apicolordotic View', 300, 0, '', '16'),
(215, 'Chest PA/LAT Pedia', 'Chest PA/LAT Pedia', 500, 0, '', '16'),
(216, 'Chest AP/LAT Adult', 'Chest AP/LAT Adult', 600, 0, '', '16'),
(217, 'Chest AP/LAT Adult', 'Chest AP/LAT Adult', 600, 0, '', '16'),
(218, 'Chest Lateral', 'Chest Lateral', 300, 0, '', '16'),
(219, 'Clavicle', 'Clavicle', 300, 0, '', '16'),
(220, 'Elbow AP/L', 'Elbow AP/L', 600, 0, '', '16'),
(221, 'Femur/Thigh AP/L', 'Femur/Thigh AP/L', 600, 0, '', '16'),
(222, 'Foot AP/Oblique', 'Foot AP/Oblique', 600, 0, '', '16'),
(223, 'Hand AP/O', 'Hand AP/O', 600, 0, '', '16'),
(224, 'Hip Joint AP', 'Hip Joint AP', 300, 0, '', '16'),
(225, 'Knee AP/L', 'Knee AP/L', 600, 0, '', '16'),
(226, 'KUB Plain', 'KUB Plain', 300, 0, '', '16'),
(227, 'Leg AP/L', 'Leg AP/L', 600, 0, '', '16'),
(228, 'Lumbar Spine AP/L', 'Lumbar Spine AP/L', 600, 0, '', '16'),
(231, 'PNS (Paranasal Sinuses) Series 3 Views', 'PNS (Paranasal Sinuses) Series 3 Views', 900, 0, '', '16'),
(232, 'Temporomandibular Joint TMJ', 'Temporomandibular Joint TMJ', 300, 0, '', '16'),
(233, 'Mandible AP', 'Mandible AP', 300, 0, '', '16'),
(234, 'Mandible AP/Oblique', 'Mandible AP/Oblique', 600, 0, '', '16'),
(235, 'Townes View AP', 'Townes View AP', 300, 0, '', '16'),
(236, 'Townes View Bilateral', 'Townes View Bilateral', 600, 0, '', '16'),
(237, 'Pelvis AP', 'Pelvis AP', 300, 0, '', '16'),
(238, 'Plain Abdomen', 'Plain Abdomen', 300, 0, '', '16'),
(239, 'Rib Cage (Thoracic Cage) AP', 'Rib Cage (Thoracic Cage) AP', 300, 0, '', '16'),
(240, 'Shoulder AP', 'Shoulder AP', 300, 0, '', '16'),
(241, 'Skull AP/L', 'Skull AP/L', 600, 0, '', '16'),
(242, 'Skull Series 3 Views', 'Skull Series 3 Views', 900, 0, '', '16'),
(243, 'Thoracic Spines AP/L', 'Thoracic Spines AP/L', 600, 0, '', '16'),
(244, 'Thoracolumbar Spines AP/L', 'Thoracolumbar Spines AP/L', 600, 0, '', '16'),
(245, 'Thoracolumbar AP', 'Thoracolumbar AP', 300, 0, '', '16'),
(246, 'Scoliosis Series', 'Scoliosis Series', 600, 0, '', '16'),
(247, 'CBC w/ Platelet Count', 'Pedia', 275, 1, '', '3');

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
  `normal_range` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdate` date NOT NULL,
  `note` longtext NOT NULL,
  `enid` int(255) NOT NULL,
  `upid` int(255) NOT NULL,
  `titles` longtext NOT NULL,
  `types` longtext NOT NULL,
  `options` longtext NOT NULL,
  `order_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_labresults`
--

INSERT INTO `tbl_labresults` (`id`, `test_id`, `patient_id`, `queuing_number`, `resultdata`, `image`, `normal_range`, `date`, `dateupdate`, `note`, `enid`, `upid`, `titles`, `types`, `options`, `order_data`) VALUES
(1, 35, 7, 'Thu-001', '[\"Brown\",\"Soft\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\"]', '', '[\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\"]', '2021-09-02 00:00:00', '2021-09-02', 'this is a test', 18, 18, '[\"Color\",\"Consistency\",\"Pus Cells\",\"Red Blood Cells\",\"Fat Globules\",\"Muscle Fiber\",\"Yeast Cells\",\"Vegetable Cells\",\"Occult Blood\",\"Parasites\"]', '[\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\"]', '[[\"Brown\",\"           Dark Brown\",\"           Greenish Brown\",\"           Light Brown\",\"           Yellow\",\"           Light Yellow\"],[\"Soft\",\"           Semi-Formed\",\"           Formed\",\"           Watery\",\"           Loose\"],[\"none\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"N/A\"],[\"n/a\"]]', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_company`
--

CREATE TABLE `tbl_lab_company` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `ctype` int(1) NOT NULL DEFAULT 0,
  `price` double NOT NULL,
  `note` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lab_company`
--

INSERT INTO `tbl_lab_company` (`id`, `company_id`, `lab_id`, `ctype`, `price`, `note`) VALUES
(6, 6, 35, 0, 63.75, ''),
(8, 6, 36, 0, 63.75, ''),
(9, 6, 212, 0, 255, ''),
(10, 6, 20, 0, 233.75, ''),
(12, 6, 179, 0, 280.5, ''),
(13, 7, 5, 0, 220, ''),
(14, 7, 35, 0, 60, ''),
(15, 7, 36, 0, 60, ''),
(16, 7, 212, 0, 240, ''),
(17, 7, 179, 0, 264, ''),
(18, 7, 201, 0, 280, ''),
(19, 8, 5, 0, 192.5, ''),
(20, 8, 36, 0, 40, ''),
(21, 8, 35, 0, 40, ''),
(22, 8, 212, 0, 210, ''),
(23, 8, 179, 0, 240, ''),
(24, 8, 201, 0, 200, ''),
(25, 9, 5, 0, 233.75, ''),
(26, 9, 36, 0, 63.75, ''),
(27, 9, 35, 0, 63.75, ''),
(28, 9, 212, 0, 255, ''),
(29, 9, 179, 0, 280.5, ''),
(30, 9, 201, 0, 297.5, ''),
(31, 10, 36, 1, 67.5, 'MUR'),
(32, 10, 201, 1, 315, 'Full Medical Exam'),
(33, 11, 201, 1, 307.44, 'Full Medical Exam'),
(34, 11, 36, 1, 65.88, 'MUR'),
(35, 11, 178, 1, 241.56, ''),
(36, 11, 212, 1, 263.52, ''),
(37, 11, 5, 1, 241.56, ''),
(38, 11, 81, 1, 131.76, ''),
(39, 11, 84, 1, 131.76, ''),
(40, 11, 85, 1, 131.76, ''),
(41, 11, 92, 1, 183.59, ''),
(42, 11, 82, 1, 131.76, ''),
(43, 12, 5, 0, 233.75, ''),
(44, 12, 35, 0, 63.75, ''),
(45, 12, 36, 0, 63.75, ''),
(46, 12, 212, 0, 255, ''),
(47, 12, 201, 0, 297.5, ''),
(48, 12, 179, 0, 280.5, ''),
(49, 13, 201, 1, 350, 'Full Medical Exam'),
(50, 13, 36, 1, 75, 'MUR'),
(51, 11, 161, 0, 0, '');

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
  `supplier_ids` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materials`
--

INSERT INTO `tbl_materials` (`id`, `name`, `description`, `qty`, `reorder_level`, `supplier_ids`) VALUES
(3, 'JLC Supplier Liquick Cor Urea 60', 'JLC Supplier', 1, 0, '[\"\"]'),
(4, 'JLC Supplier GLUCOSE 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(5, 'JLC Supplier UA 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(6, 'JLC Supplier UA 60', 'JLC Supplier', 1, 1, '[\"\"]'),
(7, 'JLC Supplier TG MONO 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(8, 'JLC Supplier ALP 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(9, 'JLC Supplier TP 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(10, 'JLC Supplier ASAT 60', 'JLC Supplier', 1, 1, '[\"\"]'),
(11, 'JLC Supplier ALAT 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(12, 'JLC Supplier CHOLESTEROL 30', 'JLC Supplier', 1, 1, '[\"\"]'),
(13, 'JLC Supplier HDL DIRECT 60', 'JLC Supplier', 1, 1, '[\"\"]'),
(14, 'JLC Supplier CORMAY SERUM HN', 'JLC Supplier', 1, 1, '[\"\"]'),
(15, 'JLC Supplier CORMAY SERUM HP', 'JLC Supplier', 1, 1, '[\"\"]'),
(16, 'JLC Supplier ACCENT 200-ALBUMIN', 'JLC Supplier', 1, 1, '[\"\"]'),
(17, 'JLC Supplier ALKALINE WASH SOL', 'JLC Supplier', 1, 1, '[\"\"]'),
(18, 'JLC Supplier HBA1C', 'JLC Supplier', 1, 1, '[\"\"]'),
(19, 'JLC Supplier ICHROMAC PSA', 'JLC Supplier', 1, 1, '[\"\"]'),
(20, 'JLC Supplier ANTI A / B / D Set', 'JLC Supplier', 1, 1, '[\"\"]'),
(23, 'JLC Supplier CREATININE', 'JLC Supplier', 3600, 1, '[\"\"]'),
(24, 'JLC Supplier MULTICAL LEVEL 1', 'JLC Supplier', 1, 1, '[\"\"]'),
(25, 'JLC Supplier MULTICAL LEVEL 2', 'JLC Supplier', 1, 1, '[\"\"]'),
(26, 'JLC Supplier HIV TEST', 'JLC Supplier', 1, 1, '[\"\"]'),
(27, 'JLC Supplier PREG TEST COMBO', 'JLC Supplier', 1, 1, '[\"\"]'),
(28, 'SUIZA MEDICAL ENTERPRISE ADVANCE QUALITY™ ONE-STEP MULTI-DRUG TESTING DEVICE THC/MET', 'SUIZA MEDICAL ENTERPRISE', 1, 1, '[\"\"]'),
(29, 'ROBINROSE TRADING PREGTEST/SERUM TEST', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(30, 'ROBINROSE TRADING SYPHILLIS TEST', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(31, 'ROBINROSE TRADING GLUCOSE ORANGE JUICE', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(32, 'ROBINROSE TRADING SYRINGE TERUMO 1CC', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(33, 'ROBINROSE TRADING SYRINGE TERUMO 3CC', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(34, 'ROBINROSE TRADING SYRINGE TERUMO 5CC', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(35, 'ROBINROSE TRADING GLASS SLIDES', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(36, 'ROBINROSE TRADING NUTRILE GLOVES (M)', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(37, 'ROBINROSE TRADING NUTRILE GLOVES (L)', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(38, 'ROBINROSE TRADING FACEMASK', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(39, 'ROBINROSE TRADING ISOPROPHYL ALCOHOL 70%', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(40, 'ROBINROSE TRADING MEDIC HEMAQUICK STAIN', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(41, 'ROBINROSE TRADING MEDIC AFB STAIN', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(42, 'ROBINROSE TRADING BIOSTIX 4SG', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(43, 'ROBINROSE TRADING RPR STRIP', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(44, 'ROBINROSE TRADING SD HEPA B TEST KIT', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(45, 'ROBINROSE TRADING EDTA TUBE', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(46, 'ROBINROSE TRADING MICROPORE 1/2 INCH', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(47, 'ROBINROSE TRADING REDTOP TUBE', 'ROBINROSE TRADING', 1, 1, '[\"\"]'),
(48, 'Brightline BLUE TIPS', 'Brightline ', 1, 1, '[\"\"]'),
(49, 'Brightline YELLOW TIPS', 'Brightline ', 1, 1, '[\"\"]'),
(50, 'Brightline PIPETTE TIPS (BLUE TIPS)', 'Brightline ', 1, 1, '[\"\"]'),
(51, 'Brightline PIPETTE TIPS (YELLOW TIPS)', 'Brightline ', 1, 1, '[\"\"]'),
(52, 'Brightline GLUCOSE ORANGE JUICE', 'Brightline ', 1, 1, '[\"\"]'),
(53, 'Brightline SYRINGE TERUMO 3CC', 'Brightline ', 1, 1, '[\"\"]'),
(54, 'Brightline SYRINGE TERUMO 5CC', 'Brightline ', 1, 1, '[\"\"]'),
(55, 'Brightline GLASS SLIDES', 'Brightline ', 1, 1, '[\"\"]'),
(56, 'Brightline NUTRILE GLOVES (S)', 'Brightline ', 1, 1, '[\"\"]'),
(58, 'Brightline GLOVES (M)', 'Brightline ', 1, 1, '[\"\"]'),
(59, 'Brightline COTTON', 'Brightline ', 1, 1, '[\"\"]'),
(60, 'Brightline FACEMASK', 'Brightline ', 1, 1, '[\"\"]'),
(61, 'Brightline ISOPROPHYL ALCOHOL 70%', 'Brightline ', 1, 1, '[\"\"]'),
(62, 'Brightline MICROTAINER EDTA', 'Brightline ', 1, 1, '[\"\"]'),
(63, 'Brightline GLOVES NON POWDERED', 'Brightline ', 1, 1, '[\"\"]'),
(64, 'Brightline  URINE STRIPS 4 PARA', 'Brightline ', 1, 1, '[\"\"]'),
(65, 'Brightline HAV IgM/ARIA', 'Brightline ', 1, 1, '[\"\"]'),
(66, 'Brightline EDTA TUBE', 'Brightline ', 1, 1, '[\"\"]'),
(67, 'Brightline MICROPORE 1/2 ICH', 'Brightline ', 1, 1, '[\"\"]'),
(68, 'Brightline ANTI A', 'Brightline ', 1, 1, '[\"\"]'),
(69, 'Brightline ANTI B', 'Brightline ', 1, 1, '[\"\"]'),
(70, 'Brightline ANTI D', 'Brightline ', 1, 1, '[\"\"]'),
(71, 'Brightline TORNIQUET', 'Brightline ', 1, 1, '[\"\"]'),
(72, 'Brightline APPLICATOR STICKS', 'Brightline ', 1, 1, '[\"\"]'),
(73, 'Brightline SD HEPA B TEST KIT', 'Brightline ', 1, 1, '[\"\"]'),
(74, 'Biocare ALFATON', 'Biocare ', 1, 1, '[\"\"]'),
(75, 'Biocare ALFALYSE', 'Biocare ', 1, 1, '[\"\"]'),
(76, 'Biocare SWELAB CONTROL', 'Biocare', 1, 1, '[\"\"]'),
(77, 'S Reagent Strips for Urinalysis', 'S', 1, 1, '[\"\"]'),
(78, 'S Specimen Cup', ' S', 0, 1, '[\"\"]'),
(79, 'S TERUMO SYRINGE 1CC', '1', 1, 1, '[\"\"]'),
(80, 'S TERUMO SYRINGE 3CC', '1', 1, 1, '[\"\"]'),
(81, 'S TERUMO SYRINGE 5CC', '1', 1, 1, '[\"\"]'),
(82, 'S GLOVES (M)', '1', 1, 1, '[\"\"]'),
(83, 'S GLOVES (L)', '1', 1, 1, '[\"\"]'),
(84, 'S HIV I&II TEST CARD', 'S', 1, 1, '[\"\"]'),
(85, 'S HAV IgM RAPID TEST', '1', 1, 1, '[\"\"]'),
(86, 'S ONE-STEP HBsAg TEST', '1', 1, 1, '[\"\"]'),
(87, 'S HCV ANTIBODY TEST CARD', '1', 1, 1, '[\"\"]'),
(88, 'S BLUE CROSS PREGNANCY TEST', '1', 1, 1, '[\"\"]'),
(89, 'S ESR TUBE', 'S', 1, 1, '[\"\"]');

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
(1, 'sample only', 'asdasd asd asdas', '[\"1\"]', '[\"2\"]', '[\"2\",\"3\"]'),
(2, 'test medicines', 'asd asd ', '[\"1\"]', '[\"2\"]', '[\"3\"]');

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
(1, ' ', 'Kim', ' ', 'Daza', 'legazpi city', '1995-12-16', ' ', '2019-10-12', 'SHS-20191012-FZWQUIDC', ' ', 'Filipino', '123@gmail.com', ' ', ' ', 'Female', 'uploads/user.png'),
(2, ' mr', 'cesar', ' ong', 'chua', '12', '1956-05-23', 'o', '2019-10-12', 'SHS-20191012-CL69TB3W', '09176289095', 'Filipino', 'cesarngchua@gmail.com', 'md', 'soezz', 'Male', 'uploads/user.png'),
(3, ' mr', 'mar', ' oliva', 'pasano', 'legazpi city', '1978-11-27', 'A+', '2019-10-14', 'SHS-20191014-L6Y3N6TH', '0997533257', 'Filipino', '123@gmail.com', 'supervisor', 'soezz', 'Male', 'uploads/user.png'),
(4, 'Mr', 'Virgie Marie', 'B', 'Guardian', 'Puro, Legazpi City', '1955-10-30', 'b3', '2019-10-14', 'SHS-20191014-YVNFQD6I', '123456', 'filipino', 'mcdonald@sample.com', 'eqweqe', 'Female', 'msdmasmd', 'uploads/user.png'),
(5, '', 'asdas', 'asdasd', 'asdasd', 'asdasd', '2020-01-20', '', '2020-01-14', 'SHS-20200114-BKMT6OJX', '', 'asdasd', '', '', '', 'Male', 'uploads/user.png'),
(6, 'sfdfdsdf', 'dsfsdf', '', 'sdfdsf', 'asdsad', '2020-01-21', '', '2020-01-15', 'SHS-20200115-ZSWEEKIZ', '', 'asd', 'ds@asd.dgf', '', '', 'Male', 'uploads/user.png'),
(7, '', 'Randolf', 'S', 'Gelisan', 'Legazpi City', '1985-02-11', 'O+', '2020-02-07', 'SHS-20200207-87QTQYSX', '09777777777', 'Filipino', 'randolf@gmail.com', '', '', 'Male', 'uploads/user.png');

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
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(255) NOT NULL,
  `amount` double NOT NULL,
  `bank` text NOT NULL,
  `account_number` text NOT NULL,
  `check_number` text NOT NULL,
  `note` longtext NOT NULL,
  `payment_date` date NOT NULL,
  `check_date` date NOT NULL,
  `model` text NOT NULL,
  `model_id` longtext NOT NULL,
  `status` text NOT NULL,
  `received_by` text NOT NULL,
  `date_received` text NOT NULL,
  `payment_type` text NOT NULL,
  `payment_class` text NOT NULL,
  `receipt_number` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `cashflow` text NOT NULL,
  `updated_by` int(255) NOT NULL,
  `payment_number` text NOT NULL,
  `mdcomsup` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `amount`, `bank`, `account_number`, `check_number`, `note`, `payment_date`, `check_date`, `model`, `model_id`, `status`, `received_by`, `date_received`, `payment_type`, `payment_class`, `receipt_number`, `created_at`, `updated_at`, `cashflow`, `updated_by`, `payment_number`, `mdcomsup`) VALUES
(6, 5000, '', '', '', 'Electric Bill', '2020-02-03', '0000-00-00', 'expenses', '9', 'PAID', '18', '2020-02-03', 'cash', 'expenses-payment', 'ERT042', '2020-02-07', '0000-00-00', 'out', 0, '', 0),
(8, 905, '', '', '', 'Walk-in Client', '2020-02-07', '0000-00-00', 'transaction', '15', 'PAID', '18', '2020-02-07', 'cash', 'trans-payment', '0002', '2020-02-07', '0000-00-00', 'in', 0, '', 0),
(19, 1124, 'MetroBank Albay', '200001', '234234', '', '2020-02-07', '2020-02-07', 'billings', '[\"2\"]', 'PAID', '18', '2020-02-07', 'check', 'bill-company-payment', 'WER023', '2020-02-07', '0000-00-00', 'in', 0, 'PNO-00000019', 0),
(22, 210000, 'BDO Legazpi City', '123123', '123123', 'asdsad', '2020-02-07', '2020-02-07', 'po', '[\"5\"]', 'PAID', '18', '2020-02-07', 'check', 'po-payment', 'GTY324', '2020-02-07', '2020-02-08', 'out', 18, 'PNO-00000022', 0),
(23, 210000, 'MetroBank Legazpi City', '1000001', '1232111', '', '2020-02-08', '2020-02-08', 'po', '[\"5\"]', 'PAID', '18', '2020-02-08', 'check', 'po-payment', 'TRE432', '2020-02-08', '2020-02-08', 'out', 18, 'PNO-00000023', 5),
(24, 210000, 'TESTBANK', '123123', '42354325', 'test', '2020-02-08', '2020-02-08', 'po', '[\"5\"]', 'PAID', '18', '2020-02-08', 'check', 'po-payment', 'GGG777', '2020-02-08', '2020-02-08', 'out', 18, 'PNO-00000024', 5);

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
-- Table structure for table `tbl_po`
--

CREATE TABLE `tbl_po` (
  `id` int(255) NOT NULL,
  `supplier_id` int(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `prepared_by` int(255) NOT NULL,
  `date_approved` date NOT NULL,
  `inclusives` longtext NOT NULL,
  `approved_by` int(255) NOT NULL,
  `date_forwarded` date NOT NULL,
  `status` text NOT NULL,
  `returns` longtext NOT NULL,
  `po_number` int(11) NOT NULL,
  `date_received` date NOT NULL,
  `ordered_by` int(255) NOT NULL,
  `received_by` int(255) NOT NULL,
  `pending_by` int(255) NOT NULL,
  `notes` longtext NOT NULL,
  `type` int(1) NOT NULL DEFAULT 0,
  `payment_id` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_po`
--

INSERT INTO `tbl_po` (`id`, `supplier_id`, `date_created`, `prepared_by`, `date_approved`, `inclusives`, `approved_by`, `date_forwarded`, `status`, `returns`, `po_number`, `date_received`, `ordered_by`, `received_by`, `pending_by`, `notes`, `type`, `payment_id`) VALUES
(5, 5, '2020-01-13 00:00:00', 18, '2020-01-13', '[{\"material_id\":\"48\",\"supmaterial_id\":\"56\",\"qty\":\"100\",\"price\":\"800\",\"amount\":\"80,000.00\"},{\"material_id\":\"67\",\"supmaterial_id\":\"76\",\"qty\":\"200\",\"price\":\"650\",\"amount\":\"130,000.00\"}]', 18, '2020-01-31', 'Received', '', 1, '2020-01-31', 18, 18, 18, '', 0, 24),
(6, 5, '2021-09-02 00:00:00', 18, '2021-09-02', '[{\"material_id\":\"48\",\"supmaterial_id\":\"56\",\"qty\":\"1\",\"price\":\"800\",\"amount\":\"800.00\"},{\"material_id\":\"68\",\"supmaterial_id\":\"77\",\"qty\":\"2\",\"price\":\"600\",\"amount\":\"1,200.00\"}]', 18, '0000-00-00', 'Approved', '', 2, '0000-00-00', 0, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popayments`
--

CREATE TABLE `tbl_popayments` (
  `id` int(255) NOT NULL,
  `payment_number` text NOT NULL,
  `receipt_number` text NOT NULL,
  `payment_type` text NOT NULL,
  `amount` double NOT NULL,
  `inclusives` longtext NOT NULL,
  `payment_date` date NOT NULL,
  `bank_name` text NOT NULL,
  `bank_branch` text NOT NULL,
  `check_number` text NOT NULL,
  `check_date` date NOT NULL,
  `status` text NOT NULL,
  `create_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` int(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `or_number` text NOT NULL,
  `dr_id` int(255) NOT NULL,
  `dr_name` text NOT NULL,
  `skipwait` int(1) NOT NULL DEFAULT 0,
  `company` int(255) NOT NULL,
  `charge_slip` text NOT NULL,
  `credit_slip` text NOT NULL,
  `notes` longtext NOT NULL,
  `result_id` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_queuing`
--

INSERT INTO `tbl_queuing` (`id`, `dtime`, `queuing_number`, `patient_type`, `patient_id`, `trans_type`, `which`, `patient_class`, `status`, `date`, `or_number`, `dr_id`, `dr_name`, `skipwait`, `company`, `charge_slip`, `credit_slip`, `notes`, `result_id`) VALUES
(1, '2020-02-07 08:50:20', 'Fri-001', 'NEW', 7, 'Laboratory', '5', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 7, 'CSP-0001', '', '', 0),
(2, '2020-02-07 08:50:20', 'Fri-001', 'NEW', 7, 'Laboratory', '35', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 7, 'CSP-0001', '', '', 0),
(3, '2020-02-07 08:50:20', 'Fri-001', 'NEW', 7, 'Laboratory', '36', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 7, 'CSP-0001', '', '', 0),
(4, '2020-02-07 08:50:20', 'Fri-001', 'NEW', 7, 'Laboratory', '212', 'Individual', 2, '2020-02-07', '0002', 0, '', 1, 7, 'CSP-0001', '', '', 0),
(5, '2020-02-07 08:50:20', 'Fri-001', 'NEW', 7, 'Laboratory', '179', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 7, 'CSP-0001', '', '', 0),
(6, '2020-02-07 08:50:20', 'Fri-001', 'NEW', 7, 'Laboratory', '201', 'Individual', 2, '2020-02-07', '0002', 0, '', 1, 7, 'CSP-0001', '', '', 0),
(7, '2020-02-07 08:51:07', 'Fri-002', 'OLD', 6, 'Laboratory', '16', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 0, 'CSP-0002', '', '', 0),
(8, '2020-02-07 08:51:07', 'Fri-002', 'OLD', 6, 'Laboratory', '94', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 0, 'CSP-0002', '', '', 0),
(9, '2020-02-07 08:51:07', 'Fri-002', 'OLD', 6, 'Laboratory', '44', 'Individual', 2, '2020-02-07', '0002', 0, '', 0, 0, 'CSP-0002', '', '', 0),
(10, '2021-09-02 19:27:15', 'Thu-001', 'OLD', 7, 'Laboratory', '35', 'Individual', 3, '2021-09-02', '0003', 0, '', 0, 6, 'TEST123', '', 'On-process', 1),
(11, '2021-09-02 19:27:15', 'Thu-001', 'OLD', 7, 'Laboratory', '36', 'Individual', 2, '2021-09-02', '0003', 0, '', 0, 6, 'TEST123', '', '', 0),
(12, '2021-09-02 19:27:15', 'Thu-001', 'OLD', 7, 'Laboratory', '212', 'Individual', 2, '2021-09-02', '0003', 0, '', 1, 6, 'TEST123', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result_data`
--

CREATE TABLE `tbl_result_data` (
  `labtest_id` int(11) NOT NULL,
  `data_title` longtext NOT NULL,
  `normal_range` longtext NOT NULL,
  `options` longtext NOT NULL,
  `type` longtext NOT NULL,
  `id` int(255) NOT NULL,
  `order_number` longtext NOT NULL,
  `order_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_result_data`
--

INSERT INTO `tbl_result_data` (`labtest_id`, `data_title`, `normal_range`, `options`, `type`, `id`, `order_number`, `order_data`) VALUES
(161, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 1, '', '[\"1\",\"2\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 2, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 3, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 4, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 5, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 6, '', '[\"1\"]'),
(16, '[\"Blood Type\"]', '[\"4.1 - 5.9 mmol/L\"]', '[[\"Brown\",\"  Dark Brown\",\"  Greenish Brown\",\"  Light Brown\",\"  Yellow\",\"  Light Yellow\"]]', '[\"text\"]', 7, '', '[\"1\"]'),
(24, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Anti-HBS Screening\"],[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 8, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(26, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"Hepatitis IgG/IgM\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Hepatitis IgG/IgM\"],[\"Positive (+)\",\"  Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 9, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(122, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\"Positive (+)\",\"   Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 10, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(121, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"Hepatitis IgM\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Hepatitis IgM\"],[\"Positive (+)\",\"  Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 11, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(25, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"Hepatitis C Screening\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"Hepatitis C Screening\"],[\"Positive (+)\",\"  Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 12, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(73, '[\"PSA\"]', '[\"0 - 4.00 ng/ml\"]', '[[\" \"]]', '[\"text\"]', 13, '', ''),
(179, '[\"Date and Time of Collection\",\"Collected By\",\"Drug Test Analyst\"]', '[\"mm/dd/yyyy hr:min\",\"ASC Name\",\"Analyst\"]', '[[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\"]', 14, '', '[\"1\",\"2\",\"3\"]'),
(27, '[\"Date Tested\",\"Kit Used\",\"Lot #\",\"Expiration Date\",\"Tested By\"]', '[\"mm/dd/yyyy\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 15, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(20, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"HBsAg Screening\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"HBsAg Screening\"],[\"Reactive\",\"  Non-Reactive\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 16, '', '[\"1\",\"2\",\"3\",\"4\",\"5\"]'),
(44, '[\"AFB Stain\"]', '[\"O+, +n, 1+, 2+, 3+\"]', '[[\" \"]]', '[\"text\"]', 17, '', '[\"1\"]'),
(40, '[\"Result\"]', '[\"N/A\"]', '[[\"Positive (+)\",\"  Negative (-)\"]]', '[\"text\"]', 18, '', '[\"1\"]'),
(38, '[\"Result\"]', '[\"N/A\"]', '[[\"Positive (+)\",\"  Negative (-)\"]]', '[\"text\"]', 19, '', '[\"1\"]'),
(96, '[\"Result\"]', '[\"3.4 tp 5.4 g/dL\"]', '[[\" \"]]', '[\"text\"]', 20, '', '[\"1\"]'),
(93, '[\"Result\"]', '[\"(F) 44-98 U/I | (M) 53-128 U/I\"]', '[[\" \"]]', '[\"text\"]', 21, '', '[\"1\"]'),
(82, '[\"Result\"]', '[\"(F) 149 - 405 umol/L | (M) 214 - 458 umol/L\"]', '[[\" \"]]', '[\"text\"]', 22, '', '[\"1\"]'),
(83, '[\"Result\"]', '[\"up to 8.3 mmol/L\"]', '[[\" \"]]', '[\"text\"]', 23, '', '[\"1\"]'),
(85, '[\"Result\"]', '[\"up to 5.2 mmol/L\"]', '[[\" \"]]', '[\"text\"]', 24, '', '[\"1\"]'),
(84, '[\"Result\"]', '[\"(F) 53 - 97 umol/L | (M) 62 - 115 umol/L\"]', '[[\" \"]]', '[\"text\"]', 25, '', '[\"1\"]'),
(89, '[\"Glucose (FBS)\",\"2 Hour PPBS\"]', '[\"4.1 - 5.9 mmol/L\",\"3.8 - 6.6 mmol/L\"]', '[[\" \"],[\" \"]]', '[\"text\",\"text\"]', 26, '', '[\"1\",\"2\"]'),
(81, '[\"Glucose (FBS)\",\"1st Hour OGTT\",\"2nd Hour OGTT\",\"2 Hour PPBS\"]', '[\"4.1 - 5.9 mmol/L\",\"6.6 - 9.9 mmol/L\",\"3.8 - 8.5 mmol/L\",\"3.8 - 6/6 mmol/L\"]', '[[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\"]', 27, '', '[\"01\",\"02\",\"03\",\"04\"]'),
(88, '[\"Glucose (FBS)\",\"1st Hour OGTT\",\"2nd Hour OGTT\"]', '[\"4.1 - 5.9 mmol/L\",\"6.6 - 9.9 mmol/L\",\"3.8 - 8.5 mmol/L\"]', '[[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\"]', 28, '', '[\"01\",\"02\",\"03\"]'),
(91, '[\"Result\"]', '[\"(F) up to 32 U/I | (M) up to 42 U/I\"]', '[[\"NONE\"]]', '[\"text\"]', 29, '', '[\"01\"]'),
(92, '[\"Result\"]', '[\"(F) up to 32 U/I | (M) up to 42 U/I\"]', '[[\" \"]]', '[\"text\"]', 30, '', '[\"01\"]'),
(95, '[\"Result\"]', '[\"6.60 - 8.70 g/dl\"]', '[[\" \"]]', '[\"text\"]', 31, '', '[\"01\"]'),
(106, '[\"Result\"]', '[\"4.5% - 6.5%\"]', '[[\" \"]]', '[\"text\"]', 32, '', '[\"01\"]'),
(97, '[\"Total Protein\",\"Albumin\",\"Globulin\",\"Albumin/Globulin Ratio\",\"Alkaline Phosphatase\"]', '[\"6.60 - 8.70 g/dl\",\"3.50 - 5.20 g/dl\",\"2.30 - 3.00 g/dl\",\"1.1 - 2.5\",\"54 - 369 U/L\"]', '[[\" \"],[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 33, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(86, '[\"Result\"]', '[\"up to 1.7 mmol/L\"]', '[[\" \"]]', '[\"text\"]', 34, '', '[\"01\"]'),
(160, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" N/A\"],[\"Positive (+)\",\"  Negative (-)\"]]', '[\"image\",\"text\"]', 35, '', '[\"1\",\"2\"]'),
(126, '[\"Level of Fluid\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 36, '', '[\"1\"]'),
(140, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 37, '', '[\"01\",\"02\"]'),
(154, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 38, '', '[\"01\",\"02\"]'),
(155, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 39, '', '[\"01\",\"02\"]'),
(159, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 40, '', '[\"1\",\"2\"]'),
(94, '[\"Acid Phosphatase\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 41, '', '[\"1\"]'),
(36, '[\"Yeast Cells\",\"Amorphous Urates\",\"Calcium Oxalates\",\"Amorphous Phospates\",\"Triple Phosphates\",\"Uric Acid\",\"Color\",\"Transparency\",\"Ph\",\"Specific Gravity\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"],[\"N/A\"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\"]', 42, '', '[\"021\",\"022\",\"023\",\"024\",\"025\",\"026\",\"1\",\"2\",\"3\",\"4\"]'),
(35, '[\"Color\",\"Consistency\",\"Pus Cells\",\"Red Blood Cells\",\"Fat Globules\",\"Muscle Fiber\",\"Yeast Cells\",\"Vegetable Cells\",\"Occult Blood\",\"Parasites\"]', '[\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\",\" N/A\"]', '[[\"Brown\",\"           Dark Brown\",\"           Greenish Brown\",\"           Light Brown\",\"           Yellow\",\"           Light Yellow\"],[\"Soft\",\"           Semi-Formed\",\"           Formed\",\"           Watery\",\"           Loose\"],[\"none\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"NONE\"],[\"N/A\"],[\"n/a\"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\",\"text\"]', 43, '', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\"]'),
(209, '[\"Images\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 44, '', '[\"1\",\"2\"]'),
(124, '[\"Test\",\"Result\",\"Kit\",\"Lot #\",\"Expiration Date\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\"Positive (+)\",\"     Negative (-)\"],[\" \"],[\" \"],[\" \"]]', '[\"text\",\"text\",\"text\",\"text\",\"text\"]', 45, '', '[\"01\",\"02\",\"03\",\"04\",\"05\"]'),
(178, '[\"Image\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 46, '', '[\"1\"]'),
(210, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 47, '', '[\"01\",\"02\"]'),
(211, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 48, '', '[\"01\",\"02\"]'),
(216, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 49, '', '[\"01\",\"02\"]'),
(217, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 50, '', '[\"01\",\"02\"]'),
(218, '[\"Image\",\"Finding\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 51, '', '[\"01\",\"02\"]'),
(212, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"text\",\"text\"]', 52, '', '[\"01\",\"02\"]'),
(213, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 53, '', '[\"01\",\"02\"]'),
(215, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 54, '', '[\"01\",\"02\"]'),
(214, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 55, '', '[\"01\",\"02\"]'),
(219, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 56, '', '[\"01\",\"02\"]'),
(220, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 57, '', '[\"01\",\"02\"]'),
(221, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 58, '', '[\"01\",\"02\"]'),
(222, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 59, '', '[\"01\",\"02\"]'),
(223, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 60, '', '[\"01\",\"02\"]'),
(224, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 61, '', '[\"01\",\"02\"]'),
(225, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 62, '', '[\"01\",\"02\"]'),
(226, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 63, '', '[\"01\",\"02\"]'),
(227, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 64, '', '[\"01\",\"02\"]'),
(228, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 65, '', '[\"1\",\"02\"]'),
(175, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 66, '', '[\"01\",\"02\"]'),
(233, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 67, '', '[\"01\",\"02\"]'),
(234, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 68, '', '[\"01\",\"02\"]'),
(176, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 69, '', '[\"01\",\"02\"]'),
(237, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 70, '', '[\"01\",\"02\"]'),
(238, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 71, '', '[\"01\",\"02\"]'),
(231, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 72, '', '[\"01\",\"02\"]'),
(239, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 73, '', '[\"01\",\"02\"]'),
(246, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 74, '', '[\"01\",\"02\"]'),
(240, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 75, '', ''),
(241, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 76, '', '[\"01\",\"02\"]'),
(242, '[\"Image 1\",\"Image 2\",\"Image 3\",\"Findings\"]', '[\"N/A\",\"N/A\",\"N/A\",\"N/A\"]', '[[\" \"],[\" \"],[\" \"],[\" \"]]', '[\"image\",\"image\",\"image\",\"text\"]', 77, '', '[\"01\",\"02\",\"03\",\"04\"]'),
(232, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 78, '', '[\"01\",\"02\"]'),
(243, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 79, '', '[\"01\",\"02\"]'),
(245, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 80, '', '[\"01\",\"02\"]'),
(244, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 81, '', '[\"01\",\"02\"]'),
(235, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 82, '', '[\"01\",\"02\"]'),
(236, '[\"Image\",\"Findings\"]', '[\"N/A\",\"N/A\"]', '[[\" \"],[\" \"]]', '[\"image\",\"text\"]', 83, '', '[\"01\",\"02\"]'),
(0, '[\"1\"]', '[\"N/A\"]', '[[\" \"]]', '[\"text\"]', 84, '', '[\"1\"]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_returns`
--

CREATE TABLE `tbl_returns` (
  `id` int(255) NOT NULL,
  `model` text NOT NULL,
  `model_id` int(255) NOT NULL,
  `inclusives` longtext NOT NULL,
  `status` text NOT NULL,
  `date_created` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `date_returned` date NOT NULL,
  `received_by` text NOT NULL,
  `date_updated` date NOT NULL,
  `updated_by` int(255) NOT NULL,
  `note` longtext NOT NULL,
  `return_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_returns`
--

INSERT INTO `tbl_returns` (`id`, `model`, `model_id`, `inclusives`, `status`, `date_created`, `created_by`, `date_returned`, `received_by`, `date_updated`, `updated_by`, `note`, `return_id`) VALUES
(7, '', 0, '[{\"model\":\"po\",\"id\":\"5\",\"name\":\"Brightline MICROPORE 1/2 ICH(200 qty)\",\"price\":\"650\",\"qty\":\"8\",\"amount\":\"5200\",\"material_id\":\"67\"}]', 'Returned', '2020-02-06', 18, '2020-02-05', 'asdasddd', '2020-02-06', 18, 'asd', 'RID-00000007');

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
(4, 'O.R. Prefix', 'orprefix', 'AAA', '2018-08-21 00:00:00', '2018-08-21 00:00:00'),
(5, 'Doctor\'s Default P.F.', 'doctor_default_fee', '500', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Auto Number O.R.', 'auto_or', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Void Password', 'void_pass', 'sohessi123', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supmaterials`
--

CREATE TABLE `tbl_supmaterials` (
  `id` int(255) NOT NULL,
  `sup_id` int(255) NOT NULL,
  `material_id` int(255) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supmaterials`
--

INSERT INTO `tbl_supmaterials` (`id`, `sup_id`, `material_id`, `price`) VALUES
(1, 1, 1, 100),
(12, 1, 2, 90),
(13, 2, 3, 3000),
(14, 2, 4, 2800),
(15, 2, 5, 3800),
(16, 2, 6, 7600),
(17, 2, 7, 6150),
(18, 2, 8, 4000),
(19, 2, 9, 4000),
(20, 2, 10, 4400),
(21, 2, 11, 2200),
(22, 2, 12, 3800),
(23, 2, 13, 16500),
(24, 2, 14, 2000),
(25, 2, 15, 2000),
(26, 2, 13, 16500),
(27, 2, 16, 3600),
(28, 2, 17, 3000),
(29, 2, 18, 8750),
(30, 2, 19, 6500),
(31, 2, 20, 2400),
(32, 2, 23, 0),
(33, 2, 24, 2000),
(34, 2, 25, 2000),
(35, 2, 26, 7200),
(36, 2, 27, 1600),
(37, 3, 28, 520),
(38, 4, 29, 2400),
(39, 4, 30, 2500),
(40, 4, 31, 250),
(41, 4, 32, 1000),
(42, 4, 33, 950),
(43, 4, 34, 1000),
(44, 4, 35, 100),
(45, 4, 36, 250),
(46, 4, 37, 250),
(47, 4, 38, 100),
(48, 4, 39, 75),
(49, 4, 40, 5000),
(50, 4, 41, 5000),
(51, 4, 42, 3600),
(52, 4, 43, 2500),
(53, 4, 45, 1000),
(54, 4, 46, 600),
(55, 4, 47, 800),
(56, 5, 48, 800),
(57, 5, 49, 800),
(58, 5, 50, 1200),
(59, 5, 51, 600),
(60, 5, 52, 200),
(61, 5, 53, 700),
(62, 5, 54, 800),
(63, 5, 55, 100),
(64, 5, 56, 250),
(65, 5, 58, 200),
(66, 5, 59, 100),
(67, 5, 60, 100),
(68, 5, 61, 100),
(69, 5, 62, 1200),
(70, 5, 63, 200),
(71, 5, 64, 600),
(73, 5, 65, 7500),
(74, 5, 73, 2000),
(75, 5, 66, 600),
(76, 5, 67, 650),
(77, 5, 68, 600),
(78, 5, 69, 600),
(79, 5, 70, 1000),
(80, 5, 71, 25),
(81, 5, 72, 380),
(82, 6, 74, 31000),
(83, 6, 75, 25000),
(84, 6, 76, 12500),
(85, 7, 77, 3600),
(86, 7, 88, 2400),
(87, 7, 83, 250),
(88, 7, 82, 250),
(89, 7, 85, 0),
(90, 7, 87, 0),
(91, 7, 84, 0),
(92, 7, 86, 0),
(93, 7, 77, 0),
(94, 7, 78, 0),
(95, 7, 79, 0),
(96, 7, 80, 0),
(97, 7, 81, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE `tbl_suppliers` (
  `id` int(255) NOT NULL,
  `business` text NOT NULL,
  `business_address` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`id`, `business`, `business_address`, `fname`, `lname`, `phone`, `mobile`, `email`) VALUES
(2, 'JLC CABLETOW CORP', ' 104 M H Del Pilar St. Sto Tomas, Pasig, Metro Manila', ' ', ' ', '', '0920909183 / 09434278447 / 09231008566', ''),
(3, 'SUIZA MEDICAL ENTERPRISE', ' 23 Blk.10, Lot 4, Champaca St. San Antonio Valley 17 Talon lV. (30.20 mi) Las Piñas 4102', ' ', ' ', ' ', ' 0927 202 7078', ''),
(4, 'ROBINROSE TRADING', ' 515 Ocampo Bldg. Iriga City 4431', ' ', ' ', ' ', '+63 54 288 4126', ''),
(5, 'Brightline Medical System', ' Lot 6, Blk 7, Lady Iza Subd., Cumadcad, Castilla, Sorsogon', ' ', ' ', '09283231769', ' ', ''),
(6, 'Biocare Health Resources, Inc.', 'Naga City', ' ', ' ', '09192711964 / 09328495838', '', 'inquiry@biocare.ph'),
(7, 'SOHESSI', 'LEGAZPI CITY', ' ', ' ', ' ', ' ', '');

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
  `orprefix` text NOT NULL,
  `transtype` int(11) NOT NULL DEFAULT 0,
  `company` int(255) NOT NULL,
  `md` int(255) NOT NULL,
  `credit_slip` text NOT NULL,
  `charge_slip` text NOT NULL,
  `ackknowledgement` text NOT NULL,
  `disc` double NOT NULL,
  `disc_type` text NOT NULL,
  `bill_id` int(255) NOT NULL DEFAULT 0,
  `payment_id` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `patient_id`, `trans_date`, `trans_time`, `total_amount`, `net`, `or_number`, `amount_paid`, `queuing_number`, `realdate`, `vat`, `wht`, `orprefix`, `transtype`, `company`, `md`, `credit_slip`, `charge_slip`, `ackknowledgement`, `disc`, `disc_type`, `bill_id`, `payment_id`) VALUES
(13, 7, '2020-02-07', '12:46:18', 1124, 1067.8, '0002', 0, 'Fri-001', '2020-02-07 12:46:18', 0, 56.2, 'AAA', 1, 7, 0, '', '', '', 0, 'NONE', 2, 0),
(15, 6, '2020-02-07', '12:48:07', 905, 859.75, '0002', 905, 'Fri-002', '2020-02-07 12:48:07', 0, 45.25, 'AAA', 0, 0, 0, '', '', '', 0, 'NONE', 0, 8),
(16, 7, '2021-09-02', '19:33:35', 382.5, 363.375, '0003', 0, 'Thu-001', '2021-09-02 19:33:35', 0, 19.125, 'AAA', 1, 6, 0, 'CREDIT1', '', 'CREDIT2', 0, 'NONE', 0, 0);

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
-- Indexes for table `result_datas`
--
ALTER TABLE `result_datas`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_billings`
--
ALTER TABLE `tbl_billings`
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
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
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
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_phycisian`
--
ALTER TABLE `tbl_phycisian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_po`
--
ALTER TABLE `tbl_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popayments`
--
ALTER TABLE `tbl_popayments`
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
-- Indexes for table `tbl_returns`
--
ALTER TABLE `tbl_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supmaterials`
--
ALTER TABLE `tbl_supmaterials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
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
-- AUTO_INCREMENT for table `result_datas`
--
ALTER TABLE `result_datas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_acl`
--
ALTER TABLE `tbl_acl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1657;

--
-- AUTO_INCREMENT for table `tbl_availedlab`
--
ALTER TABLE `tbl_availedlab`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_billings`
--
ALTER TABLE `tbl_billings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_diseases`
--
ALTER TABLE `tbl_diseases`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_labcategory`
--
ALTER TABLE `tbl_labcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_labmaterials`
--
ALTER TABLE `tbl_labmaterials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_laboffered`
--
ALTER TABLE `tbl_laboffered`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `tbl_labresults`
--
ALTER TABLE `tbl_labresults`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_lab_company`
--
ALTER TABLE `tbl_lab_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_materials`
--
ALTER TABLE `tbl_materials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_phycisian`
--
ALTER TABLE `tbl_phycisian`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_po`
--
ALTER TABLE `tbl_po`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_popayments`
--
ALTER TABLE `tbl_popayments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `tbl_queuing`
--
ALTER TABLE `tbl_queuing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_result_data`
--
ALTER TABLE `tbl_result_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_returns`
--
ALTER TABLE `tbl_returns`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_supmaterials`
--
ALTER TABLE `tbl_supmaterials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_symptoms`
--
ALTER TABLE `tbl_symptoms`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
