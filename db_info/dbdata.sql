-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_sample`
--

-- --------------------------------------------------------

--
-- Table structure for tables
--

CREATE TABLE `Userinfo` (
	`authorid` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL, 
	`firstname` VARCHAR(255) NOT NULL,
	`lastname` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`country` VARCHAR(255),
	`imageURL` VARCHAR(255) DEFAULT "images/default-avatar-icon.png",
	`status` INTEGER DEFAULT 0,
	`joindate` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Blogpost` (
	`postid` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`authorid` INT NOT NULL,
	`title` VARCHAR(200),
	`content` TEXT, 
	`date` DATE, 
	`category` VARCHAR(20) DEFAULT "Off Topic"
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Comment` (
	`commentid` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`postid` INT NOT NULL, 
	`authorid` INT NOT NULL,
	`content` TEXT, 
	`date` DATE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--



INSERT INTO `Userinfo`(`username`,`password`,`firstname`,`lastname`,`email`,`country`,`imageURL`,`status`,`joindate`) VALUES ("catlover24","ebacfb56152925523a86675c6fb9b8e8","Elise","Walker","ewalker24@gmail.com","Canada","images/user1.jpg", 1,"2018-01-11");
INSERT INTO Userinfo(username,password,firstname,lastname,email,country,imageURL,joindate) VALUES ("football2005","482c811da5d5b4bc6d497ffa98491e38","Brett","Anderson","fb4lyfe@gmail.com","Ireland","images/user2.jpg","2019-12-17");
INSERT INTO Userinfo(username,password,firstname,lastname,email,country,imageURL,joindate) VALUES ("gremlin_04","09a65a49fb6d48f2e5b6fa8369d6d02e","Tom","Smith","gremlin04@gmail.com","Canada","images/user3.jpg","2018-02-01");
INSERT INTO Userinfo(username,password,firstname,lastname,email,country,imageURL,joindate) VALUES ("validpizza12","5d7845ac6ee7cfffafc5fe5f35cf666d","Ellie","Page","elliep23@mail.com","United Kingdom","images/user4.jpg","2020-06-24");
INSERT INTO Userinfo(username,password,firstname,lastname,email,country,imageURL,joindate) VALUES ("SDK-45","63b4a4cbd81684706066e6b255ea11ba","Sam","Lee","samlee1990@gmail.com","Taiwan","images/user5.jpg","2020-03-16");
INSERT INTO Userinfo(username,password,firstname,lastname,email,country,imageURL,status,joindate) VALUES ("hacker-man72","beabfedc62871300e88c6dc33e242092","John","Smith","hackman72@hotmail.com","Madagascar","images/user6.jpg",-1,"2021-02-01");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (1,"Welcome to MyBlogPost!","Hello Everyone! My name is Elise, and this is MyBlogPost. Please be kind and respectful! :)","2018-01-17","Off Topic");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (2,"Football Playoffs","I scored a touchdown today at the big football playoffs. Everyone cheered. I was amazing. -Brett","2020-03-17","Sports");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (3,"Alien sighting!","I think I saw a UFO today. It was a dark and stormy night. I was sitting at my window and there it was!","2018-02-11","Life");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (4,"Why is the stock market down today?","There seems to be a general dip in the market today and I think I have several theories for it.","2021-01-12","Finance");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (5,"Trip to Rome - Dec 2019","There is nowhere quite like Rome. I visited this Italian capital filled with historic wonders and immediately fell in love with the city.","2020-12-30","Travel");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (6,"Big Hacks","I am planning a big hack into the world wide web; there is a conspiracy going on, and I am going to blow the lid clean off. Who is with me?!","2021-02-15","Off Topic");
INSERT INTO Blogpost(authorid,title,content,date,category) VALUES (1,"Kitty Blog","Today I adopted a new kitten! I'm going to try to leash train her so I can take her for walks :) I'm so excited!!","2021-03-23","Life");
INSERT INTO Comment(postid,authorid,content,date) VALUES (1,2,"Hi Elise. Do you like football?","2020-03-05");
INSERT INTO Comment(postid,authorid,content,date) VALUES (1,1,"Hello! No, cats are life :)","2020-03-06");
INSERT INTO Comment(postid,authorid,content,date) VALUES (2,1,"Wow! Good job.","2020-03-18");
INSERT INTO Comment(postid,authorid,content,date) VALUES (6,2,"U R cray cray man.","2021-02-16");
INSERT INTO Comment(postid,authorid,content,date) VALUES (6,1,"This type of content is not allowed, you have been banned.","2021-02-16");
--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
