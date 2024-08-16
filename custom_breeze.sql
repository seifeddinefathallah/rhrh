-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 16 août 2024 à 13:08
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
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `administrative_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrative_requests`
--

INSERT INTO `administrative_requests` (`id`, `employee_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Attestation de travail', 'approuvé', '2024-07-10 09:31:50', '2024-07-26 09:31:47'),
(2, 8, 'Attestation de salaire', 'En attente', '2024-07-18 10:26:08', '2024-07-18 10:26:08'),
(3, 8, 'Fiche de paie avec cachet', 'rejeté', '2024-07-29 10:25:23', '2024-07-29 10:26:47'),
(4, 8, 'Fiche de paie avec cachet', 'approuvé', '2024-07-29 10:25:26', '2024-07-29 10:26:34'),
(5, 1, 'Attestation de salaire', 'approuvé', '2024-07-29 10:38:37', '2024-08-06 12:29:48'),
(6, 1, 'Fiche de paie avec cachet', 'rejeté', '2024-08-06 09:33:18', '2024-08-06 12:30:36'),
(7, 1, 'Attestation de travail', 'rejeté', '2024-08-06 09:34:26', '2024-08-06 12:32:24'),
(8, 1, 'Attestation de travail', 'rejeté', '2024-08-07 07:27:02', '2024-08-07 07:27:17'),
(9, 1, 'Attestation de travail', 'rejeté', '2024-08-07 07:28:19', '2024-08-07 07:28:31'),
(10, 1, 'Attestation de travail', 'approuvé', '2024-08-07 07:28:51', '2024-08-08 10:54:41'),
(11, 1, 'Attestation de travail', 'rejeté', '2024-08-08 10:28:51', '2024-08-08 10:54:52'),
(12, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:31:57', '2024-08-08 10:31:57'),
(13, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:35:13', '2024-08-08 10:35:13'),
(14, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:37:41', '2024-08-08 10:37:41'),
(15, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:38:13', '2024-08-08 10:38:13'),
(16, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:40:12', '2024-08-08 10:40:12'),
(17, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:40:46', '2024-08-08 10:40:46'),
(18, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:43:22', '2024-08-08 10:43:22'),
(19, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:43:41', '2024-08-08 10:43:41'),
(20, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:45:03', '2024-08-08 10:45:03'),
(21, 1, 'Attestation de travail', 'En attente', '2024-08-08 10:51:10', '2024-08-08 10:51:10');

-- --------------------------------------------------------

--
-- Structure de la table `approval_histories`
--

DROP TABLE IF EXISTS `approval_histories`;
CREATE TABLE IF NOT EXISTS `approval_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `loan_request_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('Approuvé','Rejeté') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `duration_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authorization_requests_user_id_foreign` (`user_id`),
  KEY `authorization_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authorization_requests`
--

INSERT INTO `authorization_requests` (`id`, `user_id`, `employee_id`, `type`, `start_date`, `start_time`, `end_date`, `duration_type`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 'Sortie', '2024-07-10', '00:00:00', '2024-07-10', 'hours', '1 hours', 'rejected', '2024-07-10 09:44:35', '2024-07-11 09:09:26'),
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
(16, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'rejected', '2024-07-11 10:07:15', '2024-07-17 08:31:28'),
(17, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:47:46', '2024-07-11 10:47:55'),
(18, 4, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:51:26', '2024-07-11 10:51:32'),
(19, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:22:43', '2024-07-11 11:23:11'),
(20, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:24:53', '2024-07-11 11:24:57'),
(23, 1, 1, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0.5 hours', 'approved', '2024-07-11 17:57:07', '2024-08-05 10:29:19'),
(26, 1, 1, 'Sortie', '2024-08-08', '14:01:00', '2024-08-08', 'hours', '1 hours', 'approved', '2024-08-08 11:00:50', '2024-08-08 11:23:06'),
(27, 1, 1, 'Sortie', '2024-08-08', '13:25:00', '2024-08-08', 'hours', '1 hours', 'rejected', '2024-08-08 11:25:08', '2024-08-08 11:25:17'),
(28, 1, 1, 'Sortie', '2024-08-08', '13:25:00', '2024-08-08', 'hours', '1 hours', 'approved', '2024-08-08 11:25:41', '2024-08-08 11:25:54'),
(29, 1, 1, 'Télétravail', '2024-08-08', '14:13:00', '2024-08-08', 'half day', '0.5 days', 'rejected', '2024-08-08 12:13:36', '2024-08-08 12:13:55'),
(30, 1, 1, 'Sortie', '2024-08-14', '09:44:00', '2024-08-14', 'hours', '1 hours', 'rejected', '2024-08-14 07:44:31', '2024-08-14 07:44:51');

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` int DEFAULT NULL,
  `periode_essai_initiale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renouvellement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree_contrat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debut_contrat` date DEFAULT NULL,
  `fin_contrat` date DEFAULT NULL,
  `pays` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contracts_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contract_types`
--

DROP TABLE IF EXISTS `contract_types`;
CREATE TABLE IF NOT EXISTS `contract_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coefficient` int DEFAULT NULL,
  `probation_period` int DEFAULT NULL,
  `renouvellement` tinyint(1) NOT NULL DEFAULT '1',
  `cdt_renouv` int NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contract_types`
--

INSERT INTO `contract_types` (`id`, `name`, `description`, `country`, `classification`, `coefficient`, `probation_period`, `renouvellement`, `cdt_renouv`, `created_at`, `updated_at`) VALUES
(1, 'Temporaire', 'CDD stage', 'TN', NULL, NULL, 4, 1, 1, '2024-07-16 11:06:33', '2024-07-16 11:06:33'),
(4, 'Permanant', 'svdx', 'FR', 'ETAM', 4, NULL, 1, 1, '2024-07-18 11:21:59', '2024-07-18 11:21:59');

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `iso2` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `phone_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subregion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precision` tinyint NOT NULL DEFAULT '2',
  `symbol` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_native` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_first` tinyint NOT NULL DEFAULT '1',
  `decimal_mark` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '.',
  `thousands_separator` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ',',
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
  `period` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 8, 'month', 2.00, 5.00, '2024-08-02 12:08:44', '2024-08-02 12:08:44'),
