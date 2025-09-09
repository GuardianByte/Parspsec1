CREATE DATABASE appdb;
USE appdb;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);
INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('testuser', 'testpass'),
('john', 'doe123');
