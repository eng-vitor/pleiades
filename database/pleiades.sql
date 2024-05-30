-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para pleiades
CREATE DATABASE IF NOT EXISTS `pleiades` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pleiades`;

-- Copiando estrutura para tabela pleiades.acc_classe
CREATE TABLE IF NOT EXISTS `acc_classe` (
  `id_classe` int(3) DEFAULT NULL,
  `nome_classe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.acc_classe: ~3 rows (aproximadamente)
INSERT INTO `acc_classe` (`id_classe`, `nome_classe`) VALUES
	(0, 'Overloard'),
	(1, 'Usuário'),
	(3, 'Pleiade');

-- Copiando estrutura para tabela pleiades.acc_notifications
CREATE TABLE IF NOT EXISTS `acc_notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.acc_notifications: ~3 rows (aproximadamente)
INSERT INTO `acc_notifications` (`id`, `descricao`) VALUES
	(1, 'Notificações do Sistema'),
	(2, 'Notificações de Ticket'),
	(3, 'Notificações de Conta');

-- Copiando estrutura para tabela pleiades.acc_tools
CREATE TABLE IF NOT EXISTS `acc_tools` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.acc_tools: ~4 rows (aproximadamente)
INSERT INTO `acc_tools` (`id`, `descricao`) VALUES
	(1, 'Anydesk'),
	(2, 'Team Viewer'),
	(3, 'RealVNC'),
	(4, 'Network Config');

-- Copiando estrutura para tabela pleiades.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `msgcontent` varchar(1000) DEFAULT NULL,
  `isfile` tinyint(1) NOT NULL,
  `enviadapor` int(100) DEFAULT NULL,
  `namesended` varchar(50) NOT NULL,
  `socialsended` varchar(50) NOT NULL,
  `ticketprotocolo` varchar(100) DEFAULT NULL,
  `datamsg` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CONSTRAINT_1` (`ticketprotocolo`),
  KEY `CONSTRAINT_2` (`enviadapor`),
  CONSTRAINT `CONSTRAINT_1` FOREIGN KEY (`ticketprotocolo`) REFERENCES `tickets` (`protocolo`),
  CONSTRAINT `CONSTRAINT_2` FOREIGN KEY (`enviadapor`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.chat: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela pleiades.invites
CREATE TABLE IF NOT EXISTS `invites` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `key_invite` varchar(100) DEFAULT NULL,
  `class_account` tinyint(1) DEFAULT NULL,
  `tag_account` varchar(100) DEFAULT NULL,
  `email_account` varchar(100) DEFAULT NULL,
  `is_expired` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.invites: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela pleiades.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int(100) NOT NULL AUTO_INCREMENT,
  `id_conta` int(100) DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `tipo_notification` tinyint(1) DEFAULT NULL,
  `data_notification` datetime DEFAULT NULL,
  `visualizado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `id_conta` (`id_conta`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.notifications: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela pleiades.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `protocolo` varchar(100) NOT NULL,
  `solicitante` int(100) DEFAULT NULL,
  `tickethash` varchar(100) DEFAULT NULL,
  `designacao` varchar(50) DEFAULT NULL,
  `nometicket` varchar(100) DEFAULT NULL,
  `sla` int(10) DEFAULT NULL,
  `ticketstatus` varchar(50) DEFAULT NULL,
  `datapedido` datetime DEFAULT NULL,
  `datasla` datetime DEFAULT NULL,
  `datafinalizado` datetime DEFAULT NULL,
  PRIMARY KEY (`protocolo`),
  KEY `tickets_ibfk_1` (`solicitante`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`solicitante`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.tickets: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela pleiades.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `social` varchar(50) DEFAULT NULL,
  `classe` tinyint(3) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `urlprofile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `emailverificado` tinyint(1) DEFAULT NULL,
  `datacriacao` date DEFAULT NULL,
  `ultimovisto` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `nome`, `social`, `classe`, `tag`, `urlprofile`, `email`, `senha`, `emailverificado`, `datacriacao`, `ultimovisto`) VALUES
	(1, 'Administrador', '@admin', 0, 'Desenvolvimento', 'www.linkedin.com/in/mr-vitor-g-dantas', 'admin@admin.com.br', 'aeb25bb382bc0c52aa3719ba2beda7f8', 1, '2022-01-01', '2023-08-29 09:33:53');

-- Copiando estrutura para tabela pleiades.usertools
CREATE TABLE IF NOT EXISTS `usertools` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_conta` int(100) DEFAULT NULL,
  `tipotool` tinyint(1) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_conta` (`id_conta`),
  CONSTRAINT `usertools_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pleiades.usertools: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;