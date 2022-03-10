-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Mar-2022 às 22:08
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inner_join_mysqli_tres_tabelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessorio`
--

CREATE TABLE `acessorio` (
  `id` int(11) NOT NULL,
  `nome_acessorio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `acessorio`
--

INSERT INTO `acessorio` (`id`, `nome_acessorio`) VALUES
(3, 'Sem acessório'),
(4, 'Com cabo de força');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aparelho`
--

CREATE TABLE `aparelho` (
  `id` int(11) NOT NULL,
  `nome_aparelho` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aparelho`
--

INSERT INTO `aparelho` (`id`, `nome_aparelho`) VALUES
(32, 'TV LED'),
(33, 'TV TUBO'),
(34, 'SOM 3X1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `ordem_servico` varchar(5) NOT NULL,
  `id_cliente` varchar(5) NOT NULL,
  `id_aparelho` varchar(5) NOT NULL,
  `id_marca` varchar(5) NOT NULL,
  `id_defeito` int(5) NOT NULL,
  `id_acessorio` int(5) NOT NULL,
  `id_modelo` int(5) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `numeroSerie` varchar(100) NOT NULL,
  `id_estado` varchar(5) NOT NULL,
  `defeitoReclamado` varchar(200) NOT NULL,
  `dataEntrada` date NOT NULL,
  `dataPronto` date NOT NULL,
  `dataSaida` date NOT NULL,
  `orcamento` float NOT NULL,
  `material` varchar(254) NOT NULL,
  `acessorio` varchar(200) NOT NULL,
  `obs` varchar(254) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `barra` varchar(11) NOT NULL,
  `excluir` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `ordem_servico`, `id_cliente`, `id_aparelho`, `id_marca`, `id_defeito`, `id_acessorio`, `id_modelo`, `modelo`, `numeroSerie`, `id_estado`, `defeitoReclamado`, `dataEntrada`, `dataPronto`, `dataSaida`, `orcamento`, `material`, `acessorio`, `obs`, `foto`, `barra`, `excluir`) VALUES
(62, '00001', '77', '33', '27', 6, 0, 0, 'ASASSS233', '37466DFSG88', '1', '', '2022-03-01', '0000-00-00', '0000-00-00', 0, '', 'Com cabo de força', '', '', '4529216881', ''),
(63, '00002', '77', '34', '29', 7, 0, 0, 'HT-30', '23s12asd', '1', '', '2022-03-01', '0000-00-00', '0000-00-00', 0, '', 'com fonte, com carrocel, com cabiode força, com prato, com tudo que tem direito, com mais coisa', '', '', '8979520472', ''),
(64, '00003', '78', '34', '28', 6, 0, 0, 'ASASSS233', '37466DFSG88', '7', '', '2022-03-01', '0000-00-00', '0000-00-00', 0, '', 'Com cabo de força', '', '', '4063279314', ''),
(65, '00033', '79', '32', '28', 7, 0, 0, 'SS123', '2345ASDF12', '7', '', '2022-03-01', '0000-00-00', '0000-00-00', 0, '', 'dsdsds', 'asa', '', '6165061643', ''),
(66, '00123', '80', '34', '27', 7, 0, 0, 'ASASSS233', '123AS23', '8', '', '2022-03-07', '0000-00-00', '0000-00-00', 0, '', 'Com cabo de força', '', '', '3864573168', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `telefone2` varchar(15) NOT NULL,
  `cpf` varchar(12) NOT NULL,
  `dataNascimento` date NOT NULL,
  `dataCadastro` date NOT NULL,
  `foto` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `barra` varchar(12) NOT NULL,
  `excluir` varchar(4) NOT NULL,
  `numeroCadastro` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `endereco`, `telefone`, `telefone2`, `cpf`, `dataNascimento`, `dataCadastro`, `foto`, `email`, `barra`, `excluir`, `numeroCadastro`) VALUES
(77, 'Maria José de Lima Brito', 'Rua da Saudade 2345 Recife PE', '(81)92888-8888', '', '46371167162', '0000-00-00', '2022-03-01', '', 'ana@bol.com', '0872221817', '', 2),
(78, 'Ana Maria Lima', 'RUA DA PRAIA 123', '(34)34343-4343', '', '54748642645', '2002-06-05', '2022-03-01', '', 'claudioadventista@hotmail.com', '5546322389', '', 1),
(79, 'Delma da silva', 'Rua São Silvetre 56 Loteamento hosana Caruaru', '(23)23232-3232', '', '73681423172', '2002-06-05', '2022-03-01', '', 'claudioadventista@hotmail.com', '8069858777', '', 1),
(80, 'Ana Maria Lima', 'Rua da Saudade 2345 Recife PE', '(87)66554-4444', '', '38544337511', '2000-10-10', '2022-03-07', '', 'ana@bol.com', '5026725844', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `defeito`
--

CREATE TABLE `defeito` (
  `id` int(11) NOT NULL,
  `nome_defeito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `defeito`
--

INSERT INTO `defeito` (`id`, `nome_defeito`) VALUES
(6, 'Sem cor'),
(7, 'Sem funcionar'),
(8, 'Sem funcionar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nome_estado` varchar(50) NOT NULL,
  `sigla_estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id`, `nome_estado`, `sigla_estado`) VALUES
(1, 'PARA ORÇAMENTO', 'PO'),
(2, 'SERVIÇO PRONTO', 'SP'),
(3, 'APARELHO SAIU', 'AS'),
(4, 'RETORNOU', 'RT'),
(5, 'DEVOLVEU', 'DV'),
(6, 'COMPROU', 'CO'),
(7, 'DOOU', 'DO'),
(8, 'AGUARDANDO', 'AG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome_marca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `nome_marca`) VALUES
(27, 'CCE'),
(28, 'PHILCO'),
(29, 'TOSHIBA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `nome_modelo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`id`, `nome_modelo`) VALUES
(3, 'HPS2091'),
(4, 'PCS100');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acessorio`
--
ALTER TABLE `acessorio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `aparelho`
--
ALTER TABLE `aparelho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `defeito`
--
ALTER TABLE `defeito`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessorio`
--
ALTER TABLE `acessorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `aparelho`
--
ALTER TABLE `aparelho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `defeito`
--
ALTER TABLE `defeito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
