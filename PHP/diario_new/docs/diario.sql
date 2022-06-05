-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para diario_new
DROP DATABASE IF EXISTS `diario_new`;
CREATE DATABASE IF NOT EXISTS `diario_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `diario_new`;

-- Copiando estrutura para tabela diario_new.aluno
DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `mat_aluno` int(50) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mat_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.aluno: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
REPLACE INTO `aluno` (`mat_aluno`, `nome_aluno`) VALUES
	(2, 'sadasd');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.ano_letivo
DROP TABLE IF EXISTS `ano_letivo`;
CREATE TABLE IF NOT EXISTS `ano_letivo` (
  `id_ano` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.ano_letivo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ano_letivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ano_letivo` ENABLE KEYS */;

-- Copiando estrutura para procedure diario_new.apgcod
DROP PROCEDURE IF EXISTS `apgcod`;
DELIMITER //
CREATE PROCEDURE `apgcod`()
BEGIN
       DELETE FROM rec_conta WHERE data_rec < DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL -6 HOUR);
     END//
DELIMITER ;

-- Copiando estrutura para tabela diario_new.aula
DROP TABLE IF EXISTS `aula`;
CREATE TABLE IF NOT EXISTS `aula` (
  `id_aula` int(11) NOT NULL AUTO_INCREMENT,
  `id_ano` int(11) DEFAULT NULL,
  `id_ministra` int(11) DEFAULT NULL,
  `trimestre` int(11) DEFAULT NULL,
  `aula_prev` int(11) DEFAULT NULL,
  `aula_min` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aula`),
  KEY `id_ano` (`id_ano`),
  KEY `id_ministra` (`id_ministra`),
  CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`id_ano`) REFERENCES `ano_letivo` (`id_ano`),
  CONSTRAINT `aula_ibfk_2` FOREIGN KEY (`id_ministra`) REFERENCES `ministra` (`id_ministra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.aula: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.avaliacao
DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id_aval` int(11) NOT NULL AUTO_INCREMENT,
  `id_ministra` int(11) DEFAULT NULL,
  `id_ano` int(11) DEFAULT NULL,
  `nota_max` float DEFAULT NULL,
  `desc_aval` varchar(50) DEFAULT NULL,
  `tipo_aval` varchar(50) DEFAULT NULL,
  `trimeste` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aval`),
  KEY `id_ministra` (`id_ministra`),
  KEY `id_ano` (`id_ano`),
  CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_ministra`) REFERENCES `ministra` (`id_ministra`),
  CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`id_ano`) REFERENCES `ano_letivo` (`id_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.avaliacao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.avaliado
