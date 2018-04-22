-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 22 2018 г., 19:13
-- Версия сервера: 5.7.18-0ubuntu0.16.04.1
-- Версия PHP: 7.0.28-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `small_img` varchar(255) DEFAULT NULL,
  `main_img` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `name`, `small_img`, `main_img`, `category_id`, `slug`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'news 1', '5adc6c95ae5a2.jpg', '5adc6cf541929.jpg', 1, 'news-1', NULL, '', 1524393553, 1524395256),
(2, 'news 2', '5adcad0fc7dd3.jpg', '5adcad182431b.jpg', 1, 'news-2', NULL, '', 1524411675, 1524411714),
(3, 'news 3', '5adcad6d978ef.jpg', '5adcad7635ded.jpg', 1, 'news-3', NULL, '', 1524411769, 1524411769),
(4, 'news 4', '5adcada8b47dd.jpg', '5adcadbc8e013.jpg', 1, 'news-4', NULL, '', 1524411839, 1524411839);

-- --------------------------------------------------------

--
-- Структура таблицы `articles_lang`
--

CREATE TABLE `articles_lang` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `text` text,
  `author` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles_lang`
--

INSERT INTO `articles_lang` (`id`, `item_id`, `lang_id`, `lang`, `title`, `description`, `text`, `author`) VALUES
(1, 1, 1, 'en', '1', '<p>1</p>\r\n', '<p>1</p>\r\n', '1'),
(2, 1, 2, 'ru', 'ru1', '<p>ru1</p>\r\n', '<p>ru1</p>\r\n', 'ru1'),
(3, 1, 3, 'uk', 'ua1', '<p>ua---Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '<p>ua- <strong>Lorem Ipsum</strong> - это текст-&quot;рыба&quot;, часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной &quot;рыбой&quot; для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>\r\n', 'ua1'),
(4, 2, 1, 'en', '2', '<p>2</p>\r\n', '<p>2</p>\r\n', '2'),
(5, 2, 2, 'ru', '2', '<p>2</p>\r\n', '<p>22</p>\r\n', '2'),
(6, 2, 3, 'uk', '2', '', '<p>2</p>\r\n', '22'),
(7, 3, 1, 'en', '3', '<p>33</p>\r\n', '<p>3</p>\r\n', '3'),
(8, 3, 2, 'ru', '3', '<p>3</p>\r\n', '<p>3</p>\r\n', '3'),
(9, 3, 3, 'uk', '3', '<p>3</p>\r\n', '<p>3</p>\r\n', '3'),
(10, 4, 1, 'en', '4', '<p>4</p>\r\n', '<p>4</p>\r\n', '4'),
(11, 4, 2, 'ru', '4', '<p>4</p>\r\n', '<p>4</p>\r\n', '4'),
(12, 4, 3, 'uk', '4', '<p>4</p>\r\n', '<p>4</p>\r\n', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_lang`
--

CREATE TABLE `catalog_lang` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog_lang`
--

INSERT INTO `catalog_lang` (`id`, `item_id`, `lang_id`, `lang`, `title`, `description`) VALUES
(1, 1, 1, 'en', 'test 1', '<p>en--Lorem ipsum dolor sit amet, mei error intellegebat te. Affert equidem pertinacia eum in. Modus audire salutatus ius ea, ut nonumy sapientem referrentur eam, est cu justo persecuti. Noster tritani at mel, nec mucius tamquam neglegentur an.</p>\r\n'),
(2, 1, 2, 'ru', '1', '<p>ru--Lorem ipsum dolor sit amet, mei error intellegebat te. Affert equidem pertinacia eum in. Modus audire salutatus ius ea, ut nonumy sapientem referrentur eam, est cu justo persecuti. Noster tritani at mel, nec mucius tamquam neglegentur an.</p>\r\n'),
(3, 1, 3, 'uk', '11', '<p>ua--Lorem ipsum dolor sit amet, mei error intellegebat te. Affert equidem pertinacia eum in. Modus audire salutatus ius ea, ut nonumy sapientem referrentur eam, est cu justo persecuti. Noster tritani at mel, nec mucius tamquam neglegentur an.</p>\r\n'),
(4, 2, 1, 'en', 'en test2', '<p>test2</p>\r\n'),
(5, 2, 2, 'ru', 'ru test 2', '<p>ru-fhg&#39;hhw&#39;ebj</p>\r\n\r\n<p>[wt wtbn2</p>\r\n\r\n<p>t[btb</p>\r\n'),
(6, 2, 3, 'uk', 'ua test 2', '<p>ua- pf[eergb\\ btrbyebr brerb</p>\r\n'),
(7, 3, 1, 'en', 'en test3', '<p>3 desc</p>\r\n'),
(8, 3, 2, 'ru', 'ru test 3', '<p>ru desc 3</p>\r\n'),
(9, 3, 3, 'uk', 'ua test 3', '<p>ua desc 3</p>\r\n'),
(10, 4, 1, 'en', 'en test4', '<p>sssssssssss</p>\r\n'),
(11, 4, 2, 'ru', 'ru test 4', '<p>eeeeeeeee ru</p>\r\n'),
(12, 4, 3, 'uk', 'ua test 4', '<p>ua desc 4</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_list`
--