(2, 9, 'month', 2.00, 5.00, '2024-08-14 09:39:30', '2024-08-14 09:39:30'),
(3, 10, 'month', 2.00, 5.00, '2024-08-14 12:34:17', '2024-08-14 12:34:17');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'QAD', '2024-07-10 09:27:23', '2024-07-10 09:27:23'),
(3, 'SAP', '2024-07-18 11:35:01', '2024-07-18 11:35:01'),
(4, 'tb', '2024-07-24 08:38:23', '2024-07-24 08:38:23'),
(5, 'rbrgvdf', '2024-07-26 08:27:21', '2024-07-26 08:27:21');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departement_entite`
--

INSERT INTO `departement_entite` (`id`, `departement_id`, `entite_id`, `created_at`, `updated_at`) VALUES
(7, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 5, 1, NULL, NULL),
(8, 3, 8, NULL, NULL),
(6, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `divers`
--

DROP TABLE IF EXISTS `divers`;
CREATE TABLE IF NOT EXISTS `divers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `divers_type_unique` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `nom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `email_professionnel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_personnel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `situation_familiale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_enfants` int NOT NULL,
  `entite_id` bigint UNSIGNED NOT NULL,
  `departement_id` bigint UNSIGNED NOT NULL,
  `poste_id` bigint UNSIGNED NOT NULL,
  `cin_numero` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin_date_delivrance` date DEFAULT NULL,
  `state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carte_sejour_numero` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carte_sejour_date_delivrance` date DEFAULT NULL,
  `carte_sejour_date_expiration` date DEFAULT NULL,
  `carte_sejour_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passeport_numero` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passeport_date_delivrance` date DEFAULT NULL,
  `passeport_date_expiration` date DEFAULT NULL,
  `passeport_delai_validite` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contract_type_id` bigint UNSIGNED DEFAULT NULL,
  `duree_contrat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debut_contrat` date DEFAULT NULL,
  `fin_contrat` date DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sortie_balance` decimal(8,2) NOT NULL DEFAULT '2.00',
  `teletravail_days_balance` int UNSIGNED NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_professionnel_unique` (`email_professionnel`),
  KEY `employees_user_id_foreign` (`user_id`),
  KEY `employees_entite_id_foreign` (`entite_id`),
  KEY `employees_departement_id_foreign` (`departement_id`),
  KEY `employees_poste_id_foreign` (`poste_id`),
  KEY `employees_contract_type_id_foreign` (`contract_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `nom`, `prenom`, `date_naissance`, `email_professionnel`, `email_personnel`, `matricule`, `telephone`, `code_postal`, `ville`, `pays`, `adresse`, `situation_familiale`, `nombre_enfants`, `entite_id`, `departement_id`, `poste_id`, `cin_numero`, `cin_date_delivrance`, `state`, `carte_sejour_numero`, `carte_sejour_date_delivrance`, `carte_sejour_date_expiration`, `carte_sejour_type`, `passeport_numero`, `passeport_date_delivrance`, `passeport_date_expiration`, `passeport_delai_validite`, `created_at`, `updated_at`, `contract_type_id`, `duree_contrat`, `debut_contrat`, `fin_contrat`, `image`, `sortie_balance`, `teletravail_days_balance`) VALUES
(1, 1, 'fathallah', 'seifeddine', '1999-04-04', 'seifeddine.fathallah@csi-corporation.com', 'seifeddine@gmail.com', '7845', '9562623', '716', 'Bizerte', 'TN', '48548545', 'Célibataire', 0, 1, 1, 5, '8751', '2020-04-04', '23', NULL, NULL, NULL, NULL, '95526', '2020-04-04', '2025-04-04', '79865', '2024-07-10 09:29:18', '2024-08-08 09:42:43', 1, NULL, NULL, NULL, 'employees/B014vrrVxWp2VhYNGMp1GBZey0kdWivvAq7c1Gue.png', 2.00, 5),
(3, 3, 'eazu', 'ijar', '1999-01-04', 'ahf@csi-corporation.com', 'aufh@gmail.com', '89645', '8532', '87571', 'Jendouba', 'TN', '278671', 'Célibataire', 0, 1, 1, 5, '864', '2020-04-04', '32', '2772uygf', '2021-10-01', '2028-10-01', 'bgfvdc', '984', '2020-09-08', '2025-09-08', '1826', '2024-07-12 11:09:03', '2024-08-08 09:27:02', 1, '0 ans, 1 mois', '2024-08-08', '2024-09-28', 'employees/1EoLHGQDG5rwOElXiaLO5M7cvzuIaviTPYRnJYlG.png', 2.00, 5),
(4, 12, 'rr', 'rr', '1999-06-11', 'kharbecherayen19@csi-corporation.com', 'qfev@gmail.com', '11111', '11447788', '7000', 'Bizerte', 'TN', 'bizerte', 'Célibataire', 0, 1, 1, 5, '11447788', '2023-02-11', '23', '2577', '2023-02-11', '2026-02-10', 'gjhrsg', NULL, NULL, NULL, NULL, '2024-07-24 07:53:57', '2024-07-24 07:53:57', NULL, '1 ans, 9 mois', '2024-07-27', '2026-05-24', NULL, 2.00, 5),
(5, 14, 'rr', 'rr.rr', '2003-09-20', 'rayen.kharbech1@csi-corporation.com', 'emna@gmail.com', '11111', '11447788', '7000', 'Bizerte', 'TN', 'ain mariem', 'Célibataire', 0, 1, 4, 4, '11447788', '2020-10-10', '23', '2577666', '2020-10-10', '2026-12-04', 'ttrree', '11223366', '2020-10-10', '2026-10-10', '2191', '2024-07-29 07:31:28', '2024-07-29 07:31:28', 1, '1 ans, 10 mois', '2024-08-04', '2026-06-17', NULL, 2.00, 5),
(6, 21, 'rrbbb', 'rrbbbbb', '2000-10-10', 'rayen.kharbech11@csi-corporation.com', 'rayen.kharbech44@gmail.com', '1414145', '11422020', '581', 'Oran', 'DZ', 'nf c', 'Célibataire', 0, 1, 1, 5, '25747250', '2020-02-10', '31', 'vrf', '2020-10-10', '2026-10-10', 'kj hgf', '2754KJHG', '2020-01-01', '2026-02-01', '2223', '2024-08-01 09:36:25', '2024-08-01 11:05:15', 1, '0 ans, 4 mois', '2024-08-27', '2024-12-13', NULL, 2.00, 5),
(7, 22, 'kharbeche', 'rayen', '1997-11-22', 'rayen.kharbech24@csi-corporation.com', 'rayen.kharbech1@gmail.com', '1414145', '11447788', '7000', 'Bizerte', 'TN', 'vs', 'Célibataire', 0, 1, 1, 5, '25747250', '2020-10-10', '23', 'bgv', '2020-01-01', '2026-01-01', 'ml:kj,hg', '2754KJHG', '2020-01-01', '2026-01-01', '2192', '2024-08-01 11:37:50', '2024-08-05 07:25:36', 1, '1 ans, 2 mois', '2024-08-22', '2025-10-24', 'employees/cqIokj5lmCmHRHkg20nQrzej03T4mFh19zSmVBVp.jpg', 2.00, 5),
(8, 27, 'kharbeche', 'rayenn', '1999-06-11', 'rayen.kharbech@csi-corporation.com', 'rayen.kharbech@gmail.com', '69', '11447788', '766', 'Bizerte', 'TN', '2865', 'Célibataire', 0, 1, 1, 5, '11423038', '2019-02-01', '23', '2577666', '2020-01-01', '2026-01-01', 'gjhrsg', '28328hgfv', '2020-01-01', '2026-02-01', '2223', '2024-08-02 12:08:44', '2024-08-08 09:48:28', 1, NULL, NULL, NULL, 'employees/u3R6vT9J0Tm8MAw4LSQMIMxeQOIOFsD2HIIhvQJA.png', 2.00, 5),
(9, 28, 'mokrani', 'mohamed', '1999-04-04', 'mohamed.mokrani@csi-corporation.com', 'yrhzeajf@gmail.com', '84512', '522432', '542552', 'Bizerte', 'TN', 'ezfl542', 'Marié(e)', 0, 1, 1, 5, '5412', '2020-04-05', '23', '52fer45', '2020-04-01', '2025-04-04', '56e2f', '845rfe45', '2020-04-04', '2025-04-04', '1826', '2024-08-14 09:39:30', '2024-08-14 09:39:30', 4, '0 ans, 1 mois', '2024-08-14', '2024-09-14', 'employees/ttpnteVQ3cOTyyMhxyE5JdQK9tYAscLzBT8JzO0m.png', 2.00, 5),
(10, 29, 'arza', 'zerarz', '1999-04-04', 'arze.zear@csi-corporation.com', 'zeruj@gmail.com', '525626', '52243225', '8454', 'Bizerte', 'TN', 'azer', 'Célibataire', 0, 1, 1, 5, '87562345', '2020-04-04', '23', '56e2ze78r', '2020-04-04', '2025-04-04', '5e2fd', 'er85f2', '2020-04-04', '2025-04-04', '1826', '2024-08-14 12:34:17', '2024-08-14 12:34:17', 4, '0 ans, 1 mois', '2024-08-14', '2024-09-14', 'employees/6EBg5YOE2kPhJCRb9SeBsGzjcKENZfG38KqzFce8.png', 2.00, 5);

-- --------------------------------------------------------

--
-- Structure de la table `entites`
--

DROP TABLE IF EXISTS `entites`;
CREATE TABLE IF NOT EXISTS `entites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_fiscal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_siret` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_ape_naf` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `convention_collective` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifiant_etablissement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entites`
--

INSERT INTO `entites` (`id`, `nom`, `numero_fiscal`, `adresse`, `pays`, `contact`, `numero_siret`, `code_ape_naf`, `convention_collective`, `identifiant_etablissement`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Csi_tun', '7', '45', 'tunisie', '856', '7845', '7/845', '7846', '/784', NULL, '2024-07-10 09:27:16', '2024-08-01 08:40:52'),
(8, 'Csi-fr', 'gbg x', 'f x', 'France', 'gvfd', 'gfv', 'x vc', 'vc', 'fd', NULL, '2024-07-29 10:13:51', '2024-08-01 08:41:05'),
(9, 'Csi-TNN', 'gbg x', 'f x', 'France', 'gvfd', 'gfv', 'x vc', 'vc', 'BGV X', NULL, '2024-08-01 08:37:09', '2024-08-01 08:37:09'),
(10, 'cszf', '852485', '4er55zr', 'tunisie', '82131545', '84512', '8465', 'azre', 'sqf', 'entite_images/SLbCdzs4Rs1MwaBFoflpj7xf1VfEMOkjecGGu1FU.png', '2024-08-07 09:04:19', '2024-08-07 09:04:19');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start_time`, `end_time`, `location`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'ezrzre', 'zarzer', '2024-08-14', '2024-08-14', 'zear', 'zar', 1, '2024-08-14 13:01:53', '2024-08-14 13:01:53'),
(9, 'aerac', 'arazx', '2024-08-15', '2024-08-15', 'razrxaxra', 'axerax', 1, '2024-08-15 06:13:37', '2024-08-15 06:13:37'),
(8, 'aerac', 'arazx', '2024-08-15', '2024-08-15', 'razrxaxra', 'axerax', 1, '2024-08-15 06:12:43', '2024-08-15 06:12:43'),
(7, 'meetings', 'rh', '2024-08-15', '2024-08-15', 'ezrz', 'zzer', 1, '2024-08-15 06:05:31', '2024-08-15 06:05:31'),
(10, 'aerac', 'arazx', '2024-08-15', '2024-08-15', 'razrxaxra', 'axerax', 1, '2024-08-15 06:14:25', '2024-08-15 06:14:25'),
(11, 'aerac', 'arazx', '2024-08-15', '2024-08-15', 'razrxaxra', 'axerax', 1, '2024-08-15 06:15:56', '2024-08-15 06:15:56'),
(12, 'aerac59f2d', 'arazx', '2024-08-15', '2024-08-15', 'razrxaxra', 'axerax', 1, '2024-08-15 06:18:22', '2024-08-15 06:18:22'),
(13, 'aerac59f2d', 'arazx', '2024-08-15', '2024-08-15', 'razrxaxra', 'axerax', 1, '2024-08-15 06:19:40', '2024-08-15 06:19:40'),
(14, 'raraax', 'zarxaz', '2024-08-15', '2024-08-15', 'zearx', 'axre', 1, '2024-08-15 06:20:04', '2024-08-15 06:20:04'),
(15, 'meet', 'xazxa', '2024-08-16', '2024-08-16', 'ear', 'zer', 1, '2024-08-16 10:43:37', '2024-08-16 10:43:37');

