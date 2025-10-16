-- Crie o banco de dados hotel_db se ele ainda não existir
CREATE DATABASE IF NOT EXISTS hotel_db;

-- Use o banco de dados hotel_db
USE hotel_db;

-- Desative o modo de não gerar valores automáticos em zero
SET SQL_MODE = "";

-- Crie a tabela users
CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telefone VARCHAR(11) NOT NULL,
  documento VARCHAR(11) NOT NULL,
  observacao VARCHAR(255) NULL,
  endereco VARCHAR(255) NULL,
  password VARCHAR(80) NOT NULL,
  join_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_login DATETIME NOT NULL,
  permissions VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela users
INSERT INTO users (full_name, email, telefone, documento, password, join_date, last_login, permissions) VALUES
('Anfitriao Teste', 'anfitriaoteste@teste.com', '32999999999', '12345678999', '$2y$10$7wwMzmUrTvFFZjQkDdEEhelQZ6PpbyWXxYmwjl007JwGCjJPIKQ6y', '2025-08-25 14:20:37', '2025-12-13 23:50:22', 'admin, editor'),
('Hospede Teste', 'hospedeteste@teste.com', '31888888888', '98765432111', '$2y$10$7wwMzmUrTvFFZjQkDdEEhelQZ6PpbyWXxYmwjl007JwGCjJPIKQ6y', '2025-08-25 14:20:37', '2025-12-13 23:50:22', 'admin, editor');

CREATE TABLE IF NOT EXISTS rooms (
  id INT(11) NOT NULL AUTO_INCREMENT,
  room_number VARCHAR(255) NOT NULL,
  host INT NOT NULL,
  type VARCHAR(255) NOT NULL,
  price TEXT NOT NULL,
  details TEXT NOT NULL,
  photo TEXT NOT NULL,
  endereco VARCHAR(255) NULL,
  usuario_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insira dados na tabela rooms
INSERT INTO rooms (room_number, host, type, price, details, photo, usuario_id) VALUES
('Victoria Falls Hotel', 20, 'Hotel', '550', 'Quarto independente com serviço.', 'images/c28a4216d269487d1a80072c0cf60544.jpg', 1),
('Chita Samfya Lodge', 15, 'Hotel', '450', 'Quarto independente com serviço.', 'images/e434cecc6cfa3b049462b124681bd0b8.jpg', 1),
('Continental Hotel', 24, 'Hotel', '650', 'Quarto independente com serviço.', 'images/774b4bf86117f0d06f236c3a757471d9.jpg', 1),
('Fazenda Hotel Resort', 24, 'Fazenda', '450', 'Quarto independente com serviço.', 'images/ff47695ad6f2245479157b38b7cdc332.jpg', 1);


-- Crie a tabela reservations
CREATE TABLE IF NOT EXISTS reservations (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  checkin DATE NOT NULL,
  checkout DATE NOT NULL,
  phone TEXT NOT NULL,
  people INT(11) NOT NULL,
  email VARCHAR(255) NOT NULL,
  room VARCHAR(255) NOT NULL,
  aprovacao VARCHAR (100) NOT NULL,
  price TEXT NOT NULL,
  user_id INT(11) NOT NULL,
  rooms_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (rooms_id) REFERENCES rooms (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




