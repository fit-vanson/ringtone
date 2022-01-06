-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 05, 2022 lúc 08:55 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ring_all`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `api_keys`
--

INSERT INTO `api_keys` (`id`, `name`, `key`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'app1', 'tqstpILqIZ7m3Jg4dTipN5cQH0kLg8OELGNHEoAEF3pbdTX8ZPjosWsLJHqxVYp1', 1, '2022-01-05 04:06:45', '2022-01-05 04:09:08', '2022-01-05 04:09:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_key_access_events`
--

CREATE TABLE `api_key_access_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `api_key_id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_key_admin_events`
--

CREATE TABLE `api_key_admin_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `api_key_id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `event` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `api_key_admin_events`
--

INSERT INTO `api_key_admin_events` (`id`, `api_key_id`, `ip_address`, `event`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', 'created', '2022-01-05 04:06:45', '2022-01-05 04:06:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `block_ips_has_site`
--

CREATE TABLE `block_ips_has_site` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sites_id` int(11) NOT NULL,
  `blockIps_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `block_i_p_s`
--

CREATE TABLE `block_i_p_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `block_i_p_s`
--

INSERT INTO `block_i_p_s` (`id`, `ip_address`, `created_at`, `updated_at`) VALUES
(3, '3/2', '2022-01-05 04:54:31', '2022-01-05 04:54:31'),
(4, 'Tp.Vinh', '2022-01-05 04:58:40', '2022-01-05 04:58:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `turn_to_fake_cate` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `slug`, `view_count`, `turn_to_fake_cate`, `order`, `created_at`, `updated_at`) VALUES
(1, 'defaultCategory', 'January2022/defaultcategory_1641354661.jpg', 'defaultcategory', 1556, 0, 1, '2022-01-05 03:51:01', '2022-01-05 03:51:01'),
(2, 'category12', 'January2022/category12_1641355489.JPG', 'category12', 11862, 0, 1, '2022-01-05 03:51:09', '2022-01-05 04:04:50'),
(3, 'Bugatti', 'January2022/bugatti_1641357410.jpg', 'bugatti', 1673, 0, 1, '2022-01-05 04:36:50', '2022-01-05 04:36:50'),
(4, 'hj', 'January2022/hj_1641357435.jpg', 'hj', 1708, 0, 1, '2022-01-05 04:37:15', '2022-01-05 04:37:15'),
(5, 'Phace_defaultCategory', 'January2022/phace-defaultcategory_1641357460.jpg', 'phace-defaultcategory', 1817, 0, 1, '2022-01-05 04:37:41', '2022-01-05 04:37:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_has_site`
--

CREATE TABLE `categories_has_site` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_has_site`
--

INSERT INTO `categories_has_site` (`id`, `category_id`, `site_id`, `image`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL, NULL),
(3, 3, 1, 'January2022/1_3_1641358169.jpg', NULL, '2022-01-05 04:49:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_has_ringtones`
--

CREATE TABLE `category_has_ringtones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ringtone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_has_ringtones`
--

INSERT INTO `category_has_ringtones` (`id`, `category_id`, `ringtone_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feature_images`
--

CREATE TABLE `feature_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feature_images`
--

INSERT INTO `feature_images` (`id`, `image`, `site_id`, `created_at`, `updated_at`) VALUES
(3, 'January2022/1_audi-12-1640165319.jpg', 1, '2022-01-05 05:09:20', '2022-01-05 05:09:20'),
(4, 'January2022/1_audi-11-1640165319.jpg', 1, '2022-01-05 05:09:21', '2022-01-05 05:09:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_ips`
--

CREATE TABLE `list_ips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `load_features`
--

CREATE TABLE `load_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `load_view_by` tinyint(1) NOT NULL DEFAULT 1,
  `key` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'load_home_features',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `load_features`
--

INSERT INTO `load_features` (`id`, `load_view_by`, `key`, `created_at`, `updated_at`) VALUES
(1, 1, 'load_home_features', NULL, NULL),
(2, 1, 'load_wallpapers', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_resets_table', 1),
(36, '2016_12_28_111110_create_api_keys_table', 1),
(37, '2016_12_28_111111_create_api_key_access_events_table', 1),
(38, '2016_12_28_111112_create_api_key_admin_events_table', 1),
(39, '2019_08_19_000000_create_failed_jobs_table', 1),
(40, '2021_11_08_081758_create_permission_tables', 1),
(41, '2021_12_22_105810_create_site_manages_table', 1),
(42, '2021_12_22_113444_create_category_manages_table', 1),
(43, '2021_12_23_093103_create_tbl_category_has_site', 1),
(44, '2021_12_27_112650_create_block_i_p_s_table', 1),
(45, '2021_12_27_120510_create_tbl_site_has_block_ip', 1),
(46, '2021_12_29_161527_create_visitors_table', 1),
(47, '2021_12_29_162215_create_list_ips_table', 1),
(48, '2021_12_30_170611_create_feature_images_table', 1),
(49, '2022_01_05_102349_create_ringtones_table', 1),
(50, '2022_01_05_102410_create_category_has_ringtones_table', 1),
(51, '2022_01_05_102632_create_visitor_favorites_table', 1),
(52, '2022_01_05_142319_create_load_features_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ringtones`
--

CREATE TABLE `ringtones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail_image` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `feature` tinyint(1) NOT NULL DEFAULT 0,
  `set_as_premium` tinyint(1) NOT NULL DEFAULT 0,
  `downloads` int(11) NOT NULL DEFAULT 0,
  `like_count` int(11) NOT NULL DEFAULT 0,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `ringtone_file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ringtones`
--

INSERT INTO `ringtones` (`id`, `name`, `thumbnail_image`, `feature`, `set_as_premium`, `downloads`, `like_count`, `view_count`, `ringtone_file`, `created_at`, `updated_at`) VALUES
(1, 'Sau-Nay-Neu-Co-Yeu-Ai-Tang-Phuc-Ngo-Kien-Huy', NULL, 0, 1, 0, 783, 600, 'January2022/Sau-Nay-Neu-Co-Yeu-Ai-Tang-Phuc-Ngo-Kien-Huy_1641361796.mp3', '2022-01-05 05:49:56', '2022-01-05 06:49:39'),
(2, 'Thay-Long-DIMZ-TVk-NH4T', NULL, 1, 0, 0, 976, 768, 'January2022/Thay-Long-DIMZ-TVk-NH4T_1641361797.mp3', '2022-01-05 05:49:57', '2022-01-05 06:48:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-01-05 03:36:18', '2022-01-05 03:36:18'),
(2, 'user', 'web', '2022-01-05 03:36:18', '2022-01-05 03:36:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sites`
--

CREATE TABLE `sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `site_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `web_site` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ad_switch` tinyint(1) NOT NULL DEFAULT 0,
  `load_wallpapers` tinyint(4) NOT NULL DEFAULT 1,
  `load_home_features` tinyint(4) NOT NULL DEFAULT 1,
  `header_title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `body_title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body_content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `policy` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sites`
--

INSERT INTO `sites` (`id`, `header_image`, `site_name`, `web_site`, `ad_switch`, `load_wallpapers`, `load_home_features`, `header_title`, `header_content`, `body_title`, `body_content`, `footer_title`, `footer_content`, `policy`, `created_at`, `updated_at`) VALUES
(1, 'January2022/kpop-ringtone_1641359034.png', 'Kpop Ringtone', 'kpop.ringtone4u.xyz', 1, 1, 1, 'Header Title', 'Header Title', 'Header Title', 'Header Title', 'Header Title', 'Header Title', '<p>f</p>', '2022-01-05 04:24:59', '2022-01-05 05:10:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$cfSMdI2fj1tusrZpzYy2SuE0Zr7HfX5XaZRYHW1SayePjbV2qfXwC', NULL, '2022-01-05 03:36:19', '2022-01-05 03:36:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visitor_favorites`
--

CREATE TABLE `visitor_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ringtone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_keys_name_index` (`name`),
  ADD KEY `api_keys_key_index` (`key`);

--
-- Chỉ mục cho bảng `api_key_access_events`
--
ALTER TABLE `api_key_access_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_key_access_events_ip_address_index` (`ip_address`),
  ADD KEY `api_key_access_events_api_key_id_foreign` (`api_key_id`);

--
-- Chỉ mục cho bảng `api_key_admin_events`
--
ALTER TABLE `api_key_admin_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_key_admin_events_ip_address_index` (`ip_address`),
  ADD KEY `api_key_admin_events_event_index` (`event`),
  ADD KEY `api_key_admin_events_api_key_id_foreign` (`api_key_id`);

--
-- Chỉ mục cho bảng `block_ips_has_site`
--
ALTER TABLE `block_ips_has_site`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `block_i_p_s`
--
ALTER TABLE `block_i_p_s`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `categories_has_site`
--
ALTER TABLE `categories_has_site`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_has_ringtones`
--
ALTER TABLE `category_has_ringtones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_has_ringtones_category_id_foreign` (`category_id`),
  ADD KEY `category_has_ringtones_ringtone_id_foreign` (`ringtone_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `feature_images`
--
ALTER TABLE `feature_images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_ips`
--
ALTER TABLE `list_ips`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `load_features`
--
ALTER TABLE `load_features`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `ringtones`
--
ALTER TABLE `ringtones`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `visitor_favorites`
--
ALTER TABLE `visitor_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_favorites_visitor_id_foreign` (`visitor_id`),
  ADD KEY `visitor_favorites_ringtone_id_foreign` (`ringtone_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `api_key_access_events`
--
ALTER TABLE `api_key_access_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `api_key_admin_events`
--
ALTER TABLE `api_key_admin_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `block_ips_has_site`
--
ALTER TABLE `block_ips_has_site`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `block_i_p_s`
--
ALTER TABLE `block_i_p_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories_has_site`
--
ALTER TABLE `categories_has_site`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `category_has_ringtones`
--
ALTER TABLE `category_has_ringtones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `feature_images`
--
ALTER TABLE `feature_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `list_ips`
--
ALTER TABLE `list_ips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `load_features`
--
ALTER TABLE `load_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ringtones`
--
ALTER TABLE `ringtones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sites`
--
ALTER TABLE `sites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `visitor_favorites`
--
ALTER TABLE `visitor_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `api_key_access_events`
--
ALTER TABLE `api_key_access_events`
  ADD CONSTRAINT `api_key_access_events_api_key_id_foreign` FOREIGN KEY (`api_key_id`) REFERENCES `api_keys` (`id`);

--
-- Các ràng buộc cho bảng `api_key_admin_events`
--
ALTER TABLE `api_key_admin_events`
  ADD CONSTRAINT `api_key_admin_events_api_key_id_foreign` FOREIGN KEY (`api_key_id`) REFERENCES `api_keys` (`id`);

--
-- Các ràng buộc cho bảng `category_has_ringtones`
--
ALTER TABLE `category_has_ringtones`
  ADD CONSTRAINT `category_has_ringtones_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_has_ringtones_ringtone_id_foreign` FOREIGN KEY (`ringtone_id`) REFERENCES `ringtones` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `visitor_favorites`
--
ALTER TABLE `visitor_favorites`
  ADD CONSTRAINT `visitor_favorites_ringtone_id_foreign` FOREIGN KEY (`ringtone_id`) REFERENCES `ringtones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visitor_favorites_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
