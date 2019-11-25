-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 04:05 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_final`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `backup_to_receipt` (IN `userid` INT(5), IN `appid` INT(5))  NO SQL
BEGIN

INSERT INTO receipt(receipt.user_id,app_id) VALUES(userid,appid);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_app_avg_rating` (IN `in_appid` INT)  NO SQL
BEGIN
SELECT SUM(r_star) INTO @rating FROM rating WHERE r_appid = in_appid;
SELECT COUNT(r_star) INTO @rater FROM rating WHERE r_appid = in_appid;
UPDATE applications SET app_rating = @rating/@rater WHERE app_id = in_appid;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `f_name` varchar(45) DEFAULT NULL,
  `l_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `ref_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `username`, `password`, `f_name`, `l_name`, `email`, `age`, `dob`, `address`, `ref_code`) VALUES
(1, 'admin1', 'admin1', 'Thanach', 'Ungkhara', 'thanachjuno@gmail.com', 20, '1999-02-23', '@2bcasa Thammasat U', '12120'),
(2, 'admin2', 'admin2', 'Peerapol', 'La-ongsiri', 'peerapol@gmail.com', 20, '1999-09-23', '@Home', '11120');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `app_id` int(11) NOT NULL,
  `app_name` varchar(45) NOT NULL,
  `app_pic` varchar(45) NOT NULL DEFAULT 'null.jpg',
  `app_ss1` varchar(100) DEFAULT 'null.jpg',
  `app_ss2` varchar(100) NOT NULL DEFAULT 'null.jpg',
  `app_ss3` varchar(100) NOT NULL DEFAULT 'null.jpg',
  `des_short` varchar(50) DEFAULT NULL,
  `des_long` varchar(500) DEFAULT NULL,
  `app_price` float DEFAULT NULL,
  `changelog` varchar(300) DEFAULT NULL,
  `app_rating` float DEFAULT NULL,
  `version` varchar(30) NOT NULL DEFAULT '1.0',
  `download_c` int(11) DEFAULT NULL,
  `app_size` float DEFAULT NULL,
  `age_restriction` int(11) DEFAULT NULL,
  `dev_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`app_id`, `app_name`, `app_pic`, `app_ss1`, `app_ss2`, `app_ss3`, `des_short`, `des_long`, `app_price`, `changelog`, `app_rating`, `version`, `download_c`, `app_size`, `age_restriction`, `dev_id`, `cat_id`, `status`, `upload_time`) VALUES
(1, 'Pubg Mobile', 'pubg.png', 'pubg_ss1.jpg', 'pubg_ss2.jpg', 'pubg_ss3.jpg', 'The official PLAYERUNKNOWN\'S BATTLEGROUNDS', 'The official PLAYERUNKNOWN\'S BATTLEGROUNDS designed exclusively for mobile. Play free anywhere, anytime. PUBG MOBILE delivers the most intense free-to-play multiplayer action on mobile. Drop in, gear up, and compete. Survive epic 100-player classic battles, payload mode and fast-paced 4v4 team deathmatch and zombie modes. Survival is key and the last one standing wins. When duty calls, fire at will!', NULL, NULL, 4.3, '', 21460173, 4500000, 18, 1, 2, 'Approved', '2019-09-30 17:00:00'),
(2, 'Cytus II', 'Cytus_2.png', 'cytus_ss1.png', 'cytus_ss2.png', 'cytus_ss3.png', '\"Cytus II\" is a music rhythm game created by Raya', '\"Cytus II\" is a music rhythm game created by Rayark Games. It\'s our fourth rhythm game title, following the footsteps of three global successes, \"Cytus\", \"DEEMO\" and \"VOEZ\". This sequel to \"Cytus\" brings back the original staff and is a product of hardwork and devotion.', 88, NULL, 4.5, '', 55219, 102000000, 14, 2, 2, 'Approved', '2019-08-31 17:00:00'),
(3, 'Limbo', 'limbo.png', 'limbo_ss1.png', 'limbo_ss2.png', 'limbo_ss3.png', 'Uncertain of his sister\'s fate, a boy enters LIMBO', 'Gameinformerï¿½s ï¿½Best Downloadableï¿½\r\nGamespotï¿½s ï¿½Best Puzzle Gameï¿½\r\nKotakuï¿½s ï¿½The Best Indie Gameï¿½\r\nGameReactorï¿½s ï¿½Digital Game of the Yearï¿½\r\nSpike TVï¿½s ï¿½Best Independent Gameï¿½\r\nX-Playï¿½s ï¿½Best Downloadable Gameï¿½\r\nIGNï¿½s ï¿½Best Horror Gameï¿½', 88, NULL, 4.7, '', 44836, 32000000, 14, 1, 2, 'Pending', '2019-11-13 09:09:50'),
(4, 'JOOX MUSIC', 'joox.png', 'joox_ss1.png', 'joox_ss2.png', 'joox_ss3.png', 'The JOOX streaming music app is here for download.', 'It’s the FREE music player app with lyrics for all local music lovers to stream or download the latest songs with millions of other local and International tracks to choose from. Listen to your favourite radio stations. Enjoy karaoke and stream videos with friends.', NULL, NULL, 4.4, '', 5509488, 98000000, 14, 2, 3, 'Approved', '2019-06-30 17:00:00'),
(5, 'Zenonia® 3', 'zenonia.png', 'zenonia_ss1.png', 'zenonia_ss2.png', 'zenonia_ss3.png', 'ZENONIA® 3: Return of the Legend, Extreme RPG', 'The definitive action RPG has returned, now in glorious HD!\r\nWhen an ancient evil threatens to erupt onto the world, heroes of the ages must assemble once again to change the course of destiny.\r\nJoin Regret, Chael, Ecne, Lu and more to embark on the greatest ZENONIA adventure yet!', NULL, NULL, 3.33333, '', 299645, 41000000, 14, 1, 2, 'Approved', '2019-05-31 17:00:00'),
(6, 'Snapask', 'snapask.png', 'snapask_ss1.png', 'snapask_ss2.png', 'snapask_ss3.png', '***Over 1.3 million students across Asia have used', 'Don\'t you ever wish that there was an app to help you with your homework?\r\nYour wish is our command.\r\nWhat makes us different from other homework apps?', 100, NULL, 4, '', 25797, 16000000, 3, 1, 1, 'Approved', '2019-04-30 17:00:00'),
(7, 'Epic!', 'epic.png', 'epic_ss1.png', 'epic_ss2.png', 'epic_ss3.png', 'Epic! is the #1 children’s digital library for kid', 'With thousands of children’s books and videos, including kids’ audiobooks, ebooks and read along books, Epic! brings unlimited reading and learning to millions of children at home and in school.', 80, NULL, 4, '', 30760, 18000000, 6, 2, 1, 'Approved', '2019-03-31 17:00:00'),
(8, 'Beetalk', 'beetalk.JPG', 'beetalk_ss1.png', 'beetalk_ss2.png', 'beetalk_ss3.png', 'Just like other communication apps in the market', 'BeeTalk is an all-in-one communication platform that provides you with the tools to chat, call and video chat with your friends and acquaintances', NULL, NULL, 3.4, '', 400000, 5500000, 18, 1, 4, 'Approved', '2018-05-01 17:00:00'),
(9, 'Discord', 'discord.JPG', 'discord_ss1.png', 'discord_ss2.png', 'discord_ss3.png', 'Discord is the only cross-platform voice and text ', 'Discord is the only cross-platform voice and text chat app designed specifically for gamers. With the iOS app you can stay connected to all your Discord voice and text channels even while AFK. It is perfect for chatting with team members, seeing who is playing online, and catching up on text conversations you may have missed.', NULL, NULL, 4.8, '', 800000, 9000000, 12, 1, 4, 'Approved', '2019-05-08 17:00:00'),
(10, 'Instagram', 'instagram.JPG', 'instagram_ss1.png', 'instagram_ss2.png', 'instagram_ss3.png', 'Bringing you closer to the people', 'Connect with friends, share what you\'re up to or see what\'s new from others all over the world. Explore our community where you can feel free to be yourself and share everything from your daily moments to life\'s highlights.', NULL, NULL, 4.8, '', 4000000, 115000000, 12, 2, 4, 'Approved', '2019-06-11 17:00:00'),
(11, 'Pinterest', 'pinterest.PNG', 'pinterest_ss1.png', 'pinterest_ss2.png', 'pinterest_ss3.png', 'Good ideas start on Pinterest.', 'Explore over 100 billion new ideas for every part of your life, from what haircut to get to what to make for dinner. Create extra storage space in your home, turn an old t-shirt into a stylish dress, or plan your next vacation with Pinterest.', NULL, NULL, 4.8, '', 2000000, 16800000, 12, 2, 4, 'Approved', '2019-06-02 17:00:00'),
(12, 'English with ABA', 'ABA.png', 'ABA_ss1.png', 'ABA_ss2.png', 'ABA_ss3.png', 'Andy will help you learn and practice your English', 'Study language by actually using it in a conversation. Chat, learn new words, study grammar and play language games.', 50, NULL, 4.9, '', 48700, 40000000, 8, 1, 1, 'Approved', '2019-04-02 17:00:00'),
(13, 'Busuu', 'busuu.png', 'busuu_ss1.png', 'busuu_ss2.png', 'busuu_ss3.png', 'Learn Spanish, French, Italian, German', 'Language learning is simple, fun and effective with Busuu. You can even fit language learning into your daily schedule with the help of our study plan. 90 million users are already learning languages with Busuu! Join them today and learn a language!', 50, NULL, 4.25, '', 29803, 12000000, 8, 2, 1, 'Approved', '2019-06-24 17:00:00'),
(14, 'Chordify', 'chordify.jpg', 'chordify_ss1.png', 'chordify_ss2.png', 'chordify_ss3.png', 'Chordify is your #1 platform for chords.1', 'We help musicians of all levels to learn and play the music they love. Chordify gives you the chords for any song and aligns them to the music in a simple to use player.1', 1501, NULL, 4.8, '1', 30920, 12000000, 12, 1, 3, 'Pending', '2019-11-13 09:10:41'),
(15, 'TuneIn', 'tunein.jpg', 'turnin_ss1.png', 'turnin_ss2.png', 'turnin_ss3.png', 'Listen to your favorite radio stations for free', 'With over 100,000 radio stations, TuneIn has the largest selection of sports, news, music and talk radio from around the world.', 132, NULL, 4.6, '', 12987, 3425000, 8, 2, 3, 'Approved', '2019-06-03 17:00:00'),
(16, 'WeSing', 'wesing.png', 'wesing_ss1.png', 'wesing_ss2.png', 'wesing_ss3.png', 'Sing free songs with the pocket version WeSing', 'Let\'s start the new journey in WeSing, new world, new tuning mode, new Stars, new Live Stream! You\'ll see how wonderful you are, you’ll see how popular you are! WeSing is kind of new style Karaoke software, it is very different with others before.', 100, NULL, 4.6, '', 2945, 43023100, 8, 2, 3, 'Approved', '2019-03-22 17:00:00'),
(455, 'ELSA Speak', 'elsa.jpg', 'elsa_ss1.png', 'elsa_ss2.png', 'elsa_ss3.png', 'English Accent Coach', 'ELSA is the ultimate English speaking practice app for English learners.\r\nELSA, your English Language Speech Assistant, coaches you to speak English like an American. Powered by award-winning speech recognition technology, ELSA figures out where your pronunciations mistakes are and shows you how to improve.', 80, NULL, 4.3, '5.4', 1000000, 19000000, 4, 2, 1, 'Approved', '2019-11-24 14:23:51'),
(456, 'Rosetta Stone', 'rosetta_stone.png', 'rosetta_ss1.png', 'rosetta_ss2.png', 'rosetta_ss3.png', 'Rosetta Stone: Learn Languages', 'Rosetta Stone’s award-winning mobile app teaches you to think in a new language by connecting what you’re seeing with what you’re saying. Explore a conversational way of language learning that grows your speaking and reading abilities. Study grammar and vocabulary intuitively and learn to speak a new language, from French to Korean.', 90, NULL, 4.6, '5.12', 1000000, 31000000, 3, 2, 1, 'Approved', '2019-11-24 14:23:51'),
(457, 'Fruit Ninja', 'fruit-ninja.png', 'fruit-ninja_ss1.png', 'fruit-ninja_ss2.png', 'fruit-ninja_ss2.png', 'Welcome to the dojo, ninja. Your objective: become', 'Unsheathe your blade and start the juicy carnage with the three classic game modes that billions of players have come to know and love. Experience the thrill of setting a new high score in the fan-favourite Arcade mode as you focus on dodging bombs and slicing massive combos with the help of the special Double Score, Freeze or Frenzy bananas. Need something less intense? Simply relax and slash for stress relief in Zen Mode. Finally, cut as much as you can in the endless Classic mode – just avoid', 36, NULL, 4.4, '2.7', 100000000, 16000000, 7, 2, 2, 'Approved', '2019-11-24 14:36:27'),
(458, 'Identity V', 'identity.png', 'identity_ss1.png', 'identity_ss2.png', 'identity_ss3.png', 'Fear Always Springs from the Unknown.', 'Join the Thrilling Party! Welcome to Identity V, the first asymmetrical horror mobile game developed by NetEase. With a gothic art style, mysterious storylines and exciting 1vs4 gameplay, Identity V will bring you a breathtaking experience.', 199, NULL, 4, '3.5', 10000000, 42000000, 12, 1, 2, 'Approved', '2019-11-24 14:36:27'),
(459, 'MuseScore', 'musescore.png', 'musescore_ss1.png', 'musescore_ss2.png', 'musescore_ss3.png', 'Play free music scores with MuseScore', 'One of the largest catalogs of sheet music, which can be browsed by instrument (piano, trumpet, violin, percussion, flute, etc.) and played immediately from the site with the embedded player.', 49, NULL, 3.9, '2.4', 500000, 12000000, 4, 1, 3, 'Approved', '2019-11-24 14:57:48'),
(460, 'Gaana Music', 'gaana.jpg', 'gaana_ss1.png', 'gaana_ss2.png', 'gaana_ss3.png', 'Hindi Tamil Telugu MP3 Songs Online', 'Gaana is the one-stop music streaming app for all your Music needs. Gaana offers you free, unlimited online access to all your favorite Hindi Songs, Bollywood Music, Regional Music & Radio.', 50, NULL, 4.6, '8.1', 50000, 26000000, 12, 1, 3, 'Approved', '2019-11-24 14:57:48'),
(461, 'hi5', 'hi5.PNG', 'hi5_ss1.PNG', 'hi5_ss2.PNG', 'hi5_ss3.PNG', 'meet, chat & flirt', 'hi5 is the best place to date, chat, or meet new people!', NULL, NULL, 4.5, '9.20', 500000, 43000000, 18, 2, 4, 'Approved', '2019-11-24 15:03:58'),
(462, 'Bigo Live', 'bigo.JPG', 'bigo_ss1.JPG', 'bigo_ss2.JPG', 'bigo_ss3.JPG', 'Live Stream, Live Video & Live Chat', 'Bigo Live is a top live video streaming social network. It allows you to live stream your special moments, live talk with your friends, make video calls and watch trendy videos.', 120, NULL, 4.5, '4.25', 5000000, 46000000, 12, 2, 4, 'Approved', '2019-11-24 15:03:58');

--
-- Triggers `applications`
--
DELIMITER $$
CREATE TRIGGER `savetoversioncat` AFTER UPDATE ON `applications` FOR EACH ROW BEGIN
INSERT INTO version_cat(version,changelog,app_id,app_dev_id,timestamp,indicator) VALUES(OLD.version,OLD.changelog,OLD.app_id,OLD.dev_id,CURRENT_TIMESTAMP,'o');

INSERT INTO version_cat(version,changelog,app_id,app_dev_id,timestamp,indicator) VALUES(NEW.version,NEW.changelog,NEW.app_id,NEW.dev_id,CURRENT_TIMESTAMP,'n');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `trans_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `app_dev_id` int(11) NOT NULL,
  `paid` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'education'),
