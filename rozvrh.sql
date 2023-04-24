SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `classname` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `classes` (`class_id`, `classname`) VALUES
(1, 'Žádná'),
(2, '1ITA'),
(3, '2ITA'),
(4, '3ITA'),
(5, '4ITA'),
(6, '1ITB'),
(7, '2ITB'),
(8, '3ITB'),
(9, '4ITB');

CREATE TABLE `classrooms` (
  `classroom_id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `name` varchar(8) NOT NULL,
  `shortcut` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `days` (`day_id`, `name`, `shortcut`) VALUES
(1, 'Pondělí', 'po'),
(2, 'Úterý', 'út'),
(3, 'Středa', 'st'),
(4, 'Čtvrtek', 'čt'),
(5, 'Pátek', 'pá');

CREATE TABLE `hours` (
  `hour_id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `hours` (`hour_id`, `start`, `end`) VALUES
(1, '08:00:00', '08:45:00'),
(2, '08:55:00', '09:40:00'),
(3, '09:50:00', '10:35:00'),
(4, '10:50:00', '11:35:00'),
(5, '11:45:00', '12:30:00'),
(6, '12:40:00', '13:25:00'),
(7, '13:35:00', '14:20:00'),
(8, '14:30:00', '15:15:00');

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `shortcut` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `teachers` (
  `teacher_id` int(11) DEFAULT NULL,
  `username` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `hour_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `class_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `email`, `pass`, `is_admin`, `name`, `surname`, `class_id`) VALUES
(1, 'testovani@bagros.eu', '$2y$10$72gjykgvaADD7BMTvlALj.S4m5CWe1eKm.rwtElenTCCoWapuLXM.', 0, '', '', 1),
(7, 'admin@bagros.eu', '$2y$10$dPiBDc2S25gXPrjJwn0gsunJbpOBYgRiBAfJ31knZtcvbOOQEyVK.', 1, 'Tom', 'Bagros', 2),
(8, 'radim.podmost@bagros.eu', '$2y$10$8Typ3oKmbyhrmHKWIqXacuKvpjmLyUSZwK0RTbRiBYXZnT0Fr65D6', 0, 'Martin', 'Podmost', 4),
(9, 'pepa.novy@test.cz', '$2y$10$NIqF1v.H4VWl.OEygvAdxOQ8ps0nDR2.WMOG0zZBwgcIyMf0FQFbm', 0, 'Adam', 'Starý', 7),
(10, 'lukas.zboren@bagros.eu', '$2y$10$c3J277f7k/qymG.819AY5.4pofssn9Tsp/09T35PM6TDf7QUqygU.', 0, 'Lukáš', 'Zbořen', 1),
(18, 'tom@bagros.eu', '$2y$10$p/q6Y82t2wYJMcY1qj3XZujx.cqVZRFB89tSXVGS69/PHgPWol/l6', 0, NULL, NULL, 1);


ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`classroom_id`);

ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

ALTER TABLE `hours`
  ADD PRIMARY KEY (`hour_id`);

ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

ALTER TABLE `teachers`
  ADD UNIQUE KEY `login_id` (`teacher_id`);

ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`) USING BTREE,
  ADD KEY `class_id` (`class_id`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`) USING BTREE,
  ADD KEY `subject_id` (`subject_id`) USING BTREE,
  ADD KEY `hour_id` (`hour_id`) USING BTREE,
  ADD KEY `day_id` (`day_id`) USING BTREE;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `class_id` (`class_id`);


ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `classrooms`
  MODIFY `classroom_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `hours`
  MODIFY `hour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;


ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`classroom_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`day_id`) REFERENCES `days` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_4` FOREIGN KEY (`hour_id`) REFERENCES `hours` (`hour_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_5` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_6` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
