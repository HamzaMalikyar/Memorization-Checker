SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `security_question`, `security_answer`) VALUES
(1, 'Ajay', 'ajay@gmail.com', '12345', 'What was the name of your elementary school?', 'Georgia State Elementary School'),
(2, 'Ari', 'ari@gmail.com', '1234', 'What was the name of your elementary school?', 'Georgia State Elementary School'),
(3, 'Alex', 'alex@gmail.com', '$2y$10$g.xv9BS7DZbZ0KT/.fkGouuD8duIUWY2lDntZ7ZXDDUW6h09ZDiqe', 'What was the name of your elementary school?', 'Georgia State Elementary School'),
(4, 'Marrilyn', 'marrilyn@gmail.com', '$2y$10$ZuWPf98dGPFogVM8MoKGxOVZ4v1mXD.WrJQ7rwfvdYLWMpyEyRhtK', 'What was the name of your elementary school?', 'Georgia State Elementary School'),
(5, 'Mark', 'mark@gmail.com', '$2y$10$PL6oQH71xCh3F3BALBuVYu6SLn2AVQ41o.i5vi2LosRIWEh1H.0Zi', 'What was the name of your elementary school?', 'Georgia State Elementary School');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

CREATE TABLE goals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    goal VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    input_text TEXT NOT NULL,
    missed_percentage DECIMAL(5, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
