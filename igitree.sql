-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 04:06 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `igitree`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_phoneNumber` varchar(100) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_role` varchar(100) NOT NULL,
  `admin_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`, `admin_phoneNumber`, `admin_image`, `admin_role`, `admin_status`) VALUES
(1, 'Administrator', 'admin@igitree.com', '4f197c99a78b8411f1cf48ab409a0a6d176b99b7', '', '', 'account.jpg', 'super', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chats`
--

CREATE TABLE `tbl_chats` (
  `c_id` int(11) NOT NULL,
  `c_sender` varchar(11) NOT NULL,
  `c_recipient` varchar(11) NOT NULL,
  `c_message` text NOT NULL,
  `c_image` varchar(100) NOT NULL,
  `c_date` datetime NOT NULL,
  `c_device` varchar(100) NOT NULL,
  `c_os_type` varchar(20) NOT NULL,
  `c_status` enum('0','1','2','3') NOT NULL COMMENT '0 sent but not received, 1 for received but not read, 2 for received and read'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chats`
--

INSERT INTO `tbl_chats` (`c_id`, `c_sender`, `c_recipient`, `c_message`, `c_image`, `c_date`, `c_device`, `c_os_type`, `c_status`) VALUES
(1, '2', '1', 'Hi', '', '2018-09-03 02:20:55', '', '', '2'),
(2, '1', '2', 'Alright', '', '2018-09-03 02:21:08', '', '', '2'),
(3, '3', '1', 'Yo', '', '2018-09-03 05:53:30', '', '', '2'),
(4, '2', '1', 'Let me kno wen', '', '2018-09-03 07:35:30', '', '', '2'),
(5, '1', '2', 'Sawa... will let you know', '', '2018-09-03 07:36:02', '', '', '2'),
(6, '1', '3', 'ðŸ˜…ðŸ˜…', '', '2018-09-03 07:36:22', '', '', '2'),
(7, '1', '3', 'You sent me a message', '', '2018-09-03 07:36:31', '7B7C88EB-5C09-466D-ACF6-2B4845A0DADC', 'Android', '2'),
(8, '1', '3', 'Hey....', '', '2018-09-03 22:52:26', '', '', '2'),
(9, '1', '3', 'Really...', '', '2018-09-03 22:53:23', '', '', '2'),
(10, '3', '1', 'I see the light', '', '2018-09-06 05:53:30', '', '', '2'),
(11, '3', '1', 'I see the message', '', '2018-09-06 05:53:30', '', '', '2'),
(12, '2', '1', 'Are we there yet?', '', '2018-09-07 10:51:43', '', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactmessages`
--

CREATE TABLE `tbl_contactmessages` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(65) DEFAULT NULL,
  `m_email` varchar(65) DEFAULT NULL,
  `m_message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contactmessages`
--

INSERT INTO `tbl_contactmessages` (`m_id`, `m_name`, `m_email`, `m_message`) VALUES
(1, 'Keneth', 'kampala@gmail.com', '        Message\r\n      My Msg'),
(2, 'Mwesigwa David', 'mytest@gmail.com', '        Message\r\n      Ttttt Wbxcbxcx Cvdvdc Dvcvcx  C C Cv Cvxcv Xcvxc Vvxcv Xcvxc Vxcc Xvxc Vcx');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `c_id` int(11) NOT NULL,
  `c_content` longtext,
  `c_type` varchar(30) NOT NULL,
  `c_title` varchar(200) DEFAULT NULL,
  `c_image` varchar(50) DEFAULT NULL,
  `c_added_at` datetime DEFAULT NULL,
  `c_added_by` int(11) NOT NULL,
  `c_last_edited_at` datetime NOT NULL,
  `c_last_edited_by` int(11) NOT NULL,
  `c_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`c_id`, `c_content`, `c_type`, `c_title`, `c_image`, `c_added_at`, `c_added_by`, `c_last_edited_at`, `c_last_edited_by`, `c_status`) VALUES
(8, '<p>A genealogy phone application, originates from Rwanda, the word &lsquo;IGITI&rsquo; meaning a tree, and the english word &lsquo;TREE&rsquo; merged together to form &ldquo;igiTREE&rdquo;.</p>\r\n\r\n<p><br />\r\nFounder is Deexon Muhizi an East African entrepreneur. Having grown up a global citizen in Uganda, Rwanda, Burundi and Kenya he worked with BLU FLAMINGO, INDEPENDENT, FENON and founded FOOTPRINTS AFRICA a corporate communications and marketing company, based in three countries of East Africa. And he is currently the M.D of FOOTPRINTS Africa.</p>\r\n\r\n<p><br />\r\nAs more people around the world begin to rely on their smartphones for all aspects of their lives, we IGITREE we give you a Lineage platform from Rwanda, world&rsquo;s free genealogy, ancestry and family tree creator, research phone Application / website, helping you find your ancestors, discover your family members, their careers and titles history&hellip; here you connect the past with the present.</p>\r\n\r\n<p><br />\r\nIGITREE<br />\r\nIGITREE.com will also be available, this capability will be assisting people who do not have smart phones to participate in the global genealogy, through their computers.</p>\r\n\r\n<p><br />\r\nigiTREE a platform to reconnect and build bonding.</p>', 'Igitree Overview', NULL, NULL, '2018-10-11 02:32:04', 0, '2018-10-12 04:03:00', 0, 1),
(9, '<p>World&rsquo;s Resource For Online Family History &amp; Genealogy, Build Family Tree, Re-connect With Family Members And Make The Family History Live Forever.<br />\r\nShare Family Stories With Your Children At Bedtime Or At A Vacation. Use Your Free Time To Learn A Few New Things About Your Family, As Your Other Relatives, Grow The Records And Tree Information. Take The IgiTREE App To Family Reunions, Or Events, And Capture Record Stories You Have Never Heard Before, Collect From Parents And Grandparents, Information About Their Lives And What They Remember About Their Deceased Relatives.</p>\r\n\r\n<p>Watch How Stories Of Your Ancestors&rsquo; Hardships, Endurance And Faith Help You Become A Better Person.<br />\r\nFind Your Long-lost Ancestors By Providing Your DNA, And Build Your Family Tree.</p>\r\n\r\n<p>igiTREE Will Be The Best Way To Find And Share Meaningful, Heart-turning Family Stories That Will Make An Impact On Your Life And The Lives Of Your Loved Ones.</p>\r\n\r\n<p>&nbsp;</p>', 'Igitree Description', NULL, NULL, '2018-10-11 02:33:07', 0, '2018-10-12 03:48:22', 0, 1),
(14, '<p>Family Tree;<br />\r\nIndividuals will create / build family trees, browse family branches, and see portraits of<br />\r\nrelatives you&rsquo;ve never seen before.<br />\r\nThrough the members&rsquo; profiles in the tree, discover facts, documents, stories and photos of<br />\r\nyour ancestors.<br />\r\nEasily add new life details, photos, stories and new relatives.<br />\r\nTake your family tree with you wherever you go- some app functions will be able to work<br />\r\neven without the internet.</p>', 'Igitree Feature', 'Family Tree', NULL, '2018-10-12 03:23:34', 0, '2018-10-12 03:55:38', 0, 1),
(15, '<p>Here igiTREE app, will give you an opportunity to trace your ancestors by providing you<br />\r\nwith a DNA test process, and we will trace your DNA&rsquo;s origin.<br />\r\nigiTREE will be able to match you with possible family members, that will match your DNA<br />\r\nresults and exist on the app.</p>', 'Igitree Feature', 'Ancestral (DNA) Trace / Match', NULL, '2018-10-12 03:24:12', 0, '2018-10-12 03:57:05', 0, 1),
(16, '<p>A platform that will help us reconnect with long lost family and friends, by uploading old<br />\r\npictures and locating them to time of when they were taken, and location of where they were<br />\r\ntaken from, we will be able to search, location and time, for people to see who posted of the<br />\r\ntime when and where.</p>', 'Igitree Feature', 'Timemory', NULL, '2018-10-12 03:24:51', 0, '2018-10-12 03:57:38', 0, 1),
(17, '<p>Family and friends will be able to add each other and chat, family groups will be created,<br />\r\nfamily functions will be planed and families will grow closer.</p>', 'Igitree Feature', 'Contact / Chat', NULL, '2018-10-12 03:25:19', 0, '2018-10-12 03:58:12', 0, 1),
(18, '<p>Each person will be able to create profiles and build them with pictures and records for other<br />\r\nmembers to see.</p>', 'Igitree Feature', 'Profiles', NULL, '2018-10-12 03:25:45', 0, '2018-10-12 03:58:53', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family`
--

CREATE TABLE `tbl_family` (
  `f_id` int(11) NOT NULL,
  `f_fathers` varchar(100) NOT NULL,
  `f_mothers` varchar(100) NOT NULL,
  `f_husbands` varchar(100) NOT NULL,
  `f_wives` varchar(100) NOT NULL,
  `f_fullname` varchar(200) NOT NULL,
  `f_gender` enum('M','F') NOT NULL DEFAULT 'M'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_family`
--

INSERT INTO `tbl_family` (`f_id`, `f_fathers`, `f_mothers`, `f_husbands`, `f_wives`, `f_fullname`, `f_gender`) VALUES
                              (1, '3', '4', '', '14', 'Papa Tucker', 'M'),
                              (3, '', '', '', '4', 'Great Papa Tucker', 'M'),
                              (4, '', '', '3', '', 'Great Mama Tucker', 'F'),
                              (5, '3', '4', '12', '', 'Sis Papa Tucker', 'F'),
                              (12, '', '', '', '5', 'Hubby Sis Papa Tucker', 'M'),
                              (13, '1', '14', '', '', 'Son Tucker', 'M'),
                              (14, '', '', '1', '', 'Wifey Tucker', 'F'),
                              (15, '13', '', '', '', 'Grand-Son Tucker', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `i_id` int(11) NOT NULL,
  `i_image` varchar(200) NOT NULL,
  `i_location` text NOT NULL,
  `i_date` varchar(100) NOT NULL,
  `i_user` varchar(50) NOT NULL,
  `i_device` varchar(100) NOT NULL,
  `i_os_type` varchar(100) NOT NULL,
  `i_date_added` datetime NOT NULL,
  `i_status` enum('0','1','2','3','4') NOT NULL DEFAULT '1' COMMENT '0 for private, 1 for public, 2 for deleted'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`i_id`, `i_image`, `i_location`, `i_date`, `i_user`, `i_device`, `i_os_type`, `i_date_added`, `i_status`) VALUES
(2, '264f233e69-09-28-13am.jpg', 'Kalerwe', '2015-08-31', '2', '', '', '2018-09-03 02:28:13', '1'),
(3, 'db4e9ad54e-09-28-14am.jpg', 'Kalerwe', '2015-08-31', '1', '', '', '2018-09-03 02:28:14', '1'),
(4, 'f944b67c52-12-55-26pm.jpg', 'Kampala', '2018-08-31', '3', '', '', '2018-09-03 05:55:26', '0'),
(5, '3151bdd546-12-55-27pm.jpg', 'Kampala', '2018-08-31', '3', '', '', '2018-09-03 05:55:27', '1'),
(6, '856dbcc0dc-12-55-27pm.jpg', 'Kampala', '2018-08-31', '3', '', '', '2018-09-03 05:55:27', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logins`
--

CREATE TABLE `tbl_logins` (
  `login_id` int(11) NOT NULL,
  `login_user` varchar(100) NOT NULL,
  `login_ipAddress` varchar(100) NOT NULL,
  `login_userAgent` varchar(100) NOT NULL,
  `login_osType` varchar(100) NOT NULL,
  `login_deviceType` varchar(100) NOT NULL,
  `login_date` datetime NOT NULL,
  `login_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logins`
--

INSERT INTO `tbl_logins` (`login_id`, `login_user`, `login_ipAddress`, `login_userAgent`, `login_osType`, `login_deviceType`, `login_date`, `login_status`) VALUES
(1, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-04 10:33:52', '0'),
(2, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-10 11:48:34', '0'),
(3, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-10 03:18:04', '0'),
(4, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-11 12:51:39', '0'),
(5, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-11 04:44:05', '0'),
(6, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-11 02:27:20', '0'),
(7, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-11 10:23:32', '0'),
(8, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-12 03:17:15', '0'),
(9, 'Administrator', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '', '', '2018-10-12 09:55:31', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sitestats`
--

CREATE TABLE `tbl_sitestats` (
  `ss_id` int(11) NOT NULL,
  `ss_page` varchar(100) NOT NULL,
  `ss_ipAddress` varchar(100) NOT NULL,
  `ss_userAgent` varchar(100) NOT NULL,
  `ss_browser` varchar(100) NOT NULL,
  `ss_browserVersion` varchar(100) NOT NULL,
  `ss_osType` varchar(100) NOT NULL,
  `ss_deviceType` varchar(100) NOT NULL,
  `ss_date` date NOT NULL,
  `ss_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sitestats`
--

INSERT INTO `tbl_sitestats` (`ss_id`, `ss_page`, `ss_ipAddress`, `ss_userAgent`, `ss_browser`, `ss_browserVersion`, `ss_osType`, `ss_deviceType`, `ss_date`, `ss_status`) VALUES
(1, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(2, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(3, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(4, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(5, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(6, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(7, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(8, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(9, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(10, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(11, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(12, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(13, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(14, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(15, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(16, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(17, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(18, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(19, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(20, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-11', '0'),
(21, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(22, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(23, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(24, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(25, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(26, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.10', 'Google Chrome', '69.0.3497.100', 'Windows', 'Desktop', '2018-10-12', '0'),
(27, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.10', 'Google Chrome', '69.0.3497.100', 'Windows', 'Desktop', '2018-10-12', '0'),
(28, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(29, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(30, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(31, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(32, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(33, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(34, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(35, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(36, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(37, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(38, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(39, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(40, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(41, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(42, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(43, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(44, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(45, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(46, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(47, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(48, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(49, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(50, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(51, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(52, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(53, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(54, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(55, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(56, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(57, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(58, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(59, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(60, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(61, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(62, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(63, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(64, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(65, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(66, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(67, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(68, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(69, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(70, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(71, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(72, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(73, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(74, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(75, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(76, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(77, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(78, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(79, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(80, 'Team', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(81, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(82, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(83, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(84, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(85, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(86, 'overview', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0'),
(87, 'Home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', 'Mozilla Firefox', '62.0', 'Windows', 'Desktop', '2018-10-12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

CREATE TABLE `tbl_team` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(255) DEFAULT NULL,
  `t_position` varchar(255) DEFAULT NULL,
  `t_contacts` varchar(255) DEFAULT NULL,
  `t_email` varchar(255) DEFAULT NULL,
  `t_photo` varchar(255) DEFAULT NULL,
  `t_category` varchar(255) DEFAULT NULL,
  `t_added_by` int(11) DEFAULT NULL,
  `t_added_at` datetime DEFAULT NULL,
  `t_last_edited_by` int(11) DEFAULT NULL,
  `t_last_edited_at` datetime DEFAULT NULL,
  `t_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`t_id`, `t_name`, `t_position`, `t_contacts`, `t_email`, `t_photo`, `t_category`, `t_added_by`, `t_added_at`, `t_last_edited_by`, `t_last_edited_at`, `t_status`) VALUES
(8, 'Deexon Muhizi', 'Founder', '077777777777', 'Muhizi@gmail.com', 'team_201810121508521845.jpg', 'Board of directors', 1, '2018-10-12 03:08:52', NULL, NULL, '0'),
(9, 'Andrew M. Mwenda', 'Advisor', '00000000000', 'Mwenda@gmail.com', 'team_201810121510169290.jpg', 'Board of advisors', 1, '2018-10-12 03:10:16', NULL, NULL, '0'),
(10, 'Patrick Bitature', 'Advisor', '3456789', 'Patrick@gmail.com', 'team_201810121513047695.jpg', 'Board of advisors', 1, '2018-10-12 03:13:04', NULL, NULL, '0'),
(11, 'Donald Kaberuka', 'Edvisor', '4567890', 'Donald@gmail.com', 'team_201810121514328485.jpg', 'Board of advisors', 1, '2018-10-12 03:14:32', NULL, NULL, '0'),
(12, 'Femi Adeleke', 'Advisor', '4567890', 'Femi@gmail.com', 'team_201810121519435648.jpg', 'Board of advisors', 1, '2018-10-12 03:16:48', NULL, '2018-10-12 03:19:43', '0'),
(13, 'Mathew Langol', 'Advisor', '2345678', '', 'team_201810121518474586.jpg', 'Board of advisors', 1, '2018-10-12 03:18:47', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL,
  `u_fullname` varchar(200) NOT NULL,
  `u_image` varchar(200) NOT NULL,
  `u_dob` varchar(100) NOT NULL,
  `u_address` text NOT NULL,
  `f_lat` double(6,6) DEFAULT NULL,
  `f_lng` double(6,6) DEFAULT NULL,
  `u_email` varchar(200) NOT NULL,
  `u_password` longtext NOT NULL,
  `u_salt` varchar(200) NOT NULL,
  `u_phoneline` varchar(20) NOT NULL,
  `u_gender` enum('Male','Female','Other') NOT NULL,
  `u_country` varchar(100) NOT NULL,
  `u_device` varchar(100) NOT NULL,
  `u_os_type` varchar(100) NOT NULL,
  `u_ip_address` varchar(20) NOT NULL,
  `u_date_created` datetime NOT NULL,
  `u_verification_code` varchar(200) NOT NULL,
  `u_last_login` datetime NOT NULL,
  `u_status` enum('0','1','2','3') NOT NULL COMMENT '0 for unverified, 1 for verified, 2 for deactivated, 3 for suspended'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`u_id`, `u_fullname`, `u_image`, `u_dob`, `u_address`, `f_lat`, `f_lng`, `u_email`, `u_password`, `u_salt`, `u_phoneline`, `u_gender`, `u_country`, `u_device`, `u_os_type`, `u_ip_address`, `u_date_created`, `u_verification_code`, `u_last_login`, `u_status`) VALUES
(1, 'Dark Don', '', '1986-02-19', 'Wano...', 0.999999, NULL, 'darkdante216@gmail.com', 'fbb1de6cb9887c458049fb7051d17eca4c82b339e12b56c6df8777e89ad66932924cf0bfbbdbe271abd61f78d46b8a82fe8a9a94d351b2f27556bd42480ed686', '', '070001111', 'Male', 'Uganda', '', '', '', '2018-09-02 05:07:42', 'DMsKJzetow', '0000-00-00 00:00:00', '1'),
(2, 'Deexon Muhizi', 'adm_201808091126059644.jpg', '1988-12-14', 'Kololo hill drive', NULL, NULL, 'eexonmuhizi@gmail.com', 'a86b4ad87aa7ac40ff6df301324dc45e6076885e1a31bddaf2dc2888de7fc867ebd64c8896ca3da1ae0f6603b6ea116fc142817908f92f7b04f4a49d186cc26a', '', '0777898655', 'Male', 'Uganda', '', '', '', '2018-09-02 05:09:28', 'ZoVTgPp5lb', '0000-00-00 00:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_chats`
--
ALTER TABLE `tbl_chats`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_contactmessages`
--
ALTER TABLE `tbl_contactmessages`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_family`
--
ALTER TABLE `tbl_family`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `tbl_logins`
--
ALTER TABLE `tbl_logins`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_sitestats`
--
ALTER TABLE `tbl_sitestats`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_chats`
--
ALTER TABLE `tbl_chats`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_contactmessages`
--
ALTER TABLE `tbl_contactmessages`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_family`
--
ALTER TABLE `tbl_family`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_logins`
--
ALTER TABLE `tbl_logins`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_sitestats`
--
ALTER TABLE `tbl_sitestats`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
