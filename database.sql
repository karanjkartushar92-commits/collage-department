-- College Department Management System
-- Import this file in phpMyAdmin (or: mysql -u root -p < database.sql)

CREATE DATABASE IF NOT EXISTS college_dms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE college_dms;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  code VARCHAR(20) NOT NULL UNIQUE,
  hod VARCHAR(100) DEFAULT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS faculty (
  id INT AUTO_INCREMENT PRIMARY KEY,
  department_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  phone VARCHAR(20) DEFAULT NULL,
  designation VARCHAR(80) DEFAULT NULL,
  qualification VARCHAR(120) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  department_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  roll_no VARCHAR(30) NOT NULL UNIQUE,
  year TINYINT NOT NULL DEFAULT 1,
  phone VARCHAR(20) DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  department_id INT DEFAULT NULL,           -- NULL = visible to everyone
  title VARCHAR(200) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS exams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  department_id INT NOT NULL,
  title VARCHAR(150) NOT NULL,
  subject VARCHAR(120) NOT NULL,
  year TINYINT NOT NULL DEFAULT 0,           -- 0 = all years
  exam_date DATE NOT NULL,
  start_time TIME NOT NULL,
  max_marks INT NOT NULL DEFAULT 100,
  result_declared TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  exam_id INT NOT NULL,
  student_id INT NOT NULL,
  marks_obtained DECIMAL(6,2) NOT NULL,
  grade VARCHAR(3) NOT NULL,
  UNIQUE KEY uniq_exam_student (exam_id, student_id),
  FOREIGN KEY (exam_id) REFERENCES exams(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Sample departments (optional)
INSERT IGNORE INTO departments (name, code, hod, description) VALUES
('Computer Science & Engineering', 'CSE', 'Dr. A. Kulkarni', 'Programming, algorithms, databases, AI and networks.'),
('Electronics & Communication', 'ECE', 'Dr. S. Patil', 'Circuits, embedded systems, signals and communication.'),
('Mechanical Engineering', 'ME', 'Dr. R. Deshmukh', 'Design, thermodynamics, manufacturing and robotics.');

-- NOTE: the first admin (username: admin / password: admin123) is created
-- automatically the first time you open admin/login.php. Change it afterwards.
