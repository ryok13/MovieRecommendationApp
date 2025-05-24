-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 01:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msrps_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action'),
(5, 'Animation'),
(3, 'Comedy'),
(10, 'Documentary'),
(2, 'Drama'),
(9, 'Fantasy'),
(7, 'Horror'),
(6, 'Romance'),
(8, 'Sci-Fi'),
(4, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `word` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `word`) VALUES
(9, 'Adventure'),
(7, 'Family'),
(6, 'Friendship'),
(4, 'Ghost'),
(10, 'Psychological'),
(2, 'Romance'),
(1, 'Sci-Fi'),
(3, 'Superhero'),
(5, 'Time Travel'),
(8, 'War');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster_url` text DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre_id`, `release_year`, `description`, `poster_url`, `rating`, `status`, `image_path`) VALUES
(1, 'Inception', 8, 2010, 'A thief who infiltrates dreams to steal secrets.', NULL, NULL, 'active', '/assets/images/Inception.jpg'),
(2, 'Titanic', 6, 1997, 'A tragic love story on the ill-fated Titanic.', NULL, NULL, 'active', '/assets/images/titanic.jpg'),
(3, 'The Conjuring', 7, 2013, 'Paranormal investigators help a family terrorized by dark forces.', NULL, NULL, 'active', '/assets/images/The Conjuring.jpg'),
(4, 'Toy Story', 5, 1995, 'Toys come to life when humans are not around.', NULL, NULL, 'active', '/assets/images/Toy Story.jpg'),
(5, 'The Godfather', 2, 1972, 'An aging patriarch of an organized crime dynasty transfers control.', NULL, NULL, 'active', '/assets/images/The Godfather.jpg'),
(6, 'Avengers: Endgame', 1, 2019, 'Heroes assemble to reverse the effects of Thanos\' snap. Heroes won the game.', NULL, '', 'active', '/assets/images/Avengers_Endgame.jpg'),
(7, 'The Notebook', 6, 2004, 'A romantic tale of a young couple in the 1940s.', NULL, NULL, 'active', '/assets/images/The Notebook.jpg'),
(8, 'The Matrix', 8, 1999, 'A hacker discovers the truth about his reality.', NULL, NULL, 'active', '/assets/images/The Matrix.jpg'),
(9, 'Forrest Gump', 2, 1994, 'A slow-witted man witnesses and influences historical events.', NULL, NULL, 'active', '/assets/images/Forrest Gump.jpg'),
(10, 'Inside Out', 5, 2015, 'Personified emotions guide a young girl through change.', NULL, NULL, 'active', '/assets/images/Inside Out.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie_keywords`
--

CREATE TABLE `movie_keywords` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_keywords`
--

INSERT INTO `movie_keywords` (`id`, `movie_id`, `keyword_id`) VALUES
(1, 1, 1),
(2, 1, 5),
(3, 1, 10),
(4, 2, 2),
(5, 2, 8),
(6, 3, 4),
(7, 3, 10),
(8, 4, 6),
(9, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `recommended_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`id`, `user_id`, `movie_id`, `recommended_id`, `reason`) VALUES
(1, 1, 1, 10, 'If you liked Inception, you should watch The Matrix.'),
(2, 1, 2, 7, 'Titanic fans will also love The Notebook.'),
(3, 1, 4, 10, 'Toy Story lovers should check out Inside Out.'),
(4, 1, 6, 3, 'For Marvel fans, The Conjuring is an unexpected twist.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `movie_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 5, 'Mind-blowing sci-fi experience!', '2025-04-07 03:35:29'),
(2, 1, 2, 4, 'Beautiful love story.', '2025-04-07 03:35:29'),
(3, 1, 3, 3, 'Scary and suspenseful!', '2025-04-07 03:35:29'),
(4, 1, 4, 5, 'Nostalgic and heartwarming.', '2025-04-07 03:35:29'),
(5, 1, 8, 4, 'Classic cyberpunk action.', '2025-04-07 03:35:29'),
(6, 1, 10, 4, 'A colorful and emotional journey through childhood.', '2025-04-07 12:31:29'),
(7, 1, 5, 4, 'A masterpiece of storytelling and character.', '2025-04-07 12:31:36'),
(8, 1, 7, 4, 'A touching love story with emotional weight.', '2025-04-07 12:31:39'),
(9, 1, 6, 5, 'An epic conclusion to the saga!', '2025-04-07 12:32:06'),
(10, 1, 9, 5, 'Heartwarming and unforgettable performance by Tom Hanks.', '2025-04-07 12:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`setting_key`, `setting_value`) VALUES
('site_name', 'Movie App'),
('theme_color', '#007bff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
# When user enter the password, you should use "admin#2025" or "chris#2025"
INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$nomrzItoqh6Gi245WjxkguozcbsdeUx9FIqyQe7RZDNg1ZvKkda0C', NULL, '2025-04-07 03:20:15'),
(3, 'chris', '$2y$10$IUe3fzg65RQ/DX/Za0ESye3kaY5.mSm3CFEaI1ioZKdRpmwPSoRhm', NULL, '2025-04-07 17:22:37');

--
-- Indexes for dumped tables
--git

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `word` (`word`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `movie_keywords`
--
ALTER TABLE `movie_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `keyword_id` (`keyword_id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`setting_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `movie_keywords`
--
ALTER TABLE `movie_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Constraints for table `movie_keywords`
--
ALTER TABLE `movie_keywords`
  ADD CONSTRAINT `movie_keywords_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_keywords_ibfk_2` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `recommendations_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
