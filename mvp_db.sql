-- Create database
CREATE DATABASE IF NOT EXISTS mvp_db;
USE mvp_db;

-- Create table pembalap
CREATE TABLE IF NOT EXISTS pembalap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tim VARCHAR(255) NOT NULL,
    negara VARCHAR(255) NOT NULL,
    poinMusim INT DEFAULT 0,
    jumlahMenang INT DEFAULT 0
);

-- Insert data pembalap
INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES
('Lewis Hamilton', 'Mercedes', 'United Kingdom', 347, 11),
('Max Verstappen', 'Red Bull', 'Netherlands', 335, 10),
('Valtteri Bottas', 'Mercedes', 'Finland', 203, 2),
('Sergio Perez', 'Red Bull', 'Mexico', 190, 1),
('Carlos Sainz', 'Ferrari', 'Spain', 150, 0),
('Daniel Ricciardo', 'McLaren', 'Australia', 115, 1),
('Charles Leclerc', 'Ferrari', 'Monaco', 95, 0),
('Lando Norris', 'McLaren', 'United Kingdom', 88, 0),
('Pierre Gasly', 'AlphaTauri', 'France', 75, 0),
('Fernando Alonso', 'Alpine', 'Spain', 65, 0);

-- Create table sirkuit
CREATE TABLE IF NOT EXISTS sirkuit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    kapasitas_penonton INT,
    rekor_pembalap VARCHAR(255),
    rekor_waktu VARCHAR(20)
);

-- Insert data sirkuit
INSERT INTO sirkuit (nama, lokasi, kapasitas_penonton, rekor_pembalap, rekor_waktu) VALUES
('Circuit de Monaco', 'Monte Carlo, Monaco', 37000, 'Lewis Hamilton', '01:12:909'),
('Silverstone Circuit', 'Silverstone, UK', 150000, 'Max Verstappen', '01:27:097'),
('Suzuka International', 'Suzuka, Japan', 155000, 'Lewis Hamilton', '01:30:983'),
('Monza Circuit', 'Monza, Italy', 113000, 'Rubens Barrichello', '01:21:046'),
('Marina Bay Street Circuit', 'Singapore', 90000, 'Kevin Magnussen', '01:41:905'),
('Circuit of the Americas', 'Austin, USA', 120000, 'Charles Leclerc', '01:36:169'),
('Interlagos Circuit', 'São Paulo, Brazil', 60000, 'Valtteri Bottas', '01:10:540'),
('Yas Marina Circuit', 'Abu Dhabi, UAE', 60000, 'Max Verstappen', '01:26:103'),
('Hungaroring', 'Budapest, Hungary', 70000, 'Lewis Hamilton', '01:16:627'),
('Red Bull Ring', 'Spielberg, Austria', 105000, 'Carlos Sainz', '01:05:619');