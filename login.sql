-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Ago-2019 às 19:20
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Administrator', '{\"admin\":1,\"moderator\":1}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `joined` datetime NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `grupo`) VALUES
(1, 'tiago', 'password', 'salt', 'Tiago Silvestre', '2019-07-20 00:00:00', 1),
(12, 'Ferinnfae', '2d38d5ffadd5d3a4910a2d253c585c2ed018d7145638502ae367c96658109364', '¢†\'Ì´À	&*ÍB@·ÇïË2«gXˆª[B`eµ', 'guiarhgiaur', '2019-07-22 23:26:02', 1),
(13, 'tatatat', '780af0a49f854402cd4c1b1cf12e9d534990267571226eba72753ebfcc5ab1ac', '+xÈH\Zéq¼k‡¨t‹YŽ˜FA\nP¨•îÿp©‘', 'g5r6g45rs4gr', '2019-07-22 23:27:10', 1),
(14, 'gregrje', '4108c3a33ff42710e9146407b3f2a4cd53882c81968c23c42056ca400f396532', 'pÞÛ1Ôµ»øØ¡¿RãBaŒ°„Vøï¶AhÝ\Zøáý', 'groisgjrogi', '2019-07-22 23:27:42', 1),
(15, 'tratartar', 'd7f8d1193a1e01e00bf27c5d7d931b55d03a6be9ebe4232438cb808477b78284', 'WåX4®¡=ˆ¯Ž´µ&ä×Ö.gÌ¬Ô­§µ°ýr6ÕÊ', 'tratratrta', '2019-07-22 23:29:31', 1),
(16, 'teatea', '08ef2e278dae8c22895a76fcb00ec178807fd8052e12b2824c8f58218fa46104', 'Qã¶I,6\n\re‚û*ÂÈ›]ÁÇòò®J¦Å(Ecïîq', 'teateatea', '2019-07-22 23:30:17', 1),
(17, 'tiagos', '1e85abbddde2fc0e24c935f292a306cef518900d7c5d8ab96082e2abd46a1402', 'ÕwJšóÛƒ;¥ÕÞY,;n/“ÃutYâûD’’DF\'¼f', 'tiagoSS', '2019-07-23 00:01:34', 2),
(18, 'michaeljackson', '54cb55b84abe612a4f2e920be35301d1a59473a384ee73663232de0d94ee5acc', '\n=kwì…C›’]¯èød÷Tæ&%_þ6½Ø', 'Michael Jackson Freitas', '2019-07-24 23:53:29', 1),
(19, 'tiagotester', 'beebb5f5e90c7c5c5ec0cb217dbf86b6932a565b18e8983fa828efdf2dc95f7a', 'ë|i—th ]Þ§AÔDïD-Õg}é’ãóÍFÃtu', 'tester', '2019-07-25 22:43:05', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
