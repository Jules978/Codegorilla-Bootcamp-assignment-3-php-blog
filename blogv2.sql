-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 feb 2018 om 14:18
-- Serverversie: 10.1.29-MariaDB
-- PHP-versie: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogv2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `articles`
--

CREATE TABLE `articles` (
  `a_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `disable_comments` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `articles`
--

INSERT INTO `articles` (`a_id`, `title`, `date`, `text`, `disable_comments`) VALUES
(17, 'THIS IS A DATABASE AND PHP TEST', 'February 6th 2018', '<p>TESST</p>\r\n', 'true'),
(18, 'In php and database', 'February 6th 2018', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas diam nulla, sagittis vel finibus a, malesuada in dolor. Integer augue leo, luctus nec dictum id, viverra sit amet nulla. Donec dapibus dui eu elit tempor scelerisque. Phasellus erat nulla, dapibus eget ex in, sodales blandit justo. Etiam tristique non nisi non viverra. Proin efficitur libero eget enim placerat ullamcorper. Curabitur mollis pretium dignissim. Sed id risus eget sapien ullamcorper porttitor eget in dolor.</p>\r\n\r\n<p>Proin nec efficitur purus. Sed felis orci, tristique sit amet erat id, gravida tincidunt lectus. Suspendisse bibendum, turpis nec malesuada blandit, ex elit luctus lorem, sit amet tempus nunc purus vel magna. Integer hendrerit, purus nec maximus congue, massa ipsum iaculis quam, at luctus lectus leo eget lacus. Nulla ac eros dolor. Vestibulum ut mauris pulvinar, facilisis odio dapibus, faucibus dui. Aliquam erat volutpat. Proin id turpis eu lacus volutpat euismod sit amet at nulla. Ut malesuada, nulla in imperdiet dapibus, ligula tellus tempor mauris, quis faucibus sapien ante ut nunc. Nam in lectus et velit pharetra consectetur. Nunc tellus orci, vulputate non nibh id, gravida porttitor sem. Vestibulum nec metus ornare, viverra dui pellentesque, sagittis quam.</p>\r\n', 'false'),
(19, 'teest', 'February 6th 2018', '<p>eege</p>\r\n', 'false'),
(20, 'ee', 'February 6th 2018', '<p>ee</p>\r\n', 'false'),
(21, 'this is a test databases and php', 'February 6th 2018', '<p>teest</p>\r\n', 'false'),
(22, 'It\'s wednesday! ', 'February 7th 2018', '<p>This to disable comments!</p>\r\n', 'true'),
(23, 'ANOTHER TEST', 'February 7th 2018', '<p>fwgege</p>\r\n', 'false'),
(24, 'testing', 'February 7th 2018', '<p>wdwdw</p>\r\n', 'false'),
(25, 'THIS IS A TEST', 'February 7th 2018', '<p>Disable comments should be TRUE</p>\r\n', 'true'),
(26, 'THIS POST HAS A COMMENT SECTION', 'February 7th 2018', '<p>please</p>\r\n', 'false'),
(27, 'aw yess,  login is working', 'February 7th 2018', '<p>wdwdw</p>\r\n', 'false'),
(28, 'testing javascript', 'February 7th 2018', 'dwdwdwd', 'false'),
(29, 'FINAL JAVASCRIPT TEST', 'February 7th 2018', 'dwdwda', 'true'),
(30, 'PLLEEASE', 'February 7th 2018', 'wdwadawdaw', 'true'),
(31, 'this is a test', 'February 8th 2018', '<p>TEESTING apple</p>', 'false'),
(32, '', 'February 8th 2018', 'dw<b>dwddwd</b>ddwd<p></p>', 'true');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `articles_categories`
--

INSERT INTO `articles_categories` (`id`, `article_id`, `category_id`) VALUES
(8, 17, 1),
(9, 17, 2),
(13, 21, 1),
(14, 21, 2),
(15, 22, 3),
(16, 22, 4),
(17, 23, 6),
(18, 23, 7),
(19, 24, 2),
(20, 24, 3),
(21, 25, 1),
(22, 25, 2),
(23, 25, 3),
(24, 26, 1),
(25, 26, 2),
(26, 27, 2),
(27, 27, 3),
(28, 27, 4),
(29, 28, 3),
(30, 29, 2),
(31, 29, 3),
(32, 30, 1),
(33, 30, 2),
(34, 30, 3),
(35, 31, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `autofinish`
--

CREATE TABLE `autofinish` (
  `id` int(11) NOT NULL,
  `word` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `autofinish`
--

INSERT INTO `autofinish` (`id`, `word`) VALUES
(1, 'desktop'),
(2, 'Javascript'),
(4, 'manifacturer'),
(5, 'database'),
(6, 'CodeGorilla'),
(7, 'Groningen'),
(8, 'deadline'),
(9, 'workload'),
(10, 'cats'),
(11, 'more cats');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `c_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`c_id`, `name`) VALUES
(1, 'Database'),
(2, 'PHP'),
(3, 'javascript'),
(4, 'Updates'),
(5, 'Lifestyle'),
(6, 'CSS'),
(7, 'HTML'),
(8, 'Testing');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `article_id`) VALUES
(12, ' 06.Feb.2018: THIS IS A COMMENT', 21),
(13, ' 06.Feb.2018: ee', 20),
(14, ' 07.Feb.2018: ', 26),
(32, ' 08.Feb.2018: testing', 24);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `u_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`u_id`, `username`, `password`, `name`) VALUES
(1, 'blogger', 'password', 'blogger1');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexen voor tabel `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexen voor tabel `autofinish`
--
ALTER TABLE `autofinish`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `a_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT voor een tabel `articles_categories`
--
ALTER TABLE `articles_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `autofinish`
--
ALTER TABLE `autofinish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD CONSTRAINT `articles_categories_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`a_id`),
  ADD CONSTRAINT `articles_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