-- --------------------------------------------------------

--
-- Structure de la table `event_employee`
--

DROP TABLE IF EXISTS `event_employee`;
CREATE TABLE IF NOT EXISTS `event_employee` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_employee_event_id_foreign` (`event_id`),
  KEY `event_employee_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_employee`
--

INSERT INTO `event_employee` (`id`, `event_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 7, 8, NULL, NULL),
(2, 8, 1, NULL, NULL),
(3, 9, 1, NULL, NULL),
(4, 10, 1, NULL, NULL),
(5, 11, 1, NULL, NULL),
(6, 12, 1, NULL, NULL),
(7, 13, 1, NULL, NULL),
(8, 14, 1, NULL, NULL),
(9, 15, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `failed_logins_email_index` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `failed_logins`
--

INSERT INTO `failed_logins` (`id`, `email`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 'rayen.kharbech@csi-corporation.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0', '2024-08-05 06:33:18', '2024-08-05 06:33:18'),
(2, 'rayen.kharbech@csi-corporation.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0', '2024-08-05 06:38:46', '2024-08-05 06:38:46'),
(3, 'rayen.kharbech@csi-corporation.com', '192.168.100.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0', '2024-08-05 08:09:00', '2024-08-05 08:09:00');

-- --------------------------------------------------------

--
-- Structure de la table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
CREATE TABLE IF NOT EXISTS `holidays` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `holidays`
--

INSERT INTO `holidays` (`id`, `name`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'fete de revolution', '2024-08-23', '2024-08-23', '2024-08-16 09:31:15', '2024-08-16 09:31:15');

-- --------------------------------------------------------

--
-- Structure de la table `intervention_requests`
--

DROP TABLE IF EXISTS `intervention_requests`;
CREATE TABLE IF NOT EXISTS `intervention_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `intervention_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervention_requests`
--

INSERT INTO `intervention_requests` (`id`, `employee_id`, `description`, `request_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'HRYTG', '2024-08-09', 'rejected', '2024-07-31 08:29:08', '2024-08-06 12:29:33'),
(2, 5, 'fv', '2024-08-02', 'approved', '2024-07-31 08:54:16', '2024-08-02 07:40:32'),
(3, 2, 'ndhgfb', '2024-08-09', 'approved', '2024-08-02 07:40:49', '2024-08-06 12:29:38'),
(4, 1, 'sdfgh', '2024-08-08', 'rejected', '2024-08-08 12:09:40', '2024-08-08 12:09:48'),
(5, 1, 'eazrezr', '2024-08-16', 'approved', '2024-08-16 11:12:28', '2024-08-16 11:12:36');

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_native` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `authCode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authCount` int NOT NULL,
  `authStatus` tinyint(1) NOT NULL DEFAULT '0',
  `authDate` datetime DEFAULT NULL,
  `requestDate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laravel2step_userid_index` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `laravel2step`
--

INSERT INTO `laravel2step` (`id`, `userId`, `authCode`, `authCount`, `authStatus`, `authDate`, `requestDate`, `created_at`, `updated_at`) VALUES
(1, 1, '2DT5', 0, 1, '2024-08-14 08:31:49', NULL, '2024-07-10 09:24:51', '2024-08-14 07:31:49'),
(2, 2, 'Y7WA', 0, 1, '2024-07-11 10:23:13', NULL, '2024-07-10 09:43:55', '2024-07-11 09:23:13'),
(3, 4, '7PP6', 0, 1, '2024-07-18 08:35:01', NULL, '2024-07-18 07:34:40', '2024-07-18 07:35:01'),
(4, 5, '1UON', 0, 1, '2024-07-19 07:43:22', NULL, '2024-07-19 06:43:05', '2024-07-19 06:43:22'),
(5, 6, 'VWE1', 0, 1, '2024-07-22 09:32:20', NULL, '2024-07-22 08:32:02', '2024-07-22 08:32:20'),
(6, 7, '9083', 0, 1, '2024-07-22 12:49:39', NULL, '2024-07-22 11:49:01', '2024-07-22 11:49:39'),
(7, 8, '65S4', 0, 1, '2024-07-23 07:22:41', NULL, '2024-07-23 06:22:24', '2024-07-23 06:22:41'),
(8, 9, 'KII4', 0, 1, '2024-07-23 12:13:48', NULL, '2024-07-23 11:13:30', '2024-07-23 11:13:48'),
(9, 10, 'AV3Q', 0, 1, '2024-07-24 07:21:43', NULL, '2024-07-24 06:21:24', '2024-07-24 06:21:43'),
(10, 11, '7Q37', 0, 1, '2024-07-24 08:20:53', NULL, '2024-07-24 07:20:37', '2024-07-24 07:20:53'),
(11, 13, 'U78A', 0, 1, '2024-07-26 07:40:17', NULL, '2024-07-26 06:39:44', '2024-07-26 06:40:17'),
(12, 14, 'T4C8', 0, 1, '2024-07-29 07:34:58', NULL, '2024-07-29 06:34:24', '2024-07-29 06:34:58'),
(13, 16, '1628', 0, 1, '2024-07-31 07:55:04', NULL, '2024-07-31 06:54:48', '2024-07-31 06:55:04'),
(14, 17, '283J', 0, 1, '2024-07-31 09:11:53', NULL, '2024-07-31 08:11:21', '2024-07-31 08:11:53'),
(15, 19, '54AI', 0, 1, '2024-07-31 20:16:32', NULL, '2024-07-31 19:16:14', '2024-07-31 19:16:32'),
(16, 20, '7B8T', 0, 1, '2024-08-01 07:42:37', NULL, '2024-08-01 06:42:12', '2024-08-01 06:42:37'),
(17, 23, '3IU9', 0, 1, '2024-08-02 07:49:39', NULL, '2024-08-02 06:49:06', '2024-08-02 06:49:39'),
(18, 24, 'NW9G', 1, 1, '2024-08-02 09:50:59', '2024-08-02 09:52:21', '2024-08-02 08:50:39', '2024-08-02 08:52:21'),
(19, 25, 'I9KU', 0, 1, '2024-08-02 12:11:40', NULL, '2024-08-02 11:11:19', '2024-08-02 11:11:40'),
(20, 26, 'FONJ', 0, 1, '2024-08-02 12:18:01', NULL, '2024-08-02 11:17:42', '2024-08-02 11:18:01'),
(21, 27, '77UQ', 0, 1, '2024-08-06 07:35:19', NULL, '2024-08-02 11:20:55', '2024-08-06 06:35:19');

-- --------------------------------------------------------

--
-- Structure de la table `leave_balances`
--

DROP TABLE IF EXISTS `leave_balances`;
CREATE TABLE IF NOT EXISTS `leave_balances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `leave_type_id` bigint UNSIGNED NOT NULL,
  `remaining_days` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_balances_employee_id_foreign` (`employee_id`),
  KEY `leave_balances_leave_type_id_foreign` (`leave_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leave_balances`
--

INSERT INTO `leave_balances` (`id`, `employee_id`, `leave_type_id`, `remaining_days`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 4, '2024-08-12 06:51:44', '2024-08-12 11:14:28'),
(2, 3, 3, 5, '2024-08-12 06:51:44', '2024-08-12 06:51:44'),
(3, 4, 3, 5, '2024-08-12 06:51:44', '2024-08-12 06:51:44'),
(4, 5, 3, 5, '2024-08-12 06:51:44', '2024-08-12 06:51:44'),
(5, 6, 3, 5, '2024-08-12 06:51:44', '2024-08-12 06:51:44'),
(6, 7, 3, 5, '2024-08-12 06:51:44', '2024-08-12 06:51:44'),
(7, 8, 3, 5, '2024-08-12 06:51:44', '2024-08-12 06:51:44'),
(8, 1, 4, 1, '2024-08-12 11:20:25', '2024-08-16 09:44:00'),
(9, 3, 4, 22, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(10, 4, 4, 22, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(11, 5, 4, 22, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(12, 6, 4, 22, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(13, 7, 4, 22, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(14, 8, 4, 22, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(15, 1, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(16, 3, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(17, 4, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(18, 5, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(19, 6, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(20, 7, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(21, 8, 6, 8520, '2024-08-14 09:10:21', '2024-08-14 09:10:21'),
(22, 9, 1, 2, '2024-08-14 09:39:30', '2024-08-14 09:39:30'),
(23, 9, 2, 5, '2024-08-14 09:39:30', '2024-08-14 09:39:30'),
(24, 9, 3, 4, '2024-08-14 09:39:30', '2024-08-14 09:39:30'),
(25, 9, 4, 22, '2024-08-14 09:39:30', '2024-08-14 09:39:30'),
(26, 9, 6, 8520, '2024-08-14 09:39:30', '2024-08-14 09:39:30'),
(27, 10, 1, 2, '2024-08-14 12:34:17', '2024-08-14 12:34:17'),
(28, 10, 2, 5, '2024-08-14 12:34:17', '2024-08-14 12:34:17'),
(29, 10, 3, 4, '2024-08-14 12:34:17', '2024-08-14 12:34:17'),
(30, 10, 4, 22, '2024-08-14 12:34:17', '2024-08-14 12:34:17'),
(31, 10, 6, 8520, '2024-08-14 12:34:17', '2024-08-14 12:34:17');

-- --------------------------------------------------------

--
-- Structure de la table `leave_requests`
--

DROP TABLE IF EXISTS `leave_requests`;
CREATE TABLE IF NOT EXISTS `leave_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `leave_type_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `medical_certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_upload_deadline` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_requests_employee_id_foreign` (`employee_id`),
  KEY `leave_requests_leave_type_id_foreign` (`leave_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type_id`, `start_date`, `end_date`, `reason`, `medical_certificate`, `certificate_upload_deadline`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-08-09', '2024-08-31', '852', 'medical_certificates/OklKiScE89HL69ZXGDCIIjKdny2W1IsVwZEoHgfH.png', NULL, 'rejected', '2024-08-09 09:41:23', '2024-08-12 07:05:17'),
(2, 1, 2, '2024-08-09', '2024-09-01', 'zae', 'C:\\wamp64\\tmp\\phpC90.tmp', NULL, 'rejected', '2024-08-09 09:56:31', '2024-08-13 06:01:18'),
(3, 1, 2, '2024-08-09', '2024-08-10', '4512', NULL, NULL, 'rejected', '2024-08-09 10:09:36', '2024-08-13 06:01:25'),
(4, 1, 2, '2024-08-09', '2024-08-10', 'zad', NULL, NULL, 'rejected', '2024-08-09 10:16:02', '2024-08-13 06:01:08'),
(5, 1, 2, '2024-08-09', '2024-08-10', 'adzazd', NULL, '2024-08-11 10:18:28', 'rejected', '2024-08-09 10:18:28', '2024-08-13 06:00:44'),
(6, 1, 3, '2024-08-12', '2024-08-12', 'ryeztz', 'medical_certificates/uMi6yMcf4I4FySFziiuISnOKGbkFgFyibsnVT4uG.png', '2024-08-14 11:04:40', 'approved', '2024-08-12 11:04:40', '2024-08-12 11:09:00'),
(7, 1, 3, '2024-08-12', '2024-08-12', 'zera', 'medical_certificates/iMoe5unX8QNHXM2yH4HuG4J6m58s93ZgJM9L2ZoR.png', '2024-08-14 11:14:24', 'approved', '2024-08-12 11:14:24', '2024-08-12 11:14:28'),
(8, 1, 2, '2024-08-12', '2024-08-12', 'aerar', NULL, '2024-08-14 11:19:40', 'rejected', '2024-08-12 11:19:40', '2024-08-13 06:00:55'),
(9, 1, 4, '2024-08-12', '2024-08-14', 'zad', NULL, NULL, 'approved', '2024-08-12 12:11:11', '2024-08-12 12:11:18'),
(10, 1, 4, '2024-08-22', '2024-08-24', 'zad', NULL, NULL, 'approved', '2024-08-12 12:44:42', '2024-08-12 12:44:47'),
(11, 1, 4, '2024-08-23', '2024-08-24', 'zasd', NULL, NULL, 'rejected', '2024-08-12 12:45:10', '2024-08-12 12:45:13'),
(12, 1, 4, '2024-08-13', '2024-08-13', 'aezra', NULL, NULL, 'approved', '2024-08-13 06:19:17', '2024-08-13 06:35:01'),
(13, 1, 4, '2024-08-13', '2024-08-13', 'aezra', NULL, NULL, 'approved', '2024-08-13 06:20:25', '2024-08-13 06:34:49'),
(14, 1, 4, '2024-08-13', '2024-08-13', 'aezra', NULL, NULL, 'rejected', '2024-08-13 06:21:41', '2024-08-13 06:34:35'),
(15, 1, 4, '2024-08-13', '2024-08-13', 'aezra', NULL, NULL, 'rejected', '2024-08-13 06:23:28', '2024-08-13 06:24:22'),
(16, 1, 4, '2024-08-13', '2024-08-13', 'azer', NULL, NULL, 'approved', '2024-08-13 06:49:34', '2024-08-13 06:49:52'),
(17, 1, 2, '2024-08-13', '2024-08-13', '8452', NULL, '2024-08-15 07:20:24', 'pending', '2024-08-13 07:20:24', '2024-08-13 07:20:24'),
(18, 1, 4, '2024-08-13', '2024-08-13', '7452', NULL, NULL, 'approved', '2024-08-13 07:25:36', '2024-08-13 07:25:44'),
(19, 1, 4, '2024-08-13', '2024-08-13', '845', NULL, NULL, 'approved', '2024-08-13 08:04:40', '2024-08-13 08:04:55'),
(20, 1, 4, '2024-08-13', '2024-08-13', 'ezrdz', NULL, NULL, 'rejected', '2024-08-13 10:24:33', '2024-08-13 10:24:44'),
(21, 1, 3, '2024-08-14', '2024-08-14', 'arzeazr', 'medical_certificates/RMNc1XyBbhIvEuTKmoBER9cCU6VuUphYW5xvojcU.png', '2024-08-16 06:33:26', 'pending', '2024-08-14 06:33:26', '2024-08-14 06:33:26'),
(22, 1, 3, '2024-08-15', '2024-08-15', 'rzre', 'medical_certificates/URwoAIkUe52FnWKQ41R8ukeqp4LY5lqA5BQwYGYd.png', '2024-08-16 06:38:58', 'pending', '2024-08-14 06:38:58', '2024-08-14 06:38:58'),
(23, 1, 3, '2024-08-14', '2024-08-14', 'dsd', 'public/medical_certificates/RgSbAiGxZ7jkJVh5jm1sLyr9cJp1hMN1lavSy2cw.png', '2024-08-16 06:45:29', 'pending', '2024-08-14 06:45:29', '2024-08-14 06:45:29'),
(24, 1, 4, '2024-08-14', '2024-08-14', 'ezare', NULL, NULL, 'rejected', '2024-08-14 07:39:48', '2024-08-14 07:39:58'),
(25, 1, 4, '2024-08-14', '2024-08-14', 'razeraze', NULL, NULL, 'approved', '2024-08-14 07:41:35', '2024-08-14 07:41:44'),
(26, 1, 4, '2024-08-14', '2024-08-14', 'aze', NULL, NULL, 'rejected', '2024-08-14 07:47:15', '2024-08-14 07:47:25'),
(27, 1, 3, '2024-08-14', '2024-08-14', '5167', 'public/medical_certificates/4XN58iUSI7S8YRDKaKPi3D65We0z6WMMv2A8g3c8.png', '2024-08-16 07:53:43', 'pending', '2024-08-14 07:53:43', '2024-08-14 07:53:43'),
(28, 1, 4, '2024-08-14', '2024-08-14', 'zera', NULL, NULL, 'rejected', '2024-08-14 09:11:23', '2024-08-14 09:11:54'),
(29, 1, 4, '2024-08-14', '2024-08-14', 'raz', NULL, NULL, 'approved', '2024-08-14 09:12:17', '2024-08-14 09:12:25'),
(30, 1, 4, '2024-08-14', '2024-08-14', 'araz', NULL, NULL, 'approved', '2024-08-14 11:09:52', '2024-08-14 11:10:08'),
(31, 1, 4, '2024-08-14', '2024-08-18', 'ezar', NULL, NULL, 'approved', '2024-08-14 11:52:11', '2024-08-14 12:08:33'),
(32, 1, 4, '2024-08-14', '2024-08-18', 'arza', NULL, NULL, 'approved', '2024-08-14 11:52:14', '2024-08-14 11:52:26'),
(33, 1, 4, '2024-08-02', '2024-08-04', 'xtc', NULL, NULL, 'approved', '2024-08-14 11:54:10', '2024-08-14 11:55:20'),
(34, 1, 4, '2024-08-28', '2024-08-31', 'adds', NULL, NULL, 'approved', '2024-08-14 12:06:04', '2024-08-14 12:06:13'),
(35, 1, 4, '2024-08-30', '2024-09-04', 'zre', NULL, NULL, 'approved', '2024-08-14 12:37:03', '2024-08-14 12:37:12'),
(36, 1, 4, '2024-08-23', '2024-08-26', 'azer', NULL, NULL, 'approved', '2024-08-16 09:43:41', '2024-08-16 09:44:00'),
(37, 1, 4, '2024-08-23', '2024-08-23', 'aear', NULL, NULL, 'approved', '2024-08-16 09:45:56', '2024-08-16 09:46:05'),
(38, 1, 4, '2024-08-23', '2024-08-23', 'ezrte', NULL, NULL, 'approved', '2024-08-16 10:47:50', '2024-08-16 10:48:06');

-- --------------------------------------------------------

--
-- Structure de la table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_days` int DEFAULT NULL,
  `requires_medical_certificate` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `leave_types_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `max_days`, `requires_medical_certificate`, `created_at`, `updated_at`) VALUES
