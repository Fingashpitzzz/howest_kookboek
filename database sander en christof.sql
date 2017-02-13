-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 17 Jun 2010 om 08:19
-- Serverversie: 5.1.36
-- PHP-Versie: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kookboek`
--
CREATE DATABASE `kookboek` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kookboek`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` char(50) NOT NULL,
  `wachtwoord` char(50) NOT NULL,
  `geslacht` char(50) NOT NULL,
  `voornaam` char(50) NOT NULL,
  `achternaam` char(50) NOT NULL,
  `woonplaats` char(50) NOT NULL,
  `provincie` char(50) NOT NULL,
  `land` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `accounts`
--

INSERT INTO `accounts` (`id`, `gebruikersnaam`, `wachtwoord`, `geslacht`, `voornaam`, `achternaam`, `woonplaats`, `provincie`, `land`, `email`) VALUES
(17, 'christof', 'blablabla', 'Man', 'Christof', 'De Bo', 'ingelmonster', 'West-Vlaanderen', 'Belgie', 'christofdebo@hotmail.com'),
(16, 'sies', '21121966', 'Vrouw', '', '', '', '', '', ''),
(1, 'Sander', 'sandman1989', 'Man', 'Sander', 'Claus', 'Zwevezele', 'West-Vlaanderen', 'Belgie', 'gelmir_elendil@hotmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bereidingstijden`
--

DROP TABLE IF EXISTS `bereidingstijden`;
CREATE TABLE IF NOT EXISTS `bereidingstijden` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `tijd` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Gegevens worden uitgevoerd voor tabel `bereidingstijden`
--

