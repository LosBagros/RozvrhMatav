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

CREATE TABLE `classrooms` (
  `classroom_id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `name` varchar(8) NOT NULL,
  `shortcut` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hours` (
  `hour_id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_teacher` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `login` (`id`, `email`, `pass`, `is_admin`, `is_teacher`, `name`, `surname`) VALUES
(7, 'admin@bagros.eu', '$2y$10$dPiBDc2S25gXPrjJwn0gsunJbpOBYgRiBAfJ31knZtcvbOOQEyVK.', 1, 0, NULL, NULL),
(8, 'admin1@bagros.eu', '$2y$10$8Typ3oKmbyhrmHKWIqXacuKvpjmLyUSZwK0RTbRiBYXZnT0Fr65D6', 0, 0, NULL, NULL),
(9, 'test@test.cz', '$2y$10$NIqF1v.H4VWl.OEygvAdxOQ8ps0nDR2.WMOG0zZBwgcIyMf0FQFbm', 0, 0, NULL, NULL),
(10, 'tom@bagros.eu', '$2y$10$c3J277f7k/qymG.819AY5.4pofssn9Tsp/09T35PM6TDf7QUqygU.', 0, 0, NULL, NULL);

CREATE TABLE `students` (
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `students` (`student_id`, `class_id`) VALUES
(NULL, NULL),
(NULL, NULL),
(NULL, NULL),
(NULL, NULL);

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


ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`classroom_id`);

ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

ALTER TABLE `hours`
  ADD PRIMARY KEY (`hour_id`);

ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `students`
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`) USING BTREE;

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


ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `login` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`classroom_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`day_id`) REFERENCES `days` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_4` FOREIGN KEY (`hour_id`) REFERENCES `hours` (`hour_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_5` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_6` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