(2, 'game'),
(3, 'music'),
(4, 'social');

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `dev_id` int(11) NOT NULL,
  `dev_name` varchar(100) DEFAULT NULL,
  `dev_desc` varchar(100) DEFAULT NULL,
  `dev_email` varchar(100) DEFAULT NULL,
  `dev_web` varchar(100) DEFAULT NULL,
  `dev_addr` varchar(200) DEFAULT NULL,
  `dev_username` varchar(45) DEFAULT NULL,
  `dev_password` varchar(45) DEFAULT NULL,
  `dev_phone` varchar(10) DEFAULT NULL,
  `dev_paypal` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`dev_id`, `dev_name`, `dev_desc`, `dev_email`, `dev_web`, `dev_addr`, `dev_username`, `dev_password`, `dev_phone`, `dev_paypal`) VALUES
(1, 'Komodo', 'Just a Developer', 'komododra@gmail.com', 'https://www.google.com', '@Chula', 'dev1', 'dev1', '0812345678', '110111111'),
(2, 'Justin', 'Just a Developer2', 'justinni@gmail.com', 'https://www.google2.com', '@Kaset', 'dev2', 'dev2', '0812345679', '220222222'),
(3, 'Police', 'I\'m Developer 3', 'policee@gmail.com', 'www.pornhub.com', 'Changi 22334', 'dev3', 'dev3', '0898978965', '0000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fb_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dev_id` int(11) DEFAULT NULL,
  `fb_title` varchar(45) DEFAULT NULL,
  `fb_body` varchar(500) DEFAULT NULL,
  `fb_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logincred`
--

CREATE TABLE `logincred` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(20) NOT NULL,
  `typeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logincred`
--

INSERT INTO `logincred` (`id`, `username`, `password`, `role`, `typeid`) VALUES
(1, 'admin1', 'admin1', 'admin', 1),
(2, 'admin2', 'admin2', 'admin', 2),
(3, 'dev1', 'dev1', 'dev', 1),
(4, 'dev2', 'dev2', 'dev', 2),
(5, 'user1', 'user1', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `r_id` int(11) NOT NULL,
  `r_appid` int(11) NOT NULL,
  `r_version` varchar(60) NOT NULL,
  `r_devid` int(11) NOT NULL,
  `r_title` varchar(200) NOT NULL,
  `r_desc` varchar(500) NOT NULL,
  `r_star` int(11) NOT NULL,
  `r_userid` int(11) NOT NULL,
  `r_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`r_id`, `r_appid`, `r_version`, `r_devid`, `r_title`, `r_desc`, `r_star`, `r_userid`, `r_timestamp`) VALUES
(3, 13, '', 2, 'asdas', 'asdasd', 1, 1, '2019-11-21 14:16:22'),
(4, 13, '', 2, 'ISUS', 'YEAMEA', 5, 1, '2019-11-21 14:18:44'),
(5, 13, '', 2, 'poop', 'poop', 1, 1, '2019-11-21 14:19:54'),
(6, 13, '', 2, 'HEE', 'KUY', 4, 1, '2019-11-21 14:20:29'),
(7, 13, '', 2, 'sdf', 'eqwf', 5, 1, '2019-11-21 15:30:23'),
(8, 13, '', 2, 'wef', 'wefwef', 5, 1, '2019-11-21 15:30:27'),
(9, 13, '', 2, 'wef', 'ewfwef', 5, 1, '2019-11-21 15:30:32'),
(10, 13, '', 2, 'wefewf', 'wefwef', 5, 1, '2019-11-21 15:30:37'),
(11, 13, '', 2, 'asdw', 'qdqwd', 5, 1, '2019-11-21 15:37:09'),
(12, 13, '', 2, 'asdw', 'qdqwd', 5, 1, '2019-11-21 15:38:51'),
(13, 13, '', 2, 'asdw', 'qdqwd', 5, 1, '2019-11-21 15:39:23'),
(14, 5, '', 1, 'wqdwqd', 'qwdqwd', 5, 1, '2019-11-21 15:39:33'),
(15, 5, '', 1, 'qweqwe', 'wqe', 2, 1, '2019-11-21 15:39:37'),
(16, 5, '', 1, 'qweqwe', 'awsdqwd', 3, 1, '2019-11-21 15:39:42'),
(17, 13, '', 2, 'qwe', 'wqd', 5, 1, '2019-11-21 16:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `r_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `r_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`r_id`, `user_id`, `app_id`, `r_date`) VALUES
(1, 2, 2, '2019-11-19 15:49:58'),
(2, 2, 16, '2019-11-19 15:49:58'),
(3, 2, 5, '2019-11-19 15:49:58'),
(4, 2, 8, '2019-11-19 15:49:58'),
(5, 2, 451, '2019-11-19 15:58:17'),
(6, 2, 6, '2019-11-19 15:58:17'),
(7, 2, 5, '2019-11-19 15:58:17'),
(8, 2, 10, '2019-11-19 15:58:17'),
(9, 2, 1, '2019-11-19 15:59:06'),
(10, 1, 12, '2019-11-23 17:57:00'),
(11, 1, 3, '2019-11-23 17:57:00'),
(12, 1, 5, '2019-11-23 17:57:00'),
(13, 1, 7, '2019-11-23 17:57:00'),
(14, 1, 1, '2019-11-23 18:25:14'),
(15, 1, 2, '2019-11-23 18:25:14'),
(16, 1, 1, '2019-11-23 18:33:30'),
(17, 1, 9, '2019-11-23 18:33:30'),
(18, 1, 4, '2019-11-23 18:33:30'),
(19, 1, 12, '2019-11-24 20:11:03'),
(20, 1, 12, '2019-11-24 20:11:03'),
(21, 1, 7, '2019-11-24 20:12:13'),
(22, 1, 13, '2019-11-24 20:12:13'),
(23, 1, 13, '2019-11-24 20:34:45');

-- --------------------------------------------------------

--
-- Stand-in structure for view `test`
-- (See below for the actual view)
--
CREATE TABLE `test` (
`username` varchar(45)
,`PASSWORD` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `test1`
-- (See below for the actual view)
--
CREATE TABLE `test1` (
`username` varchar(45)
,`password` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `test2`
-- (See below for the actual view)
--
CREATE TABLE `test2` (
`username` varchar(45)
,`password` varchar(100)
,`name` varchar(100)
,`typeid` int(11)
,`role` varchar(5)
,`email` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `payment_id` varchar(16) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `addr` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `f_name`, `l_name`, `email`, `payment_id`, `age`, `dob`, `addr`) VALUES
(1, 'user1', 'user1', 'Parrot', 'Mario', 'parrotto@gmail.com', '3192030912123', 45, '1974-08-04', '123 redder nadaja 12000'),
(2, 'user2', 'user2', 'pap', 'pop', 'pappop@mail.com', '123456789444444', 69, '2019-11-04', NULL),
(3, 'user3', 'user3', 'Boboka', 'Baba', 'Boba@gmail.com', '1234567891234567', 21, '1999-02-11', 'Bangkok 12300');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_history`
--

CREATE TABLE `user_payment_history` (
  `pm_his_id` int(11) NOT NULL,
  `pm_id` int(11) NOT NULL,
  `pm_cash` decimal(11,0) NOT NULL,
  `pm_his_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_payment_history`
--

INSERT INTO `user_payment_history` (`pm_his_id`, `pm_id`, `pm_cash`, `pm_his_timestamp`) VALUES
(2, 1, '20', '2019-11-13 04:27:15'),
(3, 1, '50', '2019-11-24 13:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_info`
--

CREATE TABLE `user_payment_info` (
  `pm_id` int(11) NOT NULL,
  `pm_user_id` int(11) NOT NULL,
  `pm_num` int(12) NOT NULL,
  `pm_name` varchar(100) NOT NULL,
  `pm_month` int(2) NOT NULL,
  `pm_year` int(2) NOT NULL,
  `pm_cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `version_cat`
--

CREATE TABLE `version_cat` (
  `id` int(11) NOT NULL,
  `version` varchar(20) NOT NULL,
  `changelog` varchar(500) DEFAULT NULL,
  `app_id` int(11) NOT NULL,
  `app_dev_id` int(11) NOT NULL,
  `indicator` char(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `version_cat`
--

INSERT INTO `version_cat` (`id`, `version`, `changelog`, `app_id`, `app_dev_id`, `indicator`, `timestamp`) VALUES
(1, '1.0.0', 'Initial Release', 450, 2, 'o', '2019-11-12 11:57:51'),
(2, '1.0.1', 'fix bug', 450, 2, 'n', '2019-11-12 11:57:51'),
(3, '1.21', 'poasdaopdn', 1, 1, 'o', '2019-11-12 12:30:07'),
(4, '1.22', 'fix ass', 1, 1, 'n', '2019-11-12 12:30:07'),
(5, '', '', 3, 1, '', '2019-11-13 09:09:50'),
(6, '', '', 3, 1, '', '2019-11-13 09:09:50'),
(7, '', '', 14, 1, '', '2019-11-13 09:10:41'),
(8, '1', '1', 14, 1, '', '2019-11-13 09:10:41'),
(9, '1.0', 'Initial Release', 451, 1, '', '2019-11-13 09:23:24'),
(10, '1.1', 'edit', 451, 1, '', '2019-11-13 09:23:24'),
(11, '1.1', 'edit', 451, 1, 'o', '2019-11-13 09:25:48'),
(12, '1.2', 'edit 2', 451, 1, 'n', '2019-11-13 09:25:48'),
(13, '1.0', 'Initial Release', 452, 1, 'o', '2019-11-13 09:26:13'),
(14, '1.1', 'Initial Release 22', 452, 1, 'n', '2019-11-13 09:26:13'),
(15, '1.0.0', 'Initial Release', 454, 1, 'o', '2019-11-21 11:49:06'),
(16, '1.0.1', 'ASS', 454, 1, 'n', '2019-11-21 11:49:06'),
(17, '', '', 13, 2, 'o', '2019-11-21 15:26:57'),
(18, '', '', 13, 2, 'n', '2019-11-21 15:26:57'),
(19, '', '', 13, 2, 'o', '2019-11-21 15:28:50'),
(20, '', '', 13, 2, 'n', '2019-11-21 15:28:50'),
(21, '', '', 13, 2, 'o', '2019-11-21 15:31:03'),
(22, '', '', 13, 2, 'n', '2019-11-21 15:31:03'),
(23, '', '', 13, 2, 'o', '2019-11-21 15:36:02'),
(24, '', '', 13, 2, 'n', '2019-11-21 15:36:02'),
(25, '', '', 13, 2, 'o', '2019-11-21 15:37:09'),
(26, '', '', 13, 2, 'n', '2019-11-21 15:37:09'),
(27, '', '', 13, 2, 'o', '2019-11-21 15:38:51'),
(28, '', '', 13, 2, 'n', '2019-11-21 15:38:51'),
(29, '', '', 13, 2, 'o', '2019-11-21 15:39:23'),
(30, '', '', 13, 2, 'n', '2019-11-21 15:39:23'),
(31, '', '', 5, 1, 'o', '2019-11-21 15:39:33'),
(32, '', '', 5, 1, 'n', '2019-11-21 15:39:33'),
(33, '', '', 5, 1, 'o', '2019-11-21 15:39:37'),
(34, '', '', 5, 1, 'n', '2019-11-21 15:39:37'),
(35, '', '', 5, 1, 'o', '2019-11-21 15:39:42'),
(36, '', '', 5, 1, 'n', '2019-11-21 15:39:42'),
(37, '', '', 13, 2, 'o', '2019-11-21 16:56:25'),
(38, '', '', 13, 2, 'n', '2019-11-21 16:56:25'),
(39, '', '', 3, 1, 'o', '2019-11-22 03:17:53'),
(40, '', '', 3, 1, 'n', '2019-11-22 03:17:53'),
(41, '1', '1', 14, 1, 'o', '2019-11-22 03:18:07'),
(42, '1', '1', 14, 1, 'n', '2019-11-22 03:18:07'),
(43, '1.2', 'edit 2', 451, 1, 'o', '2019-11-22 03:18:17'),
(44, '1.2', 'edit 2', 451, 1, 'n', '2019-11-22 03:18:17'),
(45, '1.1', 'Initial Release 22', 452, 1, 'o', '2019-11-22 03:18:22'),
(46, '1.1', 'Initial Release 22', 452, 1, 'n', '2019-11-22 03:18:22'),
(47, '1.9.6', 'à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ\r\nà¹€à¸¥à¸·à¸­à¸à¸Šà¹‰à¸­à¸›à¸ªà¸´à¸™à¸„à¹‰à¸²à¸¡à¸²à¸à¸¡à¸²à¸¢à¸ªà¹ˆà¸‡à¸•à¸£à¸‡à¸–à¸¶à¸‡à¸šà¹‰à¸²à¸™à¸ˆà¸²à¸à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ à¸šà¹‰à¸²à¸™, à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ªà¸³à¸­à¸²à¸‡, à¹‚à¸”à¸£à¸™, à¸à¸µà¸¬à¸², à¸‚à¸­à¸‡à¹€à¸¥à¹ˆà¸™, à¸„à¸§à¸²à¸¡à¸‡à¸²à¸¡, à¸•à¸à¹à¸•', 453, 1, 'o', '2019-11-22 03:18:30'),
(48, '1.9.6', 'à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ\r\nà¹€à¸¥à¸·à¸­à¸à¸Šà¹‰à¸­à¸›à¸ªà¸´à¸™à¸„à¹‰à¸²à¸¡à¸²à¸à¸¡à¸²à¸¢à¸ªà¹ˆà¸‡à¸•à¸£à¸‡à¸–à¸¶à¸‡à¸šà¹‰à¸²à¸™à¸ˆà¸²à¸à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ à¸šà¹‰à¸²à¸™, à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ªà¸³à¸­à¸²à¸‡, à¹‚à¸”à¸£à¸™, à¸à¸µà¸¬à¸², à¸‚à¸­à¸‡à¹€à¸¥à¹ˆà¸™, à¸„à¸§à¸²à¸¡à¸‡à¸²à¸¡, à¸•à¸à¹à¸•', 453, 1, 'n', '2019-11-22 03:18:30'),
(49, '1.0.1', 'ASS', 454, 1, 'o', '2019-11-22 03:18:35'),
(50, '1.0.1', 'ASS', 454, 1, 'n', '2019-11-22 03:18:35'),
(51, '', '', 1, 1, 'o', '2019-11-22 03:40:19'),
(52, '', '', 1, 1, 'n', '2019-11-22 03:40:19'),
(53, '', '', 1, 1, 'o', '2019-11-22 03:40:23'),
(54, '', '', 1, 1, 'n', '2019-11-22 03:40:23'),
(55, '', '', 1, 1, 'o', '2019-11-22 03:40:28'),
(56, '', '', 1, 1, 'n', '2019-11-22 03:40:28'),
(57, '', '', 2, 2, 'o', '2019-11-22 03:40:38'),
(58, '', '', 2, 2, 'n', '2019-11-22 03:40:38'),
(59, '', '', 2, 2, 'o', '2019-11-22 03:40:43'),
(60, '', '', 2, 2, 'n', '2019-11-22 03:40:43'),
(61, '', '', 2, 2, 'o', '2019-11-22 03:40:48'),
(62, '', '', 2, 2, 'n', '2019-11-22 03:40:48'),
(63, '', '', 3, 1, 'o', '2019-11-22 03:40:55'),
(64, '', '', 3, 1, 'n', '2019-11-22 03:40:55'),
(65, '', '', 3, 1, 'o', '2019-11-22 03:41:02'),
(66, '', '', 3, 1, 'n', '2019-11-22 03:41:02'),
(67, '', '', 3, 1, 'o', '2019-11-22 03:41:04'),
(68, '', '', 3, 1, 'n', '2019-11-22 03:41:04'),
(69, '', '', 3, 1, 'o', '2019-11-22 03:41:06'),
(70, '', '', 3, 1, 'n', '2019-11-22 03:41:06'),
(71, '', '', 4, 2, 'o', '2019-11-22 03:41:11'),
(72, '', '', 4, 2, 'n', '2019-11-22 03:41:11'),
(73, '', '', 4, 2, 'o', '2019-11-22 03:41:13'),
(74, '', '', 4, 2, 'n', '2019-11-22 03:41:13'),
(75, '', '', 4, 2, 'o', '2019-11-22 03:41:17'),
(76, '', '', 4, 2, 'n', '2019-11-22 03:41:17'),
(77, '', '', 5, 1, 'o', '2019-11-22 03:41:22'),
(78, '', '', 5, 1, 'n', '2019-11-22 03:41:22'),
(79, '', '', 5, 1, 'o', '2019-11-22 03:41:26'),
(80, '', '', 5, 1, 'n', '2019-11-22 03:41:26'),
(81, '', '', 5, 1, 'o', '2019-11-22 03:41:29'),
(82, '', '', 5, 1, 'n', '2019-11-22 03:41:29'),
(83, '', '', 6, 1, 'o', '2019-11-22 03:41:33'),
(84, '', '', 6, 1, 'n', '2019-11-22 03:41:33'),
(85, '', '', 6, 1, 'o', '2019-11-22 03:41:36'),
(86, '', '', 6, 1, 'n', '2019-11-22 03:41:36'),
(87, '', '', 6, 1, 'o', '2019-11-22 03:41:40'),
(88, '', '', 6, 1, 'n', '2019-11-22 03:41:40'),
(89, '', '', 7, 2, 'o', '2019-11-22 03:41:45'),
(90, '', '', 7, 2, 'n', '2019-11-22 03:41:45'),
(91, '', '', 7, 2, 'o', '2019-11-22 03:41:50'),
(92, '', '', 7, 2, 'n', '2019-11-22 03:41:50'),
(93, '', '', 7, 2, 'o', '2019-11-22 03:41:52'),
(94, '', '', 7, 2, 'n', '2019-11-22 03:41:52'),
(95, '', '', 8, 1, 'o', '2019-11-22 03:41:58'),
(96, '', '', 8, 1, 'n', '2019-11-22 03:41:58'),
(97, '', '', 8, 1, 'o', '2019-11-22 03:42:02'),
(98, '', '', 8, 1, 'n', '2019-11-22 03:42:02'),
(99, '', '', 8, 1, 'o', '2019-11-22 03:42:04'),
(100, '', '', 8, 1, 'n', '2019-11-22 03:42:04'),
(101, '', '', 9, 1, 'o', '2019-11-22 03:42:14'),
(102, '', '', 9, 1, 'n', '2019-11-22 03:42:14'),
(103, '', '', 9, 1, 'o', '2019-11-22 03:42:15'),
(104, '', '', 9, 1, 'n', '2019-11-22 03:42:15'),
(105, '', '', 9, 1, 'o', '2019-11-22 03:42:17'),
(106, '', '', 9, 1, 'n', '2019-11-22 03:42:17'),
(107, '', '', 9, 1, 'o', '2019-11-22 03:42:21'),
(108, '', '', 9, 1, 'n', '2019-11-22 03:42:21'),
(109, '', '', 9, 1, 'o', '2019-11-22 03:42:24'),
(110, '', '', 9, 1, 'n', '2019-11-22 03:42:24'),
(111, '', '', 9, 1, 'o', '2019-11-22 03:42:27'),
(112, '', '', 9, 1, 'n', '2019-11-22 03:42:27'),
(113, '', '', 10, 2, 'o', '2019-11-22 03:42:33'),
(114, '', '', 10, 2, 'n', '2019-11-22 03:42:33'),
(115, '', '', 10, 2, 'o', '2019-11-22 03:42:35'),
(116, '', '', 10, 2, 'n', '2019-11-22 03:42:35'),
(117, '', '', 10, 2, 'o', '2019-11-22 03:42:38'),
(118, '', '', 10, 2, 'n', '2019-11-22 03:42:38'),
(119, '', '', 11, 2, 'o', '2019-11-22 03:42:43'),
(120, '', '', 11, 2, 'n', '2019-11-22 03:42:43'),
(121, '', '', 11, 2, 'o', '2019-11-22 03:42:47'),
(122, '', '', 11, 2, 'n', '2019-11-22 03:42:47'),
(123, '', '', 11, 2, 'o', '2019-11-22 03:42:50'),
(124, '', '', 11, 2, 'n', '2019-11-22 03:42:50'),
(125, '', '', 12, 1, 'o', '2019-11-22 03:42:56'),
(126, '', '', 12, 1, 'n', '2019-11-22 03:42:56'),
(127, '', '', 12, 1, 'o', '2019-11-22 03:42:57'),
(128, '', '', 12, 1, 'n', '2019-11-22 03:42:57'),
(129, '', '', 12, 1, 'o', '2019-11-22 03:42:58'),
(130, '', '', 12, 1, 'n', '2019-11-22 03:42:58'),
(131, '', '', 12, 1, 'o', '2019-11-22 03:43:00'),
(132, '', '', 12, 1, 'n', '2019-11-22 03:43:00'),
(133, '', '', 12, 1, 'o', '2019-11-22 03:43:01'),
(134, '', '', 12, 1, 'n', '2019-11-22 03:43:01'),
(135, '', '', 13, 2, 'o', '2019-11-22 03:43:08'),
(136, '', '', 13, 2, 'n', '2019-11-22 03:43:08'),
(137, '', '', 13, 2, 'o', '2019-11-22 03:43:10'),
(138, '', '', 13, 2, 'n', '2019-11-22 03:43:10'),
(139, '', '', 13, 2, 'o', '2019-11-22 03:43:12'),
(140, '', '', 13, 2, 'n', '2019-11-22 03:43:12'),
(141, '1', '1', 14, 1, 'o', '2019-11-22 03:43:17'),
(142, '1', '1', 14, 1, 'n', '2019-11-22 03:43:17'),
(143, '1', '1', 14, 1, 'o', '2019-11-22 03:43:21'),
(144, '1', '1', 14, 1, 'n', '2019-11-22 03:43:21'),
(145, '1', '1', 14, 1, 'o', '2019-11-22 03:43:24'),
(146, '1', '1', 14, 1, 'n', '2019-11-22 03:43:24'),
(147, '1', '1', 14, 1, 'o', '2019-11-22 03:43:27'),
(148, '1', '1', 14, 1, 'n', '2019-11-22 03:43:27'),
(149, '', '', 15, 2, 'o', '2019-11-22 03:43:32'),
(150, '', '', 15, 2, 'n', '2019-11-22 03:43:32'),
(151, '', '', 15, 2, 'o', '2019-11-22 03:43:34'),
(152, '', '', 15, 2, 'n', '2019-11-22 03:43:34'),
(153, '', '', 15, 2, 'o', '2019-11-22 03:43:37'),
(154, '', '', 15, 2, 'n', '2019-11-22 03:43:37'),
(155, '', '', 16, 2, 'o', '2019-11-22 03:43:42'),
(156, '', '', 16, 2, 'n', '2019-11-22 03:43:42'),
(157, '', '', 16, 2, 'o', '2019-11-22 03:43:45'),
(158, '', '', 16, 2, 'n', '2019-11-22 03:43:45'),
(159, '', '', 16, 2, 'o', '2019-11-22 03:43:48'),
(160, '', '', 16, 2, 'n', '2019-11-22 03:43:48'),
(161, '1.1', 'Initial Release 22', 452, 1, 'o', '2019-11-22 03:44:00'),
(162, '1.1', 'Initial Release 22', 452, 1, 'n', '2019-11-22 03:44:00'),
(163, '1.9.6', 'à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ\r\nà¹€à¸¥à¸·à¸­à¸à¸Šà¹‰à¸­à¸›à¸ªà¸´à¸™à¸„à¹‰à¸²à¸¡à¸²à¸à¸¡à¸²à¸¢à¸ªà¹ˆà¸‡à¸•à¸£à¸‡à¸–à¸¶à¸‡à¸šà¹‰à¸²à¸™à¸ˆà¸²à¸à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ à¸šà¹‰à¸²à¸™, à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ªà¸³à¸­à¸²à¸‡, à¹‚à¸”à¸£à¸™, à¸à¸µà¸¬à¸², à¸‚à¸­à¸‡à¹€à¸¥à¹ˆà¸™, à¸„à¸§à¸²à¸¡à¸‡à¸²à¸¡, à¸•à¸à¹à¸•', 453, 1, 'o', '2019-11-22 03:44:02'),
(164, '1.9.6', 'à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ\r\nà¹€à¸¥à¸·à¸­à¸à¸Šà¹‰à¸­à¸›à¸ªà¸´à¸™à¸„à¹‰à¸²à¸¡à¸²à¸à¸¡à¸²à¸¢à¸ªà¹ˆà¸‡à¸•à¸£à¸‡à¸–à¸¶à¸‡à¸šà¹‰à¸²à¸™à¸ˆà¸²à¸à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ à¸šà¹‰à¸²à¸™, à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ªà¸³à¸­à¸²à¸‡, à¹‚à¸”à¸£à¸™, à¸à¸µà¸¬à¸², à¸‚à¸­à¸‡à¹€à¸¥à¹ˆà¸™, à¸„à¸§à¸²à¸¡à¸‡à¸²à¸¡, à¸•à¸à¹à¸•', 453, 1, 'n', '2019-11-22 03:44:02'),
(165, '1.0.1', 'ASS', 454, 1, 'o', '2019-11-22 03:44:03'),
(166, '1.0.1', 'ASS', 454, 1, 'n', '2019-11-22 03:44:03'),
(167, '1.2', 'edit 2', 451, 1, 'o', '2019-11-22 17:06:51'),
(168, '1.2', '', 451, 1, 'n', '2019-11-22 17:06:51'),
(169, '1.1', 'Initial Release 22', 452, 1, 'o', '2019-11-22 17:06:55'),
(170, '1.1', '', 452, 1, 'n', '2019-11-22 17:06:55'),
(171, '1.9.6', 'à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ\r\nà¹€à¸¥à¸·à¸­à¸à¸Šà¹‰à¸­à¸›à¸ªà¸´à¸™à¸„à¹‰à¸²à¸¡à¸²à¸à¸¡à¸²à¸¢à¸ªà¹ˆà¸‡à¸•à¸£à¸‡à¸–à¸¶à¸‡à¸šà¹‰à¸²à¸™à¸ˆà¸²à¸à¸«à¸¡à¸§à¸”à¸«à¸¡à¸¹à¹ˆ à¸šà¹‰à¸²à¸™, à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸ªà¸³à¸­à¸²à¸‡, à¹‚à¸”à¸£à¸™, à¸à¸µà¸¬à¸², à¸‚à¸­à¸‡à¹€à¸¥à¹ˆà¸™, à¸„à¸§à¸²à¸¡à¸‡à¸²à¸¡, à¸•à¸à¹à¸•', 453, 1, 'o', '2019-11-22 17:06:59'),
(172, '1.9.6', '', 453, 1, 'n', '2019-11-22 17:06:59'),
(173, '1.0.1', 'ASS', 454, 1, 'o', '2019-11-22 17:07:01'),
(174, '1.0.1', '', 454, 1, 'n', '2019-11-22 17:07:01'),
(175, '1', '1', 14, 1, 'o', '2019-11-22 17:07:56'),
(176, '1', '', 14, 1, 'n', '2019-11-22 17:07:56'),
(177, '', '0', 1, 1, 'o', '2019-11-22 17:12:39'),
(178, '', NULL, 1, 1, 'n', '2019-11-22 17:12:39'),
(179, '', '0', 2, 2, 'o', '2019-11-22 17:12:43'),
(180, '', NULL, 2, 2, 'n', '2019-11-22 17:12:43'),
(181, '', '0', 3, 1, 'o', '2019-11-22 17:12:45'),
(182, '', NULL, 3, 1, 'n', '2019-11-22 17:12:45'),
(183, '', '0', 4, 2, 'o', '2019-11-22 17:12:47'),
(184, '', NULL, 4, 2, 'n', '2019-11-22 17:12:47'),
(185, '', '0', 5, 1, 'o', '2019-11-22 17:12:48'),
(186, '', NULL, 5, 1, 'n', '2019-11-22 17:12:48'),
(187, '', '0', 6, 1, 'o', '2019-11-22 17:12:49'),
(188, '', NULL, 6, 1, 'n', '2019-11-22 17:12:49'),
(189, '', '0', 7, 2, 'o', '2019-11-22 17:12:51'),
(190, '', NULL, 7, 2, 'n', '2019-11-22 17:12:51'),
(191, '', '0', 8, 1, 'o', '2019-11-22 17:12:52'),
(192, '', NULL, 8, 1, 'n', '2019-11-22 17:12:52'),
(193, '', '0', 9, 1, 'o', '2019-11-22 17:12:53'),
(194, '', NULL, 9, 1, 'n', '2019-11-22 17:12:53'),
(195, '', '0', 10, 2, 'o', '2019-11-22 17:12:55'),
(196, '', NULL, 10, 2, 'n', '2019-11-22 17:12:55'),
(197, '', '0', 11, 2, 'o', '2019-11-22 17:12:56'),
(198, '', NULL, 11, 2, 'n', '2019-11-22 17:12:56'),
(199, '', '0', 12, 1, 'o', '2019-11-22 17:12:58'),
(200, '', NULL, 12, 1, 'n', '2019-11-22 17:12:58'),
(201, '', '0', 13, 2, 'o', '2019-11-22 17:12:59'),
(202, '', NULL, 13, 2, 'n', '2019-11-22 17:12:59'),
(203, '1', '0', 14, 1, 'o', '2019-11-22 17:13:01'),
(204, '1', NULL, 14, 1, 'n', '2019-11-22 17:13:01'),
(205, '', '0', 15, 2, 'o', '2019-11-22 17:13:03'),
(206, '', NULL, 15, 2, 'n', '2019-11-22 17:13:03'),
(207, '', '0', 16, 2, 'o', '2019-11-22 17:13:05'),
(208, '', NULL, 16, 2, 'n', '2019-11-22 17:13:05'),
(209, '1.2', '0', 451, 1, 'o', '2019-11-22 17:13:07'),
(210, '1.2', NULL, 451, 1, 'n', '2019-11-22 17:13:07'),
(211, '1.1', '0', 452, 1, 'o', '2019-11-22 17:13:09'),
(212, '1.1', NULL, 452, 1, 'n', '2019-11-22 17:13:09'),
(213, '1.9.6', '0', 453, 1, 'o', '2019-11-22 17:13:11'),
(214, '1.9.6', NULL, 453, 1, 'n', '2019-11-22 17:13:11'),
(215, '1.0.1', '0', 454, 1, 'o', '2019-11-22 17:13:13'),
(216, '1.0.1', NULL, 454, 1, 'n', '2019-11-22 17:13:13'),
(217, '5.4', NULL, 455, 2, 'o', '2019-11-24 14:24:46'),
(218, '5.4', NULL, 455, 2, 'n', '2019-11-24 14:24:46'),
(219, '9.20', NULL, 461, 2, 'o', '2019-11-24 15:04:32'),
(220, '9.20', NULL, 461, 2, 'n', '2019-11-24 15:04:32');

-- --------------------------------------------------------

--
-- Structure for view `test`
--
DROP TABLE IF EXISTS `test`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `test`  AS  select `administrator`.`username` AS `username`,`administrator`.`password` AS `PASSWORD` from `administrator` ;

-- --------------------------------------------------------

--
-- Structure for view `test1`
--
DROP TABLE IF EXISTS `test1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `test1`  AS  select `administrator`.`username` AS `username`,`administrator`.`password` AS `password` from `administrator` union select `developer`.`dev_username` AS `dev_username`,`developer`.`dev_password` AS `dev_password` from `developer` ;

-- --------------------------------------------------------

--
-- Structure for view `test2`
--
DROP TABLE IF EXISTS `test2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `test2`  AS  select `administrator`.`username` AS `username`,`administrator`.`password` AS `password`,`administrator`.`f_name` AS `name`,`administrator`.`admin_id` AS `typeid`,'admin' AS `role`,`administrator`.`email` AS `email` from `administrator` union select `developer`.`dev_username` AS `dev_username`,`developer`.`dev_password` AS `dev_password`,`developer`.`dev_name` AS `dev_name`,`developer`.`dev_id` AS `dev_id`,'dev' AS `type`,`developer`.`dev_email` AS `email` from `developer` union select `user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`f_name` AS `f_name`,`user`.`user_id` AS `user_id`,'user' AS `type`,`user`.`email` AS `email` from `user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`dev_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `logincred`
--
ALTER TABLE `logincred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `devconstraint` (`r_devid`),
  ADD KEY `userconstraint` (`r_userid`),
  ADD KEY `appconstraint` (`r_appid`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_payment_history`
--
ALTER TABLE `user_payment_history`
  ADD PRIMARY KEY (`pm_his_id`);

--
-- Indexes for table `user_payment_info`
--
ALTER TABLE `user_payment_info`
  ADD PRIMARY KEY (`pm_id`),
  ADD KEY `pm_user_id` (`pm_user_id`);

--
-- Indexes for table `version_cat`
--
ALTER TABLE `version_cat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logincred`
--
ALTER TABLE `logincred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_payment_history`
--
ALTER TABLE `user_payment_history`
  MODIFY `pm_his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_payment_info`
--
ALTER TABLE `user_payment_info`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `version_cat`
--
ALTER TABLE `version_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `appconstraint` FOREIGN KEY (`r_appid`) REFERENCES `applications` (`app_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devconstraint` FOREIGN KEY (`r_devid`) REFERENCES `developer` (`dev_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userconstraint` FOREIGN KEY (`r_userid`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_payment_info`
--
ALTER TABLE `user_payment_info`
  ADD CONSTRAINT `user_payment_info_ibfk_1` FOREIGN KEY (`pm_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