(1, 'zearlmfdlx;a', 2, 0, '2024-08-09 09:05:16', '2024-08-09 09:05:16'),
(2, 'maladie', 5, 1, '2024-08-09 09:12:13', '2024-08-09 09:12:13'),
(3, 'sick', 4, 1, '2024-08-12 06:51:44', '2024-08-12 11:09:00'),
(4, 'annuel', 22, 0, '2024-08-12 11:20:25', '2024-08-12 11:20:25'),
(6, 'azer', 8520, 1, '2024-08-14 09:10:21', '2024-08-14 09:10:21');

-- --------------------------------------------------------

--
-- Structure de la table `loan_requests`
--

DROP TABLE IF EXISTS `loan_requests`;
CREATE TABLE IF NOT EXISTS `loan_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` enum('Prêt','Avances') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('En attente','Approuvé','Rejeté') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En attente',
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `employee_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_requests_user_id_foreign` (`user_id`),
  KEY `loan_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `user_id`, `type`, `amount`, `status`, `comments`, `employee_id`, `created_at`, `updated_at`) VALUES
(2, 27, 'Prêt', 100.00, 'Approuvé', 'DGC FD XC', 8, '2024-08-02 12:28:49', '2024-08-06 06:37:11'),
(3, 27, 'Avances', 400.00, 'Approuvé', 'RGDBDGBVX', 8, '2024-08-02 12:40:03', '2024-08-06 12:52:33'),
(4, 1, 'Prêt', 0.00, 'Rejeté', NULL, 1, '2024-08-06 12:51:42', '2024-08-06 12:52:50'),
(5, 1, 'Prêt', 1.00, 'Approuvé', 'zaeraz', 1, '2024-08-07 07:55:08', '2024-08-07 07:55:08'),
(6, 1, 'Avances', 542.00, 'Rejeté', 'ezr', 1, '2024-08-16 07:49:10', '2024-08-16 11:07:02'),
(7, 1, 'Prêt', 50.00, 'Approuvé', 'aezr', 1, '2024-08-16 10:52:46', '2024-08-16 10:52:46'),
(8, 1, 'Prêt', 50.00, 'Approuvé', 'aezr', 1, '2024-08-16 10:53:06', '2024-08-16 11:06:51');

-- --------------------------------------------------------

--
-- Structure de la table `material_requests`
--

DROP TABLE IF EXISTS `material_requests`;
CREATE TABLE IF NOT EXISTS `material_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `material_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `material_requests`
--

INSERT INTO `material_requests` (`id`, `employee_id`, `material_name`, `description`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'f g', 'fx', 100, 'approved', '2024-08-02 07:58:36', '2024-08-02 07:58:43'),
(2, 8, 'gbd', 'fd', 10, 'approved', '2024-08-05 06:40:16', '2024-08-05 08:40:52'),
(3, 8, 'NHGB', 'gbvd', 10, 'approved', '2024-08-05 08:44:48', '2024-08-05 08:44:54'),
(4, 8, 'NHGB', 'v cw', 10, 'approved', '2024-08-05 08:52:47', '2024-08-05 08:52:53'),
(5, 8, 'NHGB', 'qdw c', 20, 'approved', '2024-08-05 08:53:45', '2024-08-05 08:59:19'),
(6, 8, 'NHGB', 'v d wxc', 20, 'rejected', '2024-08-05 09:01:47', '2024-08-06 12:26:06'),
(7, 1, 'laptop', 'fzea', 1, 'rejected', '2024-08-16 11:34:05', '2024-08-16 11:34:20');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(46, '2024_07_01_125420_create_loan_requests_table', 14),
(26, '2024_07_01_125439_create_approval_histories_table', 1),
(27, '2024_07_09_130635_add_currency_to_loan_requests_table', 1),
(47, '2024_07_10_111934_add_image_to_employees_table', 14),
(48, '2024_07_11_082909_add_authorization_balances_to_employees', 14),
(49, '2024_07_11_121916_add_start_time_to_authorization_requests_table', 14),
(50, '2024_07_12_081737_create_player_ids_table', 14),
(51, '2024_07_12_105412_create_subscriptions_table', 14),
(52, '2024_07_15_082148_create_default_balances_table', 14),
(53, '2024_07_15_085659_create_temporary_balances_table', 14),
(54, '2024_07_15_091300_create_period_definitions_table', 14),
(55, '2024_07_15_091631_add_period_definition_id_to_temporary_balances_table', 14),
(38, '2024_07_17_100454_employee-update_table', 11),
(39, '2024_07_17_101229_employee-update_table', 12),
(40, '2024_07_17_101730_employee-update2_table', 13),
(56, '2024_07_17_090554_add_image_to_entites_table', 14),
(57, '2024_07_17_094914_updatetype-contrat_table', 15),
(58, '2024_07_26_111235_create_intervention_requests_table', 16),
(59, '2024_07_26_132748_create_supply_requests_table', 16),
(60, '2024_07_29_074553_create_material_requests_table', 16),
(61, '2024_07_29_090044_create_specific_requests_table', 16),
(62, '0000_00_00_000000_create_websockets_statistics_entries_table', 17),
(63, '2024_08_06_113636_create_divers_table', 17),
(64, '2024_08_06_113810_create_divers_table', 18),
(65, '2024_08_07_102616_add_onesignal_user_id_to_users_table', 19),
(66, '2024_08_08_082916_create_push_subscriptions_table', 20),
(67, '2024_08_09_092650_create_leave_types_table', 21),
(68, '2024_08_09_092811_create_leave_requests_table', 21),
(69, '2024_08_09_103354_add_medical_certificate_to_leave_requests_table', 22),
(70, '2024_08_09_110713_add_certificate_upload_deadline_to_leave_requests_table', 23),
(71, '2024_08_12_074633_create_leave_balances_table', 24),
(72, '2024_08_14_120022_create_events_table', 25),
(73, '2024_08_14_134344_create_event_employee_table', 26),
(74, '2024_08_16_102414_create_holidays_table', 27);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `player_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `titre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postes_departement_id_foreign` (`departement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id`, `titre`, `departement_id`, `created_at`, `updated_at`) VALUES
(5, 'ieajf', 1, '2024-07-18 10:19:51', '2024-07-18 10:19:51'),
(4, 'consulant technique', 4, '2024-07-18 10:18:26', '2024-07-29 06:37:43'),
(6, 'consulant fonctionel', 1, '2024-07-29 10:16:35', '2024-07-29 10:16:35'),
(7, 'finance', 1, '2024-07-29 10:17:43', '2024-07-29 10:17:43');

