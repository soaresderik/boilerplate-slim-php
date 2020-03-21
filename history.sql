-- 01
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100),
    email PASSWORD(100),
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP
);