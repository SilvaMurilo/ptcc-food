CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    name VARCHAR(100) NOT NULL
);

INSERT INTO users (username, password, role, name) VALUES
    ('marcos_adm', '123456', 'admin', 'Marcos'),
    ('xclientex', '123', 'user', 'Cliente Sobrenome');