-- --------------------------------------------------------

--
-- Structure de la table `push_subscriptions`
--

DROP TABLE IF EXISTS `push_subscriptions`;
CREATE TABLE IF NOT EXISTS `push_subscriptions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `subscription_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_subscriptions_subscription_id_unique` (`subscription_id`),
  KEY `push_subscriptions_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `push_subscriptions`
--

INSERT INTO `push_subscriptions` (`id`, `user_id`, `subscription_id`, `created_at`, `updated_at`) VALUES
(1, 1, '6b76d4b0-3285-4f2f-a3ad-40491b449ec3', '2024-08-08 08:28:29', '2024-08-08 08:28:29'),
(2, 1, '4c5c7e7a-3d5b-47b9-ac1e-ba94d96d0c30', '2024-08-08 08:28:52', '2024-08-08 08:28:52'),
(3, 1, '3f65f4b3-07c8-4703-8f26-2c9a840ce527', '2024-08-08 09:46:53', '2024-08-08 09:46:53'),
(4, 1, '675d874b-1145-47c4-9d10-907b8d55e298', '2024-08-09 10:57:32', '2024-08-09 10:57:32');

-- --------------------------------------------------------

--
-- Structure de la table `specific_requests`
--

DROP TABLE IF EXISTS `specific_requests`;
CREATE TABLE IF NOT EXISTS `specific_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `request_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specific_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specific_requests`
--

INSERT INTO `specific_requests` (`id`, `employee_id`, `request_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'TY', 'yvgihbjkml', 'rejected', '2024-08-02 07:02:51', '2024-08-12 07:04:35'),
(2, 8, 'TY', 'bvhcgbfdc', 'approved', '2024-08-02 12:12:13', '2024-08-02 12:12:19'),
(3, 8, 'fgbv', 'bgfv', 'approved', '2024-08-05 06:39:58', '2024-08-05 08:03:04'),
(4, 1, 'raz', 'eazr', 'approved', '2024-08-06 12:17:13', '2024-08-06 12:24:46'),
(5, 1, 'ezr', 'zer', 'approved', '2024-08-16 11:44:22', '2024-08-16 11:44:34');

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `subscription_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_subscription_id_unique` (`subscription_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `supply_requests`
--

DROP TABLE IF EXISTS `supply_requests`;
CREATE TABLE IF NOT EXISTS `supply_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `item_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supply_requests_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `supply_requests`
--

INSERT INTO `supply_requests` (`id`, `employee_id`, `item_name`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'pc', 1, 'approved', '2024-08-16 11:29:16', '2024-08-16 11:29:29'),
(2, 8, 'cfg', 100, 'approved', '2024-08-02 12:10:03', '2024-08-02 12:10:09'),
(3, 8, 'h', 20, 'approved', '2024-08-05 06:40:38', '2024-08-06 12:26:22');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
CREATE TABLE IF NOT EXISTS `timezones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `onesignal_player_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_attempts` int NOT NULL DEFAULT '0',
  `onesignal_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `provider_token`, `remember_token`, `created_at`, `updated_at`, `onesignal_player_id`, `failed_attempts`, `onesignal_user_id`) VALUES
(1, 'seifeddine fathallah', 'seifeddine.fathallah', 'seifeddine.fathallah@csi-corporation.com', '2024-07-10 09:24:51', '$2y$10$3riMo58v/eL12SxVVNKmL.r14xLLE8/nE/wkLYQk2YfCB23p/Gnjm', NULL, NULL, NULL, 'dPr76Tun8EvSzsg4KJQ0H5NPBNsjuy34IODc2LqzKL8pBGALX3HAFOg2Fjye', '2024-07-10 09:24:34', '2024-08-08 07:26:00', '4c5c7e7a-3d5b-47b9-ac1e-ba94d96d0c30', 0, NULL),
(12, 'rr', 'rr.rr', 'kharbecherayen19@csi-corporation.com', NULL, '$2y$10$OoxM5wN8W4B11JOCMou0heKHGNeCvCaHTfhm8ldBmIJ03LkFtdzjC', NULL, NULL, NULL, NULL, '2024-07-24 07:53:57', '2024-07-24 07:53:57', NULL, 0, NULL),
(3, 'ijar eazu', 'ijar.eazu', 'ahf@csi-corporation.com', NULL, '$2y$10$HaEHR1DfUs.h89Sb1aZlQOhcA.U8eHMgPpsyfz7jljHrDSd4Alngm', NULL, NULL, NULL, NULL, '2024-07-12 11:09:03', '2024-07-12 11:09:03', NULL, 0, NULL),
(15, 'rr', 'rr.rr.rr', 'rayen.kharbech1@csi-corporation.com', NULL, '$2y$10$4IB8pHosgilmiQtzUthdSuaJKoUVGS7WDTlZbiXK8N2NZK9kuJO9G', NULL, NULL, NULL, NULL, '2024-07-29 07:31:28', '2024-07-29 07:31:28', NULL, 0, NULL),
(21, 'rrbbb', 'rrbbbbb.rrbbb', 'rayen.kharbech14@csi-corporation.com', NULL, '$2y$10$PVCAkQtIzz12r9Y.WgYQ..H5l522Ot3gRZFSEDZiYpi9cJfdrDk3C', NULL, NULL, NULL, NULL, '2024-08-01 09:36:25', '2024-08-01 09:36:25', NULL, 0, NULL),
(22, 'rayen kharbeche', 'rayen.kharbeche', 'rayen.kharbech24@csi-corporation.com', NULL, '$2y$10$RPQA0zBJntr8ToW2qmXF8O5OP7NyKFPdGiknrfNpCA5ZQ7UshZJYi', NULL, NULL, NULL, NULL, '2024-08-01 11:37:50', '2024-08-05 07:24:43', NULL, 0, NULL),
(27, 'rayenn kharbeche', 'rayenn.kharbeche', 'rayen.kharbech@csi-corporation.com', '2024-08-02 11:20:55', '$2y$10$l3WViS2FBL3w8VnBR0GzMutuEv1kMCk9XCBIBEZ.Os0hr1L/ziOVm', NULL, NULL, NULL, NULL, '2024-08-02 11:20:44', '2024-08-05 06:56:32', NULL, 0, NULL),
(28, 'mokrani', 'mohamed.mokrani', 'mohamed.mokrani@csi-corporation.com', NULL, '$2y$10$l7PjIXsAIkqOIN/CRk0g6Ou1HOo9zfU57mVzu7zi/ldaJsVYklH2.', NULL, NULL, NULL, NULL, '2024-08-14 09:39:30', '2024-08-14 09:39:30', NULL, 0, NULL),
(29, 'arza', 'zerarz.arza', 'arze.zear@csi-corporation.com', NULL, '$2y$10$eWv/fN0tAegIY3.D40vDRulS/roK29UbYHE09V0mk5khVtbg9KQZi', NULL, NULL, NULL, NULL, '2024-08-14 12:34:17', '2024-08-14 12:34:17', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `websockets_statistics_entries`
--

DROP TABLE IF EXISTS `websockets_statistics_entries`;
CREATE TABLE IF NOT EXISTS `websockets_statistics_entries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
