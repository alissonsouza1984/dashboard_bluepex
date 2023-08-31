# dashboard_linux
O projeto a seguir tem como objetivo Desenvolver um sistema com dashboard de status do sistema Operacional Linux

# Banco de dados 
mysql -u root -psua_senha

Antes de Iniciar é necessario criar o banco de dados No mysql 
editar o arquivo config/db.php

# Criando o Banco de dados dashboard_linux no Mysql;
CREATE DATABASE dashboard_linux;

# Criando Tabelas no Mysql
USE dashboard_linux;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_id VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

#Dar Permissões ao usuario no banco de dados

GRANT ALL PRIVILEGES ON *.* TO 'dashboard_linux'@'localhost';

FLUSH PRIVILEGES;

#definir usuario admin no banco de dados
INSERT INTO users (username, password, is_admin, email) VALUES ('admin', '$2y$10$8aHHdVZvppjNYWV80MIwu.BiFGjQ1J5N7OB5LZw3Cy.KKTPOtFFuO', 1, 'admin@example.com');
