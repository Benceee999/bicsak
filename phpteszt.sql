-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Okt 13. 08:59
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `phpteszt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `osztalyok`
--

CREATE TABLE `osztalyok` (
  `osztId` int(11) NOT NULL,
  `osztNev` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `osztalyok`
--

INSERT INTO `osztalyok` (`osztId`, `osztNev`) VALUES
(1, '13.I'),
(2, '12.a');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sorok`
--

CREATE TABLE `sorok` (
  `sorId` int(11) NOT NULL,
  `nev1` int(11) DEFAULT NULL,
  `nev2` int(11) DEFAULT NULL,
  `nev3` int(11) DEFAULT NULL,
  `nev4` int(11) DEFAULT NULL,
  `nev5` int(11) DEFAULT NULL,
  `osztId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `sorok`
--

INSERT INTO `sorok` (`sorId`, `nev1`, `nev2`, `nev3`, `nev4`, `nev5`, `osztId`) VALUES
(41, NULL, NULL, NULL, 72, NULL, 1),
(42, 51, 58, 65, 73, 79, 1),
(43, 52, 59, 66, 74, 80, 1),
(44, NULL, NULL, 67, 75, 81, 1),
(45, NULL, NULL, NULL, 76, 82, 2),
(46, 53, 60, 68, NULL, 83, 2),
(47, 54, 61, 69, 77, 84, 2),
(48, NULL, NULL, 70, NULL, 85, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szemelyek`
--

CREATE TABLE `szemelyek` (
  `szId` int(11) NOT NULL,
  `nev` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szemelyek`
--

INSERT INTO `szemelyek` (`szId`, `nev`) VALUES
(51, 'Beni'),
(52, 'Korondi'),
(53, 'Beni'),
(54, 'Korondi'),
(58, 'Erik'),
(59, 'Tokrist'),
(60, 'Kriszitán'),
(61, 'Tokrist'),
(65, 'Szabi'),
(66, 'Iványi'),
(67, 'Bicsák'),
(68, 'Szabi'),
(69, 'Iványi'),
(70, 'Bicsák'),
(72, 'Bujdi'),
(73, 'Zoltán'),
(74, 'Pintér'),
(75, 'Béla'),
(76, 'Géza'),
(77, 'Kristóf'),
(79, 'Horváth'),
(80, 'Ede'),
(81, 'Cucu'),
(82, 'János'),
(83, 'Bence'),
(84, 'Ede'),
(85, 'Cucu');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `osztalyok`
--
ALTER TABLE `osztalyok`
  ADD PRIMARY KEY (`osztId`);

--
-- A tábla indexei `sorok`
--
ALTER TABLE `sorok`
  ADD PRIMARY KEY (`sorId`),
  ADD KEY `osztId` (`osztId`),
  ADD KEY `nev1` (`nev1`,`nev2`,`nev3`,`nev4`,`nev5`),
  ADD KEY `obfk_nev2_szemely` (`nev2`),
  ADD KEY `obfk_nev3_szemely` (`nev3`),
  ADD KEY `obfk_nev4_szemely` (`nev4`),
  ADD KEY `obfk_nev5_szemely` (`nev5`);

--
-- A tábla indexei `szemelyek`
--
ALTER TABLE `szemelyek`
  ADD PRIMARY KEY (`szId`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `osztalyok`
--
ALTER TABLE `osztalyok`
  MODIFY `osztId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `sorok`
--
ALTER TABLE `sorok`
  MODIFY `sorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `szemelyek`
--
ALTER TABLE `szemelyek`
  MODIFY `szId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `sorok`
--
ALTER TABLE `sorok`
  ADD CONSTRAINT `ibfk_sorok_osztalyok` FOREIGN KEY (`osztId`) REFERENCES `osztalyok` (`osztId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `obfk_nev1_szemely` FOREIGN KEY (`nev1`) REFERENCES `szemelyek` (`szId`) ON DELETE SET NULL,
  ADD CONSTRAINT `obfk_nev2_szemely` FOREIGN KEY (`nev2`) REFERENCES `szemelyek` (`szId`) ON DELETE SET NULL,
  ADD CONSTRAINT `obfk_nev3_szemely` FOREIGN KEY (`nev3`) REFERENCES `szemelyek` (`szId`) ON DELETE SET NULL,
  ADD CONSTRAINT `obfk_nev4_szemely` FOREIGN KEY (`nev4`) REFERENCES `szemelyek` (`szId`) ON DELETE SET NULL,
  ADD CONSTRAINT `obfk_nev5_szemely` FOREIGN KEY (`nev5`) REFERENCES `szemelyek` (`szId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
