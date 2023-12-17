-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 06:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oba`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image_url`, `parent_id`) VALUES
(1, 'Atta', '', 0),
(2, 'Bakery', '', 0),
(4, 'Biscuit', '', 2),
(5, 'Rusk', '', 2),
(7, 'Besan', '', 0),
(10, 'Desi Ghee', '', 0),
(14, 'Food Color', '', 0),
(19, 'Hing', '', 0),
(25, 'Dali Hing', '', 19),
(26, 'Harihar Hing', '', 19),
(28, 'Krishna Bihari Hing', '', 19),
(31, 'Shiv Om', '', 19),
(40, 'Masala', '', 0),
(46, '10 Rs Dabba', 'Oil Bottel.png', 40),
(47, '100gm / 50gm Dabba', 'Chicken Masala_Mockup_PNG.png', 40),
(49, '5 Rs Dabba', '', 40),
(52, 'Haldi / Mirch / Dhaniya', '', 40),
(56, 'Sabut Masala', '', 40),
(61, 'Namak', '', 0),
(67, 'Kala Namak', '', 61),
(68, 'Sendha Namak', '', 61),
(70, 'Others', '', 0),
(73, 'Pooja Items', '', 0),
(77, 'Chandan', '', 73),
(78, 'Dhoop Bati', '', 73),
(80, 'Hawan Samagri', '', 73),
(83, 'Kalawa', '', 73),
(87, 'Kapoor', '', 73),
(92, 'Pooja Ghee', '', 73),
(98, 'Rangoli', '', 73),
(105, 'Roli', '', 73),
(113, 'Rui Bati', '', 73),
(122, 'Sindoor', '', 73),
(132, 'Til Oil', '', 73),
(144, 'Tota', '', 19);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `state_id`) VALUES
(1, 'Bijnor', 5),
(2, 'Haridwar', 5),
(3, 'Amhera', 5),
(4, 'Bachnau', 5),
(5, 'Baruki', 5),
(6, 'Bhaguwala', 5),
(15, 'Chacri Mod', 5),
(16, 'Chandpur', 5),
(17, 'Dhampur', 5),
(18, 'Dhanora', 5),
(19, 'Gajraula', 5),
(20, 'Ganj', 5),
(21, 'Haldaur', 5),
(22, 'Hasanpur', 5),
(23, 'Hathras', 5),
(24, 'Himpur', 5),
(25, 'Jalilpur', 5),
(26, 'Kiratpur', 5),
(27, 'Kotwali', 5),
(28, 'Mandawar', 5),
(29, 'Nagina', 5),
(30, 'Najibabad', 5),
(31, 'Nangal', 5),
(32, 'Noorpur', 5),
(33, 'Padla', 5),
(34, 'Seohara', 5),
(35, 'Sowatpur', 5),
(36, 'Nethaur', 5),
(37, 'S.L.M.R', 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `firm_name` varchar(100) NOT NULL,
  `GSTIN` varchar(20) NOT NULL,
  `type` enum('Retailer','Distributor','Wholesaler','Other') NOT NULL DEFAULT 'Retailer',
  `distributor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `mobile_number`, `state_id`, `city`, `address`, `firm_name`, `GSTIN`, `type`, `distributor_id`) VALUES
(1, 'Aaradhana Provision Store', '', 5, 1, '', '', '', 'Retailer', 0),
(2, 'General supplier', '', 5, 2, '', '', '', 'Retailer', 0),
(3, 'Dilshad', '', 5, 3, '', '', '', 'Retailer', 0),
(4, 'Hira lal', '', 5, 4, '', '', '', 'Retailer', 0),
(5, 'Abdul Waheed', '', 5, 5, '', '', '', 'Retailer', 0),
(6, 'Akash Vikas', '', 5, 5, '', '', '', 'Retailer', 0),
(7, 'Akbar', '', 5, 5, '', '', '', 'Retailer', 0),
(8, 'Babu Trader', '', 5, 5, '', '', '', 'Retailer', 0),
(9, 'Gopal', '', 5, 5, '', '', '', 'Retailer', 0),
(10, 'Jishan', '', 5, 5, '', '', '', 'Retailer', 0),
(11, 'Narender', '', 5, 5, '', '', '', 'Retailer', 0),
(12, 'Rajendra', '', 5, 5, '', '', '', 'Retailer', 0),
(13, 'Salamudeen Kirana', '', 5, 5, '', '', '', 'Retailer', 0),
(14, 'Vaarish', '', 5, 5, '', '', '', 'Retailer', 0),
(15, 'Mukesh singh', '', 5, 6, '', '', '', 'Retailer', 0),
(16, 'Aakarshna Kirana Store', '', 5, 1, '', '', '', 'Retailer', 0),
(17, 'Abhishek Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(18, 'Ambar kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(19, 'Amit Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(20, 'Aneesh', '', 5, 1, '', '', '', 'Retailer', 0),
(21, 'Ankur Gautam', '', 5, 1, '', '', '', 'Retailer', 0),
(22, 'Arora Gen Store', '', 5, 1, '', '', '', 'Retailer', 0),
(23, 'Arpit Traders', '', 5, 1, '', '', '', 'Retailer', 0),
(24, 'Arun Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(25, 'Ashu Khanna', '', 5, 1, '', '', '', 'Retailer', 0),
(26, 'Ashu Mittal', '', 5, 1, '', '', '', 'Retailer', 0),
(27, 'Aslam Bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(28, 'Bala Ji Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(29, 'Bishan Lal Rakesh Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(30, 'Chaudhary Bhojnalaya', '', 5, 1, '', '', '', 'Retailer', 0),
(31, 'Deepak Pooja Store', '', 5, 1, '', '', '', 'Retailer', 0),
(32, 'Devender Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(33, 'Devendra', '', 5, 1, '', '', '', 'Retailer', 0),
(34, 'Fakir Chand', '', 5, 1, '', '', '', 'Retailer', 0),
(35, 'Faruk Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(36, 'Gamaa Sweets', '', 5, 1, '', '', '', 'Retailer', 0),
(37, 'Gautam', '', 5, 1, '', '', '', 'Retailer', 0),
(38, 'Harshit', '', 5, 1, '', '', '', 'Retailer', 0),
(39, 'Irshad', '', 5, 1, '', '', '', 'Retailer', 0),
(40, 'Jain kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(41, 'Jamal kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(42, 'Janta Traders', '', 5, 1, '', '', '', 'Retailer', 0),
(43, 'Kailash', '', 5, 1, '', '', '', 'Retailer', 0),
(44, 'Kanha Gifts', '', 5, 1, '', '', '', 'Retailer', 0),
(45, 'Khari Traders', '', 5, 1, '', '', '', 'Retailer', 0),
(46, 'Khurana', '', 5, 1, '', '', '', 'Retailer', 0),
(47, 'Khurana Provisional Store', '', 5, 1, '', '', '', 'Retailer', 0),
(48, 'Krishna Traders', '', 5, 1, '', '', '', 'Retailer', 0),
(49, 'Kunjamal Ramcharan', '', 5, 1, '', '', '', 'Retailer', 0),
(50, 'Madan Provision Store', '', 5, 1, '', '', '', 'Retailer', 0),
(51, 'Maheshwari Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(52, 'Mukesh', '', 5, 1, '', '', '', 'Retailer', 0),
(53, 'Naeem kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(54, 'Narendra Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(55, 'Om Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(56, 'OmPrakash RamKumar', '', 5, 1, '', '', '', 'Retailer', 0),
(57, 'Pappu Karnwal', '', 5, 1, '', '', '', 'Retailer', 0),
(58, 'Parveen Dalwala', '', 5, 1, '', '', '', 'Retailer', 0),
(59, 'Pooja Provision Store', '', 5, 1, '', '', '', 'Retailer', 0),
(60, 'Prakhash Trading Company', '', 5, 1, '', '', '', 'Retailer', 0),
(61, 'Quality kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(62, 'Radhey Mohan And Sons', '', 5, 1, '', '', '', 'Retailer', 0),
(63, 'Raj Bahadur', '', 5, 1, '', '', '', 'Retailer', 0),
(64, 'Rajeev General Store', '', 5, 1, '', '', '', 'Retailer', 0),
(66, 'Rajendra Kumar Sanjay Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(67, 'Rajkumar Sanjeev Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(68, 'Rajnikant Vipnkant', '', 5, 1, '', '', '', 'Retailer', 0),
(69, 'Ramavtar', '', 5, 1, '', '', '', 'Retailer', 0),
(70, 'Sai Super', '', 5, 1, '', '', '', 'Retailer', 0),
(71, 'Sanjeev Bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(72, 'Sanjeev Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(73, 'Sarfaraz', '', 5, 1, '', '', '', 'Retailer', 0),
(74, 'Shankar Bhojnalaya', '', 5, 1, '', '', '', 'Retailer', 0),
(75, 'Shiv Kumar Gupta', '', 5, 1, '', '', '', 'Retailer', 0),
(76, 'Singhal Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(77, 'Siraj Traders', '', 5, 1, '', '', '', 'Retailer', 0),
(78, 'Soni kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(79, 'Sukhija Provisional store', '', 5, 1, '', '', '', 'Retailer', 0),
(80, 'Sunil', '', 5, 1, '', '', '', 'Retailer', 0),
(81, 'Sunil Sweets', '', 5, 1, '', '', '', 'Retailer', 0),
(82, 'Suresh', '', 5, 1, '', '', '', 'Retailer', 0),
(83, 'Tauseef', '', 5, 1, '', '', '', 'Retailer', 0),
(84, 'Tayal Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(85, 'Teji', '', 5, 1, '', '', '', 'Retailer', 0),
(86, 'Toni Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(87, 'Tosib Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(88, 'Tripti Bhojnalay', '', 5, 1, '', '', '', 'Retailer', 0),
(89, 'True Buy', '', 5, 1, '', '', '', 'Retailer', 0),
(90, 'Uday Bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(91, 'Vaibhav kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(92, 'Varun Bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(93, 'VDSP', '', 5, 1, '', '', '', 'Retailer', 0),
(94, 'Vinay', '', 5, 1, '', '', '', 'Retailer', 0),
(95, 'Vipin Mandi', '', 5, 1, '', '', '', 'Retailer', 0),
(96, 'Vivek', '', 5, 1, '', '', '', 'Retailer', 0),
(97, 'Sudheer', '', 5, 15, '', '', '', 'Retailer', 0),
(98, 'Bharat Traders', '', 5, 16, '', '', '', 'Retailer', 0),
(99, 'Furkan Kirana Store', '', 5, 16, '', '', '', 'Retailer', 0),
(100, 'Kumar Traders', '', 5, 16, '', '', '', 'Retailer', 0),
(101, 'Malik Traders', '', 5, 16, '', '', '', 'Retailer', 0),
(102, 'Sartaaj Kirana Store', '', 5, 16, '', '', '', 'Retailer', 0),
(103, 'Dargo', '', 5, 17, '', '', '', 'Retailer', 0),
(104, 'Mahashay Ji Trading Company', '', 5, 17, '', '', '', 'Retailer', 0),
(105, 'Vivek agarwal', '', 5, 17, '', '', '', 'Retailer', 0),
(106, 'A.J Distributor', '', 5, 18, '', '', '', 'Retailer', 0),
(107, 'Amit', '', 5, 18, '', '', '', 'Retailer', 0),
(108, 'Yogesh', '', 5, 19, '', '', '', 'Retailer', 0),
(109, 'Daga Trading Company', '', 5, 20, '', '', '', 'Retailer', 0),
(110, 'Harisharan Ji', '', 5, 20, '', '', '', 'Retailer', 0),
(111, 'Nitin', '', 5, 20, '', '', '', 'Retailer', 0),
(112, 'Omkar', '', 5, 20, '', '', '', 'Retailer', 0),
(113, 'A-one Kirana', '', 5, 21, '', '', '', 'Retailer', 0),
(114, 'Abdul Samad', '', 5, 21, '', '', '', 'Retailer', 0),
(115, 'Ankur', '', 5, 21, '', '', '', 'Retailer', 0),
(116, 'Bala Ji', '', 5, 21, '', '', '', 'Retailer', 0),
(117, 'Devender', '', 5, 21, '', '', '', 'Retailer', 0),
(118, 'Manoj', '', 5, 21, '', '', '', 'Retailer', 0),
(119, 'Sanjay Kirana', '', 5, 21, '', '', '', 'Retailer', 0),
(120, 'Shiv Charan ', '', 5, 21, '', '', '', 'Retailer', 0),
(121, 'Veenu', '', 5, 21, '', '', '', 'Retailer', 0),
(122, 'Vipin', '', 5, 21, '', '', '', 'Retailer', 0),
(123, 'Yogendra', '', 5, 21, '', '', '', 'Retailer', 0),
(124, 'Muneesh', '', 5, 22, '', '', '', 'Retailer', 0),
(125, 'Pramod kumar', '', 5, 22, '', '', '', 'Retailer', 0),
(126, 'Akash', '', 5, 23, '', '', '', 'Retailer', 0),
(127, 'Bheem Agarwal', '', 5, 24, '', '', '', 'Retailer', 0),
(128, 'Kamla Rajkumar', '', 5, 25, '', '', '', 'Retailer', 0),
(129, 'Rajkumar', '', 5, 25, '', '', '', 'Retailer', 0),
(131, 'Keshavnand Narendra Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(132, 'Ajay Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(133, 'Ambe Traders', '', 5, 26, '', '', '', 'Retailer', 0),
(134, 'Ambika Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(135, 'Anmol Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(136, 'Banti Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(137, 'ChhoteLal and Sons', '', 5, 26, '', '', '', 'Retailer', 0),
(138, 'Deep Kirana Store', '', 5, 26, '', '', '', 'Retailer', 0),
(139, 'Gaurav Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(140, 'Gopichandra Kirana Store', '', 5, 26, '', '', '', 'Retailer', 0),
(141, 'Himanshu', '', 5, 26, '', '', '', 'Retailer', 0),
(142, 'Kavi Kirana Store', '', 5, 26, '', '', '', 'Retailer', 0),
(143, 'Komal Saini', '', 5, 26, '', '', '', 'Retailer', 0),
(144, 'Madan Lal Kiratpur', '', 5, 26, '', '', '', 'Retailer', 0),
(145, 'Mohit Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(146, 'Munawar Hussain', '', 5, 26, '', '', '', 'Retailer', 0),
(147, 'Naze Alam', '', 5, 26, '', '', '', 'Retailer', 0),
(148, 'Nazia Alam', '', 5, 26, '', '', '', 'Retailer', 0),
(150, 'Pulkit Rastogi', '', 5, 26, '', '', '', 'Retailer', 0),
(151, 'Ramesh Kumar Pradeep', '', 5, 26, '', '', '', 'Retailer', 0),
(152, 'Rastogi Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(153, 'Rastogi Namkeen', '', 5, 26, '', '', '', 'Retailer', 0),
(154, 'Saif Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(155, 'Saini Kirana Store', '', 5, 26, '', '', '', 'Retailer', 0),
(156, 'Sajeed Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(158, 'Sardar Kirana ', '', 5, 26, '', '', '', 'Retailer', 0),
(159, 'Sarvesh Kumar', '', 5, 26, '', '', '', 'Retailer', 0),
(160, 'Shiv Namkeen', '', 5, 26, '', '', '', 'Retailer', 0),
(161, 'Shree SatGuru Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(162, 'Shri Radhey Kirana', '', 5, 26, '', '', '', 'Retailer', 0),
(163, 'Smriti Bartan Bhandar', '', 5, 26, '', '', '', 'Retailer', 0),
(164, 'Vipin Rastogi', '', 5, 26, '', '', '', 'Retailer', 0),
(165, 'Vipul Ji', '', 5, 26, '', '', '', 'Retailer', 0),
(166, 'Vishwa', '', 5, 26, '', '', '', 'Retailer', 0),
(167, 'Wazeed Husain', '', 5, 26, '', '', '', 'Retailer', 0),
(168, 'Tyagi Traders', '', 5, 27, '', '', '', 'Retailer', 0),
(169, 'Manoj Light', '', 5, 1, '', '', '', 'Retailer', 0),
(170, 'Babu kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(171, 'Bunty Kirana', '', 5, 28, '', '', '', 'Retailer', 0),
(172, 'Jabar Singh', '', 5, 28, '', '', '', 'Retailer', 0),
(173, 'Rakesh', '', 5, 28, '', '', '', 'Retailer', 0),
(175, 'Vinod', '', 5, 1, '', '', '', 'Retailer', 0),
(176, 'Rajesh', '', 5, 1, '', '', '', 'Retailer', 0),
(177, 'Sachin', '', 5, 29, '', '', '', 'Retailer', 0),
(178, 'Siddbali Trading Company', '', 5, 29, '', '', '', 'Retailer', 0),
(179, 'Aggarwal Sales', '', 5, 30, '', '', '', 'Retailer', 0),
(180, 'Agarwal Kirana Store', '', 5, 30, '', '', '', 'Retailer', 0),
(181, 'Rahul Rajput', '', 5, 30, '', '', '', 'Retailer', 0),
(182, 'Shajad', '', 5, 30, '', '', '', 'Retailer', 0),
(184, 'Anuj kumar', '', 5, 31, '', '', '', 'Retailer', 0),
(185, 'Classic Traders', '', 5, 32, '', '', '', 'Retailer', 0),
(186, 'Eqbal', '', 5, 32, '', '', '', 'Retailer', 0),
(187, 'Furkan', '', 5, 32, '', '', '', 'Retailer', 0),
(188, 'Laeek', '', 5, 32, '', '', '', 'Retailer', 0),
(189, 'Rafeek', '', 5, 33, '', '', '', 'Retailer', 0),
(190, 'Sandeep Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(191, 'Bittu Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(192, 'Ashok', '', 5, 1, '', '', '', 'Retailer', 0),
(194, 'Gaurav', '', 5, 34, '', '', '', 'Retailer', 0),
(195, 'Niglani', '', 5, 34, '', '', '', 'Retailer', 0),
(197, 'Shiv General Store', '', 5, 1, '', '', '', 'Retailer', 0),
(198, 'Shanu kirana', '', 5, 5, '', '', '', 'Retailer', 0),
(199, 'Shaha  alam ', '', 5, 1, '', '', '', 'Retailer', 0),
(200, 'Kuldeep Ji', '', 5, 1, '', '', '', 'Retailer', 0),
(201, 'Ajay jain', '', 5, 1, '', '', '', 'Retailer', 0),
(202, 'Bhura Traders', '', 5, 1, '', '', '', 'Retailer', 0),
(203, 'Chirag Maheshwari', '', 5, 1, '', '', '', 'Retailer', 0),
(204, 'Hind Shop', '', 5, 1, '', '', '', 'Retailer', 0),
(205, 'Kelash Mandi', '', 5, 1, '', '', '', 'Retailer', 0),
(206, 'Rafat  Bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(208, 'Safeek Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(209, 'Sai namkeen', '', 5, 1, '', '', '', 'Retailer', 0),
(210, 'Saluja General Store', '', 5, 1, '', '', '', 'Retailer', 0),
(211, 'Vaisheshwar Prasad', '', 5, 1, '', '', '', 'Retailer', 0),
(212, 'Vishwa kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(213, 'Sharik ', '', 5, 1, '', '', '', 'Retailer', 0),
(214, 'Agarwal Traders', '', 5, 17, '', '', '', 'Retailer', 0),
(215, 'Vaibhav', '', 5, 18, '', '', '', 'Retailer', 0),
(216, 'Dhanga Traders', '', 5, 20, '', '', '', 'Retailer', 0),
(217, 'Jai prakash', '', 5, 26, '', '', '', 'Retailer', 0),
(218, 'Dun Confectionery', '', 5, 1, '', '', '', 'Retailer', 0),
(219, 'Arun Center', '', 5, 30, '', '', '', 'Retailer', 0),
(220, 'Mumtaz Ahmed', '', 5, 36, '', '', '', 'Retailer', 0),
(221, 'Monu Numaish', '', 5, 1, '', '', '', 'Retailer', 0),
(222, 'Sundar Lal Munshi Ram', '', 5, 37, '', '', '', 'Retailer', 0),
(223, 'A.K Enterprises', '', 5, 1, '', '', '', 'Retailer', 0),
(224, 'Aadesh', '', 5, 1, '', '', '', 'Retailer', 0),
(225, 'Abdul  Hasan', '', 5, 1, '', '', '', 'Retailer', 0),
(226, 'Abhishek', '', 5, 1, '', '', '', 'Retailer', 0),
(227, 'anuj', '', 5, 1, '', '', '', 'Retailer', 0),
(228, 'Ayush kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(229, 'B.L.A.K', '', 5, 1, '', '', '', 'Retailer', 0),
(230, 'Bablu', '', 5, 1, '', '', '', 'Retailer', 0),
(232, 'chirag nikhil', '', 5, 1, '', '', '', 'Retailer', 0),
(233, 'Deepak  chandak', '', 5, 1, '', '', '', 'Retailer', 0),
(234, 'Deepak Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(235, 'deepak mandi', '', 5, 1, '', '', '', 'Retailer', 0),
(236, 'Durga Kirana store', '', 5, 1, '', '', '', 'Retailer', 0),
(237, 'Faiz kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(238, 'Gupta Nagena', '', 5, 1, '', '', '', 'Retailer', 0),
(239, 'Ishrar', '', 5, 1, '', '', '', 'Retailer', 0),
(240, 'Israr  bure wale', '', 5, 1, '', '', '', 'Retailer', 0),
(241, 'Jai maa durga', '', 5, 1, '', '', '', 'Retailer', 0),
(242, 'jain gerenal store', '', 5, 1, '', '', '', 'Retailer', 0),
(243, 'Janta', '', 5, 1, '', '', '', 'Retailer', 0),
(244, 'Jay Prakash & Sons', '', 5, 1, '', '', '', 'Retailer', 0),
(245, 'Jethomal', '', 5, 1, '', '', '', 'Retailer', 0),
(246, 'Kalra Genera Store', '', 5, 1, '', '', '', 'Retailer', 0),
(247, 'Kartik Pooja', '', 5, 1, '', '', '', 'Retailer', 0),
(248, 'kashipur', '', 5, 1, '', '', '', 'Retailer', 0),
(249, 'Kuldeep mandawar', '', 5, 1, '', '', '', 'Retailer', 0),
(250, 'Madan  Tradres', '', 5, 1, '', '', '', 'Retailer', 0),
(251, 'Manoj Sharma', '', 5, 1, '', '', '', 'Retailer', 0),
(252, 'N.K kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(253, 'Narender Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(254, 'Om Prakash Ram Kumar', '', 5, 1, '', '', '', 'Retailer', 0),
(255, 'Pandit ji', '', 5, 1, '', '', '', 'Retailer', 0),
(256, 'Pappu bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(257, 'papuu', '', 5, 1, '', '', '', 'Retailer', 0),
(258, 'Peede wala', '', 5, 1, '', '', '', 'Retailer', 0),
(259, 'prabhat khanna', '', 5, 1, '', '', '', 'Retailer', 0),
(260, 'Prahlad karigar', '', 5, 1, '', '', '', 'Retailer', 0),
(261, 'R.B. Industries', '', 5, 1, '', '', '', 'Retailer', 0),
(262, 'Radha Kishan Bishan Dass Rang Rasayan PVT LTD', '', 5, 1, '', '', '', 'Retailer', 0),
(263, 'Rahmat kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(264, 'Rahul  kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(265, 'Rajender gautam chingari', '', 5, 1, '', '', '', 'Retailer', 0),
(266, 'Raju Dushiyant', '', 5, 1, '', '', '', 'Retailer', 0),
(267, 'Ramchandra Narendra Kishore', '', 5, 1, '', '', '', 'Retailer', 0),
(268, 'Rameesh jain', '', 5, 1, '', '', '', 'Retailer', 0),
(269, 'Samaa kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(270, 'Sammati bartan bhandar', '', 5, 1, '', '', '', 'Retailer', 0),
(271, 'Seohara khad store', '', 5, 1, '', '', '', 'Retailer', 0),
(272, 'Shaan traders', '', 5, 1, '', '', '', 'Retailer', 0),
(273, 'Shahna kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(274, 'Shajad mandi', '', 5, 1, '', '', '', 'Retailer', 0),
(275, 'Shannu Tradres', '', 5, 1, '', '', '', 'Retailer', 0),
(276, 'Shiv Kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(277, 'Shivotar bhai', '', 5, 1, '', '', '', 'Retailer', 0),
(278, 'Shorya Traders kiratpur', '', 5, 1, '', '', '', 'Retailer', 0),
(279, 'Shree Mohan Chemical Industries', '', 5, 1, '', '', '', 'Retailer', 0),
(280, 'Shubhkamna', '', 5, 1, '', '', '', 'Retailer', 0),
(281, 'Sudhakar Jain', '', 5, 1, '', '', '', 'Retailer', 0),
(282, 'sunil jain', '', 5, 1, '', '', '', 'Retailer', 0),
(283, 'Suresh Bijnor', '', 5, 1, '', '', '', 'Retailer', 0),
(284, 'Teebdi', '', 5, 1, '', '', '', 'Retailer', 0),
(285, 'Trang kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(286, 'Urmila Provision Store( Bijnor', '', 5, 1, '', '', '', 'Retailer', 0),
(287, 'Usmaan', '', 5, 1, '', '', '', 'Retailer', 0),
(288, 'Vardhman gerenal store', '', 5, 1, '', '', '', 'Retailer', 0),
(289, 'vijay kirana', '', 5, 1, '', '', '', 'Retailer', 0),
(290, 'Zunaid Kirana', '', 5, 1, '', '', '', 'Retailer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `firm`
--

CREATE TABLE `firm` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `fssai` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `ifsc` varchar(50) NOT NULL,
  `bank_address` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `signature_image` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `state_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `firm`
--

INSERT INTO `firm` (`id`, `name`, `gstin`, `address`, `fssai`, `mobile`, `bank_name`, `account_number`, `ifsc`, `bank_address`, `logo`, `signature_image`, `email`, `state`, `state_code`) VALUES
(1, 'Agarwal Provision Store', '09ACJPA8453G1ZJ', 'Chashirin Market Bulla ka chaurha bijnor 246701', 'FSSAI', '9927000878', 'IDBI', '999999', 'IDBIIFSC', 'Bijnor', '', '', '', 'Uttar Pradesh', '09');

-- --------------------------------------------------------

--
-- Table structure for table `hd_images`
--

CREATE TABLE `hd_images` (
  `product_id` int(11) NOT NULL,
  `image_url` varchar(512) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `amount` decimal(11,0) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `party_id` int(11) NOT NULL,
  `order_status` enum('New','Pending','Completed','Cancelled By Us','Cancelled By Customer') NOT NULL DEFAULT 'New',
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_mapping`
--

CREATE TABLE `order_item_mapping` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(11,0) NOT NULL,
  `price` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `amount` decimal(11,0) NOT NULL,
  `date` date NOT NULL,
  `type` enum('Cash','Sale Return','Cheque','NEFT','UPI') NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `salesman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `secondary_unit_id` int(11) NOT NULL,
  `multiplier` decimal(5,0) NOT NULL,
  `low_price` float NOT NULL,
  `max_price` float NOT NULL,
  `mrp` float NOT NULL,
  `hsn_code` int(11) NOT NULL,
  `gst_rate` float NOT NULL,
  `default_image_url` varchar(500) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `gst_price` decimal(11,0) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `unit_id`, `category_id`, `secondary_unit_id`, `multiplier`, `low_price`, `max_price`, `mrp`, `hsn_code`, `gst_rate`, `default_image_url`, `firm_id`, `gst_price`, `available`) VALUES
(1, 'Atta Bajra 500 gm', 1, 1, 1, '1', 48, 48, 0, 0, 0, '', 0, '0', 1),
(2, 'Atta Bajra Loose', 1, 1, 1, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(3, 'Atta Channa 500 gm', 1, 1, 1, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(4, 'Atta Chawal 40kg', 1, 1, 1, '1', 28, 28, 0, 0, 0, '', 0, '0', 1),
(5, 'Atta Chawal 500 gm', 1, 1, 1, '1', 48, 48, 0, 0, 0, '', 0, '0', 1),
(6, 'Atta Chawal Loose', 1, 1, 1, '1', 28, 28, 0, 0, 0, '', 0, '0', 1),
(7, 'Atta Kuttu 1 kg Plain', 1, 1, 1, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(8, 'Atta Kuttu 250 gm Radhey Radhey', 1, 1, 1, '1', 105, 105, 0, 0, 0, '', 0, '0', 1),
(9, 'Atta Kuttu Double (Loose)', 1, 1, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(10, 'Atta Kuttu Harihar 250gm', 1, 1, 1, '1', 120, 120, 0, 0, 0, '', 0, '0', 1),
(11, 'Atta Kuttu Harihar 500gm', 1, 1, 1, '1', 123, 123, 0, 0, 0, '', 0, '0', 1),
(12, 'Atta Kuttu Single (Loose)', 1, 1, 1, '1', 115, 115, 0, 0, 0, '', 0, '0', 1),
(13, 'Atta Lal Bagad 500 gm', 1, 1, 1, '1', 78, 78, 0, 0, 0, '', 0, '0', 1),
(14, 'Atta Lal Bagad Loose', 1, 1, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(15, 'Atta Makka 500 gm', 1, 1, 1, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(16, 'Atta Makka Loose', 1, 1, 1, '1', 46, 46, 0, 0, 0, '', 0, '0', 1),
(17, 'Atta Singada 200gm', 1, 1, 1, '1', 200, 200, 0, 0, 0, '', 0, '0', 1),
(18, 'Atta Singada 250 gm', 1, 1, 1, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(19, 'Premiun bisuit 200 gm(Badam  )', 4, 4, 4, '1', 46, 46, 0, 0, 0, '', 0, '0', 1),
(20, 'Premiun bisuit 200 gm(Kaju  )', 4, 4, 4, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(21, 'Premiun bisuit 200 gm(Mix Fruit )', 4, 4, 4, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(22, 'Regular bisuit 200 gm( Ajwain  )', 4, 4, 4, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(23, 'Regular bisuit 200 gm( Atta )', 4, 4, 4, '1', 36, 36, 0, 0, 0, '', 0, '0', 1),
(24, 'Regular bisuit 200 gm( Coconut )', 4, 4, 4, '1', 36, 36, 0, 0, 0, '', 0, '0', 1),
(25, 'Premium bisuit 200 gm( Honey Almond  )', 4, 4, 4, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(26, 'Regular bisuit 200 gm( Jam )', 4, 4, 4, '1', 33, 33, 0, 0, 0, '', 0, '0', 1),
(27, 'Regular bisuit 200 gm( Jeera)', 4, 4, 4, '1', 35, 35, 0, 0, 0, '', 0, '0', 1),
(28, 'Regular bisuit 200 gm( Pnut )', 4, 4, 4, '1', 35, 35, 0, 0, 0, '', 0, '0', 1),
(29, 'Regular bisuit 200 gm(Khajur  )', 4, 4, 4, '1', 35, 35, 0, 0, 0, '', 0, '0', 1),
(30, 'Regular bisuit 200 gm(Choclate  )', 4, 4, 4, '1', 35, 35, 0, 0, 0, '', 0, '0', 1),
(31, 'Regular bisuit 200 gm(Cherry  )', 4, 4, 4, '1', 35, 35, 0, 0, 0, '', 0, '0', 1),
(32, 'Regular Mix 200gm', 4, 4, 4, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(33, 'Premium Mix 200gm', 4, 4, 4, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(34, 'Baby Rusk 400gm', 4, 5, 4, '1', 64, 64, 0, 0, 0, '', 0, '0', 1),
(35, 'DD Rusk 400gm', 4, 5, 4, '1', 58.5, 58.5, 0, 0, 0, '', 0, '0', 1),
(36, 'Square Rusk 200 gm', 4, 5, 4, '1', 28, 28, 0, 0, 0, '', 0, '0', 1),
(37, 'Square Rusk 300 gm', 4, 5, 4, '1', 42, 42, 0, 0, 0, '', 0, '0', 1),
(38, 'Square Rusk 400 gm', 4, 5, 4, '1', 62, 62, 0, 0, 0, '', 0, '0', 1),
(39, 'Besan 10 kg', 1, 7, 1, '1', 80, 80, 0, 0, 0, '', 0, '0', 1),
(40, 'Besan 1kg', 1, 7, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(41, 'Besan 35 kg', 1, 7, 1, '1', 74.29, 74.29, 0, 0, 0, '', 0, '0', 1),
(42, 'Besan 500gm', 1, 7, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(43, 'Mohan Bhog Besan 35 kg', 1, 7, 1, '1', 57.14, 57.14, 0, 0, 0, '', 0, '0', 1),
(44, 'Brij Bihari Desi Ghee  Tin', 2, 10, 2, '1', 386.67, 386.67, 0, 0, 0, '', 0, '0', 1),
(45, 'Brij Bihari Desi Ghee 1L', 2, 10, 2, '1', 370, 370, 0, 0, 0, '', 0, '0', 1),
(46, 'Brij Bihari Desi Ghee 500 Ml', 2, 10, 2, '1', 400, 400, 0, 0, 0, '', 0, '0', 1),
(47, 'Desi Ghee Murli Bhog 1 Liter', 2, 10, 2, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(48, 'Desi Ghee Murli Bhog 500 ml', 2, 10, 2, '1', 270, 270, 0, 0, 0, '', 0, '0', 1),
(49, 'Desi Ghee Paran 1 Ltr', 2, 10, 2, '1', 275, 275, 0, 0, 0, '', 0, '0', 1),
(50, 'Desi Ghee Paran 500 ml', 2, 10, 2, '1', 275, 275, 0, 0, 0, '', 0, '0', 1),
(51, 'Zaina Desi Ghee 1 Liter', 2, 10, 2, '1', 360, 360, 0, 0, 0, '', 0, '0', 1),
(52, 'Zaina Desi Ghee 500ml', 2, 10, 2, '1', 360, 360, 0, 0, 0, '', 0, '0', 1),
(53, 'Green Color 100gm (Pack of 10)', 4, 14, 4, '1', 250, 250, 0, 0, 0, '', 0, '0', 1),
(54, 'Red Color 100gm (Pack of 10)', 4, 14, 4, '1', 250, 250, 0, 0, 0, '', 0, '0', 1),
(55, 'Yellow Color 100gm (Pack of 10)', 4, 14, 4, '1', 250, 250, 0, 0, 0, '', 0, '0', 1),
(56, 'Yellow Color 10gm Jar (Pack of 25)', 7, 14, 7, '1', 85, 85, 0, 0, 0, '', 0, '0', 1),
(57, 'Apple Green Color 10gm Jar (Pack of 25)', 7, 14, 7, '1', 85, 85, 0, 0, 0, '', 0, '0', 1),
(58, 'Orange Red Color 10gm Jar (Pack of 25)', 7, 14, 7, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(60, 'Dali Hing ( Pack of 50 Piece of 10gm )', 7, 25, 7, '1', 1600, 1600, 0, 0, 0, '', 0, '0', 1),
(61, 'Hing 5 gm (pack of 25)', 4, 25, 4, '1', 135, 135, 0, 0, 0, '', 0, '0', 1),
(62, 'Sakshi Hing 10gm', 7, 25, 7, '1', 1500, 1500, 0, 0, 0, '', 0, '0', 1),
(63, 'Harihar Glass Hing 100gm', 8, 26, 8, '1', 80, 80, 0, 0, 0, '', 0, '0', 1),
(64, 'Harihar Glass Hing 50 gm', 8, 26, 8, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(65, 'Harihar Plastic Hing 100gm', 8, 26, 8, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(66, 'Harihar Plastic Hing 50 gm', 8, 26, 8, '1', 35, 35, 0, 0, 0, '', 0, '0', 1),
(67, 'Harihar Katora Hing 50 gm', 8, 26, 8, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(68, 'Harihar Katora Hing 100 gm', 8, 26, 8, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(69, 'Hing Chutney', 1, 26, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(70, 'Hing Jar Special Churra', 1, 26, 1, '1', 1600, 1600, 0, 0, 0, '', 0, '0', 1),
(71, 'Kitchen Tadka 7 gm ( Pack of 10 )', 4, 26, 4, '1', 32, 32, 0, 0, 0, '', 0, '0', 1),
(72, 'Kitchen Tadka 15 gm (Pack of 10)', 4, 26, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(73, 'Kitchen Tadka 50 gm', 8, 26, 8, '1', 25, 25, 0, 0, 0, '', 0, '0', 1),
(74, 'Murli Hing 14gm (pack of 12)', 10, 26, 10, '1', 78, 78, 0, 0, 0, '', 0, '0', 1),
(75, 'Murli Hing 7gm (pack Of 12)', 10, 26, 10, '1', 39, 39, 0, 0, 0, '', 0, '0', 1),
(76, 'Radhe Radhe Hing 14gm ( Pack 0f 12 )', 10, 26, 10, '1', 78, 78, 0, 0, 0, '', 0, '0', 1),
(77, 'Radhe Radhe Hing 7gm ( Pack 0f 12 )', 10, 26, 10, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(78, 'Radhey  Radhey hing 100 gm jar ( pack of 10 )', 10, 26, 10, '1', 810, 810, 0, 0, 0, '', 0, '0', 1),
(79, 'Radhey  Radhey hing 50 gm jar ( pack of 20 )', 10, 26, 10, '1', 810, 810, 0, 0, 0, '', 0, '0', 1),
(80, 'Krishna Bihari 20gm (Pack of 12)', 10, 28, 10, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(81, 'Krishna bihari hing 10 gm ( pack of 12)', 10, 28, 10, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(82, 'Krishna bihari hing 7 gm (pack of 12)', 10, 28, 10, '1', 39, 39, 0, 0, 0, '', 0, '0', 1),
(83, 'Shiv Om Hing 100gm (Pack of 5)', 10, 31, 10, '1', 530, 530, 0, 0, 0, '', 0, '0', 1),
(84, 'Shiv Om Hing 10gm (Pack of 10)', 10, 31, 10, '1', 118, 118, 0, 0, 0, '', 0, '0', 1),
(85, 'Shiv Om Hing 200 gm', 10, 31, 10, '1', 260, 260, 0, 0, 0, '', 0, '0', 1),
(86, 'Shiv Om Hing 20gm (Pack of 10)', 10, 31, 10, '1', 240, 240, 0, 0, 0, '', 0, '0', 1),
(87, 'Shiv Om Hing 50gm (Pack of 10)', 10, 31, 10, '1', 530, 530, 0, 0, 0, '', 0, '0', 1),
(88, 'Shiv Om Hing 6gm (Pack of 10)', 10, 31, 10, '1', 86, 86, 0, 0, 0, '', 0, '0', 1),
(89, 'Shiv Om Hing 7 gm ( Pack of 10 )', 10, 31, 10, '1', 86, 86, 0, 0, 0, '', 0, '0', 1),
(90, 'Shiv Om Hing Steel 100gm', 8, 31, 8, '1', 140, 140, 0, 0, 0, '', 0, '0', 1),
(91, 'Bakey Bihari Premium 25gm', 8, 144, 8, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(92, 'Bankey Bihari Blue 100gm hing jar (pack of 10)', 7, 144, 7, '1', 1075, 1075, 0, 0, 0, '', 0, '0', 1),
(93, 'Bankey Bihari Blue 20gm hing', 10, 144, 10, '1', 202, 202, 0, 0, 0, '', 0, '0', 1),
(94, 'Bankey Bihari Blue 50gm hing (jaar)', 7, 144, 7, '1', 1100, 1100, 0, 0, 0, '', 0, '0', 1),
(95, 'Bankey Bihari Blue 50gm hing (Pack of 10)', 10, 144, 10, '1', 520, 520, 0, 0, 0, '', 0, '0', 1),
(96, 'Bankey Bihari Blue hing 100gm Plastic ( pack of 5)', 10, 144, 10, '1', 475, 475, 0, 0, 0, '', 0, '0', 1),
(97, 'Bankey Bihari Blue Hing 10gm (Pack of 12)', 10, 144, 10, '1', 95, 95, 0, 0, 0, '', 0, '0', 1),
(98, 'Bankey Bihari Blue hing 50gm Steel ( Pack Of 10)', 4, 144, 4, '1', 43, 43, 0, 0, 0, '', 0, '0', 1),
(99, 'Bankey Bihari Premium 100gm Hing', 10, 144, 10, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(100, 'Bankey Bihari Premium 10gm Hing ( Jar Of 50 Piece)', 7, 144, 7, '1', 775, 775, 0, 0, 0, '', 0, '0', 1),
(101, 'Bankey Bihari Premium 50gm', 8, 144, 8, '1', 55, 55, 0, 0, 0, '', 0, '0', 1),
(102, 'Bankey Bihari Yellow 100gm Plastic ( pack of 5)', 4, 144, 4, '1', 300, 300, 0, 0, 0, '', 0, '0', 1),
(103, 'Bankey Bihari Yellow 15gm (pack of 12)', 10, 144, 10, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(104, 'Bankey Bihari Yellow 20gm Hing (Pack of 12)', 10, 144, 10, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(105, 'Bankey Bihari Yellow 50gm (pack of 12)', 10, 144, 10, '1', 280, 280, 0, 0, 0, '', 0, '0', 1),
(106, 'Bankey Bihari Yellow 50gm Steel Hing ( Pack of 10)', 4, 144, 4, '1', 37.4, 37.4, 0, 0, 0, '', 0, '0', 1),
(107, 'Bankey Bihari Yellow 7gm Hing (Pack of 12)', 10, 144, 10, '1', 50, 50, 0, 0, 0, '', 0, '0', 1),
(108, 'Bankey Bihari Yellow Hing 10gm (Pack of 12)', 10, 144, 10, '1', 55, 55, 0, 0, 0, '', 0, '0', 1),
(109, 'Bankey Bihari Yellow Steel hing 100gm ( Pack of 5)', 4, 144, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(110, 'Tota Gold 7gm Hing ( Pack Of 10)', 4, 144, 4, '1', 240, 240, 0, 0, 0, '', 0, '0', 1),
(111, 'Tota Gold hing 10gm', 4, 144, 4, '1', 380, 380, 0, 0, 0, '', 0, '0', 1),
(112, 'Tota Super Hing 10gm ( pack of 20)', 4, 144, 4, '1', 800, 800, 0, 0, 0, '', 0, '0', 1),
(113, 'Tota Toaster hing', 4, 144, 4, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(114, 'Kitchen King 12 gm ( Pack of 10 )', 4, 46, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(115, 'Amchoor Powder 12 gm ( Pack of 10 )', 4, 46, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(116, 'Biryani Masala 12 gm ( Pack of 10 )', 4, 46, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(117, 'Chaat Masala 12 gm ( Pack of 10 )', 4, 46, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(118, 'Chana Masala 12 gm (pack of 10)', 4, 46, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(119, 'Chicken Masala 12 gm ( Pack of 10 )', 4, 46, 4, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(120, 'Garam Masala 12 gm ( Pack of 10 )', 4, 46, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(121, 'Jaljeera Masala 12gm (pack of 10)', 4, 46, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(122, 'Kasoori Methi 12 gm ( Pack of 10 )', 4, 46, 4, '1', 55, 55, 0, 0, 0, '', 0, '0', 1),
(123, 'Meat Masala 12 gm ( Pack of 10 )', 4, 46, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(124, 'Paneer Masala 12 gm ( Pack of 10 )', 4, 46, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(125, 'Panipuri Masala 12 gm ( pack of 10)', 4, 46, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(126, 'Pav bhaji Masala 12 gm ( pack of 10)', 4, 46, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(127, 'Sabji Masala 12gm ( pack of 10)', 4, 46, 4, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(128, 'Amchoor Powder 100gm', 1, 47, 1, '1', 240, 240, 0, 0, 0, '', 0, '0', 1),
(129, 'Amchoor Powder 50gm (Pack of 10)', 4, 47, 4, '1', 224, 224, 0, 0, 0, '', 0, '0', 1),
(130, 'Garam Masala 100 gm', 1, 47, 1, '1', 850, 850, 0, 0, 0, '', 0, '0', 1),
(131, 'Garam Masala 1kg', 1, 47, 1, '1', 300, 300, 0, 0, 0, '', 0, '0', 1),
(132, 'Kasoori Methi 25gm( Pack of 10)', 4, 47, 4, '1', 260, 260, 0, 0, 0, '', 0, '0', 1),
(133, 'Kasoori methi 50gm', 4, 47, 4, '1', 520, 520, 0, 0, 0, '', 0, '0', 1),
(134, 'Meat Masala 100 gm', 1, 47, 1, '1', 750, 750, 0, 0, 0, '', 0, '0', 1),
(135, 'Sauf powder Loose', 1, 47, 1, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(136, 'Sauf Powder 100gm (Pack of 10)', 1, 47, 1, '1', 520, 520, 0, 0, 0, '', 0, '0', 1),
(137, 'Sauth Powder 100gm (Pack of 10)', 1, 47, 1, '1', 360, 360, 0, 0, 0, '', 0, '0', 1),
(138, 'Sauth Powder 50 gm', 4, 47, 4, '1', 9.5, 9.5, 0, 0, 0, '', 0, '0', 1),
(139, 'White Pepper Powder 100gm', 1, 47, 1, '1', 1000, 1000, 0, 0, 0, '', 0, '0', 1),
(140, 'Masala 5Rs (pack of 10)', 4, 49, 4, '1', 57.6, 57.6, 0, 0, 0, '', 0, '0', 1),
(141, 'Meat Masala 6 gm(pack of 20 )', 4, 49, 4, '1', 65, 65, 0, 0, 0, '', 0, '0', 1),
(142, 'Dhaniya 1 Kg', 1, 52, 1, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(143, 'Dhaniya 10 kg', 1, 52, 1, '1', 85, 85, 0, 0, 0, '', 0, '0', 1),
(144, 'Dhaniya 100 gm', 1, 52, 1, '1', 145, 145, 0, 0, 0, '', 0, '0', 1),
(145, 'Dhaniya 200 gm', 1, 52, 1, '1', 130, 130, 0, 0, 0, '', 0, '0', 1),
(146, 'Dhaniya 25 kg', 1, 52, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(147, 'Dhaniya 40 gm ( Pack of 20 Piece )', 4, 52, 4, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(148, 'Dhaniya 5 kg', 1, 52, 1, '1', 85, 85, 0, 0, 0, '', 0, '0', 1),
(149, 'Dhaniya 50 gm', 1, 52, 1, '1', 140, 140, 0, 0, 0, '', 0, '0', 1),
(150, 'Dhaniya Gold 10kg', 1, 52, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(151, 'Dhaniya Gold 25kg', 1, 52, 1, '1', 130, 130, 0, 0, 0, '', 0, '0', 1),
(152, 'Dhaniya Gold 5kg', 1, 52, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(153, 'Haldi 1 Kg', 1, 52, 1, '1', 300, 300, 0, 0, 0, '', 0, '0', 1),
(154, 'Haldi 10 kg', 1, 52, 1, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(155, 'Haldi 100 gm', 1, 52, 1, '1', 175, 175, 0, 0, 0, '', 0, '0', 1),
(156, 'Haldi 200 gm', 1, 52, 1, '1', 170, 170, 0, 0, 0, '', 0, '0', 1),
(157, 'Haldi 25 kg', 1, 52, 1, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(158, 'Haldi 40 gm ( Pack of 20 Piece )', 4, 52, 4, '1', 140, 140, 0, 0, 0, '', 0, '0', 1),
(159, 'Haldi 5 kg', 1, 52, 1, '1', 145, 145, 0, 0, 0, '', 0, '0', 1),
(160, 'Haldi 50 gm', 1, 52, 1, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(161, 'Haldi 500 gm', 1, 52, 1, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(162, 'Haldi Gold 10kg', 1, 52, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(163, 'Haldi Gold 25kg', 1, 52, 1, '1', 120, 120, 0, 0, 0, '', 0, '0', 1),
(164, 'Haldi Gold 5kg', 1, 52, 1, '1', 165, 165, 0, 0, 0, '', 0, '0', 1),
(165, 'Mirch 25 gm ( Pack of 20 Pcs )', 4, 52, 4, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(166, 'Mirch 25 kg', 1, 52, 1, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(167, 'Mirchi Khamkham 500gm', 1, 52, 1, '1', 180, 180, 0, 0, 0, '', 0, '0', 1),
(168, 'Mirch Powder 10kg Diamond', 1, 52, 1, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(169, 'Mirch Powder 25 kg Diamond', 1, 52, 1, '1', 175, 175, 0, 0, 0, '', 0, '0', 1),
(170, 'Mirch Powder 5kg Diamond', 1, 52, 1, '1', 300, 300, 0, 0, 0, '', 0, '0', 1),
(171, 'Mirchi 10 kg', 1, 52, 1, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(172, 'Mirchi 100 gm', 1, 52, 1, '1', 285, 285, 0, 0, 0, '', 0, '0', 1),
(173, 'Mirchi 200 gm', 1, 52, 1, '1', 280, 280, 0, 0, 0, '', 0, '0', 1),
(174, 'Mirchi 5 kg', 1, 52, 1, '1', 200, 200, 0, 0, 0, '', 0, '0', 1),
(175, 'Mirchi 50 gm', 1, 52, 1, '1', 290, 290, 0, 0, 0, '', 0, '0', 1),
(176, 'Mirchi Khamkham 1kg', 1, 52, 1, '1', 245, 245, 0, 0, 0, '', 0, '0', 1),
(177, 'Mirchi Kuti Khamkham 1kg', 1, 52, 1, '1', 245, 245, 0, 0, 0, '', 0, '0', 1),
(178, 'Mirchi Gold 10kg', 1, 52, 1, '1', 260, 260, 0, 0, 0, '', 0, '0', 1),
(179, 'Mirchi Gold 25 kg', 1, 52, 1, '1', 280, 280, 0, 0, 0, '', 0, '0', 1),
(180, 'Mirchi Gold 5kg', 1, 52, 1, '1', 220, 220, 0, 0, 0, '', 0, '0', 1),
(181, 'Mirchi kuti 10 kg', 1, 52, 1, '1', 240, 240, 0, 0, 0, '', 0, '0', 1),
(182, 'Mirchi kuti 100 gm', 1, 52, 1, '1', 285, 285, 0, 0, 0, '', 0, '0', 1),
(183, 'Mirchi kuti 200 gm', 1, 52, 1, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(184, 'Mirchi kuti 25 kg', 1, 52, 1, '1', 210, 210, 0, 0, 0, '', 0, '0', 1),
(185, 'Mirchi Kuti 5kg', 1, 52, 1, '1', 260, 260, 0, 0, 0, '', 0, '0', 1),
(186, 'Peeli Mirch 10 kg', 1, 52, 1, '1', 240, 240, 0, 0, 0, '', 0, '0', 1),
(187, 'Peeli Mirch 1kg', 1, 52, 1, '1', 220, 220, 0, 0, 0, '', 0, '0', 1),
(188, 'Peeli Mirch 25Kg', 1, 52, 1, '1', 210, 210, 0, 0, 0, '', 0, '0', 1),
(189, 'Peeli Mirch 500 gm', 1, 52, 1, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(190, 'Peeli Mirch 5Kg', 1, 52, 1, '1', 220, 220, 0, 0, 0, '', 0, '0', 1),
(191, 'Ajwain 100 gm', 1, 56, 1, '1', 260, 260, 0, 0, 0, '', 0, '0', 1),
(192, 'Ajwain 50 gm', 1, 56, 1, '1', 264, 264, 0, 0, 0, '', 0, '0', 1),
(193, 'Jeera  50 gm', 1, 56, 1, '1', 735, 735, 0, 0, 0, '', 0, '0', 1),
(194, 'Jeera 100gm', 1, 56, 1, '1', 820, 820, 0, 0, 0, '', 0, '0', 1),
(195, 'Jeera sabut 200gm', 1, 56, 1, '1', 730, 730, 0, 0, 0, '', 0, '0', 1),
(196, 'Jeera sabut Loose', 1, 56, 1, '1', 750, 750, 0, 0, 0, '', 0, '0', 1),
(197, 'Kali Mirch 100gm', 1, 56, 1, '1', 820, 820, 0, 0, 0, '', 0, '0', 1),
(198, 'Kali Mirch 50gm', 4, 56, 4, '1', 820, 820, 0, 0, 0, '', 0, '0', 1),
(199, 'Kasoori Methi Loose', 1, 56, 1, '1', 390, 390, 0, 0, 0, '', 0, '0', 1),
(200, 'Methi 50 gm', 1, 56, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(201, 'Methi Dana Loose', 1, 56, 1, '1', 110, 110, 0, 0, 0, '', 0, '0', 1),
(202, 'Rai 50 gm', 1, 56, 1, '1', 214, 214, 0, 0, 0, '', 0, '0', 1),
(203, 'Sabut Garam Masala 100gm', 1, 56, 1, '1', 550, 550, 0, 0, 0, '', 0, '0', 1),
(204, 'Sabut Garam Masala 50gm', 1, 56, 1, '1', 550, 550, 0, 0, 0, '', 0, '0', 1),
(205, 'Sauf Sabut Loose', 1, 56, 1, '1', 260, 260, 0, 0, 0, '', 0, '0', 1),
(206, 'Tejpatta', 1, 56, 1, '1', 180, 180, 0, 0, 0, '', 0, '0', 1),
(207, 'Cheetah Kala Namak 1kg', 1, 67, 1, '1', 15, 15, 0, 0, 0, '', 0, '0', 1),
(208, 'Cheetah Kala Namak 200 gm', 1, 67, 1, '1', 14, 14, 0, 0, 0, '', 0, '0', 1),
(209, 'Cheetah Kala Namak 500 gm', 1, 67, 1, '1', 14, 14, 0, 0, 0, '', 0, '0', 1),
(210, 'Harihar kala namak 200gm', 1, 67, 1, '1', 36, 36, 0, 0, 0, '', 0, '0', 1),
(211, 'Harihar Kala Namak Sabut 1kg (Pack of 25kg)', 1, 67, 1, '1', 34, 34, 0, 0, 0, '', 0, '0', 1),
(212, 'Cheetah Kala Namak 100gm', 1, 67, 1, '1', 12.5, 12.5, 0, 0, 0, '', 0, '0', 1),
(213, 'Kala Namak Crystal Loose (Pack of 30kg)', 1, 67, 1, '1', 26, 26, 0, 0, 0, '', 0, '0', 1),
(214, 'Kala Namak Virat 200gm(Pack of 30kg)', 1, 67, 1, '1', 30, 30, 0, 0, 0, '', 0, '0', 1),
(215, 'MTV 200gm Black Salt', 1, 67, 1, '1', 32, 32, 0, 0, 0, '', 0, '0', 1),
(216, 'MTV Black Salt 1KG', 1, 67, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(217, 'Virat Black Salt  Sabut 1 kg', 1, 67, 1, '1', 32, 32, 0, 0, 0, '', 0, '0', 1),
(218, 'Harihar Sendha Namak 1kg', 1, 68, 1, '1', 32, 32, 0, 0, 0, '', 0, '0', 1),
(219, 'Harihar Sendha Namak 200 gm', 1, 68, 1, '1', 36, 36, 0, 0, 0, '', 0, '0', 1),
(220, 'Harihar Sendha Namak Loose', 1, 68, 1, '1', 25, 25, 0, 0, 0, '', 0, '0', 1),
(221, 'MTV Senda Namak 1KG', 1, 68, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(222, 'Sendha Namak seep 1 kg', 1, 68, 1, '1', 18, 18, 0, 0, 0, '', 0, '0', 1),
(223, 'Sendha Namak seep 100gm', 1, 68, 1, '1', 21, 21, 0, 0, 0, '', 0, '0', 1),
(224, 'Sendha Namak seep 200 gm', 1, 68, 1, '1', 21, 21, 0, 0, 0, '', 0, '0', 1),
(225, 'Sendha Pakistani Sabut', 1, 68, 1, '1', 22, 22, 0, 0, 0, '', 0, '0', 1),
(226, 'Sendha Sabut Irani ( Pack of 30 Kg )', 1, 68, 1, '1', 14, 14, 0, 0, 0, '', 0, '0', 1),
(227, 'Virat Sendha Namak 1 kg', 1, 68, 1, '1', 38, 38, 0, 0, 0, '', 0, '0', 1),
(228, 'Virat sendha namak 200 gm', 1, 68, 1, '1', 34, 34, 0, 0, 0, '', 0, '0', 1),
(229, 'Ararot 50kg', 1, 70, 1, '1', 44, 44, 0, 0, 0, '', 0, '0', 1),
(230, 'Ararot Loose', 1, 70, 1, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(231, 'Channa chuni ( Bag of 35 kg )', 1, 70, 1, '1', 22.86, 22.86, 0, 0, 0, '', 0, '0', 1),
(232, 'Chatpata Masala Loose', 1, 70, 1, '1', 120, 120, 0, 0, 0, '', 0, '0', 1),
(233, 'Cholai 14 kg', 1, 70, 1, '1', 155, 155, 0, 0, 0, '', 0, '0', 1),
(234, 'Cholai 28 Kg', 1, 70, 1, '1', 114, 114, 0, 0, 0, '', 0, '0', 1),
(235, 'Chuni 40kg', 1, 70, 1, '1', 22.5, 22.5, 0, 0, 0, '', 0, '0', 1),
(236, 'coffee', 1, 70, 1, '1', 1320, 1320, 0, 0, 0, '', 0, '0', 1),
(237, 'Dal Chana (Pack of 30kg)', 1, 70, 1, '1', 59, 59, 0, 0, 0, '', 0, '0', 1),
(238, 'Fitkari 25kg', 1, 70, 1, '1', 20, 20, 0, 0, 0, '', 0, '0', 1),
(239, 'Gulab Jal 250 Ml', 4, 70, 4, '1', 96, 96, 0, 0, 0, '', 0, '0', 1),
(240, 'Gulab Jal 30 Ml (Pack of 12)', 4, 70, 4, '1', 360, 360, 0, 0, 0, '', 0, '0', 1),
(241, 'Haeed choti', 1, 70, 1, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(242, 'Jaifal', 1, 70, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(243, 'Jawe', 1, 70, 1, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(244, 'Kalongi Loose', 1, 70, 1, '1', 180, 180, 0, 0, 0, '', 0, '0', 1),
(245, 'Kewada 250ml', 4, 70, 4, '1', 28, 28, 0, 0, 0, '', 0, '0', 1),
(246, 'Kuttu Chilka', 1, 70, 1, '1', 5, 5, 0, 0, 0, '', 0, '0', 1),
(247, 'Long', 1, 70, 1, '1', 840, 840, 0, 0, 0, '', 0, '0', 1),
(248, 'Lunch Box', 8, 70, 8, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(249, 'Macroni', 1, 70, 1, '1', 42.5, 42.5, 0, 0, 0, '', 0, '0', 1),
(250, 'Multani Mitti', 1, 70, 1, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(251, 'Parmal', 1, 70, 1, '1', 330, 330, 0, 0, 0, '', 0, '0', 1),
(252, 'Pasta', 1, 70, 1, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(253, 'Sabut Kuttu 50 Kg', 1, 70, 1, '1', 2950, 2950, 0, 0, 0, '', 0, '0', 1),
(254, 'Steel Plate', 8, 70, 8, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(255, 'Tarbuj beej', 1, 70, 1, '1', 370, 370, 0, 0, 0, '', 0, '0', 1),
(256, 'Towel', 8, 70, 8, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(257, 'Tub', 8, 70, 8, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(258, 'Bankey Bihari Chandan 50gm (Pack of 10 )', 4, 77, 4, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(259, 'Chandan Tikka 40gm (pack of 10)', 4, 77, 4, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(260, 'Prayagraj Chandan Tikka 40gm', 8, 77, 8, '1', 120, 120, 0, 0, 0, '', 0, '0', 1),
(261, 'Tota Chandan paste 40gm (Pack of 10)', 4, 77, 4, '1', 125, 125, 0, 0, 0, '', 0, '0', 1),
(262, 'Tota Chandan Tikka 100gm', 4, 77, 4, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(263, 'Tulsi Chandan tikka 25gm', 4, 77, 4, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(264, 'Bankey Bihari Premium Dhoop Bati', 4, 78, 4, '1', 96, 96, 0, 0, 0, '', 0, '0', 1),
(265, 'Sai Dhoop', 11, 78, 11, '1', 96, 96, 0, 0, 0, '', 0, '0', 1),
(266, 'Sai Dhoop 80gm', 11, 78, 11, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(267, 'Tota Dhoop Bati', 4, 78, 4, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(268, 'Zipper Dhoop Bati', 11, 78, 11, '1', 180, 180, 0, 0, 0, '', 0, '0', 1),
(269, 'Hawan  Samagri 1 kg', 1, 80, 1, '1', 54, 54, 0, 0, 0, '', 0, '0', 1),
(270, 'Hawan  Samagri Sadhu 500 gm', 1, 80, 1, '1', 36, 36, 0, 0, 0, '', 0, '0', 1),
(271, 'Hawan Samagri 100gm (Pack of 10)', 1, 80, 1, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(272, 'Hawan Samagri 200 gm', 4, 80, 4, '1', 15, 15, 0, 0, 0, '', 0, '0', 1),
(273, 'Hawan Samagri 250 gm', 1, 80, 1, '1', 48, 48, 0, 0, 0, '', 0, '0', 1),
(274, 'Hawan Samagri 500 gm', 1, 80, 1, '1', 56, 56, 0, 0, 0, '', 0, '0', 1),
(275, 'Hawan Samagri 50gm (Pack of 10)', 4, 80, 4, '1', 48, 48, 0, 0, 0, '', 0, '0', 1),
(276, 'Hawan Samagri Sadhu 1 kg', 1, 80, 1, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(277, 'Radhey Radhey Hawan Samagri 100 gm ( Pack of 10 )', 1, 80, 1, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(278, 'Radhey Radhey Hawan Samagri 50 gm ( Pack of 10 )', 4, 80, 4, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(279, 'HariHar Kalawa  (Pack of 25 piece)', 4, 83, 4, '1', 70, 70, 0, 0, 0, '', 0, '0', 1),
(280, 'Harihar Kalawa 80 Piece', 7, 83, 7, '1', 250, 250, 0, 0, 0, '', 0, '0', 1),
(281, 'Tota Kalawa 10 Rs ( Jar of 50piece)', 7, 83, 7, '1', 250, 250, 0, 0, 0, '', 0, '0', 1),
(282, 'Tota Moli Kalawa Dabba (Pack of 10pcs)', 4, 83, 4, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(283, 'Ambika Kapoor Jar of 100 Piece', 4, 87, 4, '1', 520, 520, 0, 0, 0, '', 0, '0', 1),
(284, 'Harihar Bheemseni Kapoor 100gm', 8, 87, 8, '1', 95, 95, 0, 0, 0, '', 0, '0', 1),
(285, 'Harihar Bheemseni Kapoor 50gm', 8, 87, 8, '1', 75, 75, 0, 0, 0, '', 0, '0', 1),
(286, 'Harihar Kapoor 100 gm', 8, 87, 8, '1', 95, 95, 0, 0, 0, '', 0, '0', 1),
(287, 'Harihar Kapoor 10gm', 11, 87, 11, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(288, 'Harihar kapoor 20 gm', 11, 87, 11, '1', 24, 24, 0, 0, 0, '', 0, '0', 1),
(289, 'Harihar kapoor 50 gm', 8, 87, 8, '1', 40, 40, 0, 0, 0, '', 0, '0', 1),
(290, 'HariHar Kapoor Jar Rs. 10 ( Pack of 50 )', 7, 87, 7, '1', 400, 400, 0, 0, 0, '', 0, '0', 1),
(291, 'Kapoor 2gm', 4, 87, 4, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(292, 'Kapoor 4gm', 4, 87, 4, '1', 62, 62, 0, 0, 0, '', 0, '0', 1),
(293, 'Kapoor Bheemsaini Loose', 1, 87, 1, '1', 1200, 1200, 0, 0, 0, '', 0, '0', 1),
(294, 'Maa Durga Kapoor 50gm', 8, 87, 8, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(295, 'Maa Durga Kapoor 100gm', 8, 87, 8, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(296, 'Maa Durga Kapoor Jar(Pack Of 50)', 7, 87, 7, '1', 320, 320, 0, 0, 0, '', 0, '0', 1),
(297, 'Maa Kaali kapoor tikki', 4, 87, 4, '1', 95, 95, 0, 0, 0, '', 0, '0', 1),
(298, 'Slab kapoor 50gm', 8, 87, 8, '1', 37.5, 37.5, 0, 0, 0, '', 0, '0', 1),
(302, 'Tota kapoor 100gm', 8, 87, 8, '1', 85, 85, 0, 0, 0, '', 0, '0', 1),
(303, 'Tota Kapoor 10gm', 11, 87, 11, '1', 15, 15, 0, 0, 0, '', 0, '0', 1),
(304, 'Tota Kapoor 25gm', 11, 87, 11, '1', 336, 336, 0, 0, 0, '', 0, '0', 1),
(305, 'Tota kapoor 4gm', 4, 87, 4, '1', 0, 0, 0, 0, 0, '', 0, '0', 1),
(306, 'Tota Kapoor 50gm', 8, 87, 8, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(307, 'Tota Kapoor 555 Jar', 7, 87, 7, '1', 700, 700, 0, 0, 0, '', 0, '0', 1),
(308, 'Tota Slab Kapoor 100gm', 8, 87, 8, '1', 80, 80, 0, 0, 0, '', 0, '0', 1),
(309, 'Tota Slab Kapoor 50gm', 8, 87, 8, '1', 30, 30, 0, 0, 0, '', 0, '0', 1),
(310, 'Devdhar Puja Ghee 1l', 2, 92, 2, '1', 180, 180, 0, 0, 0, '', 0, '0', 1),
(311, 'Devdhar Puja Ghee 200 ml', 2, 92, 2, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(312, 'Devdhar Puja ghee 500ml', 2, 92, 2, '1', 185, 185, 0, 0, 0, '', 0, '0', 1),
(313, 'Devdhar Tetra 1 L', 2, 92, 2, '1', 155, 155, 0, 0, 0, '', 0, '0', 1),
(314, 'Devdhar Tetra 500Ml', 2, 92, 2, '1', 175, 175, 0, 0, 0, '', 0, '0', 1),
(315, 'Madhu Shivam Ghee 200 Ml', 2, 92, 2, '1', 160, 160, 0, 0, 0, '', 0, '0', 1),
(316, 'Madhu Shivam Puja Ghee 1Litre', 2, 92, 2, '1', 140, 140, 0, 0, 0, '', 0, '0', 1),
(317, 'Madhu Shivam Puja Ghee 500 Ml', 2, 92, 2, '1', 155, 155, 0, 0, 0, '', 0, '0', 1),
(318, 'Pyare Mohan 1L', 2, 92, 2, '1', 90, 90, 0, 0, 0, '', 0, '0', 1),
(319, 'Pyare Mohan 200 Ml', 2, 92, 2, '1', 92, 92, 0, 0, 0, '', 0, '0', 1),
(320, 'Pyare Mohan 500 Ml', 2, 92, 2, '1', 92, 92, 0, 0, 0, '', 0, '0', 1),
(321, 'Trishul Ghee 1 Ltr', 2, 92, 2, '1', 200, 200, 0, 0, 0, '', 0, '0', 1),
(322, 'Trishul Ghee 200 ml', 2, 92, 2, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(323, 'Trishul Ghee 500 ml', 2, 92, 2, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(324, 'Vrinda pooja  Ghee 500 Ml', 2, 92, 2, '1', 185, 185, 0, 0, 0, '', 0, '0', 1),
(325, 'Vrinda pooja Ghee 1 liter', 2, 92, 2, '1', 180, 180, 0, 0, 0, '', 0, '0', 1),
(326, 'Vrinda Puja Ghee 200ml', 2, 92, 2, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(327, 'Rangoli simple 100 gm (pack of 10 )', 4, 98, 4, '1', 80, 80, 0, 0, 0, '', 0, '0', 1),
(328, 'Bankey Bihari Kumkum Roli 10gm', 4, 105, 4, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(329, 'Marwadi Roli 2 Rs. ( Pack of 50 Pcs )', 4, 105, 4, '1', 75, 75, 0, 0, 0, '', 0, '0', 1),
(330, 'Marwari Roli 5 Rs', 4, 105, 4, '1', 60, 60, 0, 0, 0, '', 0, '0', 1),
(331, 'Roli Chawal', 4, 105, 4, '1', 45, 45, 0, 0, 0, '', 0, '0', 1),
(332, 'Tota Kumkum Roli 1 kg', 1, 105, 1, '1', 125, 125, 0, 0, 0, '', 0, '0', 1),
(333, 'Tota Kumkum Roli 10gm ( Pack of 50 )', 4, 105, 4, '1', 130, 130, 0, 0, 0, '', 0, '0', 1),
(334, 'Tota Kumkum Roli 5Rs', 4, 105, 4, '1', 5.5, 5.5, 0, 0, 0, '', 0, '0', 1),
(335, 'Tota Roli 20gm( pack of 10)', 4, 105, 4, '1', 149.14, 149.14, 0, 0, 0, '', 0, '0', 1),
(336, 'Tota Roli 25gm dabbi ( Pack Of 12)', 4, 105, 4, '1', 6, 6, 0, 0, 0, '', 0, '0', 1),
(337, 'Tulsi Roli 15 gm (pack of 50)', 4, 105, 4, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(338, 'Tota Ghee Batti ( Pack of 50 Piece )', 4, 113, 4, '1', 15.7, 15.7, 0, 0, 0, '', 0, '0', 1),
(339, 'Marwadi Sindoor 5 Rs', 4, 122, 4, '1', 75, 75, 0, 0, 0, '', 0, '0', 1),
(340, 'Tota Pooja Sindoor 10gm', 4, 122, 4, '1', 100, 100, 0, 0, 0, '', 0, '0', 1),
(341, 'Tota Sindoor 1 kg', 1, 122, 1, '1', 340, 340, 0, 0, 0, '', 0, '0', 1),
(342, 'Tota Sindoor 100gm', 4, 122, 4, '1', 46, 46, 0, 0, 0, '', 0, '0', 1),
(343, 'Tota Sindoor 20gm', 4, 122, 4, '1', 6, 6, 0, 0, 0, '', 0, '0', 1),
(344, 'Tota Sindoor 25gm Dabbi ( pack of 12)', 4, 122, 4, '1', 150, 150, 0, 0, 0, '', 0, '0', 1),
(345, 'Tota Sindoor 50gm', 4, 122, 4, '1', 25, 25, 0, 0, 0, '', 0, '0', 1),
(346, 'Tulsi Pooja Sindoor 20gm (pack of 50)', 4, 122, 4, '1', 190, 190, 0, 0, 0, '', 0, '0', 1),
(347, 'Murli Til 0il 200ml', 2, 132, 2, '1', 135, 135, 0, 0, 0, '', 0, '0', 1),
(348, 'Murli Til 0il 900ml', 2, 132, 2, '1', 125, 125, 0, 0, 0, '', 0, '0', 1),
(349, 'Murli Til Oil 450ml', 2, 132, 2, '1', 125, 125, 0, 0, 0, '', 0, '0', 1),
(350, 'Til Oil DM Gold 1L', 2, 132, 2, '1', 113.33, 113.33, 0, 0, 0, '', 0, '0', 1),
(351, 'TiL Oil DM Gold 500ml', 2, 132, 2, '1', 73, 73, 0, 0, 0, '', 0, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(5, 'Accountant'),
(1, 'Admin'),
(4, 'Salesman');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state`) VALUES
(5, 'Uttar Pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(10, 'Box'),
(11, 'Dozen'),
(7, 'Jar'),
(1, 'Kg'),
(2, 'Litre'),
(4, 'Packet'),
(8, 'Pieces');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `token` varchar(512) NOT NULL,
  `token_creation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mobile_number`, `email`, `role`, `token`, `token_creation_time`) VALUES
(5, 'mahipal', '$2y$10$INSaReKL0loiDHz5UToWcOyGNJz0A1ZRej9zLDWIKADIHHDdbW5gm', '9927888787', 'mahipal', 4, 'eb49caf80ff081e13075389f1678c42807cc4deb5fe13daec6f9bc933488672a', '2023-11-13 08:38:23'),
(6, 'Admin', '$2y$10$INSaReKL0loiDHz5UToWcOyGNJz0A1ZRej9zLDWIKADIHHDdbW5gm', '123', 'harshit.agarwal@gmail.com', 1, '0638809a8a3ff2b3beb437305cf9617d0343696369597cb8679ed2bba3bda6c2', '2023-11-15 06:07:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `firm`
--
ALTER TABLE `firm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gstin` (`gstin`),
  ADD UNIQUE KEY `fssai` (`fssai`);

--
-- Indexes for table `hd_images`
--
ALTER TABLE `hd_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number_unique` (`invoice_number`,`year`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `party_id` (`party_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salesman_id` (`salesman_id`),
  ADD KEY `party_id` (`party_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `order_item_mapping`
--
ALTER TABLE `order_item_mapping`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`),
  ADD UNIQUE KEY `party_id` (`party_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `secondary_unit_id` (`secondary_unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state` (`state`),
  ADD KEY `state_2` (`state`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `firm`
--
ALTER TABLE `firm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hd_images`
--
ALTER TABLE `hd_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `hd_images`
--
ALTER TABLE `hd_images`
  ADD CONSTRAINT `hd_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`party_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `user` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`party_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `order_item_mapping`
--
ALTER TABLE `order_item_mapping`
  ADD CONSTRAINT `order_item_mapping_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_item_mapping_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`party_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`salesman_id`) REFERENCES `user` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`secondary_unit_id`) REFERENCES `units` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
