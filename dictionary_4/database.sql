CREATE DATABASE dictionary_app;
USE dictionary_app;

CREATE TABLE dictionary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(100) UNIQUE,
    bangla TEXT,
    phonetics JSON,
    meanings JSON,
    created_at DATETIME
);

CREATE TABLE search_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(100) UNIQUE,
    count INT DEFAULT 1,
    last_searched DATETIME
);