INSERT INTO `bereidingstijden` (`id`, `tijd`) VALUES
(1, 'kort (< 20 min)'),
(2, 'matig (< 45 min)'),
(3, 'lang (< 90 min)'),
(4, 'uitgebreid (> 90 min');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `naam` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`id`, `naam`) VALUES
(1, 'Pasta'),
(2, 'Vegetarisch'),
(3, 'Vis'),
(4, 'Vlees'),
(8, 'IJs & Sorbet');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechten`
--

DROP TABLE IF EXISTS `gerechten`;
CREATE TABLE IF NOT EXISTS `gerechten` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `naam` char(100) NOT NULL,
  `bereiding` text NOT NULL,
  `bereidingstijd` char(50) NOT NULL,
  `categorie` char(50) NOT NULL,
  `soort` char(50) NOT NULL,
  `ingredient` text NOT NULL,
  `gebruikersnaam` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Gegevens worden uitgevoerd voor tabel `gerechten`
--

INSERT INTO `gerechten` (`id`, `naam`, `bereiding`, `bereidingstijd`, `categorie`, `soort`, `ingredient`, `gebruikersnaam`) VALUES
(54, 'Canneloni met ham', 'Kook de lasagnevellen beetgaar en laat ze opdrogen op een keukenhanddoek. Vermeng de mascarpone met de olijfolie en flink wat zwarte peper. Bestrijk er de lasagnevellen mee. Leg er een fijne plak magere ham met ui op. Rol stevig op. Serveer op een bedje van groene groenten en werk af met parmezaanschilfers.', 'kort (< 20 min)', 'Vlees', 'Voorgerecht', '4 vellen groene lasagne, 4 eetlepels mascarpone, 4 koffielepels olijfolie extra vierge, zwarte peper van de molen, 4 fijne plakken magere ham met ui, groene groenten, parmezaanschilfers', 'Sander'),
(55, 'Zalmbeursjes gevuld met roomkaas', 'Meng de roomkaas met de mierikswortel en de bieslook. Zet het mengsel in de koelkast. Leg kleine plakjes zalm open op het werkvlak. Leg in het midden van het plakje zalm een lepeltje roomkaas. Maak beursjes door de uiteinden van de zalm samen te nemen en er een sprietje bieslook rond te binden. Garneer met sesamzaadjes. ', 'matig (< 45 min)', 'Vis', 'Aperitiefhapje', '200 gram gerookte zalm in plakjes, 200 gram roomkaas,1 eetlepel mierikswortel, 1.5 eetlepels gehakte bieslook, lichte en donkere sesamzaadjes', 'Sander'),
(56, 'Risotto met gebakken bloemkool en sjalotvinaigrette', 'Verwijder de bladeren en spoel de bloemkool. Halveer en snij één helft in plakjes van 0,5 tot 1 cm. Verdeel de andere helft in roosjes en hak ze in de keukenrobot of rasp ze fijn. Kleur de sjalotsnippers mooi bruin in 3 el olijfolie, voeg er de tijm aan toe en blus met balsamicoazijn. Kruid met peper en zout. Bak de bloemkoolplakjes op laag vuur goudbruin en gaar in wat olijfolie. Kruid met peper en zout en hou warm. Fruit de ui op laag vuur glazig in olijfolie. Voeg er de rijst aan toe, stoof kort mee en blus met de witte wijn. Laat even uitdampen en voeg er dan de gehakte bloemkool aan toe. Doe er beetje bij beetje de warme groentebouillon bij en roer goed. Na ongeveer 18 minuten is de rijst gaar en mooi romig. Doe er anders nog wat extra bouillon bij. Haal de risotto van het vuur. Voeg er de gemalen parmezaan aan toe en roer er de mascarpone door. Breng op smaak met peper en zout. Serveer met gebakken bloemkool en wat sjalotvinaigrette.', 'lang (< 90 min)', 'Vegetarisch', 'Hoofdgerecht', '1 mooie bloemkool, 4 fijngesnipperde Franse (lange) sjalotten, 5 eetlepels olijfolie, 2 eetlepels balsamicoazijn, 1 takje tijm, 1 fijngesnipperde ui, 100 gram risottorijst, 1,5 deciliter droge witte wijn, 2.5 tot 3 deciliter warme groentebouillon, 50 gram gemalen parmezaan, 100 gram mascarpone, peper en zout', 'Sander'),
(57, 'Aardbeienlollies', 'Spoel de aardbeien, verwijder de kroontjes en pureer ze. Vermeng de yoghurt met de honing. Roer er de aardbeienpuree door. Verdeel het mengsel over vormpjes en zet er een ijslollystokje in. Zet 6 tot 8 uur in de diepvriezer.', 'lang (< 90 min)', 'IJs & Sorbet', 'Dessert', '250 gram aardbeien, 125 gram volle yoghurt, 1 theelepel honing', 'Sander'),
(58, 'Macaroni met zalm en spinazie', 'Kook de pasta beetgaar in gezouten water. Laat uitlekken en afkoelen. Snij de zalm in stukjes of reepjes. Spoel de spinazie en verwijder harde steeltjes. Roer een vinaigrette van de honing, de mosterd, de olijfolie en het citroensap. Breng op smaak met\r\npeper en zout. Vermeng de pasta met de vinaigrette, de spinazie en de zalm. Verdeel alles over de borden en werk af met plukjes dille.', 'matig (< 45 min)', 'Pasta', 'Hoofdgerecht', '300 gram macaroni, 6 plakjes gerookte zalm, 1/2 zak spinazie, 2 eetlepels citroensap, 1 eetlepel honing, 1 eetlepel graanmosterd, 5 eetlepel olijfolie, enkele takjes dille', 'Sander');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `landen`
--

DROP TABLE IF EXISTS `landen`;
CREATE TABLE IF NOT EXISTS `landen` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `naam` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `landen`
--

INSERT INTO `landen` (`id`, `naam`) VALUES
(1, 'Belgie'),
(2, 'Nederland');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `provincies`
--

DROP TABLE IF EXISTS `provincies`;
CREATE TABLE IF NOT EXISTS `provincies` (
  `land` enum('Nederland','Belgie') NOT NULL,
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `provincie` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `provincies`
--

INSERT INTO `provincies` (`land`, `id`, `provincie`) VALUES
('Belgie', 1, 'Oost-Vlaanderen'),
('Belgie', 2, 'Belgisch Limburg'),
('Belgie', 3, 'Antwerpen'),
('Belgie', 4, 'West-Vlaanderen'),
('Belgie', 5, 'Vlaams-Brabant'),
('Nederland', 6, 'Groningen'),
('Nederland', 7, 'Friesland'),
('Nederland', 8, 'Drenthe'),
('Nederland', 9, 'Overijssel'),
('Nederland', 10, 'Flevoland'),
('Nederland', 11, 'Gelderland'),
('Nederland', 12, 'Utrecht'),
('Nederland', 13, 'Noord-Holland'),
('Nederland', 14, 'Zuid-Holland'),
('Nederland', 15, 'Zeeland'),
('Nederland', 16, 'Noord-Brabant'),
('Nederland', 17, 'Nederlands Limburg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soort`
--

DROP TABLE IF EXISTS `soort`;
CREATE TABLE IF NOT EXISTS `soort` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `naam` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `soort`
--

INSERT INTO `soort` (`id`, `naam`) VALUES
(1, 'Aperitiefhapje'),
(2, 'Voorgerecht'),
(3, 'Hoofdgerecht'),
(4, 'Dessert'),
(5, 'Soep'),
(6, 'Ontbijt'),
(7, 'Tussendoortje');
