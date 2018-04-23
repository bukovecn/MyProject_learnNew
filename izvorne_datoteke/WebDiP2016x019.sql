-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Lip 14, 2017 u 01:49 PM
-- Verzija poslužitelja: 5.5.55
-- PHP verzija: 5.4.45-0+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `WebDiP2016x019`
--

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `akcija`
--

CREATE TABLE IF NOT EXISTS `akcija` (
  `idAkcija` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik` int(11) NOT NULL,
  `vrsta_akcije` int(11) NOT NULL,
  PRIMARY KEY (`idAkcija`),
  KEY `fk_akcija_korisnik1_idx` (`korisnik`),
  KEY `fk_akcija_vrsta_akcije1_idx` (`vrsta_akcije`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Izbacivanje podataka za tablicu `akcija`
--

INSERT INTO `akcija` (`idAkcija`, `korisnik`, `vrsta_akcije`) VALUES
(1, 2, 4),
(2, 7, 4),
(3, 6, 3),
(4, 13, 2),
(5, 3, 5),
(6, 4, 1),
(7, 7, 9),
(8, 15, 3),
(9, 5, 7),
(10, 14, 2),
(11, 4, 9),
(12, 14, 10),
(13, 6, 9),
(14, 16, 2),
(15, 4, 2),
(16, 5, 3),
(17, 10, 6),
(18, 11, 6),
(19, 5, 9),
(20, 10, 3),
(21, 11, 4),
(22, 3, 8),
(23, 7, 9),
(24, 11, 9),
(25, 8, 9),
(26, 12, 5),
(27, 2, 3),
(28, 6, 7),
(29, 9, 8),
(30, 13, 3);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `dnevnik_rada`
--

CREATE TABLE IF NOT EXISTS `dnevnik_rada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_akcije` varchar(45) NOT NULL,
  `radnja` varchar(45) NOT NULL,
  `upit` varchar(1000) DEFAULT NULL,
  `korisnik_id` int(11) NOT NULL,
  `datum_i_vrijeme` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dnevnik_akcija_korisnik1_idx` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=159 ;

--
-- Izbacivanje podataka za tablicu `dnevnik_rada`
--

INSERT INTO `dnevnik_rada` (`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES
(1, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-08 02:30:32,1,1)', 1, '2017-06-08 02:30:32'),
(2, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-08 02:45:13'),
(3, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-08 03:27:01'),
(4, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 04:32:49'),
(5, 'Ostale radnje', 'Blokiran korisnik', 'UPDATE `korisnik` SET `status_racuna`=blokiran  WHERE `korisnicko_ime`=ana111', 3, '2017-06-08 05:42:49'),
(6, 'Ostale radnje', 'Otključan', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=ppero', 2, '2017-06-08 05:54:20'),
(7, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 19:09:07'),
(8, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 19:12:26'),
(9, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 19:13:44'),
(10, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-08 19:14:09,2,2)', 2, '2017-06-08 19:14:09'),
(11, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 19:16:31'),
(12, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 19:50:52'),
(13, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-08 20:04:10'),
(14, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-08 18:06:53'),
(15, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-08 18:24:36'),
(16, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-08 18:25:31'),
(17, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 18:25:56'),
(18, 'Prijava/odjava', 'Odjava', NULL, 2, '2017-06-08 18:26:09'),
(19, 'Prijava/odjava', 'Neuspješna prijava', NULL, 2, '2017-06-08 18:26:16'),
(20, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-08 18:27:14'),
(21, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-08 19:55:41'),
(22, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-08 19:56:33'),
(23, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-08 21:26:02'),
(24, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-08 21:31:59'),
(25, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-08 21:53:44'),
(26, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-08 22:03:08,1,2)', 1, '2017-06-08 22:03:08'),
(27, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-10 21:50:36'),
(28, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, ,2,3)', 2, '2017-06-10 21:51:01'),
(29, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-10 21:53:42,2,3)', 2, '2017-06-10 21:53:42'),
(30, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-10 21:54:15'),
(31, 'Ostale radnje', 'Prijava na program', '', 1, '0000-00-00 00:00:00'),
(32, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-10 22:11:59'),
(33, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Nikola, Fluks, mexewo@getapet.net, nikfluks,  NNnn11, NNnn11, afcf0566e3192798c75af7637ce7301a367fc709, f69ecd12b1096e58d89e3b41df4ad8a5be30707c, 2017-06-10 16:20:50, 2017-06-10 21:20:50, null, da, null, nije aktiviran, 0)', 4, '2017-06-10 16:20:50'),
(34, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=nikfluks', 4, '2017-06-11 02:23:09'),
(35, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Marko, Markic, marko123@gmail.com, mmarko,  MMmm3, MMmm3, 390b346f79ddb22bdf54a3e2b7068f70244e5e01, fd40273e69a629a3828836b932f824c6c6553888, 2017-06-10 16:29:23, 2017-06-10 21:29:23, null, ne, null, nije aktiviran, 0)', 5, '2017-06-11 02:29:23'),
(36, 'Prijava/odjava', 'Prijava', NULL, 5, '2017-06-11 02:29:51'),
(37, 'Prijava/odjava', 'Prijava', NULL, 4, '2017-06-11 02:37:01'),
(38, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Luka, Modric, henaxud@ipdeer.com, lmo10,  MMmm11, MMmm11, ed764cd6ab9aad301550e6ffc74f1b6da85f49bc, c5cc07b50814061f612abcc6e00b05e04e8b555f, 2017-06-10 16:38:20, 2017-06-10 21:38:20, null, ne, null, nije aktiviran, 0)', 6, '2017-06-11 02:38:20'),
(39, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=lmo10', 6, '2017-06-12 18:39:05'),
(40, 'Ostale radnje', 'Blokiran korisnik', 'UPDATE `korisnik` SET `status_racuna`=blokiran  WHERE `korisnicko_ime`=nikfluks', 4, '2017-06-12 18:40:44'),
(41, 'Ostale radnje', 'Otključan', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=nikfluks', 4, '2017-06-12 18:40:55'),
(42, 'Prijava/odjava', 'Neuspješna prijava', NULL, 4, '2017-06-12 18:41:33'),
(43, 'Prijava/odjava', 'Neuspješna prijava', NULL, 4, '2017-06-12 18:41:39'),
(44, 'Prijava/odjava', 'Neuspješna prijava', NULL, 4, '2017-06-12 18:41:44'),
(45, 'Ostale radnje', 'Zaključan', 'UPDATE `korisnik` SET `status_racuna`=zakljucan  WHERE `korisnicko_ime`=nikfluks', 4, '2017-06-12 18:41:48'),
(46, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Zoran, Zoric, zzoka@gmail.com, zoka12,  ZZzz1, ZZzz1, 1522bdc82aae88f0cbd147d1f6832bc8a286ddee, 9f43b7c8490acd61905c67b0c56439ab82f431ac, 2017-06-12 18:42:09, 2017-06-12 18:42:09, null, ne, null, nije aktiviran, 0)', 7, '2017-06-12 18:42:09'),
(47, 'Ostale radnje', 'Otključan', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=nikfluks', 4, '2017-06-12 18:42:10'),
(48, 'Prijava/odjava', 'Prijava', NULL, 4, '2017-06-12 18:42:36'),
(49, 'Prijava/odjava', 'Odjava', NULL, 4, '2017-06-12 18:43:17'),
(50, 'Prijava/odjava', 'Neuspješna prijava', NULL, 4, '2017-06-12 18:45:06'),
(51, 'Prijava/odjava', 'Neuspješna prijava', NULL, 6, '2017-06-12 18:45:24'),
(52, 'Prijava/odjava', 'Prijava', NULL, 6, '2017-06-12 18:46:06'),
(53, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Klara, Klaric, kklara123@gmail.com, kklara,  KKkk2, KKkk2, 3d85684d758c0f5e33e4c5eff971d4c32b9e1be9, a4c5311aebb195c5a43da8756714177f7afb70ab, 2017-06-12 18:48:04, 30Sat, 10 Jun 2017 21:48:04 +0200pm10Europe/Berlin_201710, null, ne, null, nije aktiviran, 0)', 8, '2017-06-12 18:48:04'),
(54, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Goran, Gogic, go@gi.com, gogo333,  GGgg3, GGgg3, 33211fe85a22eb9f704728d365305e278d55313d, 1038f3a66458c00f18a9f9fbb9bc1531ac6a0319, 2017-06-12 18:49:53, 2017-06-12 18:49:53, null, ne, null, nije aktiviran, 0)', 9, '2017-06-12 18:49:58'),
(55, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Kata, Katic, katakat@gmail.com, katakatic,  KKkk1, KKkk1, 3d5c27fac53afdc651bcca1757cfa1aed28e227a, 15444aba7e2abcd5c29e7e2dacc34c1b43085d9e, 2017-06-12 19:05:52, 1497287152, null, ne, null, nije aktiviran, 0)', 10, '2017-06-12 19:05:52'),
(56, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Ivan, Ivic, ivoivan1@gmail.com, ivoivan,  IIii2, IIii2, 8fd8d98a5b37d619f684db2b435736519c7bf1c5, 8190bd0e836ccfbe73be895476acc2e0c5d462dd, 2017-06-12 19:08:11, 1497287291, null, ne, null, nije aktiviran, 0)', 11, '2017-06-12 19:08:12'),
(57, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Maja, Juric, majajur@gmail.com, majajur,  MAma1, MAma1, 89714717c4112f616ee09c910d8e89ce582ec5c9, 92561856e8c03bf209d59e7452a51a45b2dc90d3, 2017-06-12 19:11:34, 1497287494, null, ne, null, nije aktiviran, 0)', 12, '2017-06-12 19:11:34'),
(58, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Dora, Doric, ddora123@gmail.com, ddora,  DDdd1, DDdd1, c2c4841a47502692492646ce7801bc313fe5c77e, 287451f51f554dc2cabedb93cc8940479990cc93, , , null, ne, null, nije aktiviran, 0)', 13, '2017-06-12 19:32:16'),
(59, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Mirko, Mirkic, mirkomirkic@gmail.com, mirko11,  MMii1, MMii1, 30e75acd4c8a9dd3b7c8b347cc8d649aed2f656a, 068fff35560c7976597de031135f0335ac6c7cf4, null, null, null, ne, null, nije aktiviran, 0)', 14, '2017-06-12 19:39:34'),
(60, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Iva, Babic, ivab@gmail.com, ivababic,  IBib2, IBib2, 11c1301c72d6fdf2f994448ff0ed19385dd3ebc8, 9f36dd23844ae2b9aeb333cb86781649234d52d5, null, null, null, ne, null, nije aktiviran, 0)', 15, '2017-06-12 19:45:24'),
(61, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Petra, Petric, petrica@gmail.com, ppetra,  PEtra2, PEtra2, fbb07d8497d29ce08fc2e4f8bfae4b94f7a27439, 1c0005acd096b5103c4d9e3895841b4f5ce5e2e8, null, null, null, ne, null, nije aktiviran, 0)', 16, '2017-06-12 19:48:05'),
(62, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Jura, Juric, jjuric@gmail.com, jjuric,  JJjj3, JJjj3, a4aa6ff2fc749dea3000a053f758f5f9ced6984f, 0ca2be0e4669e0b8541247d920137c0633faf248, null, null, null, ne, null, nije aktiviran, 0)', 17, '2017-06-12 19:50:15'),
(63, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Gloria, Batic, globatic@gmail.com, globat,  GBgb2, GBgb2, 278d131154a7c99644d3a32b862c30d87e756f08, ffadf95aef2df3456f242d5939ea434071ae6125, null, null, null, ne, null, nije aktiviran, 0)', 18, '2017-06-12 19:54:26'),
(64, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `akt_vrijediOd`, `akt_vrijediDo`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Mijo, Mijic, mijo123@gmail.com, mijom,  MIJOmijo1, MIJOmijo1, 5b336c0f1c783297a9f96d19906efe1405df4e9f, f83fb0a30a9663dd293ec7d674b538e8c01ceefd, null, null, null, ne, null, nije aktiviran, 0)', 19, '2017-06-12 19:56:46'),
(68, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 20:37:56'),
(69, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 20:40:13'),
(70, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 20:41:04'),
(71, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 20:54:33'),
(72, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 20:56:14'),
(73, 'Prijava/odjava', 'Prijava', NULL, 3, '2017-06-12 20:57:58'),
(74, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-11 10:33:00'),
(75, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-11 10:37:07'),
(76, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-11 10:48:31'),
(77, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-11 13:52:48'),
(78, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-11 13:54:23,2,1)', 2, '2017-06-11 13:54:23'),
(79, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-11 14:43:17'),
(80, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 02:00:07'),
(81, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 04:16:46'),
(82, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 04:19:39'),
(83, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 06:24:50'),
(84, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 06:46:40'),
(85, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 06:48:12'),
(86, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 07:11:46'),
(87, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 07:14:40'),
(88, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 07:22:54'),
(89, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-12 07:41:58'),
(90, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 03:19:09'),
(91, 'Prijava/odjava', 'Odjava', NULL, 2, '2017-06-12 03:36:57'),
(92, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-12 03:37:43'),
(93, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-12 03:54:52'),
(94, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 03:59:36'),
(95, 'Prijava/odjava', 'Odjava', NULL, 2, '2017-06-12 04:03:24'),
(96, 'Prijava/odjava', 'Prijava', NULL, 2, '2017-06-12 06:34:27'),
(97, 'Prijava/odjava', 'Odjava', NULL, 2, '2017-06-12 07:24:26'),
(98, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-12 07:24:57'),
(99, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-12 10:36:28'),
(100, 'Prijava/odjava', 'Prijava', NULL, 3, '2017-06-12 10:37:52'),
(101, 'Prijava/odjava', 'Odjava', NULL, 3, '2017-06-12 10:38:12'),
(102, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-12 10:38:43'),
(103, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-12 10:39:41'),
(104, 'Prijava/odjava', 'Neuspješna prijava', NULL, 4, '2017-06-12 10:40:55'),
(105, 'Prijava/odjava', 'Prijava', NULL, 4, '2017-06-12 10:41:20'),
(106, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-12 10:41:45,4,3)', 4, '2017-06-12 10:41:45'),
(107, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-12 10:42:19,4,6)', 4, '2017-06-12 10:42:19'),
(108, 'Prijava/odjava', 'Prijava', NULL, 4, '2017-06-12 19:56:21'),
(109, 'Prijava/odjava', 'Odjava', NULL, 4, '2017-06-12 19:56:47'),
(110, 'Prijava/odjava', 'Neuspješna prijava', NULL, 1, '2017-06-12 19:57:20'),
(111, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-12 19:57:55'),
(113, 'Prijava/odjava', 'Neuspješna prijava', NULL, 1, '2017-06-12 21:14:27'),
(114, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-12 21:16:04'),
(115, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-12 21:19:14'),
(119, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Zmajo, Zmajic, khkhnhb@ipdeer.com, zzmajo,  ZZzz1, ZZzz1, 54dbdc835a191af8b943171c946fbbd6d8d21e94, a92d101230448c17babe0ac4ca89f6b8b6841c90, null, ne, null, nije aktiviran, 0)', 22, '2017-06-12 22:41:10'),
(120, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=zzmajo', 22, '2017-06-12 22:46:47'),
(121, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Matea, Matic, matea@ipdeer.com, mmatic,  MAtea2, MAtea2, af1fdc3f01544ca46ee8131fcd68d9bd40cde42e, 4e6e945bf2efbfaf5427cafd84c6dad003d7cc6e, null, ne, null, nije aktiviran, 0)', 23, '2017-06-12 23:05:53'),
(122, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=mmatic', 23, '2017-06-12 23:06:07'),
(123, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Jozo, Jozic, jzozo@ipdeer.com, jozobozo,  JZjz1, JZjz1, e5166eaf6934fde375ff15cacd13eb18087c7741, f63da387364efc3d67dec02313dda3a101564e75, null, ne, null, nije aktiviran, 0)', 24, '2017-06-12 23:37:16'),
(124, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Mato, Matak, matak@ipdeer.com, mmatak,  MmAa3, MmAa3, fac583b08b92d636bb9f5e1321a89aa715fb638f, 40cedc26896c22d7769aef0ca1cb0a365fe2a9a9, null, ne, null, nije aktiviran, 0)', 25, '2017-06-12 23:56:51'),
(125, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=mmatak', 25, '2017-06-12 23:58:22'),
(126, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Stipe, Stipic, stipe111@ipdeer.com, stipe123,  SSss1, SSss1, 97213c282f7298cd25978aded9c6940463d78699, 2e819858b4e5e0c9dbf682aaccebb65ec80b74d3, null, ne, null, nije aktiviran, 0)', 26, '2017-06-13 00:05:34'),
(127, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=stipe123', 26, '2017-06-13 00:09:29'),
(128, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-14 15:45:20'),
(129, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Filip, Juric, filip123@ipdeer.com, filip123,  FFff1, FFff1, a7a7d582628b410404e2672c4c388252cbe1b6a0, 4702531dc7d06f83a822a3ee252cfbaa9ee0ea95, null, da, null, nije aktiviran, 0)', 31, '2017-06-14 15:47:02'),
(130, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=filip123', 31, '2017-06-14 15:49:18'),
(131, 'Prijava/odjava', 'Prijava', NULL, 31, '2017-06-14 15:50:46'),
(132, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 15:51:47,31,2)', 31, '2017-06-14 15:51:47'),
(133, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 15:51:53,31,3)', 31, '2017-06-14 15:51:53'),
(134, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 15:52:00,31,5)', 31, '2017-06-14 15:52:00'),
(135, 'Prijava/odjava', 'Odjava', NULL, 31, '2017-06-14 16:36:51'),
(136, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Jana, Janic, jana01@ipdeer.com, janica01,  JJjj1, JJjj1, 44d086b73fb8a5722bca41214601841134bc8cc5, 775be2b5a2177fc2a94c5dfa8413b1df2a169155, null, ne, null, nije aktiviran, 0)', 32, '2017-06-14 16:38:04'),
(137, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=janica01', 32, '2017-06-14 16:38:20'),
(138, 'Prijava/odjava', 'Prijava', NULL, 32, '2017-06-14 16:38:55'),
(139, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 16:39:23,32,1)', 32, '2017-06-14 16:39:23'),
(140, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 16:39:33,32,4)', 32, '2017-06-14 16:39:33'),
(141, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 16:39:38,32,8)', 32, '2017-06-14 16:39:38'),
(142, 'Ostale radnje', 'Kupnja kupona', 'INSERT INTO `kupnja_kupon`(`idKupnje`, `datum`, `kosarica`, `kod`) VALUES (null, 2017-06-14 16:40:24, 22, c3c0cb7cc38dac29de390f5db6b20f7edb14a5ad)', 32, '2017-06-14 16:40:24'),
(143, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-14 18:04:56'),
(144, 'Registracija', 'Registracija', 'INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,3,Marko, Majetic, gaba@micsocks.net, majetic099,  MAja9, MAja9, 3b44852674bafbce9a0bc6d40a704525d89cec52, b194d8534c930b0bd1a9a507dd672be733ae3b4b, null, da, null, nije aktiviran, 0)', 33, '2017-06-14 23:12:09'),
(145, 'Ostale radnje', 'Aktivacija', 'UPDATE `korisnik` SET `status_racuna`=aktivan  WHERE `korisnicko_ime`=majetic099', 33, '2017-06-14 23:12:30'),
(146, 'Prijava/odjava', 'Prijava', NULL, 33, '2017-06-14 23:16:09'),
(147, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 23:19:20,33,4)', 33, '2017-06-14 23:19:20'),
(148, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 23:20:27,33,7)', 33, '2017-06-14 23:20:27'),
(149, 'Ostale radnje', 'Prijava na program', 'INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, 2017-06-14 23:20:33,33,2)', 33, '2017-06-14 23:20:33'),
(150, 'Ostale radnje', 'Kupnja kupona', 'INSERT INTO `kupnja_kupon`(`idKupnje`, `datum`, `kosarica`, `kod`) VALUES (null, 2017-06-14 23:21:13, 23, e821ac24de75cd4d58970ffcdad9bdd8de1328e1)', 33, '2017-06-14 23:21:14'),
(151, 'Prijava/odjava', 'Odjava', NULL, 33, '2017-06-14 23:21:57'),
(152, 'Prijava/odjava', 'Neuspješna prijava', NULL, 33, '2017-06-14 23:29:41'),
(153, 'Prijava/odjava', 'Neuspješna prijava', NULL, 33, '2017-06-14 23:29:53'),
(154, 'Prijava/odjava', 'Neuspješna prijava', NULL, 33, '2017-06-14 23:30:38'),
(155, 'Ostale radnje', 'Zaključan', 'UPDATE `korisnik` SET `status_racuna`=zakljucan  WHERE `korisnicko_ime`=majetic099', 33, '2017-06-14 23:30:44'),
(156, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-14 23:33:07'),
(157, 'Prijava/odjava', 'Prijava', NULL, 1, '2017-06-14 23:34:29'),
(158, 'Prijava/odjava', 'Odjava', NULL, 1, '2017-06-14 23:37:05');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `evidencija_bodova`
--

CREATE TABLE IF NOT EXISTS `evidencija_bodova` (
  `korisnik` int(11) NOT NULL,
  `trenutno` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  PRIMARY KEY (`korisnik`),
  KEY `fk_evidencija_bodova_korisnik1_idx` (`korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Izbacivanje podataka za tablicu `evidencija_bodova`
--

INSERT INTO `evidencija_bodova` (`korisnik`, `trenutno`, `datum`) VALUES
(1, 90, '2017-06-01'),
(2, 200, '2017-06-14'),
(3, 150, '2017-06-05'),
(4, 35, '2017-06-01'),
(5, 20, '2017-06-05'),
(6, 40, '2017-06-01'),
(7, 20, '2017-06-06'),
(8, 80, '2017-06-07'),
(9, 40, '2017-06-13'),
(10, 5, '2017-06-13'),
(11, 50, '2017-06-13'),
(12, 90, '2017-06-04'),
(13, 60, '2017-06-10'),
(14, 100, '2017-06-13'),
(15, 40, '2017-06-13'),
(16, 80, '2017-06-12'),
(17, 30, '2017-06-12'),
(18, 10, '2017-06-12'),
(19, 120, '2017-06-05'),
(22, 10, '0000-00-00'),
(23, 40, '2017-06-05'),
(24, 0, '2001-01-20'),
(32, 90, '2017-06-14'),
(33, 60, '2017-06-14');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `evidencija_dolazaka`
--

CREATE TABLE IF NOT EXISTS `evidencija_dolazaka` (
  `korisnik` int(11) NOT NULL,
  `termin` int(11) NOT NULL,
  `opis` varchar(200) DEFAULT NULL,
  `moderator` int(11) NOT NULL,
  `zabrana` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`korisnik`,`termin`),
  KEY `fk_evidencija_dolazaka_korisnik2_idx` (`korisnik`),
  KEY `fk_evidencija_dolazaka_korisnik1_idx` (`moderator`),
  KEY `fk_evidencija_dolazaka_termin1_idx` (`termin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Izbacivanje podataka za tablicu `evidencija_dolazaka`
--

INSERT INTO `evidencija_dolazaka` (`korisnik`, `termin`, `opis`, `moderator`, `zabrana`) VALUES
(1, 1, 'aktivno trenira', 2, 'nema'),
(1, 5, 'nema opreme', 3, 'nema'),
(1, 6, 'aktivno trenira', 4, 'nema'),
(1, 7, 'napreduje', 4, 'nema'),
(1, 8, 'poboljšanje', 4, 'nema'),
(2, 1, 'aktivno sudjeluje', 1, 'nema'),
(2, 3, 'aktivan i uredan', 1, 'nema'),
(3, 1, 'aktivan', 1, 'nema'),
(3, 2, 'ne sudjeluje aktivno', 1, 'nema'),
(3, 4, 'aktivan', 1, 'nema'),
(4, 1, 'ne radi', 1, 'zabrana sudjelovanja tjedan dana'),
(4, 2, 'nezainteresiran', 1, 'nema'),
(4, 3, 'aktivno sudjeluje', 1, 'nema'),
(5, 3, 'redovit', 3, 'nema'),
(5, 8, 'kasni', 4, 'nema'),
(6, 7, 'nema opremu', 8, 'nema'),
(7, 6, 'aktivan', 8, 'nema'),
(7, 9, 'aktivan', 3, 'nema'),
(7, 10, 'redovito vježba', 3, 'nema'),
(8, 3, 'redovit', 4, 'nema'),
(8, 8, 'redovit', 8, 'nema'),
(8, 9, 'kasni', 4, 'nema'),
(10, 5, 'kasni', 8, 'nema'),
(12, 6, 'aktivno sudjeluje', 3, 'nema'),
(13, 2, 'napreduje dobro', 8, 'nema'),
(13, 7, 'ne dolazi redovito', 4, 'nema'),
(15, 8, 'napreduje brzo', 8, 'nema');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `konfiguracija_sus`
--

CREATE TABLE IF NOT EXISTS `konfiguracija_sus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aministrator` int(11) NOT NULL,
  `br_redaka` int(3) DEFAULT NULL,
  `trajanje_sesije` time NOT NULL,
  `pomak_vremena` int(11) NOT NULL,
  `neuspjesne_prijave` int(11) NOT NULL,
  `trajanje_linka_aktivacije` time NOT NULL,
  `trajanje_tokena` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_konfiguracija_sus_korisnik1_idx` (`aministrator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Izbacivanje podataka za tablicu `konfiguracija_sus`
--

INSERT INTO `konfiguracija_sus` (`id`, `aministrator`, `br_redaka`, `trajanje_sesije`, `pomak_vremena`, `neuspjesne_prijave`, `trajanje_linka_aktivacije`, `trajanje_tokena`) VALUES
(1, 1, 20, '23:50:00', 10, 3, '00:05:00', '00:00:05');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKorisnik` int(11) NOT NULL AUTO_INCREMENT,
  `tip_korisnika` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `e-mail` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `potvrda_lozinke` varchar(45) NOT NULL,
  `kriptirana_lozinka` varchar(200) NOT NULL,
  `aktivacijski_link` varchar(200) DEFAULT NULL,
  `datum_registriranja` datetime DEFAULT NULL,
  `prijava_2_koraka` varchar(5) NOT NULL,
  `token` varchar(200) DEFAULT NULL,
  `status_racuna` varchar(45) NOT NULL,
  `broj_neuspjesnih_prijava` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKorisnik`),
  KEY `fk_korisnik_tip_korisnika_idx` (`tip_korisnika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Izbacivanje podataka za tablicu `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES
(1, 1, 'Nina', 'Bukovec', 'nikbukove@foi.hr', 'jasad', 'NNnn1', 'NNnn1', '77aa44b822169e773fcff719795010e2c671c34c', '2d16bd6e2d0283898ee8f0eb6fdc1a1ea3b0ca76', '2017-06-03 12:26:28', 'ne', '', 'aktivan', 0),
(2, 3, 'Pero', 'Pavic', 'ppero@gmail.com', 'ppero', 'PPpp2', 'PPpp2', '783ee3bc59dfd17c3452453a26ee0a1aa5867403', 'd313d2f8374497d72088028ba3a4313fd478372a', '2017-05-31 13:15:00', 'ne', NULL, 'aktivan', 0),
(3, 2, 'Ana', 'Anic', 'ana111@gmail.com', 'ana111', 'AAaa1', 'AAaa1', 'ed3cb9d6d95505d6dce84650e554ae4b55dd29c0', '92d84421980e1fc0f9c2e1c78ef77a59cd53d7c5', '2017-06-07 12:31:45', 'ne', NULL, 'aktivan', 0),
(4, 2, 'Nikola', 'Fluks', 'mexewo@getapet.net', 'nikfluks', 'NNnn11', 'NNnn11', 'afcf0566e3192798c75af7637ce7301a367fc709', 'f69ecd12b1096e58d89e3b41df4ad8a5be30707c', '2017-06-10 21:00:00', 'da', '2b3ca74df199aefa8b13cdc56a1ba1caa4dfb55a', 'aktivan', 0),
(5, 3, 'Marko', 'Markic', 'marko123@gmail.com', 'mmarko', 'MMmm3', 'MMmm3', '390b346f79ddb22bdf54a3e2b7068f70244e5e01', 'fd40273e69a629a3828836b932f824c6c6553888', '2017-06-01 21:48:00', 'ne', NULL, 'aktiviran', 0),
(6, 2, 'Luka', 'Modric', 'henaxud@ipdeer.com', 'lmo10', 'MMmm11', 'MMmm11', 'ed764cd6ab9aad301550e6ffc74f1b6da85f49bc', 'c5cc07b50814061f612abcc6e00b05e04e8b555f', '2017-06-10 19:16:25', 'ne', NULL, 'aktivan', 0),
(7, 3, 'Zoran', 'Zoric', 'zzoka@gmail.com', 'zoka12', 'ZZzz1', 'ZZzz1', '1522bdc82aae88f0cbd147d1f6832bc8a286ddee', '9f43b7c8490acd61905c67b0c56439ab82f431ac', '2017-06-01 00:00:00', 'ne', NULL, 'aktiviran', 0),
(8, 2, 'Klara', 'Klaric', 'kklara123@gmail.com', 'kklara', 'KKkk2', 'KKkk2', '3d85684d758c0f5e33e4c5eff971d4c32b9e1be9', 'a4c5311aebb195c5a43da8756714177f7afb70ab', '2017-06-06 19:00:00', 'ne', NULL, 'aktiviran', 0),
(9, 3, 'Goran', 'Gogic', 'go@gi.com', 'gogo333', 'GGgg3', 'GGgg3', '33211fe85a22eb9f704728d365305e278d55313d', '1038f3a66458c00f18a9f9fbb9bc1531ac6a0319', '2017-06-06 18:00:00', 'ne', NULL, 'aktiviran', 0),
(10, 3, 'Kata', 'Katic', 'katakat@gmail.com', 'katakatic', 'KKkk1', 'KKkk1', '3d5c27fac53afdc651bcca1757cfa1aed28e227a', '15444aba7e2abcd5c29e7e2dacc34c1b43085d9e', '2017-06-06 15:36:00', 'ne', NULL, 'aktiviran', 0),
(11, 3, 'Ivan', 'Ivic', 'ivoivan1@gmail.com', 'ivoivan', 'IIii2', 'IIii2', '8fd8d98a5b37d619f684db2b435736519c7bf1c5', '8190bd0e836ccfbe73be895476acc2e0c5d462dd', '2017-06-12 13:25:27', 'ne', NULL, 'aktiviran', 0),
(12, 3, 'Maja', 'Juric', 'majajur@gmail.com', 'majajur', 'MAma1', 'MAma1', '89714717c4112f616ee09c910d8e89ce582ec5c9', '92561856e8c03bf209d59e7452a51a45b2dc90d3', NULL, 'ne', NULL, 'nije aktiviran', 0),
(13, 3, 'Dora', 'Doric', 'ddora123@gmail.com', 'ddora', 'DDdd1', 'DDdd1', 'c2c4841a47502692492646ce7801bc313fe5c77e', '287451f51f554dc2cabedb93cc8940479990cc93', '2017-06-06 13:24:00', 'ne', NULL, 'aktiviran', 0),
(14, 3, 'Mirko', 'Mirkic', 'mirkomirkic@gmail.com', 'mirko11', 'MMii1', 'MMii1', '30e75acd4c8a9dd3b7c8b347cc8d649aed2f656a', '068fff35560c7976597de031135f0335ac6c7cf4', NULL, 'ne', NULL, 'nije aktiviran', 0),
(15, 3, 'Iva', 'Babic', 'ivab@gmail.com', 'ivababic', 'IBib2', 'IBib2', '11c1301c72d6fdf2f994448ff0ed19385dd3ebc8', '9f36dd23844ae2b9aeb333cb86781649234d52d5', NULL, 'ne', NULL, 'nije aktiviran', 0),
(16, 3, 'Petra', 'Petric', 'petrica@gmail.com', 'ppetra', 'PEtra2', 'PEtra2', 'fbb07d8497d29ce08fc2e4f8bfae4b94f7a27439', '1c0005acd096b5103c4d9e3895841b4f5ce5e2e8', NULL, 'ne', NULL, 'nije aktiviran', 0),
(17, 3, 'Jura', 'Juric', 'jjuric@gmail.com', 'jjuric', 'JJjj3', 'JJjj3', 'a4aa6ff2fc749dea3000a053f758f5f9ced6984f', '0ca2be0e4669e0b8541247d920137c0633faf248', NULL, 'ne', NULL, 'nije aktiviran', 0),
(18, 3, 'Gloria', 'Batic', 'globatic@gmail.com', 'globat', 'GBgb2', 'GBgb2', '278d131154a7c99644d3a32b862c30d87e756f08', 'ffadf95aef2df3456f242d5939ea434071ae6125', '2017-06-06 11:00:00', 'ne', NULL, 'aktiviran', 0),
(19, 3, 'Mijo', 'Mijic', 'mijo123@gmail.com', 'mijom', 'MIJOmijo1', 'MIJOmijo1', '5b336c0f1c783297a9f96d19906efe1405df4e9f', 'f83fb0a30a9663dd293ec7d674b538e8c01ceefd', '2017-06-13 04:31:20', 'ne', NULL, 'aktiviran', 0),
(22, 3, 'Zmajo', 'Zmajic', 'khkhnhb@ipdeer.com', 'zzmajo', 'ZZzz1', 'ZZzz1', '54dbdc835a191af8b943171c946fbbd6d8d21e94', 'a92d101230448c17babe0ac4ca89f6b8b6841c90', '2017-06-12 22:46:47', 'ne', NULL, 'aktivan', 0),
(23, 3, 'Matea', 'Matic', 'matea@ipdeer.com', 'mmatic', 'MAtea2', 'MAtea2', 'af1fdc3f01544ca46ee8131fcd68d9bd40cde42e', '4e6e945bf2efbfaf5427cafd84c6dad003d7cc6e', '2017-06-12 23:06:07', 'ne', NULL, 'aktivan', 0),
(24, 3, 'Jozo', 'Jozic', 'jzozo@ipdeer.com', 'jozobozo', 'JZjz1', 'JZjz1', 'e5166eaf6934fde375ff15cacd13eb18087c7741', 'f63da387364efc3d67dec02313dda3a101564e75', NULL, 'ne', NULL, 'nije aktiviran', 0),
(25, 3, 'Mato', 'Matak', 'matak@ipdeer.com', 'mmatak', 'MmAa3', 'MmAa3', 'fac583b08b92d636bb9f5e1321a89aa715fb638f', '40cedc26896c22d7769aef0ca1cb0a365fe2a9a9', '2017-06-12 23:58:22', 'ne', NULL, 'aktivan', 0),
(26, 3, 'Stipe', 'Stipic', 'stipe111@ipdeer.com', 'stipe123', 'SSss1', 'SSss1', '97213c282f7298cd25978aded9c6940463d78699', '2e819858b4e5e0c9dbf682aaccebb65ec80b74d3', '2017-06-13 00:09:28', 'ne', NULL, 'blokiran', 0),
(27, 3, 'Zane', 'Zanic', 'lamymlam@ipdeer.com', 'zzane', 'ZaNe2', 'ZaNe2', 'bc09f3206846244d218b35e7b46d476b4943c933', '1f8b7d6dd3aced7ddb68509c4bf72b6cf25a4d5c', '2017-06-13 00:16:59', 'ne', NULL, 'aktivan', 0),
(28, 3, 'Zdravko', 'Mamic', 'seladel@micsocks.net', 'savjetnik', 'SSss11', 'SSss11', '61e99358be589eb8b5dcbe89329436d8d4ea933c', 'b5cba41c00308c3688a16fb301ba273d27970a4e', '2017-06-13 01:23:03', 'ne', NULL, 'aktivan', 0),
(29, 3, 'Ivan', 'Perisic', 'kexedexa@ipdeer.com', 'jovan', 'IIii11', 'IIii11', '2d24f0b27a5b9e7c2c0c76627e92143779ccc98c', 'b73837de843f39bcb5b1d9d9c953cd32b6749dfd', '2017-06-13 01:26:02', 'da', '7d76a555113d46c9082e65a49a75c4054318ad99', 'aktivan', 0),
(30, 3, 'Maricaa', 'Santic', 'akssbzerqq@ipdeer.com', 'maricaaa', 'MImi3', 'MImi3', '89f99998556f549d73d4cfe2f3947ba31b45dcfd', '4e1e4b83535b4b3ba42ae0dbd228a456d1a90107', '2017-06-13 08:04:16', 'da', NULL, 'aktivan', 0),
(31, 3, 'Filip', 'Juric', 'filip123@ipdeer.com', 'filip123', 'FFff1', 'FFff1', 'a7a7d582628b410404e2672c4c388252cbe1b6a0', '4702531dc7d06f83a822a3ee252cfbaa9ee0ea95', '2017-06-14 15:49:18', 'da', 'e1abc16ec666a3bdc6f059c5832501213469c146', 'aktivan', 0),
(32, 3, 'Jana', 'Janic', 'jana01@ipdeer.com', 'janica01', 'JJjj1', 'JJjj1', '44d086b73fb8a5722bca41214601841134bc8cc5', '775be2b5a2177fc2a94c5dfa8413b1df2a169155', '2017-06-14 16:38:20', 'ne', NULL, 'aktivan', 0),
(33, 3, 'Marko', 'Majetic', 'gaba@micsocks.net', 'majetic099', '8VqSL', '8VqSL', '3b44852674bafbce9a0bc6d40a704525d89cec52', 'b194d8534c930b0bd1a9a507dd672be733ae3b4b', '2017-06-14 23:12:30', 'da', '0e2168699d264589a9eba72333815096a75aba72', 'zakljucan', 3);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kosarica`
--

CREATE TABLE IF NOT EXISTS `kosarica` (
  `idKosarice` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `datum` date NOT NULL,
  `kupon` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  PRIMARY KEY (`idKosarice`),
  KEY `fk_kosarica_korisnik1_idx` (`korisnik`),
  KEY `fk_kosarica_kupon_program1_idx` (`kupon`,`program`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kosarica_privremeno`
--

CREATE TABLE IF NOT EXISTS `kosarica_privremeno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik` int(11) NOT NULL,
  `kupon` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `korisnik` (`korisnik`),
  KEY `kupon` (`kupon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Izbacivanje podataka za tablicu `kosarica_privremeno`
--

INSERT INTO `kosarica_privremeno` (`id`, `korisnik`, `kupon`) VALUES
(1, 1, 1),
(3, 2, 2),
(7, 2, 4),
(8, 3, 1),
(9, 4, 1),
(10, 5, 2),
(11, 6, 4),
(12, 6, 3),
(13, 8, 1),
(14, 5, 2),
(15, 6, 5),
(16, 11, 4),
(17, 12, 5),
(18, 14, 2),
(19, 7, 5),
(20, 9, 1),
(21, 10, 4);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kupnja`
--

CREATE TABLE IF NOT EXISTS `kupnja` (
  `idKupnje` int(11) NOT NULL AUTO_INCREMENT,
  `datum_kupnje` datetime DEFAULT NULL,
  `kosarica` int(11) NOT NULL,
  `kod` varchar(50) NOT NULL,
  PRIMARY KEY (`idKupnje`),
  KEY `fk_kupnja_kosarica_privremeno_idx` (`kosarica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kupnja_kupon`
--

CREATE TABLE IF NOT EXISTS `kupnja_kupon` (
  `idKupnje` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL,
  `kosarica` int(11) NOT NULL,
  `kod` varchar(500) NOT NULL,
  PRIMARY KEY (`idKupnje`),
  KEY `kosarica` (`kosarica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Izbacivanje podataka za tablicu `kupnja_kupon`
--

INSERT INTO `kupnja_kupon` (`idKupnje`, `datum`, `kosarica`, `kod`) VALUES
(1, '2017-06-01 17:38:00', 1, '02jsijsh209'),
(2, '2017-06-13 22:36:49', 5, '6ff5ff800fa9f282e5e074c16cdb72376e5c47e9'),
(3, '2017-06-13 22:44:13', 5, 'de1a0816b9f5a3e6650013b610af03008763ff80'),
(4, '2017-06-13 22:50:32', 5, 'fb51b9bfde638cefcbf1fa71da9dee29e5de1b4f'),
(5, '2017-06-13 09:25:00', 2, 'ksjskanxjnsxk89109mxkmskxa9'),
(6, '2017-06-08 11:23:39', 3, '7267267623jshs882hsjnjnsxjnx'),
(7, '2017-06-14 15:40:04', 6, '031887cc0fb282e34540001f2d68292c33fbf32e'),
(8, '2017-06-14 16:40:24', 22, 'c3c0cb7cc38dac29de390f5db6b20f7edb14a5ad'),
(9, '2017-06-14 23:21:13', 23, 'e821ac24de75cd4d58970ffcdad9bdd8de1328e1');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kupon`
--

CREATE TABLE IF NOT EXISTS `kupon` (
  `idKupon` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `detaljnije` varchar(200) NOT NULL,
  `vrijedi_od` date NOT NULL,
  `vrijedi_do` date NOT NULL,
  `potrebno_bodova` int(11) NOT NULL,
  `dokument` varchar(200) DEFAULT NULL,
  `slika_url` varchar(1000) NOT NULL,
  `video` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idKupon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Izbacivanje podataka za tablicu `kupon`
--

INSERT INTO `kupon` (`idKupon`, `naziv`, `detaljnije`, `vrijedi_od`, `vrijedi_do`, `potrebno_bodova`, `dokument`, `slika_url`, `video`) VALUES
(1, 'Kupon za vjernost', 'Kupon za besplatnih tjedan dana vježbanja', '2017-06-05', '2017-06-19', 20, 'pdf/poklon_kuponi.pdf', 'slike/poklon-kupon.jpg', 'https://www.youtube.com/embed/VEX7KhIA3bU'),
(2, 'Kupon za fitness', 'Besplatni termin fitnessa za dvoje', '2017-06-01', '2017-06-30', 40, 'pdf/fitness.pdf', 'slike/fitness.jpg', 'https://www.youtube.com/embed/L77b57erQ4M'),
(3, 'Kuponi popusta za Hervis', 'Popust na kupnju', '2017-06-01', '2017-06-30', 50, 'pdf/Hervis.pdf', 'slike/hervis_kuponi.jpg', 'https://www.youtube.com/embed/tK9IDfO3eXk'),
(4, 'Poklon bon', 'Kupon od 15% popusta na određene aranžmane', '2017-05-15', '2017-06-01', 100, 'pdf/Poklon_bon.pdf', 'slike/poklon_bon.jpg', 'https://www.youtube.com/embed/8GVM6G2oCMI'),
(5, 'Sport spirit', 'Određeni popusti u navedenim trgovinama', '2017-06-05', '2017-06-20', 50, 'pdf/sport.pdf', 'slike/sport_spirit.jpg', 'https://www.youtube.com/embed/0t5ccIIFLSU'),
(6, 'Kupon special', 'Kupon za popust u trgovini po izboru', '2001-06-20', '2017-06-30', 30, 'pdf/popust.jpg', 'slike/popust.jpg', 'https://www.youtube.com/embed/AFQ1YTgwEIg'),
(7, 'Novi kupon', 'Za dolaske', '2002-03-20', '2017-06-23', 50, 'pdf/sport.pdf', 'slike/popust.jpg', 'https://www.youtube.com/embed/ejDpAOyFnoE');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kupon_program`
--

CREATE TABLE IF NOT EXISTS `kupon_program` (
  `kupon` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  PRIMARY KEY (`kupon`,`program`),
  KEY `fk_kupon_program_kupon1_idx` (`kupon`),
  KEY `fk_kupon_program_program1_idx` (`program`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Izbacivanje podataka za tablicu `kupon_program`
--

INSERT INTO `kupon_program` (`kupon`, `program`) VALUES
(1, 1),
(1, 2),
(1, 5),
(2, 3),
(2, 5),
(2, 7),
(3, 2),
(3, 8),
(4, 1),
(4, 5),
(4, 10),
(5, 6),
(5, 8),
(6, 1),
(6, 9);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `potroseni_bodovi`
--

CREATE TABLE IF NOT EXISTS `potroseni_bodovi` (
  `id` int(11) NOT NULL,
  `kupnja_id` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_potroseni_bodovi_kupnja1_idx` (`kupnja_id`),
  KEY `fk_potroseni_bodovi_evidencija_bodova1_idx` (`korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `prijava`
--

CREATE TABLE IF NOT EXISTS `prijava` (
  `idPrijave` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `korisnik` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  PRIMARY KEY (`idPrijave`),
  KEY `fk_prijava_program1_idx` (`program`),
  KEY `fk_prijava_korisnik1_idx` (`korisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Izbacivanje podataka za tablicu `prijava`
--

INSERT INTO `prijava` (`idPrijave`, `datum`, `korisnik`, `program`) VALUES
(1, '2017-06-08', 2, 2),
(2, '2017-06-08', 1, 1),
(3, '2017-06-08', 1, 2),
(4, '2017-06-10', 2, 3),
(5, '2017-06-11', 2, 1),
(6, '2017-06-01', 4, 2),
(7, '2017-06-03', 3, 2),
(8, '2017-06-01', 3, 4),
(9, '2017-06-02', 4, 2),
(10, '2017-06-12', 4, 3),
(11, '2017-06-12', 4, 6),
(12, '2017-06-13', 1, 4),
(13, '2017-06-13', 1, 9),
(14, '2017-06-13', 1, 11),
(15, '2017-06-13', 1, 5),
(16, '2017-06-13', 2, 5),
(17, '2017-06-06', 5, 5),
(18, '2017-06-01', 12, 2),
(19, '2017-06-05', 5, 2),
(20, '2017-06-07', 7, 10),
(21, '2017-06-01', 3, 8),
(22, '2017-06-06', 9, 3),
(23, '2017-06-02', 7, 6),
(24, '2017-06-06', 11, 4),
(25, '2017-06-03', 8, 5),
(26, '2017-06-06', 12, 5),
(27, '2017-06-06', 5, 9),
(28, '2017-06-06', 12, 4),
(29, '2017-06-02', 10, 6),
(30, '2017-06-01', 12, 6),
(31, '2017-06-04', 4, 7),
(32, '2017-06-05', 11, 10),
(33, '2017-06-05', 7, 21),
(34, '2017-06-06', 9, 23),
(35, '2017-06-12', 15, 23),
(36, '2017-06-12', 16, 21),
(37, '2017-06-05', 6, 21),
(38, '2017-06-04', 23, 22),
(39, '2017-06-14', 31, 2),
(40, '2017-06-14', 31, 3),
(41, '2017-06-14', 31, 5),
(42, '2017-06-14', 32, 1),
(43, '2017-06-14', 32, 4),
(44, '2017-06-14', 32, 8),
(45, '2017-06-14', 33, 4),
(46, '2017-06-14', 33, 7),
(47, '2017-06-14', 33, 2);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `idProgram` int(11) NOT NULL AUTO_INCREMENT,
  `vrsta_programa` int(11) NOT NULL,
  `naziv` varchar(45) DEFAULT NULL,
  `opis_programa` varchar(200) DEFAULT NULL,
  `broj_mjesta` int(11) DEFAULT NULL,
  `slobodno` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProgram`),
  KEY `fk_program_vrsta_programa1_idx` (`vrsta_programa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Izbacivanje podataka za tablicu `program`
--

INSERT INTO `program` (`idProgram`, `vrsta_programa`, `naziv`, `opis_programa`, `broj_mjesta`, `slobodno`) VALUES
(1, 1, 'Program snage', 'Treninzi za povećanje mišićne mase i test snage', 30, 3),
(2, 2, 'Novi', 'novi', 20, 1),
(3, 1, 'Vježbe za kralježnicu', 'Vježbe na spravama za kralježnicu i ravno držanje', 20, 2),
(4, 4, 'Razgibavanje uz ples', 'Lagani plesni pokreti uz muziku i opuštajuće vježbe', 20, 0),
(5, 1, 'Vježbe za napredne sportaše ', 'Intenzivni treninzi u trajanju od sat vremena', 20, 8),
(6, 3, 'Vježbe za oblikovanje nogu', 'Dinamičan tempo, za učvršćivanje mišića nogu', 30, 5),
(7, 5, 'Aerobic', 'Klisični aerobic,trajanje 45 min', 30, 11),
(8, 1, 'Program izdržljivosti', 'Jačanje kondicije kroz kontinuirane treninge na spravama', 15, 2),
(9, 2, 'Grupni trening za početnike', 'Mjesec dana probnog treninga za apsolutne početnike', 20, 3),
(10, 2, 'Program na otvorenom', 'Vježbe u prirodi, koordinira trener', 30, 10),
(11, 2, 'Jogga', 'Sat jogge, koordinira vanjski suradnik i stručnjak', 20, 5),
(12, 3, 'Trčanje', 'Trčanje prema odgovarajućem tempu, kombinirano sa par sprava', 15, 4),
(13, 2, 'Program opuštanja', 'Opuštajuće vježbe disanja', 10, 6),
(14, 3, 'Program za djecu', 'Vježbe za kralježnicu i zglobove, grupno', 50, 14),
(15, 2, 'Program za jačanje', 'Jačanje mišića cijelog tijela', 20, 6),
(16, 4, 'Dvotjedni program mršavljanja', 'Intenzivne vježbe za smanjenje tjelesne težine', 15, 5),
(17, 4, 'Noćni program', 'Treninzi iza 22 h', 12, 4),
(18, 5, 'Program za trudnice', 'Lakše vježbe, trajanje 30 min', 30, 15),
(19, 2, 'Program Fit', 'Vježbe za zatezanje', 25, 6),
(20, 4, 'Program za mlade', 'dinamične vježbe po 45 min', 30, 8),
(21, 6, 'Program Special', 'Vježbe na spravama', 14, 3),
(22, 7, 'Program Professional', 'Program izdržljivosti', 8, 2),
(23, 7, 'Aktivnosti na otovrenom', 'Planinarenje, šetnje, na igralištu...', 30, 8),
(24, 5, 'Program iznenađenja', 'Kombinacija', 40, 6),
(25, 6, 'Program za oblikovanje', 'Prilagođeno vašim željama', 15, 7),
(26, 6, 'Program koncentracije', 'Opuštanje i vježbe za bolju koncentraciju', 20, 8),
(27, 6, 'Vježbe za cirkulaciju', 'Za poboljšanje cirkulacije (starije osobe)', 10, 4),
(28, 7, 'StayVital', 'Program za strarije osobe u dobroj formi, zahtjeva fizički napor', 15, 6),
(29, 7, 'Ballance program', 'Ujednačane vježbe tijekom 3 mjeseca treniranja', 25, 7);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `program_stranica`
--

CREATE TABLE IF NOT EXISTS `program_stranica` (
  `id` int(11) NOT NULL,
  `opis` varchar(250) NOT NULL,
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_program_stranica_program1_idx` (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `termin_vjezbi`
--

CREATE TABLE IF NOT EXISTS `termin_vjezbi` (
  `idTermin` int(11) NOT NULL AUTO_INCREMENT,
  `dan_u_tjednu` varchar(45) NOT NULL,
  `mjesec` varchar(45) NOT NULL,
  `datum` date DEFAULT NULL,
  `vrijeme` time NOT NULL,
  `trajanje` time NOT NULL,
  `broj_polaznika` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `program` int(11) NOT NULL,
  PRIMARY KEY (`idTermin`),
  KEY `fk_termin_vjezbi_program1_idx` (`program`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Izbacivanje podataka za tablicu `termin_vjezbi`
--

INSERT INTO `termin_vjezbi` (`idTermin`, `dan_u_tjednu`, `mjesec`, `datum`, `vrijeme`, `trajanje`, `broj_polaznika`, `status`, `program`) VALUES
(1, 'utorak', 'svibanj', '2017-05-09', '17:00:00', '00:00:01', 15, 'održava se', 1),
(2, 'ponedjeljak', 'lipanj', '2017-06-05', '19:00:00', '00:00:02', 30, 'održava se', 2),
(3, 'srijeda', 'lipanj', '2017-06-14', '18:00:00', '00:00:01', 20, 'održava se', 3),
(4, 'petak', 'lipanj', '2017-06-02', '21:30:00', '00:00:02', 5, 'održava se', 2),
(5, 'nedjelja', 'svibanj', '2017-06-03', '20:00:00', '01:00:00', 10, 'održava se', 3),
(6, 'srijeda', 'lipanj', '2017-06-07', '19:00:00', '01:00:00', 5, 'održava se', 4),
(7, 'petak', 'lipanj', '2017-06-08', '12:00:00', '02:00:00', 10, 'održava se', 3),
(8, 'četvrtak', 'svibanj', '2017-06-07', '17:00:00', '00:30:00', 15, 'održava se', 2),
(9, 'petak', 'travanj', '2017-04-07', '19:00:00', '02:00:00', 10, 'održava se', 1),
(10, 'nedjelja', 'svibanj', '2017-05-06', '20:00:00', '01:00:00', 20, 'odgođeno za srpanj', 2),
(11, 'petak', 'lipanj', '2017-06-02', '08:00:00', '01:00:00', 10, 'održava se', 6),
(12, 'ponedjeljak', 'svibanj', '2017-05-08', '21:00:00', '02:00:00', 13, 'održava se', 4);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `tip_korisnika`
--

CREATE TABLE IF NOT EXISTS `tip_korisnika` (
  `idTip_korisnika` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`idTip_korisnika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Izbacivanje podataka za tablicu `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`idTip_korisnika`, `naziv`) VALUES
(1, 'administrator'),
(2, 'moderator'),
(3, 'registrirani'),
(4, 'neregistrirani');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `vrsta_akcije`
--

CREATE TABLE IF NOT EXISTS `vrsta_akcije` (
  `idVrste_akcije` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `broj_bodova` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVrste_akcije`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Izbacivanje podataka za tablicu `vrsta_akcije`
--

INSERT INTO `vrsta_akcije` (`idVrste_akcije`, `naziv`, `broj_bodova`) VALUES
(1, 'Registracija', 10),
(2, 'prijava', 10),
(3, 'Dodaj u košaricu', 30),
(4, 'Dijeljenje na mrežama', 80),
(5, 'Korištenje kupona u teretani', 100),
(6, 'Prijava na program', 20),
(7, 'Gledanje videa', 40),
(8, 'Download pdf-a', 50),
(9, 'Stavaljanje u košaricu', 30),
(10, 'Pregled evidencije bodova', 10);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `vrsta_programa`
--

CREATE TABLE IF NOT EXISTS `vrsta_programa` (
  `idVrste_programa` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` varchar(200) DEFAULT NULL,
  `moderator` int(11) NOT NULL,
  PRIMARY KEY (`idVrste_programa`),
  KEY `fk_vrsta_programa_korisnik2_idx` (`moderator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Izbacivanje podataka za tablicu `vrsta_programa`
--

INSERT INTO `vrsta_programa` (`idVrste_programa`, `naziv`, `opis`, `moderator`) VALUES
(1, 'Individualni trening', 'Rad sa spravama', 4),
(2, 'Grupni program', 'Treninzi u skupinama', 3),
(3, 'Individualni treninzi izdržljivosti', 'Treninzi u kontinuitetu, trajanje 2h', 3),
(4, 'Vježbe za starije osobe', 'Za osobe iznad 60 godina, lagan tempo, po 45 min', 8),
(5, 'Treninzi za timove', 'Timovi po 8 članova, vježbe po izboru, u dogovoru s trenerom', 4),
(6, 'Dvotjedni trening', 'Svakodnevni treninzi u razdoblju od 2 tjedna, za napredne sportaše', 3),
(7, 'Programi na otvorenom', 'Vježbe se izvode u parku teretane, sa nosivim spravama', 3);

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `akcija`
--
ALTER TABLE `akcija`
  ADD CONSTRAINT `fk_akcija_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_akcija_vrsta_akcije1` FOREIGN KEY (`vrsta_akcije`) REFERENCES `vrsta_akcije` (`idVrste_akcije`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD CONSTRAINT `fk_dnevnik_akcija_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `evidencija_bodova`
--
ALTER TABLE `evidencija_bodova`
  ADD CONSTRAINT `fk_evidencija_bodova_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `evidencija_dolazaka`
--
ALTER TABLE `evidencija_dolazaka`
  ADD CONSTRAINT `fk_evidencija_dolazaka_korisnik2` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evidencija_dolazaka_korisnik1` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evidencija_dolazaka_termin1` FOREIGN KEY (`termin`) REFERENCES `termin_vjezbi` (`idTermin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `konfiguracija_sus`
--
ALTER TABLE `konfiguracija_sus`
  ADD CONSTRAINT `fk_konfiguracija_sus_korisnik1` FOREIGN KEY (`aministrator`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_tip_korisnika` FOREIGN KEY (`tip_korisnika`) REFERENCES `tip_korisnika` (`idTip_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `kosarica`
--
ALTER TABLE `kosarica`
  ADD CONSTRAINT `fk_kosarica_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kosarica_kupon_program1` FOREIGN KEY (`kupon`, `program`) REFERENCES `kupon_program` (`kupon`, `program`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `kupnja`
--
ALTER TABLE `kupnja`
  ADD CONSTRAINT `fk_kupnja_kosarica1` FOREIGN KEY (`kosarica`) REFERENCES `kosarica` (`idKosarice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `kupon_program`
--
ALTER TABLE `kupon_program`
  ADD CONSTRAINT `fk_kupon_program_kupon1` FOREIGN KEY (`kupon`) REFERENCES `kupon` (`idKupon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kupon_program_program1` FOREIGN KEY (`program`) REFERENCES `program` (`idProgram`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `potroseni_bodovi`
--
ALTER TABLE `potroseni_bodovi`
  ADD CONSTRAINT `fk_potroseni_bodovi_kupnja1` FOREIGN KEY (`kupnja_id`) REFERENCES `kupnja` (`idKupnje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_potroseni_bodovi_evidencija_bodova1` FOREIGN KEY (`korisnik`) REFERENCES `evidencija_bodova` (`korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `fk_prijava_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prijava_program1` FOREIGN KEY (`program`) REFERENCES `program` (`idProgram`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_2` FOREIGN KEY (`vrsta_programa`) REFERENCES `vrsta_programa` (`idVrste_programa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `program_stranica`
--
ALTER TABLE `program_stranica`
  ADD CONSTRAINT `fk_program_stranica_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`idProgram`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `termin_vjezbi`
--
ALTER TABLE `termin_vjezbi`
  ADD CONSTRAINT `fk_termin_vjezbi_program1` FOREIGN KEY (`program`) REFERENCES `program` (`idProgram`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `vrsta_programa`
--
ALTER TABLE `vrsta_programa`
  ADD CONSTRAINT `fk_vrsta_programa_korisnik2` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`idKorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
