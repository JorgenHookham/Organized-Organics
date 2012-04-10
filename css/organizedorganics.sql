-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2011 at 03:23 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `organizedorganics`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `cityID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `cityName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `cityName`) VALUES
(1, 'Vancouver'),
(2, 'Abbotsford'),
(3, 'Burnaby'),
(4, 'Coquitlam'),
(5, 'Delta'),
(6, 'Langley'),
(7, 'Maple Ridge'),
(8, 'Mission'),
(9, 'New Westminster'),
(10, 'North Vancouver'),
(11, 'Pitt Meadows'),
(12, 'Port Coquitlam'),
(13, 'Port Moody'),
(14, 'Richmond'),
(15, 'Surrey'),
(16, 'Tsawwassen'),
(18, 'West Vancouver'),
(19, 'White Rock');

-- --------------------------------------------------------

--
-- Table structure for table `cuisineTypes`
--

CREATE TABLE IF NOT EXISTS `cuisineTypes` (
  `cuisineTypeID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `cuisineName` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`cuisineTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `cuisineTypes`
--

INSERT INTO `cuisineTypes` (`cuisineTypeID`, `cuisineName`) VALUES
(1, 'Afghan'),
(2, 'African'),
(3, 'American'),
(4, 'Asian'),
(5, 'Bakery'),
(6, 'Barbecue'),
(7, 'Brazilian'),
(8, 'Breakfast'),
(9, 'Buffet'),
(10, 'Burgers'),
(11, 'Caribbean'),
(12, 'Chinese'),
(13, 'Coffee & Tea'),
(14, 'Deli'),
(15, 'Desserts'),
(16, 'Dim Sum'),
(17, 'Diner'),
(18, 'Eastern European'),
(19, 'English'),
(20, 'Ethiopian'),
(21, 'European'),
(22, 'Family Fare'),
(23, 'Fast Food'),
(24, 'Filipino'),
(25, 'French'),
(26, 'German'),
(27, 'Greek'),
(28, 'Halal'),
(29, 'Hot Dogs'),
(30, 'Hot Pot'),
(31, 'Indian'),
(32, 'Indonesian'),
(33, 'International'),
(34, 'Italian'),
(35, 'Japanese'),
(36, 'Korean'),
(37, 'Kosher'),
(38, 'Latin American'),
(39, 'Malaysian'),
(40, 'Mediterranean'),
(41, 'Mexican'),
(42, 'Middle Eastern'),
(43, 'Pakistani'),
(44, 'Pizza'),
(45, 'Portuguese'),
(46, 'Pub Food'),
(47, 'Sandwiches'),
(48, 'Seafood'),
(49, 'Singaporean'),
(50, 'Smoothies'),
(51, 'Soups'),
(52, 'Southern'),
(53, 'Spanish'),
(54, 'Steakhouse'),
(55, 'Sushi'),
(56, 'Tacos'),
(57, 'Taiwanese'),
(58, 'Tapas'),
(59, 'Thai'),
(60, 'Turkish'),
(61, 'Vegetarian'),
(62, 'Vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `listingcuisines`
--

CREATE TABLE IF NOT EXISTS `listingcuisines` (
  `listingcuisinesID` smallint(5) NOT NULL AUTO_INCREMENT,
  `cuisineTypeID` tinyint(3) NOT NULL,
  `listingID` smallint(5) NOT NULL,
  PRIMARY KEY (`listingcuisinesID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `listingcuisines`
--

INSERT INTO `listingcuisines` (`listingcuisinesID`, `cuisineTypeID`, `listingID`) VALUES
(68, 4, 66),
(67, 3, 66),
(66, 2, 66),
(65, 1, 66),
(71, 61, 59),
(70, 61, 60),
(69, 61, 68),
(49, 9, 53),
(48, 8, 53);

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE IF NOT EXISTS `listings` (
  `listingID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `listingName` varchar(100) NOT NULL,
  `listingType` enum('farm','market','restaurant') NOT NULL,
  `listingDescription` text,
  `listingStreetAddress` varchar(150) DEFAULT NULL,
  `cityID` tinyint(3) unsigned NOT NULL,
  `listingPostalCode` char(6) DEFAULT NULL,
  `listingPhone` int(10) DEFAULT NULL,
  `listingWebsite` varchar(100) DEFAULT NULL,
  `listingLatitude` float DEFAULT NULL,
  `listingLongitude` float DEFAULT NULL,
  PRIMARY KEY (`listingID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`listingID`, `listingName`, `listingType`, `listingDescription`, `listingStreetAddress`, `cityID`, `listingPostalCode`, `listingPhone`, `listingWebsite`, `listingLatitude`, `listingLongitude`) VALUES
(72, 'Rockweld farm', 'farm', 'Our names are Tim and Flo Rempel and we are the owners of Rockweld Farm in Abbotsford, B.C.  We raise certified organic fed, BCSPCA Certified, chicken and eggs.\r\n\r\nHours\r\nMonday - Friday 10am -5:30pm\r\nSaturday 9am - 5:30pm', '34205 Townshipline Road', 2, '', NULL, 'http://rockweldfarm.com', 49.0893, -122.273),
(70, 'Gelderman Farms', 'farm', 'Gelderman Farms Ltd. is a family owned pig farm located in the Fraser Valley in Abbotsford B.C. The Gelderman family takes pride in raising quality pork that is tasty and good for your family. Gelderman Farms is primarily focused on providing various cuts of high quality pork from ham and pork chops to bacon but they also offer blueberries in season and fantastic compost for your garden.', '35805 Vye Road', 2, 'V3G 1Z', NULL, 'http://www.geldermanfarms.ca', 49.017, -122.228),
(71, 'Maan Farms', 'farm', 'Welcome to the Maan Farms Country Market! Come stock up on winter squash, beets, carrots, garlic, sweet potatoes,Brussels sprout, cabbage and a variety of other fall veggies at our country Market today.  Frozen berries are also available. Sugar pumpkins and Cinderella pumpkins are available for your pies and soups.\r\n\r\nHours\r\n9am - 6pm\r\nClosed for the winter', '790 McKenzie Road', 2, 'V2S 7N', NULL, 'http://www.maanfarms.com/', 49.0165, -122.282),
(69, 'The Apple Barn', 'farm', '..the farm is full of activities that make the Autumn season worth looking forward to. In 1940 the Great Grandfather John decided to farm the fertile soils in the south part of Abbotsford. Grandson Loren and his wife Corinne have continued the farming with orchards full of crisp sweet apples. Twenty-one years ago they decided to open the farm to the public and now offer all kinds of \r\nfarm family fun!', '333 Gladwin Road', 2, '', NULL, 'http://www.applebarn.ca/', 49.0089, -122.316),
(68, 'Healthee', 'restaurant', 'Although some traditional fast food restaurants are beginning to offer limited "healthy" choices, unhealthy items are still too tempting and are often more reasonably priced. Even healthy options can be nutritionally misleading.\r\n\r\nSo, Healthee was born--a convenient eatery offering healthy tasty food fast. \r\n\r\nHours\r\nMonday to Friday 11am - 8pm\r\nSaturday & Sunday 11am - 6pm', '2277 West 41st ave', 1, 'V6M 2A', NULL, 'http://www.gohealthee.com/', 49.2348, -123.159),
(73, 'Whole Foods', 'market', 'A trendy retailer of health foods, gourmet items, and kitchen ware located in Park Royal mall, by Cactus Club.', '925 Main Street', 18, '', NULL, 'http://wholefoodsmarket.com', 49.3252, -123.143),
(60, 'Organic lives / Granville location', 'restaurant', 'Whether you are eating at our restaurant, shopping at our online store or taking one of our culinary workshops. At OrganicLives, weâ€™re all about the food - how and where itâ€™s grown and sold, the purity of the preparation process, the quality and quantity of the nutrients inside, and, of course, the taste. The mind-blowing, zen-inducing, canâ€™t-peel-the-smile-off-my-face taste. \r\n\r\nHours\r\n11am -7pm', '451 Granville street at West Hasting', 1, 'V5T 1B', NULL, 'http://organiclives.org', 49.2617, -123.139),
(57, 'Greens organic + natural Market', 'market', 'Greens Organic + Natural Market is a new organic and natural market founded by two UBC graduates who are passionate about promoting a sustainable, healthy and fun lifestyle. Our vision is to create a community oriented, grocery store committed to zero-waste, buying local where possible and offering the freshest, tastiest organic and natural foods. Greens is completely independent and proudly 100% BC owned and operated', '1978 W Broadway @ Maple st', 1, 'V6J 1Z', NULL, 'http://www.greensmarket.ca', 49.2638, -123.151),
(54, 'Choices markets Kitsilano', 'market', 'From Kitsilano to Kelowna, our customers enjoy a large selection of organic, natural and specialty food items at fair prices. We''re committed to upholding our vision while providing exceptional customer service in a friendly and welcoming environment. As proud locals, we''ll always be 100% BC owned and operated.\r\n\r\nHours \r\n8am - 11pm', '2627 West 16th ave', 1, 'V3K 3C', NULL, 'http://www.choicesmarket.com', 49.2578, -123.166),
(58, 'Donald''s Market', 'market', 'Donaldâ€™s Market has been serving the Sunrise neighbourhood since 1986. The store has evolved from mostly produce with a small selection of essential grocery to the wide selection we have today. We carry just about everything you need to run your household, including food, drinks, personal care products, cleaning supplies, kitchen tools, pet supplies, and more. We carry both conventional and organic products.', '2279 Commercial Drive', 1, 'V5N 4B', NULL, 'http://www.donaldsmarket.com', 49.2641, -123.07),
(56, 'Whole Foods: Capers community Market', 'market', 'Affectionately dubbed the â€œheartâ€ of the trendy Robson retail area. This store shares a LOT with the West End community; its popular parking lot is home to several events including our annual harvest-time Living Naturally Fair and other open-air celebrations. Its wraparound awning covered outdoor deck is also a popular mealtime destination.\r\n\r\nHours\r\n8am - 8pm', '1675 Robson st', 1, 'V6G 1C', NULL, 'http://wholefoodsmarket.com', 49.2901, -123.133),
(21, 'Gorilla Food', 'restaurant', 'We are an organic, vegan, raw food restaurant, take away and catering service. We also provide a line of prepared, vegan, raw foods and vegan, raw food ingredients available at select retail environments; We can also provide a delivery service, bringing raw foods to you with convenience.\r\n\r\nHours \r\n\r\n11am - 8pm', '101-436 Richards street', 1, '', NULL, 'http://www.gorillafood.com/', 49.2835, -123.113),
(59, 'Panz Veggie', 'restaurant', 'We''re 100% Vegetarian, and even 100% Vegan, with absolutely no meat of any kind, no seafood, and no meat broths or meat by-products.\r\nNo MSG\r\nAffordable pricing and ample-sized helpings.\r\nMeticulously clean and aesthetically pleasing surroundings\r\nCatering available for private parties\r\nDelivery available from\r\n\r\nHours\r\n11am - 9pm', '1355 Hornby Street', 1, '', NULL, 'http://www.panzveggie.com/', 49.2769, -123.131);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `ratingID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `rating` enum('1','2','3','4','5') DEFAULT NULL,
  `listingID` smallint(5) unsigned NOT NULL,
  `userID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ratingID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`ratingID`, `rating`, `listingID`, `userID`) VALUES
(1, '5', 4, 1),
(2, '4', 4, 2),
(3, '3', 4, 3),
(4, '3', 3, 3),
(5, '2', 2, 2),
(6, '1', 1, 1),
(7, '4', 4, 3),
(8, '5', 10, 6),
(9, '5', 65, 6),
(10, '4', 54, 6),
(11, '4', 59, 4),
(12, '4', 58, 4),
(13, '4', 68, 11),
(14, '2', 68, 8);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `reviewTitle` varchar(50) NOT NULL,
  `reviewBody` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `listingID` smallint(5) unsigned NOT NULL,
  `userID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`reviewID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewID`, `reviewTitle`, `reviewBody`, `reviewDate`, `listingID`, `userID`) VALUES
(24, 'Title', 'Review', '2011-12-16 06:00:03', 65, 6),
(25, 'Pretty Good', 'I''ve eaten here a few times when I was in the neighbourhood getting some printing done. Their deli has a good selection, but it''s pretty pricey.', '2011-12-16 08:14:32', 54, 6),
(26, 'Amazing food', 'Again Panz veggie delivered amazing food and customer service.', '2011-12-16 08:15:27', 59, 4),
(27, 'Great selection', 'Again and again Donald market keep having a great selection with a affordable pricing great place to do you shopping', '2011-12-16 08:17:31', 58, 4),
(23, 'Samuel L. Jackson says:', 'Well, the way they make shows is, they make one show. That show''s called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they''re going to make more shows. Some pilots get picked and become television programs. Some don''t, become nothing. She starred in one of the ones that became nothing.', '2011-12-16 02:15:57', 10, 6),
(21, 'good food for a good price', 'Forstbauer family natural food farm is a friendly and affordable place to find all your daily needs', '2011-12-16 01:43:55', 17, 4),
(28, 'bla', 'fnjkdknlds', '2011-12-16 23:13:22', 68, 11),
(29, 'djhj', 'qhjdfjkd', '2011-12-16 23:14:02', 68, 8);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `stockID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `listingID` smallint(5) unsigned NOT NULL,
  `stockTypeID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`stockID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `listingID`, `stockTypeID`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(14, 69, 2),
(13, 65, 3),
(12, 65, 2),
(7, 67, 1),
(8, 67, 2),
(9, 67, 3),
(15, 70, 1),
(16, 70, 2),
(22, 57, 3),
(21, 57, 2),
(20, 57, 1),
(23, 71, 2),
(40, 54, 3),
(39, 54, 2),
(38, 54, 1),
(27, 58, 1),
(28, 58, 2),
(29, 58, 3),
(30, 56, 1),
(31, 56, 2),
(32, 56, 3),
(33, 72, 1),
(34, 72, 3),
(35, 73, 1),
(36, 73, 2),
(37, 73, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stockType`
--

CREATE TABLE IF NOT EXISTS `stockType` (
  `stockTypeID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `stockTypeName` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`stockTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stockType`
--

INSERT INTO `stockType` (`stockTypeID`, `stockTypeName`) VALUES
(1, 'Meat'),
(2, 'Vegetables'),
(3, 'Dairy');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE IF NOT EXISTS `supply` (
  `supplyID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `listingID` smallint(5) unsigned NOT NULL,
  `stockID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`supplyID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`supplyID`, `listingID`, `stockID`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `userPassword` char(40) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPassword`, `userEmail`) VALUES
(1, 'Jorgen', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'JorgenHookham@Gmail.com'),
(2, 'jorgen2', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'JorgenHookham@Gmail.com'),
(3, 'jorgen3', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'JorgenHookham@Gmail.com'),
(4, 'Johanbos', '759412786bc533369b22377bf83fb9056c5b25b2', 'Johanbos1975@gmail.com'),
(8, 'geeofftee', '18cc62c042dea479905eccb76f6ce085cab1b3d8', 'funkeesax@gmail.com'),
(6, 'JorgenScott', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'JorgenHookham@Gmail.com'),
(7, 'kate', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'kate.makarow@gmail.com'),
(9, 'dthomson12', 'baae6d1eb4514d48b8d4de27cdae7eecff04e75e', 'dthomson12@gmail.com'),
(10, 'johnston battleford', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'funkeesax@gmail.com'),
(11, 'geeoff', '18cc62c042dea479905eccb76f6ce085cab1b3d8', 'GThierman@thehub.capilanou.ca'),
(12, 'viv1', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'viv@ien.com'),
(13, 'viv2', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'viv@ien.com'),
(14, 'viv3', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'viv@ien.com'),
(15, 'viv4', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'viv@ien.com'),
(16, 'viv5', '0343bb07c98f8a943e8eb80c0ba3d9758d372d22', 'viv@ien.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
