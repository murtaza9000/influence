-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2016 at 02:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `influence`
--

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` text,
  `publisher_id` int(11) unsigned NOT NULL,
  `priority` int(255) NOT NULL,
  `click_rate` float NOT NULL,
  `click_ratepre` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publisher_id` (`publisher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `url`, `publisher_id`, `priority`, `click_rate`, `click_ratepre`) VALUES
(47, 'http://omnifeed.com/top?rss', 1, 1, 12, 102),
(51, 'http://www.theverge.com/rss/frontpage', 1, 2, 23, 50),
(52, 'http://www.automark.pk/feed/', 2, 3, 2, 155);

-- --------------------------------------------------------

--
-- Table structure for table `influencer`
--

CREATE TABLE IF NOT EXISTS `influencer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ban` int(11) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `payment` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `influencer`
--

INSERT INTO `influencer` (`id`, `name`, `display_name`, `password`, `email`, `ban`, `account_no`, `country`, `confirmation_token`, `confirmed`, `payment`) VALUES
(9, 'Murtaza', 'Murtaza9000', '123', 'murtaza.hanif@gmail.com', 0, '123455912', 'PAK', NULL, 1, 0),
(10, 'Salman', 'Salman9000', '123', 'murtaza.hanif@gmail.com', 0, '123455912', 'PAK', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`) VALUES
(1, 'Salmam'),
(2, 'murtaza');

-- --------------------------------------------------------

--
-- Table structure for table `rss_links`
--

CREATE TABLE IF NOT EXISTS `rss_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `links` text NOT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `description` text,
  `title` text,
  `reserved` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_id` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=840 ;

--
-- Dumping data for table `rss_links`
--

