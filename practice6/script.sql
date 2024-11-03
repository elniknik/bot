DROP TABLE IF EXISTS applicants;
DROP TABLE IF EXISTS applicants_auth;
DROP TABLE IF EXISTS consultants;
DROP TABLE IF EXISTS chats;
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS faculties;
DROP TABLE IF EXISTS study_programs;
DROP TABLE IF EXISTS applications;
DROP TABLE IF EXISTS exams;
DROP TABLE IF EXISTS rankings;

-- Таблиця абітурієнтів
CREATE TABLE applicants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    chat_id VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone_number VARCHAR(20),
    registration_date DATE DEFAULT CURRENT_DATE
);

CREATE TABLE IF NOT EXISTS applicants_auth (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    applicant_id INT(11) NOT NULL,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    token CHAR(50),
    date_expires TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (applicant_id) REFERENCES applicants(id)
);

-- Таблиця консультантів
CREATE TABLE consultants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_number VARCHAR(20),
    specialty VARCHAR(100)
);

-- Таблиця чатів
CREATE TABLE chats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    applicant_id INT NOT NULL,
    consultant_id INT NOT NULL,
    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicants(id),
    FOREIGN KEY (consultant_id) REFERENCES consultants(id)
);

-- Таблиця повідомлень
CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    chat_id INT NOT NULL,
    sender VARCHAR(20) NOT NULL, -- "applicant" або "consultant"
    content TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES chats(id)
);

-- Таблиця факультетів
CREATE TABLE faculties (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Таблиця програм навчання
CREATE TABLE study_programs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    faculty_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    duration_years INT,
    description TEXT,
    FOREIGN KEY (faculty_id) REFERENCES faculties(id)
);

-- Таблиця заявок на вступ
CREATE TABLE applications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    applicant_id INT NOT NULL,
    program_id INT NOT NULL,
    submission_date DATE DEFAULT CURRENT_DATE,
    status VARCHAR(50) DEFAULT 'Pending', -- "Pending", "Accepted", "Rejected"
    FOREIGN KEY (applicant_id) REFERENCES applicants(id),
    FOREIGN KEY (program_id) REFERENCES study_programs(id)
);

-- Таблиця іспитів
CREATE TABLE exams (
    id INT PRIMARY KEY AUTO_INCREMENT,
    program_id INT NOT NULL,
    exam_date DATE,
    location VARCHAR(100),
    description TEXT,
    FOREIGN KEY (program_id) REFERENCES study_programs(id)
);

-- Таблиця рейтингу абітурієнтів
CREATE TABLE rankings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    application_id INT NOT NULL,
    score DECIMAL(5, 2) NOT NULL,
    ranking_date DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (application_id) REFERENCES applications(id)
);

-- Приклад даних для таблиці факультетів
INSERT INTO faculties (name, description) VALUES 
('Engineering', 'Engineering faculty offering various technical programs'),
('Business', 'Business faculty focusing on management and finance'),
('Arts', 'Faculty of arts and humanities');

-- Приклад даних для таблиці програм навчання
INSERT INTO study_programs (faculty_id, name, duration_years, description) VALUES 
(1, 'Computer Science', 4, 'Study of computer systems and software'),
(1, 'Mechanical Engineering', 4, 'Study of mechanical systems and materials'),
(2, 'Business Administration', 3, 'Management and business studies'),
(3, 'Graphic Design', 3, 'Study of visual communication and design principles');
