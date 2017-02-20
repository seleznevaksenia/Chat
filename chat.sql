-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 20 2017 г., 05:00
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `mes_id` int(11) NOT NULL,
  `user_name` char(255) NOT NULL,
  `text` text,
  `mes_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vk_id` int(11) NOT NULL,
  `parent_id` text,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`mes_id`, `user_name`, `text`, `mes_date`, `vk_id`, `parent_id`, `status`) VALUES
(306, 'Ksenia', 'Текст (от лат. textus — «ткань; сплетение, связь, сочетание») — зафиксированная на каком-либо материальном носителе человеческая мысль; в общем плане связная и полная последовательность символов.', '2017-02-20 01:34:57', 137891365, NULL, 1),
(307, 'Ksenia', '    Существует метафорическое представление о тексте, как о лабиринте, в котором блуждают его читатели и исследователи, или спутанном клубке, который подлежит распутыванию. Не существует универсальной теории выхода из лабиринта или распутывания клубков, есть лишь некоторые эвристические принципы, которым бывает полезно следовать. Однако когда вы приступаете к распутыванию клубка, у вас заранее не может быть гарантий, что вы его сумеете распутать до конца; равным образом, не сумев его распутать, вы не имеете права утверждать, что этот клубок является нераспутываемым в принципе. ', '2017-02-20 01:35:20', 137891365, NULL, 0),
(308, 'Ksenia', 'Существуют две основные трактовки понятия «текст»: «имманентная» (расширенная, философски нагруженная) и «репрезентативная» (более частная). Имманентный подход подразумевает отношение к тексту как к автономной реальности, нацеленность на выявление его внутренней структуры.', '2017-02-20 01:35:53', 137891365, '306', 0),
(310, 'Ksenia', 'Нет страшнее зверя в сибирских лесах, чем разъяренный заяц-мутант.  \n  Вы видели, какие у него зубы? О, даже медведь боится этих зубов! А, как известно, \n  медведи больше ничего не боятся.', '2017-02-20 01:56:41', 137891365, NULL, 0),
(311, 'Ksenia', 'Нет страшнее зверя в сибирских лесах, чем разъяренный заяц-мутант.  \n  Вы видели, какие у него зубы? О, даже медведь боится этих зубов! А, как известно, \n  медведи больше ничего не боятся.', '2017-02-20 01:58:06', 137891365, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `vk_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_name`, `vk_id`) VALUES
(1, 'Ksenia', 137891365),
(11, 'Иван', 11056008);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mes_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
