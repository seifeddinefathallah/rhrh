-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 août 2024 à 10:45
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrative_requests`
--

INSERT INTO `administrative_requests` (`id`, `employee_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Attestation de travail', 'approuvé', '2024-07-10 09:31:50', '2024-07-26 09:31:47'),
(2, 2, 'Attestation de salaire', 'rejeté', '2024-07-18 10:26:08', '2024-08-02 11:47:22'),
(3, 2, 'Fiche de paie avec cachet', 'rejeté', '2024-07-29 10:25:23', '2024-07-29 10:26:47'),
(4, 2, 'Fiche de paie avec cachet', 'approuvé', '2024-07-29 10:25:26', '2024-07-29 10:26:34'),
(5, 1, 'Attestation de salaire', 'approuvé', '2024-07-29 10:38:37', '2024-08-02 11:42:35'),
(6, 1, 'Attestation de salaire', 'rejeté', '2024-08-02 11:51:54', '2024-08-02 11:52:05');

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authorization_requests`
--

INSERT INTO `authorization_requests` (`id`, `user_id`, `employee_id`, `type`, `start_date`, `start_time`, `end_date`, `duration_type`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Télétravail', '2024-07-10', '00:00:00', '2024-07-10', 'half day', '4 hours', 'approved', '2024-07-10 09:37:34', '2024-07-11 08:29:30'),
(3, 2, 2, 'Sortie', '2024-07-10', '00:00:00', '2024-07-10', 'hours', '1 hours', 'pending', '2024-07-10 09:44:35', '2024-08-05 07:18:27'),
(4, 1, 1, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-12', 'days', '29 hours', 'approved', '2024-07-11 07:56:36', '2024-07-11 09:10:40'),
(5, 1, 1, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '1 hours', 'approved', '2024-07-11 08:36:21', '2024-07-11 09:12:12'),
(6, 1, 1, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0 hours', 'approved', '2024-07-11 09:12:57', '2024-07-11 09:13:05'),
(7, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '1 days', 'approved', '2024-07-11 09:23:31', '2024-07-11 09:23:46'),
(8, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0 hours', 'rejected', '2024-07-11 09:29:47', '2024-08-05 07:17:49'),
(9, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0.5 hours', 'approved', '2024-07-11 09:34:01', '2024-07-11 09:34:08'),
(10, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '1 hours', 'approved', '2024-07-11 09:36:01', '2024-07-11 09:36:05'),
(11, 2, 2, 'Sortie', '2024-07-11', '00:00:00', '2024-07-11', 'hours', '0.5 hours', 'approved', '2024-07-11 09:38:13', '2024-07-11 09:38:19'),
(12, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '1 days', 'approved', '2024-07-11 09:42:04', '2024-08-05 07:02:11'),
(13, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-13', 'days', '3 days', 'rejected', '2024-07-11 09:42:32', '2024-08-05 07:00:59'),
(14, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 09:50:38', '2024-07-11 09:50:48'),
(15, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 09:52:21', '2024-07-11 09:52:27'),
(16, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'rejected', '2024-07-11 10:07:15', '2024-07-17 08:31:28'),
(17, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:47:46', '2024-07-11 10:47:55'),
(18, 4, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 10:51:26', '2024-07-11 10:51:32'),
(19, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:22:43', '2024-07-11 11:23:11'),
(20, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:24:53', '2024-07-11 11:24:57'),
(21, 4, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'approved', '2024-07-11 11:30:17', '2024-07-11 11:34:49'),
(22, 2, 2, 'Télétravail', '2024-07-11', '00:00:00', '2024-07-11', 'half day', '0.5 days', 'rejected', '2024-07-11 11:39:20', '2024-08-05 07:35:22'),
(23, 1, 1, 'Sortie', '2024-08-02', '00:00:00', '2024-08-02', 'hours', '0.5 hours', 'rejected', '2024-07-11 17:57:07', '2024-08-02 11:38:19'),
(26, 1, 1, 'Sortie', '2024-08-05', '10:28:00', '2024-08-05', 'hours', '1 hours', 'rejected', '2024-08-05 07:28:57', '2024-08-05 07:30:24');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `nom`, `prenom`, `date_naissance`, `email_professionnel`, `email_personnel`, `matricule`, `telephone`, `code_postal`, `ville`, `pays`, `adresse`, `situation_familiale`, `nombre_enfants`, `entite_id`, `departement_id`, `poste_id`, `cin_numero`, `cin_date_delivrance`, `state`, `carte_sejour_numero`, `carte_sejour_date_delivrance`, `carte_sejour_date_expiration`, `carte_sejour_type`, `passeport_numero`, `passeport_date_delivrance`, `passeport_date_expiration`, `passeport_delai_validite`, `created_at`, `updated_at`, `contract_type_id`, `duree_contrat`, `debut_contrat`, `fin_contrat`, `image`, `sortie_balance`, `teletravail_days_balance`) VALUES
(1, 1, 'fathallah', 'seifeddine', '1999-04-04', 'seifeddine.fathallah@csi-corporation.com', 'seifeddine@gmail.com', '7845', '9562623', '8752', 'Bizerte', 'TN', '75272', 'Célibataire', 0, 1, 1, 5, '8751', '2020-04-04', '23', NULL, NULL, NULL, NULL, '95526', '2020-04-04', '2025-04-04', '79865', '2024-07-10 09:29:18', '2024-08-02 10:05:51', 1, '0 ans, 3 mois', '2024-08-02', '2024-11-30', 'employees/nlShZUF34arlWHwcnFM2gdXiGeJQEkhggp0i89P5.png', 2.00, 5),
(2, 24, 'rayen', 'rayen', '1999-04-04', 'rayen.kharbech@csi-corporation.com', 'rayen.kharbech@gmail.com', '974865', '4784656', '4852', 'Carthage', 'TN', '48524152', 'Célibataire', 0, 1, 1, 5, '852', '2020-04-04', '11', NULL, NULL, NULL, NULL, '9562', '2020-04-04', '2025-04-04', '85632', '2024-07-10 09:40:39', '2024-08-02 10:04:07', 1, '0 ans, 1 mois', '2024-08-02', '2024-09-30', 'employees/lGB9jxXQUTVs2Xjc7G5P4LY1bxDrNSPcpoKWM18g.png', 2.00, 5),
(3, 3, 'eazu', 'ijar', '1999-01-04', 'ahf@csi-corporation.com', 'aufh@gmail.com', '89645', '8532', '785', 'Aïn el Bya', 'DZ', '8785', 'Célibataire', 0, 1, 1, 1, '864', '2020-04-04', '31', '8458', '2020-04-04', '2025-04-04', '485zer', '984', '2020-09-08', '2025-04-04', '1669', '2024-07-12 11:09:03', '2024-07-12 11:09:03', NULL, NULL, NULL, NULL, NULL, 2.00, 5),
(4, 12, 'rr', 'rr', '1999-06-11', 'kharbecherayen19@csi-corporation.com', 'qfev@gmail.com', '11111', '11447788', '7000', 'Bizerte', 'TN', 'bizerte', 'Célibataire', 0, 1, 1, 5, '11447788', '2023-02-11', '23', '2577', '2023-02-11', '2026-02-10', 'gjhrsg', NULL, NULL, NULL, NULL, '2024-07-24 07:53:57', '2024-07-24 07:53:57', NULL, '1 ans, 9 mois', '2024-07-27', '2026-05-24', NULL, 2.00, 5),
(5, 14, 'rr', 'rr.rr', '2003-09-20', 'rayen.kharbech1@csi-corporation.com', 'emna@gmail.com', '11111', '11447788', '7000', 'Bizerte', 'TN', 'ain mariem', 'Célibataire', 0, 1, 4, 4, '11447788', '2020-10-10', '23', '2577666', '2020-10-10', '2026-12-04', 'ttrree', '11223366', '2020-10-10', '2026-10-10', '2191', '2024-07-29 07:31:28', '2024-07-29 07:31:28', 1, '1 ans, 10 mois', '2024-08-04', '2026-06-17', NULL, 2.00, 5),
(6, 21, 'rrbbb', 'rrbbbbb', '2000-10-10', 'rayen.kharbech11@csi-corporation.com', 'rayen.kharbech44@gmail.com', '1414145', '11422020', '581', 'Oran', 'DZ', 'nf c', 'Célibataire', 0, 1, 1, 5, '25747250', '2020-02-10', '31', 'vrf', '2020-10-10', '2026-10-10', 'kj hgf', '2754KJHG', '2020-01-01', '2026-02-01', '2223', '2024-08-01 09:36:25', '2024-08-01 11:05:15', 1, '0 ans, 4 mois', '2024-08-27', '2024-12-13', NULL, 2.00, 5),
(7, 22, 'kharbeche', 'rayen', '1997-11-22', 'rayen.kharbech24@csi-corporation.com', 'rayen.kharbech1@gmail.com', '1414145', '11447788', '485545', 'Panjāb', 'AF', '45434', 'Célibataire', 0, 1, 1, 5, '25747250', '2020-10-10', 'BAM', 'I54754', '2020-01-01', '2026-01-01', 'ttrreehgj,hng v', '2754KJHG', '2020-01-01', '2026-01-01', '2192', '2024-08-01 11:37:50', '2024-08-02 10:22:51', 1, NULL, NULL, NULL, 'employees/IIgBivdUH9ldlwaUka5cC9fXlOZe9L1SO2CN2Hzs.png', 2.00, 5);

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
  `nom_employeur` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_employeur` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_siret` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_ape_naf` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `convention_collective` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifiant_etablissement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entites`
--

INSERT INTO `entites` (`id`, `nom`, `numero_fiscal`, `adresse`, `pays`, `contact`, `nom_employeur`, `adresse_employeur`, `numero_siret`, `code_ape_naf`, `convention_collective`, `identifiant_etablissement`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Csi_tun', '7', '45', 'tunisie', '856', 'csi', '8745', '7845', '7/845', '7846', '/784', NULL, '2024-07-10 09:27:16', '2024-08-01 08:40:52'),
(8, 'Csi-fr', 'gbg x', 'f x', 'France', 'gvfd', 'vecd', ',n bv', 'gfv', 'x vc', 'vc', 'fd', NULL, '2024-07-29 10:13:51', '2024-08-01 08:41:05'),
(9, 'Csi-TNN', 'gbg x', 'f x', 'France', 'gvfd', 'vecd', ',n bv', 'gfv', 'x vc', 'vc', 'BGV X', NULL, '2024-08-01 08:37:09', '2024-08-01 08:37:09');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervention_requests`
--

