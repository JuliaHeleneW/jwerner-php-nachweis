SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `albums` (
`albumId` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`description` varchar(500) NOT NULL,
`bandId` int(11) NOT NULL,
`genreId` int(11) NOT NULL,
`price` float NOT NULL,
`cover` varchar(200) NOT NULL,
`releaseDate` date NOT NULL,
PRIMARY KEY (`albumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

INSERT INTO `albums` (`albumId`, `name`, `description`, `bandId`, `genreId`, `price`, `cover`, `releaseDate`) VALUES
(1, 'The Stage', 'The Stage is the seventh studio album by American heavy metal band Avenged Sevenfold. It is a concept album about artificial intelligence and self-destruction of society. The Stage is the first Avenged Sevenfold album to feature Brooks Wackerman on drums, after the departure of Arin Ilejay in July 2015, and the band''s first album to be released through Capitol Records. It is also the band''s longest studio album at 73 minutes and 35 seconds, thus beating City of Evil by almost a ', 1, 1, 9.99, 'http://www.ghostcultmag.com/wp-content/uploads/2016/10/Avenged-Sevenfold-The-Stage-album-cover-full-size-ghostcultmagazine.jpg', '2016-10-28'),
(2, 'Nightmare', 'Nightmare is the fifth studio album by the American heavy metal band Avenged Sevenfold. It was released on July 27, 2010 through Warner Bros. Records. It was produced by Mike Elizondo and mixed in New York City by noted engineer Andy Wallace. Nightmare is the first Avenged Sevenfold record without James "The Rev" Sullivan performing drums on all the songs due to his death in December 2009. ', 1, 1, 11.49, 'https://upload.wikimedia.org/wikipedia/en/d/df/Avenged_Sevenfold_-_Nightmare.png', '2010-07-27'),
(3, 'Issues', 'Issues is the fourth studio album by Korn, released through Immortal Records. Since its release, the album has sold over 13 million copies worldwide. The album was promoted throughout 2000 by the band''s highly successful Sick and Twisted Tour.', 2, 1, 5.99, 'http://vignette4.wikia.nocookie.net/korn/images/6/6e/Issuescover.jpg/revision/latest?cb=20100215221542', '1999-11-16'),
(4, 'The Serenity Of Suffering', 'The Serenity of Suffering is the twelfth studio album by Korn. According to guitarist Brian Welch, it is "heavier than anyone''s heard us in a long time” and that it contains their most intense music in a long time vocally as well.', 2, 1, 13.99, 'https://upload.wikimedia.org/wikipedia/en/thumb/6/62/Korn-The_Serenity_of_Suffering-album_cover.jpg/480px-Korn-The_Serenity_of_Suffering-album_cover.jpg', '2016-10-21'),
(5, 'XOXO', 'XOXO is the first studio album by South Korean-Chinese boy band Exo, released on June 3, 2013 by S.M. Entertainment. The album is a follow-up to the group''s debut EP, Mama (2012). Like all of the group''s music, the album was released in two versions – a Korean "Kiss" edition and a Chinese "Hug" edition ', 7, 5, 25.33, 'https://upload.wikimedia.org/wikipedia/en/0/0b/EXO-XOXO-First_Album.jpg', '2013-06-03'),
(8, 'Exodus', 'Exodus (stylized as EXODUS) is the second studio album by South Korean-Chinese boy band EXO, released by S.M. Entertainment and distributed by KT Music. It is the band''s first full-length release since XOXO (2013), and also the first release from the band after the lawsuits of Kris and Luhan, now promoting with only ten members. Exodus is the final release to include member Tao before he left the group and filed a lawsuit against S.M. Entertainment requesting contract termination. ', 7, 5, 17.5, 'https://upload.wikimedia.org/wikipedia/en/6/6f/EXODUS-EXO.png', '2015-03-30'),
(9, 'Bleach', ' Bleach is the debut studio album by American rock band Nirvana, released on June 15, 1989 by Sub Pop. The main recording sessions took place at Reciprocal Recording in Seattle, Washington between December 1988 and January 1989.\r\nBleach was well received by critics, but failed to chart in the U.S. upon its original release. The album was re-released internationally by Geffen Records in 1992 following the success of Nirvana''s second album, Nevermind (1991). \r\n ', 3, 9, 9.42, 'https://upload.wikimedia.org/wikipedia/en/a/a1/Nirvana-Bleach.jpg', '1989-06-15'),
(10, 'Nevermind', 'Nevermind is the second studio album by the American rock band Nirvana, released on September 24, 1991 by DGC Records. Produced by Butch Vig, Nevermind was the group''s first release on DGC. It is their first album to feature drummer Dave Grohl.\r\nDespite low commercial expectations by the band and its record label, Nevermind became a surprise success in late 1991, largely due to the popularity of its first single, "Smells Like Teen Spirit". By January 1992, it had replaced Michael Jackson''s album', 3, 9, 6.15, 'https://upload.wikimedia.org/wikipedia/en/b/b7/NirvanaNevermindalbumcover.jpg', '1991-09-24'),
(11, 'Vessel', 'Vessel is the third studio album by American musical duo Twenty One Pilots, which was released on January 8, 2013. It is the band''s first album released via Fueled by Ramen, and is their major-label debut album. As of July 2016, the album sold over 569,000 copies. ', 5, 3, 9.19, 'https://upload.wikimedia.org/wikipedia/en/2/20/Vessel_by_Twenty_One_Pilots.jpg', '2013-01-08'),
(12, 'Blurryface', 'Blurryface is the fourth studio album by American musical duo Twenty One Pilots. It is the band''s second album released through Fueled by Ramen. Originally set to be released on May 19, 2015, it was released two days earlier on May 17, via iTunes. The album was preceded by its lead single, "Fairly Local", released on March 17, 2015. As of July 2016, the album has sold over 1 million copies in the United States. It contains the Billboard Hot 100 top-five singles, "Stressed Out" and "Ride", which ', 5, 3, 9.2, 'https://upload.wikimedia.org/wikipedia/en/7/7d/Blurryface_by_Twenty_One_Pilots.png', '2015-05-17'),
(13, 'The Colour and the Shape', 'The Colour and the Shape is the second studio album by the American rock band Foo Fighters. The record is the debut of the Foo Fighters as a group, as the band''s previous record, Foo Fighters (1995), was primarily recorded by frontman Dave Grohl and friend Barrett Jones as a demoThe band strived to create a full-fledged rock record, although the music press predicted another grunge offshoot. ', 4, 2, 7, 'https://upload.wikimedia.org/wikipedia/en/0/0d/FooFighters-TheColourAndTheShape.jpg', '1997-05-20'),
(14, 'One By One', 'One by One is the fourth studio album by American rock band Foo Fighters. The album is the first to feature guitarist Chris Shiflett. Production on the album was troubled, with initial recording sessions considered unsatisfying and raising tensions between the band members. They eventually decided to redo the album from scratch during a two-week period at frontman Dave Grohl''s home studio in Alexandria, Virginia. ', 4, 2, 8.24, 'https://upload.wikimedia.org/wikipedia/en/0/06/Foo_Fighters_-_One_by_One.jpg', '2002-10-22'),
(15, 'Bouquet', 'Bouquet is the debut extended play (EP) by American DJ duo The Chainsmokers. It was released on October 23, 2015, by Disruptor Records and Columbia Records. ', 6, 4, 7.89, 'https://upload.wikimedia.org/wikipedia/en/c/c4/Bouquet_EP_cover_art.jpg', '2015-10-23'),
(16, 'Collage', 'Collage is the second extended play (EP) by American DJ duo The Chainsmokers. It was released on November 4, 2016, by Disruptor Records and Columbia Records. ', 6, 4, 6.64, 'https://upload.wikimedia.org/wikipedia/en/2/22/Collage%2C_album_cover.jpg', '2016-11-04'),
(17, 'The Girl with the Dragon Tattoo', 'The Girl with the Dragon Tattoo is an ambient soundtrack by Trent Reznor (of Nine Inch Nails) and Atticus Ross, for David Fincher''s film of the same name. It was released on December 9, 2011.[1] This is the second soundtrack that Reznor and Ross have worked on together, the previous being the Oscar-winning[2] The Social Network, also for Fincher. The album was released on Mute Records outside North America. ', 8, 7, 13.88, 'https://upload.wikimedia.org/wikipedia/en/8/82/TheGirlWithTheDragonTattooDigital.jpg', '2011-12-09'),
(18, 'Gone Girl', 'Gone Girl: Soundtrack from the Motion Picture is the soundtrack album by Trent Reznor and Atticus Ross for David Fincher''s film of the same name. The album was released on September 30, 2014 by Columbia Records. It marks as third time that Reznor and Ross have collaborated with Fincher, following 2010''s Oscar-winning The Social Network and 2011''s The Girl with the Dragon Tattoo. The soundtrack was nominated for the 2015 Grammy Award for Best Compilation Soundtrack for Visual Media, and also for ', 8, 7, 9.32, 'https://upload.wikimedia.org/wikipedia/en/4/4f/Gone_Girl_album_art.jpeg', '2014-09-30'),
(19, 'Illumination', 'Illumination is the 19th album by R&B band Earth, Wind & Fire. It was released in September 2005 on Sanctuary Records. It featured collaborations with several artists including Jimmy Jam and Terry Lewis, Kenny G, Kelly Rowland, will.i.am, and Brian McKnight. Illumination debuted at number 32 on the Billboard 200 Chart, and number 8 on the Top R&B/Hip-Hop Albums Chart. ', 9, 8, 23.8, 'https://upload.wikimedia.org/wikipedia/en/7/73/EWF_-_Illumination.jpg', '2005-09-20'),
(20, 'Open Our Eyes', 'Open Our Eyes is the fifth studio album by Earth, Wind & Fire, released in 1974 on Columbia Records. The album went to number one on the R&B Charts and number 15 on the Pop Charts. Open Our Eyes contained the Billboard charting singles, "Mighty Mighty" (R&B #4, Pop #29), "Devotion" (R&B #23, Pop #33) and "Kalimba Story" (R&B #6, Pop #55). The album was made available in a digitally remastered version in 2001, which includes 4 previously unreleased bonus tracks. Open Our Eyes has been certified p', 9, 8, 4.99, 'https://upload.wikimedia.org/wikipedia/en/b/b7/Earth%2C_Wind_%26_Fire_-_Open_Our_Eyes.jpg', '1974-03-25'),
(21, 'The Chronological Duke Ellington & His Orchestra 1', 'Cut a few years before the Ellington band''s golden run during the early ''40s, this 24-track collection from 1936-1937 finds the group in top form. As is usual with any of Classics'' chronological discs, the fare runs the gamut. In this case, the mix takes in novelties ("Love Is Like a Cigarette"), reprised classics ("East St. Louis Toodle-Oo"), and contemporary gems ("In a Jam"). And as a highlight, there are also several sides cut by clarinetist Barney Bigard and a small band made up of other El', 11, 10, 28.63, 'https://archive.org/services/img/mbid-2e1eb000-01f5-44bd-8f0e-dab44f9ee3ce', '1996-11-19'),
(22, 'Night & Day: Big Band', 'Night & Day: Big Band is the eighteenth studio album by the American band Chicago, and twenty-second overall, released in 1995. It is a departure from Top 40 material for a more thematic project, with a focus on classic big band and swing music.\r\n\r\nChicago left Reprise Records and started their own imprint, Chicago Records, to re-distribute their music. This album was carried by Giant Records, a subsidiary of Warner
Music, who also distributes Reprise. ', 10, 6, 46.03, 'https://upload.wikimedia.org/wikipedia/en/8/8d/ChicagoNADBB.jpg', '1995-05-23');

CREATE TABLE IF NOT EXISTS `bands` (
`bandId` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`genreId` int(11) NOT NULL,
PRIMARY KEY (`bandId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

INSERT INTO `bands` (`bandId`, `name`, `genreId`) VALUES
(1, 'Avenged Sevenfold', 1),
(2, 'KoRn', 1),
(3, 'Nirvana', 9),
(4, 'Foo Fighters', 2),
(5, 'Twenty One Pilots', 3),
(6, 'The Chainsmokers', 4),
(7, 'Exo', 5),
(8, 'Trent Reznor & Atticus Ross', 7),
(9, 'Earth, Wind & Fire', 8),
(10, 'Chicago', 6),
(11, 'Duke Ellington Orchestra', 10);

CREATE TABLE IF NOT EXISTS `genres` (
`genreId` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
PRIMARY KEY (`genreId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `genres` (`genreId`, `name`) VALUES
(1, 'Metal'),
(2, 'Rock'),
(3, 'Pop'),
(4, 'Electronic Dance Music'),
(5, 'K-Pop'),
(6, 'Jazz'),
(7, 'Instrumental'),
(8, 'Funk'),
(9, 'Grunge'),
(10, 'Swing');

CREATE TABLE IF NOT EXISTS `users` (
`userId` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(8) NOT NULL,
`password` varchar(40) NOT NULL,
PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `users` (`userId`, `username`, `password`) VALUES
(1, 'admin', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab'),
(2, 'user_1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'user_2', '81fe8bfe87576c3ecb22426f8e57847382917acf');