-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 21 2024 г., 14:08
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `boolatova`
--
CREATE DATABASE IF NOT EXISTS `boolatova` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `boolatova`;

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `adress` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id`, `name`, `mail`, `adress`, `time`) VALUES
(3, 'asdasdas', 'Ed@dma.ru', 'asdads asdasdasd asd asddasd asasd assd s', '2023-04-30 23:42:04');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `discription` text NOT NULL,
  `src` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `discription`, `src`, `time`) VALUES
(1, 'asdasdasda', 'asdlkasdla askdmkasdklasdka kadsdasjdalksd kasjdklajsdklsj kasjdlkasjdlak laksldjakljskalda jjosadkdwjojeidlkasdalk aksdaksd', './images/gallery/asdasdasda1682800513.jpg', '2023-04-29 20:35:13'),
(2, 'asasdasa', 'asdasasddasasd', './images/gallery/asasdasa1682800795.jpg', '2023-04-29 20:39:55');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `name`, `mail`, `text`, `time`, `approval`) VALUES
(11, 'Тестер', 'user@user.ru', 'Внезапно, активно развивающиеся страны третьего мира объективно рассмотрены соответствующими инстанциями. Также как существующая теория играет важную роль в формировании позиций, занимаемых участниками в отношении поставленных задач. С другой стороны, сплочённость команды профессионалов предопределяет высокую востребованность поставленных обществом задач.', '2024-05-19 20:08:34', 1),
(14, 'Фундучная груша', 'ad@ad.ru', 'Противоположная точка зрения подразумевает, что независимые государства набирают популярность среди определенных слоев населения, а значит, должны быть рассмотрены исключительно в разрезе маркетинговых и финансовых предпосылок. Современные технологии достигли такого уровня, что новая модель организационной деятельности обеспечивает актуальность кластеризации усилий. Разнообразный и богатый опыт го', '2024-05-19 20:25:14', 1),
(15, 'Футболки', 'Admin@admin.ru', 'В рамках спецификации современных стандартов, элементы политического процесса рассмотрены исключительно в разрезе маркетинговых и финансовых предпосылок. С другой стороны, семантический разбор внешних противодействий позволяет выполнить важные задания по разработке инновационных методов управления процессами. Безусловно, новая модель организационной деятельности требует анализа первоочередных треб', '2024-05-19 20:28:50', 1),
(16, 'Тестер', 'ad@ad.ru', 'В рамках спецификации современных стандартов, элементы политического процесса рассмотрены исключительно в разрезе маркетинговых и финансовых предпосылок. С другой стороны, семантический разбор внешних противодействий позволяет выполнить важные задания по разработке инновационных методов управления процессами. Безусловно, новая модель организационной деятельности требует анализа первоочередных треб', '2024-05-19 20:30:05', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `passwordView` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `passwordView`) VALUES
(1, 'Admin', 'Admin', '$2y$10$.BRG0HWUVkqR8osfe5oV3.DEIk5nPl7zO6URe49ovp6fDdipFTi32', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
