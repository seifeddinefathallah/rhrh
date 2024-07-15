-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 juil. 2024 à 12:58
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrative_requests`
--

INSERT INTO `administrative_requests` (`id`, `employee_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Attestation de travail', 'En attente', '2024-07-10 09:31:50', '2024-07-10 09:31:50');

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authorization_requests`
--

INSERT INTO `authorization_requests` (`id`, `user_id`, `employee_id`, `type`, `start_date`, `start_time`, `end_date`, `duration_type`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Télétravail', '2024-07-10', '00:00:00', '2024-07-10', 'half day', '4 hours', 'approved', '2024-07-10 09:37:34', '2024-07-11 08:29:30'),
(3, 2, 2, 'Sortie', '2024-07-10', '00:00:00', '2024-07-10', 'hours', '1 hours', 'rejected', '2024-07-10 09:44:35', '2024-07-11 09:09:26'),
(4, 1, 1, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-12', 'days', '29 hours', 'approved', '2024-07-11 07:56:36', '2024-07-11 09:10:40'),
(5, 1, 1, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '1 hours', 'approved', '2024-07-11 08:36:21', '2024-07-11 09:12:12'),
(6, 1, 1, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0 hours', 'approved', '2024-07-11 09:12:57', '2024-07-11 09:13:05'),
(7, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '1 days', 'approved', '2024-07-11 09:23:31', '2024-07-11 09:23:46'),
(8, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0 hours', 'pending', '2024-07-11 09:29:47', '2024-07-11 09:29:47'),
(9, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0.5 hours', 'approved', '2024-07-11 09:34:01', '2024-07-11 09:34:08'),
(10, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '1 hours', 'approved', '2024-07-11 09:36:01', '2024-07-11 09:36:05'),
(11, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0.5 hours', 'approved', '2024-07-11 09:38:13', '2024-07-11 09:38:19'),
(12, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '1 days', 'pending', '2024-07-11 09:42:04', '2024-07-11 09:42:04'),
(13, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-13', 'days', '3 days', 'pending', '2024-07-11 09:42:32', '2024-07-11 09:42:32'),
(14, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 09:50:38', '2024-07-11 09:50:48'),
(15, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 09:52:21', '2024-07-11 09:52:27'),
(16, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:07:15', '2024-07-11 10:07:20'),
(17, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:47:46', '2024-07-11 10:47:55'),
(18, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:51:26', '2024-07-11 10:51:32'),
(19, 2, 2, 'Télétravail', '2024-07-11', '12:24:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:22:43', '2024-07-11 11:23:11'),
(20, 2, 2, 'Télétravail', '2024-07-11', '12:26:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:24:53', '2024-07-11 11:24:57'),
(21, 2, 2, 'Télétravail', '2024-07-11', '12:31:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:30:17', '2024-07-11 11:34:49'),
(22, 2, 2, 'Télétravail', '2024-07-11', '12:41:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:39:20', '2024-07-11 11:39:25'),
(23, 1, 1, 'Sortie', '2024-07-11', '18:56:00', '2024-07-11', 'hours', '0.5 hours', 'approved', '2024-07-11 17:57:07', '2024-07-11 18:02:38'),
(24, 1, 1, 'Sortie', '2024-07-11', '18:59:00', '2024-07-11', 'hours', '1 hours', 'approved', '2024-07-11 17:58:09', '2024-07-11 17:58:17');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `default_balances`
--

INSERT INTO `default_balances` (`id`, `employee_id`, `period`, `sortie_balance`, `teletravail_days_balance`, `created_at`, `updated_at`) VALUES
(1, 1, 'month', 2.00, 5.00, '2024-07-15 07:25:19', '2024-07-15 07:25:19'),
(2, 2, 'month', 2.00, 5.00, '2024-07-15 07:25:19', '2024-07-15 07:25:19'),
(3, 3, 'month', 2.00, 5.00, '2024-07-15 07:25:19', '2024-07-15 07:25:19');

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
(1, 'QAD', '2024-07-10 09:27:23', '2024-07-10 09:27:23');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `nom`, `prenom`, `date_naissance`, `email_professionnel`, `email_personnel`, `matricule`, `telephone`, `code_postal`, `ville`, `pays`, `adresse`, `situation_familiale`, `nombre_enfants`, `entite_id`, `departement_id`, `poste_id`, `cin_numero`, `cin_date_delivrance`, `state`, `carte_sejour_numero`, `carte_sejour_date_delivrance`, `carte_sejour_date_expiration`, `carte_sejour_type`, `passeport_numero`, `passeport_date_delivrance`, `passeport_date_expiration`, `passeport_delai_validite`, `created_at`, `updated_at`, `image`, `sortie_balance`, `teletravail_days_balance`) VALUES
(1, 1, 'fathallah', 'seifeddine', '1999-04-04', 'seifeddine.fathallah@csi-corporation.com', 'seifeddine@gmail.com', '7845', '9562623', '8745', 'Sidi Khaled', 'DZ', '562', 'Célibataire', 0, 1, 1, 1, '8751', '2020-04-04', '07', '8456', '2020-04-04', '2025-04-04', '8956', '95526', '2020-04-04', '2025-04-04', '79865', '2024-07-10 09:29:18', '2024-07-11 17:59:02', 'c.png', 0.00, 5.00),
(2, 2, 'kharbech', 'rayen', '1999-04-04', 'rayen.kharbech@csi-corporation.com', 'rayen.kharbech@gmail.com', '974865', '4784656', '646', 'Menzel Abderhaman', 'TN', '788745', 'Célibataire', 0, 1, 1, 1, '852', '2020-04-04', '23', '856', '2020-04-04', '2025-04-04', '8956', '9562', '2020-04-04', '2025-04-04', '85632', '2024-07-10 09:40:39', '2024-07-11 11:41:01', NULL, 0.00, 2.00),
(3, 3, 'eazu', 'ijar', '1999-01-04', 'ahf@csi-corporation.com', 'aufh@gmail.com', '89645', '8532', '785', 'Aïn el Bya', 'DZ', '8785', 'Célibataire', 0, 1, 1, 1, '864', '2020-04-04', '31', '8458', '2020-04-04', '2025-04-04', '485zer', '984', '2020-09-08', '2025-04-04', '1669', '2024-07-12 11:09:03', '2024-07-12 11:09:03', NULL, 2.00, 5.00);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entites`
--

