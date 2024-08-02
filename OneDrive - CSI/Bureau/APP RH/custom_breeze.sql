-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 juil. 2024 à 13:49
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `custom_breeze`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrative_requests`
--

DROP TABLE IF EXISTS `administrative_requests`;
CREATE TABLE IF NOT EXISTS `administrative_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `administrative_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrative_requests`
--

INSERT INTO `administrative_requests` (`id`, `employee_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Attestation de travail', 'En attente', '2024-07-17 12:58:35', '2024-07-17 12:58:35'),
(3, 2, 'Attestation de travail', 'en_attente', '2024-07-23 06:49:35', '2024-07-23 06:55:17'),
(4, 2, 'Attestation de salaire', 'En attente', '2024-07-23 07:00:39', '2024-07-23 07:00:39');

-- --------------------------------------------------------

--
-- Structure de la table `approval_histories`
--

DROP TABLE IF EXISTS `approval_histories`;
CREATE TABLE IF NOT EXISTS `approval_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `loan_request_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('Approuvé','Rejeté') COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approval_histories_loan_request_id_foreign` (`loan_request_id`),
  KEY `approval_histories_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `authorization_requests`
--

DROP TABLE IF EXISTS `authorization_requests`;
CREATE TABLE IF NOT EXISTS `authorization_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `duration_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authorization_requests_user_id_foreign` (`user_id`),
  KEY `authorization_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authorization_requests`
--

INSERT INTO `authorization_requests` (`id`, `user_id`, `employee_id`, `type`, `start_date`, `start_time`, `end_date`, `duration_type`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Sortie', '2024-07-17', '13:59:00', '2024-07-17', 'hours', '1 hours', 'rejected', '2024-07-17 12:57:49', '2024-07-23 11:11:34'),
(2, 1, 2, 'Télétravail', '2024-07-17', '15:08:00', '2024-07-17', 'half day', '0.5 days', 'pending', '2024-07-17 13:06:24', '2024-07-17 13:06:24'),
(3, 1, 2, 'Télétravail', '2024-07-17', '15:08:00', '2024-07-17', 'half day', '0.5 days', 'approved', '2024-07-17 13:06:26', '2024-07-23 10:13:24'),
(4, 1, 2, 'Sortie', '2024-07-23', '13:33:00', '2024-07-23', 'hours', '1 hours', 'rejected', '2024-07-23 11:02:35', '2024-07-23 11:34:31');

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` int DEFAULT NULL,
  `periode_essai_initiale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renouvellement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree_contrat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debut_contrat` date DEFAULT NULL,
  `fin_contrat` date DEFAULT NULL,
  `pays` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contracts_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `iso2` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `phone_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subregion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precision` tinyint NOT NULL DEFAULT '2',
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_native` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_first` tinyint NOT NULL DEFAULT '1',
  `decimal_mark` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '.',
  `thousands_separator` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ',',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `default_balances`
--

DROP TABLE IF EXISTS `default_balances`;
CREATE TABLE IF NOT EXISTS `default_balances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortie_balance` decimal(8,2) NOT NULL DEFAULT '2.00',
  `teletravail_days_balance` decimal(8,2) NOT NULL DEFAULT '5.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `default_balances_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `default_balances`
--

INSERT INTO `default_balances` (`id`, `employee_id`, `period`, `sortie_balance`, `teletravail_days_balance`, `created_at`, `updated_at`) VALUES
(1, 1, 'month', 2.00, 5.00, '2024-07-17 11:59:24', '2024-07-17 11:59:24'),
(2, 2, 'month', 2.00, 5.00, '2024-07-17 12:23:45', '2024-07-17 12:23:45'),
(3, 3, 'month', 2.00, 5.00, '2024-07-18 09:52:34', '2024-07-18 09:52:34'),
(4, 4, 'month', 2.00, 5.00, '2024-07-22 12:13:07', '2024-07-22 12:13:07'),
(5, 5, 'month', 2.00, 5.00, '2024-07-22 12:47:07', '2024-07-22 12:47:07');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'QAD', '2024-07-17 11:55:19', '2024-07-17 11:55:19');

-- --------------------------------------------------------

--
-- Structure de la table `departement_entite`
--

DROP TABLE IF EXISTS `departement_entite`;
CREATE TABLE IF NOT EXISTS `departement_entite` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `departement_id` bigint UNSIGNED NOT NULL,
  `entite_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_entite_departement_id_foreign` (`departement_id`),
  KEY `departement_entite_entite_id_foreign` (`entite_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departement_entite`
--

INSERT INTO `departement_entite` (`id`, `departement_id`, `entite_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `email_professionnel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_personnel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situation_familiale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_enfants` int NOT NULL,
  `entite_id` bigint UNSIGNED NOT NULL,
  `departement_id` bigint UNSIGNED NOT NULL,
  `poste_id` bigint UNSIGNED NOT NULL,
  `cin_numero` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin_date_delivrance` date DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carte_sejour_numero` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carte_sejour_date_delivrance` date DEFAULT NULL,
  `carte_sejour_date_expiration` date DEFAULT NULL,
  `carte_sejour_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passeport_numero` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passeport_date_delivrance` date DEFAULT NULL,
  `passeport_date_expiration` date DEFAULT NULL,
  `passeport_delai_validite` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sortie_balance` decimal(8,2) NOT NULL DEFAULT '2.00',
  `teletravail_days_balance` decimal(8,2) NOT NULL DEFAULT '5.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_professionnel_unique` (`email_professionnel`),
  KEY `employees_user_id_foreign` (`user_id`),
  KEY `employees_entite_id_foreign` (`entite_id`),
  KEY `employees_departement_id_foreign` (`departement_id`),
  KEY `employees_poste_id_foreign` (`poste_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `nom`, `prenom`, `date_naissance`, `email_professionnel`, `email_personnel`, `matricule`, `telephone`, `code_postal`, `ville`, `pays`, `adresse`, `situation_familiale`, `nombre_enfants`, `entite_id`, `departement_id`, `poste_id`, `cin_numero`, `cin_date_delivrance`, `state`, `carte_sejour_numero`, `carte_sejour_date_delivrance`, `carte_sejour_date_expiration`, `carte_sejour_type`, `passeport_numero`, `passeport_date_delivrance`, `passeport_date_expiration`, `passeport_delai_validite`, `created_at`, `updated_at`, `image`, `sortie_balance`, `teletravail_days_balance`) VALUES
(2, 1, 'fathallah', 'seifeddine', '1999-04-04', 'seifeddine.fathallah@csi-corporation.com', 'seif@gmail.com', '8745', '855665', '8454', 'Air Force Academy', 'US', 'zera4', 'Célibataire', 0, 1, 1, 1, '08574', '2020-04-04', 'CO', 'etghyjk', '2020-04-04', '2025-04-04', '85', '84568', '2020-04-04', '2025-04-04', '1826', '2024-07-17 12:23:45', '2024-07-23 11:46:24', 'employees/y46BifSJu5K4k2TZEQeTioedWIOLDVyS8sU95uUH.png', 2.00, 1.00),
(3, 2, 'kharbech', 'rayen', '1999-04-04', 'rayen.kharbech@csi-corporation.com', 'afuh@gmail.com', '84512', '525656565', '485545', 'Bouïra', 'DZ', 'zera4', 'Célibataire', 0, 1, 1, 1, '874652', '2020-04-04', '10', '84568edf', '2020-04-04', '2025-04-04', '845e2d', '8565541', '2020-04-04', '2025-04-04', '1826', '2024-07-18 09:52:34', '2024-07-23 11:46:24', 'Capture d\'écran 2024-06-21 211831.png', 2.00, 1.00);

-- --------------------------------------------------------

--
-- Structure de la table `entites`
--

DROP TABLE IF EXISTS `entites`;
CREATE TABLE IF NOT EXISTS `entites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_fiscal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_employeur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_employeur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_siret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_ape_naf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `convention_collective` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifiant_etablissement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entites`
--

INSERT INTO `entites` (`id`, `nom`, `numero_fiscal`, `adresse`, `pays`, `contact`, `nom_employeur`, `adresse_employeur`, `numero_siret`, `code_ape_naf`, `convention_collective`, `identifiant_etablissement`, `image`, `created_at`, `updated_at`) VALUES
(1, 'csi', '79852', '8956', 'tunisie', '8956', 'fyghj', '45', '7845', '7845', '7', '45', 'entite_images/FW4UOEkX2ywky6MUGXxONSUkZL7DQ3FFPlBSp7T4.png', '2024-07-17 11:53:35', '2024-07-17 12:43:26'),
(2, 'csss', '784', '7845', 'tiajk', '7864', '8465', '78465', '845', '8451', '485', '84', 'entite_images/bcbr21ADCc4JWiBYkz6NEENtBdqFw44ekOq4dq5B.png', '2024-07-17 12:33:41', '2024-07-17 12:33:41');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_logins`
--

DROP TABLE IF EXISTS `failed_logins`;
CREATE TABLE IF NOT EXISTS `failed_logins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `failed_logins_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_native` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `laravel2step`
--

DROP TABLE IF EXISTS `laravel2step`;
CREATE TABLE IF NOT EXISTS `laravel2step` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint UNSIGNED NOT NULL,
  `authCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authCount` int NOT NULL,
  `authStatus` tinyint(1) NOT NULL DEFAULT '0',
  `authDate` datetime DEFAULT NULL,
  `requestDate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laravel2step_userid_index` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `laravel2step`
--

INSERT INTO `laravel2step` (`id`, `userId`, `authCode`, `authCount`, `authStatus`, `authDate`, `requestDate`, `created_at`, `updated_at`) VALUES
(1, 1, 'RDUL', 0, 1, '2024-07-23 07:15:28', NULL, '2024-07-17 11:22:52', '2024-07-23 06:15:28');

-- --------------------------------------------------------

--
-- Structure de la table `loan_requests`
--

DROP TABLE IF EXISTS `loan_requests`;
CREATE TABLE IF NOT EXISTS `loan_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` enum('Prêt','Avances') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TND',
  `status` enum('En attente','Approuvé','Rejeté') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En attente',
  `comments` text COLLATE utf8mb4_unicode_ci,
  `employee_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_requests_user_id_foreign` (`user_id`),
  KEY `loan_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `user_id`, `type`, `amount`, `currency`, `status`, `comments`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Prêt', 452.00, 'TND', 'En attente', 'rdft', 1, '2024-07-17 12:55:32', '2024-07-17 12:55:32'),
(2, 1, 'Prêt', 55.00, 'TND', 'En attente', 'esdrgh', 2, '2024-07-17 13:11:40', '2024-07-17 13:11:40');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_12_09_070937_create_two_step_auth_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_07_07_055656_create_countries_table', 1),
(7, '2020_07_07_055725_create_cities_table', 1),
(8, '2020_07_07_055746_create_timezones_table', 1),
(9, '2021_10_19_071730_create_states_table', 1),
(10, '2021_10_23_082414_create_currencies_table', 1),
(11, '2022_01_22_034939_create_languages_table', 1),
(12, '2024_06_18_083014_add_onesignal_player_id_to_users_table', 1),
(13, '2024_06_21_120114_create_employees_table', 1),
(14, '2024_06_23_111911_create_administrative_requests_table', 1),
(15, '2024_06_25_094628_create_entites_table', 1),
(16, '2024_06_25_110100_create_departements_table', 1),
(17, '2024_06_25_111027_create_departement_entite_table', 1),
(18, '2024_06_25_124559_create_postes_table', 1),
(19, '2024_06_27_093922_create_authorization_requests_table', 1),
(20, '2024_06_28_135743_add_state_to_employees_table', 1),
(21, '2024_06_28_152838_contactmaj', 1),
(22, '2024_07_01_121525_add_failed_attempts_to_users_table', 1),
(23, '2024_07_01_124348_create_failed_logins_table', 1),
(24, '2024_07_01_124856_add_timestamps_to_failed_logins_table', 1),
(25, '2024_07_01_125420_create_loan_requests_table', 1),
(26, '2024_07_01_125439_create_approval_histories_table', 1),
(27, '2024_07_09_130635_add_currency_to_loan_requests_table', 1),
(28, '2024_07_10_111934_add_image_to_employees_table', 1),
(29, '2024_07_11_082909_add_authorization_balances_to_employees', 1),
(30, '2024_07_11_121916_add_start_time_to_authorization_requests_table', 1),
(31, '2024_07_12_081737_create_player_ids_table', 1),
(32, '2024_07_12_105412_create_subscriptions_table', 1),
(33, '2024_07_15_082148_create_default_balances_table', 1),
(34, '2024_07_15_085659_create_temporary_balances_table', 1),
(35, '2024_07_15_091300_create_period_definitions_table', 1),
(36, '2024_07_15_091631_add_period_definition_id_to_temporary_balances_table', 1),
(37, '2024_07_17_090554_add_image_to_entites_table', 1),
(38, '0000_00_00_000000_create_websockets_statistics_entries_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `period_definitions`
--

DROP TABLE IF EXISTS `period_definitions`;
CREATE TABLE IF NOT EXISTS `period_definitions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `period_definitions`
--

INSERT INTO `period_definitions` (`id`, `name`, `days`, `created_at`, `updated_at`) VALUES
(1, 'day', 1, '2024-07-23 11:40:20', '2024-07-23 11:40:20');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `player_ids`
--

DROP TABLE IF EXISTS `player_ids`;
CREATE TABLE IF NOT EXISTS `player_ids` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `player_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `player_ids_player_id_unique` (`player_id`),
  KEY `player_ids_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

DROP TABLE IF EXISTS `postes`;
CREATE TABLE IF NOT EXISTS `postes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postes_departement_id_foreign` (`departement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id`, `titre`, `departement_id`, `created_at`, `updated_at`) VALUES
(1, 'consultant', 1, '2024-07-17 11:55:46', '2024-07-23 09:27:06'),
(2, 'consultant_qad', 1, '2024-07-23 09:28:32', '2024-07-23 09:28:32'),
(3, 'consultant_qad_csi', 1, '2024-07-23 09:29:38', '2024-07-23 09:29:38');

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_subscription_id_unique` (`subscription_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temporary_balances`
--

DROP TABLE IF EXISTS `temporary_balances`;
CREATE TABLE IF NOT EXISTS `temporary_balances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `sortie_hours` decimal(5,2) NOT NULL DEFAULT '0.00',
  `teletravail_days` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `period_definition_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `temporary_balances_employee_id_foreign` (`employee_id`),
  KEY `temporary_balances_period_definition_id_foreign` (`period_definition_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `temporary_balances`
--

INSERT INTO `temporary_balances` (`id`, `employee_id`, `start_date`, `end_date`, `sortie_hours`, `teletravail_days`, `created_at`, `updated_at`, `period_definition_id`) VALUES
(1, 2, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:40:20', '2024-07-23 11:40:20', 1),
(2, 3, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:40:20', '2024-07-23 11:40:20', 1),
(3, 2, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:41:43', '2024-07-23 11:41:43', 1),
(4, 3, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:41:43', '2024-07-23 11:41:43', 1),
(5, 2, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:42:57', '2024-07-23 11:42:57', 1),
(6, 3, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:42:57', '2024-07-23 11:42:57', 1),
(7, 2, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:45:00', '2024-07-23 11:45:00', 1),
(8, 3, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:45:00', '2024-07-23 11:45:00', 1),
(9, 2, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:46:24', '2024-07-23 11:46:24', 1),
(10, 3, '2024-07-23', '2024-07-23', 2.00, 1.00, '2024-07-23 11:46:24', '2024-07-23 11:46:24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
CREATE TABLE IF NOT EXISTS `timezones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `onesignal_player_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_attempts` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `provider_token`, `remember_token`, `created_at`, `updated_at`, `onesignal_player_id`, `failed_attempts`) VALUES
(1, 'seifeddine fathallah', 'seifeddine.fathallah', 'seifeddine.fathallah@csi-corporation.com', '2024-07-17 11:22:51', '$2y$10$.Z2dvCD15oEwztncO2YIme7MJdLOI0zZHIQ.9wKweWnEKG2phsTwK', NULL, NULL, NULL, NULL, '2024-07-17 11:22:37', '2024-07-17 11:22:51', NULL, 0),
(2, 'rayen kharbech', 'rayen.kharbech', 'rayen.kharbech@csi-corporation.com', NULL, '$2y$10$daH.OjiXIUJ4NJ7ZrfC1cuqzkuLhJpRsqE6zcLliZ2VHp6CjJxqyy', NULL, NULL, NULL, NULL, '2024-07-18 09:52:34', '2024-07-18 09:52:34', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `websockets_statistics_entries`
--

DROP TABLE IF EXISTS `websockets_statistics_entries`;
CREATE TABLE IF NOT EXISTS `websockets_statistics_entries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `websockets_statistics_entries`
--

INSERT INTO `websockets_statistics_entries` (`id`, `app_id`, `peak_connection_count`, `websocket_message_count`, `api_message_count`, `created_at`, `updated_at`) VALUES
(1, '1827915', 1, 1, 0, '2024-07-19 11:43:22', '2024-07-19 11:43:22'),
(2, '1827915', 0, 2, 1, '2024-07-19 11:44:22', '2024-07-19 11:44:22'),
(3, '1827915', 0, 2, 1, '2024-07-19 11:45:22', '2024-07-19 11:45:22'),
(4, '1827915', 0, 2, 1, '2024-07-19 11:46:22', '2024-07-19 11:46:22'),
(5, '1827915', 0, 2, 1, '2024-07-19 11:47:22', '2024-07-19 11:47:22'),
(6, '1827915', 0, 1, 1, '2024-07-19 11:48:22', '2024-07-19 11:48:22'),
(7, '1827915', 0, 2, 1, '2024-07-19 11:49:22', '2024-07-19 11:49:22'),
(8, '1827915', 0, 2, 1, '2024-07-19 11:50:22', '2024-07-19 11:50:22'),
(9, '1827915', 0, 2, 1, '2024-07-19 11:51:22', '2024-07-19 11:51:22'),
(10, '1827915', 0, 2, 1, '2024-07-19 11:52:22', '2024-07-19 11:52:22'),
(11, '1827915', 0, 2, 1, '2024-07-19 11:53:22', '2024-07-19 11:53:22'),
(12, '1827915', 0, 2, 1, '2024-07-19 11:54:22', '2024-07-19 11:54:22'),
(13, '1827915', 0, 2, 1, '2024-07-19 11:55:22', '2024-07-19 11:55:22'),
(14, '1827915', 0, 2, 1, '2024-07-19 11:56:22', '2024-07-19 11:56:22'),
(15, '1827915', 0, 2, 1, '2024-07-19 11:57:22', '2024-07-19 11:57:22'),
(16, '1827915', 0, 2, 1, '2024-07-19 11:58:22', '2024-07-19 11:58:22'),
(17, '1827915', 0, 2, 1, '2024-07-19 11:59:22', '2024-07-19 11:59:22'),
(18, '1827915', 0, 2, 1, '2024-07-19 12:00:22', '2024-07-19 12:00:22'),
(19, '1827915', 0, 2, 1, '2024-07-19 12:01:22', '2024-07-19 12:01:22'),
(20, '1827915', 0, 2, 1, '2024-07-19 12:02:22', '2024-07-19 12:02:22'),
(21, '1827915', 0, 2, 1, '2024-07-19 12:03:22', '2024-07-19 12:03:22'),
(22, '1827915', 0, 2, 1, '2024-07-19 12:04:22', '2024-07-19 12:04:22'),
(23, '1827915', 0, 2, 1, '2024-07-19 12:05:22', '2024-07-19 12:05:22'),
(24, '1827915', 0, 2, 1, '2024-07-19 12:06:22', '2024-07-19 12:06:22'),
(25, '1827915', 0, 2, 1, '2024-07-19 12:07:22', '2024-07-19 12:07:22'),
(26, '1827915', 0, 2, 1, '2024-07-19 12:08:22', '2024-07-19 12:08:22'),
(27, '1827915', 0, 2, 1, '2024-07-19 12:09:22', '2024-07-19 12:09:22'),
(28, '1827915', 0, 2, 1, '2024-07-19 12:10:22', '2024-07-19 12:10:22'),
(29, '1827915', 0, 2, 1, '2024-07-19 12:11:22', '2024-07-19 12:11:22'),
(30, '1827915', 0, 2, 1, '2024-07-19 12:12:22', '2024-07-19 12:12:22'),
(31, '1827915', 0, 2, 1, '2024-07-19 12:13:22', '2024-07-19 12:13:22'),
(32, '1827915', 0, 2, 1, '2024-07-19 12:14:22', '2024-07-19 12:14:22'),
(33, '1827915', 0, 2, 1, '2024-07-19 12:15:22', '2024-07-19 12:15:22'),
(34, '1827915', 0, 2, 1, '2024-07-19 12:16:22', '2024-07-19 12:16:22'),
(35, '1827915', 0, 2, 1, '2024-07-19 12:17:22', '2024-07-19 12:17:22'),
(36, '1827915', 0, 2, 1, '2024-07-19 12:18:22', '2024-07-19 12:18:22'),
(37, '1827915', 0, 2, 1, '2024-07-19 12:19:22', '2024-07-19 12:19:22'),
(38, '1827915', 0, 2, 1, '2024-07-19 12:20:22', '2024-07-19 12:20:22'),
(39, '1827915', 0, 2, 1, '2024-07-19 12:21:22', '2024-07-19 12:21:22'),
(40, '1827915', 0, 2, 1, '2024-07-19 12:22:23', '2024-07-19 12:22:23'),
(41, '1827915', 0, 1, 1, '2024-07-19 12:23:22', '2024-07-19 12:23:22'),
(42, '1827915', 0, 1, 1, '2024-07-19 12:24:22', '2024-07-19 12:24:22'),
(43, '1827915', 0, 2, 1, '2024-07-19 12:25:22', '2024-07-19 12:25:22'),
(44, '1827915', 0, 2, 1, '2024-07-19 12:26:22', '2024-07-19 12:26:22'),
(45, '1827915', 0, 2, 1, '2024-07-19 12:27:22', '2024-07-19 12:27:22'),
(46, '1827915', 0, 2, 1, '2024-07-19 12:28:22', '2024-07-19 12:28:22'),
(47, '1827915', 0, 1, 1, '2024-07-19 12:29:22', '2024-07-19 12:29:22'),
(48, '1827915', 0, 2, 1, '2024-07-19 12:30:22', '2024-07-19 12:30:22'),
(49, '1827915', 0, 2, 1, '2024-07-19 12:31:22', '2024-07-19 12:31:22'),
(50, '1827915', 0, 2, 1, '2024-07-19 12:32:22', '2024-07-19 12:32:22'),
(51, '1827915', 0, 2, 1, '2024-07-19 12:33:22', '2024-07-19 12:33:22'),
(52, '1827915', 0, 2, 1, '2024-07-19 12:34:22', '2024-07-19 12:34:22'),
(53, '1827915', 0, 2, 1, '2024-07-19 12:35:22', '2024-07-19 12:35:22'),
(54, '1827915', 0, 1, 1, '2024-07-19 12:36:22', '2024-07-19 12:36:22'),
(55, '1827915', 0, 0, 1, '2024-07-19 12:37:22', '2024-07-19 12:37:22'),
(56, '1827915', 0, 1, 1, '2024-07-19 12:38:23', '2024-07-19 12:38:23'),
(57, '1827915', 0, 3, 1, '2024-07-19 12:39:22', '2024-07-19 12:39:22'),
(58, '1827915', 1, 2, 1, '2024-07-19 12:40:22', '2024-07-19 12:40:22'),
(59, '1827915', 1, 2, 1, '2024-07-19 12:41:22', '2024-07-19 12:41:22'),
(60, '1827915', 1, 2, 1, '2024-07-19 12:42:22', '2024-07-19 12:42:22'),
(61, '1827915', 1, 2, 1, '2024-07-19 12:43:22', '2024-07-19 12:43:22'),
(62, '1827915', 1, 3, 1, '2024-07-19 12:44:22', '2024-07-19 12:44:22'),
(63, '1827915', 1, 2, 1, '2024-07-19 12:45:22', '2024-07-19 12:45:22'),
(64, '1827915', 1, 2, 1, '2024-07-19 12:46:22', '2024-07-19 12:46:22'),
(65, '1827915', 1, 2, 1, '2024-07-19 12:47:22', '2024-07-19 12:47:22'),
(66, '1827915', 1, 2, 1, '2024-07-19 12:48:23', '2024-07-19 12:48:23'),
(67, '1827915', 1, 2, 1, '2024-07-19 12:49:22', '2024-07-19 12:49:22'),
(68, '1827915', 1, 2, 1, '2024-07-19 12:50:22', '2024-07-19 12:50:22'),
(69, '1827915', 1, 2, 1, '2024-07-19 12:51:23', '2024-07-19 12:51:23'),
(70, '1827915', 0, 1, 1, '2024-07-19 12:52:22', '2024-07-19 12:52:22'),
(71, '1827915', 0, 1, 1, '2024-07-19 12:53:22', '2024-07-19 12:53:22'),
(72, '1827915', 0, 2, 1, '2024-07-19 12:54:23', '2024-07-19 12:54:23'),
(73, '1827915', 1, 1, 1, '2024-07-19 12:55:23', '2024-07-19 12:55:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
