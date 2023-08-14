-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 14 2023 г., 11:25
-- Версия сервера: 5.6.51
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `medals`
--

-- --------------------------------------------------------

--
-- Структура таблицы `athletes`
--

CREATE TABLE `athletes` (
  `IDathlete` int(11) NOT NULL,
  `FIO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `athletes`
--

INSERT INTO `athletes` (`IDathlete`, `FIO`) VALUES
(1, 'Иванов Иван Иванович'),
(2, 'Антоненко Мария Ивановна'),
(3, 'Петров Николай Васильевич'),
(5, 'Антоненко Екатерина Ивановна'),
(6, 'Кличко Василий Дмитриевич'),
(7, 'Галиц Виктор Иосифович'),
(8, 'Гойдман Вано Иосифович'),
(9, 'Федоренко Ирина Олеговна'),
(10, 'Кочка Алёна Николаевна'),
(11, 'Ковальчук Мария Михайловна'),
(12, 'Анющко Виктория Юрьевна'),
(13, 'Чудаева Арина Максимовна'),
(14, 'Ураев Василий Григорьевич');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `IDcolor` int(11) NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`IDcolor`, `color`) VALUES
(1, 'золото'),
(2, 'серебро'),
(3, 'бронза');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `IDcountry` int(11) NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`IDcountry`, `country`) VALUES
(1, 'Россия'),
(2, 'Уругвай'),
(3, 'США'),
(5, 'Италия'),
(7, 'Германия'),
(8, 'Польша'),
(9, 'Индия'),
(10, 'ОАЭ'),
(11, 'Китай'),
(12, 'Австралия'),
(13, 'Греция'),
(21, 'Болгария'),
(31, 'Дания'),
(41, 'Египет'),
(42, 'Франция');

-- --------------------------------------------------------

--
-- Структура таблицы `medals`
--

CREATE TABLE `medals` (
  `IDmedal` int(11) NOT NULL,
  `IDcolor` int(11) NOT NULL,
  `IDsport` int(11) NOT NULL,
  `IDathlete` int(11) NOT NULL,
  `IDcountry` int(11) NOT NULL,
  `medals` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `medals`
--

INSERT INTO `medals` (`IDmedal`, `IDcolor`, `IDsport`, `IDathlete`, `IDcountry`, `medals`) VALUES
(1, 2, 1, 1, 1, 1),
(4, 2, 2, 2, 5, 3),
(5, 3, 4, 3, 2, 4),
(6, 1, 1, 6, 31, 5),
(7, 2, 2, 5, 5, 3),
(8, 3, 1, 5, 3, 6),
(15, 2, 4, 1, 2, 7),
(16, 1, 5, 7, 8, 8),
(17, 2, 5, 8, 21, 9),
(21, 1, 6, 10, 1, 10),
(22, 1, 6, 9, 1, 10),
(23, 1, 6, 13, 1, 10),
(24, 1, 6, 11, 1, 10),
(25, 1, 6, 12, 1, 10),
(63, 3, 5, 12, 21, 15),
(64, 2, 7, 13, 8, 16),
(65, 2, 7, 14, 8, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `sports`
--

CREATE TABLE `sports` (
  `IDsport` int(11) NOT NULL,
  `sport` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sports`
--

INSERT INTO `sports` (`IDsport`, `sport`) VALUES
(1, 'Бег'),
(2, 'Бег вдвоём'),
(4, 'Челночный бег'),
(5, 'Прыжки в длину'),
(6, 'Эстафета'),
(7, 'Фигурное катание'),
(8, 'Кёрлинг'),
(9, 'Футбол');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `athletes`
--
ALTER TABLE `athletes`
  ADD PRIMARY KEY (`IDathlete`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`IDcolor`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`IDcountry`);

--
-- Индексы таблицы `medals`
--
ALTER TABLE `medals`
  ADD PRIMARY KEY (`IDmedal`);

--
-- Индексы таблицы `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`IDsport`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `athletes`
--
ALTER TABLE `athletes`
  MODIFY `IDathlete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `IDcolor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `IDcountry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `medals`
--
ALTER TABLE `medals`
  MODIFY `IDmedal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `sports`
--
ALTER TABLE `sports`
  MODIFY `IDsport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
