-- phpMyAdmin SQL Dump
-- version 3.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 12:52 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.4-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `scic_admin`
--

CREATE TABLE IF NOT EXISTS `scic_admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `permission` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scic_admin`
--

INSERT INTO `scic_admin` (`user_id`, `user_name`, `password`, `email`, `first_name`, `last_name`, `address`, `permission`, `status`, `date`) VALUES
(1, 'admin', 'admin', 'admin@localhost', 'Mohaimen', 'Khan', 'Rockledge,FL.', 7, 1, '2014-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `scic_answer`
--

CREATE TABLE IF NOT EXISTS `scic_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ans_number` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `scic_answer`
--

INSERT INTO `scic_answer` (`id`, `ans_number`, `answer`, `type`) VALUES
(1, 1, '', '0'),
(2, 2, '', '0'),
(3, 3, '', '0'),
(4, 4, '', '0'),
(5, 5, '', '0'),
(6, 6, '', '0'),
(7, 7, '', '0'),
(8, 8, 'd', '1'),
(9, 9, 'c', '1'),
(10, 10, 'b', '1'),
(11, 11, 'c', '1'),
(12, 12, 'c', '1'),
(13, 13, 'c', '1'),
(14, 14, 'd', '1'),
(15, 15, 'd', '1'),
(16, 16, 'c', '1'),
(17, 17, 'c', '1'),
(18, 18, 'd', '1'),
(19, 19, 'd', '1'),
(20, 20, 'a', '1'),
(21, 21, 'd', '1'),
(22, 22, '3:45', '2'),
(23, 23, '6', '2'),
(24, 24, '36', '2'),
(25, 25, '1', '2'),
(26, 26, 'Donkey x Cats', '2'),
(27, 27, '68', '2'),
(28, 28, '201', '2'),
(29, 29, '26', '2'),
(30, 30, '', '3'),
(31, 31, '', '3');

-- --------------------------------------------------------

--
-- Table structure for table `scic_general`
--

CREATE TABLE IF NOT EXISTS `scic_general` (
  `user_id` int(11) NOT NULL,
  `ans_number` int(11) NOT NULL,
  `answer` text NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`ans_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scic_general`
--

INSERT INTO `scic_general` (`user_id`, `ans_number`, `answer`, `type`) VALUES
(1, 1, 'n/a', '0'),
(1, 2, 'n/a', '0'),
(1, 3, 'n/a', '0'),
(1, 4, 'n/a', '0'),
(1, 5, 'n/a', '0'),
(1, 6, 'n/a', '0'),
(1, 7, 'n/a', '0');

-- --------------------------------------------------------

--
-- Table structure for table `scic_multi_ans`
--

CREATE TABLE IF NOT EXISTS `scic_multi_ans` (
  `qid` int(11) NOT NULL,
  `first` varchar(250) NOT NULL,
  `second` varchar(250) NOT NULL,
  `third` varchar(250) NOT NULL,
  `fourth` varchar(250) NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scic_multi_ans`
--

INSERT INTO `scic_multi_ans` (`qid`, `first`, `second`, `third`, `fourth`) VALUES
(8, 'Wait to be rescued', 'Drown', 'Try to swim to shore', 'Stop imagining'),
(9, 'You don''t', 'Sideways', 'Open the fridge, put it in', 'Head First'),
(10, 'Two', 'Three', 'Seven', 'Five'),
(11, '3', '18573', '5280', '12'),
(12, 'White', 'Black', 'Orange', 'Grey'),
(13, 'Top', 'Middle', 'Bottom', 'There is no Green'),
(14, 'Thomas Jefferson', 'Alexander Hamilton', 'Benjamin Franklin', 'None'),
(15, 'White Toast', 'Wheat Toast', 'Toast', 'Bread'),
(16, '25', '35', '70', '30'),
(17, '7', '6', '9', '8'),
(18, '7', '6', '14', '15'),
(19, '24 socks', '2 socks', '12 socks', '3 socks'),
(20, '7:00 a.m.', '12:00 a.m.', '4:00 a.m.', '2:00 p.m.'),
(21, '8:00 a.m.', '1:00 a.m.', '8:00 p.m.', '2:00 p.m.');

-- --------------------------------------------------------

--
-- Table structure for table `scic_part_i`
--

CREATE TABLE IF NOT EXISTS `scic_part_i` (
  `user_id` int(11) NOT NULL,
  `ans_number` int(11) NOT NULL,
  `answer` varchar(20) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`,`ans_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scic_part_i`
--

INSERT INTO `scic_part_i` (`user_id`, `ans_number`, `answer`, `type`) VALUES
(1, 8, 'd', '1'),
(1, 9, 'a', '1'),
(1, 10, 'b', '1'),
(1, 11, 'c', '1'),
(1, 12, 'c', '1'),
(1, 13, 'c', '1'),
(1, 14, 'd', '1'),
(1, 15, 'd', '1'),
(1, 16, 'c', '1'),
(1, 17, 'c', '1'),
(1, 18, 'd', '1'),
(1, 19, 'd', '1'),
(1, 20, 'a', '1'),
(1, 21, 'b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `scic_part_ii`
--

CREATE TABLE IF NOT EXISTS `scic_part_ii` (
  `user_id` int(11) NOT NULL,
  `ans_number` int(11) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scic_part_ii`
--

INSERT INTO `scic_part_ii` (`user_id`, `ans_number`, `answer`, `type`) VALUES
(1, 22, '3:45', '2'),
(1, 23, '6', '2'),
(1, 24, '36', '2'),
(1, 25, '1', '2'),
(1, 26, 'x', '2'),
(1, 27, '68', '2'),
(1, 28, '201', '2'),
(1, 29, '26', '2');

-- --------------------------------------------------------

--
-- Table structure for table `scic_part_iii`
--

CREATE TABLE IF NOT EXISTS `scic_part_iii` (
  `user_id` int(11) NOT NULL,
  `ans_number` int(11) NOT NULL,
  `answer` text NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`ans_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scic_part_iii`
--

INSERT INTO `scic_part_iii` (`user_id`, `ans_number`, `answer`, `type`) VALUES
(1, 30, 'None', '3'),
(1, 31, 'None', '3');

-- --------------------------------------------------------

--
-- Table structure for table `scic_question`
--

CREATE TABLE IF NOT EXISTS `scic_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texts` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `scic_question`
--

INSERT INTO `scic_question` (`id`, `texts`, `type`, `status`) VALUES
(1, 'What interested you about our firm?', '0', 'active'),
(2, 'How much was an average sale at your previous position?', '0', 'active'),
(3, 'How comfortable are you with calling existing customers and asking for more business?', '0', 'active'),
(4, 'What types of customer relationship tracking did you implement at your past jobs?', '0', 'active'),
(5, 'Where do you see yourself in one, three, and five years?', '0', 'active'),
(6, 'Please explain your definition of stress:', '0', 'active'),
(7, 'Please write down the most stressful situation encountered during your work history:', '0', 'active'),
(8, 'Imagine you are in the middle of the ocean drowning, and surrounded by sharks. What do you do?', '1', 'active'),
(9, 'How do you put a giraffe in a fridge?', '1', 'active'),
(10, 'If Joe has three dogs, and on Tuesday Joe''s mom gives Joe two cats.How many dogs does Joe have?', '1', 'active'),
(11, 'How many feet in a mile?', '1', 'active'),
(12, 'What is the color of the black box in a commercial airplane?', '1', 'active'),
(13, 'On a standard traffic light where is the green light located?', '1', 'active'),
(14, 'Which president is on the $100 dollar bill?', '1', 'active'),
(15, 'Which of the following goes in a toaster?', '1', 'active'),
(16, 'Divide 30 by 50 percent and add 10. What is the answer?', '1', 'active'),
(17, 'A farmer has 17 sheep, and all but 9 are sold. How many are left?', '1', 'active'),
(18, 'If you write down every number between 50 and 100, how many times will you write the number 6?', '1', 'active'),
(19, 'You have 12 black socks and 12 white socks in a basket. what is the least amount of socks you have to pull out(blindly) to be sure of getting a matching pair.', '1', 'active'),
(20, 'What time is it in Mexico City when it is 8:00 a.m. in Miami?', '1', 'active'),
(21, 'What time is it in Paris when it is 8:00 a.m. in Miami?', '1', 'active'),
(22, 'Ted started his homework when he got home from school. He worked 45 minutes on his homework. He then walked the dog for 30 minutes. It was 5:00 when he finished walking the dog. At what time did he get home and start his homework?', '2', 'active'),
(23, 'Crystal has exactly $2.40 in quarters, dimes and nickles. She has the same number of each type of coin. What is that number?', '2', 'active'),
(24, 'Pam gave her friend Tammy the number riddle below. Solve it.\n<strong>"I am a 2-digit number less than 84. The sum of my digits is 9. The ones digit is twice the tens digit. What number am I?"</strong>', '2', 'active'),
(25, 'There were 3 cookies on a plate. Henry ate 1/3 of the cookies on the plate. Marsha ate 1/2 of what was left. How many cookies were left for Art to eat?\n<img src="http://intranet.com/testing_system/images/numb-4.png">', '2', 'active'),
(26, 'Dogs, cats and donkeys had a tug-of war. Four cats tied with three dogs. Two donkeys tied with six dogs. Which side won when one donkey tugged with five cats?\r\n<img src="http://intranet.com/testing_system/images/numb-5.png">', '2', 'active'),
(27, 'Joshua gave Warren a birthday present. How much ribbon did he need to go around the present and make the bow? The bow took 12 inches by itself.\n<img src="http://intranet.com/testing_system/images/numb-6.png">', '2', 'active'),
(28, 'I am a 3-digit number less than 300. My tens digit is less than my ones digit and my ones digit is less than my hundreds digit? Who am I?', '2', 'active'),
(29, 'Mazie counted her dimes. When she put them in groups of 4, she had two dimes left over. When she put them in groups of 5, she had one left over. What is the smallest number of dimes she could have, if she has more than 10?\n<img src="http://intranet.com/testing_system/images/numb-8.png">', '2', 'active'),
(30, '<h2>Scenario:</h2>\r\n<strong>You have the following email in your inbox when you arrived this morning:</strong>\r\n<hr />\r\n\r\nGood Morning\r\n</br></br>\r\nWe just started to use 5000 pcs. of the supplied microcontrollers in our production, but after testing of the final produced units, we discovered that microcontrollers do not work at manufacturer specs. Please let us know how we can return these to you immediately for a refund.\r\n</br></br>\r\nGeorge Hall</br>\r\nPurchasing Manager</br>\r\nBAE UK</br>\r\nTel: +44-258-56887-65</br>\r\nFax: +44-258-56887-79</br>\r\n<hr />\r\n<h2>Additional information:</h2>\r\n1. Components were sold and shipped to the customer on September 30th, 2009\r\n</br>\r\n2. Customer is considered a good customer (Placed about 20 orders totaling a $100K in the last year\r\n</br>\r\n3. Our replacement waranty is 30 days for form, fit and function on all sold parts.\r\n</br></br>\r\nPlease compose an email response to the customer in textbox reflecting how you would handle this sititation.', '3', 'active'),
(31, '<h2>Offer Letter</h2>\r\n1. Use the internet to research the cheapest price for a new Sony XBR-65X900A\r\n</br>\r\n2. Write an offer letter in textbox for the sony XBR-65X900A to our customer John Smith', '3', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `scic_result`
--

CREATE TABLE IF NOT EXISTS `scic_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `general` int(11) NOT NULL DEFAULT '-1',
  `first_part` int(11) NOT NULL DEFAULT '0',
  `second_part` int(11) NOT NULL DEFAULT '0',
  `third_part` int(11) NOT NULL DEFAULT '-1',
  `test_status` int(11) NOT NULL DEFAULT '0',
  `notification` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scic_result`
--

INSERT INTO `scic_result` (`id`, `user_id`, `email`, `general`, `first_part`, `second_part`, `third_part`, `test_status`, `notification`) VALUES
(1, 1, 'teas@localhost', 50, 12, 7, 80, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `scic_skillset`
--

CREATE TABLE IF NOT EXISTS `scic_skillset` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `date` date NOT NULL,
  `arrival_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `left_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scic_skillset`
--

INSERT INTO `scic_skillset` (`user_id`, `fullname`, `date`, `arrival_time`, `left_time`) VALUES
(1, 'Test Examinee', '2014-06-17', '2014-06-17 14:45:14', '2014-06-17 14:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `scic_total_time`
--

CREATE TABLE IF NOT EXISTS `scic_total_time` (
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scic_user`
--

CREATE TABLE IF NOT EXISTS `scic_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'active',
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scic_user`
--

INSERT INTO `scic_user` (`id`, `username`, `password`, `status`, `date`) VALUES
(1, 'teas@localhost', '1234', 'inactive', '2014-06-17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