INSERT INTO `entites` (`id`, `nom`, `numero_fiscal`, `adresse`, `pays`, `contact`, `nom_employeur`, `adresse_employeur`, `numero_siret`, `code_ape_naf`, `convention_collective`, `identifiant_etablissement`, `created_at`, `updated_at`) VALUES
(1, 'Csi_tun', '7', '45', 'tunisie', '856', 'csi', '8745', '7845', '7/845', '7846', '/784', '2024-07-10 09:27:16', '2024-07-10 09:27:16');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `laravel2step`
--

INSERT INTO `laravel2step` (`id`, `userId`, `authCode`, `authCount`, `authStatus`, `authDate`, `requestDate`, `created_at`, `updated_at`) VALUES
(1, 1, 'S6OG', 0, 1, '2024-07-15 09:34:21', NULL, '2024-07-10 09:24:51', '2024-07-15 08:34:21'),
(2, 2, 'Y7WA', 0, 1, '2024-07-11 10:23:13', NULL, '2024-07-10 09:43:55', '2024-07-11 09:23:13');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_requests_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `user_id`, `type`, `amount`, `currency`, `status`, `comments`, `created_at`, `updated_at`) VALUES
(1, 2, 'Prêt', 545.00, 'TND', 'En attente', '00', '2024-07-10 11:04:08', '2024-07-10 11:04:08'),
(2, 1, 'Prêt', 500.00, 'TND', 'En attente', 'fgh', '2024-07-11 07:54:19', '2024-07-11 07:54:19');

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(28, '2024_07_10_111934_add_image_to_employees_table', 2),
(29, '2024_07_11_082909_add_authorization_balances_to_employees', 3),
(30, '2024_07_11_121916_add_start_time_to_authorization_requests_table', 4),
(31, '2024_07_12_081737_create_player_ids_table', 5),
(32, '2024_07_12_105412_create_subscriptions_table', 6),
(33, '2024_07_15_082148_create_default_balances_table', 7),
(34, '2024_07_15_085659_create_temporary_balances_table', 8),
(35, '2024_07_15_091300_create_period_definitions_table', 9),
(36, '2024_07_15_091631_add_period_definition_id_to_temporary_balances_table', 10);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `period_definitions`
--

