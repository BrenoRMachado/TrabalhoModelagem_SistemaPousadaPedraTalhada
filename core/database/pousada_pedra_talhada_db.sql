-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/01/2026 às 19:15
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pousada_pedra_talhada_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixadiario`
--

CREATE TABLE `caixadiario` (
  `id` int(11) NOT NULL,
  `DATA` datetime DEFAULT NULL,
  `saldoInicial` decimal(10,2) DEFAULT NULL,
  `saldoFinal` decimal(10,2) DEFAULT NULL,
  `STATUS` enum('ABERTO','FECHADO') DEFAULT NULL,
  `idFuncionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conta`
--

CREATE TABLE `conta` (
  `id` int(11) NOT NULL,
  `valorTotal` decimal(10,2) DEFAULT NULL,
  `STATUS` enum('ABERTA','FECHADA','PAGA') DEFAULT NULL,
  `idReserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `STATUS` enum('ATIVO','INATIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `id_usuario`, `nome`, `cpf`, `cargo`, `email`, `STATUS`) VALUES
(1, 1, 'Ana Carolina Junqueira', '000.000.000-00', 'Gerente', 'ana@email.com', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `hospede`
--

CREATE TABLE `hospede` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itemconsumo`
--

CREATE TABLE `itemconsumo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `valorUnitario` decimal(10,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `idConta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacaocaixa`
--

CREATE TABLE `movimentacaocaixa` (
  `id` int(11) NOT NULL,
  `tipo` enum('ENTRADA','SAIDA') DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `dataHora` datetime DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `idCaixaDiario` int(11) DEFAULT NULL,
  `idConta` int(11) DEFAULT NULL,
  `idFuncionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `quarto`
--

CREATE TABLE `quarto` (
  `numero` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `precoDiaria` decimal(10,2) DEFAULT NULL,
  `STATUS` enum('DISPONIVEL','OCUPADO','MANUTENCAO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `dataEntradaPrevista` datetime DEFAULT NULL,
  `dataSaidaPrevista` datetime DEFAULT NULL,
  `dataCheckin` datetime DEFAULT NULL,
  `dataCheckout` datetime DEFAULT NULL,
  `STATUS` enum('RESERVADA','HOSPEDADA','FINALIZADA','CANCELADA') DEFAULT NULL,
  `idQuarto` int(11) NOT NULL,
  `idHospede` int(11) NOT NULL,
  `idFuncionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`) VALUES
(1, 'ana202335002', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `caixadiario`
--
ALTER TABLE `caixadiario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFuncionario` (`idFuncionario`);

--
-- Índices de tabela `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idReserva` (`idReserva`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `hospede`
--
ALTER TABLE `hospede`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itemconsumo`
--
ALTER TABLE `itemconsumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idConta` (`idConta`);

--
-- Índices de tabela `movimentacaocaixa`
--
ALTER TABLE `movimentacaocaixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCaixaDiario` (`idCaixaDiario`),
  ADD KEY `idConta` (`idConta`),
  ADD KEY `idFuncionario` (`idFuncionario`);

--
-- Índices de tabela `quarto`
--
ALTER TABLE `quarto`
  ADD PRIMARY KEY (`numero`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idQuarto` (`idQuarto`),
  ADD KEY `idHospede` (`idHospede`),
  ADD KEY `idFuncionario` (`idFuncionario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixadiario`
--
ALTER TABLE `caixadiario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conta`
--
ALTER TABLE `conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `hospede`
--
ALTER TABLE `hospede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itemconsumo`
--
ALTER TABLE `itemconsumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `movimentacaocaixa`
--
ALTER TABLE `movimentacaocaixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `caixadiario`
--
ALTER TABLE `caixadiario`
  ADD CONSTRAINT `caixadiario_ibfk_1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`id`);

--
-- Restrições para tabelas `conta`
--
ALTER TABLE `conta`
  ADD CONSTRAINT `conta_ibfk_1` FOREIGN KEY (`idReserva`) REFERENCES `reserva` (`id`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `itemconsumo`
--
ALTER TABLE `itemconsumo`
  ADD CONSTRAINT `itemconsumo_ibfk_1` FOREIGN KEY (`idConta`) REFERENCES `conta` (`id`);

--
-- Restrições para tabelas `movimentacaocaixa`
--
ALTER TABLE `movimentacaocaixa`
  ADD CONSTRAINT `movimentacaocaixa_ibfk_1` FOREIGN KEY (`idCaixaDiario`) REFERENCES `caixadiario` (`id`),
  ADD CONSTRAINT `movimentacaocaixa_ibfk_2` FOREIGN KEY (`idConta`) REFERENCES `conta` (`id`),
  ADD CONSTRAINT `movimentacaocaixa_ibfk_3` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`id`);

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`idQuarto`) REFERENCES `quarto` (`numero`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`idHospede`) REFERENCES `hospede` (`id`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
