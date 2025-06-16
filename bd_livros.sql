-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 15/06/2025 às 19:30
-- Versão do servidor: 10.4.21-MariaDB
-- Versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `bd_livros`
--
CREATE DATABASE IF NOT EXISTS `bd_livros` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bd_livros`;

--
-- Estrutura para tabela `usuarios`
--
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `privilegio` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo usuários de teste
--
INSERT INTO `usuarios` (username, senha, email, privilegio) VALUES
('rick', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rick@example.com', 1),
('dezin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dezin@example.com', 1),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user@example.com', 0);

--
-- Estrutura para tabela `livros`
--
CREATE TABLE IF NOT EXISTS `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `ano_publicacao` year(4) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura para tabela `livros`
--
CREATE TABLE `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `ano_publicacao` year(4) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo usuários de teste
--
INSERT INTO `usuarios` (`username`, `senha`, `email`, `privilegio`) VALUES
('rick', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rick@example.com', 1),
('dezin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dezin@example.com', 1),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user@example.com', 0);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
