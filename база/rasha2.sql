-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 31 2018 г., 15:13
-- Версия сервера: 5.6.23
-- Версия PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rasha2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `content_en`
--

CREATE TABLE `content_en` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `content_en`
--

INSERT INTO `content_en` (`id`, `title`, `text`) VALUES
(1, 'Hello, you are in the closed section of the site', 'these stories was that you should not hang yoke even on the most evil hero, because there can always be a cowardly hare who can outwit the fox and defeat the wolf.');

-- --------------------------------------------------------

--
-- Структура таблицы `content_ru`
--

CREATE TABLE `content_ru` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `content_ru`
--

INSERT INTO `content_ru` (`id`, `title`, `text`) VALUES
(1, 'Здравствуйте вы попали в закрытый раздел сайта', 'Герои народных сказок русских часто представлены в лице животных. Так волк всегда отображал жадного и злого, лиса хитрого и смекалистого, медведь сильного и доброго, а заяц слабого и трусливого человека. Но мораль этих историй заключалась в том, что не стоит вешать ярмо даже на самого злого героя, ведь всегда может встретиться трусливый заяц, который сможет обхитрить лису и победить волка. ');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `password` varchar(2550) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `password`, `login`, `email`, `img`) VALUES
(14, 'e10adc3949ba59abbe56e057f20f883e', 'admin1', '2tanak@mail.ru', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `content_en`
--
ALTER TABLE `content_en`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `content_ru`
--
ALTER TABLE `content_ru`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `content_en`
--
ALTER TABLE `content_en`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `content_ru`
--
ALTER TABLE `content_ru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
