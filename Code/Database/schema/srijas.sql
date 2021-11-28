SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS srijas DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE srijas;

CREATE TABLE job_master (
  job_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  job_title varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE resume_master (
  resume_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  resume_json longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE resume_skills (
  resume_skill_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  resume_id int NOT NULL REFERENCES resume_master (resume_id),
  skill_id int NOT NULL REFERENCES skill_master (skill_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE skill_master (
  skill_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  skill_title varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE user_master (
  user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_fname varchar(50) NOT NULL,
  user_lname varchar(50) DEFAULT NULL,
  user_email varchar(50) NOT NULL UNIQUE,
  user_pwd varchar(50) NOT NULL,
  location varchar(50) DEFAULT NULL,
  user_preferred_job_id int NOT NULL REFERENCES job_master (job_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE user_resume (
  user_resume_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL REFERENCES user_master (user_id),
  resume_id int NOT NULL REFERENCES resume_master (resume_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE job_board(
  job_board_id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE user_notification(
  user_id int NOT NULL REFERENCES user_master(user_id),
  job_board_id varchar(50) NOT NULL REFERENCES job_board(job_board_id),
  PRIMARY KEY(user_id, job_board_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO job_master (job_title) VALUES
('Software Engineer'),
('Software Developer'),
('Software Engineer Intern'),
('Software Developer Intern');

INSERT INTO skill_master(skill_title) VALUES
("C"),
("Java"),
("Python"),
("C++"),
("C#"),
("Visual Basic"),
("JavaScript"),
("Assembly Language"),
("PHP"),
("SQL"),
("Classic Visual Basic"),
("Delphi/Object Pascal"),
("Ruby"),
("Go"),
("Swift"),
("R"),
("Groovy"),
("Perl"),
("MATLAB"),
("Git"),
("Kotlin"),
("Android"),
("MongoDB"),
("Object Oriented"),
("NodeJS"),
("React"),
("Native"),
("Data Structures"),
("Algorithm"),
("Distributed Systems"),
("Pandas"),
("Numpy"),
("Django"),
("Flask"),
("Spring Boot"),
("Spring"),
("Jersey"),
("Rails"),
("AngularJS"),
("Julia"),
("Bootstrap"),
("Swift"),
("Algorithms"),
("Computer Science"),
("Problem Solving"),
("JS"),
("C#"),
("Coding"),
("Data Structures"),
("Fortran");

INSERT INTO job_board (name) VALUES
('LINKEDIN'),
('ZIPRECRUITER'),
('INDEED'),
('GOINGLOBAL'),
('MONSTER');
COMMIT;
