-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Máj 08. 17:07
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `plwebshop`
--
CREATE DATABASE IF NOT EXISTS `plwebshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `plwebshop`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adatok`
--

CREATE TABLE `adatok` (
  `id` int(9) NOT NULL,
  `user` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `adatok`
--

INSERT INTO `adatok` (`id`, `user`, `email`, `pwd`) VALUES
(1, 'Laci', 'laszlo.poczik@yahoo.com', '7c222fb2927d828af22f592134e8932480637c0d');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `admin` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(2) NOT NULL,
  `katnev` varchar(255) NOT NULL,
  `katsorrend` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`id`, `katnev`, `katsorrend`) VALUES
(1, 'Ipari porszívó', 1),
(2, 'Bosch porszívó', 2),
(3, 'Electrolux porszívó', 3),
(4, 'Samsung porszívó', 4),
(5, 'Gorenje porszívó', 5),
(6, 'Philips porszívó', 6),
(7, 'Hyundai porszívó', 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `id` int(5) NOT NULL,
  `vevoid` int(4) NOT NULL,
  `szallitas` varchar(20) NOT NULL,
  `fizmod` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `statusz` varchar(50) NOT NULL,
  `bosszeg` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rendelesek`
--

INSERT INTO `rendelesek` (`id`, `vevoid`, `szallitas`, `fizmod`, `datum`, `statusz`, `bosszeg`) VALUES
(2, 2, 'gls', 'obk', '2021-05-08', 'függőben', '38899'),
(3, 3, 'gls', 'obk', '2021-05-08', 'függőben', '0'),
(4, 4, 'gls', 'obk', '2021-05-08', 'függőben', '0'),
(5, 5, 'szemelyes', 'utanvet', '2021-05-08', 'függőben', '74899'),
(6, 6, 'szemelyes', 'utanvet', '2021-05-08', 'függőben', '0'),
(7, 7, 'szemelyes', 'utanvet', '2021-05-08', 'függőben', '0'),
(8, 8, 'szemelyes', 'utanvet', '2021-05-08', 'függőben', '0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rend_term`
--

CREATE TABLE `rend_term` (
  `id` int(5) NOT NULL,
  `rendelesid` int(5) NOT NULL,
  `termekid` int(5) NOT NULL,
  `db` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rend_term`
--

INSERT INTO `rend_term` (`id`, `rendelesid`, `termekid`, `db`) VALUES
(1, 1, 7, 1),
(2, 1, 2, 3),
(3, 6, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tajekoztato`
--

CREATE TABLE `tajekoztato` (
  `id` int(2) NOT NULL,
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `content` mediumtext COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tajekoztato`
--

INSERT INTO `tajekoztato` (`id`, `cim`, `content`) VALUES
(2, 'Vásárlói tájékoztató', '<P>Köszönjük, hogy nálunk vásárolt. Adatait bizalmasan kezeljük, a jelenleg érvényes magyar jogszabályok szerint. Általános magyar fogyasztói jogszabályoknak megfelelt áruházunk.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit sem, commodo vel erat id, feugiat dictum odio. Nulla aliquet ligula ac odio congue, ultricies bibendum ligula dignissim. Mauris vel magna finibus purus posuere dignissim eu sed ante. Vestibulum eget lacinia lectus, nec porta elit. Sed luctus, dolor eu sodales dapibus, magna erat blandit erat, et consectetur felis ante ut nulla. Proin ullamcorper mattis vulputate. Ut ac leo id lorem rutrum congue sit amet sit amet est. Fusce gravida sapien vitae ligula blandit pretium. Phasellus fermentum ullamcorper condimentum. Nam eget pellentesque erat. Integer vitae nunc vel nulla commodo viverra sed vitae tortor. Phasellus nec varius eros, eu efficitur metus. Fusce bibendum tortor a enim bibendum, non elementum turpis posuere. Aliquam tristique enim eget metus aliquet volutpat. Vestibulum a condimentum felis, quis consectetur neque.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent facilisis volutpat tortor, id finibus sem pretium in. Vivamus feugiat tristique lorem a rutrum. Aenean dolor ante, pretium nec tellus quis, accumsan laoreet nunc. Curabitur faucibus faucibus arcu, sed fermentum turpis vehicula id. In in eros purus. Fusce euismod diam in urna tempus consectetur. Ut nec tincidunt risus. Integer vitae lectus turpis. Nunc nunc erat, ultricies id erat at, mollis porttitor est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam condimentum sem id ante volutpat, non condimentum enim porttitor. Quisque elementum libero vitae bibendum euismod. Mauris luctus laoreet nulla sed venenatis. Donec eget imperdiet ex. Donec nunc sem, cursus gravida nisi sed, dapibus egestas urna. Fusce ullamcorper, ex vitae dapibus pellentesque, lacus mauris blandit magna, vitae congue nisl nunc sit amet mi.</p>\r\n<p>&nbsp;</p>\r\n<p>Donec rutrum lacinia fermentum. Nunc ut blandit ante. Aliquam venenatis lacus vel mauris semper venenatis. Vestibulum vel dignissim ante. Phasellus ut turpis non augue elementum ultrices. Curabitur consectetur, orci id molestie dictum, metus dui elementum orci, vitae ultrices elit nibh sed magna. Nullam interdum, urna et pretium volutpat, dui ante lacinia sem, sed pretium mauris magna in dolor. Quisque tincidunt lectus quis velit pellentesque interdum. Mauris vitae ultrices metus, eu consequat purus. Curabitur facilisis lorem lacinia eros viverra, in lobortis eros luctus.</p>\r\n<p>&nbsp;</p>\r\n<p>Cras congue nulla eu nisl laoreet ultricies. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec ultricies urna a aliquet auctor. In at laoreet felis. Aliquam nibh erat, dignissim et commodo faucibus, accumsan eget magna. Curabitur sit amet rhoncus justo. Vivamus eget risus tincidunt, fermentum neque a, rutrum dui. Praesent fermentum sem lacus, nec efficitur quam sollicitudin et. Integer eu mi purus. Ut quis enim sit amet arcu suscipit malesuada non at odio. Maecenas consectetur facilisis tortor, vel molestie diam tempus eu. In hac habitasse platea dictumst. Integer sit amet lobortis mauris. Fusce ut ultrices urna.</p>');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `id` int(5) NOT NULL,
  `kategoria` varchar(100) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `cikkszam` decimal(10,0) NOT NULL,
  `ar` decimal(10,0) NOT NULL,
  `rleiras` varchar(255) NOT NULL,
  `hleiras` mediumtext NOT NULL,
  `kep` varchar(255) NOT NULL,
  `keszlet` int(3) NOT NULL,
  `aktiv` int(1) NOT NULL DEFAULT 1,
  `megtekintes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`id`, `kategoria`, `nev`, `cikkszam`, `ar`, `rleiras`, `hleiras`, `kep`, `keszlet`, `aktiv`, `megtekintes`) VALUES
(1, '2', 'Bosch BBHF214', '270001', '38899', ' Gyártó: Bosch, Modell: BBHF214', 'Tulajdonságok:\r\n\r\n- Végre! Nincs kábel. Nincs kompromisszum. Tökéletes nagy teljesítményű\r\n- 2in1: Kézi porszívó és morzsaporszívó egy készülékben\r\n- Lítium-ion technológia: Erőteljes akkumulátor hosszú élettartammal és rövid töltési idővel\r\n- Elektromos kefe az összes padlófelület alapos tisztításához\r\n- Két teljesítmény\r\n- Mosható szűrő\r\n- Könnyű kezelés a tartály eltávolításakor és ürítésekor\r\n- Maximális rugalmasság: vezeték nélküli szívás korlátozás nélkül, a bútorok körül és alatt, a rögzíthető mozgatható csatlakozónak köszönhetően\r\n- Önálló állóhelyzet az egyszerű tároláshoz és rugalmas töltéshez\r\n- Könnyen kezelhető, tárolható és tisztítható a könnyű súlya miatt és az EasyClean rendszernek köszönhetően\r\n- EasyClean rendszer: A kefe könnyű eltávolítása és tisztítása\r\n- Rendkívül hosszú működési idő: akár 35 perc\r\n- Töltési idő: 4-5 óra\r\n- Súly: 2.4 kg\r\n- Méretek: 1160 x 265 x 165 mm\r\n', 'img/termek1.jpg', 16, 1, 1),
(2, '3', 'Electrolux EER73BP Ergorapido 2in1', '270002', '37169', 'Gyártó: Electrolux, Modell: EER73BP Ergorapido 2in1 ', 'Electrolux Ergorapido 2az1-ben vezeték nélküli álló porszívó kivehető morzsaporszívóval, LED világítás a szívófejen.\r\nNagyobb teljesítmény, hosszabb üzemidő\r\nA hatékony Lithium TurboPower akkumulátor könnyű, egyszerűen kezelhető és kétszer olyan hosszú működési időt garantál a nikkel-kadmium technológiához képest.\r\n\r\n\r\n2 az 1-ben porszívó\r\nA porszívó 2az1-ben sokoldalúságát az egyszerűen leválasztható kézi egységnek (morzsaporszívónak) köszönheti, amely használatával könnyedén varázsolhatja tisztává az asztalt, konyhapultot, a bútorokat vagy akár az autó utasterét is.\r\n\r\n\r\nEgyszerű irányítás, könnyed mozgatás\r\nA 180°-os mozgástartomány, az ergonomikus formaterv, a kifinomult szívófej és a nagyméretű hátsó kerekek minden felületen zökkenőmentes haladást és fordulást ígérnek.\r\n\r\n\r\nSzívófejen elhelyezett LED fények\r\nAz Ergorapido szívófején lévő DustSpotter™ LED-fények tovább fokozzák a takarítás hatékonyságát.\r\n\r\n\r\nTermék adatlapja\r\n\r\nPor tárolása	Porzsák nélküli\r\nPorszívó típus	Álló porszívó\r\nEnergiaforrás	Akkumulátoros\r\nAkkumulátor feszültség	14.4 V\r\nPorkapacitás	0.5 liter\r\nTelítettség kijelzés	\r\nFunkciók: Száraz tisztítás	, nedves tiszítás	\r\nHEPA szűrő	\r\nVízszűrős porszívó	\r\nSzívóerő szabályozás	\r\nKivehető morzsaporszívó\r\nZajszint	79 dB\r\nTömeg	3.2 kg\r\nMéretek (szélesség x magasság x mélység)	26.5 x 114.5 x 14.5 cm', 'img/termek2.jpg', 103, 1, 0),
(3, '4', 'Samsung VCC43U0V3D/XEH', '270003', '18593', 'Gyártó: Samsung, Modell: VCC43U0V3D/XEH', 'Leírás:\r\n\r\nKét kamra, kétszeresen alapos takarítás\r\n\r\nA Samsung egyedülálló kétkamrás rendszere, a Twin Chamber System™ két részre osztja a hagyományos porkamrát, így sokkal könnyebb és hatékonyabb a takarítás, tovább tart a hatása, és meghosszabbodik a szűrő élettartama. A megnövelt szívóerő a porszemcséket a kamra légörvényén keresztül keringeti, amely a centrifugális erő segítségével különválasztja a por - és piszokszemcséket. A nagyobb porszemek a külső kamrába kerülnek, ahol biztonságosan tárolódnak a kiürítésig.\r\n\r\nPoreltávolítás három egyszerű lépésben\r\n\r\nA portartály kiürítése a porszívózás után a takarítás legkevésbé kellemes része lehet. Kivéve a Samsung könnyen üríthető Easy-to-Empty portartályaival! Három egyszerű lépésben végezhetsz a feladattal. Csak nyomd meg a gombot, amivel lekapcsolod a tartályt, majd húzd ki és borítsd ki a tartalmát. Nincs vele vesződés, nem szóródik ki a por, csak egyszerűen könnyebb lett a lakást tisztán tartani.\r\n\r\nEgyszerű és gazdaságos\r\n\r\nA hagyományos porszívók esetében a porzsák telítődésénél újabb és újabb porzsákok vásárlása szükséges. Azonban a Samsung kétkamrás rendszerével (Twin Chamber System™) ellátott porszívókhoz nem kell drága, eldobható porzsákokat vásárolnod.\r\n\r\nLélegezz fel. A szó szoros értelmében\r\n\r\nA Samsung HEPA szűrés biztosítja a porszívóból távozó levegő maximális tisztaságát. A HEPA szűrő kiszűri a mikroszemcséket, mint például a finom port vagy egyéb allergéneket, így a környezet sokkal tisztább és egészségesebb lesz. Sőt, a kifújt levegő minőségét, illetve a HEPA szűrés szűrőképességét az elismert, német SLG intézet vizsgálta be és tanúsította. Emellett bizonyos poratka- és allergénszűrő rendszereink is rendelkeznek tanúsítvánnyal.\r\n\r\nMűszaki adatok:\r\n\r\n- Porgyűjtési kapacitás: 1.3 l\r\n- Készülék méret (Szé x Ma x Mé): 280 x 238 x 395 mm\r\n- Max fogyasztási teljesítmény: 700 W\r\n- Készülék tömeg: 4.2 kg\r\n- Energiahatékonysági osztály: A\r\n- Zajszint: 80 dBA\r\n- Hálózati kábel hossza: 6 m\r\n- Működési távolság: 9.2 m', 'img/termek3.jpg', 52, 1, 0),
(4, '5', 'Gorenje SVC216FR', '270004', '44900', 'Gyártó: Gorenje, Modell: SVC216FR', '\r\nTulajdonságok:\r\nPortartályos porszívó\r\nSzáraz porszívó\r\nVezeték nélküli működés\r\nSzívófejek száma: 2\r\nLevegő áramlás: 12 l/s\r\nPortartály űrtartalma: 0,6 l\r\nKettő az egyben porszívó\r\nHEPA szűrő\r\nAkkumulátor töltő állomás\r\nTöltési idő: 6 óra\r\nAkkumulátor telítettség jelző\r\nLágy motorindítás\r\nAkkumulátor feszültsége: 21,6 V\r\nMéretek (SZx M x M): 26 × 118 × 17 cm\r\nNettó súly: 2,5 kg\r\nCsatlakoztatási teljesítmény: 125 W\r\n', 'img/termek4.jpg', 78, 1, 0),
(5, '6', 'Philips FC9330/09', '270005', '28999', 'Gyártó: Philips, Modell: FC9330/09', 'Erőteljesebb porfelszívás és PowerCyclone 5 technológia\r\n\r\n- A energiahatékonysági osztály\r\n- TriActive szívófej\r\n- Allergénszűrő\r\n\r\n„A” energiahatékonysági osztály\r\n\r\nA Philips PowerPro Compact azért készült, hogy maximális teljesítmény érjen el „A” energiahatékonysági osztályban.\r\n\r\nA PowerCyclone 5 technológia különválasztja a port és a levegőt\r\n\r\nAz egyedülálló PowerCyclone 5 technológia felgyorsítja a levegőt körkörös légkamrájában, hogy elválassza azt a portól. Egy erőteljes keverő mozgás maximalizálja a légáramlás teljesítményét a káprázatos tisztítási teljesítmény eléréséért.\r\n\r\nTriActive szívófej a 3-féle tisztítóeljárásért\r\n\r\nAz egyedülálló TriActive szívófej gyengéden nyitja meg a szőnyeg szálait, hogy mélyebben tisztíthasson. Az elől és az oldalt található légcsatornák beengedik a morzsákat, és elég közel tisztíthat velük a bútorok és falak mentén.\r\n\r\nEgy kézzel is kiüríthető a por könnyű kezelhetősége érdekében\r\n\r\nA portároló egy kézzel csatlakoztatható, és különleges formájának és sima felszínének köszönhetően irányítja a port ürítés közben.\r\n\r\nPuha kefe a fogantyúba beépítve, mely mindig készen áll a használatra\r\n\r\nEgy porolókefe- tartozék található közvetlenül a fogantyúba építve, ami mindig készen áll a bútorokhoz, lapos felületekhez és kárpitokhoz.\r\n\r\nAz ActiveLock csatlakozásokkal könnyen alkalmazkodik minden feladathoz\r\n\r\nAz ActiveLock csatlakozások azt jelentik, hogy a csövek és a tartozékok egyszerűen a helyükre ugranak a teleszkópos csövön a tisztítás közben.\r\n\r\nNagyméretű gumi kerekek a jobb mozgathatóság érdekében\r\n\r\nA nagy gumikerekek sima mozgásirányítást biztosítanak takarítás közben.\r\n\r\nAz allergén szűrő felfogja a finom por 99,9%-át\r\n\r\nA Clean-air szűrőrendszer felfogja a finom por 99,9%-át – ideértve a polleneket, szőr és poratkákat – az allergiásoknak, és azoknak, akik magasabb szintre emelnék a higiéniát.\r\n', 'img/termek5.jpg', 108, 1, 0),
(6, '7', 'Hyundai VC020', '270006', '17989', 'Gyártó: Hyundai, Modell: VC020', 'Tulajdonságok:\r\n\r\nTermék típusa: Porzsák nélküli porszívó\r\nÁramellátás: hálózati\r\nMaximális teljesítmény (W): 600\r\nPorzsák/portartály kapacitás (l): 0,50\r\nZajszint (dB): 80.0\r\nHatósugár: 8m\r\nKábel hosszúság: 7m\r\nEgyéb funkciók: Lehajtható fogantyú a könnyebb tárolásért\r\nHEPA szűrő: Igen\r\nNettó súly (Kg): 2.7\r\nSzélesség (mm): 260\r\nMagasság (mm): 1140\r\nMélység (mm): 155', 'img/termek6.jpg', 182, 1, 210),
(7, '1', 'Kärcher SE 4001', '270000', '74899', 'Gyártó: Kärcher, Modell: SE 4001', 'A Kärcher SE 4001 szőnyeg- és kárpittisztító ideális eszköz a padló és a padlószőnyeg tisztítására.\r\n\r\nA sokoladlú, 1200 Watt-os porszívó tartálya 18 literes, és mind a port, mind a folyadékot könnyedén felszippantja. A Kärcher SE 4001 szőnyeg- és kárpittisztító kábele 7,5 méteres, 6 db kereke pedig 360°-ban forgatható.\r\n\r\nA SE 4001 porszívót egy kombinált száraz- nedves szívófejjel, egy hosszú szívófejjel, egy szivacs szűrővel, egy papír porzsákkal és egy flakon tisztítófolyadékkal szállítjuk.\r\n\r\nTulajdonságok:\r\n\r\nTípus: Víz- és porszívó\r\nMotorteljesítmény (Watt): 1400\r\nMotornyomás (Kpa): 19\r\nFelszívott légmennyiség (dm3/sec): 65\r\nPorzsák vagy portartály kapacitás (liter): 18\r\nSzűrőtípus: szűrő szivacs\r\nTeleszkópos cső: Igen\r\nKábel méret (méter): 7,5\r\nKiegészítő tartozékok: RM 519 (100 ml) tisztítófolyadék\r\nMéretek (cm): 38,5 x 38,5 x 50 cm\r\nSúly (Kg): 8 kg\r\nNyomtatott használati útmutató: német\r\n', 'img/termek7.jpg', 14, 1, 100);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vevok`
--

CREATE TABLE `vevok` (
  `id` int(4) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `szcim` varchar(255) NOT NULL,
  `felh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `vevok`
--

INSERT INTO `vevok` (`id`, `nev`, `email`, `cim`, `telefon`, `pw`, `szcim`, `felh`) VALUES
(6, 'Poczik László', 'laszlo.poczik@yahoo.com', '1094 Budapest, Tűzoltó utca 59.', '06201234567', '', '1094 Budapest, Tűzoltó utca 59.', 'Laci'),
(7, 'Poczik László', 'laszlo.poczik@yahoo.com', '1094 Budapest, Tűzoltó utca 59.', '06201234567', '', '1094 Budapest, Tűzoltó utca 59.', 'Laci'),
(8, 'Poczik László', 'laszlo.poczik@yahoo.com', '1094 Budapest, Tűzoltó utca 59.', '06201234567', '', '1094 Budapest, Tűzoltó utca 59.', 'Laci');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adatok`
--
ALTER TABLE `adatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rend_term`
--
ALTER TABLE `rend_term`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tajekoztato`
--
ALTER TABLE `tajekoztato`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `vevok`
--
ALTER TABLE `vevok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adatok`
--
ALTER TABLE `adatok`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `rend_term`
--
ALTER TABLE `rend_term`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `tajekoztato`
--
ALTER TABLE `tajekoztato`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `vevok`
--
ALTER TABLE `vevok`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
