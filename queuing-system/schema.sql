-- Create database
CREATE DATABASE IF NOT EXISTS queuing_system;
USE queuing_system;

-- Create roles table
CREATE TABLE roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

-- Create users table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- Create queues table
CREATE TABLE queues (
    queue_id INT PRIMARY KEY AUTO_INCREMENT,
    queue_name VARCHAR(100) NOT NULL,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create queue_entries table
CREATE TABLE queue_entries (
    entry_id INT PRIMARY KEY AUTO_INCREMENT,
    queue_id INT,
    user_id INT,
    status ENUM('waiting', 'serving', 'completed', 'cancelled') DEFAULT 'waiting',
    entry_number VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (queue_id) REFERENCES queues(queue_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Insert default roles
INSERT INTO roles (role_name) VALUES 
('admin'),
('user');