INSERT INTO `intervention_requests` (`id`, `employee_id`, `description`, `request_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'HRYTG', '2024-08-09', 'pending', '2024-07-31 08:29:08', '2024-07-31 08:29:08'),
(2, 5, 'fv', '2024-08-02', 'approved', '2024-07-31 08:54:16', '2024-08-02 07:40:32'),
(3, 2, 'ndhgfb', '2024-08-09', 'pending', '2024-08-02 07:40:49', '2024-08-02 07:40:49');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `laravel2step`
--

INSERT INTO `laravel2step` (`id`, `userId`, `authCode`, `authCount`, `authStatus`, `authDate`, `requestDate`, `created_at`, `updated_at`) VALUES
(1, 1, '0NL2', 0, 1, '2024-08-05 07:34:30', NULL, '2024-07-10 09:24:51', '2024-08-05 06:34:30'),
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
(18, 24, 'NW9G', 1, 1, '2024-08-02 09:50:59', '2024-08-02 09:52:21', '2024-08-02 08:50:39', '2024-08-02 08:52:21');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `user_id`, `type`, `amount`, `status`, `comments`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 20, 'Prêt', 200.00, 'En attente', 'zd', 2, '2024-08-01 12:45:46', '2024-08-02 11:26:52');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `material_requests`
--

INSERT INTO `material_requests` (`id`, `employee_id`, `material_name`, `description`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'f g', 'fx', 100, 'approved', '2024-08-02 07:58:36', '2024-08-02 07:58:43');

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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(61, '2024_07_29_090044_create_specific_requests_table', 16);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specific_requests`
--

INSERT INTO `specific_requests` (`id`, `employee_id`, `request_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'TY', 'yvgihbjkml', 'approved', '2024-08-02 07:02:51', '2024-08-02 07:58:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `supply_requests`
--

INSERT INTO `supply_requests` (`id`, `employee_id`, `item_name`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'ugkbhj', 200, 'approved', '2024-08-02 07:19:26', '2024-08-02 07:58:03');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `provider_token`, `remember_token`, `created_at`, `updated_at`, `onesignal_player_id`, `failed_attempts`) VALUES
(1, 'seifeddine fathallah', 'seifeddine.fathallah', 'seifeddine.fathallah@csi-corporation.com', '2024-07-10 09:24:51', '$2y$10$3riMo58v/eL12SxVVNKmL.r14xLLE8/nE/wkLYQk2YfCB23p/Gnjm', NULL, NULL, NULL, NULL, '2024-07-10 09:24:34', '2024-07-10 09:24:51', NULL, 0),
(12, 'rr', 'rr.rr', 'kharbecherayen19@csi-corporation.com', NULL, '$2y$10$OoxM5wN8W4B11JOCMou0heKHGNeCvCaHTfhm8ldBmIJ03LkFtdzjC', NULL, NULL, NULL, NULL, '2024-07-24 07:53:57', '2024-07-24 07:53:57', NULL, 0),
(3, 'ijar eazu', 'ijar.eazu', 'ahf@csi-corporation.com', NULL, '$2y$10$HaEHR1DfUs.h89Sb1aZlQOhcA.U8eHMgPpsyfz7jljHrDSd4Alngm', NULL, NULL, NULL, NULL, '2024-07-12 11:09:03', '2024-07-12 11:09:03', NULL, 0),
(24, 'rayen rayen', 'rayen.rayen', 'rayen.kharbech@csi-corporation.com', '2024-08-02 08:50:38', '$2y$10$GbvSOORFUTkSgbSGIS5G2u1rhT6NlP.Vdc9wCyX4ZgmWoccPK.Nc6', NULL, NULL, NULL, NULL, '2024-08-02 08:50:20', '2024-08-02 10:04:07', NULL, 0),
(15, 'rr', 'rr.rr.rr', 'rayen.kharbech1@csi-corporation.com', NULL, '$2y$10$4IB8pHosgilmiQtzUthdSuaJKoUVGS7WDTlZbiXK8N2NZK9kuJO9G', NULL, NULL, NULL, NULL, '2024-07-29 07:31:28', '2024-07-29 07:31:28', NULL, 0),
(21, 'rrbbb', 'rrbbbbb.rrbbb', 'rayen.kharbech14@csi-corporation.com', NULL, '$2y$10$PVCAkQtIzz12r9Y.WgYQ..H5l522Ot3gRZFSEDZiYpi9cJfdrDk3C', NULL, NULL, NULL, NULL, '2024-08-01 09:36:25', '2024-08-01 09:36:25', NULL, 0),
(22, 'rayen kharbeche', 'rayen.kharbeche', 'rayen.kharbech24@csi-corporation.com', NULL, '$2y$10$RPQA0zBJntr8ToW2qmXF8O5OP7NyKFPdGiknrfNpCA5ZQ7UshZJYi', NULL, NULL, NULL, NULL, '2024-08-01 11:37:50', '2024-08-02 10:08:33', NULL, 0);

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
