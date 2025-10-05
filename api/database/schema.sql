-- HomeStyle Furniture Database Schema
-- Run this script to create the database and tables

-- Create database
CREATE DATABASE IF NOT EXISTS homestyle_furniture CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE homestyle_furniture;

-- Create visitors table
CREATE TABLE IF NOT EXISTS visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NOT NULL,
    page VARCHAR(255) NOT NULL,
    action VARCHAR(100) NOT NULL,
    data JSON NULL,
    viewport_width INT DEFAULT 0,
    is_mobile BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_action (action),
    INDEX idx_page (page),
    INDEX idx_created_at (created_at),
    INDEX idx_ip_address (ip_address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create analytics summary view (optional)
CREATE OR REPLACE VIEW visitor_analytics AS
SELECT 
    DATE(created_at) as date,
    action,
    page,
    COUNT(*) as total_actions,
    COUNT(DISTINCT ip_address) as unique_visitors,
    AVG(viewport_width) as avg_viewport_width,
    SUM(CASE WHEN is_mobile = 1 THEN 1 ELSE 0 END) as mobile_visitors,
    SUM(CASE WHEN is_mobile = 0 THEN 1 ELSE 0 END) as desktop_visitors
FROM visitors 
GROUP BY DATE(created_at), action, page
ORDER BY date DESC, total_actions DESC;