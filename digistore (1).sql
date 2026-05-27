-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 27 2026 г., 09:59
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `digistore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Нейросети', 'neiroseti', '122', '🧠', '2026-04-22 08:41:36', '2026-04-22 08:41:36'),
(3, 'VPN', 'vpn', 'Подключитесь к серверу с защищённым подключением и шифрованием трафика', '🤖', '2026-04-22 09:11:52', '2026-04-22 09:11:52');

-- --------------------------------------------------------

--
-- Структура таблицы `digital_keys`
--

CREATE TABLE `digital_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `key_value` varchar(255) NOT NULL,
  `status` enum('available','sold','used') DEFAULT 'available',
  `used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `digital_keys`
--

INSERT INTO `digital_keys` (`id`, `product_id`, `order_item_id`, `key_value`, `status`, `used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'HSF7-CD0A-GU5S', 'sold', NULL, '2026-04-22 08:49:03', '2026-04-22 08:52:37'),
(2, 1, 3, 'UYQW-OWJL-DO6E', 'sold', NULL, '2026-04-22 08:49:03', '2026-04-22 23:08:29'),
(3, 1, 5, 'NZF7-BYDZ-3TTW', 'sold', NULL, '2026-04-22 08:49:03', '2026-04-29 11:29:22'),
(4, 1, NULL, 'UHIP-E7HA-0F5L', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(5, 1, NULL, 'WVTL-8UUI-POLG', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(6, 1, NULL, 'JRUL-8XII-MFRV', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(7, 1, NULL, 'EZJO-PBNC-S1IC', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(8, 1, NULL, 'VV8R-S2V1-0CLP', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(9, 1, NULL, '9ICQ-KFVB-WLY9', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(10, 1, NULL, '8W8D-FKCD-UTMD', 'available', NULL, '2026-04-22 08:49:03', '2026-04-22 08:49:03'),
(11, 2, 4, 'M2GL-ABEP-FQTJ', 'sold', NULL, '2026-04-22 23:09:08', '2026-04-22 23:12:10'),
(12, 2, 6, 'YSZP-QA8H-1O2Q', 'sold', NULL, '2026-04-22 23:09:08', '2026-04-29 19:05:55'),
(13, 2, 7, '0ERQ-0I2S-PFRK', 'sold', NULL, '2026-04-22 23:09:08', '2026-04-29 20:35:57'),
(14, 2, NULL, 'ULJR-CZIQ-WTP7', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08'),
(15, 2, NULL, 'STNI-QDGL-ORIL', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08'),
(16, 2, NULL, 'QK6H-PBHL-42JM', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08'),
(17, 2, NULL, 'XTWY-RIJN-PTFE', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08'),
(18, 2, NULL, 'PQIT-G4MW-TNTU', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08'),
(19, 2, NULL, 'L7VS-8Y65-YW7L', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08'),
(20, 2, NULL, 'SARC-JNLH-GGXX', 'available', NULL, '2026-04-22 23:09:08', '2026-04-22 23:09:08');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','completed','cancelled') DEFAULT 'pending',
  `payment_method` enum('card','paypal','crypto') DEFAULT NULL,
  `promo_code` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `subtotal`, `discount`, `total`, `status`, `payment_method`, `promo_code`, `notes`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'ORD-H3WJZPGN', 1111.00, 0.00, 1111.00, 'paid', NULL, NULL, NULL, '2026-04-22 08:52:37', '2026-04-22 08:52:37', '2026-04-22 08:52:37'),
(2, 1, 'ORD-1U8JXIM5', 100.00, 0.00, 100.00, 'paid', NULL, NULL, NULL, '2026-04-22 09:16:21', '2026-04-22 09:16:21', '2026-04-22 09:16:21'),
(3, 1, 'ORD-2IKYSKBS', 1111.00, 0.00, 1111.00, 'paid', NULL, NULL, NULL, '2026-04-22 23:08:29', '2026-04-22 23:08:29', '2026-04-22 23:08:29'),
(4, 10, 'ORD-ZTNKBGSQ', 200.00, 0.00, 200.00, 'paid', NULL, NULL, NULL, '2026-04-22 23:12:10', '2026-04-22 23:12:10', '2026-04-22 23:12:10'),
(5, 10, 'ORD-L8YFOCQ9', 1111.00, 500.00, 611.00, 'paid', NULL, NULL, NULL, '2026-04-29 11:29:22', '2026-04-29 11:29:22', '2026-04-29 11:29:22'),
(6, 10, 'ORD-NBTZSYXP', 100.00, 100.00, 0.00, 'paid', NULL, NULL, NULL, '2026-04-29 19:05:55', '2026-04-29 19:05:55', '2026-04-29 19:05:55'),
(7, 10, 'ORD-18NBSNRJ', 100.00, 100.00, 0.00, 'paid', NULL, NULL, NULL, '2026-04-29 20:35:57', '2026-04-29 20:35:57', '2026-04-29 20:35:57');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `subscription_period` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `subscription_period`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Подписка ChatGPT PLUS', '1_month', 1111.00, 1, '2026-04-22 08:52:37', '2026-04-22 08:52:37'),
(2, 2, 2, 'SerenaVPN', '1_month', 100.00, 1, '2026-04-22 09:16:21', '2026-04-22 09:16:21'),
(3, 3, 1, 'Подписка ChatGPT PLUS', '1_month', 1111.00, 1, '2026-04-22 23:08:29', '2026-04-22 23:08:29'),
(4, 4, 2, 'SerenaVPN', '1_month', 100.00, 2, '2026-04-22 23:12:10', '2026-04-22 23:12:10'),
(5, 5, 1, 'Подписка ChatGPT PLUS', '1_month', 1111.00, 1, '2026-04-29 11:29:22', '2026-04-29 11:29:22'),
(6, 6, 2, 'SerenaVPN', '1_month', 100.00, 1, '2026-04-29 19:05:55', '2026-04-29 19:05:55'),
(7, 7, 2, 'SerenaVPN', '1_month', 100.00, 1, '2026-04-29 20:35:57', '2026-04-29 20:35:57');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `long_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `subscription_period` varchar(255) NOT NULL,
  `stock` int(11) DEFAULT 999,
  `image` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT 0,
  `reviews_count` int(11) DEFAULT 0,
  `featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `long_description`, `price`, `subscription_period`, `stock`, `image`, `rating`, `reviews_count`, `featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'Подписка ChatGPT PLUS', 'podpiska-chatgpt-plus', 'Подписка ChatGPT PLUS на 1 месяц', 'Подписка ChatGPT PLUS', 1111.00, '1_month', 999, 'products/qIGq793HGbS2yxUrK6RPPMLbKaE2iss6bhV0se9K.png', 4, 1, 1, '2026-04-22 08:42:23', '2026-04-29 11:29:36'),
(2, 3, 'SerenaVPN', 'serenavpn', 'Подписка на 1 месяц', 'Подписка на 1 месяц', 100.00, '1_month', 999, 'products/ZUw6mCysiN0elWs4KvDwUKFaPYayQkeLybRtXoiy.png', 5, 1, 1, '2026-04-22 09:13:31', '2026-04-29 19:06:22');

-- --------------------------------------------------------

--
-- Структура таблицы `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `max_uses` int(11) DEFAULT 1,
  `current_uses` int(11) DEFAULT 0,
  `expires_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `promos`
--

INSERT INTO `promos` (`id`, `code`, `description`, `discount_amount`, `discount_percent`, `max_uses`, `current_uses`, `expires_at`, `active`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME10', 'Добро пожаловать! 10% скидка на первый заказ', NULL, 10, 100, 0, '2026-05-29 18:24:48', 1, '2026-04-29 18:24:48', '2026-04-29 18:24:48'),
(2, 'SUMMER20', 'Летняя акция - 20% скидка на все товары', NULL, 20, 200, 0, '2026-06-28 18:24:48', 1, '2026-04-29 18:24:48', '2026-04-29 18:24:48'),
(3, 'SAVE500', 'Скидка 500 рублей на покупки свыше 5000 рублей', 500.00, NULL, 50, 0, '2026-05-14 18:24:48', 1, '2026-04-29 18:24:48', '2026-04-29 18:24:48'),
(4, 'LUCKY15', '15% скидка для постоянных клиентов', NULL, 15, 150, 0, '2026-06-13 18:24:48', 1, '2026-04-29 18:24:48', '2026-04-29 18:24:48'),
(5, 'FLASH25', 'Флеш-распродажа - 25% скидка (ограниченное время)', NULL, 25, 30, 0, '2026-05-06 18:24:48', 1, '2026-04-29 18:24:48', '2026-04-29 18:24:48');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(2, 1, 10, 4, 'неплохо', '2026-04-29 11:29:36', '2026-04-29 11:29:36'),
(3, 2, 10, 5, 'LDMFEKGBMRMBD;,LVD', '2026-04-29 19:06:22', '2026-04-29 19:06:22');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@digistore.ru', NULL, '$2y$12$YeDB15FqVqXvER9MzolwO.0anbYjkgw4ImR8Odcm1Nn5aIircj0R.', 'admin', 'hOviOOXyC62ZrgItOcOpm7WHmW4mdQ0GvS7HPPsN2tsJawwakagqwWkdyPGO', '2026-04-22 08:21:53', '2026-04-29 11:20:37'),
(2, 'Иван Петров', 'ivan@example.com', NULL, '$2y$12$KI.RBcH3XiEELlh7fiShYu6imRq72daCzETzprQ2x1hurX8qi1qfW', 'user', NULL, '2026-04-22 08:21:53', '2026-04-22 08:21:53'),
(3, 'Мария Сидорова', 'maria@example.com', NULL, '$2y$12$fBMG2fWjHpI5eaiNHTV5JO5uNczkB3UaCHkEISOLdc9trir2Pjf4W', 'user', NULL, '2026-04-22 08:21:53', '2026-04-22 08:21:53'),
(4, 'Петр Федоров', 'petr@example.com', NULL, '$2y$12$Whejiwyffwg9IhDQaRKOducDHMye7pdFllDjxpug3.ZgBqhEDKgP6', 'user', NULL, '2026-04-22 08:21:53', '2026-04-22 08:21:53'),
(5, 'Пользователь 1', 'user1@example.com', NULL, '$2y$12$jakMwSWX8V7UhViUTEGgXefH7l9ATHDzd1tdNtMnoWczpJgo0lZWO', 'user', NULL, '2026-04-22 08:21:53', '2026-04-22 08:21:53'),
(6, 'Пользователь 2', 'user2@example.com', NULL, '$2y$12$U2CJTZrZE81Kv53HC7AzAe65PyRCIjhrjpzCOe6AzCL5hBZp0Y1rS', 'user', NULL, '2026-04-22 08:21:54', '2026-04-22 08:21:54'),
(7, 'Пользователь 3', 'user3@example.com', NULL, '$2y$12$oas2MhVVpF5bAGGM5zV9teaBl5byYEAzyxJk.E9NRIYNuZDNLvi.a', 'user', NULL, '2026-04-22 08:21:54', '2026-04-22 08:21:54'),
(8, 'Пользователь 4', 'user4@example.com', NULL, '$2y$12$lk6UVBK8wS99FiYSQy6d9eh01V.q5Brhwn.EA913f4AsRiLrwu7he', 'user', NULL, '2026-04-22 08:21:54', '2026-04-22 08:21:54'),
(9, 'Пользователь 5', 'user5@example.com', NULL, '$2y$12$.t6FcRkOkf3ZgdLJ34R8m.8Gq.NmNdgdQBpPTcC9iBXNzbb61ObkG', 'user', NULL, '2026-04-22 08:21:54', '2026-04-22 08:21:54'),
(10, 'Данила', 'Fl0yd20065@gmail.com', NULL, '$2y$12$LZWbmlIMbXxDq9Ex9TFg3eMmaIKd7XpNN7z0rs6UV5QqwCBIG9vve', 'admin', 'kA9zgKkLuRtmHMot90JGSSGrr2XBed02HRirk0A8fKg7AD38CeSlwyi6OOkB', '2026-04-22 23:11:20', '2026-04-22 23:11:20');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_activity_logs_user_id` (`user_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `digital_keys`
--
ALTER TABLE `digital_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_digital_keys_product_id` (`product_id`),
  ADD KEY `fk_digital_keys_order_item_id` (`order_item_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_order_id` (`order_id`),
  ADD KEY `fk_order_items_product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category_id` (`category_id`);

--
-- Индексы таблицы `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reviews_product_id` (`product_id`),
  ADD KEY `fk_reviews_user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `digital_keys`
--
ALTER TABLE `digital_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `fk_activity_logs_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `digital_keys`
--
ALTER TABLE `digital_keys`
  ADD CONSTRAINT `fk_digital_keys_order_item_id` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_digital_keys_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
