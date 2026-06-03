-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 juin 2026 à 20:09
-- Version du serveur : 8.4.3
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `onemorerep`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercises`
--

CREATE TABLE `exercises` (
  `id` int NOT NULL,
  `muscle_group_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `difficulty` enum('Débutant','Intermédiaire','Avancé') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exercises`
--

INSERT INTO `exercises` (`id`, `muscle_group_id`, `name`, `description`, `difficulty`, `image`) VALUES
(1, 1, 'Développé couché barre', 'Exercice polyarticulaire fondamental pour les pectoraux. Allongé sur un banc plat, descendre la barre jusqu\'au niveau de la poitrine puis pousser vers le haut. Sollicite également les triceps et les épaules.', 'Intermédiaire', 'Pectoraux/Bench_press.webp'),
(2, 1, 'Presse à pectoraux (machine)', 'Exercice guidé sur machine ciblant les pectoraux. Le mouvement est sécurisé et idéal pour les débutants. Permet de travailler avec des charges lourdes sans pareur.', 'Débutant', 'Pectoraux/Machine_bench_press.webp'),
(3, 1, 'Écarté à la poulie', 'Exercice d\'isolation pour les pectoraux réalisé à la poulie vis-à-vis. Le mouvement d\'ouverture et de fermeture des bras étire et contracte les fibres pectorales en profondeur.', 'Débutant', 'Pectoraux/Cable_crossover.webp'),
(4, 1, 'Pompes', 'Exercice au poids du corps ciblant les pectoraux, les triceps et les épaules. Accessible partout sans matériel. Varier l\'écartement des mains permet de cibler différentes zones.', 'Débutant', 'Pectoraux/Push_ups.webp'),
(5, 1, 'Dips', 'Exercice au poids du corps avancé réalisé sur des barres parallèles. Sollicite intensément les pectoraux (buste penché en avant) et les triceps. Nécessite une bonne force de base.', 'Avancé', 'Pectoraux/Chest_dips.webp'),
(6, 2, 'Tractions', 'Exercice au poids du corps roi pour le dos. Suspendu à une barre, tirer le corps vers le haut jusqu\'au menton. Sollicite les dorsaux, les biceps et les avant-bras. Prise large pour cibler le grand dorsal.', 'Avancé', 'Dos/Gironda_sternum_chins.webp'),
(7, 2, 'Rowing barre', 'Exercice polyarticulaire pour l\'épaisseur du dos. Penché en avant, tirer la barre vers le nombril en serrant les omoplates. Travaille les dorsaux, les trapèzes et les rhomboïdes.', 'Intermédiaire', 'Dos/Barbell_rear_delt_row.webp'),
(8, 2, 'Tirage vertical', 'Exercice sur machine reproduisant le mouvement des tractions. Idéal pour les débutants qui ne peuvent pas encore faire de tractions. Permet de régler la charge progressivement.', 'Débutant', 'Dos/Wide_grip_lat_pull_down.webp'),
(9, 2, 'Tirage horizontal', 'Exercice sur machine ciblant le milieu du dos. Position assise, tirer la poignée vers le ventre en gardant le dos droit. Excellent pour l\'épaisseur du dos et la posture.', 'Débutant', 'Dos/Seated_cable_rows.webp'),
(10, 2, 'Soulevé de terre', 'Exercice polyarticulaire complet sollicitant toute la chaîne postérieure : dos, fessiers, ischio-jambiers. Technique exigeante, nécessite un apprentissage progressif pour éviter les blessures.', 'Avancé', 'Dos/Barbell_dead_lifts.webp'),
(11, 3, 'Squat barre', 'Exercice polyarticulaire fondamental pour les jambes. Barre sur les trapèzes, descendre en fléchissant les genoux jusqu\'à la parallèle. Sollicite quadriceps, fessiers et ischio-jambiers.', 'Intermédiaire', 'Jambes/Squats.webp'),
(12, 3, 'Presse à cuisses', 'Exercice sur machine guidée pour les quadriceps et les fessiers. Position assise, pousser la plateforme avec les pieds. Permet de charger lourd en sécurité sans solliciter le dos.', 'Débutant', 'Jambes/Leg_press.webp'),
(13, 3, 'Leg extension (machine)', 'Exercice d\'isolation sur machine ciblant spécifiquement les quadriceps. Position assise, étendre les jambes vers l\'avant. Mouvement simple et sécurisé pour les débutants.', 'Débutant', 'Jambes/Leg_extensions.webp'),
(14, 3, 'Leg curl', 'Exercice d\'isolation sur machine ciblant les ischio-jambiers. Position allongée ou assise, fléchir les jambes vers l\'arrière. Complémentaire du leg extension pour l\'équilibre musculaire.', 'Débutant', 'Jambes/Lying_leg_curl_machine.webp'),
(15, 3, 'Mollets debout', 'Exercice d\'isolation pour les mollets. Debout sur une marche ou une machine, monter sur la pointe des pieds puis redescendre lentement.', 'Débutant', 'Jambes/Standing_calf_raises_using_machine.webp'),
(16, 4, 'Développé militaire (machine)', 'Exercice polyarticulaire sur machine pour les épaules. Mouvement de poussée verticale guidé, sécurisé et accessible aux débutants. Cible le deltoïde antérieur et moyen.', 'Débutant', 'Epaules/Seated_shoulder_press_machine.webp'),
(17, 4, 'Élévations latérales haltères', 'Exercice d\'isolation pour le deltoïde moyen. Debout, lever les bras sur les côtés jusqu\'à l\'horizontale avec des haltères légers. Mouvement contrôlé sans élan.', 'Débutant', 'Epaules/Lateral_dumbbell_raises.webp'),
(18, 4, 'Élévation latérale poulie', 'Exercice d\'isolation pour le deltoïde moyen réalisé à la poulie basse. La tension constante du câble offre une résistance uniforme sur toute l\'amplitude du mouvement.', 'Intermédiaire', 'Epaules/Bent_over_lateral_cable_raises.webp'),
(19, 4, 'Oiseau', 'Exercice d\'isolation pour le deltoïde postérieur. Penché en avant, lever les bras sur les côtés. Essentiel pour l\'équilibre des épaules et la posture.', 'Débutant', 'Epaules/Bent_over_rear_deltoid_raise_with_head_on_bench.webp'),
(20, 5, 'Curl biceps banc incliné', 'Exercice d\'isolation pour les biceps réalisé sur un banc incliné à 45°. Les coudes sont en position arrière, ce qui étire davantage le biceps et augmente l\'amplitude du mouvement.', 'Intermédiaire', 'Bras/Alternating_incline_curl_with_dumbbell.webp'),
(21, 5, 'Curl machine', 'Exercice d\'isolation pour les biceps sur machine. Les coudes sont calés en position avant, ce qui cible le pic du biceps. Mouvement guidé et sécurisé pour les débutants.', 'Débutant', 'Bras/Preacher_curl_with_machine.webp'),
(22, 5, 'Dips triceps', 'Exercice au poids du corps ciblant les triceps. Réalisé sur des barres parallèles ou un banc, buste droit pour cibler les triceps plutôt que les pectoraux.', 'Intermédiaire', 'Bras/Chest_dips.webp'),
(23, 5, 'Extension triceps au-dessus de la tête', 'Exercice d\'isolation pour les triceps avec haltère ou à la poulie. Bras levés au-dessus de la tête, fléchir et étendre les avant-bras. Cible la longue portion du triceps.', 'Intermédiaire', 'Bras/Standing_triceps_extension.webp'),
(24, 5, 'Curl marteau', 'Exercice pour les biceps et le brachial réalisé avec les paumes face à face. Renforce également les avant-bras. Prise neutre qui soulage les poignets.', 'Intermédiaire', 'Bras/Alternating_hammer_curl_with_dumbbell.webp'),
(25, 6, 'Crunch sur banc', 'Exercice d\'isolation pour le grand droit de l\'abdomen. Réalisé sur un banc décliné, remonter le buste en contractant les abdominaux. Mouvement contrôlé sans tirer sur la nuque.', 'Débutant', 'Abdos/Decline_crunch.webp'),
(26, 6, 'Relevé de jambes allongé', 'Exercice ciblant la partie basse des abdominaux. Allongé sur le dos, lever les jambes tendues vers le plafond puis redescendre lentement sans toucher le sol.', 'Intermédiaire', 'Abdos/Flat_bench_leg_raises.webp');

-- --------------------------------------------------------

--
-- Structure de la table `muscle_groups`
--

CREATE TABLE `muscle_groups` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `muscle_groups`
--

INSERT INTO `muscle_groups` (`id`, `name`) VALUES
(6, 'Abdos'),
(5, 'Bras'),
(2, 'Dos'),
(4, 'Épaules'),
(3, 'Jambes'),
(1, 'Pectoraux');

-- --------------------------------------------------------

--
-- Structure de la table `programs`
--

CREATE TABLE `programs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `programs`
--