CREATE TABLE `catalog_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) DEFAULT NULL,
  `visible` smallint(1) NOT NULL DEFAULT '1',
  `sort` int(11) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog_list`
--

INSERT INTO `catalog_list` (`id`, `name`, `img`, `visible`, `sort`, `slug`) VALUES
(1, 'test 1', '5adca79e41dc8.jpg', 1, NULL, 'test-1'),
(2, 'test 2', '5adca85124cde.jpg', 1, NULL, 'test-2'),
(3, 'test 3', '5adca89b1b383.jpg', 1, NULL, 'test-3'),
(4, 'test 4', '5adca8e3676f9.jpg', 1, NULL, 'test-4');

-- --------------------------------------------------------

--
-- Структура таблицы `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `default` smallint(6) NOT NULL DEFAULT '0',
  `date_update` int(11) DEFAULT NULL,
  `date_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lang`
--

INSERT INTO `lang` (`id`, `url`, `local`, `name`, `img`, `default`, `date_update`, `date_create`) VALUES
(1, 'en', 'en', 'English', NULL, 0, 1524321608, 1524321608),
(2, 'ru', 'ru', 'Русский', NULL, 0, 1524321608, 1524321608),
(3, 'uk', 'uk', 'Українська', NULL, 1, 1524321608, 1524321608);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `translation` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(1, 'en-EN', NULL),
(1, 'ru-RU', NULL),
(1, 'uk-UK', NULL),
(2, 'en-EN', NULL),
(2, 'ru-RU', NULL),
(2, 'uk-UK', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1524320833),
('m130524_201442_init', 1524320837),
('m140609_093837_addI18nTables', 1524322298),
('m180421_143547_lang_table', 1524321608),
('m180421_170147_catalog_tables', 1524340329),
('m180422_095126_articles_tables', 1524391602);

-- --------------------------------------------------------

--
-- Структура таблицы `source_message`
--

CREATE TABLE `source_message` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `source_message`
--

INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
(1, 'category', 'Category :'),
(2, 'article', 'Home');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aaaa', 'SNT8smofW5zMM7rGf_CcG-02G-NslFi1', '$2y$13$/Gi1eF5c4KhhDl67NF.LKOEY4vbHfjI/ei0zVIWXWXcDY3QY5YRcK', NULL, 'admin@admin.ua', 10, 1524321092, 1524321092);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_articles` (`category_id`);

--
-- Индексы таблицы `articles_lang`
--
ALTER TABLE `articles_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_articles_lang` (`item_id`);

--
-- Индексы таблицы `catalog_lang`
--
ALTER TABLE `catalog_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_catalog_lang` (`item_id`);

--
-- Индексы таблицы `catalog_list`
--
ALTER TABLE `catalog_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`,`language`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `source_message`
--
ALTER TABLE `source_message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `articles_lang`
--
ALTER TABLE `articles_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `catalog_lang`
--
ALTER TABLE `catalog_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `catalog_list`
--
ALTER TABLE `catalog_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `source_message`
--
ALTER TABLE `source_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_catalog` FOREIGN KEY (`category_id`) REFERENCES `catalog_list` (`id`);

--
-- Ограничения внешнего ключа таблицы `articles_lang`
--
ALTER TABLE `articles_lang`
  ADD CONSTRAINT `FK_articles_lang` FOREIGN KEY (`item_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `catalog_lang`
--
ALTER TABLE `catalog_lang`
  ADD CONSTRAINT `FK_catalog_lang` FOREIGN KEY (`item_id`) REFERENCES `catalog_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_source_message_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
