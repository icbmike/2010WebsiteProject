-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 22, 2010 at 02:48 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `shcmusic`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `alerts`
-- 

CREATE TABLE `alerts` (
  `alert_id` int(11) NOT NULL auto_increment,
  `content` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY  (`alert_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `alerts`
-- 

INSERT INTO `alerts` VALUES (1, 'bio595 deleted you as a friend', 'pianoman', 1, '2010-09-16 21:27:06');
INSERT INTO `alerts` VALUES (10, '<a href="news.php">SHCMUSIC has news</a>', 'bio595', 1, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (11, '<a href="news.php">SHCMUSIC has news</a>', 'goober', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (12, '<a href="news.php">SHCMUSIC has news</a>', 'kowman', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (13, '<a href="news.php">SHCMUSIC has news</a>', 'horseteeth', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (14, '<a href="news.php">SHCMUSIC has news</a>', 'pianoman', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (15, '<a href="news.php">SHCMUSIC has news</a>', 'polglasi', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (16, '<a href="news.php">SHCMUSIC has news</a>', 'tommy', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (17, '<a href="news.php">SHCMUSIC has news</a>', 'pothead', 0, '2010-09-16 22:35:02');
INSERT INTO `alerts` VALUES (18, 'New NCEA Level 2 Resource', 'bio595', 1, '2010-09-16 23:23:46');
INSERT INTO `alerts` VALUES (19, 'New NCEA Level 2 Resource', 'pothead', 0, '2010-09-16 23:23:46');
INSERT INTO `alerts` VALUES (20, '<a href="events.php">SHCMUSIC has a new event</a>', 'bio595', 1, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (21, '<a href="events.php">SHCMUSIC has a new event</a>', 'goober', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (22, '<a href="events.php">SHCMUSIC has a new event</a>', 'kowman', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (23, '<a href="events.php">SHCMUSIC has a new event</a>', 'horseteeth', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (24, '<a href="events.php">SHCMUSIC has a new event</a>', 'pianoman', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (25, '<a href="events.php">SHCMUSIC has a new event</a>', 'polglasi', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (26, '<a href="events.php">SHCMUSIC has a new event</a>', 'tommy', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (27, '<a href="events.php">SHCMUSIC has a new event</a>', 'pothead', 0, '2010-09-16 23:27:01');
INSERT INTO `alerts` VALUES (28, 'New Guitar Resource', 'goober', 0, '2010-09-21 00:24:20');
INSERT INTO `alerts` VALUES (29, 'New Guitar Resource', 'pianoman', 0, '2010-09-21 00:24:20');
INSERT INTO `alerts` VALUES (30, 'New Guitar Resource', 'bio595', 1, '2010-09-21 00:24:20');
INSERT INTO `alerts` VALUES (31, 'New Guitar Resource', 'goober', 0, '2010-09-21 13:37:14');
INSERT INTO `alerts` VALUES (32, 'New Guitar Resource', 'pianoman', 0, '2010-09-21 13:37:14');
INSERT INTO `alerts` VALUES (33, 'New Guitar Resource', 'bio595', 1, '2010-09-21 13:37:14');

-- --------------------------------------------------------

-- 
-- Table structure for table `events`
-- 

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL auto_increment,
  `headline` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `happened` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `events`
-- 

INSERT INTO `events` VALUES (1, 'Smoke Free Rockquest Finals', 'Come see blahdy blahdy blahdy blah, stuff adn toher things', 'images/events/rockquest.jpg', '2010-08-17', 1);
INSERT INTO `events` VALUES (3, 'Booom MOFO', '3 of March, 2012', 'images/events/Seth_boom.jpg', '2010-08-11', 1);
INSERT INTO `events` VALUES (4, 'SHC Legends 2011', 'SHC LEGENDS are here again!<br /><br />Get set to listen to the best of SHC''''s talent?<br />With the SHC bands, also expect the traditional Year 13 performance and other varying displays of talent!', 'images/events/SHC_Logo.png', '2012-12-06', 0);
INSERT INTO `events` VALUES (5, 'Battle Star Galactiva', 'Six is a seductive, statuesque Cylon infiltrator. She was the first example shown of a new generation of Cylons capable of adapting to human form and emotions. Little else is known of her earlier years. She can, like other Cylons, retain memories which can be downloaded into another body if the original body is killed. Like her counterparts, her body was designed to mimic the human body at the cellular level, making her almost undetectable to testing procedures, and there are many copies of her in existence. Sixes and Eights are the Humanoid Cylon models shown most frequently. Sixes tend to have individualistic traits, and are considerably susceptible to the full array of human emotions. Although extremely effective and adaptive, Sixes always show certain disdain for their given chores and dislike being treated as expendable. Most versions of Six have platinum-blonde hair, including Caprica Six, Shelley Godfrey, and Sonja. Others such as Gina Inviere, Natalie, and Lida have honey-blonde hair, and one Six with black hair has been observed.\r<br />[edit] Music\r<br />\r<br />Since her debut in the mini-series, a leitmotif has been used in scenes featuring Tricia Helfer as Six. This simple 9-note motif was composed by Richard Gibbs. The 9/8 figure is divided unevenly into a group of 3 notes, followed by 3 groups of 2. It is almost always performed on a gamelan, and also plays over the introduction to each episode of the series. On the published series soundtrack, the melody is listed as The Sense of Six.\r<br />[edit] Versions\r<br />\r<br />Copies of Number Six appear regularly, mostly within Cylon society. Several notable versions have had more prominent roles:\r<br />[edit] Caprica Six\r<br />\r<br />At the beginning of the miniseries, a Six copy[2] is involved in an intense sexual affair with Dr. Gaius Baltar. Pretending to be an employee of a rival computer corporation, Six seduces Baltar while helping him with his work on the Colonial defense system. Six then reveals her true nature to Baltar, and informs him that the Cylons will use the computer secrets that he has given her to infiltrate the Colonial defense systems, disable the Colonial military, and attack the Twelve Colonies. That day, the Cylons launch their attack and destroy most of humanity. Six uses her body to shield Baltar from a blast during the attack, saving his life and sacrificing hers.[3]\r<br />\r<br />In the episode "Downloaded," this Six copy is downloaded into a new body. Nicknamed "Caprica Six" by fellow Cylons, she is viewed as a hero within the Cylon civilization for her complete success in her mission to compromise the colonies'' defenses. She retains her sentimentality and expresses some regret at her actions, as evidenced by her constant visions of Baltar. This "Head Baltar" acts as a critical counselor and manipulator to her in the same way Head Six does for the real Baltar. Caprica Six is enlisted to motivate the resurrected Galactica copy of Sharon "Boomer" Valerii to move out of her apartment and reintegrate into Cylon society. However, in defiance of their superiors, both Caprica Six and Sharon opt instead to aid Samuel Anders, to the extent that Caprica Six murders a Three to save him. Allowed by the Caprica Cavil, Caprica Six and Sharon then begin preaching peace with the humans as the way of God. This leads them to take over Cylon cu', 'images/events/176637defaultlargezo9.png', '2010-04-03', 1);
INSERT INTO `events` VALUES (6, 'Lets test my new code', 'agjuopasdgfjawgansguobnasdngupoahghnAUPOWHGRIUWG', 'images/events/1.jpg', '2010-08-24', 1);
INSERT INTO `events` VALUES (7, 'Smoke Free Rockquest Finals', 'The national finals of the 2010 Somkefree Rockquest is on the 17th of August at the Hamilton Founders Theatre<br /><br />As well as the competing finalists, also set to play are:<br />J Williams<br />Kids of 88<br />DIE! DIE! DIE!<br />with C4''''s Drew and the Edge''''s Sharyn as MCs<br /><br />The finalists are:<br />Dinosaur Goes Rawr<br />Pleasants of Eden<br />Malcom Jack<br />Custard Bear<br />The Good Fun<br />Te Paamu<br />Kriston<br />and SHC''''s own Massad Barakat Devine!<br /><br />The event starts at 7pm and tickets are $20 only available through tiketek<br />See you there!', 'images/events/rockquest.jpg', '2011-10-02', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `friends`
-- 

CREATE TABLE `friends` (
  `friendship_id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  KEY `friendship_id` (`friendship_id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `friends`
-- 

INSERT INTO `friends` VALUES (2, 'bio595', 1);
INSERT INTO `friends` VALUES (2, 'pothead', 1);
INSERT INTO `friends` VALUES (4, 'goober', 1);
INSERT INTO `friends` VALUES (4, 'pianoman', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `lessons`
-- 

CREATE TABLE `lessons` (
  `instrument` varchar(50) NOT NULL,
  `day` int(1) NOT NULL,
  `period` int(11) NOT NULL,
  `student` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `lessons`
-- 

INSERT INTO `lessons` VALUES ('guitar', 1, 1, 'Chris Dooley, Sam Chevin');
INSERT INTO `lessons` VALUES ('guitar', 3, 6, 'Michael Penbroke');
INSERT INTO `lessons` VALUES ('guitar', 2, 5, '');
INSERT INTO `lessons` VALUES ('guitar', 5, 1, 'Sam Chevin');
INSERT INTO `lessons` VALUES ('guitar', 1, 2, '');
INSERT INTO `lessons` VALUES ('guitar', 1, 3, '');
INSERT INTO `lessons` VALUES ('guitar', 1, 4, '');
INSERT INTO `lessons` VALUES ('guitar', 1, 5, '');
INSERT INTO `lessons` VALUES ('guitar', 2, 1, '');
INSERT INTO `lessons` VALUES ('guitar', 2, 2, '');
INSERT INTO `lessons` VALUES ('guitar', 2, 3, '');
INSERT INTO `lessons` VALUES ('guitar', 2, 4, '');
INSERT INTO `lessons` VALUES ('guitar', 1, 6, '');
INSERT INTO `lessons` VALUES ('guitar', 2, 6, '');
INSERT INTO `lessons` VALUES ('guitar', 3, 1, '');
INSERT INTO `lessons` VALUES ('guitar', 3, 2, '');
INSERT INTO `lessons` VALUES ('guitar', 3, 3, '');
INSERT INTO `lessons` VALUES ('guitar', 3, 4, '');
INSERT INTO `lessons` VALUES ('guitar', 3, 5, '');
INSERT INTO `lessons` VALUES ('guitar', 4, 1, '');
INSERT INTO `lessons` VALUES ('guitar', 4, 2, '');
INSERT INTO `lessons` VALUES ('guitar', 4, 3, '');
INSERT INTO `lessons` VALUES ('guitar', 4, 4, '');
INSERT INTO `lessons` VALUES ('guitar', 4, 5, 'Michael Little');
INSERT INTO `lessons` VALUES ('guitar', 4, 6, '');
INSERT INTO `lessons` VALUES ('guitar', 5, 2, '');
INSERT INTO `lessons` VALUES ('guitar', 5, 3, '');
INSERT INTO `lessons` VALUES ('guitar', 5, 4, '');
INSERT INTO `lessons` VALUES ('guitar', 5, 5, '');
INSERT INTO `lessons` VALUES ('guitar', 5, 6, '');
INSERT INTO `lessons` VALUES ('Bassoon', 1, 1, '');
INSERT INTO `lessons` VALUES ('Bassoon', 1, 2, '');
INSERT INTO `lessons` VALUES ('Bassoon', 1, 3, '');
INSERT INTO `lessons` VALUES ('Bassoon', 1, 4, '');
INSERT INTO `lessons` VALUES ('Bassoon', 1, 5, '');
INSERT INTO `lessons` VALUES ('Bassoon', 1, 6, '');
INSERT INTO `lessons` VALUES ('Bassoon', 2, 1, 'Sam Chevin');
INSERT INTO `lessons` VALUES ('Bassoon', 2, 2, '');
INSERT INTO `lessons` VALUES ('Bassoon', 2, 3, '');
INSERT INTO `lessons` VALUES ('Bassoon', 2, 4, '');
INSERT INTO `lessons` VALUES ('Bassoon', 2, 5, '');
INSERT INTO `lessons` VALUES ('Bassoon', 2, 6, '');
INSERT INTO `lessons` VALUES ('Bassoon', 3, 1, '');
INSERT INTO `lessons` VALUES ('Bassoon', 3, 2, '');
INSERT INTO `lessons` VALUES ('Bassoon', 3, 3, '');
INSERT INTO `lessons` VALUES ('Bassoon', 3, 4, '');
INSERT INTO `lessons` VALUES ('Bassoon', 3, 5, '');
INSERT INTO `lessons` VALUES ('Bassoon', 3, 6, '');
INSERT INTO `lessons` VALUES ('Bassoon', 4, 1, '');
INSERT INTO `lessons` VALUES ('Bassoon', 4, 2, '');
INSERT INTO `lessons` VALUES ('Bassoon', 4, 3, '');
INSERT INTO `lessons` VALUES ('Bassoon', 4, 4, '');
INSERT INTO `lessons` VALUES ('Bassoon', 4, 5, '');
INSERT INTO `lessons` VALUES ('Bassoon', 4, 6, '');
INSERT INTO `lessons` VALUES ('Bassoon', 5, 1, '');
INSERT INTO `lessons` VALUES ('Bassoon', 5, 2, '');
INSERT INTO `lessons` VALUES ('Bassoon', 5, 3, '');
INSERT INTO `lessons` VALUES ('Bassoon', 5, 4, '');
INSERT INTO `lessons` VALUES ('Bassoon', 5, 5, '');
INSERT INTO `lessons` VALUES ('Bassoon', 5, 6, '');
INSERT INTO `lessons` VALUES ('Clarinet', 1, 1, 'Alex Polglase');
INSERT INTO `lessons` VALUES ('Clarinet', 1, 2, '');
INSERT INTO `lessons` VALUES ('Clarinet', 1, 3, '');
INSERT INTO `lessons` VALUES ('Clarinet', 1, 4, '');
INSERT INTO `lessons` VALUES ('Clarinet', 1, 5, '');
INSERT INTO `lessons` VALUES ('Clarinet', 1, 6, '');
INSERT INTO `lessons` VALUES ('Clarinet', 2, 1, '');
INSERT INTO `lessons` VALUES ('Clarinet', 2, 2, '');
INSERT INTO `lessons` VALUES ('Clarinet', 2, 3, '');
INSERT INTO `lessons` VALUES ('Clarinet', 2, 4, '');
INSERT INTO `lessons` VALUES ('Clarinet', 2, 5, '');
INSERT INTO `lessons` VALUES ('Clarinet', 2, 6, '');
INSERT INTO `lessons` VALUES ('Clarinet', 3, 1, '');
INSERT INTO `lessons` VALUES ('Clarinet', 3, 2, '');
INSERT INTO `lessons` VALUES ('Clarinet', 3, 3, '');
INSERT INTO `lessons` VALUES ('Clarinet', 3, 4, '');
INSERT INTO `lessons` VALUES ('Clarinet', 3, 5, '');
INSERT INTO `lessons` VALUES ('Clarinet', 3, 6, '');
INSERT INTO `lessons` VALUES ('Clarinet', 4, 1, '');
INSERT INTO `lessons` VALUES ('Clarinet', 4, 2, '');
INSERT INTO `lessons` VALUES ('Clarinet', 4, 3, '');
INSERT INTO `lessons` VALUES ('Clarinet', 4, 4, '');
INSERT INTO `lessons` VALUES ('Clarinet', 4, 5, '');
INSERT INTO `lessons` VALUES ('Clarinet', 4, 6, '');
INSERT INTO `lessons` VALUES ('Clarinet', 5, 1, '');
INSERT INTO `lessons` VALUES ('Clarinet', 5, 2, '');
INSERT INTO `lessons` VALUES ('Clarinet', 5, 3, '');
INSERT INTO `lessons` VALUES ('Clarinet', 5, 4, '');
INSERT INTO `lessons` VALUES ('Clarinet', 5, 5, '');
INSERT INTO `lessons` VALUES ('Clarinet', 5, 6, '');
INSERT INTO `lessons` VALUES ('Piano', 1, 1, '');
INSERT INTO `lessons` VALUES ('Piano', 1, 2, '');
INSERT INTO `lessons` VALUES ('Piano', 1, 3, '');
INSERT INTO `lessons` VALUES ('Piano', 1, 4, '');
INSERT INTO `lessons` VALUES ('Piano', 1, 5, '');
INSERT INTO `lessons` VALUES ('Piano', 1, 6, '');
INSERT INTO `lessons` VALUES ('Piano', 2, 1, '');
INSERT INTO `lessons` VALUES ('Piano', 2, 2, '');
INSERT INTO `lessons` VALUES ('Piano', 2, 3, '');
INSERT INTO `lessons` VALUES ('Piano', 2, 4, '');
INSERT INTO `lessons` VALUES ('Piano', 2, 5, 'Michael Little');
INSERT INTO `lessons` VALUES ('Piano', 2, 6, '');
INSERT INTO `lessons` VALUES ('Piano', 3, 1, '');
INSERT INTO `lessons` VALUES ('Piano', 3, 2, '');
INSERT INTO `lessons` VALUES ('Piano', 3, 3, '');
INSERT INTO `lessons` VALUES ('Piano', 3, 4, '');
INSERT INTO `lessons` VALUES ('Piano', 3, 5, '');
INSERT INTO `lessons` VALUES ('Piano', 3, 6, '');
INSERT INTO `lessons` VALUES ('Piano', 4, 1, '');
INSERT INTO `lessons` VALUES ('Piano', 4, 2, '');
INSERT INTO `lessons` VALUES ('Piano', 4, 3, '');
INSERT INTO `lessons` VALUES ('Piano', 4, 4, '');
INSERT INTO `lessons` VALUES ('Piano', 4, 5, '');
INSERT INTO `lessons` VALUES ('Piano', 4, 6, '');
INSERT INTO `lessons` VALUES ('Piano', 5, 1, '');
INSERT INTO `lessons` VALUES ('Piano', 5, 2, '');
INSERT INTO `lessons` VALUES ('Piano', 5, 3, '');
INSERT INTO `lessons` VALUES ('Piano', 5, 4, '');
INSERT INTO `lessons` VALUES ('Piano', 5, 5, '');
INSERT INTO `lessons` VALUES ('Piano', 5, 6, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `news`
-- 

CREATE TABLE `news` (
  `news_id` int(50) NOT NULL auto_increment,
  `headline` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `news`
-- 

INSERT INTO `news` VALUES (1, '3 Rock Quest Wins!!!', 'Sacred Heart Music is on the rise again!\r\n<br /><br />\r\nWe often quote are musical talent as New Zealand artists like the Finn Brothers and Dave Dobbyn from the 60s and early 70s.\r\n<br />\r\n<br />\r\nHowever it may seem that a new generation of prolific Sacred Heart Musicians has emerged.\r\n<br />\r\n<br />\r\nOn 19th of June were the Auckland Eastern regional finals and on 23rd of May were the Central finals.\r\n\r\nSHC had 3 wins!\r\nHey Hey Payday,(Greg Chang, Thomas Plank, Byron Terris and Nick Davies) took first place at the Eastern Regional Finals and the Black Jacks(Harry Glynn,\r\nMatt Kirk,\r\nSaua Leaupepe,\r\nBrendan Ford)\r\ntook 3rd place.\r\n<br />\r\nMassad Barakat Devine took second at the Central Finals.\r\n<br />\r\n<br />\r\nHey Hey Payday also won the Lowdown Best Song Award.\r\n<br /><br />\r\nGreg Chang of Hey Hey Payday was quoted: \r\n<br /><br />\r\n"The best thing about smokefreerockquest is getting to play<br />\r\nin front of an audience - and I love being up on stage and<br />\r\nhearing the fans screaming."', 'images/news/rockquest.png', '2010-08-20');
INSERT INTO `news` VALUES (2, 'ZOMG - MASSAD WINS STUFF AGAIN!!!', 'Howdy Screeners! It''s another glorious Saturday here in San Francisco. It''s overcast, around 55 degrees outside, but it''s awfully warm here in my apartment...oh, right, I left the oven on overnight. Sure was a toasty sleep I had. Anyway, enough about me: let''s talk about you! We have another solid week of Screened.com edits and publishes and talkings and meanderings to cover, so let''s get down to business. Big thanks to user Skidd for a bunch of this week''s links and nominations!\r\n\r\nUser Reviews:   \r\nLots of new movies coming out this weekend, so let''s see what people are saying about the biggies first: \r\n\r\n    *   Theshanetrane and spencerboltz check out Piranha 3D, and spencerboltz also somehow manages to lay down the law on Vampires Suck and The Switch. \r\n    * I mostly concur with Olivaw''s thoughts on Signs. \r\n    * The prolific spencerboltz lets us know his thoughts on the ever-to-be-remade Logan''s Run. \r\n    * I have never seen Aeon Flux, but I somehow suspect that skidd is right when he pans the film. \r\n    * Vapnik tells us all about how awesome Universal Soldier: Regeneration is. You heard him!\r\n    * I like Tomrock''s take on Starship Troopers.\r\n\r\n \r\nWiki Edits\r\n\r\n    * HT101 responds to my bounty on Star Wars Episode II with an excellent overview and image dump.  \r\n    * I love it when people do good edits on Objects for some reason. Joe''s scholarly work on Polyjuice Potion, for example. Or flap_jackson''s work on the Concept of Daleks. Good job!\r\n    * I suspect we might have featured this before, but in any case, it''s worth another look: Count_Zero''s page on Doctor Who (The Doctor character, more specifically) is a model of what I like to see pages look like on the site. \r\n    * natetodamax busted out on the I Am Legend page and makes it real purty-like. \r\n    * GhostyGhost puts down a great page on Nolan''s Insomnia, aka "the movie everyone forgets that Nolan directed".\r\n    * TheSacredTurf gets us up to date on WarGames. Be sure to check out his timestamped quotes! (I love that feature of our site.)\r\n\r\n\r\nForum Posts\r\n\r\n    * Good post on a concept forum: tsigo asks which movies have the worst twist endings. \r\n    * Freezerr wants to know the best movie you''ve never watched.\r\n    * BrowncoatGrimm writes an impassioned defense of Star Trek: Voyager.\r\n    * Mushir takes a classic question from Fight Club and turns it into a forum topic.\r\n    * ScanCase points out a 2012 Trailer edit he did. Good stuff!\r\n    * Perhaps a bit early, but Hawkeye lets us know his top ten albums of 2010. \r\n    * Ox tells us a story about his first viewing of The Happening.\r\n\r\n \r\nUser lists\r\n\r\n    *   ScanCase comes up with lists of the worst superhero movies, and the best.\r\n\r\n\r\n \r\nHey, I Did Good Stuff Too!  \r\nWant to get your content featured in the future? Well, first off, make sure it''s top-notch. If you''re making a user review or editing the wiki, be sure to use the image tools to throw in some pictures or videos or bullet points and spice it up a bit! Ensure that it''s all well-written (maybe have another user edit it for you?) and free of misspellings.  \r\n  \r\nIf you want to submit something for next week''s list, you can do so via this forum thread. I am virile and my stamina is unmatched, and yet the site is a bit too big for me to find all the cool content that you guys rock out every week. But if you post in that thread, it''ll be a lot easier for me to make sure that I have your nominations all in a line. ', 'images/news/inception.jpeg', '2010-08-01');
INSERT INTO `news` VALUES (3, 'Plans for new Music Block - Finally', 'There''s plans for a new music block in the patch of grass by Gate 1 and Crossfield Road.\r\n\r\nAfter the hand me downs of the old year 7 and 8 block this is welcome, the only downside is that no one of the current generation of SHC students will be around when it will be opened.\r\n\r\nThe new block is set for 9 years from now, so the students of 2019 will be the luckiest of all.', 'images/news/Auckland_Sacred_Heart_College.jpg', '2010-08-19');

-- --------------------------------------------------------

-- 
-- Table structure for table `photos`
-- 

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL auto_increment,
  `album` varchar(50) NOT NULL default 'other',
  `URL` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY  (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `photos`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `resources`
-- 

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL auto_increment,
  `resource_name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `links` text NOT NULL,
  `NCEA_level` int(11) NOT NULL,
  `standard_number` varchar(6) NOT NULL default '0',
  `instrument` varchar(20) NOT NULL,
  `grade` int(11) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY  (`resource_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `resources`
-- 

INSERT INTO `resources` VALUES (1, '90776 - Perform Solo Pieces', 'aklsfkjsnaqfjknaskjfb SOLO', '#', 3, '90776', '', 0, '0000-00-00');
INSERT INTO `resources` VALUES (2, 'Pentatonic Guitar Scales', 'blahdy blah blah blah', 'www.ultimate-guitar.com', 0, '', 'Guitar', 0, '0000-00-00');
INSERT INTO `resources` VALUES (3, 'Guitar Scales', 'Blahdy Blah Blah Blah', 'www.ultimate-guitar.com', 0, '', 'Guitar', 0, '0000-00-00');
INSERT INTO `resources` VALUES (5, '90526 - Group Performance', 'adfaewngonsdlkgnlkawMDVK''Lnwrlkgmnwldgnlk''WNG', '', 3, '90526', '', 0, '0000-00-00');
INSERT INTO `resources` VALUES (6, '90264 - Solo Performnace', 'afaefhgwhagasfg', '', 2, '90264', '', 0, '0000-00-00');
INSERT INTO `resources` VALUES (7, 'Piano licks', 'sadasdgDWGASDFGASDFASDFASDF', '', 0, '', 'Piano', 3, '0000-00-00');
INSERT INTO `resources` VALUES (8, '90265 - Group Performance', 'Explanatory Notes\r<br />1 This achievement standard is derived from The Arts in the New Zealand Curriculum,\r<br />Learning Media, Ministry of Education, 2000, Level 7 strand, Communicating and\r<br />Interpreting Meaning in Music.\r<br />2 The performance must be before an audience and may be based in a classroom, school\r<br />or community. The performance should be video recorded for checking assessment and\r<br />moderation purposes.\r<br />Number AS90265 Version 2 Page 2 of 2\r<br />3 The performance could comprise a selection of short pieces or an extended piece or\r<br />pieces.\r<br />4 Ideally a group consists of 3-7 members. Where there are only 2 in a group, careful\r<br />consideration must be given to the selection of music to ensure ensemble awareness is\r<br />assessable ie soloist/accompanist is not acceptable.\r<br />5 The contribution of a student in a group performance must be uniquely identifiable and\r<br />assessable.\r<br />6 The performance should show evidence of technical skills, accuracy, ensemble\r<br />awareness and presentation.\r<br />â€¢ Technical skills refer to techniques specific to the instrument being used for the\r<br />performance.\r<br />â€¢ Accuracy refers to the degree of precision as communicated from the written score\r<br />or the aural transcription, with the understanding that performances are seldom\r<br />completely accurate.\r<br />â€¢ Ensemble awareness refers to the individual contribution to the cohesive sound of\r<br />the group including sensitivity to the composerâ€™s intention and awareness of\r<br />intonation, blend and balance, tempo, style and feel.\r<br />â€¢ Presentation refers to the sense of performance appropriate to the genre and style\r<br />of the music. This also includes rapport and communication with the audience,\r<br />appropriate posture and stagecraft.\r<br />7 The performance should reflect the technical and musical demands equivalent to a\r<br />fourth year of study through itinerant lessons.\r<br />8 Improvisation skills are assessed where appropriate to the musical style.', 'http://www.nzqa.govt.nz/nqfdocs/ncea-resource/achievements/2005/as90265.pdf', 2, '90265', '', 0, '2010-09-16');
INSERT INTO `resources` VALUES (12, 'Major and Minor Pentatonic Scales', 'One thing that confuses a lot of guitarists is the use of the minor and major pentatonic scales.\r<br />\r<br />The the minor scales that are outlined below, in the key of "A", are simply patterns that can be moved up and down the neck. Putting these patterns in the key of "A" means that the notes that have an "R" after them, or the root notes, are on an "A" note.\r<br />\r<br />Minor Patterns\r<br />\r<br />\r<br />Pattern 1\r<br />E||----------------------|----------------------|------------3----5R---|\r<br />B||----------------------|----------------------|--3----5--------------|\r<br />G||----------------------|------------2R---5----|----------------------|\r<br />D||----------------------|--2----5--------------|----------------------|\r<br />A||------------3----5----|----------------------|----------------------|\r<br />E||--3----5R-------------|----------------------|----------------------|\r<br />\r<br />Pattern 2\r<br />----------------------|----------------------|------------5R---8----|\r<br />----------------------|----------------------|--5----8--------------|\r<br />----------------------|------------5----7----|----------------------|\r<br />----------------------|--5----7R-------------|----------------------|\r<br />------------5----7----|----------------------|----------------------|\r<br />--5R---8--------------|----------------------|----------------------|\r<br />\r<br />Pattern 3\r<br />------------------------|-----------------------|-------------8----10----|\r<br />------------------------|-----------------------|--8----10R--------------|\r<br />------------------------|-------------7----9----|------------------------|\r<br />------------------------|--7R---10--------------|------------------------|\r<br />-------------7----10----|-----------------------|------------------------|\r<br />--8----10---------------|-----------------------|------------------------|\r<br />\r<br />Pattern 4\r<br />--------------------------|-------------------------|--------------10----12----|\r<br />--------------------------|-------------------------|--10R----13-----------\r<br />--------------------------|--------------9----12----|--------------------------|\r<br />--------------------------|--10----12---------------|--------------------------|\r<br />--------------10----12R---|-------------------------|--------------------------|\r<br />--10----12----------------|-------------------------|--------------------------|\r<br />\r<br />Pattern 5\r<br />--------------------------|--------------------------|--------------12----15----|\r<br />--------------------------|--------------------------|--13----15----------------|\r<br />--------------------------|--------------12----14R---|--------------------------|\r<br />--------------------------|--12----14----------------|--------------------------|\r<br />--------------12R----15---|--------------------------|-----------------------\r<br />--12----15----------------|--------------------------|--------------------------|\r<br />\r<br />Pattern 6\r<br />--------------------------|--------------------------|--------------15----17R---||\r<br />--------------------------|--------------------------|--15----17----------------||\r<br />--------------------------|--------------14R---17----|-----------------------\r<br />--------------------------|--14----17----------------|--------------------------||\r<br />--------------15----17----|--------------------------|--------------------------||\r<br />--15----17R---------------|--------------------------|--------------------------||\r<br />\r<br />Here you can see that pattern 6 has the same shape as pattern 1 and it''s root notes in the same place, but is exactly 12 frets up the fretboard, meaning all the notes in pattern 6 are one octave higher then pattern 1.\r<br />\r<br />The major pentatonic scales use the same patterns but with the root notes in a different place to produce a different tonic "progression", which is basically the music theory way of saying it makes it sound major, instead of minor. Here are the same 6 patterns on the neck but with the roots in different areas.\r<br />\r<br />Major Patterns\r<br />\r<br />\r<br />Pattern 1\r<br />E||----------------------|----------------------|------------3----5----|\r<br />B||----------------------|----------------------|--3----5--------------|\r<br />G||----------------------|------------2----5R---|----------------------|\r<br />D||----------------------|--2----5--------------|----------------------|\r<br />A||------------3R---5----|----------------------|----------------------|\r<br />E||--3----5--------------|----------------------|----------------------|\r<br />\r<br />Pattern 2\r<br />----------------------|----------------------|------------5----8R---|\r<br />----------------------|----------------------|--5----8--------------|\r<br />----------------------|------------5R---7----|----------------------|\r<br />----------------------|--5----7--------------|----------------------|\r<br />------------5----7----|----------------------|----------------------|\r<br />--5----8R-------------|----------------------|----------------------|\r<br />\r<br />Pattern 3\r<br />------------------------|-----------------------|-------------8R---10----|\r<br />------------------------|-----------------------|--8----10---------------|\r<br />------------------------|-------------7----9----|------------------------|\r<br />------------------------|--7----10R-------------|------------------------|\r<br />-------------7----10----|-----------------------|------------------------|\r<br />--8R---10---------------|-----------------------|------------------------|\r<br />\r<br />Pattern 4\r<br />--------------------------|-------------------------|--------------10----12----|\r<br />--------------------------|-------------------------|--10----13R---------------|\r<br />--------------------------|--------------9----12----|--------------------------|\r<br />--------------------------|--10R---12---------------|----------------------\r<br />--------------10----12----|-------------------------|--------------------------|\r<br />--10----12----------------|-------------------------|--------------------------|\r<br />\r<br />Pattern 5\r<br />--------------------------|--------------------------|--------------12----15----|\r<br />--------------------------|--------------------------|--13R---15------------\r<br />--------------------------|--------------12----14----|--------------------------|\r<br />--------------------------|--12----14----------------|--------------------------|\r<br />--------------12----15R---|--------------------------|--------------------------|\r<br />--12----15----------------|--------------------------|--------------------------|\r<br />\r<br />Pattern 6\r<br />--------------------------|--------------------------|--------------15----17----||\r<br />--------------------------|--------------------------|--15----17----------------||\r<br />--------------------------|--------------14----17R---|--------------------------||\r<br />--------------------------|--14----17----------------|--------------------------||\r<br />--------------15R---17----|--------------------------|---------------------\r<br />--15----17----------------|--------------------------|--------------------------||\r<br />\r<br />\r<br />Here you can see that the same patterns but the roots have been changed. The change in roots for the patterns isnt very difficult at all. You can take the the pattern for the Minor scale, and root moves up one note.\r<br />\r<br />So in the case of pattern 2, The root note for the minor is on the 5th fret, and the root note for the major is on the 8th fret. So all you are doing is moving the root one note forward in the pattern to change from minor to major.\r<br />\r<br />These major patterns also fall into a different key because there is a change in the root note. These patterns shown above are the C major Pentatonic scales. What?!?! You might think this is strange, but starting at the root note, they have totally different tone feel. So the A minor pentatonic scale and the C major pentatonic scale might be made of the same notes (A C D E G) but depending on what note you start on, you give the scale a whole different feel.\r<br />\r<br />All you need to do is learn the 5 patterns and how the root notes change for major and minor scales and you will be well on your way to being able to improvise a solo over nearly every song your hear. This is one of the most powerful tools for a learning guitarist. So make sure to memorise the patterns and think about how to apply them, use your ears and have fun!', 'http://www.ultimate-guitar.com/lessons/scales/major_and_minor_pentatonics.html', 0, '0', 'Guitar', 0, '2010-09-21');
INSERT INTO `resources` VALUES (13, 'Modes on Guitar', 'Modes Explained.\r<br />\r<br />\r<br />\r<br />C Ionian:     C D E F G A B C\r<br />D Dorian:     D E F G A B C D\r<br />E Phrygian:   E F G A B C D E\r<br />F Lydian:     F G A B C D E F\r<br />G Mixolydian: G A B C D E F G\r<br />A Aeolian:    A B C D E F G A\r<br />B Locrian:    B C D E F G A B\r<br />\r<br />Ionian:\r<br />The Ionian mode is just the major scale. So you take the root and follow this pattern to produce the notes of the major scale: Tone, Tone, Semitone, Tone, Tone, Tone, Semitone. So, for the C major scale it would be C D E F G A B C.\r<br />\r<br />Dorian:\r<br />The Dorian mode is a minor scale with an added lift. THe D minor scale would be D E F G A Bb C. However, you raise the sixth note of the minor scale to produce the Dorian mode. So the D Dorian scale is D E F G A B C.\r<br />\r<br />Phrygian:\r<br />The Phrygian mode also resembles a minor scale, but unlike the Dorian mode it has a different altered note. The second note of the Minor scale is lowered a half step to produce the Phrygian mode for that root note. E minor: E F# G A B C D. E Phrygian: E F G A B C D.\r<br />\r<br />Lydian:\r<br />The Lydian mode resembles the major scale this time but with an altered note (like every mode but two in here). The F major scale is F G A Bb C D E F. The F Lydian mode is F G A B C D E. The difference is the raised fourth pitch. So, you raise the fourth note in the major scale one half step to get the Lydian mode for that root.\r<br />\r<br />Mixolydian:\r<br />The Mixolydian mode also resembles the major scale but, again, another altered note. This time the altered note is the seventh note. When switching to Mixolydian, you lower the seventh note of the scale one half step. The G major scale is G A B C D E F# G while the G Mixolydian scale is G A B C D E F G.\r<br />\r<br />Aeolian:\r<br />The Aeolian scale is another name for the Minor scale, just as the Ionian is another name for the major scale. The A minor scale is A B C D E F G A while the A Aeolian scale is, you guessed it, the same thing! But, when you look at the notes for the C major scale and the A minor scale and you noticed that they contain the same notes, you ask how can one sound sad and the other happy. Well, it''s just the placement of the notes.\r<br />\r<br />Locrian:\r<br />The seventh and final mode is Locrian. Wow, we made it this far already, not bad. But, anyways, the Locrian mode is the "ugly duckling" of all of the modes because of its unusual construction. The Locrian mode is a minor scale with a lowered second and a lowered fifth. So, the B minor scale is B C# D E F# G A B while the B Locrian mode is B C D E F G A B!\r<br />\r<br />Mode Charts:\r<br />\r<br />\r<br />\r<br />Legend:\r<br />0 - Root Note\r<br />1 - index\r<br />2 - middle\r<br />3 - ring\r<br />4 - pinkie\r<br />\r<br />Note: Sixth String Root.\r<br />\r<br />\r<br />Ionian: MAJOR SCALE.\r<br />\r<br />Dorian:\r<br />|---|-0-|---|-3-|-4-|\r<br />|---|-1-|---|-3-|-4-|\r<br />|-1-|-2-|---|-4-|---|\r<br />|-1-|-2-|---|-0-|---|\r<br />|---|-1-|---|-3-|---|\r<br />|---|-0-|---|-3-|-4-|\r<br />\r<br />Phrygian:\r<br />|-0-|-2-|---|-4-|\r<br />|-1-|-2-|---|-4-|\r<br />|-1-|---|-3-|---|\r<br />|-1-|---|-0-|-4-|\r<br />|-1-|---|-3-|-4-|\r<br />|-0-|-2-|---|-4-|\r<br />\r<br />Lydian:\r<br />|-1-|-0-|---|-4-|\r<br />|-1-|-2-|---|-4-|\r<br />|-1-|---|-3-|---|\r<br />|-1-|---|-3-|-0-|\r<br />|-1-|---|-3-|-4-|\r<br />|---|-0-|---|-4-|\r<br />\r<br />Mixolydian:\r<br />|---|-0-|---|---|---|\r<br />|---|-1-|---|-3-|-4-|\r<br />|-1-|---|-3-|-4-|---|\r<br />|-1-|-2-|---|-0-|---|\r<br />|-1-|-2-|---|-4-|---|\r<br />|---|-0-|---|-4-|---|\r<br />\r<br />Aeolian: MINOR SCALE.\r<br />\r<br />Locrian:\r<br />|-0-|---|---|---|\r<br />|---|-2-|---|-4-|\r<br />|-1-|---|-3-|-4-|\r<br />|-1-|---|-0-|-4-|\r<br />|-1-|-2-|---|-4-|\r<br />|-0-|-2-|---|-4-|\r<br />', 'http://www.ultimate-guitar.com/lessons/scales/modes_explained.html, http://www.ultimate-guitar.com/lessons/scales/major_scale_modes.html', 0, '0', 'Guitar', 0, '2010-09-21');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `user_id` int(50) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL default 'blah',
  `full_name` varchar(50) NOT NULL default 'blah',
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `homeroom` varchar(50) NOT NULL,
  `instruments` varchar(50) NOT NULL,
  `bands` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(80) NOT NULL default 'images/users/default.jpg',
  `admin` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'bio595', 'Michael Little', '8e606f8c5b8988b7e7820c76fccc26ae', 'bio595@gmail.com', '13JW', 'Piano, Guitar', 'Tool, Vivaldi, Linkin Park', 'asdasdasdasd', 'images/users/lego_guitar.jpg', 1);
INSERT INTO `users` VALUES (2, 'goober', 'Michael Penbroke', '8e606f8c5b8988b7e7820c76fccc26ae', 'asdasd', '13TL', 'Saxophone, Piano', 'Pendulum, the Black Jacks', 'blahdy blahdy blah', 'images/users/lego_guitar.jpg1', 0);
INSERT INTO `users` VALUES (3, 'kowman', 'Chris Coates-Walker', '435ad1c6dd4b9f2b1bcb4ebca2b72fb4', 'bio595@gmail.com', '13 JW', 'Piano, Guitar', 'Pink Floyd, Iron Maiden, Metallica', 'I''m strawberry blonde! NOT GINGER!!!', 'images/users/strawberry_dvo_dotcom.jpg1', 0);
INSERT INTO `users` VALUES (4, 'horseteeth', 'Robby Lopez', '435ad1c6dd4b9f2b1bcb4ebca2b72fb4', 'bio595@gmail.com', '13TL', 'Clarinet, Guitar, Drums, Bass, Piano', 'Ministry of Sound, Chris Cornell, Deadmau5', 'I''m a huge dickhead', 'images/users/horse.jpeg2', 0);
INSERT INTO `users` VALUES (5, 'pianoman', 'Sam Chevin', 'ef2956dbd847d84f5b8c3f8371006b50', 'bio595@gmail.com', '13XX', 'piano, bassoon, clarinet', 'Pendulum', 'I have a girlfriend, a awesome yellow car, and a slick haircut.\r<br />\r<br />Oh and I like cheese', 'images/users/cheese.gif1', 0);
INSERT INTO `users` VALUES (6, 'polglasi', 'Alex Polglase', '435ad1c6dd4b9f2b1bcb4ebca2b72fb4', 'mjfatso@gmail.com', '13HG', 'Bass Clarinet, Piano', 'P!nk, Kids of 88, La Roux', 'I''m possibly gay and have a hot sister', 'images/users/Swastika_Symbol.png', 0);
INSERT INTO `users` VALUES (7, 'tommy', 'Tom Plank', '435ad1c6dd4b9f2b1bcb4ebca2b72fb4', 'bio595@gmail.com', '13TL', 'Bass Guitar, Guitar, Tuba', 'Hey Hey Payday, the Blackjacks, the Silver Bullets', 'I have curly hair and a younger brother who smiles too much', 'images/users/electric-g-4mm-bass-guitar-red-burst.jpg1', 0);
INSERT INTO `users` VALUES (8, 'pothead', 'Chris Dooley', 'a93cfb341592ba70dfb60226afecc3a0', 'asd', '13AG', 'Guitar, Bass Guitar, Drums', 'Bob Marley, Metallica', 'I''m going to be a failure and a midget', 'images/users/cannabis_leaf.gif', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `user_standards`
-- 

CREATE TABLE `user_standards` (
  `user` varchar(20) NOT NULL,
  `standard_number` int(6) NOT NULL,
  KEY `user` (`user`,`standard_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `user_standards`
-- 

INSERT INTO `user_standards` VALUES ('bio595', 90264);
INSERT INTO `user_standards` VALUES ('bio595', 90498);
INSERT INTO `user_standards` VALUES ('bio595', 90526);
INSERT INTO `user_standards` VALUES ('pothead', 90264);
INSERT INTO `user_standards` VALUES ('pothead', 90266);
INSERT INTO `user_standards` VALUES ('pothead', 90267);
INSERT INTO `user_standards` VALUES ('pothead', 90526);
INSERT INTO `user_standards` VALUES ('pothead', 90775);
INSERT INTO `user_standards` VALUES ('pothead', 90776);
INSERT INTO `user_standards` VALUES ('tommy', 90497);
INSERT INTO `user_standards` VALUES ('tommy', 90498);
INSERT INTO `user_standards` VALUES ('tommy', 90499);
INSERT INTO `user_standards` VALUES ('tommy', 90526);
INSERT INTO `user_standards` VALUES ('tommy', 90530);
