-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Fev-2017 às 03:30
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exemplo_ntwi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas_despesas`
--

CREATE TABLE `receitas_despesas` (
  `id` int(11) NOT NULL COMMENT 'Chave primaria .',
  `nome` varchar(50) NOT NULL COMMENT 'Ex .: conta de telefone .',
  `mes_referencia` int(11) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '1. Receita ; 2. Despesa .',
  `classe` int(1) NOT NULL COMMENT '1. variavel ; 2. Fixo .',
  `datahora` datetime NOT NULL,
  `valor` float NOT NULL,
  `usuario` int(11) NOT NULL COMMENT 'Id do usuario a quem pertence .',
  `descricao` text COMMENT 'Comentarios adicionais .'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receitas_despesas`
--

INSERT INTO `receitas_despesas` (`id`, `nome`, `mes_referencia`, `tipo`, `classe`, `datahora`, `valor`, `usuario`, `descricao`) VALUES
(96, 'Salario', 1, 1, 2, '2017-02-20 02:29:40', 1000, 1, 'Salario'),
(97, 'Receita Extra', 2, 1, 1, '2017-02-20 02:30:34', 500, 1, 'Receita Extra'),
(98, 'Despesa Fixa', 1, 2, 2, '2017-02-20 02:31:04', 300, 1, 'Despesa'),
(99, 'Despesa variavel', 2, 2, 1, '2017-02-20 02:31:30', 200, 1, 'Despesa variavel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Chave primaria .',
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sexo` int(11) NOT NULL COMMENT '1. Feminino ; 2. Masculino .',
  `identidade` varchar(20) DEFAULT NULL COMMENT 'Apenas numeros',
  `cpf` varchar(11) NOT NULL COMMENT 'Apenas numeros.',
  `nascimento` date NOT NULL,
  `estado_civil` int(11) NOT NULL COMMENT '1. Solteiro ; 2. Casado ; 3. Separado ;\r\n4. Divorciado ; 5. Viuvo ; 6. Uniao estavel .',
  `funcao_empresa` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(8) NOT NULL COMMENT 'Apenas numeros.',
  `perfil` int(11) NOT NULL COMMENT '1. Padrao ; 2. Administrador.',
  `cad_usuario` int(11) NOT NULL COMMENT 'Id do usuario que efetuou o cadastro .',
  `cad_datahora` datetime NOT NULL COMMENT 'Data e hora de efetivacao do cadastro .'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `nome`, `sexo`, `identidade`, `cpf`, `nascimento`, `estado_civil`, `funcao_empresa`, `email`, `telefone`, `perfil`, `cad_usuario`, `cad_datahora`) VALUES
(1, 'admin', 'admin', 'Administrador Padrao', 2, NULL, '00000000000', '2011-08-09', 1, 'Administracao', 'admin@minhaempresa.com.br', '00000000', 2, 1, '2011-08-09 17:44:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `receitas_despesas`
--
ALTER TABLE `receitas_despesas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`,`identidade`,`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `receitas_despesas`
--
ALTER TABLE `receitas_despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primaria .', AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primaria .', AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