DROP TABLE IF EXISTS `avaliado`;
CREATE TABLE IF NOT EXISTS `avaliado` (
  `id_avaliado` int(11) NOT NULL AUTO_INCREMENT,
  `id_mat` int(11) DEFAULT NULL,
  `id_aval` int(11) DEFAULT NULL,
  `nota_avaliado` float DEFAULT NULL,
  `data_avaliado` date DEFAULT NULL,
  PRIMARY KEY (`id_avaliado`),
  KEY `id_aval` (`id_aval`),
  KEY `id_mat` (`id_mat`),
  CONSTRAINT `avaliado_ibfk_1` FOREIGN KEY (`id_aval`) REFERENCES `avaliacao` (`id_aval`),
  CONSTRAINT `avaliado_ibfk_2` FOREIGN KEY (`id_mat`) REFERENCES `matriculado` (`id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.avaliado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `avaliado` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliado` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.conteudo
DROP TABLE IF EXISTS `conteudo`;
CREATE TABLE IF NOT EXISTS `conteudo` (
  `id_cont` int(11) NOT NULL AUTO_INCREMENT,
  `id_ministra` int(11) DEFAULT NULL,
  `id_ano` int(11) DEFAULT NULL,
  `titulo_cont` varchar(20) DEFAULT NULL,
  `desc_cont` varchar(200) DEFAULT NULL,
  `data_cont` date DEFAULT NULL,
  PRIMARY KEY (`id_cont`),
  KEY `id_ministra` (`id_ministra`),
  KEY `id_ano` (`id_ano`),
  CONSTRAINT `conteudo_ibfk_1` FOREIGN KEY (`id_ministra`) REFERENCES `ministra` (`id_ministra`),
  CONSTRAINT `conteudo_ibfk_2` FOREIGN KEY (`id_ano`) REFERENCES `ano_letivo` (`id_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.conteudo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.coordena
DROP TABLE IF EXISTS `coordena`;
CREATE TABLE IF NOT EXISTS `coordena` (
  `id_coordena` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) DEFAULT NULL,
  `id_cord` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_coordena`),
  KEY `id_curso` (`id_curso`),
  KEY `id_cord` (`id_cord`),
  CONSTRAINT `coordena_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `coordena_ibfk_2` FOREIGN KEY (`id_cord`) REFERENCES `coordenador` (`id_cord`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.coordena: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `coordena` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordena` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.coordenador
DROP TABLE IF EXISTS `coordenador`;
CREATE TABLE IF NOT EXISTS `coordenador` (
  `id_cord` int(11) NOT NULL AUTO_INCREMENT,
  `id_usur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cord`),
  KEY `id_usur` (`id_usur`),
  CONSTRAINT `coordenador_ibfk_1` FOREIGN KEY (`id_usur`) REFERENCES `usuario` (`id_usur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.coordenador: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `coordenador` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordenador` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.cursa
DROP TABLE IF EXISTS `cursa`;
CREATE TABLE IF NOT EXISTS `cursa` (
  `id_cursa` int(11) NOT NULL AUTO_INCREMENT,
  `id_disc` int(11) DEFAULT NULL,
  `n_turma` int(11) DEFAULT NULL,
  `id_ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cursa`),
  KEY `id_disc` (`id_disc`),
  KEY `n_turma` (`n_turma`),
  KEY `id_ano` (`id_ano`),
  CONSTRAINT `cursa_ibfk_1` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`),
  CONSTRAINT `cursa_ibfk_2` FOREIGN KEY (`n_turma`) REFERENCES `turma` (`n_turma`),
  CONSTRAINT `cursa_ibfk_3` FOREIGN KEY (`id_ano`) REFERENCES `ano_letivo` (`id_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.cursa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cursa` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursa` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.curso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.disciplina
DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disc` int(11) NOT NULL AUTO_INCREMENT,
  `nome_disc` varchar(50) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_disc`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.disciplina: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.enturmado
DROP TABLE IF EXISTS `enturmado`;
CREATE TABLE IF NOT EXISTS `enturmado` (
  `id_enturmado` int(11) NOT NULL,
  `id_ano` int(11) DEFAULT NULL,
  `n_turma` int(11) DEFAULT NULL,
  `mat_aluno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_enturmado`),
  KEY `id_ano` (`id_ano`),
  KEY `n_turma` (`n_turma`),
  KEY `mat_aluno` (`mat_aluno`),
  CONSTRAINT `FK_enturmado_aluno` FOREIGN KEY (`mat_aluno`) REFERENCES `aluno` (`mat_aluno`),
  CONSTRAINT `FK_enturmado_ano_letivo` FOREIGN KEY (`id_ano`) REFERENCES `ano_letivo` (`id_ano`),
  CONSTRAINT `FK_enturmado_turma` FOREIGN KEY (`n_turma`) REFERENCES `turma` (`n_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.enturmado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `enturmado` DISABLE KEYS */;
/*!40000 ALTER TABLE `enturmado` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.frequencia
DROP TABLE IF EXISTS `frequencia`;
CREATE TABLE IF NOT EXISTS `frequencia` (
  `id_freq` int(11) NOT NULL AUTO_INCREMENT,
  `id_mat` int(11) DEFAULT NULL,
  `trimestre_freq` int(11) DEFAULT NULL,
  `data_freq` date DEFAULT NULL,
  `STATUS` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_freq`),
  KEY `id_mat` (`id_mat`),
  CONSTRAINT `frequencia_ibfk_1` FOREIGN KEY (`id_mat`) REFERENCES `matriculado` (`id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.frequencia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `frequencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `frequencia` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.funcao
DROP TABLE IF EXISTS `funcao`;
CREATE TABLE IF NOT EXISTS `funcao` (
  `id_func` int(11) NOT NULL AUTO_INCREMENT,
  `nome_func` varchar(50) NOT NULL,
  PRIMARY KEY (`id_func`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.funcao: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `funcao` DISABLE KEYS */;
REPLACE INTO `funcao` (`id_func`, `nome_func`) VALUES
	(1, 'Admin'),
	(2, 'Diretor'),
	(3, 'Coordenador'),
	(4, 'Secretário'),
	(5, 'Professor'),
	(6, 'Supervisor');
/*!40000 ALTER TABLE `funcao` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.matriculado
DROP TABLE IF EXISTS `matriculado`;
CREATE TABLE IF NOT EXISTS `matriculado` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `id_ano` int(11) DEFAULT NULL,
  `id_disc` int(11) DEFAULT NULL,
  `mat_aluno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mat`),
  KEY `mat_aluno` (`mat_aluno`),
  KEY `id_disc` (`id_disc`),
  KEY `id_ano` (`id_ano`),
  CONSTRAINT `matriculado_ibfk_1` FOREIGN KEY (`mat_aluno`) REFERENCES `aluno` (`mat_aluno`),
  CONSTRAINT `matriculado_ibfk_2` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`),
  CONSTRAINT `matriculado_ibfk_3` FOREIGN KEY (`id_ano`) REFERENCES `ano_letivo` (`id_ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.matriculado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `matriculado` DISABLE KEYS */;
/*!40000 ALTER TABLE `matriculado` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.ministra
DROP TABLE IF EXISTS `ministra`;
CREATE TABLE IF NOT EXISTS `ministra` (
  `id_ministra` int(11) NOT NULL AUTO_INCREMENT,
  `id_cursa` int(11) DEFAULT NULL,
  `mat_prof` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ministra`),
  KEY `id_cursa` (`id_cursa`),
  KEY `mat_prof` (`mat_prof`),
  CONSTRAINT `ministra_ibfk_1` FOREIGN KEY (`id_cursa`) REFERENCES `cursa` (`id_cursa`),
  CONSTRAINT `ministra_ibfk_2` FOREIGN KEY (`mat_prof`) REFERENCES `professor` (`mat_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.ministra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ministra` DISABLE KEYS */;
/*!40000 ALTER TABLE `ministra` ENABLE KEYS */;

-- Copiando estrutura para evento diario_new.myevent
DROP EVENT IF EXISTS `myevent`;
DELIMITER //
CREATE EVENT `myevent` ON SCHEDULE EVERY 5 SECOND STARTS '2022-03-12 18:04:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL apgcod()//
DELIMITER ;

-- Copiando estrutura para tabela diario_new.professor
DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `mat_prof` int(20) NOT NULL,
  `id_usur` int(11) DEFAULT NULL,
  PRIMARY KEY (`mat_prof`),
  KEY `id_usur` (`id_usur`),
  CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`id_usur`) REFERENCES `usuario` (`id_usur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.professor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.rec_conta
DROP TABLE IF EXISTS `rec_conta`;
CREATE TABLE IF NOT EXISTS `rec_conta` (
  `id_rec` int(11) NOT NULL,
  `id_usur` int(11) DEFAULT NULL,
  `cod_rec` varchar(50) NOT NULL DEFAULT '',
  `data_rec` datetime NOT NULL,
  PRIMARY KEY (`id_rec`),
  KEY `id_usur` (`id_usur`),
  CONSTRAINT `FK_rec_conta_usuario` FOREIGN KEY (`id_usur`) REFERENCES `usuario` (`id_usur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.rec_conta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rec_conta` DISABLE KEYS */;
/*!40000 ALTER TABLE `rec_conta` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.turma
DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `n_turma` int(11) NOT NULL,
  `id_turno` int(11) DEFAULT NULL,
  PRIMARY KEY (`n_turma`),
  KEY `id_turno` (`id_turno`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.turma: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.turno
DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `turno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.turno: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;

-- Copiando estrutura para tabela diario_new.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usur` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `funcao` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usur`),
  KEY `id_func` (`funcao`) USING BTREE,
  CONSTRAINT `FK_usuario_funcao` FOREIGN KEY (`funcao`) REFERENCES `funcao` (`id_func`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela diario_new.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
REPLACE INTO `usuario` (`id_usur`, `usuario`, `senha`, `email`, `ativo`, `funcao`, `nome`) VALUES
	(1, 'rafa', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'rafaeloliveirasigolo@gmail.com', 1, 2, 'Rafael de Oliveira Sigolo'),
	(2, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin@admin.com', 1, 1, 'Admin');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