INSERT INTO `period_definitions` (`id`, `name`, `days`, `created_at`, `updated_at`) VALUES
(1, 'day', 1, '2024-07-15 08:15:22', '2024-07-15 08:15:22'),
(2, 'month', 30, '2024-07-15 08:15:22', '2024-07-15 08:15:22'),
(3, 'year', 365, '2024-07-15 08:15:22', '2024-07-15 08:15:22'),
(4, 'month', 31, '2024-07-15 09:35:35', '2024-07-15 09:35:35');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id`, `titre`, `departement_id`, `created_at`, `updated_at`) VALUES
(1, 'Consultant', 1, '2024-07-10 09:27:32', '2024-07-10 09:27:32'),
(2, 'f', 1, '2024-07-11 07:51:41', '2024-07-11 07:51:41');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `temporary_balances`
--

INSERT INTO `temporary_balances` (`id`, `employee_id`, `start_date`, `end_date`, `sortie_hours`, `teletravail_days`, `created_at`, `updated_at`, `period_definition_id`) VALUES
(1, 1, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:00:20', '2024-07-15 08:00:20', 0),
(2, 1, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:02:09', '2024-07-15 08:02:09', 0),
(3, 1, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:04:22', '2024-07-15 08:04:22', 0),
(4, 2, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:04:22', '2024-07-15 08:04:22', 0),
(5, 3, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:04:22', '2024-07-15 08:04:22', 0),
(6, 1, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:25:18', '2024-07-15 08:25:18', 2),
(7, 2, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:25:18', '2024-07-15 08:25:18', 2),
(8, 3, '2024-07-01', '2024-07-31', 4.00, 8.00, '2024-07-15 08:25:18', '2024-07-15 08:25:18', 2),
(9, 1, '2024-07-15', '2024-07-31', 6.00, 2.00, '2024-07-15 09:35:35', '2024-07-15 09:38:57', 4),
(10, 2, '2024-07-15', '2024-07-31', 6.00, 2.00, '2024-07-15 09:35:35', '2024-07-15 09:38:57', 4),
(11, 3, '2024-07-15', '2024-07-31', 6.00, 2.00, '2024-07-15 09:35:35', '2024-07-15 09:38:57', 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `provider_token`, `remember_token`, `created_at`, `updated_at`, `onesignal_player_id`, `failed_attempts`) VALUES
(1, 'seifeddine fathallah', 'seifeddine.fathallah', 'seifeddine.fathallah@csi-corporation.com', '2024-07-10 09:24:51', '$2y$10$3riMo58v/eL12SxVVNKmL.r14xLLE8/nE/wkLYQk2YfCB23p/Gnjm', NULL, NULL, NULL, NULL, '2024-07-10 09:24:34', '2024-07-10 09:24:51', NULL, 0),
(2, 'rayen kharbech', 'rayen.kharbech', 'rayen.kharbech@csi-corporation.com', '2024-07-10 09:43:54', '$2y$10$MMbZOsPgofmvrEZyGnuS1uncnAx8GQzomVk29a6pC3d6/RRfiMCAm', NULL, NULL, NULL, NULL, '2024-07-10 09:40:39', '2024-07-10 09:43:54', NULL, 0),
(3, 'ijar eazu', 'ijar.eazu', 'ahf@csi-corporation.com', NULL, '$2y$10$HaEHR1DfUs.h89Sb1aZlQOhcA.U8eHMgPpsyfz7jljHrDSd4Alngm', NULL, NULL, NULL, NULL, '2024-07-12 11:09:03', '2024-07-12 11:09:03', NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
