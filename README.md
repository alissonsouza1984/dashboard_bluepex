# dashboard_bluepex
O projeto a seguir tem como objetivo Desenvolver um sistema com dashboard de status do sistema Operacional Linux

# Antes de Iniciar é necessario criar o banco de dados  para vias de teste foi criado  o usuario alisson com a senha pokas
sudo mysql -u alisson -p

# Criando o Banco de dados dashboard_bluepex no Mysql;
CREATE DATABASE dashboard_bluepex;

# Criando Tabelas no Mysql
USE dashboard_bluepex;

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