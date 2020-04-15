-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 15-04-2020 a las 01:45:56
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_login_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nick` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dateLogin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nick`, `age`, `gender`, `dateLogin`) VALUES
(1, 'kraschfulll@gmail.com', '$2y$10$kiPf2u/1cZOtU', 'krash', 22, 'male', '0000-00-00 00:00:00'),
(50, 'kraschfulll5@gmail.com', '$2y$10$AtgkstXHYnm8ExfB/mTZneZPp/CJnLG.7eY.nGXacIj0thr30f3w6', 'new3', 45, 'female', '0000-00-00 00:00:00'),
(82, 'kraschfulll1222@gmail.com', '$2y$10$LkigdCkb8sqquXUK7xqvcud3QetI0CAlAuTGW3xORaXHeTpcMXRbm', 'new6mew33', 54, 'female', '0000-00-00 00:00:00'),
(85, 'AngelaC800@gmail.com', '$2y$10$y67nn7MhibKYkCv0lYNUBupXkMretnNi39NrICNcSxrc0C4pMAOoS', 'AngelaC800', 21, 'female', '0000-00-00 00:00:00'),
(60, 'kraschfulll15@gmail.com', '$2y$10$wIs1mUOpNH67l9EOXiM26u.8sR/b8XQm5voxMeHX4gA6yarz2pXJK', 'new14', 56, 'male', '0000-00-00 00:00:00'),
(83, 'new1212@gmail.com', '$2y$10$G1OMWVblcyxUsQN21pyMUeDuPTun3TfDHBRV2aprv/otaD/TluU7a', 'new6123', 74, 'male', '0000-00-00 00:00:00'),
(81, 'newnew54@gmail.com', '$2y$10$fFSNtMUn19DTQkT.6O3v0usI4QvmHwDnkKBzsLwdtZjH4IQX4goiW', 'fgh', 78, 'male', '0000-00-00 00:00:00'),
(80, 'newnew7@gmail.com', '$2y$10$kOoxDEpiegLsEKVHPtzYfOGWFELmTGg0qYMTrZP14CmCQjQI7ZeAW', 'newnew7', 45, 'female', '0000-00-00 00:00:00'),
(75, 'newnew5@gmail.com', '$2y$10$pUFaUlz3qjoia73fj4NwNuGfmLLx4lXx4SCl5PU/jyGEayZJJxkoG', 'newnew5', 54, 'male', '0000-00-00 00:00:00'),
(65, 'kraschfulll20@gmail.com', '$2y$10$JXHR8rcxCShrU0pbIK8vUOyv9bBbJZWh2Ov9l7muybaJrb7CeVzjW', 'new19', 15, 'female', '0000-00-00 00:00:00'),
(66, 'kraschfulll21@gmail.com', '$2y$10$RLYCdXuJJJ2bKT4/N3GxcO2uIDpxZ0ONMIPLjuX.bYVbQfkhi5VaO', 'new20', 71, 'male', '0000-00-00 00:00:00'),
(67, 'kraschfulll22@gmail.com', '$2y$10$pWRMC.6p/h.Z48GG9Of7ueixCjSPZxb2.ytpOlCvKMx46hC9p8Cyy', 'new21', 17, 'female', '0000-00-00 00:00:00'),
(68, 'kraschfulll23@gmail.com', '$2y$10$M3vq6MsnUnxFwqO2hv2VfO.zLh9MEmktsYXUoG1ZrJwh4H/KALzEO', 'new22', 35, 'female', '0000-00-00 00:00:00'),
(69, 'kraschfulll24@gmail.com', '$2y$10$SZowi8olHKgP4JkHcsdzYOjvLDPcKdwb83PgYEser1SyHEP/MKKy2', 'new23', 41, 'male', '0000-00-00 00:00:00'),
(70, 'kraschfulll25@gmail.com', '$2y$10$.kE0mm4SUWjzzw6/.o16IOgizY8vJCCTVB1eKzXha5c6B3qo5xDje', 'new24', 45, 'male', '0000-00-00 00:00:00'),
(71, 'newnew1@gmail.com', '$2y$10$uTc5dEr1HamfTJuI8ptECe5WiFtLB4YeMllJFHmClhbMDgNBi8Zo6', 'newnew1', 23, 'male', '0000-00-00 00:00:00'),
(76, 'newnew6@gmail.com', '$2y$10$meGlxA1NqWwkXggGn5QMnexlUeFNpJ3djnPOYF8Fptb7jgSpgVORG', 'newnew6', 45, 'male', '0000-00-00 00:00:00'),
(86, 'Andres70@gmail.com', '$2y$10$AhVMemgtbE5AfiCHvpZUDuzd.VmETf.Sw3bLdiA1Yqmptev6jFnJG', 'Andres70', 20, 'male', '2020-04-14 14:46:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
