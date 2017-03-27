-- phpMyAdmin SQL Dump
-- version 3.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 27, 2017 as 09:35 AM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `reacher`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_reacher`
--

CREATE TABLE IF NOT EXISTS `config_reacher` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `chave` varchar(255) collate latin1_general_ci NOT NULL default '',
  `valor` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`cd`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `config_reacher`
--

INSERT INTO `config_reacher` (`cd`, `chave`, `valor`) VALUES
(1, 'senha', '123456'),
(2, 'email_admin', 'reacher@reacher.com.br'),
(3, 'url_site', 'http://www.devhouse.com.br'),
(4, 'remetente', 'Nome do Remetente'),
(5, 'email_remetente', 'reacher@reacher.com.br'),
(6, 'modelo_aniversario', '1'),
(7, 'assunto_email_aniversario', 'Feliz Aniversário!'),
(8, 'data_envio_aniversario', '17/02/2010'),
(9, 'return-path', 'reacher@reacher.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicoes`
--

CREATE TABLE IF NOT EXISTS `instituicoes` (
  `id_instituicao` int(10) unsigned NOT NULL auto_increment,
  `nome_instituicao` varchar(50) collate latin1_general_ci NOT NULL default '',
  `razao_social_instituicao` varchar(50) collate latin1_general_ci default NULL,
  `telefone_instituicao` varchar(15) collate latin1_general_ci default NULL,
  `fax_instituicao` varchar(15) collate latin1_general_ci default NULL,
  `endereco_instituicao` varchar(100) collate latin1_general_ci default NULL,
  `bairro_instituicao` varchar(30) collate latin1_general_ci default NULL,
  `cidade_instituicao` varchar(30) collate latin1_general_ci default NULL,
  `estado_instituicao` char(2) collate latin1_general_ci default NULL,
  `cep_instituicao` varchar(8) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id_instituicao`),
  UNIQUE KEY `nome` (`nome_instituicao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `instituicoes`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `lembretes`
--

CREATE TABLE IF NOT EXISTS `lembretes` (
  `id_lembrete` int(10) unsigned NOT NULL auto_increment,
  `titulo` varchar(255) collate latin1_general_ci NOT NULL default '',
  `destinatario` varchar(255) collate latin1_general_ci NOT NULL,
  `texto` text collate latin1_general_ci NOT NULL,
  `data` varchar(12) collate latin1_general_ci NOT NULL default '0000-00-00',
  `status` tinyint(4) NOT NULL default '1',
  `ultimo_envio` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_lembrete`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `lembretes`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `malas`
--

CREATE TABLE IF NOT EXISTS `malas` (
  `id_mala` int(10) unsigned NOT NULL auto_increment,
  `nome_mala` varchar(50) collate latin1_general_ci NOT NULL default '',
  `remetente_mala` varchar(255) collate latin1_general_ci default NULL,
  `assunto_mala` varchar(100) collate latin1_general_ci NOT NULL default '',
  `data_mala` date default '2099-12-31',
  `css_mala` text collate latin1_general_ci NOT NULL,
  `html_mala` text collate latin1_general_ci NOT NULL,
  `status_mala` char(1) collate latin1_general_ci NOT NULL default '1',
  `emails_enviados` bigint(20) NOT NULL default '0',
  `bounces` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `malas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `malas_envios`
--

CREATE TABLE IF NOT EXISTS `malas_envios` (
  `id_mala` bigint(20) unsigned NOT NULL,
  `email` varchar(255) collate latin1_general_ci NOT NULL,
  `ordem` bigint(20) NOT NULL,
  KEY `id_mala` (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `malas_envios`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `malas_visualizacoes`
--

CREATE TABLE IF NOT EXISTS `malas_visualizacoes` (
  `id_mala` int(10) unsigned NOT NULL,
  `id_pessoa` int(10) unsigned NOT NULL,
  KEY `id_mala` (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `malas_visualizacoes`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos`
--

CREATE TABLE IF NOT EXISTS `modelos` (
  `id_modelo` int(10) unsigned NOT NULL auto_increment,
  `nome_modelo` varchar(50) collate latin1_general_ci NOT NULL default '',
  `css_modelo` text collate latin1_general_ci NOT NULL,
  `html_modelo` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_modelo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `modelos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE IF NOT EXISTS `pessoas` (
  `id_pessoa` int(10) unsigned NOT NULL auto_increment,
  `id_instituicao` int(10) unsigned NOT NULL default '0',
  `nome_pessoa` varchar(50) collate latin1_general_ci NOT NULL default '',
  `telefone_pessoa` varchar(15) collate latin1_general_ci default NULL,
  `celular_pessoa` varchar(50) collate latin1_general_ci default NULL,
  `ramal_pessoa` varchar(5) collate latin1_general_ci default NULL,
  `email_pessoa` varchar(255) collate latin1_general_ci NOT NULL,
  `departamento_pessoa` varchar(30) collate latin1_general_ci default NULL,
  `dt_nascimento_pessoa` date default NULL,
  `recebe_email_pessoa` char(1) collate latin1_general_ci NOT NULL default 's',
  `dt_nao_recebe_email` datetime NOT NULL,
  `motivo` smallint(6) default NULL,
  `bounces` bigint(20) default NULL,
  PRIMARY KEY  (`id_pessoa`),
  UNIQUE KEY `email_pessoa` (`email_pessoa`),
  KEY `id_instituicao` (`id_instituicao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `pessoas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `segmentos`
--

CREATE TABLE IF NOT EXISTS `segmentos` (
  `id_segmento` int(10) unsigned NOT NULL auto_increment,
  `nome_segmento` varchar(50) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id_segmento`),
  UNIQUE KEY `nome_segmento` (`nome_segmento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `segmentos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `segmentos_instituicoes`
--

CREATE TABLE IF NOT EXISTS `segmentos_instituicoes` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_instituicao` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_instituicao`),
  KEY `id_segmento` (`id_segmento`),
  KEY `id_instituicao` (`id_instituicao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `segmentos_instituicoes`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `segmentos_malas`
--

CREATE TABLE IF NOT EXISTS `segmentos_malas` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_mala` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_mala`),
  KEY `id_segmento` (`id_segmento`),
  KEY `id_mala` (`id_mala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `segmentos_malas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `segmentos_pessoas`
--

CREATE TABLE IF NOT EXISTS `segmentos_pessoas` (
  `id_segmento` int(10) unsigned NOT NULL default '0',
  `id_pessoa` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_segmento`,`id_pessoa`),
  KEY `id_segmento` (`id_segmento`),
  KEY `id_pessoa` (`id_pessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `segmentos_pessoas`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