INSERT INTO `programs` (`id`, `user_id`, `name`, `created_at`) VALUES
(1, 2, 'Push — Lundi', '2026-04-10 11:38:14'),
(2, 2, 'Pull — Mercredi', '2026-04-10 11:45:32');

-- --------------------------------------------------------

--
-- Structure de la table `program_exercises`
--

CREATE TABLE `program_exercises` (
  `id` int NOT NULL,
  `program_id` int NOT NULL,
  `exercise_id` int NOT NULL,
  `sets` int NOT NULL DEFAULT '3',
  `reps` int NOT NULL DEFAULT '10',
  `weight` decimal(5,1) DEFAULT NULL,
  `rest_time` int NOT NULL DEFAULT '90'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `program_exercises`
--

INSERT INTO `program_exercises` (`id`, `program_id`, `exercise_id`, `sets`, `reps`, `weight`, `rest_time`) VALUES
(1, 1, 1, 4, 8, 60.0, 120),
(2, 1, 2, 3, 12, 40.0, 90),
(3, 1, 16, 4, 10, 30.0, 90),
(4, 1, 23, 3, 12, 8.0, 60),
(5, 2, 6, 4, 8, NULL, 120),
(6, 2, 7, 4, 10, 50.0, 90),
(7, 2, 21, 3, 12, 10.0, 60),
(8, 2, 25, 3, 15, NULL, 60);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `tdee` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `tdee`, `created_at`) VALUES
(1, 'louenn@onemorerep.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '2026-04-10 10:08:47'),
(2, 'lucas@test.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, '2026-04-10 10:12:13'),
(3, 'sarah@test.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, '2026-04-10 10:25:29'),
(4, 'louenn.p@gmail.com', '$2y$10$rgIdj40yWnlrylyazhPccunhBQ/BoATJoxjsRFbJ9Br2lnaQOmyT.', 'user', NULL, '2026-04-28 17:20:53');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `muscle_group_id` (`muscle_group_id`);

--
-- Index pour la table `muscle_groups`
--
ALTER TABLE `muscle_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `program_exercises`
--
ALTER TABLE `program_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `muscle_groups`
--
ALTER TABLE `muscle_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `program_exercises`
--
ALTER TABLE `program_exercises`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`muscle_group_id`) REFERENCES `muscle_groups` (`id`);

--
-- Contraintes pour la table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `program_exercises`
--
ALTER TABLE `program_exercises`
  ADD CONSTRAINT `program_exercises_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `program_exercises_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