INSERT INTO `rss_links` (`id`, `links`, `domain_id`, `description`, `title`, `reserved`) VALUES
(830, 'http://www.automark.pk/automark-magazine-january-2015/', 52, '<p>The post <a rel="nofollow" href="http://www.automark.pk/automark-magazine-january-2015/">Automark Magazine January 2015</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(831, 'http://www.automark.pk/bike-assemblers-enjoying-famous-brands-instead-of-releasing-quality-new-models/', 52, '<p>Tough competition starts in Auto Sector cars and motorcycles specially in Karachi city after the re-launch of Pakistan’s second biggest brand “UNITED” said Chairman Association of Pakistan Motorcycle Assemblers, Muhammad Sabir Shaikh, UNIQUE &#38; SUPER POWER brands also working hard for the better position of sales in Karachi City. The more important point is that</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/bike-assemblers-enjoying-famous-brands-instead-of-releasing-quality-new-models/">Bike Assemblers Enjoying Famous Brands, Instead of Releasing Quality New Models</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(832, 'http://www.automark.pk/luxury-buses-for-intercity-routes-in-pakistan/', 52, '<p>Imagine travelling in a bus where you can’t find a proper place to sit, where your head hits the roof and you sweat because the air conditions don’t work properly. Yes, a major proportion of Pakistani population faces such issues and the rest lucky ones are unaware of them. The intercity transport system of the</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/luxury-buses-for-intercity-routes-in-pakistan/">Luxury buses for intercity routes in Pakistan</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(833, 'http://www.automark.pk/united-motorcycle-becomes-a-strong-competitor-for-karachi-market/', 52, '<p>United Auto Industry is the 2nd largest brand in the market, are becoming a strong competitor for Karachi market. In presence of already established brands in local market United has launched its special modified model of 70cc which is getting popular in dealer and buyers. With an increase in local production and subsequent drop in</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/united-motorcycle-becomes-a-strong-competitor-for-karachi-market/">United Motorcycle – Becomes a Strong competitor for Karachi market</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(834, 'http://www.automark.pk/124-brands-are-producing-same-70cc-decades-old-model-in-pakistan/', 52, '<p>Pakistan’s Motorcycle assemblers have a total installed capacity of 4 million motorcycles per annum but the production for the last two fiscal years has remained low at 1.7 million bikes per year. Relatively a small country with population of 200 million, the country has 124 bike assemblers including three Japanese giants. In Pakistan Two Japanese assemblers</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/124-brands-are-producing-same-70cc-decades-old-model-in-pakistan/">124 BRANDS ARE PRODUCING SAME 70CC DECADES OLD MODEL IN PAKISTAN</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(835, 'http://www.automark.pk/al-haj-faw-motors-are-expanding-in-pakistan/', 52, '<p>First Automobile Works is a global contributor in the automotive industry with a 50 year history of innovation. The company FAW was established in 1953 and the name was changed to China FAW Group Corporation in 1992. It has been noticed that FAW has recently started doing great in the Pakistani market. Automobile market of</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/al-haj-faw-motors-are-expanding-in-pakistan/">Al-Haj Faw Motors are expanding  in Pakistan</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(836, 'http://www.automark.pk/automark-magazine-november-2015/', 52, '<p>The post <a rel="nofollow" href="http://www.automark.pk/automark-magazine-november-2015/">Automark Magazine November 2015</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(837, 'http://www.automark.pk/paapam-cbi-return-from-agritecnica-2015-with-glorious-export-results/', 52, '<p>Results Give Confidence to Pakistani Participants Hannover, Germany: AGRITECHNICA – The world’s largest trade fair for agricultural machinery and equipment ended with good prospects for the Pakistani manufacturers of tractor parts and agricultural machinery. Thanks to CBI, the Dutch Government’s department forpreparing Pakistani Engineering Sector Companies for EU market entry with CBI’s Export Coaching Programmes</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/paapam-cbi-return-from-agritecnica-2015-with-glorious-export-results/">PAAPAM &#038; CBI returned from AGRITECNICA 2015 with glorious export results</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(838, 'http://www.automark.pk/suzuki-cultus-to-be-replaced-with-suzuki-celerio-in-2016/', 52, '<p>Pak-Suzuki has announced Suzuki Cultus 2016 is going to be replaced with Suzuki Celerio 2016. Pak Suzuki has been in the market since long. It has enjoyed several successful glorious years of increasing sales trends. However, in recent times with the new trends in auto industry and usage of social media, consumers’ taste has changed</p>\n<p>The post <a rel="nofollow" href="http://www.automark.pk/suzuki-cultus-to-be-replaced-with-suzuki-celerio-in-2016/">Suzuki Cultus to be replaced with Suzuki Celerio in 2016</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL),
(839, 'http://www.automark.pk/lx250gs-2a-gp250/', 52, '<p>The post <a rel="nofollow" href="http://www.automark.pk/lx250gs-2a-gp250/">LX250GS-2A (GP250)</a> appeared first on <a rel="nofollow" href="http://www.automark.pk">Automark Magazine</a>.</p>\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rss_links_view`
--
CREATE TABLE IF NOT EXISTS `rss_links_view` (
`id` int(11)
,`links` text
,`domain_id` int(11) unsigned
,`description` text
,`title` text
,`reserved` int(11)
,`click_rate` float
,`click_ratepre` float
);
-- --------------------------------------------------------

--
-- Table structure for table `viral_links`
--

CREATE TABLE IF NOT EXISTS `viral_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `click_rate` float NOT NULL,
  `click_ratepre` float NOT NULL,
  `site_name` text,
  `title` text,
  `description` text,
  `image` text,
  `reserved` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `viral_links`
--

INSERT INTO `viral_links` (`id`, `url`, `click_rate`, `click_ratepre`, `site_name`, `title`, `description`, `image`, `reserved`) VALUES
(27, 'http://techcrunch.com/2016/02/20/japan-launches-observatory-to-study-black-holes-and-dying-stars/', 12, 0, 'TechCrunch', 'Japan Launches Observatory To Study Black Holes And Dying Stars', 'This week the Japan Aerospace Exploration Agency (JAXA) successfully launched a new space observatory designed to study black holes, dying stars and the..', 'https://tctechcrunch2011.files.wordpress.com/2016/02/jaxa-feature-image-e1455996186823.jpg?w=764&h=400&crop=1', NULL),
(33, '    http://techcrunch.com/2016/02/11/coffee-meets-bagel-will-help-you-pick-your-best-dating-photos/?ncid=rss&cps=gravity_1730_7967644576972243211', 344, 0, 'TechCrunch', 'Coffee Meets Bagel Will Help You Pick Your Best Dating Photos', 'If you’ve ever had trouble determining which photos to upload to your dating profile, Coffee Meets Bagel says it has found a solution. From now on, users..', 'https://tctechcrunch2011.files.wordpress.com/2016/02/img_3541.jpg?w=764&h=400&crop=1', NULL),
(38, 'http://buzztache.com/things-everyone-just-ignored-in-deadpool/', 34, 0, NULL, '  Things Everyone Just Ignored In Deadpool', '', 'http://buzztache.com/wp-content/uploads/2016/02/0-236.jpg', NULL),
(39, 'http://www.automark.pk/automark-magazine-january-2015/', 11, 0, 'Automark Magazine', 'Automark Magazine January 2015 - Automark Magazine', NULL, 'http://www.automark.pk/wp-content/uploads/2016/02/jan-Title-2016.jpg', NULL),
(40, 'http://www.automark.pk/luxury-buses-for-intercity-routes-in-pakistan/', 12, 30, 'Automark Magazine', 'Luxury buses for intercity routes in Pakistan - Automark Magazine', 'Imagine travelling in a bus where you can’t find a proper place to sit, where your head hits the roof and you sweat because the air conditions don’t work properly. Yes, a major proportion of Pakistani population faces such issues and the rest lucky ones are unaware of them. The intercity transport system of the', 'http://www.automark.pk/wp-content/uploads/2016/02/automark-luzury-buses.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure for view `rss_links_view`
--
DROP TABLE IF EXISTS `rss_links_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rss_links_view` AS select `r`.`id` AS `id`,`r`.`links` AS `links`,`t2`.`id` AS `domain_id`,`r`.`description` AS `description`,`r`.`title` AS `title`,`r`.`reserved` AS `reserved`,`t2`.`click_rate` AS `click_rate`,`t2`.`click_ratepre` AS `click_ratepre` from (`rss_links` `r` join `domain` `t2` on((`r`.`domain_id` = `t2`.`id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `domain_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`);

--
-- Constraints for table `rss_links`
--
ALTER TABLE `rss_links`
  ADD CONSTRAINT `rss_links_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
