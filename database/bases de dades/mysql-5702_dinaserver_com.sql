-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-5702.dinaserver.com:3306
-- Tiempo de generación: 21-05-2020 a las 11:06:05
-- Versión del servidor: 5.7.30-log
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `multiauth`
--
CREATE DATABASE IF NOT EXISTS `multiauth` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `multiauth`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_rols`
--

CREATE TABLE `assigned_rols` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `assigned_rols`
--

INSERT INTO `assigned_rols` (`id`, `category`, `user_id`, `created_at`) VALUES
(1, 1, 4, '2020-04-22 18:30:27'),
(2, 6, 4, '2020-04-22 18:43:31'),
(4, 10, 4, '2020-04-23 11:07:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `description`) VALUES
(1, 'Equip Directiu'),
(2, 'Qualitat'),
(3, 'Disciplina'),
(4, 'Comunicació'),
(6, 'Informàtica (Manteniment)'),
(7, 'Proveïdor'),
(8, 'Queixes'),
(9, 'Suggeriment'),
(10, 'Comunicacions (SIEI)'),
(11, 'Altres'),
(12, 'Manteniment');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `incidence_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `incidence_id`, `user_id`, `description`, `created_at`) VALUES
(3, 21, 4, 'Comentari de prova desde l\'API -- 2', '2020-05-18 14:17:54'),
(7, 21, 4, 'Comentari de prova desde l\'API -- 3', '2020-05-19 10:17:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidence`
--

CREATE TABLE `incidence` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidence`
--

INSERT INTO `incidence` (`id`, `created_by`, `subject`, `category`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Victor', 'Incidencia de prova 1', 6, 'prova de editar', NULL, 'Resolta', '2020-05-15 10:57:41', NULL),
(22, 'Victor', 'Incidencia de prova 2', 6, 'Incidencia de prova 2', NULL, 'Resolta', '2020-05-15 10:57:48', NULL),
(23, 'Victor', 'Incidencia de prova 3', 10, 'Incidencia de prova 3', NULL, 'Resolta', '2020-05-15 10:57:55', NULL),
(24, 'Victor', 'Incidencia de prova 4', 11, 'Incidencia de prova 4', NULL, 'Pendent', '2020-05-15 10:58:02', NULL),
(25, 'Victor', 'Incidencia de prova 5', 4, 'Incidencia de prova 5', NULL, 'En procés', '2020-05-15 10:58:09', NULL),
(27, 'Victor', 'Prova 200', 10, 'incidencia de prova', NULL, 'Pendent', '2020-05-19 08:05:56', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(101, '2014_10_12_000000_create_users_table', 1),
(102, '2014_10_12_100000_create_password_resets_table', 1),
(103, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(104, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(105, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(106, '2016_06_01_000004_create_oauth_clients_table', 1),
(107, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(108, '2019_08_19_000000_create_failed_jobs_table', 1),
(109, '2019_11_16_094917_create_profiles_table', 1),
(110, '2020_01_30_094301_create_incidence_table', 1),
(111, '2020_02_05_155517_create_rols_table', 1),
(112, '2020_02_14_113127_create_comments_table', 1),
(113, '2020_04_22_095811_create_category_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('007b4d42fa769393b9e36f9352d5820e52bc751cc0193bde36a7ce659dcadda0e69cdbac6b76e402', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:18:56', '2020-05-18 07:18:56', '2021-05-18 09:18:56'),
('00b3353b11a18a307771b03c786e45ac4efcdbae472dc7e0dfb282e5d0b7bb4edf2a6debc273c635', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 07:32:25', '2020-05-14 07:32:25', '2021-05-14 09:32:25'),
('0300f1c89f6e7b9693a7244d66603d2aa22e2f98e7d906335c50b4fb8d772fee5bf9f54d58a23017', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 06:26:25', '2020-05-12 06:26:25', '2021-05-12 08:26:25'),
('030d2337124ea0d302cb1e7a295a642f43225b1d2d03ac40947ec45e47b4f6672d2fed016a2de8cf', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 06:06:14', '2020-05-12 06:06:14', '2021-05-12 08:06:14'),
('035fce3572151ce7d8d3cec67330ea4e4e2d34781d61d6eeaa5aaa97fb4e77087b8786b9d2b66703', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 07:03:08', '2020-05-19 07:03:08', '2021-05-19 09:03:08'),
('04b361a8b912e25a311d19be3c90c7a9e79f6dd86cd6498ad42128f8a13027f8b1ad65778acc43f0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 08:16:24', '2020-05-12 08:16:24', '2021-05-12 10:16:24'),
('04c3d2e0df9d1ac00950f870df56dbd33d3fb4da23ab5c600aa4102e327f7f716cfa4314dd7ed143', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:02:55', '2020-05-11 17:02:55', '2021-05-11 19:02:55'),
('06f2dbe671d89e26441232f9b090b5a8cd0f5dc975cecef315e9362226581d22b3e46760744c29a1', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:36:01', '2020-05-19 14:36:01', '2021-05-19 16:36:01'),
('07d2cb2d1c3f63b8b9b1a69554e941c6cef99b5a7534ae65d867d0dc5ad5888cf62392aba8e7764c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:14:08', '2020-05-18 08:14:08', '2021-05-18 10:14:08'),
('08519c0b88dd8fde032e2267279eeaecf67a4c10f3b7639e78845c5593a3aef9029c912916ac23e7', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:26:57', '2020-05-11 17:26:57', '2021-05-11 19:26:57'),
('0aac457fd210c442f66767af4d74a7018e39311ead2726d53d52b0df00df3a39a7cecc788893a800', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:36:03', '2020-05-13 07:36:03', '2021-05-13 09:36:03'),
('0ad7dcf22c371bf4be2a9f1c393ab72131abb8708e65b0a6a7f25ca5f39986fd3e73f90a147cf5d6', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 15:26:05', '2020-05-19 15:26:05', '2021-05-19 17:26:05'),
('0bd2c6f49e89f395a0047c03bd61743ccbed253bc5396931d21a092f1f5abf5bb56f947f9f186a31', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 11:56:59', '2020-05-19 11:56:59', '2021-05-19 13:56:59'),
('0c841affbf674c566e6c563c76d9e23066503051468d28bdb66fd042db047f37910a50f239acf949', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 15:19:38', '2020-05-11 15:19:38', '2021-05-11 17:19:38'),
('0d664aa19624d6960de0e85936c27b7ad8588064d2dbf2e519ef4e27b9b90f66c23cc9c201c56b82', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 07:46:32', '2020-05-12 07:46:32', '2021-05-12 09:46:32'),
('0eb089145da41db06dd5f6d44aeea0d79462c7e59881a9741de4114af35524509526e36b77b62589', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 14:59:43', '2020-05-18 14:59:43', '2021-05-18 16:59:43'),
('0f5b0f292e4c949ca9760c4d7723d5fff96c6bc5faf21842dedb65d5c646ff7c93016699fb3af5d0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:02:08', '2020-05-20 09:02:08', '2021-05-20 11:02:08'),
('10be5c481c390fab675bc6ad3f04c2580cfe9d6ce5a8f732ce12f4f135e35c58b418798ce820bfa7', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 08:13:03', '2020-05-12 08:13:03', '2021-05-12 10:13:03'),
('120bdffd871ab50feab9c8c7ccfedf7b7a349be445036e8fb974590d7c57d17a7d5621e55c74630e', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 12:12:42', '2020-05-19 12:12:42', '2021-05-19 14:12:42'),
('13b8a5a3cd27e6a236fb1f5a4c036e93768d3b78e3611687c96d8cc1793daa36d9ed60469e2360de', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 10:12:48', '2020-05-18 10:12:48', '2021-05-18 12:12:48'),
('1609aaef96381128fb0542e4be4ff9fd43ad3077ecf78752377f77ed9e5be3141c986f286fbb32fa', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 16:55:10', '2020-05-11 16:55:10', '2021-05-11 18:55:10'),
('18a8450770e022c1643ba749cea2435713ee0a65b8d7b531ca9b408995c025b0618bc7edf1e30587', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:04:32', '2020-05-20 09:04:32', '2021-05-20 11:04:32'),
('1952c312f4728e2fad862f6a84b278ba11e56489eac304acc81b794b9805036e3f4ab09ecf8cdc69', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 08:03:26', '2020-05-14 08:03:26', '2021-05-14 10:03:26'),
('1b88e33b7b12613bece01cde44dc3f3d19ed872fa307b03dbae6c0fd77a5d431bb99e6a8fc19ee16', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 15:55:35', '2020-05-13 15:55:35', '2021-05-13 17:55:35'),
('1bdd385fe99bda83190f1d0c28321632fe9aec0b20117c019f8e96ca6da8c352665cec0a0db4e1e5', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 16:13:29', '2020-05-13 16:13:29', '2021-05-13 18:13:29'),
('1fae926d3f4e0bf5fb52acda18af226fcf73f2c85ecd170b66e7db7935757d9be4c67adc1cfbc8c9', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 11:08:18', '2020-05-12 11:08:18', '2021-05-12 13:08:18'),
('204279b3185cf049e90f61db4b0560cccf80b78e1e0b13f69d3ec041df5c96f1cf1b538f3cdb4960', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 12:50:15', '2020-05-18 12:50:15', '2021-05-18 14:50:15'),
('20bc8c925d2375d27d2b0744ca0cf0cb0f49cac81a23d399eee3eb21648153f20459703abcddd414', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 07:57:29', '2020-05-14 07:57:29', '2021-05-14 09:57:29'),
('20f842d682f718427b037d7e784c48f4daff43f9208f9cae26fb473b8e5bddb66452bc114bdbead8', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 07:07:17', '2020-05-19 07:07:17', '2021-05-19 09:07:17'),
('2138b5627721a13fdb71b51000b1eb60d9021e87ac38a627a158ddfcd60f5d874a08663cb7e20acd', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:12:59', '2020-05-11 17:12:59', '2021-05-11 19:12:59'),
('2172704973ddf10ec2731d861552d2e4f4a6ff0e294160227bb36fdee57e833fdcd52e92a15df29a', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 06:51:51', '2020-05-13 06:51:51', '2021-05-13 08:51:51'),
('2216b2c57ab06db8117f92369d3525afb110b1e15940e9c6e33f3a0c969470d94435496f58b298db', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 08:16:43', '2020-05-19 08:16:43', '2021-05-19 10:16:43'),
('238847eed4f815a6678bf382c00ec059e5c279a4ce1750d00a551f1aeb565c7994e4d2b44cbd4062', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:51:09', '2020-05-19 14:51:09', '2021-05-19 16:51:09'),
('24a0fb24890e053c699f92876bfd70b46cc89b2831154245bf3f868be9b099f416942a99e15e2aa4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:21:45', '2020-05-13 07:21:45', '2021-05-13 09:21:45'),
('2555b3ee396cd643dfe2fb5ba9c99c13b79e7ebef7a688572686d02185692b81f4cb7d79d6888251', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:56:23', '2020-05-18 09:56:23', '2021-05-18 11:56:23'),
('2a714a2a53ceea162c2768a5f53d0a7727b4677de6de451956fd2a2dfeb5b7916ac17926cf1797aa', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 13:37:39', '2020-05-18 13:37:39', '2021-05-18 15:37:39'),
('2d0908a43db792f50586e261dd721dc70baa4b1de4fe4ca625de29596a6481fb0f1458deb3240f5c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 10:21:49', '2020-05-18 10:21:49', '2021-05-18 12:21:49'),
('2d7c2a14285651ac828a5112cde3cc57c4617e8348399d1163fb5f0a5b6a124672d90ad5477877d5', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:30:01', '2020-05-13 07:30:01', '2021-05-13 09:30:01'),
('2daaea1ef4a4b791112fc47fdcb89e180ed88fd8d617516e3b083a52dbecc242676be88e4aed389c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:14:42', '2020-05-20 09:14:42', '2021-05-20 11:14:42'),
('2db3426c164d2c3528ff66d2b554f8ae0ddd03fabc8564352f8f334f1cf20052223e5bc070b186d7', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 15:26:36', '2020-05-11 15:26:36', '2021-05-11 17:26:36'),
('2de638728af3f24857a778638cfad0e0d8a00d2882f861b1a064c7314396fc5b0cda66f4fc515fba', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:41:32', '2020-05-19 14:41:32', '2021-05-19 16:41:32'),
('2debc781625d7a9417f819819dfa9aafb44e494da678ac2553b3225a3112756fa827e45041b189d8', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 16:21:14', '2020-05-11 16:21:14', '2021-05-11 18:21:14'),
('3084a97bf90afc4163ff6b2f73fbbd0402bc8fd2fdd44c99ac60e49bbde0cd94d1948b4b53b4c998', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 16:59:57', '2020-05-11 16:59:57', '2021-05-11 18:59:57'),
('30f2af53750fa11400759ccd657023efba7cefa692074422960c4d029cdb38b17ef96189aa4c79dc', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:07:12', '2020-05-20 09:07:12', '2021-05-20 11:07:12'),
('32570bde81a8f1f3f9ad2bfcdb631970c52a8ad49ed0d29da2f89f3fce3a0d52d90b50e98201a45f', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:08:36', '2020-05-20 09:08:36', '2021-05-20 11:08:36'),
('327287dc272fe203e3a038dbc9b50299c5a7b4668146e349dfd10517daf397cd98a79f785a41ee6b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 14:11:49', '2020-05-18 14:11:49', '2021-05-18 16:11:49'),
('33a8ab01cc7ff916025f331b4f37c8372f87f24a874cf61f9f646bab8409b9a29dd8ac28deb51f84', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:38:32', '2020-05-13 07:38:32', '2021-05-13 09:38:32'),
('3481494afa4de6e1f5b34c33926311774d90fe89a7ed0f02e94bb156ba03c8e47c76b0ea452613c5', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 15:13:24', '2020-05-11 15:13:24', '2021-05-11 17:13:24'),
('35c37797dd36ada8d468e5d0d80ec1a5057b50d8ccb6624fc5edca32908f58ef07a45e3e7d8c76f4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 15:16:28', '2020-05-11 15:16:28', '2021-05-11 17:16:28'),
('36be6a5056aa9c75ea842096c48cf8ae8fb0a75002db76acd2ae252cb908ff7d7cb2769939b1ac02', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:40:05', '2020-05-13 07:40:05', '2021-05-13 09:40:05'),
('39a51ac22d96b89460258e6a21ec2240945148b9523a9f2af742ed250ae16005352a21e21fa0899f', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 06:05:09', '2020-05-19 06:05:09', '2021-05-19 08:05:09'),
('3e16620b4b1fcf7e2e17e67114ca69de96057fc313231b4ffd5f054d3bd55f9911754f9aa7464bd2', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 13:03:59', '2020-05-19 13:03:59', '2021-05-19 15:03:59'),
('40fb85f158df75163ab8ece78723bfb85048b2b2ddf5fbdf8a609aac668a98ba42eda7c0f5c5dc18', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 16:17:18', '2020-05-13 16:17:18', '2021-05-13 18:17:18'),
('425a2ce879b0d29d7aa68ca6fe4441c0213c99d8011b49d4bf0e6ccfec1274dcaa30d7b80f5dc80e', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 12:11:37', '2020-05-18 12:11:37', '2021-05-18 14:11:37'),
('433c0b24ae89d11c963ded5cde76799de3b0da49985203e5153c960e8e25f12c1d19090b74c7f130', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 12:50:59', '2020-05-19 12:50:59', '2021-05-19 14:50:59'),
('436f78916dbffd7f970e58c9290c03de0956e7e0f769e1f812fa4b56b5470b81addbffaa44c3b766', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:03:48', '2020-05-20 09:03:48', '2021-05-20 11:03:48'),
('45610d5bb8e6377d53de1fd04468586d11630c99959e9d333be6e391b5dd79c2ddd8852a54d6fa4d', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 12:56:50', '2020-05-18 12:56:50', '2021-05-18 14:56:50'),
('46b50dbf1b37da8a485dc2cf989357928b4f9da6a9c76543ea6383136d3cffe355d018a1d0614417', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 06:49:45', '2020-05-18 06:49:45', '2021-05-18 08:49:45'),
('470a06bc6e577747fa60f958617f19a4648c9c46778c824e5ea89b30ffa7f466dd47faa92c1172be', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:09:24', '2020-05-20 09:09:24', '2021-05-20 11:09:24'),
('47d23bd50b325b73f5dcb9b0a705d634873b9bd1a0e8c82b23650e05aa0f2d0cce802ec7031d97a3', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:45:20', '2020-05-18 08:45:20', '2021-05-18 10:45:20'),
('493239d1b8634d8336956eea7d5ab755ffddf44f9d32e5f349ea41f3c96f324619706aa46cf5a028', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 06:51:00', '2020-05-18 06:51:00', '2021-05-18 08:51:00'),
('4acbb5040ac1a9b8bf24ead77cfb7279991f6dcc207832b1fa8b619858d278bb9ac956934fb4e9c8', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:16:53', '2020-05-18 08:16:53', '2021-05-18 10:16:53'),
('4b3a9762be95fd5f1bf2c40fa670adbf4e6945d87f1baedcaf08319958cd02d65a24b88cddf2f744', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:59:02', '2020-05-18 09:59:02', '2021-05-18 11:59:02'),
('4d26ec87ac6046abd26a4bf5935cea3ae3c181d058d20c633fd28b16f32296bd095a940342995dbd', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 06:55:37', '2020-05-19 06:55:37', '2021-05-19 08:55:37'),
('4f5c9594f7214843e4e33d1f35d02cf78685770799b70c893a9f20e24a82ee404af892aa80a7167a', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 10:41:01', '2020-05-12 10:41:01', '2021-05-12 12:41:01'),
('501be91f9c9d537c119faca89378df5ce16eb79a5fdb248f389cfff8853ba7bb42ab2473ef66d40f', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 10:49:02', '2020-05-12 10:49:02', '2021-05-12 12:49:02'),
('505190dc2f461845d01cf4045e65b7c6f5b25937e65f8ded0f3ccc7344e801f54dd240c2a8ed609b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:27:57', '2020-05-11 17:27:57', '2021-05-11 19:27:57'),
('52ea5d7a8d1494ebe2000c05b629aa5bcf567f089eefde8732402a28b58f8f74eb497de21d0be622', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 08:20:28', '2020-05-12 08:20:28', '2021-05-12 10:20:28'),
('5669b22e79ede26c5904ea3638645c06dc10e2494658399a352ecbe0747d74fd0516678fd0a1985c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:47:11', '2020-05-19 14:47:11', '2021-05-19 16:47:11'),
('577407dd8d92ba46b050c274652679ce21eb64a91dc21e5f066281987a78822c94b504d687db96a9', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 16:25:57', '2020-05-19 16:25:57', '2021-05-19 18:25:57'),
('58717caf4e0aad9b8f24354b7bee1ba9a47483aeef61ba9c69d51605c6764232b92882e85ba3f1f5', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 10:03:40', '2020-05-18 10:03:40', '2021-05-18 12:03:40'),
('5b85e939bf91152f5c524503347df8da29fc60e312f3a5a77f0e04405eebdfb40cc59f7b4c52a6b4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 06:43:59', '2020-05-13 06:43:59', '2021-05-13 08:43:59'),
('5bbb316df553249f376fdae48cb21e607dd4e111c99c34eedefd5e974bf28566adafb8fd4f09ff38', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:43:35', '2020-05-18 08:43:35', '2021-05-18 10:43:35'),
('5bc9a2a8322bb77252bd3d31605cc9e3d0a732b5fdf0307b77a42f78b18496f9a5999eb4e5aaad82', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 18:40:47', '2020-05-19 18:40:47', '2021-05-19 20:40:47'),
('5eff226780011a11d882b642a3bbb08502d60f440141b523d7fb85cd764bd3ce566d6632b2bb1590', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:35:46', '2020-05-18 09:35:46', '2021-05-18 11:35:46'),
('5f39e076470d076fffdf1ebb40a49641d3caa91d851308bea7bf8c44d5bf81a0c51262c7cc335ad3', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:32:54', '2020-05-19 14:32:54', '2021-05-19 16:32:54'),
('629de1b1f949ce318a0c473c4dba793f0c7e57e2709d52fbb89e754b364f3ab840dfbe36275a201e', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:28:03', '2020-05-18 08:28:03', '2021-05-18 10:28:03'),
('6429ec797d47e840c25ed4c59eeacbc995a19de3c99647724cc7ccfca7ff13405a0d153ffc306515', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:45:28', '2020-05-19 14:45:28', '2021-05-19 16:45:28'),
('64ff510e4f8bec71c835ec3006390d56481da7bc964f2d35c4df374532cb57a1e98ed9192f8af0ab', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:33:51', '2020-05-18 07:33:51', '2021-05-18 09:33:51'),
('66728fb6783e9042e4473bbfdddf9b17b4785b30db7fe3ebc6ddc73774947277266f4c6dc991a230', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 14:05:17', '2020-05-18 14:05:17', '2021-05-18 16:05:17'),
('67011c2befbef691b58185abeb1cdc818d5482a80ec5b7ec4d920630f6ef2a3eff0d8479fbebfdbb', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 10:05:45', '2020-05-18 10:05:45', '2021-05-18 12:05:45'),
('671da9c9792f300209183fc869b1c3791b2ac76349b47ce09a916e3a9896fbc97b8edd0a97c1ba19', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 06:23:20', '2020-05-14 06:23:20', '2021-05-14 08:23:20'),
('680541e080aa85534682c425f75dd1e2605ec32d5a01a73cd929996edfe7e04ffbe789c67300d4d7', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 10:37:03', '2020-05-19 10:37:03', '2021-05-19 12:37:03'),
('6a3cb53232a3c5c22579e850c8551cb739d7b9d2ecb29fc33aed33f00eed2a57023c68778107ce40', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 12:38:06', '2020-05-19 12:38:06', '2021-05-19 14:38:06'),
('6a99579795c6499a125a76ccdd4bb5f9ac7eee87be012f3a37092798e2d96d727de265fc9e91e543', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:42:02', '2020-05-18 08:42:02', '2021-05-18 10:42:02'),
('6b308425cd6e32d56d7a4b052c68b7dc6a06df4219f8e08796b93e01cd8efba1b2079e668b77c70a', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 14:17:04', '2020-05-20 14:17:04', '2021-05-20 16:17:04'),
('6c50d0a88ccbcce8b8c6e5c6a85d1a4f607071ace835a7b97c7162330438e2d193bba42f598cff42', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 07:43:32', '2020-05-12 07:43:32', '2021-05-12 09:43:32'),
('6ceba1253254d073c34b48c053b81939492648b4ca3c414ae4eda7c0b4d19329d79ed742c9a133b9', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:37:30', '2020-05-13 07:37:30', '2021-05-13 09:37:30'),
('6f38d9836524a8c02b2aeec8ceac00fc7120def17f33898d623e40b6157870eb111fd98eeed54fc0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 14:54:18', '2020-05-18 14:54:18', '2021-05-18 16:54:18'),
('72abe396e732b482bb3039c820a001f0cca1acac9389782b37d1f5c1aa77d8b5270d2e5a8dae2233', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 08:17:58', '2020-05-12 08:17:58', '2021-05-12 10:17:58'),
('73e03a90ee3a1918badc0e32aa0177f1f5160e7f3ee717b5fcb2424d82ca759bb09c97880dc1f9da', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:16:50', '2020-05-18 08:16:50', '2021-05-18 10:16:50'),
('74ec85a6d16d668d63cb18b406913adb45330533db69c1d0af0568bda704260a3e2ba471bf44b03c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 06:07:08', '2020-05-14 06:07:08', '2021-05-14 08:07:08'),
('799ea527c2ba86601040623928ee9af69e7cf02638201ad706684d019985d6abcec8056a0d278ccf', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:03:09', '2020-05-20 09:03:09', '2021-05-20 11:03:09'),
('79da292f92b35fa8ab41f56fe22e6bfd98e2e967eb23afad2d6466d23d0bd657ed0a8d88166825fa', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:07:30', '2020-05-11 17:07:30', '2021-05-11 19:07:30'),
('7b04c9b89e33a2ef5e2ba2e1b5544fd0c97789bb12b2b5dbb5d43c785147ba5cf7c9dd4266cd322a', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:12:27', '2020-05-11 17:12:27', '2021-05-11 19:12:27'),
('7f24eb6f6fa82f15f0751b8a9067622cae1022e62ae003f2bc44ea5d7efb777128d672f7483db261', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 07:43:24', '2020-05-19 07:43:24', '2021-05-19 09:43:24'),
('7f41c0ea7ab254fac82ee3a2ec77a4dffef6e3b5c3b7adfa81d58bd7d4d62d0b84af18de1e57120c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:09:04', '2020-05-18 08:09:04', '2021-05-18 10:09:04'),
('7f6d0a90321fa5315f8cbcc661a5f72a6401484277ecbebacbadd29a2e9407565d2978c73a7ba660', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 15:23:14', '2020-05-19 15:23:14', '2021-05-19 17:23:14'),
('7f83152b60b27359ea6cbab180ff5ecf9888ed0bf01c1efc6c70cb7ca9c6514debc19791fe8870e1', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:15:41', '2020-05-18 08:15:41', '2021-05-18 10:15:41'),
('80729b46d6327a71b53ddcfa4e050c4e898a443b0055dfd8289ed9c4f607e9cc3330142a8f989ce4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 10:19:33', '2020-05-18 10:19:33', '2021-05-18 12:19:33'),
('80a2453bf23faf0259676264ea75e6d1faafb10370127f02470586af5991de2fe966ad5ae69943fb', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 15:21:41', '2020-05-11 15:21:41', '2021-05-11 17:21:41'),
('874807d9c989c34b0c5b90ed43580788782ff72a2bc8f58e7e681314f4537341a6ab6dd4ac37af70', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:55:19', '2020-05-19 14:55:19', '2021-05-19 16:55:19'),
('8c0ce60bf1e60921c476cb023fb57065a9a2d8945e1df57c69cabda4aeee061e7f43cf48d84e5e19', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 08:18:00', '2020-05-14 08:18:00', '2021-05-14 10:18:00'),
('8e301f9665539857ed9b556d0e4122cb3f63b86186c75251deddd1f411935fda673c7299b4f04104', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:46:20', '2020-05-18 07:46:20', '2021-05-18 09:46:20'),
('8f16ed5cdefcad979396eabc3633fc18676bcd0aaf91e7dcbf37ac0d98b19676c8f8cddfcce807c1', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 15:22:32', '2020-05-20 15:22:32', '2021-05-20 17:22:32'),
('907503d2c5796e6384456bb6fdf5645a51f79fcd690872193102142b7d29d71f5f2b568b9396f292', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 06:41:42', '2020-05-19 06:41:42', '2021-05-19 08:41:42'),
('9083688cfcf78cc9bc087cea092ca133a6cf09700165c887e0f0a514c64f3d7197cddc912c237d3b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 08:30:24', '2020-05-12 08:30:24', '2021-05-12 10:30:24'),
('942755503a436b809e9f933420567b0099e4f4e20c86425fc9a92ebf746738392ae12cc2c89d7269', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:28:01', '2020-05-13 07:28:01', '2021-05-13 09:28:01'),
('94f325b7430e9b9ae456e33a92ec38dcf961180fef8c7fa4ab4b4cb7cc1cd95922045bf879edb25b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 16:09:48', '2020-05-13 16:09:48', '2021-05-13 18:09:48'),
('96687a8c2000000d74d214659ad2ae692be9d13bc5c00680a8de38136f0f4db489afbd87c9f7f17f', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:34:08', '2020-05-18 08:34:08', '2021-05-18 10:34:08'),
('990fdd61016cc953099dc10e3e6c297043291da99f68e11f9f7e057b3930a02b5184d000f48a6665', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:34:59', '2020-05-18 07:34:59', '2021-05-18 09:34:59'),
('99b9f51db976e03dc472d7c26d8f3be0f876454bf9dc9a9f010bc715267d3d1242046aa3921697d4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:51:02', '2020-05-18 08:51:02', '2021-05-18 10:51:02'),
('9a35635b430fe8a53dbdd4c43895d2343012f0de09139a2e1eb5b08c90aa30c0edbac9dddcce0169', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 08:22:25', '2020-05-12 08:22:25', '2021-05-12 10:22:25'),
('9c27a84ff199c8bfe30117b9eb892fd2f121a9b702f1c67f6a71c8f76eaa80dc3b3b58ec1e1997e0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:16:15', '2020-05-11 17:16:15', '2021-05-11 19:16:15'),
('9c8e09249e5a98234f16031b15670ac84cf86fbd591302966be9071a8213623aa96fe1f82efe14f2', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 16:29:02', '2020-05-19 16:29:02', '2021-05-19 18:29:02'),
('9d16d0dc86be8eced5cfc0ce27c7d6a571dda82320c43a00037f034f81d93fc3946eff43faf4e88d', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 07:18:22', '2020-05-20 07:18:22', '2021-05-20 09:18:22'),
('9dc1b4b600538878439569cb047f7ceeb7f223d7bc8fce34df5c3d1b74df7c1a02357b76d00b512b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 13:32:03', '2020-05-20 13:32:03', '2021-05-20 15:32:03'),
('a7bede06c2169bc84961418f38b932b117f9a3448c840f22be94d41eb586f2e7fd2a6d6ffb5ddd72', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:10:25', '2020-05-18 09:10:25', '2021-05-18 11:10:25'),
('a8e4b6a921f7b3a9741da75d15a2b7e561cf092b0b82f974f91d7210a4d19db07de7c49f6c9e2ed8', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 10:10:50', '2020-05-18 10:10:50', '2021-05-18 12:10:50'),
('a9b99d121d81847ccfbeb239d89ff958c99058aec1789eb8e1680c23756fa17439bc8ed9e6d06145', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 14:01:18', '2020-05-18 14:01:18', '2021-05-18 16:01:18'),
('b1da6cdd21d7837154475836e9e1649185b376aa20a97be1dabe8c9412a3adda5a0456eae8c52569', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 08:20:38', '2020-05-14 08:20:38', '2021-05-14 10:20:38'),
('b357a4469075dfc27804405c36c0dcac7683fb81e8a0b3dac17d22ad6224d42133a14693d517a3be', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 15:14:24', '2020-05-19 15:14:24', '2021-05-19 17:14:24'),
('b44c3e74a9f9a9ff01d697ab200967c05bb48728a2f84ea709a010ca1cbbc43f30b72a33e950b59c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 19:20:30', '2020-05-13 19:20:30', '2021-05-13 21:20:30'),
('b5f55fb65cc38a19341e99e8b4752c85960804e48563c2a7d1c6be4a4ad7d7b020280c0f43ed10cd', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 06:56:55', '2020-05-19 06:56:55', '2021-05-19 08:56:55'),
('b61f98b5f32b0163e20a2e4765b5fc6e262dd18d69ee42b5d253ae41678e6be01cc27adfc5e50ebd', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 07:50:54', '2020-05-19 07:50:54', '2021-05-19 09:50:54'),
('b73b6939fdf8d93ec8e04370aba07798feab172acbd00665955525e94227e61897b543aced3ac1c1', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 08:00:36', '2020-05-14 08:00:36', '2021-05-14 10:00:36'),
('b820395a8e730f97be3a64db507ff0163bd8a538c59c4cae80f7798f0da271200b68d504927b8596', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 12:30:40', '2020-05-18 12:30:40', '2021-05-18 14:30:40'),
('b8b97abd556c7746a7b01b1cf23ccf67055cbbf5275c9078dab4e1f6f0696ecd72966f64a305a6a2', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:23:49', '2020-05-11 17:23:49', '2021-05-11 19:23:49'),
('c06510aa2e487f6867ae217f40a2609d2b919727a68b96160a934b9822109e497f05c05bd8bb574d', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 15:23:16', '2020-05-19 15:23:16', '2021-05-19 17:23:16'),
('c0c9e572ebf825fa82a5f3d0aa497122edd6e7382455285d668c74147297396ba0b7c154ddd77b8c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:11:55', '2020-05-20 09:11:55', '2021-05-20 11:11:55'),
('c509fd78cfe491ede008a0c0ff42c2cb85c2cc21a71546f719a3384c7f660596c599b75638242eac', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 13:09:34', '2020-05-19 13:09:34', '2021-05-19 15:09:34'),
('c6db8ea0bad767cbf65e1dafc220349b74503a0d7fca03574850a35f317ef42f8bc368d6371cd8f4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:38:49', '2020-05-18 07:38:49', '2021-05-18 09:38:49'),
('c78c98cf061503241c1da4a224afb761cc09a22c64c371ca0bd45b241c75b6894c35aebf5b12ad8c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 13:34:19', '2020-05-18 13:34:19', '2021-05-18 15:34:19'),
('c7fcdc8783297bab2a1b95b152812b5e603a135c04157456f7fef0f91566c9ccc975aa03d8c8ae2b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 07:57:28', '2020-05-14 07:57:28', '2021-05-14 09:57:28'),
('ca9ed149a050d12fb048e008cf01e615871103d2d431d5481bb9c9dd84aaaa642c1405f2026b54a2', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 14:07:51', '2020-05-18 14:07:51', '2021-05-18 16:07:51'),
('cbe0737aca7ec099ea05a11fd62e7580434ed322374fa4a371baf6c17427896f684b00edda3972f0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:12:55', '2020-05-20 09:12:55', '2021-05-20 11:12:55'),
('ccada05efe165c114a6a61b85dfdfbba52981f144d5a01fb262bd1328d40a9a09c254723d30324df', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 06:28:45', '2020-05-14 06:28:45', '2021-05-14 08:28:45'),
('ce2af6e6646b03b3af571569b9230bfc0cae85ba5789251ae0a94c477b3120a281c25340aabbed0c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 08:10:26', '2020-05-14 08:10:26', '2021-05-14 10:10:26'),
('ceb857ab70d68dff7b54e64c03cc173f8bdf5ea9428255abfa78c61c5fa26cd9cf1670ff40a78325', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 07:20:27', '2020-05-13 07:20:27', '2021-05-13 09:20:27'),
('cf582174ebbaa645a2a7b87e11eef2f5e30f6f54f98b9a5c98664fe832ce1adc9a953cd1e4d3c5ad', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:12:17', '2020-05-18 08:12:17', '2021-05-18 10:12:17'),
('cf625f335accaa85301f1888b6a9ec82718ab606f027d885b6cff371acfbafdf4d8d21c61d674428', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:11:02', '2020-05-20 09:11:02', '2021-05-20 11:11:02'),
('d0a2324cdd28e6c1c927fbc7a76759c8daecf262e26f706e08ce92289604d0a101cb967dbbb146d3', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 11:31:04', '2020-05-18 11:31:04', '2021-05-18 13:31:04'),
('d3f1e0cb28d716d06744892ac73ac6d5027d71d0fc956d863a48082ec1c49d0b58c14b2cd916f515', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:31:08', '2020-05-18 08:31:08', '2021-05-18 10:31:08'),
('d485e6b948142d67a3545f6a515103fd68723de58d87616e72ba144eab01e2914ca1306166e45707', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:31:50', '2020-05-18 07:31:50', '2021-05-18 09:31:50'),
('d53bbc738826bc247c3cd848a0d7c1321f4d5c671ff09113169e2f57797cfa7d23b1943fb911adf0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:37:15', '2020-05-18 08:37:15', '2021-05-18 10:37:15'),
('d64591a05c0a568e852de5cd5c3aaf52cd51d7e8607ffb3f642d3ab057c1b92a8d2de75593a8a63c', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:42:54', '2020-05-18 07:42:54', '2021-05-18 09:42:54'),
('d7aebc4e195b63468fd7234550392a4ee1080697c58ff12db8ce0787c0aac0a6165e64e7902456fa', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:21:05', '2020-05-18 08:21:05', '2021-05-18 10:21:05'),
('d7b3e69f00716f72b22b0073e084d2ebde2e0c4d001e27db2e5f1b7f39788fe4128d9054bffbdf60', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 12:18:10', '2020-05-19 12:18:10', '2021-05-19 14:18:10'),
('d828ed57b421fa9b14923e0573c37d4997c96d87711e66d79f583bcaea9a651f47beb8ec60837226', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:50:05', '2020-05-19 14:50:05', '2021-05-19 16:50:05'),
('d8d06eed4b7a65b90c90bb02686c2b71305a7151f7bdabf09fe7929a36c736f8727664f7afb4b445', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:55:56', '2020-05-18 08:55:56', '2021-05-18 10:55:56'),
('da1b30662f8092f7b9048e77cdad1931036460b37eae886c201600ce4ebab35216d31c84a1b6d142', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 06:25:53', '2020-05-14 06:25:53', '2021-05-14 08:25:53'),
('dc4c02d34d1f9d997782057d19804366ed995c86d1380d4f21c680c56b44d8f47785d2a2f0aeec0f', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:06:59', '2020-05-18 09:06:59', '2021-05-18 11:06:59'),
('de7fb0aca58434a62cbf7d32219a5d756a764e780abcbbe4f957f961d80b545571c4129eab127c04', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 12:37:16', '2020-05-18 12:37:16', '2021-05-18 14:37:16'),
('deff994ef6a29b84b60e08c20d93ae1b80918b4f876b559bfc921031690d92e2310d8b38cbd5eed0', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:23:16', '2020-05-18 08:23:16', '2021-05-18 10:23:16'),
('df2a8649aea0fe3c56c47f586f4a0003e9248380dc6fa381cf3a06f9b0ebc79a7855d1b68b264c64', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:33:07', '2020-05-18 09:33:07', '2021-05-18 11:33:07'),
('dfee1db8b4c3fee2ca00b2769ec28b28ef39ac13ef7ac20da9483b6e57e55536c40c1845230b4e93', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-13 15:49:45', '2020-05-13 15:49:45', '2021-05-13 17:49:45'),
('e025d66721083b35cf70299b5ba1b1788badb1ceef416f7ba9604c8d4203e7257b6402f73263a35e', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 13:31:46', '2020-05-20 13:31:46', '2021-05-20 15:31:46'),
('e053eccd60ae2ed4364d27a298f292e48437d38ccda65030204927e597fa9823bfa29e8df7c296f2', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 14:30:20', '2020-05-19 14:30:20', '2021-05-19 16:30:20'),
('e11aa1750c168b21d62c2aa50ad9fdcd23fafc002268121577149d24151fdb5faf46816c2f6ab644', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:23:51', '2020-05-18 07:23:51', '2021-05-18 09:23:51'),
('e1777b5619ede46b5b2d1e9002a4beae7af66214aac4b81ddbf414af308c10caacfb63ab0881a31a', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 12:47:41', '2020-05-19 12:47:41', '2021-05-19 14:47:41'),
('e1bd23fbb8ba707457512ed25230646680f5556b43a0096c403ededff4e23551d28076471ce7855a', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 09:54:31', '2020-05-18 09:54:31', '2021-05-18 11:54:31'),
('e1c6afb056b67eb0d58a46317e372942f9bbab85f939832f928aa85ce5cc89fcfd022f334483408e', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 16:45:46', '2020-05-19 16:45:46', '2021-05-19 18:45:46'),
('e6b1f022c56819305ec98413f490a3ae5817ead83d2be7efa15d45214684fad24e2eee7d1b365e0b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 11:22:54', '2020-05-18 11:22:54', '2021-05-18 13:22:54'),
('e7c4b9ce677cfc4ef7962e3832a29fd14fdaa39bcd6f8521d8b667a55d0722b4ec2a677f9fb96ba4', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 06:39:19', '2020-05-19 06:39:19', '2021-05-19 08:39:19'),
('eb898ec348318d5c39448ad08a4c450ff3b8ceb1b3605c65580e53d8a55758083fdcd5a215162b62', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:14:30', '2020-05-11 17:14:30', '2021-05-11 19:14:30'),
('ec1d675d2dec04b2b67338cedcfd814206a3d18a805654b216ebcf5de1cab983823c9f5726686fff', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 07:01:21', '2020-05-20 07:01:21', '2021-05-20 09:01:21'),
('edb2141f5827d0a23916e0d2a7398d33b0db39b984ad0ce19e8385d7d914de05ea4d7a7aaf105878', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-12 07:43:12', '2020-05-12 07:43:12', '2021-05-12 09:43:12'),
('edecddc9da898e5552aa133ceae7c2fc826d9fbb9c2625c07bbc09fe2bc951c9b807e247f0e04b97', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 08:10:43', '2020-05-18 08:10:43', '2021-05-18 10:10:43'),
('eeae20c2c602dc1075c5990257c833a7b17e69f45439ffce9f8d56d52cd20dcc7b166ae7a49632cb', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-14 08:19:42', '2020-05-14 08:19:42', '2021-05-14 10:19:42'),
('ef53793f5b2d0987a44f9c097b47267709625994e57bade612f37ade4d6738ca562cae2e4ee4076b', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-19 06:48:36', '2020-05-19 06:48:36', '2021-05-19 08:48:36'),
('f39a51623582072ef3dc4e775a57e002e1cfe802f68c90988b09fae92aa3309fa21f99a91528ac8d', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 15:03:54', '2020-05-11 15:03:54', '2021-05-11 17:03:54'),
('f4e2bf6264178e4382b98090ff3c6fb904e714a18d7125efb50d9aa376881501d538402f5be202e8', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 12:52:17', '2020-05-18 12:52:17', '2021-05-18 14:52:17'),
('f5f0eb7115f3b30c349bbea7d60fd75b76c1918f67bc11c17447fa1902be905c416fc7d01a609586', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-11 17:11:16', '2020-05-11 17:11:16', '2021-05-11 19:11:16'),
('f8ec341e81b154183be6ed233d63c5345a27c85c0a949fad6bcdf18bc54bef21b428b0dfac137c84', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-20 09:15:44', '2020-05-20 09:15:44', '2021-05-20 11:15:44'),
('fbdff23d7086e32e69a35bffed8f1808dcfd0f4ddad408cba755517ce0ced805f32c1e32e7247f6d', 4, 1, 'Personal Access Token', '[]', 0, '2020-05-18 07:29:50', '2020-05-18 07:29:50', '2021-05-18 09:29:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'La Salle Mollerussa Personal Access Client', 'M3HCnACzc3ougUgPQbSZIC3DlNL6C0CeXlYNiXj2', 'http://localhost', 1, 0, 0, '2020-04-24 07:56:09', '2020-04-24 07:56:09'),
(2, NULL, 'La Salle Mollerussa Password Grant Client', 'JjdpOVC4gTzBHW4vOmh9rLNoKvtt67PMrKRo2hn9', 'http://localhost', 0, 1, 0, '2020-04-24 07:56:09', '2020-04-24 07:56:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-04-24 07:56:09', '2020-04-24 07:56:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('victorlopezpena@gmail.com', '$2y$10$QMAXPYs4bc9U5WpwauHB.e1ZWCFNrlrw5CtWBIPs9gjGJxxK1x8EO', '2020-05-15 09:02:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `unsuscribe` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `unsuscribe`, `type`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 0, 'Admin', 'Victor', 'victorlopezpena@gmail.com', 'Victor', NULL, '$2y$10$me.ftRTNMPNCy38dPEL14eqRXTqgkF.pnn6w6EGX15/J7hZ0cgUb6', NULL, '2020-04-22 11:38:00', '2020-04-22 11:38:00'),
(9, 0, 'Professor', 'AdminProva', 'usuari1@gmail.com', 'Usuari 1', NULL, '$2y$10$mhQB9.GDnUe.MDKsDg6Yguij6FoCMfImTq9eIDc3zlEXPUb4du4Wy', NULL, '2020-04-23 11:49:40', NULL),
(10, 0, 'Professor', 'Api', 'prueba_api@example.com', 'ProvaAPI', NULL, '$2y$10$cQzPN9dE8RJFCFB6yt0EduNeO/3QJW9Shq5Mp2.ByUdcJCJAwpstO', NULL, '2020-04-24 07:51:13', NULL),
(14, 1, 'Professor', 'User1', 'user1@gmail.com', 'username1', NULL, '$2y$10$MRD/2Duu9rmcQFUeez2vpemQk1pLejE744YecV.fwtNL7ci6F2Eom', NULL, '2020-05-12 14:54:07', NULL),
(15, 0, 'Professor', 'User2', 'user2@gmail.com', 'username2', NULL, '$2y$10$9AFFnUcSd6cqjr/01Jd06upUC96TD8GB7urrGYyOvq05BUCcp8eUa', NULL, '2020-05-12 14:54:07', NULL),
(16, 0, 'Professor', 'User3', 'user3@gmail.com', 'username3', NULL, '$2y$10$rStwkPa9dZthQyQ6jISkY.qAQ0L81wDNYZSkRY2Kf85WtsLU7/onG', NULL, '2020-05-12 14:54:07', NULL),
(17, 1, 'Professor', 'User4', 'user4@gmail.com', 'username4', NULL, '$2y$10$zWgQ8KQ5x9/nsEkmrgAQH.JnawGcLl8hUCSjq.1g2iYsKjwI/l.j2', NULL, '2020-05-12 14:54:07', NULL),
(18, 0, 'Professor', 'User5', 'user14@gmail.com', 'username5', NULL, '$2y$10$sFa5ZsCDuRbYLl0sfqzls.m5TF9DQIQaBwLZHLyuhAd0HMN99Di92', NULL, '2020-05-12 14:54:07', NULL),
(19, 0, 'Professor', 'User6', 'user5@gmail.com', 'username6', NULL, '$2y$10$ie0119Gumq3j5EP8YzKnsOy3qMu3dQ0SdJn5yDGWqGA1NbbRH9nlS', NULL, '2020-05-12 14:54:07', NULL),
(20, 1, 'Professor', 'User7', 'user6@gmail.com', 'username7', NULL, '$2y$10$K2vt7TArQDtivTtGhRoQIulM5un75FzVgmrt1tqjlXCSvHB6pVTF6', NULL, '2020-05-12 14:54:07', NULL),
(21, 0, 'Professor', 'User8', 'user7@gmail.com', 'username8', NULL, '$2y$10$6Rq.04givzFoSBZJp3ncquT1BHV.TNaf5/oY56oZJOG6ZUMITYhp6', NULL, '2020-05-12 14:54:07', NULL),
(22, 0, 'Professor', 'User9', 'user8@gmail.com', 'username9', NULL, '$2y$10$ZXczk3rZH0gsJcqypsb1TugQXG9pnlMzmPL1Am9Ifm4gUbxvBZPCK', NULL, '2020-05-12 14:54:07', NULL),
(23, 0, 'Professor', 'User10', 'user9@gmail.com', 'username10', NULL, '$2y$10$7UqNJkTG0goTpGAp4i9YyuLfX1Sqy36U81f25itUGaiclx4B51Q/a', NULL, '2020-05-12 14:54:08', NULL),
(24, 0, 'Professor', 'Test', 'test@gmail.com', 'Testeito', NULL, '$2y$10$SOFMB9xkxqE0PSsWHU0Bge7eCq0B2agELMiiRkeF4n.GSiHIxx6gi', NULL, '2020-05-20 08:56:20', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assigned_rols`
--
ALTER TABLE `assigned_rols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_rols_user_id_foreign` (`user_id`),
  ADD KEY `assigned_rols_category_foreign` (`category`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_incidence_id_foreign` (`incidence_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidence`
--
ALTER TABLE `incidence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidence_category_foreign` (`category`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `assigned_rols`
--
ALTER TABLE `assigned_rols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidence`
--
ALTER TABLE `incidence`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assigned_rols`
--
ALTER TABLE `assigned_rols`
  ADD CONSTRAINT `assigned_rols_category_foreign` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `assigned_rols_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_incidence_id_foreign` FOREIGN KEY (`incidence_id`) REFERENCES `incidence` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `incidence`
--
ALTER TABLE `incidence`
  ADD CONSTRAINT `incidence_category_foreign` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
