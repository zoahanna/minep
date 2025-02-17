CREATE DATABASE comment_system;

USE comment_system;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(80) NOT NULL, -- SHA-256 produces a 64-character hash
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);