-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2020 at 01:33 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my-mentor`
--

-- --------------------------------------------------------

--
-- Table structure for table `dep`
--

CREATE TABLE `dep` (
  `fac_id` int(6) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(155) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dep`
--

INSERT INTO `dep` (`fac_id`, `dep_id`, `dep_name`) VALUES
(1, 1, 'Informatique'),
(1, 2, 'Eléctrotechnique'),
(2, 3, 'Biologie'),
(2, 4, 'Sciences de la Matière'),
(3, 5, 'العلوم السياسية'),
(3, 6, 'الحقوق'),
(4, 7, 'Architecture'),
(4, 8, 'Géologie'),
(5, 9, 'العلوم الإنسانية و الإجتماعية'),
(5, 10, 'التربية البدنية و الرياضية'),
(6, 11, 'Sciences financières'),
(6, 12, 'Sciences de Gestion'),
(7, 13, 'Médecine'),
(7, 14, 'Pharmacie');

-- --------------------------------------------------------

--
-- Table structure for table `fac`
--

CREATE TABLE `fac` (
  `fac_id` int(6) NOT NULL,
  `fac_name` varchar(155) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac`
--

INSERT INTO `fac` (`fac_id`, `fac_name`) VALUES
(1, 'Sci Ingéniorat'),
(2, 'Sciences'),
(3, 'Droit'),
(4, 'Sci de la Terre'),
(5, 'Lettres, Sci Humaines'),
(6, 'Sci Economiques & Gestion'),
(7, 'Médecine');

-- --------------------------------------------------------

--
-- Table structure for table `mentorship`
--

CREATE TABLE `mentorship` (
  `mentorship_id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL,
  `theme_id` int(6) NOT NULL,
  `student_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mentorship`
--

INSERT INTO `mentorship` (`mentorship_id`, `post_id`, `theme_id`, `student_id`) VALUES
(3, 6, 9, 2),
(4, 6, 8, 3),
(5, 9, 17, 2),
(6, 7, 11, 3),
(7, 10, 18, 3),
(8, 15, 35, 2),
(9, 15, 32, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mentorship_request`
--

CREATE TABLE `mentorship_request` (
  `mentorship_request_id` int(6) NOT NULL,
  `student_id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL,
  `theme_id` int(6) NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','accepted','rejected') CHARACTER SET utf8 NOT NULL DEFAULT 'pending',
  `message` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mentorship_request`
--

INSERT INTO `mentorship_request` (`mentorship_request_id`, `student_id`, `post_id`, `theme_id`, `date`, `status`, `message`) VALUES
(7, 2, 6, 9, '2020-09-06', 'accepted', 'Aenean lobortis vel sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(8, 2, 7, 12, '2020-09-06', 'rejected', ' ac nunc. Mauris feugiat nec odio ac malesuada. Vivamus ut augue ut elit laoreet finibus. Quisque iaculis faucibus diam a tristique. Proin eget ultrices nisl. Donec vitae tempor quam, eu vehicula eros. Aliquam malesuada tortor sit amet nunc cursus placerat. Praesent eu posuere metus, nec feugiat nulla.'),
(9, 2, 9, 17, '2020-09-06', 'accepted', 'm dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lo'),
(10, 2, 10, 20, '2020-09-06', 'rejected', 'm dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lo'),
(11, 2, 13, 28, '2020-09-06', 'rejected', 'm dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lom dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lo'),
(12, 2, 15, 35, '2020-09-06', 'accepted', 'm dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lo'),
(13, 3, 6, 8, '2020-09-06', 'accepted', 'sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in digni'),
(14, 3, 7, 11, '2020-09-06', 'accepted', 'ae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui, non luctus erat nunc a justo.\r\n\r\nSuspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam magna. Morbi tellus lorem, blandit vel euismod a, imperdiet quis nibh. Phasellus fringilla nisl urna, ut malesuada dui sagittis ac. Mauris auctor nisl id nunc viverra porta. Etiam at mauris efficitur tortor scelerisque hendrerit. Pellente'),
(15, 3, 9, 16, '2020-09-06', 'rejected', 'us, nec feugiat nulla.\r\n\r\nAenean lobortis vel sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Don'),
(16, 3, 10, 18, '2020-09-06', 'accepted', 'ingilla nisl urna, ut malesuada dui sagittis ac. Mauris auctor nisl id nunc viverra porta. Etiam at mauris efficitur tortor scelerisque hendrerit. Pellentesque vel arcu nec mauris vehicula ullamcorper et id tortor. Morbi condimentum ante in lectus imperdiet, nec faucibus tellus consequat'),
(17, 3, 13, 28, '2020-09-06', 'rejected', 'ulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lobortis, frin'),
(18, 3, 15, 32, '2020-09-06', 'accepted', 'gravida leo nec tempor. Aliquam erat volutpat. Vivamus rutrum, mi vel elementum euismod, enim lacus placerat ante, et vestibulum odio ipsum at lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec diam ac risus ornare feugiat id ac nunc. Mauris feugiat nec odio ac malesuada. Vivamus ut augue ut elit laoreet finibus. Quisque iaculis faucibus diam a tristique. Proin eget ultrices nisl. Donec vitae tempor quam, eu vehicula eros. Aliquam malesuada tortor sit amet nunc cursus placerat. Praesent eu posuere metus, nec feugiat');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(6) NOT NULL,
  `teacher_id` int(6) NOT NULL,
  `dep_id` int(6) NOT NULL,
  `status` enum('ouvert','fermée','suspendu') DEFAULT 'ouvert',
  `post_year` enum('1','2','3','4','5') NOT NULL,
  `post_title` varchar(155) NOT NULL,
  `post_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `teacher_id`, `dep_id`, `status`, `post_year`, `post_title`, `post_description`) VALUES
(6, 4, 1, 'ouvert', '5', 'Projet Fin d\'etude, Creation de application mobile', 'Lorem Ipsumis simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,\r\n when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,\r\n but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,\r\n and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(7, 4, 5, 'ouvert', '3', 'justo lobortis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lobortis, fringilla arcu eu, molestie est.'),
(8, 4, 4, 'suspendu', '4', 'vestibulum odio ipsum', 'Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(9, 4, 14, 'ouvert', '2', 'fermentum suscipit', 's vel sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(10, 5, 2, 'ouvert', '2', 'Aenean lobortis', 'Aenean lobortis vel sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(11, 5, 8, 'fermée', '1', 'Lorem ipsum dolor', 'onsectetur adipiscing elit. Maecenas nec diam ac risus ornare feugiat id ac nunc. Mauris feugiat nec odio ac malesuada. Vivamus ut augue ut elit laoreet finibus. Quisque iaculis faucibus diam a tristique. Proin eget ultrices nisl. Donec vitae tempor quam, eu vehicula eros. Aliquam malesuada tortor sit amet nunc cursus placerat. Praesent eu posuere metus, nec feugiat nulla.\r\n\r\nAenean lobortis vel sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliqu'),
(12, 5, 12, 'suspendu', '2', 'Donec vitae ultrices felis', '. Nullam varius consequat sapien sit amet vestibulum. Phasellus viverra lectus in magna placerat, ut volutpat nulla elementum. Fusce consequat nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eget efficitur purus est quis ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui, non luctus erat nunc a justo.\r\n\r\nSuspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam ma'),
(13, 6, 11, 'ouvert', '2', 'vehicula eros. A', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus lacus scelerisque, imperdiet nisi non, pretium erat. Integer interdum finibus nulla, nec elementum turpis luctus ut. Morbi lacinia dictum nisi nec vehicula. Aliquam erat volutpat. Integer sodales eget mauris eget gravida. Morbi tincidunt lectus nibh, at egestas ligula dignissim vel. Nunc imperdiet laoreet velit, nec pharetra leo commodo eget. Cras in justo lobortis, fringilla arcu eu, molestie est.'),
(14, 6, 9, 'suspendu', '2', 'rices felis. S', 'Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(15, 6, 10, 'ouvert', '5', 'aliquam magna', 'Suspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam magna. Morbi tellus lorem, blandit vel euismod a, imperdiet quis nibh. Phasellus fringilla nisl urna, ut ');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`) VALUES
(2, 11),
(3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `public_email` varchar(155) DEFAULT NULL,
  `public_number` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `user_id`, `public_email`, `public_number`) VALUES
(4, 8, 'LoremPublic@gmail.com', '0643725987'),
(5, 9, 'Jondoepublic@gmail.com', '0773525940'),
(6, 10, 'Jane@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `post_id` int(6) NOT NULL,
  `theme_id` int(6) NOT NULL,
  `theme_title` varchar(155) NOT NULL,
  `theme_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`post_id`, `theme_id`, `theme_title`, `theme_description`) VALUES
(6, 8, 'Medical', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now'),
(6, 9, 'Transport', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now'),
(6, 10, 'Applications de messagerie', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now'),
(7, 11, 'Morbi elementum ', 'Morbi elementum gravida leo nec tempor. Aliquam erat volutpat. Vivamus rutrum, mi vel elementum euismod, enim lacus placerat ante, et vestibulum odio ipsum at lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec diam ac risus ornare feugiat id ac nunc. Mauris feugiat nec odio ac malesuada. Vivamus ut augue ut elit laoreet finibus. Quisque iaculis faucibus diam a tristique. Proin eget ultrices nisl. Donec vitae tempor quam, eu vehicula eros. Aliquam malesuada tortor sit amet nunc cursus placerat. Praesent eu posuere metus, nec feugi'),
(7, 12, 'Aenean lobortis', 'Aenean lobortis vel sem fermentum suscipit. Ut vestibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(7, 13, 'vehicula ac auctor', 'Morbi elementum gravida leo nec tempor. Aliquam erat volutpat. Vivamus rutrum, mi vel elementum euismod, enim lacus placerat ante, et vestibulum odio ipsum at lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec diam ac risus ornare feugiat id ac nunc. Mauris feugiat nec odio ac malesuada. Vivamus ut augue ut elit laoreet finibus. Quisque iaculis faucibus diam a tristique. Proin eget ultrices'),
(8, 14, 'Donec non vulputate justo.', ' massa neque tincidunt lacus, eget efficitur purus est quis ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, e'),
(8, 15, 'lutpat nulla eleme', 'Suspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam magna. Morbi tellus lorem, blandit vel euismod a, imperdiet quis nibh. Phasellus fringilla nisl urna, ut malesuada dui sagittis ac. Mauris auctor nisl id nunc viverra porta. Etiam at mauris efficitur tortor scelerisque hendrerit. Pellentesque vel arcu nec mauris vehicula ullamcorper et id tortor. Morbi condimentum ante in lectus imperdiet, nec faucibus tellus consequat.'),
(9, 16, 'et ultricie', 's finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo'),
(9, 17, 'orper nisi. Integer tellus', 'erit. Pellentesque vel arcu nec mauris vehicula ullamcorper et id tortor. Morbi condimentum ante in lectus imperdiet, nec faucibus tellus consequat.'),
(10, 18, 'Mauris condimentum', 'm ex quis ligula varius interdum. Nullam varius consequat sapien sit amet vestibulum. Phasellus viverra lectus in magna placerat, ut volutpat nulla elementum. Fusce consequat nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eget eff'),
(10, 19, 'Integer tellus ex', 'quis ligula varius interdum. Nullam varius consequat sapien sit amet vestibulum. Phasellus viverra lectus in magna placerat, ut volutpat nulla elementum. Fusce consequat nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eget efficitur purus est quis ligula. Nunc blandit f'),
(10, 20, ' lobortis vel se', 'gilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(10, 21, 'Nam in di', 'Mauris condimentum ex quis ligula varius interdum. Nullam varius consequat sapien sit amet vestibulum. Phasellus viverra lectus in magna placerat, ut volutpat nulla elementum. Fusce consequat nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eg'),
(11, 23, 'sodales alique', 'sapien sit amet vestibulum. Phasellus viverra lectus in magna placerat, ut volutpat nulla elementum. Fusce consequat nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eget efficitur purus est quis ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliqua'),
(11, 24, 'd id facilisis quam, ', 'estibulum nisi mi. Nam vel risus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis'),
(11, 25, 'ac massa porttito', ' fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui'),
(12, 26, 't sapien sit amet vestibu', 'ero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui, non luctus erat nunc a justo.\r\n\r\nSuspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam magna. Morbi tellus lorem, blandit vel euismod a, imperdiet quis nibh. Phasellus fringilla nisl urna, ut malesuada dui sagittis ac. Mauris auctor nisl id nunc viverra porta. Etiam at mauris efficitur tortor scelerisque hendrerit. Pellentesque vel a'),
(12, 27, 'sit amet vestibulum', 'fficitur purus est quis ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui,'),
(13, 28, 'suscipit. Ut', 's felis. Sed id facilisis quam, vel aliquam pit amet vestibulum. Phasellus viverra lectus in magna placerat, ut volutpat nulla elementum. Fusce consequat nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eget efficitur purus est quis ligula. Nunc bland'),
(14, 29, 'vestibulum nisi mi', 'nunc odio, sed imperdiet nisi congue ac. Nam aliquam, tortor sed commodo laoreet, massa neque tincidunt lacus, eget efficitur purus est quis ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rho'),
(14, 30, 'arcu, aliq', 'isus nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id facilisis quam, vel aliquam purus. Nullam vestibulum quis libero at egestas. Donec non vulputate justo.'),
(14, 31, ' sapien sit a', ' purus est quis ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapi'),
(15, 32, 'nisl urna,', 'is ligula. Nunc blandit fermentum est ac fermentum. Aliquam sed odio vitae ex rutrum ornare vitae id urna. Sed vehicula fermentum consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pret'),
(15, 33, 'ac fermentum', 's nec enim sodales aliquet. Vestibulum tincidunt nulla ex, sit amet ultricies ligula fringilla non. Sed et nunc lacus. Curabitur nisl arcu, aliquet ac massa porttitor, consectetur egestas libero. Phasellus maximus finibus sodales. Nam in dignissim purus. Donec vitae ultrices felis. Sed id '),
(15, 34, 'unc blandit fer', ' consectetur. Aliquam erat volutpat. Mauris nisl est, vehicula ac auctor pharetra, posuere ac diam. Proin libero eros, tincidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui, non luctus erat nunc a justo.\r\n\r\nSuspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam magna. Morbi tellus lorem, blandit vel euismod a, imperdiet quis nibh. Phasellus fringilla nisl urna, ut malesuada dui sagittis ac. Mauris au'),
(15, 35, 'sit amet vestibulum', 'cidunt sit amet mauris nec, pretium rhoncus magna. Pellentesque sit amet nulla magna. Vestibulum laoreet, elit placerat accumsan mattis, libero ipsum dapibus dui, non luctus erat nunc a justo.\r\n\r\nSuspendisse nec ullamcorper nisi. Integer tellus ex, commodo non elit a, consequat aliquam');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `first_name` varchar(155) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(155) CHARACTER SET utf8 NOT NULL,
  `email` varchar(155) CHARACTER SET utf32 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(8, 'Ipsum', 'Lorem', 'Lorem@gmail.com', '$2y$10$Gydt74zzds0kaSSgKAxpBuZmuzdoojyRoE5bFARA5aFtC/CzzclSu'),
(9, 'Doe', 'Jon', 'Jon@gmail.com', '$2y$10$YPHgJGvOGsUjOe04P0xu5ejStXlrD.K4RvDE2TVHEHllkM38oLZES'),
(10, 'Doein', 'Jane', 'Jane@gmail.com', '$2y$10$kl/I7JOnGdLDESLVHes/UeDWv8i9jG/0t79DkRIi1opcJr4ubOpl6'),
(11, 'Doe', 'Johnnie', 'Johnnie@gmail.com', '$2y$10$fAE8.G8HlwHd3JdpK2oNU.y4noZ1GVwXRcsFL5/nTNPrpK2.VT/Ku'),
(12, 'Smith', 'Roe', 'Roe@gmail.com', '$2y$10$Sv89sUaFCkKZ2LTmnmd8xOt47.hjRhnsTxMcGnx1dN1NXrfjHa.w6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dep`
--
ALTER TABLE `dep`
  ADD PRIMARY KEY (`dep_id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `fac`
--
ALTER TABLE `fac`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `mentorship`
--
ALTER TABLE `mentorship`
  ADD PRIMARY KEY (`mentorship_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `mentorship_request`
--
ALTER TABLE `mentorship_request`
  ADD PRIMARY KEY (`mentorship_request_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `theme_id` (`theme_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `dep_id` (`dep_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dep`
--
ALTER TABLE `dep`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fac`
--
ALTER TABLE `fac`
  MODIFY `fac_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mentorship`
--
ALTER TABLE `mentorship`
  MODIFY `mentorship_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mentorship_request`
--
ALTER TABLE `mentorship_request`
  MODIFY `mentorship_request_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dep`
--
ALTER TABLE `dep`
  ADD CONSTRAINT `dep_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `fac` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentorship`
--
ALTER TABLE `mentorship`
  ADD CONSTRAINT `mentorship_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mentorship_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mentorship_ibfk_3` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentorship_request`
--
ALTER TABLE `mentorship_request`
  ADD CONSTRAINT `mentorship_request_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mentorship_request_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mentorship_request_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`dep_id`) REFERENCES `dep` (`dep_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `user_id_teacher` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `theme_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
