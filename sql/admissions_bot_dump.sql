-- Створення бази даних
CREATE DATABASE admissions_bot;
USE admissions_bot;

-- Таблиця абітурієнтів
CREATE TABLE applicants (
    applicant_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_number VARCHAR(20),
    registration_date DATE DEFAULT CURRENT_DATE
);

-- Таблиця консультантів
CREATE TABLE consultants (
    consultant_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_number VARCHAR(20),
    specialty VARCHAR(100)
);

-- Таблиця чатів
CREATE TABLE chats (
    chat_id INT PRIMARY KEY AUTO_INCREMENT,
    applicant_id INT NOT NULL,
    consultant_id INT NOT NULL,
    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicants(applicant_id),
    FOREIGN KEY (consultant_id) REFERENCES consultants(consultant_id)
);

-- Таблиця повідомлень
CREATE TABLE messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    chat_id INT NOT NULL,
    sender VARCHAR(20) NOT NULL, -- "applicant" або "consultant"
    content TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES chats(chat_id)
);

-- Таблиця факультетів
CREATE TABLE faculties (
    faculty_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Таблиця програм навчання
CREATE TABLE study_programs (
    program_id INT PRIMARY KEY AUTO_INCREMENT,
    faculty_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    duration_years INT,
    description TEXT,
    FOREIGN KEY (faculty_id) REFERENCES faculties(faculty_id)
);

-- Таблиця заявок на вступ
CREATE TABLE applications (
    application_id INT PRIMARY KEY AUTO_INCREMENT,
    applicant_id INT NOT NULL,
    program_id INT NOT NULL,
    submission_date DATE DEFAULT CURRENT_DATE,
    status VARCHAR(50) DEFAULT 'Pending', -- "Pending", "Accepted", "Rejected"
    FOREIGN KEY (applicant_id) REFERENCES applicants(applicant_id),
    FOREIGN KEY (program_id) REFERENCES study_programs(program_id)
);

-- Таблиця іспитів
CREATE TABLE exams (
    exam_id INT PRIMARY KEY AUTO_INCREMENT,
    program_id INT NOT NULL,
    exam_date DATE,
    location VARCHAR(100),
    description TEXT,
    FOREIGN KEY (program_id) REFERENCES study_programs(program_id)
);

-- Таблиця рейтингу абітурієнтів
CREATE TABLE rankings (
    ranking_id INT PRIMARY KEY AUTO_INCREMENT,
    application_id INT NOT NULL,
    score DECIMAL(5, 2) NOT NULL,
    ranking_date DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (application_id) REFERENCES applications(application_id)
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
