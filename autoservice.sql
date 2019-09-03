-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 18 2019 г., 15:24
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autoservice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars_list`
--

CREATE TABLE `cars_list` (
  `id` int(11) NOT NULL,
  `car` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cars_list`
--

INSERT INTO `cars_list` (`id`, `car`, `description`, `price`, `image`) VALUES
(25, 'Vesta ÑÐµÐ´Ð°Ð½', 'ÐžÑ‚Ð»Ð¸Ñ‡Ð½Ñ‹Ð¹ Ð³Ð¾Ñ€Ð¾Ð´ÑÐºÐ¾Ð¹ Ð°Ð²Ñ‚Ð¾Ð¼Ð¾Ð±Ð¸Ð»ÑŒ', 614900, 'uploads/car1.png'),
(26, 'XRAY Cross', 'Ð¡Ñ‚Ð¸Ð»ÑŒÐ½Ñ‹Ð¹ Ð²Ð½ÐµÐ´Ð¾Ñ€Ð¾Ð¶Ð½Ð¸Ðº', 754900, 'uploads/car2.png'),
(27, 'Largus ÑƒÐ½Ð¸Ð²ÐµÑ€ÑÐ°Ð»', 'ÐŸÑ€Ð¾ÑÑ‚Ð¾Ñ€Ð½Ñ‹Ð¹ Ð¸ Ð²Ð¼ÐµÑÑ‚Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ñ‹Ð¹', 590900, 'uploads/car3.png');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `color` text CHARACTER SET utf8mb4 NOT NULL,
  `paid` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `color`, `paid`) VALUES
(1, 24, 25, 'Ð§Ñ‘Ñ€Ð½Ñ‹Ð¹', 1),
(2, 24, 26, '', NULL),
(4, 25, 25, 'Ð¡ÐµÑ€ÐµÐ±Ñ€ÑÑ‚Ñ‹Ð¹', 1),
(5, 25, 26, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(14, '123dobro@mail.ru', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(20, '123zlodey@mail.ru', 'a320480f534776bddb5cdb54b1e93d210a3c7d199e80a23c1b2178497b184c76'),
(24, '123@123', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(26, 'ivsin@mail.ru', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars_list`
--
ALTER TABLE `cars_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars_list`
--
ALTER TABLE `cars_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
