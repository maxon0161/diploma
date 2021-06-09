-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2021 г., 22:57
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `TheGreatCatsby`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Feedbacks`
--

CREATE TABLE IF NOT EXISTS `Feedbacks` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `City` text NOT NULL,
  `Feedback` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `Feedbacks`
--

INSERT INTO `Feedbacks` (`ID`, `Name`, `City`, `Feedback`) VALUES
(1, 'Барсик', 'г. Москва', 'Спасибо TheGreatCatsby за прекрасный ассортимент и отличное качество! Раньше ходил по улице как "маменькин котёнок", но с появлением этого магазина теперь я первый усач на деревне!'),
(2, 'Мурка', 'г. Санкт-Перербург', 'Я просто не могу без шоппинга и теперь не нужно тащить хозяина в магазин, стоит помяукать пару минут у компьютера и всё готово, новая одёжка уже у меня в лапах!!'),
(3, 'Максим', 'Г. Владимир', 'Огромное спасибо команде TheGreatCatsby за новые услуги прямо на дому! Теперб каждый месяц у меня начинается с домашнего пушистого СПА, и не нужно больше трястись в переноске пока едешь через эти страшные места(');

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE IF NOT EXISTS `zakaz` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FIO` varchar(255) NOT NULL,
  `Adress` varchar(255) NOT NULL,
  `Phone` bigint(12) NOT NULL,
  `Lot` varchar(255) NOT NULL,
  `Comment` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `zakaz`
--

INSERT INTO `zakaz` (`ID`, `FIO`, `Adress`, `Phone`, `Lot`, `Comment`) VALUES
(1, 'Степанов Максим Алексеевич', 'Г.Владимир, ул.Василисина., д.15-57', 89995175969, 'Комбинезон "Самурай" 1 шт.', 'мур'),
(2, 'Иванов Иван Иванович', 'г.Москва., ул. Адмирала Лазарева., д.15-556', 9241242356, 'Очки "Градиент" 1шт., Заточка котей', 'Побыстрее, пожалуйста)'),
(3, 'Симоненко Игорь Петрович', 'Московская обл., г. Балашиха., ул. Ленина., д.47/1', 9984461999, 'Домик "Пирамида Котанхамона" 1шт., Комбинезон "Самурай" 1шт.', 'Доставить к 30.07.21, оплата картой');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
