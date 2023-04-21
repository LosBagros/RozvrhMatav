SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `nazev` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `classrooms` (
  `classroom_id` int(11) NOT NULL,
  `nazev` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hours` (
  `hour_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `nazev` varchar(32) NOT NULL,
  `zkratka` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `day_id` int(11) DEFAULT NULL,
  `hour_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `classroom_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `role` enum('student','teacher') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `email`, `pass`, `admin`, `class_id`, `role`) VALUES
(7, 'admin@bagros.eu', '$2y$10$dPiBDc2S25gXPrjJwn0gsunJbpOBYgRiBAfJ31knZtcvbOOQEyVK.', 1, NULL, 'student'),
(8, 'admin1@bagros.eu', '$2y$10$8Typ3oKmbyhrmHKWIqXacuKvpjmLyUSZwK0RTbRiBYXZnT0Fr65D6', 0, NULL, 'student'),
(9, 'test@test.cz', '$2y$10$NIqF1v.H4VWl.OEygvAdxOQ8ps0nDR2.WMOG0zZBwgcIyMf0FQFbm', 0, NULL, 'student'),
(10, 'tom@bagros.eu', '$2y$10$c3J277f7k/qymG.819AY5.4pofssn9Tsp/09T35PM6TDf7QUqygU.', 0, NULL, 'student');


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

ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetable_class_fk` (`class_id`),
  ADD KEY `timetable_day_fk` (`day_id`),
  ADD KEY `timetable_hour_fk` (`hour_id`),
  ADD KEY `timetable_subject_fk` (`subject_id`),
  ADD KEY `classroom_id` (`classroom_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `class_id` (`class_id`);


ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `classrooms`
  MODIFY `classroom_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `hours`
  MODIFY `hour_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `timetable`
  ADD CONSTRAINT `classroom_id` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`classroom_id`),
  ADD CONSTRAINT `timetable_class_fk` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `timetable_day_fk` FOREIGN KEY (`day_id`) REFERENCES `days` (`day_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `timetable_hour_fk` FOREIGN KEY (`hour_id`) REFERENCES `hours` (`hour_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `timetable_subject_fk` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;